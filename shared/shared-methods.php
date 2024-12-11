<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_remove_data_on_uninstall( $blog_id = null ) {
        
    try{
     
    global $wpdb;
        
    $cache_key  = 'smpg_post_id_cache_key';
	$post_ids   = wp_cache_get( $cache_key );  

	if ( false === $post_ids ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
		$post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s", 'smpg' ) );
		wp_cache_set( $cache_key, $post_ids );

	}

    if ( $post_ids ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            $wpdb->delete(
                    $wpdb->posts,
                    array( 'post_type' => 'smpg' ),
                    array( '%s' )
            );
		 // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared	
		    $post_ids_placeholder = implode( ', ', array_fill( 0, count( $post_ids ), '%d' ) ); 
			$prepared_query = $wpdb->prepare( "DELETE FROM {$wpdb->postmeta} WHERE post_id IN ($post_ids_placeholder)" );
			$wpdb->query( $prepared_query );            
    }
                                                        
    //All options                    
    delete_option('smpg_settings');
	delete_option('smpg_misc_schema');  
    
    wp_cache_flush();
        
    }catch(Exception $ex){
        echo esc_html($ex->getMessage());
    }            
            
}

function smpg_sanitize_post_meta( $key, $val ) {

    $response = '';

    switch ( $key ) {

        case 'schema_type':

            $response = sanitize_text_field($val);
            break;
        
        default:

            $response = $val;    
            break;
    }

    return $response;

}

function smpg_get_posts_by_arg( $arg ) {
      
    $response = array();

    $meta_query = new WP_Query( $arg );
            
      if ( $meta_query->have_posts() ) {
           
          $data = array();  
          $post_meta = array();        

          while($meta_query->have_posts()) {

              $meta_query->the_post();
              $data['post_id']       =  get_the_ID();
              $data['post_title']    =  get_the_title();
              $data['post_status']   =  get_post_status();
              $data['post_modified'] =  get_the_date('M, d Y');
              $post_meta             =  get_post_meta(get_the_ID());

              if ( $post_meta ) {

                  foreach( $post_meta as $key => $val ) {
                      $post_meta[$key] = $val[0];
                  }

              }
              
              $posts_data[] = array(
              'post'        => (array) $data,
              'post_meta'   => $post_meta                
              ); 

          }

          wp_reset_postdata(); 

          $response['posts_data']  = $posts_data;
          $response['posts_found'] = $meta_query->found_posts;

      }

      return $response;

  }

/**
 * Id Gutenberg block editor enabled.
 *
 * @return bool
 */
function smpg_is_gutenberg_editor(){

    if( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) { 
        return true;
    }   
    
    $current_screen = get_current_screen();
    if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
        return true;
    }

    return false;

}

function smpg_get_context_url(){
    
    $url = 'http://schema.org';
    
    if(is_ssl()){
        $url = 'https://schema.org';
    }
    
    return $url;
}

function smpg_get_publisher( $post_id = null ){
	
	$publisher = array();
	
	$name = '';
	
	if ( empty($name) ) $name = get_bloginfo( 'name' );			
	
	$publisher['@type'] = 'Organization';
	$publisher['name']  = wp_filter_nohtml_kses($name);
	$publisher['logo']  = smpg_get_the_logo();			

	return apply_filters( 'smpg_change_publisher', $publisher );	
}

function smpg_get_post_category( $post_id = null ){

	global $post;
	
	if ( ! isset( $post_id ) && $post ) $post_id = $post->ID;
	
	$cats		= get_the_category($post_id);
	$cat		= !empty($cats) ? $cats : array();
	$category	= (isset($cat[0]->cat_name)) ? $cat[0]->cat_name : '';
   
   return $category;

}

function smpg_get_author_detail( $post_id = null ) {
	
	global $post;
		
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;
				
	$content_post	= get_post($post_id);
	$post_author	= get_userdata($content_post->post_author);
	$email 			= $post_author->user_email; 		
	
	$author = array (
		'@type'	=> 'Person',
		'name'	=> apply_filters ( 'smpg_change_author_name', $post_author->display_name ),
		'url'	=> esc_url( get_author_posts_url( $post_author->ID ) )
	);
	
	if ( get_the_author_meta( 'description', $post_author->ID ) ) {
		$author['description'] = wp_strip_all_tags( get_the_author_meta( 'description', $post_author->ID ) );
	}
	
	if ( smpg_validate_gravatar( $email ) ) {
		
		$image_size	= apply_filters( 'smpg_change_author_img_size', 96 ); 				
		$args = array(
						'size' => $image_size,
					);
		
		$image_url	= get_avatar_url( $email, $args );

		if ( $image_url ) {
			$author['image'] = array (
				'@type'		=> 'ImageObject',
				'url' 		=> $image_url,
				'height' 	=> $image_size, 
				'width' 	=> $image_size
			);
		}
	}
			
	$website 	= get_the_author_meta( 'user_url', $post_author->ID );	
	$facebook 	= get_the_author_meta( 'facebook', $post_author->ID);	
	$instagram 	= get_the_author_meta( 'instagram', $post_author->ID );
	$youtube 	= get_the_author_meta( 'youtube', $post_author->ID );
	$linkedin 	= get_the_author_meta( 'linkedin', $post_author->ID );
	$myspace 	= get_the_author_meta( 'myspace', $post_author->ID );
	$pinterest 	= get_the_author_meta( 'pinterest', $post_author->ID );
	$soundcloud = get_the_author_meta( 'soundcloud', $post_author->ID );
	$tumblr 	= get_the_author_meta( 'tumblr', $post_author->ID );
	$github 	= get_the_author_meta( 'github', $post_author->ID );
			
	$sameAs_links = array( $website, $facebook, $instagram, $youtube, $linkedin, $myspace, $pinterest, $soundcloud, $tumblr, $github );
	
	$social = array();
		
	foreach( $sameAs_links as $sameAs_link ) {
		if ( $sameAs_link != '' ) $social[] = $sameAs_link;
	}
	
	if ( ! empty($social) ) {
		$author["sameAs"] = $social;
	}
	
	return apply_filters( 'smpg_change_author_detail', $author );
}

