<?php
/**
 * This class holds all the callback functions for the hooks and filters registered for public area/Front-End
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributor
 * 
 * @subpackage Wordpress_Contributor/admin
 * 
 */

class Wordpress_Contributor_Public {

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
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
    }
    
	/**
	 * Register the stylesheets for the public area/Front-End.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * Here you can enqueue your css files
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-contributor-public.css', array(), $this->version, 'all' );
    }
    
	/**
	 * Register the JavaScript for the public area/Front-End.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * Here you can enqueue your javascript files
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-contributor-public.js', array( 'jquery' ), $this->version, false );
	}
}