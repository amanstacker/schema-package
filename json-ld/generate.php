<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_prepare_particular_post_json_ld( $schema_data, $post_id ) {

    $json_ld = [];    
    
    $properties  = $schema_data['properties'];  
    $schema_type = $schema_data['id'];  
            
    switch ( $schema_type ) {
        
        case 'localbusiness':
        case 'store':
        case 'bakery':
        case 'barorpub':
        case 'cafeorcoffeeshop':
        case 'fastfoodrestaurant':
        case 'icecreamshop':
        case 'restaurant':
            
            $json_ld = smpg_get_different_localbusiness_individual_json_ld($json_ld, $properties, $schema_type);              
                                    
        break;

        case 'customschema':
            
            $json_ld = smpg_get_custom_schema_individual_json_ld($json_ld, $properties, $schema_type);              
                                    
        break;

        case 'article':
        case 'techarticle':
        case 'newsarticle':
        case 'advertisercontentarticle':
        case 'satiricalarticle':
        case 'scholarlyarticle':
        case 'socialmediaposting':
        case 'creativework':
            
            $json_ld = smpg_get_different_article_individual_json_ld($json_ld, $properties, $schema_type);              
                                    
        break;

        case 'recipe':

            $json_ld = smpg_get_recipe_individual_json_ld($json_ld, $properties, $schema_type);  

            break;

        case 'howto':

            $json_ld = smpg_get_howto_individual_json_ld($json_ld, $properties, $schema_type);  

            break;

        case 'faqpage':

            $json_ld = smpg_get_faq_individual_json_ld($json_ld, $properties, $schema_type);            
                        
            break;
        case 'product':

            $json_ld = smpg_get_product_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;
        case 'softwareapplication':

            $json_ld = smpg_get_softwareapplication_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;   

        case 'imagegallery':

            $json_ld = smpg_get_imagegallery_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;
            
        case 'mediagallery':

            $json_ld = smpg_get_mediagallery_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'imageobject':

            $json_ld = smpg_get_imageobject_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'photograph':

            $json_ld = smpg_get_photograph_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'apartment':

            $json_ld = smpg_get_apartment_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'house':

            $json_ld = smpg_get_house_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'singlefamilyresidence':

            $json_ld = smpg_get_singlefamilyresidence_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'review':

            $json_ld = smpg_get_review_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'mobileapplication':

            $json_ld = smpg_get_mobileapplication_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'trip':

            $json_ld = smpg_get_trip_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'musicplaylist':

            $json_ld = smpg_get_musicplaylist_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'musicalbum':

            $json_ld = smpg_get_musicalbum_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;

        case 'liveblogposting':

            $json_ld = smpg_get_liveblogposting_individual_json_ld($json_ld, $properties, $schema_type);            
                            
            break;
            
        case 'book':

            $json_ld = smpg_get_book_individual_json_ld($json_ld, $properties, $schema_type);            
                                
        break;       

        case 'qna':

            $json_ld = smpg_get_qna_individual_json_ld($json_ld, $properties, $schema_type);            
                                
        break;       

        case 'videoobject':

            $json_ld = smpg_get_videoobject_individual_json_ld($json_ld, $properties, $schema_type);            
                                
        break; 

        case 'audioobject':

            $json_ld = smpg_get_audioobject_individual_json_ld($json_ld, $properties, $schema_type);            
                                
        break; 
        
        case 'course':

            $json_ld = smpg_get_course_individual_json_ld($json_ld, $properties, $schema_type);            
                                
        break; 

        case 'jobposting':

            $json_ld = smpg_get_jobposting_individual_json_ld($json_ld, $properties, $schema_type);            
                                
        break; 

        case 'event':

            $json_ld = smpg_get_event_individual_json_ld( $json_ld, $properties, $schema_type );            
                                
        break;
        
        case 'person':
            
            $json_ld = smpg_get_person_individual_json_ld( $json_ld, $properties, $schema_type );            
                          
        break;

        case 'profilepage':
            
            $json_ld = smpg_get_profilepage_individual_json_ld( $json_ld, $properties, $schema_type );            
                          
        break;

        case 'webpage':
            
            $json_ld = smpg_get_webpage_individual_json_ld( $json_ld, $properties, $schema_type );            
                          
        break;

        case 'service':
        case 'broadcastservice':
        case 'cableorsatelliteservice':
        case 'financialproduct':
        case 'foodservice':
        case 'governmentservice':
        case 'taxiservice':
        case 'webapi':

            $json_ld = smpg_get_service_individual_json_ld( $json_ld, $properties, $schema_type );
                                
        break; 
                
        default:
        
            break;
            
    }            

    $json_ld = apply_filters( 'smpg_filter_schema_package_generator_json_ld', $json_ld, $schema_data, $post_id );

    return $json_ld;
}