function smpg_get_published_date($post_id = null){

	global $post;

	if ( ! isset($post_id) && $post ) $post_id = $post->ID;

	$p_date = get_the_date( 'c', $post_id );

	return apply_filters( 'smpg_change_published_date', $p_date );	

}

function smpg_get_modified_date($post_id = null){

	global $post;

	if ( ! isset($post_id) && $post ) $post_id = $post->ID;

	$m_date = get_post_modified_time( 'c', false, $post_id, false );

	return apply_filters( 'smpg_change_modified_date', $m_date );	

}

function smpg_get_the_title( $post_id = null ){

	global $post;
	
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;

	$title  		= wp_filter_nohtml_kses( get_the_title() );

	return apply_filters( 'smpg_change_the_title', $title );		

}

function smpg_get_the_content($post_id = null){

	global $post;

	if ( ! isset($post_id) && $post ) $post_id = $post->ID;

	$content = '';   
	
	if(is_object($post)){
		$content = get_post_field('post_content', $post_id);            
		$content = wp_strip_all_tags($content);   
		$content = preg_replace('/\[.*?\]/','', $content);            
		$content = str_replace('=', '', $content); 
		$content = str_replace(array("\n","\r\n","\r"), ' ', $content);
	}
	
	return apply_filters('smpg_the_content' ,$content);

}

function smpg_get_description( $post_id = null ) {
	
	global $post;
	
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;
				
	$full_content		= $post ? $post->post_content : '';
	$excerpt			= $post ? $post->post_excerpt : '';
		
	$full_content 		= preg_replace('#\[[^\]]+\]#', '', $full_content);
	$full_content 		= wp_strip_all_tags( $full_content );	
	
	$desc_word_count	= apply_filters( 'smpg_change_description_word_count', 49 );
	$short_content		= wp_trim_words( $full_content, $desc_word_count, '' ); 
		
	$description		= apply_filters( 'smpg_change_description', ( $excerpt != '' ) ? $excerpt : $short_content ); 
	
	return $description;
}

function smpg_get_post_tags( $post_id = null ) {
	
	global $post;
	
	if ( ! isset( $post_id ) && $post ) $post_id = $post->ID;
	
	$tags = '';
	$posttags = get_the_tags();
    if ($posttags) {
       $taglist = "";
       foreach($posttags as $tag) {
           $taglist .=  $tag->name . ', '; 
       }
      $tags =  rtrim($taglist, ", ");
   }
   
   return $tags;
}

function smpg_get_categories( $post_id = null ) {
	
	global $post;
	
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;
	
	$post_categories	= wp_get_post_categories( $post_id );
	$categories			= array();
     
	if ( empty($post_categories) ) return $categories;
		
	$cats = array();
		
	foreach( $post_categories as $c ){
    	$cat	= get_category( $c );
		$cats[]	= $cat->slug;
	}
	
	if ( empty($cats) ) return $categories;
		
	$categories = smpg_array_flatten($cats);
	
	return apply_filters( 'smpg_change_categories', $categories );
}

