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
                        
            add_action( 'rest_api_init', [ $this, 'register_admin_routes' ] );
                                 
        }
                
        public static function get_instance() {
            
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
		    return self::$instance;
        }
        
        public function register_admin_routes(){
            
            register_rest_route( 'smpg-route', 'get-repeater-element', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_repeater_element'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);

            register_rest_route( 'smpg-route', 'get-post-meta', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_post_meta'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-selected-schema-properties', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'get_selected_schema_properties'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);   
            register_rest_route( 'smpg-route', 'save-post-meta', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'save_post_meta'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            
            register_rest_route( 'smpg-route', 'get-schema-loop', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_schema_loop'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
                                               
            register_rest_route( 'smpg-route', 'change-post-status', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'change_post_status'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'save-schema-data', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'save_schema_data'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'save-carousel-schema-data', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'save_carousel_schema_data'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);                        
            register_rest_route( 'smpg-route', 'update-misc-schema', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'update_misc_schema'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'update-settings', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'update_settings'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'send-customer-query', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'send_customer_query'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'reset-settings', [
                'methods'    => 'POST',
                'callback'   => [$this->_apiAction, 'reset_settings'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-schema-data', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_schema_data'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-carousel-schema-data', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_carousel_schema_data'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-automation-with', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_automation_with'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-schema-properties', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_schema_properties'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-carousel-automation-with', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_carousel_automation_with'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-plugin-list', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_plugin_list'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'placement-search', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'placement_search'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'carousel-placement-search', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'carousel_placement_search'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'get-settings', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_settings'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-misc-schema', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_misc_schema'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);                        
            register_rest_route( 'smpg-route', 'get-page-list', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_page_list'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'export-settings', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'export_settings'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                 }
            ]);                        
            register_rest_route( 'smpg-route', 'get-tags', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_tags'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-mapping-meta-list', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_mapping_meta_list'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);
            register_rest_route( 'smpg-route', 'get-taxonomies', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_taxonomies'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'get-custom-fields', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_custom_fields'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
            register_rest_route( 'smpg-route', 'get-advanced-custom-fields', [
                'methods'    => 'GET',
                'callback'   => [$this->_apiAction, 'get_advanced_custom_fields'],
                'permission_callback' => function(){
                    return current_user_can( 'manage_options' );
                }
            ]);            
        }  
             
}
if(class_exists('SMPG_Api_Controller')){
    SMPG_Api_Controller::get_instance();
}