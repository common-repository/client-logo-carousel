<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://owlpixel.com
 * @since             1.0.0
 * @package           Client_Logo_Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       Client Logo Carousel
 * Plugin URI:        https://owlpixel.com/plugins/client-logo-carousel
 * Description:       Client Logo Carousel is best to add a logo/partner carousel on your website. Just use our building function and you are ready to show the carousel to the website.
 * Version:           1.0.0
 * Author:            Md Anowar Hossen
 * Author URI:        https://owlpixel.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       client-logo-carousel
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
define( 'CLIENT_LOGO_CAROUSEL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-client-logo-carousel-activator.php
 */
function activate_client_logo_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-client-logo-carousel-activator.php';
	Client_Logo_Carousel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-client-logo-carousel-deactivator.php
 */
function deactivate_client_logo_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-client-logo-carousel-deactivator.php';
	Client_Logo_Carousel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_client_logo_carousel' );
register_deactivation_hook( __FILE__, 'deactivate_client_logo_carousel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-client-logo-carousel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_client_logo_carousel() {

	$plugin = new Client_Logo_Carousel();
	$plugin->run();

}
run_client_logo_carousel();