function smpg_get_image(){
            
	global $smpg_settings, $smpg_image;

	$json_ld_image          = array();             
	$multiple_size          = '';

	if(isset($smpg_settings['multisize_image'])){
		$multiple_size = $smpg_settings['multisize_image'];		
	}	

	if(!$smpg_image){
		$image_id 	            = get_post_thumbnail_id();
		$smpg_image             = wp_get_attachment_image_src($image_id, 'full');            
	}

	$image_details = $smpg_image; 

				if( is_array($image_details) && !empty($image_details)){                                
																								
					if( ( (isset($image_details[1]) && ($image_details[1] < 1200)) || (isset($image_details[2]) && ($image_details[2] < 675)) ) && function_exists('smpg_aq_resize')){
							
						$targetHeight = 1200;
						
						if( ($image_details[1] > 0) && ($image_details[2] > 0) ){                                            
							$img_ratio    = $image_details[1] / $image_details[2];
							$targetHeight = 1200 / $img_ratio;                                                
						}
						
						if($multiple_size){

							if($targetHeight < 675){

								$width  = array(1200, 1200, 1200);
								$height = array(900, 720, 675);

							}else{

								$width  = array(1200, 1200, 1200);
								$height = array($targetHeight, 900, 675);

							}
							
						}else{

							if($targetHeight < 675){

								$width  = array(1200);
								$height = array(720);

							}else{

								$width  = array(1200);
								$height = array($targetHeight);
								
							}
							
						}                                                                                        
						
						for($i = 0; $i < count($width); $i++){
							
							$resize_image = smpg_aq_resize( $image_details[0], $width[$i], $height[$i], true, false, true );
							
							if(isset($resize_image[0]) && $resize_image[0] !='' && isset($resize_image[1]) && isset($resize_image[2]) ){
																																	
								$json_ld_image['image'][$i]['@type']  = 'ImageObject';
								
								if($i == 0){                                                        
									$json_ld_image['image'][$i]['@id']    = get_permalink().'#primaryimage';                                                        
								}
								
								$json_ld_image['image'][$i]['url']    = esc_url($resize_image[0]);
								$json_ld_image['image'][$i]['width']  = esc_attr($resize_image[1]);
								$json_ld_image['image'][$i]['height'] = esc_attr($resize_image[2]);  
								
							}                                                                                                                                                                                                
						}
						
						if(!empty($json_ld_image)){
							foreach($json_ld_image as $arr){
								$json_ld_image['image'] = array_values($arr);
							}
						}
																																																		
					}else{
									
						if($multiple_size){
							$width  = array($image_details[1], 1200, 1200);
							$height = array($image_details[2], 900, 675);
						}else{
							$width  = array($image_details[1]);
							$height = array($image_details[2]);
						}  
																			
							for($i = 0; $i < count($width); $i++){
								
									$resize_image = smpg_aq_resize( $image_details[0], $width[$i], $height[$i], true, false, true );
								
									if(isset($resize_image[0]) && $resize_image[0] != '' && isset($resize_image[1]) && isset($resize_image[2]) ){

											$json_ld_image['image'][$i]['@type']  = 'ImageObject';
											
											if($i == 0){
									
											$json_ld_image['image'][$i]['@id']    = get_permalink().'#primaryimage'; 
											
											}
											
											$json_ld_image['image'][$i]['url']    = esc_url($resize_image[0]);
											$json_ld_image['image'][$i]['width']  = esc_attr($resize_image[1]);
											$json_ld_image['image'][$i]['height'] = esc_attr($resize_image[2]);

									}
																					
							}                                                                                                                                                                                        
						
					} 
					
					if(empty($json_ld_image) && isset($image_details[0]) && $image_details[0] !='' && isset($image_details[1]) && isset($image_details[2]) ){
						
							$json_ld_image['image']['@type']  = 'ImageObject';
							$json_ld_image['image']['@id']    = get_permalink().'#primaryimage';
							$json_ld_image['image']['url']    = esc_url($image_details[0]);
							$json_ld_image['image']['width']  = esc_attr($image_details[1]);
							$json_ld_image['image']['height'] = esc_attr($image_details[2]);
						
					}
																																																						
			}											   				     
		
		if(empty($json_ld_image)){
			
			if(isset($smpg_settings['default_image_id'])){
				
					$fetch_image = smpg_get_imageobject_by_id($smpg_settings['default_image_id']);
					
					if($fetch_image){											
						$json_ld_image['image'] 		  = $fetch_image;
						$json_ld_image['image']['@id']    = get_permalink().'#primaryimage';
					}
																					
			}
										
		}
	
	return apply_filters( 'smpg_change_json_ld_image', $json_ld_image );	
}


function smpg_get_image_by_image_id( $image_id ) {
	
	if ( ! isset($image_id) ) 
		return array();
	
	$ImageObject = array();
		
	$image_attributes = wp_get_attachment_image_src( $image_id, 'full' );
	
	if ( isset($image_attributes[0]) ) {
		$url		= $image_attributes[0];
		$width		= $image_attributes[1];
		$height		= $image_attributes[2];
		
		$ImageObject = array (
			'@type' 	=> 'ImageObject',
			'url' 		=> $url,
			'width'		=> $width,
			'height' 	=> $height,
		);
				
		$caption = wp_get_attachment_caption( $image_id );
		if ($caption) { 
			$ImageObject['caption'] = $caption;
		}
	}		
	
	return $ImageObject;
}
function smpg_get_home_url( $path = '', $scheme = null ) {

	$home_url = home_url( $path, $scheme );

	if ( ! empty( $path ) ) {
		return $home_url;
	}

	$home_path = wp_parse_url( $home_url, PHP_URL_PATH );
	
	if ( '/' === $home_path ) {
		return $home_url;
	}

	if ( is_null( $home_path ) ) { 
		return trailingslashit( $home_url );
	}

	if ( is_string( $home_path ) ) {
		return user_trailingslashit( $home_url );
	}

	return apply_filters( 'smpg_change_home_url', $home_url );
}

