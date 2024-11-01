<?php
/*
 * Plugin Name: Ticketleo Events
 * Description: Werben Sie Ihre Ticketleo-Events direkt auf Ihrer Website – wählen Sie aus drei flexiblen Ansichten.
 * Version: 1.0.2
 * Author: Hayloft-IT GmbH
 * Author URI: https://www.hayloft-it.ch/
 * License: GPLv2 or later
 * Text Domain: ticketleo-events
 */
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define constants for paths
define('TLEVENTS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TLEVENTS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Autoload required class files
require_once TLEVENTS_PLUGIN_DIR . 'classes/class-tlevents-main.php';
require_once TLEVENTS_PLUGIN_DIR . 'classes/class-tlevents-block.php';

if (!function_exists('tlevents_init')) {
    function tlevents_init() : void
    {
        $events = new TLEvents_Main();
        $event_block_json = json_decode(file_get_contents(plugin_dir_path(__FILE__) . 'blocks/event/block.json'), true);
        $eventslist_block_json = json_decode(file_get_contents(plugin_dir_path(__FILE__) . 'blocks/eventslist/block.json'), true);

        new TLEvents_Block('event', $events, $event_block_json);
        new TLEvents_Block('eventslist', $events, $eventslist_block_json);
    }
}
add_action('plugins_loaded', 'tlevents_init');