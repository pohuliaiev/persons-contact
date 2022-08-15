<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Persons_Contact_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		PERSCONT
 * @subpackage	Classes/Persons_Contact_Run
 * @author		Andrii Pohuliaiev
 * @since		1.0.0
 */
class Persons_Contact_Run{

	/**
	 * Our Persons_Contact_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks(){
	
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );
	
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles() {
		wp_enqueue_style( 'perscont-bootstrap-styles', PERSCONT_PLUGIN_URL . 'core/includes/assets/css/bootstrap.min.css', array(), PERSCONT_VERSION, 'all' );
		wp_enqueue_style( 'perscont-backend-styles', PERSCONT_PLUGIN_URL . 'core/includes/assets/css/backend-styles.css', array(), PERSCONT_VERSION, 'all' );
		wp_enqueue_script( 'perscont-bootstrap-scripts', PERSCONT_PLUGIN_URL . 'core/includes/assets/js/bootstrap.bundle.js', array(), PERSCONT_VERSION, false );
		wp_enqueue_script( 'perscont-backend-scripts', PERSCONT_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), PERSCONT_VERSION, false );
		wp_localize_script( 'perscont-backend-scripts', 'perscont', array(
			'plugin_name'   	=> __( PERSCONT_NAME, 'persons-contact' ),
		));
	}

}