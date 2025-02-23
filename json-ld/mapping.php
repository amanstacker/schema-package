<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_mapping_properties( $json_ld, $schema_data ) {

    $mp_values = [];

    if ( ! empty ( $schema_data['_mapped_properties_value'][0] ) ){
        $mp_values = unserialize( $schema_data['_mapped_properties_value'][0] );
    }
    
    if ( ! empty( $mp_values ) ) {

        foreach ( $mp_values as $key => $value ) {

            $key = smpg_snake_to_camel_case( $key );
            
            switch ( $value['meta_field'] ) {
                
                case 'blogname':
                    $json_ld[$key]   = get_bloginfo();                    
                    break;
                case 'blogdescription':
                    $json_ld[$key]   = get_bloginfo('description');                    
                    break;
                case 'site_url':
                    $json_ld[$key]   = get_site_url();                    
                    break;
                case 'post_title':
                    $json_ld[$key]   = get_the_title();                                        
                    break;                
                case 'post_category':
                    $categories = get_the_category();
                    if ( $categories ) {
                        foreach ( $categories as $category){
                            if ( isset( $category->name) ) {
                                $json_ld[$key][] = $category->name;  
                            }
                        }
                        
                    }                                           
                    break;
                case 'post_excerpt':
                    $json_ld[$key] = get_the_excerpt(); 
                    break;
                case 'post_permalink':
                    $json_ld[$key] = get_permalink();
                    break;
                case 'author_name':
                    $json_ld[$key] =  get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
                    break;
                case 'author_first_name':
                    $json_ld[$key] = get_the_author_meta('first_name'); 
                    break;
                case 'author_last_name':
                    $json_ld[$key] = get_the_author_meta('last_name');
                    break;
                case 'post_date':
                    $json_ld[$key] = get_the_date("c");
                    break;
                case 'post_modified':
                    $json_ld[$key] = get_the_modified_date("c");
                    break;
                case 'post_content':
                    $json_ld[$key] = get_the_content();
                    break;
                case 'custom_text':
                    $json_ld[$key] = $value['custom_text'];
                    break;
                case 'custom_image':                
                    $json_ld[$key] = $value['custom_image'];
                    break;
                case 'featured_img':
                    $json_ld[$key] = smpg_get_post_image_by_id( get_post_thumbnail_id() );                    
                    break;
                case 'author_image':
                    $json_ld[$key] = smpg_get_author_image_by_id();                    
                    break;
                case 'taxonomy_term':
                    //todo
                    break;
                case 'acf_custom_field':                    
                    //todo
                    break;
                case 'tp_custom_field':                    
                    //todo
                    break;
                case 'no_value':          
                    unset( $json_ld[$key] );
                    break;
                case 'custom_field':                    
                    $json_ld[$key] = get_post_meta( get_the_ID(), $value['custom_field'], true );
                    break;                
                case 'site_logo':
                    $logo_id = get_theme_mod( 'custom_logo' );     

                    if ( $logo_id ) {
                        $custom_logo    = wp_get_attachment_image_src( $logo_id, [600, 60] );

                        if ( ! empty( $custom_logo[0] ) ) {
                            $json_ld[$key] = $custom_logo[0];
                        }
                    }                                        
                    break;
                
                default:
                    # code...
                    break;
            }
        }

    }

    return $json_ld;

}