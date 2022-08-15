<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Persons_Contact' ) ) :

	/**
	 * Main Persons_Contact Class.
	 *
	 * @package		PERSCONT
	 * @subpackage	Classes/Persons_Contact
	 * @since		1.0.0
	 * @author		Andrii Pohuliaiev
	 */
	final class Persons_Contact {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Persons_Contact
		 */
		private static $instance;

		/**
		 * PERSCONT helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Persons_Contact_Helpers
		 */
		public $helpers;

		/**
		 * PERSCONT settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Persons_Contact_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'persons-contact' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'persons-contact' ), '1.0.0' );
		}

		/**
		 * Main Persons_Contact Instance.
		 *
		 * Insures that only one instance of Persons_Contact exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Persons_Contact	The one true Persons_Contact
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Persons_Contact ) ) {
				self::$instance					= new Persons_Contact;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Persons_Contact_Helpers();
				self::$instance->settings		= new Persons_Contact_Settings();

				//Fire the plugin logic
				new Persons_Contact_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'PERSCONT/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once PERSCONT_PLUGIN_DIR . 'core/includes/classes/class-persons-contact-helpers.php';
			require_once PERSCONT_PLUGIN_DIR . 'core/includes/classes/class-persons-contact-settings.php';

			require_once PERSCONT_PLUGIN_DIR . 'core/includes/classes/class-persons-contact-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'persons-contact', FALSE, dirname( plugin_basename( PERSCONT_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.