<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_mapping_properties( $json_ld, $schema_data ) {
    
    $mp_values    = $properties = $mp_keys = [];
    
    if ( ! empty ( $schema_data['_mapped_properties_value'][0] ) ){

        $mp_values = unserialize( $schema_data['_mapped_properties_value'][0] );                
        $mp_keys   = unserialize( $schema_data['_mapped_properties_key'][0] );                        
        $properties = smpg_get_schema_properties( $schema_data['_schema_type'][0] );        
                
    }
    
    if ( ! empty( $mp_values ) ) {

        foreach ( $mp_values as $key => $value ) {

            if ( in_array( $key, $mp_keys ) ) {
                
                $parent_data  = [];
                $mapped_value = null;

                if ( empty( $properties['properties'][$key]['parent_data'] ) ) {
                    $key = smpg_snake_to_camel_case( $key );
                }else{
                    $parent_data = $properties['properties'][$key]['parent_data'];
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
                        $mapped_value = wp_strip_all_tags( get_the_content() );
                        break;
                    case 'custom_text':                                        
                        $mapped_value = smpg_replace_variables_and_placeholders( $value['custom_text'] );
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

                        if ( ! empty( $parent_data ) ) {                            
                            unset( $json_ld[$parent_data['key']][$parent_data['child_key']] );   
                        }else{
                            unset( $json_ld[$key] );
                        }                        
                        
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

                    if ( ! empty( $parent_data ) ) {
                        
                            smpg_map_nested_schema_property( $json_ld, $properties, $key, $mapped_value );
                            
                    }else{
                        
                        switch ( $key ) {

                            case 'prepTime':
                            case 'cookTime':
                            case 'totalTime':
                                $json_ld[ $key ] = smpg_convert_number_to_iso_time( $mapped_value );
                                break;

                            case 'recipeInstructions':
                                $json_ld[ $key ] = smpg_convert_instructions_to_howto_format( $mapped_value );
                                break;

                            case 'id':
                                $json_ld['@id'] = $mapped_value;
                                break;

                            default:
                                $json_ld[ $key ] = $mapped_value;
                                break;
                        }


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

/**
 * Replace placeholder values in a schema properties array.
 *
 * @param array $properties Schema properties array (like the one you provided).
 * @return array Updated properties array with replaced values.
 */
function smpg_replace_properties_placeholders( $properties ) {
    
    global $smpg_settings; 
    
    if ( empty( $smpg_settings['dynamic_placeholders'] ) ) {
        return $properties;
    }

    if ( ! is_array( $properties ) ) {
        return $properties;
    }

    foreach ( $properties as $key => $property ) {
        // Only replace if 'value' exists
        if ( isset( $property['value'] ) && $property['value'] !== '' && !is_array( $property['value'] ) ) {
            $properties[ $key ]['value'] = smpg_replace_variables_and_placeholders( $property['value'] );
        }

        // Recursively handle nested arrays, e.g., media arrays or complex structures
        if ( is_array( $property ) ) {
            foreach ( $property as $sub_key => $sub_value ) {
                if ( is_array( $sub_value ) ) {
                    $properties[ $key ][ $sub_key ] = smpg_replace_properties_placeholders( $sub_value );
                }
            }
        }        
        
    }

    return $properties;
}


/**
 * Replace Schema placeholders with dynamic values (multi-author supported).
 *
 * @param string $schema JSON-LD schema string with placeholders.
 * @param int|null $post_id Post ID (optional, defaults to current post).
 * @return string Schema with replaced values.
 */
function smpg_replace_variables_and_placeholders( $schema, $post_id = null ) {

	global $post, $smpg_settings;

    if ( empty( $smpg_settings['dynamic_placeholders'] ) ) {
        return $schema;
    }

	if ( ! $post_id && $post ) {
		$post_id = $post->ID;
	}

	if ( ! $post_id ) {
		return $schema;
	}

	// Basic post data.
	$post_obj         = get_post( $post_id );
	$post_title       = get_the_title( $post_id );
	$post_excerpt     = has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : '';
	$post_content     = wp_strip_all_tags( $post_obj->post_content );
	$post_url         = get_permalink( $post_id );
	$post_type        = get_post_type( $post_id );
	$date_published   = get_the_date( 'c', $post_id );
	$date_modified    = get_the_modified_date( 'c', $post_id );
	$featured_image   = get_the_post_thumbnail_url( $post_id, 'full' );

	// Handle authors (default single + multi-author if plugin exists).
	$authors = [];

	// Co-Authors Plus support.
	if ( function_exists( 'get_coauthors' ) ) {
		$coauthors = get_coauthors( $post_id );
		foreach ( $coauthors as $author ) {
			$authors[] = [
				'name'   => $author->display_name,
				'first'  => $author->first_name,
				'last'   => $author->last_name,
				'url'    => get_author_posts_url( $author->ID ),
				'bio'    => $author->description,
				'avatar' => get_avatar_url( $author->ID ),
			];
		}
	} else {
		// Default WP single author.
		$author_id = $post_obj->post_author;
		$authors[] = [
			'name'   => get_the_author_meta( 'display_name', $author_id ),
			'first'  => get_the_author_meta( 'first_name', $author_id ),
			'last'   => get_the_author_meta( 'last_name', $author_id ),
			'url'    => get_author_posts_url( $author_id ),
			'bio'    => get_the_author_meta( 'description', $author_id ),
			'avatar' => get_avatar_url( $author_id ),
		];
	}

	// Site data.
	$site_name        = get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description' );
	$site_url         = home_url();
	$site_email       = get_bloginfo( 'admin_email' );

	// Try site logo from WP core.
	$custom_logo_id   = get_theme_mod( 'custom_logo' );
	$site_logo        = $custom_logo_id ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';

	// Categories and tags.
	$categories       = implode( ', ', wp_get_post_terms( $post_id, 'category', [ 'fields' => 'names' ] ) );
	$tags             = implode( ', ', wp_get_post_terms( $post_id, 'post_tag', [ 'fields' => 'names' ] ) );

	// Additional images (gallery/attachments).
	$attachments      = get_attached_media( 'image', $post_id );
	$images           = [];
	if ( $attachments ) {
		foreach ( $attachments as $attachment ) {
			$images[] = wp_get_attachment_url( $attachment->ID );
		}
	}
	$image_1 = isset( $images[0] ) ? $images[0] : '';
	$image_2 = isset( $images[1] ) ? $images[1] : '';
	$image_3 = isset( $images[2] ) ? $images[2] : '';

	// Core placeholder replacements.
	$replacements = [
		'%%post_title%%'        => $post_title,
		'%%post_excerpt%%'      => $post_excerpt,
		'%%post_content%%'      => $post_content,
		'%%post_url%%'          => $post_url,
		'%%post_id%%'           => $post_id,
		'%%post_type%%'         => $post_type,
		'%%date_published%%'    => $date_published,
		'%%date_modified%%'     => $date_modified,
		'%%featured_image%%'    => $featured_image,
		'%%image_1%%'           => $image_1,
		'%%image_2%%'           => $image_2,
		'%%image_3%%'           => $image_3,
		'%%categories%%'        => $categories,
		'%%tags%%'              => $tags,
		// Default (first) author placeholders.
		'%%author_name%%'       => isset( $authors[0]['name'] ) ? $authors[0]['name'] : '',
		'%%author_first_name%%' => isset( $authors[0]['first'] ) ? $authors[0]['first'] : '',
		'%%author_last_name%%'  => isset( $authors[0]['last'] ) ? $authors[0]['last'] : '',
		'%%author_url%%'        => isset( $authors[0]['url'] ) ? $authors[0]['url'] : '',
		'%%author_bio%%'        => isset( $authors[0]['bio'] ) ? $authors[0]['bio'] : '',
		'%%author_avatar%%'     => isset( $authors[0]['avatar'] ) ? $authors[0]['avatar'] : '',
		// Site placeholders.
		'%%site_name%%'         => $site_name,
		'%%site_description%%'  => $site_description,
		'%%site_url%%'          => $site_url,
		'%%site_logo%%'         => $site_logo,
		'%%site_email%%'        => $site_email,
	];

	// Add dynamic multi-author placeholders.
	if ( $authors ) {
		foreach ( $authors as $index => $author ) {
			$author_num = $index + 1;
			$replacements[ "%%author_{$author_num}_name%%" ]   = $author['name'];
			$replacements[ "%%author_{$author_num}_first%%" ]  = $author['first'];
			$replacements[ "%%author_{$author_num}_last%%" ]   = $author['last'];
			$replacements[ "%%author_{$author_num}_url%%" ]    = $author['url'];
			$replacements[ "%%author_{$author_num}_bio%%" ]    = $author['bio'];
			$replacements[ "%%author_{$author_num}_avatar%%" ] = $author['avatar'];
		}
	}

	// Replace static placeholders.
	$schema = str_replace( array_keys( $replacements ), array_values( $replacements ), $schema );

	// Handle dynamic placeholders: custom fields, taxonomies, meta, shortcodes.
	$schema = preg_replace_callback(
		'/%%custom_field_([a-zA-Z0-9_-]+)%%/',
		function( $matches ) use ( $post_id ) {
			$value = get_post_meta( $post_id, $matches[1], true );
			return $value ? esc_html( $value ) : '';
		},
		$schema
	);

	$schema = preg_replace_callback(
		'/%%taxonomy_([a-zA-Z0-9_-]+)%%/',
		function( $matches ) use ( $post_id ) {
			$terms = wp_get_post_terms( $post_id, $matches[1], [ 'fields' => 'names' ] );
			return $terms ? implode( ', ', $terms ) : '';
		},
		$schema
	);

	$schema = preg_replace_callback(
		'/%%meta_([a-zA-Z0-9_-]+)%%/',
		function( $matches ) use ( $post_id ) {
			$value = get_post_meta( $post_id, $matches[1], true );
			return $value ? esc_html( $value ) : '';
		},
		$schema
	);

	$schema = preg_replace_callback(
		'/%%shortcode_\[([^\]]+)\]%%/',
		function( $matches ) {
			return do_shortcode( '[' . $matches[1] . ']' );
		},
		$schema
	);

	return $schema;
}