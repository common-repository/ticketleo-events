<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$eventData = [];
$viewOption = sanitize_text_field($attributes['viewOptionValue']) ?? 'default';
$metaDataLabel = isset($attributes['showMetaDataLabel']) ? (bool)$attributes['showMetaDataLabel'] : null;
$metaDataStatus = isset($attributes['showMetaDataStatus']) ? (bool)$attributes['showMetaDataStatus'] : null;

$eventID = isset($attributes['eventId']) ? (int)sanitize_text_field($attributes['eventId']) : null;
$eventList = $events->fetchTicketleoEvent($eventID);

if (!$eventList['success']) {
    // Show error message in the block editor if admin
    if ($events->is_block_editor_request() && !empty($eventList['message'])) {
        echo '<div class="error-message">' . esc_html($eventList['message']) . '</div>';
    }
    return null; // Do not output anything on the frontend if there's an error
}

$eventData['event'] = $eventList['data'];
?>
<?php if (!empty($eventData['event'])): ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <?php
            if ($metaDataLabel):
                $eventData['meta_data']['label'] = $metaDataLabel;
            endif;
            if ($metaDataStatus):
                $eventData['meta_data']['status'] = $metaDataStatus;
            endif;

            if ($eventList != null):
                switch($viewOption)
                {
                    case 'list':
                        echo wp_kses_post($events->get_template('event/event-list', $eventData));
                        break;
                    case 'grid':
                        echo wp_kses_post($events->get_template('event/event-grid', $eventData));
                        break;
                    default:
                        echo wp_kses_post($events->get_template('event/event-table', $eventData));
                }
            else:
                return null;
            endif;
        ?>
    </div>
<?php endif; ?>