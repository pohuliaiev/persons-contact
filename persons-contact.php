<?php
/**
 * Persons Contact
 *
 * @package       PERSCONT
 * @author        Andrii Pohuliaiev
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Persons Contact
 * Plugin URI:    #
 * Description:   Persons with contacts demo plugin
 * Version:       1.0.0
 * Author:        Andrii Pohuliaiev
 * Author URI:    #
 * Text Domain:   persons-contact
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin name
define( 'PERSCONT_NAME',			'Persons Contact' );

// Plugin version
define( 'PERSCONT_VERSION',		'1.0.0' );

// Plugin Root File
define( 'PERSCONT_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'PERSCONT_PLUGIN_BASE',	plugin_basename( PERSCONT_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'PERSCONT_PLUGIN_DIR',	plugin_dir_path( PERSCONT_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'PERSCONT_PLUGIN_URL',	plugin_dir_url( PERSCONT_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once PERSCONT_PLUGIN_DIR . 'core/class-persons-contact.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Andrii Pohuliaiev
 * @since   1.0.0
 * @return  object|Persons_Contact
 */
function PERSCONT() {
	return Persons_Contact::instance();
}

PERSCONT();
