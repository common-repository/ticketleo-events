<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * All user events - List
 *
 * This template can be overridden by copying it to yourtheme/ticketleo-events/eventslist/events-list.php.
 */
$events = $args['events'];
isset($args['meta_data']) ? $status = in_array('status', $args['meta_data']) : $status = '';

$soldOutMsg = __('Ausverkauft', 'ticketleo-events');
$noTicketsMsg = __('Für diese Vorstellung können online keine weiteren Tickets gekauft werden.', 'ticketleo-events');
$reservationMsg = __('Reservieren', 'ticketleo-events');
$showMsg = __('Anzeigen', 'ticketleo-events');
?>

<ul class="ticketleo-events-list">
    <?php foreach ($events as $event):
        $eventTime = $event->timestamp;
        $isBookable = $event->availability->bookable;
        $totalSeats = $event->availability->total;
        $usedSeats = $event->availability->used;
        $availableSeats = $totalSeats - $usedSeats;
        ?>
        <li class="ticketleo-event<?php echo esc_attr(!$isBookable) ? ' ticketleo-event--not-bookable': ' ticketleo-event--bookable'; ?>">
            <div class="ticketleo-events-column ticketleo-events-column--image">
                <img src="<?php echo esc_url($event->header); ?>" alt="">
            </div>

            <div class="ticketleo-events-column ticketleo-events-column--info">
                <div>
                    <?php if ($event->eventDateName != ''): ?>
                        <div class="ticketleo-badge">
                            <?php echo esc_html($event->eventDateName); ?>
                        </div>
                    <?php endif; ?>

                    <h2 class="ticketleo-events__title"><?php echo esc_html($event->title); ?></h2>

                    <div class="ticketleo-event-timing">
                        <span class="ticketleo-event-timing__date"><?php echo esc_html(date_i18n('d.m.Y', $eventTime)); ?></span>
                        <span class="ticketleo-event-timing__time"><?php echo esc_html(date_i18n('H:i', $eventTime)); ?></span>
                    </div>

                    <?php if (
                        $status
                        && $isBookable
                        && $usedSeats != $totalSeats
                    ): ?>
                        <p class="ticketleo-event__status">
                            <?php /* translators: %d is the number of available seats */
                            echo esc_html(sprintf(__('Noch %d Plätze verfügbar', 'ticketleo-events'), $availableSeats)); ?>
                        </p>
                    <?php elseif ($usedSeats == $totalSeats): ?>
                        <p class="ticketleo-event__status">
                            <?php echo esc_html($soldOutMsg); ?>
                        </p>
                    <?php elseif (!$isBookable && $status): ?>
                        <p class="ticketleo-event__status">
                            <?php echo esc_html($noTicketsMsg); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="ticketleo-btn<?php echo esc_attr(!$isBookable) ? ' ticketleo-btn--show': ' ticketleo-btn--bookable'; ?>">
                    <a href="<?php echo esc_url($event->reservationLink); ?>" class="ticketleo-btn__link" target="_blank">
                        <?php echo esc_attr($isBookable) ?
                            esc_html($reservationMsg) :
                            esc_html($showMsg); ?>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>