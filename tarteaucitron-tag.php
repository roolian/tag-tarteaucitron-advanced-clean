<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              daeris.fr
 * @since             1.0.0
 * @package           Tarteaucitron_Tag
 *
 * @wordpress-plugin
 * Plugin Name:       Tag TarteAuCitron Advanced
 * Description:       Ajoute, après paramétrage, le tag d'activation du service tarteaucitron. Compatbile avec Polylang
 * Version:           1.0.3
 * Author:            Daeris
 * Author URI:        daeris.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tarteaucitron-tag
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TARTEAUCITRON_TAG_VERSION', '1.0.3' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tarteaucitron-tag.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tarteaucitron_tag() {

	$plugin = new Tarteaucitron_Tag();
	$plugin->run();

}
run_tarteaucitron_tag();
