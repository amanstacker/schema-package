<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class SMPG_Api_Individual_Controller {
                
        private static $instance;
        private $_apiAction   = null;
        
        private function __construct() {
            
            if ( $this->_apiAction == null ) {

                require_once SMPG_PLUGIN_DIR_PATH . 'admin/includes/class-smpg-api-action.php';
                $this->_apiAction = new SMPG_Api_Action();

            }            
                        
            add_action( 'rest_api_init', [ $this, 'register_admin_routes' ] );
                                 
        }
                
        public static function get_instance() {
            
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
		    return self::$instance;
        }
        
        public function register_admin_routes() {
            
            register_rest_route( 'smpg-individual-route', 'get-repeater-element', [
                'methods'    => 'GET',
                'callback'   => [ $this->_apiAction, 'get_repeater_element' ],
                'permission_callback' => function() {
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-individual-route', 'get-selected-schema-properties', [
                'methods'    => 'POST',
                'callback'   => [ $this->_apiAction, 'get_selected_schema_properties' ],
                'permission_callback' => function() {
                    return current_user_can( 'manage_options' );
                }
            ]);   
            register_rest_route( 'smpg-individual-route', 'save-post-meta', [
                'methods'    => 'POST',
                'callback'   => [ $this->_apiAction, 'save_post_meta' ],
                'permission_callback' => function() {
                    return current_user_can( 'manage_options' );
                }
            ]);            

        }  
             
}

if ( class_exists( 'SMPG_Api_Individual_Controller' ) ) {
    SMPG_Api_Individual_Controller::get_instance();
}