function smpg_make_the_image_json($data, $img_obj = null){

	$image = [];

	if(!empty($data)){

		foreach ($data as $value) {

			if($img_obj){

				$image[] = array(
					'@type'   => 'ImageObject',
					'url'     => $value['url'],
					'width'   => $value['width'],
					'height'  => $value['height']
				);
				
			}else{
				$image[] = $value['url'];
			}
			
		}
	}

	return $image;
}

function smpg_make_the_logo_json($data){

	$logo = [];

	if(isset($data[0])){

		$logo['@type']  = 'ImageObject';
		$logo['url']    = $data[0]['url'];
		$logo['width']  = $data[0]['width']; 
		$logo['height'] = $data[0]['height'];                   

	}

	return $logo;

}

function smpg_get_the_logo(){

	global $smpg_settings;

	$logo = array();

	if( isset($smpg_settings['default_logo_id']) ){

		$logo = smpg_get_imageobject_by_id($smpg_settings['default_logo_id']);				
	}

	if(empty($logo)){

		$logo_id            = get_theme_mod( 'custom_logo' );     		
		$logo_details       = wp_get_attachment_image_src( $logo_id, 'full');
		
		if(isset($logo_details[0])){

			$logo_details = @smpg_aq_resize( $logo_details[0], 600, 60, true, false, true );

			if(!empty($logo_details)){

				    $logo['@type']  = 'ImageObject';
                    $logo['url']    = $logo_details[0];
                    $logo['width']  = $logo_details[1]; 
                    $logo['height'] = $logo_details[2];                   
			}
		}
		
	}
	
	return apply_filters( 'smpg_change_the_logo', $logo );

}

function smpg_get_imageobject_by_id($image_id){
    
    $response = array();
    
    if($image_id){
        
            $image_details      = wp_get_attachment_image_src($image_id, 'full');                    
            
            if($image_details){
                
                    $response['@type']  = 'ImageObject';
                    $response['url']    = $image_details[0];
                    $response['width']  = $image_details[1]; 
                    $response['height'] = $image_details[2];                   
                    
            }
                
    }
    
    return $response;
    
}

function smpg_get_imageobject_by_url($url){
    
    $response = array();
    
    if($url){        
                
            $image_details      = @getimagesize($url);                    
            
            if($image_details){

                    $response['@type']  = 'ImageObject';
                    $response['url']    = $url;
                    $response['width']  = $image_details[0]; 
                    $response['height'] = $image_details[1];                   
                    
            }
                
    }
    
    return $response;
    
}

function smpg_format_date_time_to_iso( $date, $time = null ) {
    
    $formated = ''; 

    if ( $date && $time ) {
        	$formated =  gmdate( 'c', strtotime( $date . ' ' . $time ) );       
    } else {

        if ( $date ) {
        	$formated =  gmdate( 'c', strtotime( $date ) );      
        }        
    }               
    
    return $formated;
}

function smpg_get_post_native_reviews( $post_id ){
                        
        $comments      = array();
        $ratings       = array();
        $post_comments = array();   
        $response      = array();
               
        $post_comments = get_approved_comments( $post_id, array( 'parent'  => 0 ) );                                                                                                                                                                             
              
        if ( count( $post_comments ) ) {

        $sumofrating = 0;
        $avg_rating  = 1;
            
		foreach ( $post_comments as $comment ) {                        
			
            $rating = get_comment_meta($comment->comment_ID, 'rating', true);
            
            if(is_numeric($rating)){

                $sumofrating += $rating;

                $comments[] = array (
					'@type'         => 'Review',
					'datePublished' => $comment->comment_date ? gmdate('c',strtotime($comment->comment_date)) : '',
					'description'   => wp_strip_all_tags($comment->comment_content),
					'author'        => array (
                                            '@type' => 'Person',
                                            'name'  => $comment->comment_author                                            
                                    ),
                    'reviewRating'  => array(
                            '@type'	        => 'Rating',
                            'bestRating'	=> '5',
                            'ratingValue'	=> $rating,
                            'worstRating'	=> '1',
               )
            );
            
            if($sumofrating> 0){
                $avg_rating = $sumofrating /  count($comments); 
            }
            
            $ratings =  array(
                    '@type'         => 'AggregateRating',
                    'ratingValue'	=> $avg_rating,
                    'reviewCount'   => count($comments)
            );

            }            			
        }                
                		
    }

    if($comments){
        $response = array('reviews' => $comments, 'ratings' => $ratings);
    }
    
    return apply_filters( 'smpg_change_post_native_reviews',  $response);        
    
}

function smpg_get_post_comments( $post_id ){
            
    $comments      = array();
    $post_comments = array();   
           
    $post_comments = get_approved_comments( $post_id, array( 'parent'  => 0 ) );                                                                                                                                                                                             
      
    if ( count( $post_comments ) ) {
        
		foreach ( $post_comments as $comment ) {
					
			$comments[] = array (
					'@type'       => 'Comment',
					'id'          => trailingslashit(get_permalink()).'comment-'.$comment->comment_ID,
					'dateCreated' => smpg_format_date_time_to_iso($comment->comment_date),
					'description' => wp_strip_all_tags($comment->comment_content),
					'author'      => array (
													'@type' => 'Person',
													'name'  => esc_attr($comment->comment_author),
													'url'   => isset($comment->comment_author_url) ? esc_url($comment->comment_author_url): '',
						),
			);
		}
                
	}
	
	return apply_filters( 'smpg_change_post_comments', $comments );
    
}

