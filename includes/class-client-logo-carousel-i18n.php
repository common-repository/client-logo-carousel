<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://owlpixel.com
 * @since      1.0.0
 *
 * @package    Client_Logo_Carousel
 * @subpackage Client_Logo_Carousel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Client_Logo_Carousel
 * @subpackage Client_Logo_Carousel/includes
 * @author     Md Anowar Hossen <anrctg@gmail.com>
 */
class Client_Logo_Carousel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'client-logo-carousel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
