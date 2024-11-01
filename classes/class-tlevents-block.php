<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TLEvents_Block
{
    private $name;
    private $events;
    private $custom_args;

    function __construct($name, $events, $custom_args = [])
    {
        $this->name = $name;
        $this->events = $events;
        $this->custom_args = $custom_args;
        add_action('init', [$this, 'onInit']);
    }

    function ourRenderCallback($attributes, $content)
    {
        ob_start();
        $events = $this->events;
        require TLEVENTS_PLUGIN_DIR . "blocks/{$this->name}/{$this->name}.php";
        return ob_get_clean();
    }

    function onInit()
    {
        wp_register_script($this->name,
            TLEVENTS_PLUGIN_URL . "build/{$this->name}.js",
            ['wp-blocks', 'wp-editor'],
            '1.0',
            true
        );

        $args = [
            'editor_script' => $this->name,
            'render_callback' => [$this, 'ourRenderCallback'],
            'editor_style' => 'ticketleo-events-styles'
        ];

        // Merge custom args passed from the constructor
        $args = array_merge($args, $this->custom_args);

        register_block_type("ticketleo-events/{$this->name}", $args);
    }
}