<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       daeris.fr
 * @since      1.0.0
 *
 * @package    Tarteaucitron_Tag
 * @subpackage Tarteaucitron_Tag/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tarteaucitron_Tag
 * @subpackage Tarteaucitron_Tag/public
 * @author     Daeris <j.sartory@daeris.fr>
 */
class Tarteaucitron_Tag_Public
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
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_scripts()
    {
        $options = get_option('tarteaucitron_tag_settings');

        if ($options) {
            if ($options['domain'] != "" && $options['uuid'] != "") {
                $src = 'https://tarteaucitron.io/load.js?domain=' . $options['domain'] . '&uuid=' . $options['uuid'];
                if (function_exists('pll_current_language')) {
                    $src .= '&locale=' . pll_current_language();
                }
                wp_enqueue_script('tag_tarteaucitron', $src);
            }
        }

        
    }
}