function smpg_prepare_carousel_json_ld( $schema_data ) {
    
        global $query_string;    
        
        $json_ld      = [];
        $list_element = [];    
    
        $i = 1;
        $query_loop = new WP_Query( $query_string );
        
        if ( $query_loop->have_posts() ):

            while( $query_loop->have_posts() ): $query_loop->the_post();
                                                                                    
                                $list_element[]       =  [
                                    '@type'    => 'ListItem',
                                    'position' => $i,
                                    'url'      => get_permalink()
                                ];
                                
                $i++;

            endwhile;
        endif;		
        wp_reset_postdata();


        if ( ! empty( $list_element ) ) {
            $json_ld['@context']           = smpg_get_context_url();
            $json_ld['@type']              = 'ItemList';
            $json_ld['itemListElement']    = $list_element;
        }
    
        return apply_filters( 'smpg_filter_carousel_json_ld', $json_ld ); 

}

function smpg_prepare_global_json_ld( $schema_data, $post_id ) {
            
    $json_ld = [];        
    
    if ( empty( $schema_data['_schema_type'][0] ) ) {
        return $json_ld;
    }      
                              
    switch ( $schema_data['_schema_type'][0] ) {
        
            case 'customschema':

            if ( ! empty( $schema_data['_custom_schema'][0] ) ) {

                $js_decoded = json_decode( $schema_data['_custom_schema'][0], true );
        
                if ( json_last_error() === JSON_ERROR_NONE ) {

                    $json_ld = $js_decoded;

                }
            }

            break;

            case 'article':
            case 'techarticle':
            case 'newsarticle':
            case 'advertisercontentarticle':
            case 'satiricalarticle':
            case 'scholarlyarticle':
            case 'socialmediaposting':     
            case 'creativework':
            
            $json_ld['@context']                  = smpg_get_context_url();
            $json_ld['@type']                     = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']                       = smpg_get_permalink();
            $json_ld['headline']                  = smpg_get_the_title();
            $json_ld['description']               = smpg_get_description();    
            $json_ld['datePublished']             = smpg_get_published_date();
            $json_ld['dateModified']              = smpg_get_modified_date();    

            if ( $schema_data['_schema_type'][0] != 'creativework' ) {

                $json_ld['wordCount']                 = smpg_get_word_count();
                $json_ld['articleSection']            = smpg_get_categories();
                
            }                

            $json_ld['inLanguage']                = smpg_get_inlanguage();
            $json_ld['keywords']                  = smpg_get_post_tags();                            
            $json_ld['author']                    = smpg_get_author_detail();

            $json_ld['publisher']                 = smpg_get_publisher();

            $image = smpg_get_image();

            if ( ! empty( $image ) ) {
                $json_ld = array_merge( $json_ld, $image );
            }

            if ( isset( $schema_data['add_comments'][0] ) && $schema_data['add_comments'][0] == 1 ) {
                $json_ld['comment'] = smpg_get_post_comments($post_id);
            }
            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_article_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'webpage':
            
            $json_ld['@context']                  = smpg_get_context_url();
            $json_ld['@type']                     = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']                       = smpg_get_permalink();            
            $json_ld['description']               = smpg_get_description();                     
            $json_ld['inLanguage']                = smpg_get_inlanguage();

            $image = smpg_get_image();

            if ( ! empty( $image ) ) {
                $json_ld = array_merge( $json_ld, $image );
            }
            
            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_webpage_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'profilepage':
            
            $json_ld['@context']                  = smpg_get_context_url();
            $json_ld['@type']                     = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']                       = smpg_get_permalink();            
            $json_ld['description']               = smpg_get_description();    
            $json_ld['dateCreated']               = smpg_get_published_date();                                        
            $json_ld['inLanguage']                = smpg_get_inlanguage();

            $image = smpg_get_image();

            if ( ! empty( $image ) ) {
                $json_ld = array_merge( $json_ld, $image );
            }
            
            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_profilepage_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'person':

            $json_ld['@context']         = smpg_get_context_url();
            $json_ld['@type']            = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']              = smpg_get_permalink();

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_person_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'jobposting':

            $json_ld['@context']         = smpg_get_context_url();
            $json_ld['@type']            = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']              = smpg_get_permalink();

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_jobposting_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'course':

            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld['datePublished']             = smpg_get_published_date();
            $json_ld['dateModified']              = smpg_get_modified_date();    
			$json_ld['publisher']                 = smpg_get_publisher();
            $json_ld['provider']                  = smpg_get_publisher();
			
			
			$image = smpg_get_image();

            if ( ! empty( $image ) ) {
                $json_ld = array_merge( $json_ld, $image );
            }

            if ( isset( $schema_data['add_comments'][0] ) && $schema_data['add_comments'][0] == 1 ) {
                $json_ld['comment'] = smpg_get_post_comments($post_id);
            }

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_course_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'product':

            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_product_json_ld', $json_ld, $schema_data, $post_id ); 

            break;

        case 'faqpage':

            $json_ld['@context']         = smpg_get_context_url();
            $json_ld['@type']            = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']              = smpg_get_permalink();

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_faqpage_json_ld', $json_ld, $schema_data, $post_id ); 

            break;    

        case 'softwareapplication':

            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_softwareapplication_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'imagegallery':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_imagegallery_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'mediagallery':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_mediagallery_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'imageobject':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_imageobject_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'photograph':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_photograph_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'apartment':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_apartment_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'house':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_house_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'review':
            $json_ld['@context']                         = smpg_get_context_url();
            $json_ld['@type']                            = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['reviewBody']                       = smpg_get_description();    
            $json_ld['datePublished']                    = smpg_get_published_date();
            $json_ld['author']                           = smpg_get_author_detail();
            $json_ld['itemReviewed']['@type']            = 'Product';
            $json_ld['itemReviewed']['url']              = smpg_get_permalink();
            $json_ld['itemReviewed']['name']             = smpg_get_the_title();
            $json_ld['itemReviewed']['description']      = smpg_get_description();    

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_review_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'singlefamilyresidence':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_singlefamilyresidence_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'mobileapplication':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_mobileapplication_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'trip':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_trip_json_ld', $json_ld, $schema_data, $post_id ); 

        break;
        case 'event':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_event_json_ld', $json_ld, $schema_data, $post_id ); 

        break;
        case 'recipe':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_recipe_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'musicplaylist':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_musicplaylist_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'musicalbum':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_musicalbum_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'liveblogposting':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_liveblogposting_json_ld', $json_ld, $schema_data, $post_id ); 

        break;

        case 'localbusiness':
        case 'store':
        case 'bakery':
        case 'barorpub':
        case 'cafeorcoffeeshop':
        case 'fastfoodrestaurant':
        case 'icecreamshop':
        case 'restaurant':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_localbusiness_json_ld', $json_ld, $schema_data, $post_id );

        break;

        case 'service':
        case 'broadcastservice':
        case 'cableorsatelliteservice':
        case 'financialproduct':
        case 'foodservice':
        case 'governmentservice':
        case 'taxiservice':
        case 'webapi':
            
            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_service_json_ld', $json_ld, $schema_data, $post_id );             

        break;
        
        case 'book':
            $json_ld['@context']         = smpg_get_context_url();
            $json_ld['@type']            = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
            $json_ld['url']              = smpg_get_permalink();

            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_book_json_ld', $json_ld, $schema_data, $post_id ); 

        break;   

        case 'videoobject':

            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );

            $json_ld['datePublished']    = smpg_get_published_date();
            $json_ld['dateModified']     = smpg_get_modified_date();
            $json_ld['uploadDate']       = smpg_get_modified_date(); 
            $json_ld['author']           = smpg_get_author_detail();    

            $video_data = smpg_get_video_metadata();            

            if(!empty($video_data[0]['thumbnail_url'])){                                                                        
                $json_ld['thumbnailUrl']   = $video_data[0]['thumbnail_url'];                                    
            }

            if(!empty($video_data[0]['duration'])){                                                                        
                $json_ld['duration']   = $video_data[0]['duration'];                                    
            }
            if(!empty($video_data[0]['video_url'])){
                
                $json_ld['contentUrl'] = $video_data[0]['video_url'];
                $json_ld['embedUrl']   = $video_data[0]['video_url'];
                
            }
            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_videoobject_json_ld', $json_ld, $schema_data, $post_id ); 

        break;   

        case 'audioobject':

            $json_ld = smpg_common_default_json_ld( $json_ld, $schema_data );
            
            $json_ld['datePublished']    = smpg_get_published_date();
            $json_ld['dateModified']     = smpg_get_modified_date();
            $json_ld['uploadDate']       = smpg_get_modified_date(); 
            $json_ld['author']           = smpg_get_author_detail();    

            $video_data = smpg_get_video_metadata();            

            if(!empty($video_data[0]['thumbnail_url'])){                                                                        
                $json_ld['thumbnailUrl']   = $video_data[0]['thumbnail_url'];                                    
            }

            if(!empty($video_data[0]['duration'])){                                                                        
                $json_ld['duration']   = $video_data[0]['duration'];                                    
            }
            if(!empty($video_data[0]['video_url'])){
                
                $json_ld['contentUrl'] = $video_data[0]['video_url'];
                $json_ld['embedUrl']   = $video_data[0]['video_url'];
                
            }
            $json_ld = smpg_mapping_properties( $json_ld, $schema_data );
            $json_ld = apply_filters( 'smpg_filter_audioobject_json_ld', $json_ld, $schema_data, $post_id ); 

        break;   
        
        default:
            
        break;
    }        
            
    return apply_filters( 'smpg_filter_global_json_ld', $json_ld );    

}

