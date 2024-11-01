import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, TextControl, SelectControl, CheckboxControl } from "@wordpress/components";
import {__} from "@wordpress/i18n";
import { useEffect, useState } from '@wordpress/element';
import { tool } from '@wordpress/icons';
import apiFetch from '@wordpress/api-fetch';


export default function Edit(props) {
    const blockProps = useBlockProps();
    const { attributes, setAttributes } = props;
    const [previewBlockContent, setPreviewBlockContent] = useState('');

    // Don't set attributes for grid view
    useEffect(() => {
        if (attributes.viewOptionValue === 'grid') {
            setAttributes({ showStatus: undefined })
        } else {
            if (attributes.showStatus === undefined) {
                setAttributes({ showStatus: false });
            }
        }
    }, [attributes.viewOptionValue]);

    // Get block content and show render_callback content inside block editor
    useEffect(() => {
        apiFetch({
            path: `/wp/v2/block-renderer/${props.name}`,
            method: 'POST',
            data: {
                context: 'edit',
                attributes: attributes
            },
        }).then((response) => {
            setPreviewBlockContent(response.rendered);
        }).catch((error) => {
            console.error('Error fetching block content:', error);
        });
    }, [attributes]);

    // Set User-ID
    function setUserID(value) {
        const newValue = value === '' ? undefined : Number(value);
        setAttributes({ userId: newValue })
    }

    // Set view option for frontend styling
    function setViewOption(newView) {
        const selectedOption = viewOptions.find(option => option.value === newView);
        setAttributes({ viewOptionLabel: selectedOption.label, viewOptionValue: selectedOption.value });
    }

    // Set meta data, that's supposed to render in frontend
    function toggleMetaData() {
        setAttributes({showStatus: !attributes.showStatus});
    }

    // view options available
    const viewOptions = [
        { label: 'Tabellarisch', value: 'table' },
        { label: 'Liste', value: 'list' },
        { label: 'Kacheln', value: 'grid' }
    ];

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Einstellungen', 'ticketleo-events')} initialOpen={true} icon={tool}>
                    <TextControl
                        label={__('User-ID', 'ticketleo-events')}
                        value={attributes.userId}
                        onChange={setUserID}
                        type="number"
                        help={
                            <span>
                                Wie Sie diese herausfinden, können Sie {' '}
                                <a href={ `${window.location.origin}/wp-content/plugins/ticketleo-events/docs/find-ids.pdf` } target="_blank" rel="noopener noreferrer">
                                    hier
                                </a> sehen.
                            </span>
                        }
                    />

                    <SelectControl
                        label={__('Ansicht', 'ticketleo-events')}
                        value={attributes.viewOptionValue}
                        options={viewOptions}
                        onChange={setViewOption}
                    />

                    {attributes.showStatus !== undefined  && (
                        <>
                            <label>{__('Metadaten einblenden', 'ticketleo-events')}</label>
                            <div style={{marginTop: '10px'}}>
                                <CheckboxControl
                                    label={__('Status', 'ticketleo-events')}
                                    checked={!!attributes.showStatus}
                                    onChange={() => toggleMetaData('status')}
                                />
                            </div>
                        </>
                    )}
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <div dangerouslySetInnerHTML={{__html: previewBlockContent}}/>
            </div>
        </>
    );
}