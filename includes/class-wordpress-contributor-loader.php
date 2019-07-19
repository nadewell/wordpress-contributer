<?php
/**
 * This class is for the function which will load all hooks and filters list.
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributor
 * 
 * @subpackage Wordpress_Contributor/includes
 * 
 */

 class Wordpress_Contributor_Loader {

    /**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions (The actions registered with WordPress to fire when the plugin loads.)
	 */
    protected $actions;
    
    /**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters (The filters registered with WordPress to fire when the plugin loads.)
	 */
	protected $filters;

    /**
	 * Initialize the array of the actions and filters with constructor.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->actions = array();
		$this->filters = array();
    }
    
    /**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action.
	 * @param    object               $component        Referance to instance it has been register for public or admin side.
	 * @param    string               $callback         The name of the callback function.
	 * @param    int                  $priority         The priority at which the function should be fired. Default is 10. (Optional)
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback. Default is 1. (Optional)
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
    }
    
    /**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action.
	 * @param    object               $component        Referance to instance it has been register for public or admin side.
	 * @param    string               $callback         The name of the callback function.
	 * @param    int                  $priority         The priority at which the function should be fired. Default is 10. (Optional)
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback. Default is 1. (Optional)
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}


    /**
	 * function that returns all hooks and filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            As what collection hooks are being registered (actions or filters).
	 * @param    string               $hook             The name of the WordPress action.
	 * @param    object               $component        Referance to instance it has been register for public or admin side.
	 * @param    string               $callback         The name of the callback function.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
    private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);
		return $hooks;
    }

    /**
	 * Function that will register each of the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
    }
    
}


