<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class SMPG_Api_Controller {
                
        private static $instance;   
        private $_apiAction   = null;         
        
        private function __construct() {
            
            if($this->_apiAction == null){
                require_once SMPG_PLUGIN_DIR_PATH . 'admin/includes/class-smpg-api-action.php';
                $this->_apiAction = new SMPG_Api_Action();
            }            
                        
            add_action( 'rest_api_init', array($this, 'register_admin_routes'));
                                 
        }
                
        public static function get_instance() {
            
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
		    return self::$instance;
        }
        
        public function register_admin_routes(){
            
            register_rest_route( 'smpg-route', 'get-repeater-element', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_repeater_element'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));

            register_rest_route( 'smpg-route', 'get-post-meta', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_post_meta'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'get-selected-schema-properties', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'get_selected_schema_properties'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));   
            register_rest_route( 'smpg-route', 'save-post-meta', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'save_post_meta'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            
            register_rest_route( 'smpg-route', 'get-schema-loop', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_schema_loop'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));   
                        
            register_rest_route( 'smpg-route', 'change-post-status', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'change_post_status'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));            
            register_rest_route( 'smpg-route', 'save-schema-data', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'save_schema_data'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));                        
            register_rest_route( 'smpg-route', 'update-misc-schema', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'update_misc_schema'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'update-settings', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'update_settings'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));            
            register_rest_route( 'smpg-route', 'send-customer-query', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'send_customer_query'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));            
            register_rest_route( 'smpg-route', 'reset-settings', array(
                'methods'    => 'POST',
                'callback'   => array($this->_apiAction, 'reset_settings'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'get-schema-data', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_schema_data'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'get-automation-with', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_automation_with'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'get-plugin-list', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_plugin_list'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'placement-search', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'placement_search'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));            
            register_rest_route( 'smpg-route', 'get-settings', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_settings'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));
            register_rest_route( 'smpg-route', 'get-misc-schema', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_misc_schema'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));                        
            register_rest_route( 'smpg-route', 'get-page-list', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_page_list'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));            
            register_rest_route( 'smpg-route', 'export-settings', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'export_settings'),
                'permission_callback' => '__return_true'
            ));                        
            register_rest_route( 'smpg-route', 'get-tags', array(
                'methods'    => 'GET',
                'callback'   => array($this->_apiAction, 'get_tags'),
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ));                         
        }  
             
}
if(class_exists('SMPG_Api_Controller')){
    SMPG_Api_Controller::get_instance();
}