function smpg_array_flatten($array) {

	$return = array();

	foreach ($array as $key => $value) {

		if (is_array($value)){
			$return = array_merge($return, array_flatten($value));
		}else {
			$return[$key] = $value;
		}

	}
	
	return $return;
}

function smpg_validate_gravatar( $email ) {

	$hashkey 	= md5(strtolower(trim($email)));
	$uri 		= 'https://www.gravatar.com/avatar/' . $hashkey;
	$data 		= get_transient($hashkey);
	
	if (false === $data) {
		$response = wp_remote_head($uri);
		if( is_wp_error($response) ) {
			$data = 'not200';
		} else {
			$data = $response['response']['code'];
		}
	    set_transient( $hashkey, $data, $expiration = 60*5);
	}		
	
	if ($data == '200'){
		return true;
	} else {
		return false;
	}
}

function smpg_get_inlanguage($post_id = null){
	
	global $post;
	
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;

	return get_bloginfo('language');
}
function smpg_get_permalink( $post_id = null ){
    
	global $post;
	
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;

	$url = '';
    $url = get_permalink($post_id);
    $url = trailingslashit($url);        
    
    return $url;
}

function smpg_get_word_count($post_id = null) {
    
    global $post;
	
	if ( ! isset($post_id) && $post ) $post_id = $post->ID;
	            
    $word_count      = 0;
    $text            = '';    
    if(is_object($post)){
        $text = $post->post_content;
    }else{
		$content_post	= get_post($post_id);
		if($content_post){
			$text            = trim( wp_strip_all_tags( $content_post->post_content ) );
		}
		
	}    
    $word_count      = substr_count( "$text ", ' ' );
                
    return $word_count;    
}

function smpg_time_required(){

	global $post;
	
    $timereq 		  = '';
    $words_per_minute = 225;
    $words_per_second = $words_per_minute / 60;
    
    $word_count      = smpg_get_word_count();
    $text            = trim( wp_strip_all_tags( @get_the_content() ) );
    
    if(!$text && is_object($post)){
        $text = $post->post_content;
    }            
    $seconds = floor( $word_count / $words_per_second );        

    if($seconds > 60){

        $minutes      = floor($seconds/60);        
        $seconds_left = $seconds % 60;
        
        $timereq = 'PT'.$minutes.'M'.$seconds_left.'S';

    }else{
        $timereq = 'PT'.$seconds.'S';
    }

    return $timereq;

}

function smpg_get_blog_description(){
        		
	$blog_description = get_bloginfo('description');
		                       
	return $blog_description;
}

function smpg_get_request_url() {
 
    $link = "http"; 
      
    if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) {

        $link = "https"; 

    } 
  
    $link .= "://"; 
	
	if ( isset( $_SERVER['HTTP_HOST'] ) ) {

		$link .= sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) );
	}
    	
	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		
		$link .= sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) );
	}    
      
    return $link;
	
}

function smpg_get_initial_post_meta( $post_id, $tag_id ){

    $schema_meta = [];

	if(!empty($post_id)){
		$schema_meta = get_post_meta($post_id, 'smpg_schema_meta_setup', true);
	}

	if(!empty($tag_id)){
		$schema_meta = get_term_meta($tag_id, 'smpg_schema_meta_setup', true);
	}    
    
    if(!empty($schema_meta) && is_array($schema_meta)){

            foreach ($schema_meta as $key => $value) {

                $schema                             = smpg_get_schema_properties($value['id'], $post_id, $tag_id);                
                
                if(!empty($schema)){

                    foreach($schema['properties'] as $pkey => $pval){
                        
                        if($pval['type'] == 'repeater'){   
                            
                            $new_elements = [];
							$reptcount    = 1;
							if(isset($value['properties'][$pkey]['elements'])){
								$reptcount = count($value['properties'][$pkey]['elements']);
							}
                            
                            for( $i = 0; $i < $reptcount; $i++ ){
                                $new_elements[] = $schema['properties'][$pkey]['elements'][0];    
                            }

                            foreach ($new_elements as $nkey => $nval) {

                                    foreach ($nval as $zkey => $zval) {

										if($value['properties'][$pkey]['elements'][$nkey][$zkey]['value']){
											$new_elements[$nkey][$zkey]['value'] = $value['properties'][$pkey]['elements'][$nkey][$zkey]['value'];
										}

										if( is_array($value['properties'][$pkey]['elements'][$nkey][$zkey]) && array_key_exists( 'display',  $value['properties'][$pkey]['elements'][$nkey][$zkey]) ){
											$new_elements[$nkey][$zkey]['display'] = $value['properties'][$pkey]['elements'][$nkey][$zkey]['display'];
										}
										                                        
                                    }
                            }
                            
                            $schema['properties'][$pkey]['elements'] = $new_elements;
							
                        }else{

							if($value['properties'][$pkey]['value']){
								$schema['properties'][$pkey]['value'] = $value['properties'][$pkey]['value'];
							}

							if( is_array($value['properties'][$pkey]) && array_key_exists('display', $value['properties'][$pkey])){
								$schema['properties'][$pkey]['display'] = $value['properties'][$pkey]['display'];
							}
							                            
                        }                        

                    }
                }
                
                $data_properties = $schema['properties'];
                $schema_meta[$key]['properties']    = $data_properties;
            }
            
    }
    
    return $schema_meta;

}

