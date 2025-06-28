<?php
/*
Plugin Name: Schema Package - A Structured Data Module
Description: Helps website owners automate and add versatile schema markup to their websites, enabling more informative and visually appealing search results.
Version: 1.0.15
Text Domain: schema-package
Domain Path: /languages
Author: amanstacker
Author URI: https://profiles.wordpress.org/amanstacker/
License: GPLv2 or later
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('SMPG_VERSION', '1.0.15');
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
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/mapping.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/generate.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/individual-post.php';
require_once SMPG_PLUGIN_DIR_PATH .'json-ld/markup.php';
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

add_filter( 'plugin_action_links_' . SMPG_PLUGIN_BASENAME, 'smpg_plugin_action_links' );

function smpg_plugin_action_links( $actions ) {

     $url = add_query_arg( 'page', 'schema_package&path=settings', self_admin_url( 'admin.php' ) );
     $actions[]  = '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'schema-package' ) . '</a>';
     return $actions;
}