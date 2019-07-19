<?php
/**
 * This class is for the function which will load text domain for the plugin.
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributor
 * 
 * @subpackage Wordpress_Contributor/includes
 * 
 */

class Wordpress_Contributor_i18n {
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