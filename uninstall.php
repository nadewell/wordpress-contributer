<?php
/**
 * function and action written here will fire on plugin uninstallation or deletion
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributer
 * 
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}