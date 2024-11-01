<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$eventsData = [];
$viewOption = sanitize_text_field($attributes['viewOptionValue']) ?? 'default';
$metaDataStatus = isset($attributes['showStatus']) ? (bool)$attributes['showStatus'] : null;

$userID = isset($attributes['userId']) ? (int)sanitize_text_field($attributes['userId']) : null;
$userEvents = $events->fetchTicketleoEvents($userID);

if (!$userEvents['success']) {
    // Show error message in the block editor if admin
    if ($events->is_block_editor_request() && !empty($userEvents['message'])) {
        echo '<div class="error-message">' . esc_html($userEvents['message']) . '</div>';
    }
    return null; // Do not output anything on the frontend if there's an error
}

$eventsData['events'] = $userEvents['data'];
?>
<?php if (!empty($eventsData['events'])): ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <?php
            if ($metaDataStatus):
                $eventsData['meta_data']['status'] = $metaDataStatus;
            endif;

            if (!is_null($userEvents)):
                switch ($viewOption) {
                    case 'list':
                        echo wp_kses_post($events->get_template('eventslist/events-list', $eventsData));
                        break;
                    case 'grid':
                        echo wp_kses_post($events->get_template('eventslist/events-grid', $eventsData));
                        break;
                    default:
                        echo wp_kses_post($events->get_template('eventslist/events-table', $eventsData));
                }
            else:
                return null;
            endif;
        ?>
    </div>
<?php endif; ?>