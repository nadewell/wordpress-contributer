<?php
/**
 * This class is for the activation function which will fired on plugin activation
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributer
 * 
 * @subpackage Wordpress_Contributer/includes
 * 
 */

class Plugin_Name_i18n {
	/**
	 * Load the plugin text domain for translation.
	 * Define function for internationalization
     * 
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'wordpress-contributor',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
	}
}