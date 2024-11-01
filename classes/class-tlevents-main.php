<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TLEvents_Main
{
    function __construct()
    {
        add_action( 'enqueue_block_assets', [$this, 'enqueueStyles'] );
    }

    /**
     * Get block styles
     *
     * @return void
     */
    function enqueueStyles() : void
    {
        wp_enqueue_style(
            'ticketleo-events-styles',
            plugins_url('src/style.css', __DIR__),
            array(),
            filemtime(TLEVENTS_PLUGIN_DIR . 'src/style.css')
        );
    }

    /**
     * Get template for selected view option
     *
     * @param $template
     * @param $args
     * @return false|string
     */
    static public function get_template($template, $args = [])
    {
        ob_start();
        if (false === get_template_part('ticketleo-events/' . $template, null, $args)) {
            include TLEVENTS_PLUGIN_DIR . 'templates/' . $template . '.php';
        }
        return ob_get_clean();
    }

    /**
     * Checks if the logged-in user is inside the block editor
     *
     * @return bool
     */
    function is_block_editor_request(): bool
    {
        // Check if the current user and the request are inside the block editor
        return defined('REST_REQUEST') && REST_REQUEST && isset($_REQUEST['_locale']) && $_REQUEST['_locale'] === 'user';
    }

    /**
     * Sorts an array of events by their date
     *
     * @param array|null $events
     * @param string $dateKey           The key for the date field in the event data (e.g., 'eventDate').
     * @return array                    The sorted events array.
     */
    private function sortEventsByDate(array $events = null, string $dateKey = 'date'): array
    {
        if (!$events || empty($events)) {
            return $events;
        }

        usort($events, function ($a, $b) use ($dateKey) {
            $dateA = is_int($a->{$dateKey}) ? $a->{$dateKey} : strtotime($a->{$dateKey});
            $dateB = is_int($b->{$dateKey}) ? $b->{$dateKey} : strtotime($b->{$dateKey});
            return $dateA <=> $dateB;
        });

        return $events;
    }

    /**
     * @param string $url               The full API URL
     * @param string $emptyMessage      The message to return if no data was found
     * @param string $dataKey           The key to access the relevant data from the response
     * @return array
     */
    private function processAPIRequest(string $url, string $emptyMessage, string $dataKey) : array
    {
        $result = [
            'success' => false,
            'data' => null,
            'message' => '',
        ];

        $response = wp_remote_get($url, [
            'timeout' => 10,
            'headers' => [
                'Cache-Control' => 'no-cache, max-age=0'
            ]
        ]);
        $responseStatusCode = wp_remote_retrieve_response_code($response);

        if (is_wp_error($response)) {
            $result['message'] = $response->get_error_message();
            return $result;
        }

        $responseBody = wp_remote_retrieve_body($response);
        $results = json_decode($responseBody);

        if ($responseStatusCode !== 200 || !empty($results->code)) {
            $result['message'] = $results->message ?? __('API error occurred', 'ticketleo-events');
            return $result;
        }

        if (empty($results->{$dataKey})) {
            $result['message'] = $emptyMessage;
            return $result;
        }

        $result['success'] = true;
        $result['data'] = $results->{$dataKey};

        return $result;
    }

    /**
     * Fetches all showings of an event
     *
     * @param int|null $eventId
     * @return array
     */
    public function fetchTicketleoEvent(int $eventId = null) : array
    {
        if ($eventId == null) {
            return [
                'success' => false,
                'data' => null,
                'message' => __('Bitte geben Sie eine Event-ID ein', 'ticketleo-events')
            ];
        }
        $url = 'https://admin.ticketleo.com/api/v1/event/' . $eventId;
        $result = $this->processApiRequest($url, __('Sie haben noch keine Vorstellungen erfasst', 'ticketleo-events'), 'eventDates');

        if ($result['success']) {
            $result['data'] = $this->sortEventsByDate($result['data'], 'date');
        }

        return $result;
    }

    /**
     * Fetches all user events
     *
     * @param int|null $userId
     * @return array
     */
    public function fetchTicketleoEvents(int $userId = null) : array
    {
        if ($userId == null) {
            return [
                'success' => false,
                'data' => null,
                'message' => __('Bitte geben Sie eine User-ID ein', 'ticketleo-events')
            ];
        }

        $url = 'https://admin.ticketleo.com/api/v1/event-list?limit=9999&user=' . $userId . '&availability=true';
        $result = $this->processAPIRequest($url, __('Sie haben noch keine Veranstaltungen erfasst', 'ticketleo-events'), 'events');

        if ($result['success']) {
            $result['data'] = $this->sortEventsByDate($result['data'], 'timestamp');
        }

        return $result;
    }
}