function smpg_get_multiple_schema_properties(array $slected_ids, int $post_id, int $tag_id){
	
    $response = array();

    foreach ($slected_ids as $value) {
        $response[$value] = smpg_get_schema_properties($value, $post_id, $tag_id);
    }

    return $response;

}

function smpg_prepare_qna_answers($answers){

	$response      = [];
     
	if(!empty($answers)){

        foreach($answers as $val){

            $data = array();

            if($val['text']['value']){

                $data['@type']       = 'Answer';
                $data['upvoteCount'] = $val['vote']['value'];
                $data['url']         = $val['url']['value'];
                $data['text']        = $val['text']['value'];
                $data['dateCreated'] = $val['date_created']['value'];

                if(!empty($val['author_name']['value'])){
                    $data['author']['@type'] = 'Person'; 
                    $data['author']['name']  = $val['author_name']['value'];                    
                }
                
            }

           $response[] =  $data;
        }
       
    }

	return $response;

}

function smpg_convert_into_supported_format( $data ){

    $format = 'https://schema.org/InStock';

    switch (strtolower($data)) {

        case 'instock':
            $format = 'https://schema.org/InStock';    
        break;

        case 'soldout':
            $format = 'https://schema.org/SoldOut';    
        break;

        case 'presale':
            $format = 'https://schema.org/PreSale';    
        break;

        case 'onlineonly':
            $format = 'https://schema.org/OnlineOnly';    
        break;

        case 'limitedavailability':
            $format = 'https://schema.org/LimitedAvailability';    
        break;

        case 'instoreonly':
            $format = 'https://schema.org/InStoreOnly';    
        break;

        case 'outofstock':
            $format = 'https://schema.org/OutOfStock';    
        break;

        case 'discontinued':
            $format = 'https://schema.org/Discontinued';    
        break;

        case 'onbackorder':
            $format = 'https://schema.org/BackOrder';    
        break;
        case 'preorder':
            $format = 'https://schema.org/PreOrder';
        break;

        default:

            break;
    }

    return $format;
} 

function smpg_get_custom_post_terms($post_id, $taxonomy ){

	$response = [];

	$terms     =  wp_get_post_terms( $post_id , $taxonomy );

	if(!is_wp_error( $terms )){

		if( count($terms) > 0){
			
			foreach ( $terms as $term ) {

				if( $term ){
					
					$response[] = [
						'term'      => (array)$term,
						'term_meta' => get_term_meta($term->term_id)
					]; 
				}
				
			}

		}
	}

	return $response;
}

function smpg_extract_shortcode_attrs($shortcode_str, $content){

    $attributes = array();

    $pattern = get_shortcode_regex();

    if (  preg_match_all( '/'. $pattern .'/s', $content, $matches )
            && array_key_exists( 2, $matches ) )
    {
        if(in_array( $shortcode_str, $matches[2] )){
            
            foreach ($matches[0] as $matche){
            
                $mached         = rtrim($matche, ']'); 
                $mached         = ltrim($mached, '[');
                $mached         = trim($mached);
                $attributes[]   = shortcode_parse_atts('['.$mached.' ]');  
                                
            }

        }
    }

    return $attributes;

}

