<?php
/**
 * This file is the main file read by WordPress to understand plugin information which
 * is shown in the admin area like plugin name, author name, version and etc. It also 
 * includes all of the dependencies, registers the activation and deactivation functions
 * and defines a function that loads the plugin.
 *
 * @link              http://blueprintdevelopers.in/Wordpress_Contributor
 * @since             1.0.0
 * @package           Wordpress_Contributor
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Contributor
 * Plugin URI:        http://blueprintdevelopers.in/Wordpress_Contributor
 * Description:       Wordpress Contributor plguin provides function to add the contributor(additional author) to a post from admin area. This Contributors are shown at the end of the post in Contributiors area.
 * Version:           1.0.0
 * Author:            Nishant Shaligram
 * Author URI:        http://blueprintdevelopers.in/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wordpress-contributor
 * Domain Path:       /languages
 */

// If this file is accessed directly, make an exit.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin version.
 */
define( 'WORDPRESS_CONTRIBUTOR_VERSION', '1.0.0' );

/**
 * Register plugin activation
 * This action is documented in includes/class-wordpress-contributor-activator.php
 */
function activate_wordpress_contributor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-contributor-activator.php';
	Wordpress_Contributor_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_wordpress_contributor' );

/**
 * Register plugin deactivation
 * This action is documented in class-wordpress-contributor-deactivator.php
 */
function deactivate_wordpress_contributor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-contributor-deactivator.php';
	Wordpress_Contributor_Deactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_wordpress_contributor' );

/**
 * Import plugin class that is used to define internationalization
 * and all hooks/filters.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-contributor.php';
/**
 * Begin the excution of core plugin class using it's instance
 * 
 * @since 1.0.0
 */
function run_wordpress_contributor(){
    $plugin  = new Wordpress_Contributor();
    $plugin->run();
}
run_wordpress_contributor();