function smpg_prepare_breadcrumbs_json_ld() {

    if ( is_front_page() || is_home() ) {
        return [];
    }

    global $smpg_misc_schema;
    
    $bread_data = smpg_breadcrumbs_data();
    
    $json_ld       = [];

    if ( ! empty( $smpg_misc_schema['breadcrumbs'] ) ) {
                            
                $itemList = [];

                if ( ! empty( $bread_data['itemlist'] ) ) {

                    $i = 1;

                    foreach ( $bread_data['itemlist'] as  $value ) {

                        $itemList[] = [
                            '@type'     => 'ListItem',
                            'position'  => $i,
                            'name'      => $value['name'],
                            'item'      => $value['link']
                        ];

                        $i++;
                    }

                }

                if ( ! empty($itemList) ) {

                    $json_ld['@context']        =  smpg_get_context_url();
                    $json_ld['@type']           =  'BreadcrumbList';                
                    $json_ld['itemListElement'] =  $itemList;        

                }
                
    }

    return apply_filters( 'smpg_filter_breadcrumbs_json_ld', $json_ld );
}

function smpg_breadcrumbs_data() {
    
    $response    = [];
    $crumbslist  = [];    
    $current_url = '';
    $blog_name   = get_bloginfo();        
    $current_url = get_home_url();

    $crumbslist[] = [
        'name' => $blog_name ? $blog_name : 'HomePage',
        'link' => get_home_url()
    ];


        if ( is_author() ){

            global $authordata;
                
                if ( $authordata ) {
                    
                    $author_url             = get_author_posts_url( $authordata->ID );
                    $current_url            = $author_url;

                    $crumbslist[] = [
                        'name' => $authordata->display_name,
                        'link' => $author_url
                    ];

                }

        }

        if ( is_category() ) {

            $current_url   = smpg_get_request_url();
            $exploded_cat  = explode( '/', $current_url );
                            
            if ( ! empty( $exploded_cat ) && is_array( $exploded_cat ) ) {
                                                    
                foreach ($exploded_cat as $value) {

                    $category_value = get_category_by_slug( $value );
                    
                    if ( $category_value && is_object( $category_value ) ) {

                        $category_obj           = get_category( $category_value );                                        
                        $current_url            = get_category_link( $category_value );

                        $crumbslist[] = [
                            'name' => $category_obj->name,
                            'link' => get_category_link( $category_value )
                        ];

                    }
                    
                }
            }

        }

        if ( is_tag() ) {

                $term_id        = get_query_var( 'tag_id' );
                $get_term       = get_term( $term_id );
                
                if ( is_object( $get_term ) && isset( $get_term->name ) ) {
                    
                    $current_url            = get_term_link( $term_id );

                    $crumbslist[] = [
                        'name' => $get_term->name,
                        'link' => get_term_link( $term_id )
                    ];
                                
                }

        }

        if ( is_singular() ) {
                                                                        
                $current_url            = get_permalink();                                                                     

                $crumbslist[] = [
                    'name' => smpg_get_the_title(),
                    'link' => get_permalink()
                ];

        }

        if ( is_tax() ) {
                                                        
            $queried_obj = get_queried_object();
            
            if ( is_object( $queried_obj ) ) {

                $current_url            = get_term_link( $queried_obj->term_id );
                
                $crumbslist[] = [
                    'name' => get_queried_object()->name,
                    'link' => get_term_link( $queried_obj->term_id )
                ];
            }          

        }

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() && !is_author() ) {
                                                
            $current_url           = get_post_type_archive_link( get_post_type() );

            $crumbslist[] = [
                'name' => post_type_archive_title( '', false ),
                'link' => get_post_type_archive_link( get_post_type() )
            ];
            
        }    

        if ( ! empty( $crumbslist ) ) {
            $response = [ 'itemlist'=> $crumbslist, 'current_url' => $current_url ];   
        }

        return $response;
}

