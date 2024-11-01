<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * All showings of an event - Grid
 *
 * This template can be overridden by copying it to yourtheme/ticketleo-events/event/event-grid.php.
 */
$event = $args['event'];
$soldOutMsg = __('Ausverkauft', 'ticketleo-events');
$noTicketsMsg = __('Für diese Vorstellung können online keine weiteren Tickets gekauft werden.', 'ticketleo-events');
$reservationMsg = __('Reservieren', 'ticketleo-events');
$showMsg = __('Anzeigen', 'ticketleo-events');
?>

<ul class="ticketleo-events-grid">
    <?php foreach ($event as $item):
        $date = strtotime($item->date);
        $isBookable = $item->availability->bookable;
        $totalSeats = $item->availability->total;
        $usedSeats = $item->availability->used;
        $availableSeats = $totalSeats - $usedSeats;
        $progress = ($totalSeats / 100) * $usedSeats;
        ?>
        <li class="ticketleo-event<?php echo esc_attr(!$isBookable) ? ' ticketleo-event--not-bookable': ' ticketleo-event--bookable'; ?>">
            <div class="ticketleo-event__container">
                <?php if ($item->name != ''): ?>
                    <div class="ticketleo-badge">
                        <?php echo esc_html($item->name) ?>
                    </div>
                <?php endif; ?>

                <div class="ticketleo-event-timing">
                    <span class="ticketleo-event-timing__date"><?php echo esc_html(date_i18n('d. F Y', $date)); ?></span>
                    <span class="ticketleo-event-timing__time"><?php echo esc_html(date_i18n('H:i', $date)); ?></span>
                </div>

                <?php if (
                    $isBookable
                    && $usedSeats != $totalSeats
                ): ?>
                    <p class="ticketleo-event__status">
                        <?php /* translators: %d is the number of available seats */
                        echo esc_html(sprintf(__('Noch %d Plätze verfügbar', 'ticketleo-events'), $availableSeats)); ?>
                    </p>
                <?php elseif ($usedSeats == $totalSeats): ?>
                    <p class="ticketleo-event__status"><?php echo esc_html($soldOutMsg); ?></p>
                <?php else: ?>
                    <p class="ticketleo-event__status">
                        <?php echo esc_html($noTicketsMsg); ?>
                    </p>
                <?php endif; ?>

                <div class="ticketleo-btn<?php echo esc_attr(!$isBookable) ? ' ticketleo-btn--show': ' ticketleo-btn--bookable'; ?>">
                    <a href="<?php echo esc_html($item->reservationLink); ?>" class="ticketleo-btn__link" target="_blank">
                        <?php echo esc_attr($isBookable) ?
                            esc_html($reservationMsg) :
                            esc_html($showMsg) ?>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>