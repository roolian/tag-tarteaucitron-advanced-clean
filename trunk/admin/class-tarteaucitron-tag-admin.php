<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       daeris.fr
 * @since      1.0.0
 *
 * @package    Tarteaucitron_Tag
 * @subpackage Tarteaucitron_Tag/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tarteaucitron_Tag
 * @subpackage Tarteaucitron_Tag/admin
 * @author     Daeris <j.sartory@daeris.fr>
 */
class Tarteaucitron_Tag_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function action_add_settings_page()
    {
        add_options_page('Tag TarteAuCitron', 'Tag TarteAuCitron', 'manage_options', 'tarteaucitron-tag-page', [$this, 'render_settings_page']);
    }

    public function render_settings_page()
    {
        $this->options = get_option('tarteaucitron_tag_settings');
        include plugin_dir_path(__FILE__) . 'partials/tarteaucitron-tag-admin-display.php';
    }

    public function action_register_settings()
    {
        register_setting(
            'tarteaucitron_tag_settings_group', // settings group name
            'tarteaucitron_tag_settings', // option name
            [
                'type' => 'array',
                'sanitize_callback' => [$this, 'sanitize_settings'], // sanitization function
                'default' => [],
            ]
        );

        add_settings_section(
            'tarteaucitron-tag-setting-section', // section ID
            'Paramètres du tag', // title (if needed)
            '', // callback function (if needed)
            'tarteaucitron-tag-page' // page slug
        );

        add_settings_field(
            'uuid',
            'UUID Tarte au Citron',
            [$this, 'render_field_uuid'], // function which prints the field
            'tarteaucitron-tag-page', // page slug
            'tarteaucitron-tag-setting-section' // section ID
        );

        add_settings_field(
            'domain',
            'Domaine du site (sans http://)',
            [$this, 'render_field_domain'], // function which prints the field
            'tarteaucitron-tag-page', // page slug
            'tarteaucitron-tag-setting-section' // section ID
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize_settings($input)
    {
        $new_input = [];
        if (isset($input['uuid'])) {
            $new_input['uuid'] = sanitize_text_field($input['uuid']);
        }

        if (isset($input['domain'])) {
            $new_input['domain'] = sanitize_text_field($input['domain']);
        }

        return $new_input;
    }

    public function render_field_uuid()
    {
        $text = isset($this->options['uuid']) ? $this->options['uuid'] : "";

        printf(
            '<input type="text" id="uuid" name="tarteaucitron_tag_settings[uuid]" value="%s" class="regular-text"/>',
            esc_attr($text)
        );
    }

    public function render_field_domain()
    {
        $text = isset($this->options['domain']) ? $this->options['domain'] : "";

        $placeholder = $_SERVER['HTTP_HOST'];

        printf(
            '<input type="text" id="domain" name="tarteaucitron_tag_settings[domain]" value="%1$s"  class="regular-text"/>
            <p class="description">Suggestion : %2$s</p>',
            esc_attr($text),
            $placeholder
        );
    }

}
