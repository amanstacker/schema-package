<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_placement_condition_checker($type, $post_id, $value) {

	$response = false;

	switch ($type) {

		case 'post_type':
				if(get_post_type($post_id) == $value){
					$response = true;
				}

			break;

		case 'post':
		case 'page':

				if($post_id == $value){
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
	
	if(isset($schema_data['enabled_on'][0])){

		$stack_contition = array();

		$condition = unserialize($schema_data['enabled_on'][0]);

		$post_types = $condition['post_type'];
		$posts      = $condition['post'];
		$pages      = $condition['page'];

		$post_type_status = $schema_data['enabled_on_post_type'][0];
		$post_status      = $schema_data['enabled_on_post'][0];
		$page_status      = $schema_data['enabled_on_page'][0];	

		
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

	if( isset($schema_data['disabled_on'][0]) ){

		$stack_contition = array();

		$condition = unserialize($schema_data['disabled_on'][0]);
			
		$post_type_status = $schema_data['disabled_on_post_type'][0];
		$post_status      = $schema_data['disabled_on_post'][0];
		$page_status      = $schema_data['disabled_on_page'][0];

		$post_types = $condition['post_type'];
		$posts      = $condition['post'];
		$pages      = $condition['page'];

		
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

function smpg_is_placement_match( $schema_data, $post_id ){

	$response = false;

	$add_on      = smpg_placement_added_on($schema_data, $post_id);	
	$remove_from = smpg_placement_remove_from($schema_data, $post_id);	

	if($add_on && !$remove_from){
		$response = true;
	}

	return $response;
    
}