function smpg_get_video_metadata($content = ''){
    
	global $post, $smpg_settings;
  
	$response = array();

	if(!$content){
		if(is_object($post)){
			$content = $post->post_content;
		}    
	}
													   
	 preg_match_all( '/\[video(.*?)\[\/video]/s', $content, $matches, PREG_SET_ORDER);
	 
	 if($matches){

		 foreach ($matches as $match) {
			
			$mached = rtrim($match[0], '[/video]'); 
			$mached = ltrim($mached, '[');
			$mached = trim($mached, '[]');

			$attr = shortcode_parse_atts($mached);
			
			foreach ($attr as $key => $value) {

				if(strpos($value, 'http')!== false){

					$response[]['video_url'] = $value;

				}
			}

		 }
		 
	 }

	 $pattern = get_shortcode_regex();
			  
	 if ( preg_match_all( '/'. $pattern .'/s', $content, $matches )
		&& array_key_exists( 2, $matches )
		&& in_array( 'playlist', $matches[2] ) )
		{
		 
		  foreach ($matches[0] as $match){
		
			$mached = rtrim($match, ']'); 
			$mached = ltrim($mached, '[');
			$mached = trim($mached, '[]');
			$attr   = shortcode_parse_atts($mached);  

			if(isset($attr['ids'])){

				$vurl = wp_get_attachment_url($attr['ids']);
				$response[]['video_url'] = $vurl;

			}
							
		  }
					  
		}
	   
	   @preg_match_all( '@(https?://)?(?:www\.)?(youtu(?:\.be/([-\w]+)|be\.com/watch\?v=([-\w]+)))\S*@im', $content, $matches, PREG_SET_ORDER );
	   
	   if($matches){
		   
		   foreach($matches as $match){

			  $vurl     = $match[0]; 
			  $metadata = array();  
			  if(isset($smpg_settings['smpg-youtube-api']) && $smpg_settings['smpg-youtube-api'] != ''){

				$vid = smpg_get_youtube_vid($vurl);

				$video_meta = SMPG_Youtube_Data_Api::getVideoInfo($vid, $smpg_settings['smpg-youtube-api']);

				if(!empty($video_meta)){
					$metadata['duration']      = $video_meta['duration'];
					$metadata['thumbnail_url'] = $video_meta['thumbnail']['sdDefault'];
				}

			  }else{

				$rulr     = 'https://www.youtube.com/oembed?url='.esc_attr($vurl).'&format=json';  
				$result   = @wp_remote_get($rulr);                                                        

				if(wp_remote_retrieve_response_code($result) == 200) {

						$metadata = json_decode(wp_remote_retrieve_body($result),true);                                                

				}                                       

			  }  
			  
			  $metadata['video_url'] = $vurl;
			  $response[] = $metadata;

		   }                              
	   }
	   
	   preg_match_all( '/src\=\"(.*?)youtu\.be(.*?)\"/s', $content, $youtubematches, PREG_SET_ORDER );
	   
	   if($youtubematches){
		   
		   foreach($youtubematches as $match){
			   
			  $vurl       = $match[1].'youtu.be'.$match[2];                   
			  $metadata   = array();  

			  if(isset($smpg_settings['smpg-youtube-api']) && $smpg_settings['smpg-youtube-api'] != ''){

				$vid = smpg_get_youtube_vid($vurl);

				$video_meta = SMPG_Youtube_Data_Api::getVideoInfo($vid, $smpg_settings['smpg-youtube-api']);

				if(!empty($video_meta)){
					$metadata['duration']      = $video_meta['duration'];
					$metadata['thumbnail_url'] = $video_meta['thumbnail']['sdDefault'];
				}

			  }else{

				$rulr     = 'https://www.youtube.com/oembed?url='.esc_attr($vurl).'&format=json';  
				$result   = @wp_remote_get($rulr);                                    
				$metadata = json_decode(wp_remote_retrieve_body($result),true);

			  }
			  
			  $metadata['video_url'] = $vurl;                    
			  $response[] = $metadata;

		   }
						  
	   } 


	   if(function_exists('has_block')){
		
		if( has_block('core-embed/youtube') ){
			$attributes = smpg_get_gutenberg_block_data('core-embed/youtube');    
		}

		if( has_block('core/embed') ){
			$attributes = smpg_get_gutenberg_block_data('core/embed');    
		}
	   
		if(isset($attributes['attrs']['url'])) {

			   $vurl     = $attributes['attrs']['url']; 
			   $metadata = array();
			   if(isset($smpg_settings['smpg-youtube-api']) && $smpg_settings['smpg-youtube-api'] != ''){

				$vid = smpg_get_youtube_vid($vurl);

				$video_meta = SMPG_Youtube_Data_Api::getVideoInfo($vid, $smpg_settings['smpg-youtube-api']);

				if(!empty($video_meta)){
					$metadata['duration']      = $video_meta['duration'];
					$metadata['thumbnail_url'] = $video_meta['thumbnail']['sdDefault'];
				}
									
			   }else{

				$rulr     = 'https://www.youtube.com/oembed?url='.esc_attr($vurl).'&format=json';  
				$result   = wp_remote_get($rulr);
				$metadata = json_decode(wp_remote_retrieve_body($result),true);                                        

			   }

			   $metadata['video_url'] = $vurl;                    
			   $response[0] = $metadata;
			   
			}

	   }
								 
	return $response;
}

function smpg_get_youtube_vid($url){

    $youtube_id = '';

    if( $url ){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = isset($match[1]) ? $match[1] : '';
    }
    
    return $youtube_id;

}

function smpg_get_gutenberg_block_data($block){
    
    global $post;
     
    $block_list = array();
    $block_data = array();
    $response   = array();
    
    if(function_exists('parse_blocks') && is_object($post)){
        
            $blocks = parse_blocks($post->post_content);            
            
            if($blocks){

                foreach ($blocks as $parse_blocks){
                        $block_list[] = $parse_blocks['blockName'];
                        $block_data[$parse_blocks['blockName']] = $parse_blocks;
                }

            }        
    }
    
    if($block_list){
    
        if(in_array($block, $block_list)){
            $response = $block_data[$block];
        }
        
    }
    
    return $response;
    
}


