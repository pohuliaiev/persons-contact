<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Persons_Contact_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		PERSCONT
 * @subpackage	Classes/Persons_Contact_Settings
 * @author		Andrii Pohuliaiev
 * @since		1.0.0
 */
class Persons_Contact_Settings{

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   1.0.0
	 */
	private $plugin_name;

	/**
	 * Our Persons_Contact_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){

		$this->plugin_name = PERSCONT_NAME;
		add_action('admin_menu', 'persons_plugin_setup_menu');
	function persons_plugin_setup_menu(){
		add_menu_page( 'Persons', 'Persons', 'manage_options', 'persons-contact', 'persons_admin' );
	}

	function persons_register_settings(){
		register_setting(
			'persons_plugin_settings',
			'persons_plugin_settings',
			'persons_validate_plugin_settings'
		);
	}
	function persons_admin(){
		//include PERSCONT_PLUGIN_URL . 'templates/persons.php';
		require_once(dirname(__FILE__) . '/templates/persons.php');
	} 
	}

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * Return the plugin name
	 *
	 * @access	public
	 * @since	1.0.0
	 * @return	string The plugin name
	 */
	public function get_plugin_name(){
		return apply_filters( 'PERSCONT/settings/get_plugin_name', $this->plugin_name );
	}
}