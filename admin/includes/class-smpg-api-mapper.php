<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class SMPG_Api_Mapper {
    
    public function get_misc_schema(){
              
      $options = smpg_load_smpg_misc_schema_settings();
            
      return $options;
    }

    public function get_post_types_options() {

      $post_types = get_post_types( [ 'public' => true ], 'objects' );
    
      $post_type_list = [];
      $index = 0;

      foreach ( $post_types as $post_type ) {
          $post_type_list[] = [
              'key'   => $index++,
              'value' => $post_type->name,
              'text'  => $post_type->label
          ];
      }

      return  $post_type_list ;

    }

    public function get_taxonomies_options() {

      $taxonomies = get_taxonomies( [ 'public' => true ], 'objects' );
    
      $taxonomy_list = [];
      $index = 0;
  
      foreach ( $taxonomies as $taxonomy ) {
          $taxonomy_list[] = [
              'key'   => $index++,
              'value' => $taxonomy->name,  
              'text'  => $taxonomy->label  
          ];
      }
  
      return  $taxonomy_list;

    }

    public function get_settings(){
      
      $response                  = [];
      $response['smpg_settings'] = smpg_load_smpg_settings();
      $response['post_types']    = $this->get_post_types_options();
      $response['taxonomies']    = $this->get_taxonomies_options();

      return $response;
    }    
    public function import_from_file( $import_file ) {
      
        global $wpdb;
                
        $errorDesc       = $all_schema_post = [];         
        
        //phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Reason: loading local file
        $json_data       = @file_get_contents( $import_file );
        
        if ( $json_data ) {
            
          $json_array      = json_decode( $json_data, true );   
      
          $posts_data      = $json_array['posts'];                   
                      
          if ( $posts_data ) {
              
          foreach( $posts_data as $data ) {
                  
          $all_schema_post = $data;                   
                              
          $schema_post = [];                     
             
          if ( $all_schema_post && is_array( $all_schema_post ) ) {
          // begin transaction
          //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
          $wpdb->query( 'START TRANSACTION' );
          
          foreach ( $all_schema_post as $schema_post ) {  
                            
              $post_meta =     $schema_post['post_meta'];   

              if ( get_post_status( $schema_post['post']['ID'] ) ) {              
                  
                  $post_id    =     wp_update_post( $schema_post['post'] );  
                   
              }else{
                  
                  unset( $schema_post['post']['ID'] );
                  
                  $post_id    =     wp_insert_post( $schema_post['post'] ); 
                  
                  if ( $post_meta ) {
                      
                      foreach ( $post_meta as $key => $val ) {

                        $explod_key = explode( "_",$key );

                        $exp_count  = count( $explod_key );

                        $explod_key[( $exp_count-1 )] = $post_id;

                        $explod_key = implode( "_", $explod_key );

                        $post_meta[$explod_key] = $val;

                    }  
                      
                  }
                                      
              }
                                                                                        
              foreach ( $post_meta as $key => $meta ) {
                  
                  $meta = wp_unslash( $meta );
                  
                  if ( is_array( $meta ) ) {
                      
                      $meta = wp_unslash( $meta );
                      update_post_meta( $post_id, $key, $meta );
                      
                  }else{
                      update_post_meta( $post_id, $key, sanitize_text_field( $meta ) );
                  }
                                                          
              }
                                                                                                                  
                if ( is_wp_error( $post_id ) ) {
                    $errorDesc[] = $post_id->get_error_message();
                }
              } 
              
              }      
                                      
             }
              
          }            
          //Saving settings data starts here
          if ( array_key_exists( 'smpg_settings', $json_array ) ) {
              
              $smpg_sp_data = $json_array['smpg_settings'];
              
              foreach ( $smpg_sp_data as $key => $val ) {
                  
                  if ( is_array( $val ) ) {
                      
                      $smpg_sp_data[$key] = $meta = array_map( 'sanitize_text_field' ,$val );
                      
                  }else{
                      
                      $smpg_sp_data[$key] = sanitize_text_field( $val );
                      
                  }
                  
              }
              
              update_option( 'smpg_settings', $smpg_sp_data );
          } 
          //Saving settings data ends here   
          //Saving misc data starts here
          if ( array_key_exists( 'smpg_misc_schema', $json_array ) ) {
              
            $smpg_sp_data = $json_array['smpg_misc_schema'];
            
            foreach ( $smpg_sp_data as $key => $val ) {
                
                if ( is_array( $val ) ) {
                    
                    $smpg_sp_data[$key] = $meta = array_map( 'sanitize_text_field' ,$val );   
                    
                }else{
                    
                    $smpg_sp_data[$key] = sanitize_text_field( $val );
                    
                }
                
            }
            
            update_option('smpg_misc_schema', $smpg_sp_data); 
        }                      
          
      }
                                   
      if ( count($errorDesc) ){
        echo implode("\n<br/>", esc_html($errorDesc));
        //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
        $wpdb->query('ROLLBACK');             
      }else{
        //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
        $wpdb->query('COMMIT'); 
        return true;
      }

    }
    
    public function get_placement_data($condition, $search = '', $saved_data = '') {

      $choices      = [];  
      $array_search = false;  
  
      switch($condition){
      
        case "post_type":
          
            $post_type   = [];            
            $args['public'] = true;
              
            if(!empty($search) && $search != null){                
              $args['name'] = $search; 
            }                     
            if($saved_data){
              $args['name'] = $saved_data; 
            }
            
            $choices = get_post_types( $args, 'names');                
            unset($choices['attachment']);                    
            
            if($choices){
              $i = 0;
              foreach($choices as $key =>$value){

                $label = get_post_type_object($key);

                $post_type[] = [ 'key' => $value, 'value' => $value, 'text' => $label->label ];
                $i++;
              }
            }          
              
            $choices = $post_type;
          break;                         
  
        case "page_template" :
          $array_search = true;
          $choices[] = [ 'key' => 0, 'value' => 'default', 'text' => 'Default Template' ];
  
          $templates = get_page_templates();
          
          if ( $saved_data ) {
              $new_arr = [];
              foreach ($templates as $key => $value) {
                  if($value == $saved_data){
                    $new_arr[$key] = $value;
                  }
              }
              $templates = $new_arr;            
          }
  
          if($templates){
              $i = 0;
              foreach($templates as $k => $v){
                               
                   $choices[] = [ 'key' => $i, 'value' => $v, 'text' => $k ];

                   $i++;
              }
              
          }
          
          break;
  
        case "post" :
        case "page" :
          
          if($condition == 'page'){
  
            $post_types['page'] = 'page';
  
          }else{
  
            $post_types = get_post_types();                        
            unset( $post_types['page'], $post_types['attachment'], $post_types['revision'] , $post_types['nav_menu_item'], $post_types['acf'] );
  
          }
  
          if( $post_types )
          {
            foreach( $post_types as $post_type ){
            
              $arg['post_type']      = $post_type;
              $arg['posts_per_page'] = 10;  
              $arg['post_status']    = 'any'; 
  
              if(!empty($search)){
                $arg['s']              = $search;
              }
  
              if($saved_data){
                  $arg['p'] = $saved_data;  
              }
                  
              $posts = smpg_get_posts_by_arg($arg);             
              
              if(isset($posts['posts_data'])){
                $i = 0;              
                foreach($posts['posts_data'] as $post){                                                          
                  
                  $choices[] = [ 'key' => $post['post']['post_id'], 'value' => $post['post']['post_id'], 'text' => $post['post']['post_title'] ];

                  $i++;
                }
                
              }
              
            }
            
          }
          
          break;
  
        case "post_category" :
  
          $terms = [];
          $args = [ 
                      'taxonomy'   => 'category',
                      'hide_empty' => false,
                      'number'     => 10, 
          ];
  
          if(!empty($search)){
            $args['name__like'] = $search;
          }      
          if($saved_data){             
              $new_obj  = get_term($saved_data);
              $terms[0] = $new_obj;            
          }else{
              $terms = get_terms($args);
          }   
          
          if( !empty($terms) ) {
            $i = 0;
            foreach( $terms as $term ) {
  
              $choices[] = [ 'key' => $i, 'value' => $term->term_id, 'text' => $term->name ];

              $i++;
            }
  
          }
  
          break;
  
        case "user_type" :
  
          global $wp_roles;
  
            $array_search = true;                 
            $general_arr = [];  
            $choices = $wp_roles->get_names();            
  
            if( is_multisite() ){
            
              $choices['super_admin'] = esc_html__( 'Super Admin', 'schema-package' );
              
            }
  
            if($saved_data){
              $new_arr = [];
              foreach ($choices as $key => $value) {
                  if($key == $saved_data){
                    $new_arr[$key] = $value;
                  }
              }
               $choices = $new_arr;            
            }
            
            if($choices){
              $i = 0;
              foreach($choices as $key =>$value){
                $general_arr[] = [ 'key' => $i, 'value' => $key, 'text' => $value ];
                $i++;
              }
            }        
            $choices = $general_arr; 
  
        break;
        case "post_format" :
            $array_search = true;                 
            $general_arr = [];
            $choices = get_post_format_strings();
  
            if($saved_data){
              $new_arr = [];
              foreach ($choices as $key => $value) {
                  if($key == $saved_data){
                    $new_arr[$key] = $value;
                  }
              }
            $choices = $new_arr;            
           }
  
            if($choices){
              $i=0;
              foreach($choices as $key =>$value){
                $general_arr[] = [ 'key' => $i, 'value' => $key, 'text' => $value ];
                $i++;
              }
            }        
            $choices = $general_arr; 
  
        break;
  
        case "ef_taxonomy" :
          
          $args['public'] = true;
  
          if(!empty($search) && $search != null){
              $args['name'] = $search; 
          }  
          if($saved_data){
              $args['name'] = $saved_data; 
          }      
  
          $taxonomies = get_taxonomies( $args, 'objects');
          
          if($taxonomies){
              
              if($taxonomies){
                  $i = 0;
                  foreach($taxonomies as $taxonomy) {
                    $choices[] = [ 'key' => $i, 'value' => $taxonomy->name, 'text' => $taxonomy->labels->name ];
                    $i++;
                  }
                    
                }
  
          }
                                       
          break;      
              
          case "all":
  
              $args = [
                  'hide_empty' => false,
                  'number'     => 10, 
              ];
  
              if ( ! empty( $search ) ) {
                  $args['name__like'] = $search;
              }
  
              $taxonomies =  get_terms( $args );               
              
              if ( $taxonomies ) {
                  $i = 0;
                  foreach($taxonomies as $tax){
                      $choices[] = [ 'key'=> $i, 'value' => $tax->slug, 'text' => $tax->name ];
                    $i++;
                  }
                  
              }                        
               
          break;
  
          default:
          
          $args = [
              'taxonomy'   => $condition,
              'hide_empty' => false,
              'number'     => 10,               
          ];
  
          if ( ! empty( $search ) ) {
              $args['name__like'] = $search;
          }
  
          if ( $saved_data ) {                          
              $args['slug'] = $saved_data;
          }   
          $taxonomies    =  get_terms( $args );  
                        
          if($taxonomies){
              $i=0;
              foreach($taxonomies as $tax){
  
                  if(is_object($tax)){
                      $choices[] = [ 'key' => $i, 'value' => $tax->slug, 'text' => $tax->name ];
                  }
                  $i++;
                  
              }
              
          }
  
      }        
  
      if(!empty($search) && $search != null){
          
          if($array_search){
  
              $search_data = [];
  
              foreach($choices as $val){
                if((strpos($val['value'], $search) !== false) || (strpos($val['text'], $search) !== false)){
                  $search_data[] = $val; 
                }
              }
  
              $choices = $search_data;           
  
          }
          
          return $choices;
      }else{
          return $choices;
      }    

    }
    public function get_carousel_schema_data( $post_id = null ) {

        $response         = [];
        $meta_data        = [];        
        $taxonomies_list  = [];               
        $saved_taxonomies = [];
        $saved_schema     = 'course';
        $response['post_data']      = get_post( $post_id, ARRAY_A );
        $post_meta                  = get_metadata( 'post', $post_id );   

        if ( isset( $post_meta['_schema_type'][0] ) ) {
          $saved_schema = $post_meta['_schema_type'][0];
        }        

        if ( isset( $post_meta['_taxonomies'][0] ) && is_serialized( $post_meta['_taxonomies'][0] ) ) {
          $saved_taxonomies = unserialize($post_meta['_taxonomies'][0]);
        }        
        //Taxonomies data starts here     
        
        $taxonomies = get_taxonomies( [], 'objects' );
        unset($taxonomies['product_type'], $taxonomies['nav_menu'], $taxonomies['link_category'], $taxonomies['post_format'], $taxonomies['wp_theme'], $taxonomies['wp_template_part_area'], $taxonomies['wp_pattern_category'], $taxonomies['product_visibility'], $taxonomies['product_shipping_class'] );

        if ( $taxonomies ) {

          $j = 0;

          foreach ( $taxonomies as $taxonomy ) {
            
            // Get terms for each taxonomy (limit to 10 terms)
            $terms = get_terms([
                'taxonomy'   => $taxonomy->name,
                'number'     => 10,
                'hide_empty' => false, // Include empty terms if needed
            ]);

            if ( ! is_wp_error( $terms ) ) {

                $options = [];
                foreach ($terms as $i => $term) {
                    $options[] = [
                        'key'   => $i,
                        'value' => $term->term_id,
                        'text'  => $term->name,
                    ];
                }
              
                $tax_status = false;
                $tax_value  = [];

                if ( isset( $saved_taxonomies[$j]['status'] ) ) {
                  $tax_status  = $saved_taxonomies[$j]['status'];
                }

                if ( isset( $saved_taxonomies[$j]['value'] ) ) {
                  $tax_value  = $saved_taxonomies[$j]['value'];
                }

                $taxonomies_list[] = [
                    'taxonomy'  => $taxonomy->name,
                    'label'     => $taxonomy->label,
                    'status'    => $tax_status,
                    'value'     => $tax_value,                    
                    'options'   => $options,
                ];

            }
              $j++;
          }

        }
        //Taxonomies data ends here
        $meta_data['_taxonomies']    = $taxonomies_list;
        $meta_data['_schema_type']   = $saved_schema;

        $response['post_meta']      = $meta_data;                                               
                        
        return $response;

    }
    public function get_schema_data( $post_id = null ) {

        $response  = $meta_data = $enabled_on = $enabled_on = $disabled_on = [];

        $post_type_plc = $this->get_placement_data('post_type');
        $post_plc      = $this->get_placement_data('post');        
        $page_plc      = $this->get_placement_data('page');

        $enabled_on['post_type'] = $post_type_plc;
        $enabled_on['post']      = $post_plc;
        $enabled_on['page']      = $page_plc;

        $disabled_on['post_type'] = $post_type_plc;
        $disabled_on['post']      = $post_plc;
        $disabled_on['page']      = $page_plc;
        
        if($post_id){

            $response['post_data']      = get_post($post_id, ARRAY_A);  
            $post_meta                  = get_post_meta($post_id);              
            
            if($post_meta){

                foreach($post_meta as $key => $meta){

                    if(is_serialized($meta[0])){
                      
                      $meta_data[$key] = unserialize($meta[0]);
                      
                      if( $key == '_enabled_on' || $key == '_disabled_on' ){
                        
                        foreach($meta_data[$key] as $ikey => $ival){
                            
                            foreach($ival as $jval){
                              
                              $saved_data = $this->get_placement_data($ikey, '', $jval);
                              
                              if ( $saved_data ) {

                                if( $key == '_enabled_on' ){
                                  
                                  $enabled_on[$ikey]      = array_values(array_unique(array_merge($enabled_on[$ikey], $saved_data), SORT_REGULAR));
                                }

                                if( $key == '_disabled_on' ){                                 
                                  $disabled_on[$ikey]      = array_values(array_unique(array_merge($enabled_on[$ikey], $saved_data), SORT_REGULAR));
                                }
                                
                              }
                              
                            }
                        }

                      }                      

                    }else{
                      $meta_data[$key] = $meta[0];
                    }
                    
                }
            }

            $response['post_meta'] = $meta_data;
            
        }else{
          $meta_data['_mapped_properties']          = [];
          $meta_data['_enabled_on_post_type']       = 1;
          $meta_data['_enabled_on']['post_type'][0] = 'post';
        }   
        
        $response['post_meta'] = $meta_data;
        $response['_placement_enabled_option']  = $enabled_on;
        $response['_placement_disabled_option'] = $disabled_on;
                        
        return $response;

    }
    public function get_terms_by_search( $taxonomy_type, $search_param ) {

      $options = [];

      $terms = get_terms( [
        'taxonomy'   => $taxonomy_type,
        'name__like' => $search_param,        
        'hide_empty' => false, // Include empty terms if needed
      ] );

      if ( ! is_wp_error( $terms ) ) {
          
          foreach ($terms as $i => $term) {
              $options[] = [
                  'key'   => $i,
                  'value' => $term->term_id,
                  'text'  => $term->name,
              ];
          }                  
      }

      return $options;

    }
    
    public function get_schema_loop($post_type, $attr = null, $rvcount = null, $paged = null, $offset = null, $search_param=null){
            
        $response   = [];                                
        $arg        = [];
        $meta_query = [];
        $posts_data = [];
        
        $arg['post_type']      = $post_type;
        $arg['posts_per_page'] = -1;  
        $arg['post_status']    = 'any';    
            
        
        if(isset($attr['in'])){
          $arg['post__in']    = $attr['in'];  
        }                    
        if(isset($attr['id'])){
          $arg['attachment_id']    = $attr['id'];  
        }
        if(isset($attr['title'])){
          $arg['title']    = $attr['title'];  
        }          
        
        if($rvcount){
            $arg['posts_per_page']    = $rvcount;
        }
        if($paged){
            $arg['paged']    = $paged;
        }
        if($offset){
            $arg['offset']    = $offset;
        }       
                        
        $response = $this->getPostsByArg($arg);
        
        return $response;
    }

    

    public function getPostsByArg($arg){
      
      $response = [];

      $meta_query = new WP_Query($arg);        
              
        if($meta_query->have_posts()) {
             
            $data = [];  
            $post_meta = [];        
            while($meta_query->have_posts()) {

                $meta_query->the_post();
                $data['post_id']       =  get_the_ID();
                $data['post_title']    =  get_the_title();
                $data['post_status']   =  get_post_status();
                $data['post_modified'] =  get_the_date('d M, Y');
                $post_meta             =  get_metadata('post', get_the_ID());
                

                if($post_meta){

                    foreach($post_meta as $key => $val ){
                        $post_meta[$key] = $val[0];
                    }

                }
                           
                $posts_data[] = [
                  'post'        => (array) $data,
                  'post_meta'   => $post_meta                
                ]; 

            }
            wp_reset_postdata(); 
            $response['posts_data']  = $posts_data;
            $response['posts_found'] = $meta_query->found_posts;
        }

        return $response;

    }

    public function update_misc_schema( $parameters ) {

      if ( ! empty( $parameters['misc_schema'] ) ) {
       
        $settings = json_decode( wp_unslash( $parameters['misc_schema'] ), true );
                                              
        if ( json_last_error() === JSON_ERROR_NONE ) {
          return update_option( 'smpg_misc_schema', smpg_sanitize_schema_meta( $settings ) );          
        }

      }  

    }

    public function update_settings( $parameters ){

      if ( ! empty( $parameters['settings'] ) ) {
       
        $settings = json_decode( wp_unslash( $parameters['settings'] ), true );
                                              
        if ( json_last_error() === JSON_ERROR_NONE ) {
          return update_option( 'smpg_settings', smpg_sanitize_schema_meta( $settings ) );          
        }

      } 

    }
    
    public function save_schema_data( $parameters ) {
                                                    
            if ( ! empty( $parameters['post_data'] ) ) {

              $id =  $parameters['post_data']['ID'];
              unset( $parameters['post_data']['ID'] );
              $post_data = smpg_sanitize_schema_meta( $parameters['post_data'] );
              $post_data['ID'] = intval( $id );              
              $post_id   = wp_insert_post( $post_data );                        
              
              if ( ! empty( $parameters['post_meta'] ) ) {
                 
                foreach ( $parameters['post_meta'] as $key => $val ) {
                
                     $sanitized_data = smpg_sanitize_schema_meta( $val );             
                     update_post_meta( $post_id, sanitize_key( $key ), $sanitized_data );

                }                               
                
              }
            
              return  $post_id;
        }                                                
    }

    public function save_post_meta( $parameters ) {
                              
      if ( ! empty( $parameters['post_id'] ) ) {
        
        $post_meta = smpg_sanitize_schema_meta( $parameters['post_meta'] );
        update_post_meta( $parameters['post_id'], '_smpg_schema_meta', $post_meta );

        return  $parameters['post_id'];

      }

      if ( ! empty($parameters['tag_id'] ) ) {

        $post_meta = smpg_sanitize_schema_meta( $parameters['post_meta'] );
        update_term_meta( $parameters['tag_id'], '_smpg_schema_meta', $post_meta );

        return  $parameters['tag_id'];
      }

      if ( ! empty($parameters['user_id'] ) ) {

        $post_meta = smpg_sanitize_schema_meta( $parameters['post_meta'] );
        update_user_meta( $parameters['user_id'], '_smpg_schema_meta', $post_meta );

        return  $parameters['user_id'];
      }
                   
    }
            
    public function changePostStatus( $ad_id, $action ) {

      return wp_update_post( [ 'ID' =>  intval( $ad_id ), 'post_status' => boolval( $action ) ] );
      
    }
    public function get_carousel_automation_with( $schema_type ) {

    }                    
    public function get_automation_with( $schema_type ) {

      global $smpg_plugin_list;
      
      $response = $automate_supports = [];

      switch ( $schema_type ) {
        
        case 'product':
        case 'softwareapplication':

          $automate_supports = [ 'woocommerce', 'yotposreviews', 'ryviu', 'pbfwoocommerce', 'yithbrandwoocommerce', 'brandforwoocommerce', 'absolutereviews' ];                    
                 
          break;
        
        case 'book':      

          $automate_supports = [ 'mooberrybookmanager', 'absolutereviews' ];          

          break;

        case 'review':      

          $automate_supports = [ 'absolutereviews' ];          

          break;
        case 'faqpage':

          $automate_supports = [ 'accordion', 'accordionfaq', 'quickandeasyfaq', 'easyaccordion', 'wpresponsivefaq', 'arconixfaq', 'masterstudy' ];          
                                  
          break;
        
        case 'jobposting':

          $automate_supports = [ 'simplejobboard' ];          

          break;
        case 'localbusiness':

          break;

        case 'course':

          $automate_supports = [ 'masterstudy' ];          

        break;
        
        default:
        
          break;
      }
      
      if ( ! empty( $automate_supports ) ) {
          
        foreach ( $automate_supports as $value ) {
            
          if ( $smpg_plugin_list[$value]['is_active'] ) {
            $response[] = [ 'key' => $value, 'text' => $smpg_plugin_list[$value]['name'] ];
          }
  
        }
        
      }
      
      return $response;

    }

}