function smpg_prepare_profilepage_json_ld() {

    global $smpg_misc_schema;
    $json_ld = [];

    if ( ! empty( $smpg_misc_schema['profilepage'] ) && is_author() ) {

        $author_id    = get_queried_object_id();
        $author_name  = get_the_author_meta( 'display_name', $author_id );
        $author_url   = get_author_posts_url( $author_id );
        $author_desc  = get_the_author_meta( 'description', $author_id );
        $author_image = get_avatar_url( $author_id, [ 'size' => 300 ] );
        $job_title    = get_the_author_meta( 'job_title', $author_id ); 

        // Fetch social profiles if available (Twitter, Facebook, LinkedIn, etc.)
        $social_profiles = [];
        $social_meta_keys = [ 'twitter', 'facebook', 'linkedin', 'instagram', 'youtube' ];

        foreach ( $social_meta_keys as $key ) {
            $social_url = get_the_author_meta( $key, $author_id );
            if ( ! empty( $social_url ) ) {
                $social_profiles[] = esc_url( $social_url );
            }
        }

        $json_ld = [
            '@context'  => 'https://schema.org',
            '@type'     => 'ProfilePage',
            'mainEntity' => [
                '@type'        => 'Person',
                'name'         => esc_html( $author_name ),
                'url'          => esc_url( $author_url ),
                'description'  => ! empty( $author_desc ) ? esc_html( $author_desc ) : null,
                'image'        => esc_url( $author_image ),
                'jobTitle'     => ! empty( $job_title ) ? esc_html( $job_title ) : null,
                'sameAs'       => ! empty( $social_profiles ) ? $social_profiles : null,
            ],
        ];

        // Remove null values to keep JSON clean
        $json_ld['mainEntity'] = array_filter( $json_ld['mainEntity'] );
    }

    return $json_ld;
}

