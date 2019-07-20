<?php
/**
* The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks
 *
 * Also maintains the unique identifier(Name) and current version of the plugin.
 * 
 * @since 1.0.0
 * 
 * @package Wordpress_Contributor
 * 
 * @subpackage Wordpress_Contributor/includes
 * 
 */

class Wordpress_Contributor {

    /**
	 * The loader that's responsible for maintaining and registering all hooks
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
    protected $loader;
    
    /**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
    protected $plugin_name;

    /**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
    protected $version;
    
    /**
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
    
    public function __construct() {
		if ( defined( 'WORDPRESS_CONTRIBUTOR_VERSION' ) ) {
			$this->version = WORDPRESS_CONTRIBUTOR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wordpress-contributor';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
    }
    
    /**
	 * Load the required dependencies for this plugin.
     * 
     * @since    1.0.0
	 * @access   private
     */
    private function load_dependencies() {
		/**
		 * The class responsible for maintaining the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wordpress-contributor-loader.php';
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wordpress-contributor-i18n.php';
		/**
		 * The class responsible for defining all actions that occur in the admin area/Back_end of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wordpress-contributor-admin.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing/Front-End side of the site.
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wordpress-contributor-public.php';
        
        //Create instance of the loader class
		$this->loader = new Wordpress_Contributor_Loader();
    }
    
    /**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the text-domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Wordpress_Contributor_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

    /**
	 * Register all of the hooks related to the admin area/Back-End
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Wordpress_Contributor_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'contributors_add_meta_box' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'contributors_save_meta_box' );
    }
    
    /**
	 * Register all of the hooks related to the public-facing/Front-End
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Wordpress_Contributor_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'the_content', $plugin_public, 'add_contributors_content' );
    }
    
    /**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
    }
    
    /**
	 * Function to retrieve name of the plugin used to uniquely identify it within the context of
	 * WordPress.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
    }
    
    /**
	 * The reference to the class that maintains the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wordpress_Contributor_Loader    Maintains the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
    }
    
    /**
	 * Retrieve the version of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}