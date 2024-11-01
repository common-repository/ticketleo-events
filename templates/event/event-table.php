<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * All showings of an event - Table
 *
 * This template can be overridden by copying it to yourtheme/ticketleo-events/event/event-table.php.
 */
$event = $args['event'];
$label = $status = '';

if (isset($args['meta_data'])) {
    $label = $args['meta_data']['label'] ?? false;
    $status = $args['meta_data']['status'] ?? false;
}

$soldOutMsg = __('Ausverkauft', 'ticketleo-events');
$noTicketsMsg = __('Für diese Vorstellung können online keine weiteren Tickets gekauft werden.', 'ticketleo-events');
$reservationMsg = __('Reservieren', 'ticketleo-events');
$showMsg = __('Anzeigen', 'ticketleo-events');
?>

<div class="responsive-container">
    <table class="ticketleo-events-table">
        <thead>
            <tr>
                <th><?php echo esc_html__('Datum', 'ticketleo-events'); ?></th>
                <th><?php echo esc_html__('Zeit', 'ticketleo-events'); ?></th>

                <?php if ($label): ?>
                    <th></th>
                <?php endif; ?>

                <?php if ($status): ?>
                    <th><?php echo esc_html__('Status', 'ticketleo-events'); ?></th>
                <?php endif; ?>

                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($event as $item):
            $date = strtotime($item->date);
            $isBookable = $item->availability->bookable;
            $totalSeats = $item->availability->total;
            $usedSeats = $item->availability->used;
            $availableSeats = $totalSeats - $usedSeats;
            $progress = ($usedSeats / $totalSeats) * 100;
            ?>
            <tr class="ticketleo-event<?php echo esc_attr(!$isBookable) ? ' ticketleo-event--not-bookable': ' ticketleo-event--bookable'; ?>">
                <td class="ticketleo-event-timing__date">
                    <span><?php echo esc_html(date_i18n('l, d. F Y', $date)); ?></span>
                </td>
                <td class="ticketleo-event-timing__time">
                    <span><?php echo esc_html(date_i18n('H:i', $date)); ?></span>
                </td>
                <?php if ($label && $item->name != ''): ?>
                    <td class="ticketleo-event__badge">
                        <span class="ticketleo-badge">
                            <?php echo esc_html($item->name); ?>
                        </span>
                    </td>
                <?php elseif ($label && $item->name == ''): ?>
                    <td></td>
                <?php endif; ?>

                <?php if ($status): ?>
                    <td class="ticketleo-event__status">
                        <?php if (
                            $isBookable
                            && $usedSeats != $totalSeats
                        ): ?>
                            <div class="ticketleo-event-progress">
                                <span class="ticketleo-event-progress__tooltip">
                                    <?php /* translators: %d is the number of available seats */
                                    echo esc_html(sprintf(__('Noch %d Plätze verfügbar', 'ticketleo-events'), $availableSeats)); ?>
                                </span>
                                <div class="ticketleo-event-progress__bar" style="width: <?php echo esc_html($progress) ?>%;"></div>
                            </div>
                        <?php elseif ($usedSeats == $totalSeats): ?>
                            <span><?php echo esc_html($soldOutMsg); ?></span>
                        <?php else: ?>
                            <span>
                                <?php echo esc_html($noTicketsMsg); ?>
                            </span>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>

                <td class="ticketleo-event__reservation">
                    <div class="ticketleo-btn<?php echo esc_attr(!$isBookable) ? ' ticketleo-btn--show': ' ticketleo-btn--bookable'; ?>">
                        <a href="<?php echo esc_url($item->reservationLink); ?>" class="ticketleo-btn__link" target="_blank">
                            <?php echo esc_attr($isBookable) ?
                                esc_html($reservationMsg) :
                                esc_html($showMsg); ?>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Mobile view -->
    <?php include ('event-list.php'); ?>
</div>