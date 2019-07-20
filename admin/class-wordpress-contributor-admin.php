<?php
/**
 * This class holds all the callback functions for the hooks and filters registered for admin area/Back-End
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributor
 * 
 * @subpackage Wordpress_Contributor/admin
 * 
 */

class Wordpress_Contributor_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area/Back-End.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * Here you can enqueue your css files
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-contributor-admin.css', array(), $this->version, 'all' );
	}
	
	/**
	 * Register the JavaScript for the admin area/Back-End.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * Here you can enqueue your javascript files
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-contributor-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add new metabox for contributeors
	 * 
	 * @since 1.0.0
	 */
	public function contributors_add_meta_box() {
		add_meta_box( 
			'contributors', 
			__( 'Contributors', 'wordpress-contributor' ), 
			array( $this, 'contributors_metabox_callback' ),
			'post', 
			'normal', 
			'low', 
			array( 'title'=>'Contributors' )
		);
	}
	/**
	 * callback function of contributeors metabox
	 * 
	 * @since 1.0.0
	 */
	public function contributors_metabox_callback( $post ){
		require( dirname( __FILE__ ).'/partials/post-contributors-metabox.php' );
	}

	/**
	 * Save metabox data on post save
	 * 
	 * @since 1.0.0
	 */
	public function contributors_save_meta_box( $post_id ) {
		
		// verify meta box nonce
		if ( !isset( $_POST['contributors_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['contributors_meta_box_nonce'], 'wordpress-contributor' ) ){
			return;
		}
		
		// return if autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
			return;
		}

		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ){
			return;
		}

		// Save metabox data
		if( isset( $_POST['contributors'] ) && !empty( $_POST['contributors'] ) ){
			$contributors_array = $_POST['contributors'];
			$contributors = implode( ',' , $contributors_array );
			update_post_meta($post_id, 'contributors', $contributors );
		}
	}

}