<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * All user events - Table
 *
 * This template can be overridden by copying it to yourtheme/ticketleo-events/eventslist/events-table.php.
 */
$events = $args['events'];
isset($args['meta_data']) ? $status = in_array('status', $args['meta_data']) : $status = '';

$soldOutMsg = __('Ausverkauft', 'ticketleo-events');
$noTicketsMsg = __('Für diese Veranstaltung können online keine weiteren Tickets gekauft werden.', 'ticketleo-events');
$reservationMsg = __('Reservieren', 'ticketleo-events');
$showMsg = __('Anzeigen', 'ticketleo-events');
?>

<div class="responsive-container">
    <table class="ticketleo-events-table">
        <thead>
            <tr>
                <th><?php echo esc_html__('Bezeichnung', 'ticketleo-events'); ?></th>
                <th><?php echo esc_html__('Datum', 'ticketleo-events'); ?></th>
                <th><?php echo esc_html__('Zeit', 'ticketleo-events'); ?></th>
                <th></th>
                <?php if ($status): ?>
                    <th><?php echo esc_html__('Status', 'ticketleo-events'); ?></th>
                <?php endif; ?>

                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($events as $event):
                $eventTime = $event->timestamp;
                $isBookable = $event->availability->bookable;
                $totalSeats = $event->availability->total;
                $usedSeats = $event->availability->used;
                $availableSeats = $totalSeats - $usedSeats;
                $progress = ($usedSeats / $totalSeats) * 100;
                ?>
                <tr class="ticketleo-event<?php echo esc_attr(!$isBookable) ? ' ticketleo-event--not-bookable': ' ticketleo-event--bookable' ?>">
                    <td class="ticketleo-events__title">
                        <span><?php echo esc_html($event->title); ?></span>
                    </td>
                    <td class="ticketleo-event-timing__date">
                        <span><?php echo esc_html(date_i18n('l, d. F Y', $eventTime)); ?></span>
                    </td>
                    <td class="ticketleo-event-timing__time">
                        <span><?php echo esc_html(date_i18n('H:i', $eventTime)); ?></span>
                    </td>

                    <?php if ($event->eventDateName != ''): ?>
                        <td class="ticketleo-event__badge">
                            <span class="ticketleo-badge">
                                <?php echo esc_html($event->eventDateName); ?>
                            </span>
                        </td>
                    <?php else: ?>
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
                                    <div class="ticketleo-event-progress__bar" style="width: <?php echo esc_html($progress); ?>%;"></div>
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
                            <a href="<?php echo esc_url($event->reservationLink); ?>" class="ticketleo-btn__link" target="_blank">
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
    <?php include('events-list.php'); ?>
</div>