function smpg_get_paywalled_json_ld( $json_ld, $properties ){

	if(!empty($properties['is_paywalled']['value']) && !empty($properties['paywalled_selectors']['value'])){

		$exploded = explode(',', $properties['paywalled_selectors']['value']);
		
		if($exploded){

			$has_part = [];

			foreach ($exploded as $value) {

				if($value){
					$has_part[] = [
						'@type'               => 'WebPageElement',
						'isAccessibleForFree' => 'https://schema.org/False',
						'cssSelector'         => $value,
					];
				}
				
			}

			if(!empty($has_part)){
				$json_ld['isAccessibleForFree'] = "https://schema.org/False";
				$json_ld['hasPart'] = $has_part;
			}
			
		}
		
	}

	return $json_ld;
}

function smpg_get_speakable_xpath( $json_ld, $properties ) {


	if(!empty($properties['speakable']['value'])){

		$json_ld['speakable']['@type']     = 'SpeakableSpecification';

		if(!empty($properties['speakable_selectors']['value'])){
							 
		  $xpath     = [];

		  $selectors =   $properties['speakable_selectors']['value'];
		  $exploded  = explode(',', $selectors);

		  if(!empty($exploded)){
			
			foreach ($exploded as $value) {
				$value = trim($value); 
				if( strpos($value, '.') !== false ){                            
					$xpath[] = "/html//*[@class='".substr($value, 1)."']";
				}else if( strpos($value, '#') !== false ){
					$xpath[] = "/html//*[@id='".substr($value, 1)."']";
				}else if( strpos($value, '*') !== false ){                            
					$xpath[] = "/html//meta[@name='".substr($value, 1)."']/@content";
				}else{
					$xpath[] = "/html//title";
				}

			}

				$json_ld['speakable']['xpath'] = $xpath;

		  }

		}else{
		   
			$json_ld['speakable']['xpath']     = [
				'/html/head/title',
				'/html/head/meta[@name="description"]/@content'
			]; 
		}
		
	}

	return $json_ld;
}
function smpg_get_video_json_ld( $json_ld, $properties ){

	if(!empty($properties['include_video']['value'])){

        $json_ld['video']['@type']  = 'VideoObject';

        if(!empty($properties['video_name']['value'])){
            $json_ld['video']['name']    = $properties['video_name']['value']; 
        }
        if(!empty($properties['video_description']['value'])){
            $json_ld['video']['description']    = $properties['video_description']['value']; 
        }
        if(!empty($properties['content_url']['value'])){
            $json_ld['video']['contentUrl']    = $properties['content_url']['value']; 
        }
        if(!empty($properties['embed_url']['value'])){
            $json_ld['video']['embedUrl']    = $properties['embed_url']['value']; 
        }
        $image = smpg_make_the_image_json($properties['thumbnail_image']['value'], false);

        if(!empty($image)){
            $json_ld['video']['thumbnailUrl']              =  $image;   
        }
        if(!empty($properties['upload_date']['value'])){
            $json_ld['video']['uploadDate']    = $properties['upload_date']['value']; 
        }        

        $duration = '';
        if(!empty($properties['hours']['value'])){
            $duration .=      $properties['hours']['value'].'H';
        }
        if(!empty($properties['minutes']['value'])){
            $duration .=      $properties['minutes']['value'].'M';
        }
        if(!empty($properties['seconds']['value'])){
            $duration .=      $properties['seconds']['value'].'S';
        }
        if($duration){
            $json_ld['video']['duration']              =  'PT'.$duration;    
        }

    }

	return $json_ld;
}

function smpg_get_steps_json_ld( $json_ld, $properties, $schema_type ){

	if(!empty($properties['steps']['elements'])){
        
        $steps = $properties['steps']['elements'];
        
        $steps_data = [];
        $clips_data = [];
        
        foreach ($steps as $key => $value) {

                $step        = [];                                
            
                $step['@type']   = 'HowToStep';                

                if(!empty($value['name']['value'])){
                    $step['name']    = $value['name']['value']; 
                }
                if(!empty($value['description']['value'])){
                    $step['text']    = $value['description']['value']; 
                }
                $step['image']   = smpg_make_the_image_json($value['image']['value'], true);
                $step['url']     = trailingslashit(get_permalink()).'#step'.++$key;    
                
                if( !empty($value['clip_name']['value']) && !empty($value['clip_start_offset']['value']) && !empty($value['clip_end_offset']['value']) && !empty($properties['include_video']['value']) ){
                    
                  $step['video']['@id'] = 'Clip'.$key;  

                  $clips_data[] = [
                    '@type'         => 'Clip',
                    '@id'           => 'Clip'.$key,
                    'name'          => $value['clip_name']['value'],
                    'startOffset'   => $value['clip_start_offset']['value'],
                    'endOffset'     => $value['clip_end_offset']['value'],
                    'url'           => trailingslashit(get_permalink()).';t='.$value['clip_start_offset']['value'],
                  ];

                }
                                
                $steps_data[] = $step;
        }
        
        if($clips_data){            
            $json_ld['video']['hasPart'] = $clips_data;
        }
        if($steps_data){

			if($schema_type == 'recipe'){
				$json_ld['recipeInstructions'] = $steps_data;
			}else{
				$json_ld['step'] = $steps_data;
			}

            
        }

    }

	return $json_ld;
}