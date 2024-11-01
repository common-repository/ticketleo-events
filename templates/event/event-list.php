<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * All showings of an event - List
 *
 * This template can be overridden by copying it to yourtheme/ticketleo-events/event/event-list.php.
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

<ul class="ticketleo-events-list">
    <?php foreach ($event as $item):
        $date = strtotime($item->date);
        $isBookable = $item->availability->bookable;
        $totalSeats = $item->availability->total;
        $usedSeats = $item->availability->used;
        $availableSeats = $totalSeats - $usedSeats;
        ?>
        <li class="ticketleo-event<?php echo esc_attr(!$isBookable) ? ' ticketleo-event--not-bookable' : ' ticketleo-event--bookable'; ?>">
            <div class="ticketleo-events-column ticketleo-events-column--info">
                <div>
                    <?php if ($label && $item->name != ''): ?>
                        <div class="ticketleo-badge">
                            <?php echo esc_html($item->name) ?>
                        </div>
                    <?php endif; ?>

                    <div class="ticketleo-event-timing">
                        <span class="ticketleo-event-timing__date"><?php echo esc_html(date_i18n('d.m.Y', $date)); ?></span>
                        <span class="ticketleo-event-timing__time"><?php echo esc_html(date_i18n('H:i', $date)); ?></span>
                    </div>

                    <?php if (
                        $status
                        && $item->availability->bookable
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
                    <a href="<?php echo esc_url($item->reservationLink); ?>" class="ticketleo-btn__link" target="_blank">
                        <?php echo esc_attr($isBookable) ?
                            esc_html($reservationMsg) :
                            esc_html($showMsg); ?>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>