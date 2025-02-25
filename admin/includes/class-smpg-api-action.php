<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class SMPG_Api_Action {
                        
        protected $_api_mapper        = null;          
        
        public function __construct() {
            
            if($this->_api_mapper == null){
                require_once SMPG_PLUGIN_DIR_PATH . 'admin/includes/class-smpg-api-mapper.php';
                $this->_api_mapper = new SMPG_Api_Mapper();
            }                                                
                                 
        }                        
       
        public function delete_individual_schema_by_id( $request ) {


        }

        public function change_post_status($request){
            
            $parameters     = $request->get_params();
            $_current_status = 1;                  

            if( isset($parameters['post_id']) ){
                $post_id                = intval( $parameters['post_id'] );
                $_current_status         = rest_sanitize_boolean( $parameters['_current_status'] );
                $action                 = sanitize_text_field($parameters['action']);

                switch ($action) {

                    case 'change':
                            update_post_meta($post_id, '_current_status', $_current_status);        
                        break;

                    case 'delete':
                            wp_delete_post($post_id);
                    break;    
                    
                    default:
                        
                        break;
                }
                
            }                           
            
            return true;

        }
        
                
        public function get_page_list($request){

            $response = [];
            $search   = '';            

            $parameters = $request->get_params();

            if(isset($parameters['search'])){
                $search   = $parameters['search'];
            }            

            $response = $this->_api_mapper->get_placement_data('page', $search);

            if($response){
                return array('status' => 't', 'data' => $response);
            }else{
                return array('status' => 'f', 'data' => esc_html__( 'data not found', 'schema-package' ) );
            }
            
            return $response;

        }                
        public function get_tags( $request ) {

            $response = [];
            $search   = '';

            $parameters = $request->get_params();

            if(isset($parameters['search'])){
                $search   = $parameters['search'];
            }

            $response = $this->_api_mapper->get_placement_data('tags', $search, $saved_data = null, 'diff');
            if($response){
                return array( 'status' => 't', 'data' => $response );
            }else{
                return array( 'status' => 'f', 'data' => esc_html__( 'data not found', 'schema-package' ) );
            }
            
            return $response;

        }
                
        public function export_settings(){
            
            $export_data_all = []; 
            $post_type       = [ 'smpg_singular_schema', 'smpg_carousel_schema' ];
                        
            foreach( $post_type as $type ) {
                
                $export_data       = [];                

                $all_schema_post = get_posts( [
                            'post_type' 	     => $type,                                                                                   
                            'posts_per_page'     => -1,   
                            'post_status'        => 'any',
                    ] );                        

                if ( $all_schema_post ) {
                
                    foreach ( $all_schema_post as $schema ) {

                    $export_data[$schema->ID]['post']      = (array)$schema;                    
                    $post_meta                             = get_post_meta( $schema->ID, $key='', true );    

                    if ( $post_meta ) {

                        foreach ( $post_meta as $key => $meta ) {

                            if ( @unserialize( $meta[0] ) !== false ) {
                                $post_meta[$key] = @unserialize( $meta[0] );
                            }else{
                                $post_meta[$key] = $meta[0];
                            }

                        }

                    }

                    $export_data[$schema->ID]['post_meta'] = $post_meta;  

                    }       

                    $export_data_all['posts'][$type] = $export_data;    
                    
                }
                                    
                
            }
            
            $export_data_all['smpg_settings']         = get_option( 'smpg_settings' );
            $export_data_all['smpg_misc_schema']      = get_option( 'smpg_misc_schema' );
            
            return   $export_data_all;
        }
        
        public function reset_settings($request){

                $result = '';
        
                delete_option( 'smpg_settings');  
                
                $allposts= get_posts( array('post_type'=>'smpg_singular_schema','numberposts'=>-1) );
                
                foreach ($allposts as $eachpost) {
                    
                    $result = wp_delete_post( $eachpost->ID, true );
                
                }

                if( $result ) {
                    return array( 'status' => 't' , 'msg' => esc_html__( 'Reset Successfully', 'schema-package' ) );
                }

        }
        
        public function send_customer_query($request){

             $parameters = $request->get_params();
                                         
             $message        = sanitize_textarea_field( wp_unslash( $parameters['message'] ) ); 
             $email          = sanitize_email( wp_unslash( $parameters['email'] ) );
                                       
             $message = '<p>'.$message.'</p><br><br>'                     
                     . '<br><br>'.'Query from SMPG support tab';
             
             if ( $email && $message ) {
                           
                 //php mailer variables        
                 $sendto    = 'support@schemapackage.com';
                 $subject   = "Schema Package Customer Query";
                 
                 $headers[] = 'Content-Type: text/html; charset=UTF-8';
                 $headers[] = 'From: '. esc_attr($email);            
                 $headers[] = 'Reply-To: ' . esc_attr($email);
                 // Load WP components, no themes.                      
                 $sent = wp_mail( $sendto, $subject, $message, $headers );
     
                 if ( $sent ){
     
                    return array( 'status' => 't' );
     
                 }else{
     
                    return array( 'status' => 'f' );
     
                 }
                 
             }else{

                return array( 'status'=> 'f', 'msg' => esc_html__( 'Please provide message and email', 'schema-package' ) );

             }
        }
                
        
        public function get_settings( $request_data ) {
                
                $response   = $this->_api_mapper->get_settings();

                return  $response;

        }
        
        public function get_misc_schema($request_data){
            
            $response = [];

            $misc_schema    = $this->_api_mapper->get_misc_schema();
            $pages          = $this->_api_mapper->get_placement_data('page');
            

            if(!empty($misc_schema['about_pages'])){

                $about_pages = [];

                foreach ($misc_schema['about_pages'] as $value) {
                    $saved_data = $this->_api_mapper->get_placement_data('page', '', $value);
                    if(!empty($saved_data)){
                        $about_pages  = array_merge($about_pages, $saved_data);
                    }
                }
                
                $pages = array_merge($pages, $about_pages);                            
            }

            if(!empty($misc_schema['contact_pages'])){

                $about_pages = [];

                foreach ($misc_schema['contact_pages'] as $value) {
                    $saved_data = $this->_api_mapper->get_placement_data('page', '', $value);
                    if(!empty($saved_data)){
                        $about_pages  = array_merge($about_pages, $saved_data);
                    }
                }
                
                $pages = array_merge($pages, $about_pages);                            
            }
            

            $response = array('misc_schema' => $misc_schema, 'about_pages' => $pages, 'contact_pages' => $pages);

            return  $response;

        }                
        
        public function placement_search($request_data) {

            $response = [];

            $parameters = $request_data->get_params();            

            if( isset($parameters['type']) && isset($parameters['search']) ) {
                $response = $this->_api_mapper->get_placement_data($parameters['type'], $parameters['search']);    
            }
            
            return $response;

        }
        public function carousel_placement_search( $request_data ) {

            $response = [];

            $parameters = $request_data->get_params();            

            if( isset($parameters['type']) && isset($parameters['search']) ) {
                $response = $this->_api_mapper->get_terms_by_search($parameters['type'], $parameters['search']);    
            }
            
            return $response;

        }
        public function get_automation_with( $request_data ){

            $response    = [];
            $schema_type = '';
            
            $parameters = $request_data->get_params();
            
            if(!empty($parameters['schema_type'])) {
                $schema_type = $parameters['schema_type'];
                $result    = $this->_api_mapper->get_automation_with( $schema_type );                 
                $response = [ 'status' => 'success', 'data' => $result ]; 
            }else{
                $response = [ 'status' => 'failed', 'message' => esc_html__( 'Schema type is required', 'schema-package' ) ];
            }                                    
            return $response;
        }
        public function get_schema_properties( $request_data ){

            $response    = [];
            $schema_type = '';
            
            $parameters = $request_data->get_params();
            
            if(!empty($parameters['schema_type'])) {                                
                
                $schema_properties = smpg_get_schema_properties( $parameters['schema_type'] );

                $filtered_pro = [];  
                foreach ( $schema_properties['properties'] as $key => $value ) {
                    $filtered_pro[] = ['key' => $key, 'text' => $value['label'] ];
                }
                $response = [ 'status' => 'success', 'data' => $filtered_pro ]; 
            }else{
                $response = [ 'status' => 'failed', 'message' => esc_html__( 'Schema type is required', 'schema-package' ) ];
            }                                    
            return $response;
        }
        public function get_carousel_automation_with( $request_data ) {

            $response    = [];
            $schema_type = '';
            
            $parameters = $request_data->get_params();
            
            if(!empty($parameters['schema_type'])) {
                $schema_type = $parameters['schema_type'];
                $result    = $this->_api_mapper->get_automation_with( $schema_type );                 
                $response = [ 'status' => 'success', 'data' => $result ]; 
            }else{
                $response = [ 'status' => 'failed', 'message' => esc_html__( 'Schema type is required', 'schema-package' ) ];
            }                                    
            return $response;
        }
        public function get_plugin_list( $request_data ){

            global $smpg_plugin_list;

            $response    = [];            
            $result      = [];
            $parameters = $request_data->get_params();
            
            if(!empty($parameters['filter'])) {
                
                if($parameters['filter'] == 'has_own_json_ld'){

                    foreach ($smpg_plugin_list as $key => $value) {
                                                                    
                            if( $value['is_active'] && $value['has_own_json_ld'] ){
                                
                                $result[$key] = $value;	
                            }

                    }

                }

                $response = [ 'status' => 'success', 'data' => $result ]; 

            }else{
                $response = [ 'status' => 'failed', 'message' => esc_html__( 'filter required', 'schema-package' ) ];
            }                                    
            return $response;
        }

        public function get_schema_data( $request_data ) {

            $response = [];

            $parameters = $request_data->get_params();

            $post_id = null;

            if ( isset( $parameters['post_id'] ) ) {
                $post_id = $parameters['post_id'];
            }

            $response = $this->_api_mapper->get_schema_data( $post_id );

            return $response;
           
        }
        public function get_mapping_meta_list( $request_data ) {
            return smpg_meta_list();
        }
        public function get_taxonomies( $request_data ) {
            // Fetch all public taxonomies
                $taxonomies = get_taxonomies(['public' => true], 'objects');
                
                // Format the response
                $taxonomy_list = [];

                foreach ($taxonomies as $taxonomy) {
                    $taxonomy_list[] = [
                        'slug' => $taxonomy->name,
                        'name' => $taxonomy->label
                    ];
                }

                // Return JSON response
                return rest_ensure_response($taxonomy_list);
        }
        public function get_custom_fields( $request  ) {
            
            global $wpdb;

            // Get the search query from the request
            $search_query = sanitize_text_field($request->get_param('search'));

            // Fetch unique meta keys from the postmeta table
            $query = "SELECT DISTINCT meta_key FROM {$wpdb->postmeta} WHERE meta_key NOT LIKE '\_%'"; // Exclude private fields (_ prefix)
            
            if (!empty($search_query)) {
                $query .= $wpdb->prepare(" AND meta_key LIKE %s", '%' . $wpdb->esc_like($search_query) . '%');
            }

            $meta_keys = $wpdb->get_col($query);

            // Format response
            $custom_fields = [];

            foreach ($meta_keys as $meta_key) {
                $custom_fields[] = [
                    'id'    => $meta_key,
                    'value' => $meta_key,
                    'label' => ucfirst(str_replace('_', ' ', $meta_key)), // Make it more readable
                ];
            }

            return rest_ensure_response($custom_fields);

        }
        
        public function get_carousel_schema_data( $request_data ) {

            $response = [];

            $parameters = $request_data->get_params();

            $post_id = null;

            if ( isset( $parameters['post_id'] ) ) {
                $post_id = $parameters['post_id'];
            }

            $response = $this->_api_mapper->get_carousel_schema_data( $post_id );

            return $response;
           
        }
        public function get_schema_loop( $request_data ) {

            $parameters      = $request_data->get_params();   

            $search_param = '';
            $rvcount      = 10;
            $attr         = [];
            $paged        =  1;
            $offset       =  0;
            $post_type    = '';

            if ( isset( $parameters['post_type'] ) ) {
                // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Not processing form data
                $post_type = sanitize_text_field( wp_unslash( $parameters['post_type'] ) );
            }
            // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Not processing form data
            if ( isset( $_GET['page'] ) ) {
                // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Not processing form data
                $paged    = intval( wp_unslash( $_GET['page'] ) );
            }
            // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Not processing form data
            if ( isset($_GET['search_param'] ) ) {
                // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Not processing form data
                $search_param = sanitize_text_field( wp_unslash( $_GET['search_param'] ) );
            }            
            $result = $this->_api_mapper->get_schema_loop( $post_type, $attr, $rvcount, $paged, $offset, $search_param );
            return $result;

        }        
        
        public function update_misc_schema($request_data){

            $response        = [];

            $parameters      = $request_data->get_params();

            if($parameters){
                $result      = $this->_api_mapper->update_misc_schema($parameters);
                if($result){
                    $response = array('status' => 'success', 'message' =>  esc_html__( 'Data has been saved successfully', 'schema-package' ));                                               
                }
            }

            return $response;
        }
        public function update_settings($request_data){
            
            $response        = [];
            $parameters      = $request_data->get_params();
            $file            = $request_data->get_file_params();
            
            if(isset($file['file']) && is_array($file['file'])){
                
                $parts = explode( '.',$file['file']['name'] );                
                
                if( end($parts) != 'json' ) {
                    $response = array('status' => 'f', 'msg' =>  esc_html__( 'Please upload a valid .json file', 'schema-package' ));                   
                }
              
                $import_file = $file['file']['tmp_name'];
                if( empty( $import_file ) ) {
                    $response = array('status' => 'f', 'msg' =>  esc_html__( 'Please upload a file to import', 'schema-package' ));                                       
                }
                                                
                if($import_file){
                    $result      = $this->_api_mapper->import_from_file($import_file);    
                    $response = array('file_status' => 't','status' => 't', 'msg' =>  esc_html__( 'file uploaded successfully', 'schema-package' ));                                       
                }else{
                    $response = array('status' => 'f', 'msg' =>  esc_html__( 'File not found', 'schema-package' ));                   
                }
                                                
            }else{
                
                if($parameters){                    
                    $result      = $this->_api_mapper->update_settings($parameters);
                    if($result){
                        $response = array('status' => 't', 'msg' =>  esc_html__( 'Settings has been saved successfully', 'schema-package' ));                                               
                    }
                }
            }
            
            return $response;    
        }
        public function save_carousel_schema_data( $request_data ) {

            $parameters     = $request_data->get_params();                                               
            $post_id      = $this->_api_mapper->save_schema_data($parameters);                       
            
            if($post_id){   
                return array('status' => 't', 'post_id' => $post_id);
            }else{
                return array('status' => 'f', 'post_id' => null);
            }     
        }
        public function save_schema_data($request_data){

            $parameters     = $request_data->get_params();                                               
            $post_id      = $this->_api_mapper->save_schema_data($parameters);                       
            
            if($post_id){   
                return array('status' => 't', 'post_id' => $post_id);
            }else{
                return array('status' => 'f', 'post_id' => null);
            }     
        }
        
        public function save_post_meta($request_data){

            $parameters     = $request_data->get_params();                                               

            if( !empty($parameters['post_id']) || !empty($parameters['tag_id']) ){
                                
                $this->_api_mapper->save_post_meta($parameters);          
                return array('status' => 'success', 'message' => esc_html__( 'Saved Successfully', 'schema-package' ));

            }else{

                return array('status' => 'failed', 'message' => esc_html__( 'Post id is missing', 'schema-package' ));

            }
                         
        }
        
        public function get_repeater_element($request){

            $response   = [];
            $parameters = $request->get_params();

            if(!empty($parameters['schema_id']) && !empty($parameters['element_name'])){

                $result = smpg_get_schema_properties($parameters['schema_id']);

                if($result){
                    $data = $result['properties'][$parameters['element_name']]['elements'][0];
                    $response = array('status' => 'success', 'data' => $data);
                }else{
                    $response = array('status' => 'failed', 'data' => []);
                }

            }    

            return $response;

        }

        public function get_post_meta( $request ) {
            
            $response = [];
            
            $parameters = $request->get_params();

            if ( isset( $parameters['post_id'] ) ) {

                $post_id   = $parameters['post_id'];
                $post_meta = [];
                
                if ( get_post_meta( $post_id, '_smpg_schema_meta', true ) ) {
                    $post_meta =  get_post_meta( $post_id, '_smpg_schema_meta', true );
                }                                

                $response  =  array('status' => 'success', 'post_meta' => $post_meta);

            }else{

                $response =  array('status' => 'failed', 'message' => esc_html__( 'Post id is missing', 'schema-package' ));
            }
            
            return $response;

        }
        public function get_selected_schema_properties($request) {
            
            $response = [];
            
            $parameters = $request->get_params();                        
            
            if(!empty($parameters['init'])){
                $result    =  smpg_get_initial_post_meta($parameters['post_id'], $parameters['tag_id']);
                $response  =  array('status' => 'success', 'properties' => $result);
            }else{
                
                if( isset($parameters['selected']) && ( !empty($parameters['post_id']) || !empty($parameters['tag_id']) ) ){
                    $result    =  smpg_get_multiple_schema_properties($parameters['selected'], (int)$parameters['post_id'], (int)$parameters['tag_id']);
                    $response  =  array('status' => 'success', 'properties' => $result);
                }else{    
                    $response =  array('status' => 'failed', 'message' => esc_html__( 'Properties not found', 'schema-package' ));
                }
            }            
            
            return $response;

        }
       
}