function smpg_prepare_website_json_ld() {

    global $smpg_misc_schema;
    $json_ld       = [];

    if ( !empty($smpg_misc_schema['website']) && ( is_home() || is_front_page() ) ) {
    
        $site_url  = get_home_url();

        if ( function_exists('pll_home_url') ) {
            $site_url  = pll_home_url();
        }

        $site_name = get_bloginfo();

        if ( $site_url && $site_name ) {

            $json_ld['@context']    = smpg_get_context_url();
            $json_ld['@type']       = 'WebSite';        
            $json_ld['headline']    = $site_name;
            $json_ld['name']        = $site_name;
            $json_ld['description'] = smpg_get_blog_description();
            $json_ld['url']         = $site_url;

            if ( ! empty( $smpg_misc_schema['sitelinks_search_box'] ) ) {

                $json_ld['potentialAction']['@type']       = 'SearchAction';
                $json_ld['potentialAction']['target']      = trailingslashit( $site_url ).'?s={search_term_string}';
                $json_ld['potentialAction']['query-input'] = 'required name=search_term_string';

            }

        }

    }
    
    return $json_ld;
}

function smpg_prepare_about_page_json_ld() {

	global $smpg_misc_schema;
    
    $page_id       = get_the_ID();
    $json_ld       = [];   
    $pages_arr     = [];

    if ( ! empty( $smpg_misc_schema['about_pages'] ) ) {

        $pages_arr = $smpg_misc_schema['about_pages'];

        if ( in_array( $page_id, $pages_arr ) ) {

            $json_ld['@context']         = smpg_get_context_url();
            $json_ld['@type']            = 'AboutPage';
            $json_ld['url']              = smpg_get_permalink();
            $json_ld['headline']         = smpg_get_the_title();
            $json_ld['description']      = smpg_get_description();
            $json_ld['publisher']        = smpg_get_publisher();

            $image = smpg_get_image();

            if ( ! empty( $image ) ) {
                $json_ld = array_merge( $json_ld,$image );
            }    

        }

    }            
        	
	return $json_ld;
	
}

function smpg_prepare_contact_page_json_ld() { 

	global $smpg_misc_schema;
    
    $page_id       = get_the_ID();
    $json_ld       = [];   
    $pages_arr     = [];

    if ( ! empty( $smpg_misc_schema['contact_pages'] ) ) {

        $pages_arr = $smpg_misc_schema['contact_pages'];

        if ( in_array( $page_id, $pages_arr ) ) {

            $json_ld['@context']         = smpg_get_context_url();
            $json_ld['@type']            = 'ContactPage';
            $json_ld['url']              = smpg_get_permalink();
            $json_ld['headline']         = smpg_get_the_title();
            $json_ld['description']      = smpg_get_description();    
            $json_ld['publisher']        = smpg_get_publisher();

            $image = smpg_get_image();

            if ( ! empty( $image ) ) {
                $json_ld = array_merge( $json_ld,$image );
            }

        }

    }            
        	
	return $json_ld;	
}

function smpg_common_default_json_ld( $json_ld, $schema_data ) {

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_data['_schema_type'][0] );
    $json_ld['url']              = smpg_get_permalink();
    $json_ld['name']             = smpg_get_the_title();
    $json_ld['description']      = smpg_get_description();    

    return $json_ld;
}