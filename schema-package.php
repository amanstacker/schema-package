<?php
/*
Plugin Name: Schema Package - A Structured Data Module
Description: Helps you to add versatile schema markup on your websites.
Version: 1.0.1
Text Domain: schema-package
Domain Path: /languages
Author: Aman Kumar Sharma
Author URI: https://profiles.wordpress.org/amanstacker/
License: GPLv2 or later
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('SMPG_VERSION', '1.0.1');
define('SMPG_DIR_NAME_FILE', __FILE__ );
define('SMPG_DIR_NAME', dirname( __FILE__ ));
define('SMPG_DIR_URI', plugin_dir_url(__FILE__));
define('SMPG_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ));

define('SMPG_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('SMPG_PLUGIN_BASENAME', plugin_basename(__FILE__));

//Admin
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/class-smpg-api-controller.php';
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/class-smpg-api-individual-controller.php';
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/class-smpg-api-action.php';
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/class-smpg-api-mapper.php';
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/setup.php';
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/class-smpg-individual-post.php';
require_once SMPG_PLUGIN_DIR_PATH .'admin/includes/properties.php';
//Frontend
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/generate.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/individual-post.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/output.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/conditions.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/automation.php';

//Loading Helper Files
require_once SMPG_PLUGIN_DIR_PATH.'helper/class-smpg-aq-resize.php';
require_once SMPG_PLUGIN_DIR_PATH.'helper/class-youtube-data-api.php';

//Shared Files
require_once SMPG_PLUGIN_DIR_PATH .'shared/shared-methods.php';

register_uninstall_hook( __FILE__, 'smpg_on_plugin_uninstall' );
register_activation_hook( __FILE__, 'smpg_on_plugin_activation' );

function smpg_load_plugin_textdomain() {    

    load_plugin_textdomain( 'schema-package', false, basename( dirname( __FILE__ ) ) . '/languages/' );
    
}

add_action( 'plugins_loaded', 'smpg_load_plugin_textdomain' );