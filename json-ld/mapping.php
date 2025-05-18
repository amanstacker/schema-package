<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_mapping_properties( $json_ld, $schema_data ) {
    
    $mp_values    = $properties = $mp_keys = [];
    $mapped_value = null;

    if ( ! empty ( $schema_data['_mapped_properties_value'][0] ) ){

        $mp_values = unserialize( $schema_data['_mapped_properties_value'][0] );                
        $mp_keys   = unserialize( $schema_data['_mapped_properties_key'][0] );                        
        $properties = smpg_get_schema_properties( $schema_data['_schema_type'][0] );        
                
    }
    
    if ( ! empty( $mp_values ) ) {

        foreach ( $mp_values as $key => $value ) {

            if ( in_array( $key, $mp_keys ) ) {
            
                if ( empty( $properties['properties'][$key]['parent_data'] ) ) {
                    $key = smpg_snake_to_camel_case( $key );
                }            
                
                switch ( $value['meta_field'] ) {
                    
                    case 'blogname':
                        $mapped_value   = get_bloginfo();                    
                        break;
                    case 'blogdescription':
                        $mapped_value   = get_bloginfo('description');                    
                        break;
                    case 'site_url':
                        $mapped_value   = get_site_url();                    
                        break;
                    case 'post_title':
                        $mapped_value   = get_the_title();                                        
                        break;                
                    case 'post_category':
                        
                        $categories = get_the_category();

                        if ( $categories ) {

                            $cat_val = [];

                            foreach ( $categories as $category ) {
                                if ( isset( $category->name) ) {
                                    $cat_val[] = $category->name;  
                                }
                            }
                            $mapped_value = $cat_val;
                        }                                           
                        break;
                    case 'post_excerpt':
                        $mapped_value = get_the_excerpt(); 
                        break;
                    case 'post_permalink':
                        $mapped_value = get_permalink();
                        break;
                    case 'author_name':
                        $mapped_value =  get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
                        break;
                    case 'author_first_name':
                        $mapped_value = get_the_author_meta('first_name'); 
                        break;
                    case 'author_last_name':
                        $mapped_value = get_the_author_meta('last_name');
                        break;
                    case 'post_date':
                        $mapped_value = get_the_date("c");
                        break;
                    case 'post_modified':
                        $mapped_value = get_the_modified_date("c");
                        break;
                    case 'post_content':
                        $mapped_value = get_the_content();
                        break;
                    case 'custom_text':                                        
                        $mapped_value = $value['custom_text'];                    
                        break;
                    case 'custom_image':                
                        $mapped_value = $value['custom_image'];
                        break;
                    case 'featured_img':
                        $mapped_value = smpg_get_post_image_by_id( get_post_thumbnail_id() );                    
                        break;
                    case 'author_image':
                        $mapped_value = smpg_get_author_image_by_id();                    
                        break;
                    case 'taxonomy_term':
                        //todo
                        break;                
                    case 'tp_custom_field':                    
                        //todo
                        break;
                    case 'no_value':          
                        unset( $json_ld[$key] );
                        break;
                    case 'custom_field':                    
                        $mapped_value = get_post_meta( get_the_ID(), $value['custom_field'], true );
                        break;                
                    case 'advanced_custom_field':
                        $mapped_value = smpg_advanced_custom_fields_mapping( $value['advanced_custom_field'] );
                        $mapped_value = apply_filters( 'smpg_filter_advanced_custom_field_mapping', $json_ld[$key],  $value['advanced_custom_field'] );                    
                        break;                
                    case 'site_logo':

                        $logo_id = get_theme_mod( 'custom_logo' );     

                        if ( $logo_id ) {

                            $custom_logo    = wp_get_attachment_image_src( $logo_id, [600, 60] );

                            if ( ! empty( $custom_logo[0] ) ) {
                                $mapped_value = $custom_logo[0];
                            }
                        }                                        
                        break;
                    
                    default:
                        # code...
                        break;
                }

                if ( $mapped_value !== null ) {

                    if ( ! empty( $properties['properties'][$key]['parent_data'] ) ) {

                            smpg_map_nested_schema_property( $json_ld, $properties, $key, $mapped_value );
                            
                    }else{

                        $json_ld[$key] = $mapped_value;

                    }
                    
                }            
            }
        
        }

    }
    
    return $json_ld;

}

function smpg_advanced_custom_fields_mapping( $field_key ) {
    
    if ( function_exists( 'get_field_object') ) {

        $acf_obj = get_field_object( $field_key );
        
        switch ( $acf_obj['type'] ) {

            case 'image':
                $image_id = get_post_meta( get_the_ID(), $field_key, true );                                
                return smpg_get_post_image_by_id( $image_id );
                break;
            case 'repeater':
                # code...
                break;               
            default:
                return get_post_meta( get_the_ID(), $field_key, true );
                break;
        }
        
    }

}

/**
 * Adds a nested schema property to the JSON-LD array using dot notation for key and type.
 *
 * @param array $properties    
 * @param array &$json_ld      Reference to the JSON-LD array being constructed. 
 * @param mixed  $child_value  Value to assign to the child key (e.g., "12.34").
 */
function smpg_map_nested_schema_property( &$json_ld, $properties, $key, $child_value ) {

    $parent_key  = $properties['properties'][$key]['parent_data']['key'];
    $parent_type = $properties['properties'][$key]['parent_data']['type'];
    $child_key   = $properties['properties'][$key]['parent_data']['child_key'];

    $key_parts  = explode('.', $parent_key);
    $type_parts = explode('.', $parent_type);

    $ref =& $json_ld;

    foreach ( $key_parts as $i => $part ) {
        if ( ! isset( $ref[$part] ) || ! is_array( $ref[$part] ) ) {
            $ref[$part] = [];
        }

        // Set @type if not already set and type is available
        if ( isset( $type_parts[$i] ) && ! isset( $ref[$part]['@type'] ) ) {
            $ref[$part]['@type'] = $type_parts[$i];
        }

        $ref =& $ref[$part];
    }

    $ref[$child_key] = $child_value;
}