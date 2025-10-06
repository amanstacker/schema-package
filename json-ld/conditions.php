<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_placement_condition_checker( $type, $post_id, $value ) {

	$response = false;

	switch ( $type ) {

		case 'post_type':
				if ( get_post_type( $post_id ) == $value ) {
					$response = true;
				}

			break;

		case 'post':
		case 'page':

				if ( $post_id == $value ) {
					$response = true;
				}

			break;						
		
		default:
			
			break;

	}

	return $response;

}

function smpg_placement_added_on( $schema_data, $post_id ){

	$response = false;
	
	if(isset($schema_data['_enabled_on'][0])){

		$stack_contition = [];

		$condition = unserialize($schema_data['_enabled_on'][0]);

		$post_types = empty( $condition['post_type'] ) ? [] : $condition['post_type'];
		$posts      = empty( $condition['post'] ) ? [] : $condition['post'];
		$pages      = empty( $condition['page'] ) ? [] : $condition['page'];

		$post_type_status = $schema_data['_enabled_on_post_type'][0];
		$post_status      = $schema_data['_enabled_on_post'][0];
		$page_status      = $schema_data['_enabled_on_page'][0];	

		
		if($post_type_status && !empty($post_types)){

			foreach ($post_types as $value) {
				$stack_contition[] = smpg_placement_condition_checker('post_type', $post_id, $value);
			}

		}

		if($post_status && !empty($posts)){

			foreach ($posts as $value) {
				$stack_contition[] = smpg_placement_condition_checker('post', $post_id, $value);
			}

		}

		if( $page_status && !empty($pages) ){

			foreach ($pages as $value) {
				$stack_contition[] = smpg_placement_condition_checker('page', $post_id, $value);
			}

		}
			
		$stack_contition = array_filter($stack_contition);
		$stack_contition = array_unique($stack_contition);

		if(!empty($stack_contition)){
			$response = true;
		}

	}				

	return $response;
	
}

function smpg_placement_remove_from( $schema_data, $post_id ){

	$response = false;

	if( isset($schema_data['_disabled_on'][0]) ){

		$stack_contition = [];

		$condition = unserialize($schema_data['_disabled_on'][0]);
			
		$post_type_status = $schema_data['_disabled_on_post_type'][0];
		$post_status      = $schema_data['_disabled_on_post'][0];
		$page_status      = $schema_data['_disabled_on_page'][0];

		$post_types = empty( $condition['post_type'] ) ? [] : $condition['post_type'];
		$posts      = empty( $condition['post'] ) ? [] : $condition['post'];
		$pages      = empty( $condition['page'] ) ? [] : $condition['page'];

		
		if($post_type_status && !empty($post_types)){

			foreach ($post_types as $value) {
				$stack_contition[] = smpg_placement_condition_checker('post_type', $post_id, $value);
			}

		}

		if($post_status && !empty($posts)){

			foreach ($posts as $value) {
				$stack_contition[] = smpg_placement_condition_checker('post', $post_id, $value);
			}

		}

		if( $page_status && !empty($pages) ){

			foreach ($pages as $value) {
				$stack_contition[] = smpg_placement_condition_checker('page', $post_id, $value);
			}

		}
			
		$stack_contition = array_filter($stack_contition);
		$stack_contition = array_unique($stack_contition);

		if(!empty($stack_contition)){
			$response = true;
		}

	}	

	return $response;

}

function smpg_is_singular_placement_matched( $schema_data, $post_id ){

	$response = false;

	$add_on      = smpg_placement_added_on($schema_data, $post_id);	
	$remove_from = smpg_placement_remove_from($schema_data, $post_id);	

	if($add_on && !$remove_from){
		$response = true;
	}

	return $response;
    
}

function smpg_is_carousel_placement_matched( $schema_data, $page_type = null, $spg_id = null ){

		$response = false;		

		$unser_schema_data = [];

		if ( isset( $schema_data['taxonomies'][0] ) ) {
			$unser_schema_data = unserialize($schema_data['taxonomies'][0]);
		}		
		
		foreach ( $unser_schema_data as $tax_data ) {

			if ( ( $page_type === 'category' || is_category() ) && $tax_data['taxonomy'] == 'category' && $tax_data['status'] ) {

				smpg_is_carousel_placement_logic_check( $tax_data, $spg_id );		
				

			} else if ( ( $page_type === 'tag' || is_tag() ) && $tax_data['taxonomy'] == 'post_tag' && $tax_data['status'] ) {
				
				smpg_is_carousel_placement_logic_check( $tax_data, $spg_id );

			} else if ( is_tax( $tax_data['taxonomy'] ) && $tax_data['status'] ) {
				
				smpg_is_carousel_placement_logic_check( $tax_data, $spg_id );

			} 						

		}						
					
	return $response;
    
}

function smpg_is_carousel_placement_logic_check( $tax_data, $spg_id = null ) {

	$response = false;

	if ( empty( $tax_data['value'] ) ) {
		$response = true;
	}else{

		$queried_id = get_queried_object_id();
		
		if ( ! $queried_id ) {
			$queried_id = $spg_id;
		}

		if ( in_array( $queried_id, $tax_data['value'] ) ){
			$response = true;
		}
	}

	return $response;
}