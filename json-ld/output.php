<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'smpg_json_ld_init');

function smpg_json_ld_init(){

    if ( is_admin() ){
        return; 
    }

    smpg_manage_conflict();

    add_action('wp_head', 'smpg_json_ld_output');    
    ob_start('smpg_clean_other_format_schema');            
            
}



function smpg_json_ld_output(){
	        
    $json_ld = smpg_get_json_ld();

    if ( ! empty($json_ld) ) {

		echo "\n\n";
		echo '<!-- schema.org data generated by Schema Package v'.esc_attr(SMPG_VERSION).' -->';
		echo "\n";
		echo '<script type="application/ld+json" class="smpg-json-ld">';
		echo wp_json_encode( $json_ld );
		echo '</script>';
		echo "\n\n";		

	}

}

function smpg_get_json_ld(){

    global $post;

    $post_id = $post->ID;

    $response    = array();

    $breadcrumbs       = smpg_prepare_breadcrumbs_json_ld();    
    if(!empty($breadcrumbs)){
        $response [] = $breadcrumbs;
    }

    $website       = smpg_prepare_website_json_ld();    
    if(!empty($website)){
        $response [] = $website;
    }

    $about_page    = smpg_prepare_about_page_json_ld();
    if(!empty($about_page)){
        $response [] = $about_page;
    }

    $contact_page  = smpg_prepare_contact_page_json_ld();  

    if(!empty($contact_page)){
        $response [] = $contact_page;
    }

    $schema_meta = get_post_meta($post_id, 'smpg_schema_meta_setup', true);
    
    if(!empty($schema_meta) && is_array($schema_meta)){

        foreach ($schema_meta as $meta) {
            
            if( isset($meta['is_enable']) && $meta['is_enable'] == 1 ){
                $response[] = smpg_prepare_particular_post_json_ld($meta, $post_id);
            }

        }

    }

    $schema_ids = smpg_get_added_schema_ids();
    
    if(!empty($schema_ids)){

        foreach ($schema_ids as $id) {
            
            $schema_meta = get_post_meta($id);
            
            if(isset($schema_meta['current_status'][0]) && $schema_meta['current_status'][0] == 1){
                if(smpg_is_placement_match($schema_meta, $post_id)){
                    $response[] = smpg_prepare_global_json_ld($schema_meta, $post_id);
                }
            }            
        }

    }

    return $response;
}
/**
 * To clean the microdata and rdfa data from the content
 * Return: String
 * Since : v1.0.0
 */
function smpg_clean_other_format_schema($content){
 
    global $smpg_settings;

    if(isset($smpg_settings['clean_micro_data'])){
        $content = preg_replace(array('/itemscope=\\"[^\\"]*\\"/i', '/itemType=\\"[^\\"]*\\"/i', '/itemprop=\\"[^\\"]*\\"/i', '/itemscope/i'), '', $content);       
    }

    if(isset($smpg_settings['clean_rdfa_data'])){
        $content = preg_replace(array('/property=\\"[^\\"]*\\"/i', '/typeof=\\"[^\\"]*\\"/i'), '', $content);
    }    

    return $content;
}

function smpg_manage_conflict(){

    global $smpg_settings;

    if(!empty($smpg_settings['manage_conflict'])){

        foreach ($smpg_settings['manage_conflict'] as $value) {
            
            switch ($value) {

                case 'woocommerce':                    
                    if(class_exists('WooCommerce')){            
                        remove_action( 'wp_footer', array( WC()->structured_data, 'output_structured_data' ), 10 ); // This removes structured data from all frontend pages                                                
                    }                
                    break;                                
                case 'yetanotherstarsrating':                    
                    remove_filter('the_content', 'yasr_add_schema');  
                    break;                                
                case 'kkstarratings':                    
                    remove_action('wp_head', 'Bhittani\StarRating\structured_data');
                    break;                 
                case 'wooeventmanager':                    
                    remove_action('wp_head', 'mep_event_rich_text_data');    
                    break;  
                case 'wpeventmanager':                    
                    if(class_exists('WP_Event_Manager_Post_Types')){
                        remove_action( 'wp_footer', array( WP_Event_Manager_Post_Types::instance(), 'output_structured_data' ), 10 ); 
                    }  
                    break;
                case 'theeventscalendar':                    
                    add_filter('tribe_json_ld_event_data', 'smpg_remove_the_events_calendar_json_ld',10,2);  
                    break;
                case 'wppostratings':                    
                    add_filter('wp_postratings_schema_itemtype', '__return_false');
                    add_filter('wp_postratings_google_structured_data', '__return_false');  
                    break;
                case 'rankmath':                    
                    add_action( 'rank_math/json_ld', 'smpg_remove_rank_math_json_ld',99 );   
                    break;
                case 'yoastseo':                    
                    add_filter('wpseo_json_ld_output', '__return_false');         
                    smpg_remove_yoast_product_json_ld();                  
                    break;                
                case 'theseoframework':                    
                    add_filter('the_seo_framework_receive_json_data', '__return_null');  
                    break;
                case 'squirrlyseo':                    
                    add_filter('sq_json_ld', '__return_false',99);   
                    break;
                case 'smartcrawl':                    
                    add_filter('wds-schema-data', '__return_false');   
                    break;
                case 'seopress':                    
                    add_action('wp_head', 'smpg_seo_press_remove_json_ld',0);    
                    break;
                case 'wpeventmanager':                    
                    if(class_exists('WP_Event_Manager_Post_Types')){
                        remove_action( 'wp_footer', array( WP_Event_Manager_Post_Types::instance(), 'output_structured_data' ), 10 ); 
                    }  
                    break;    
                
                default:
                
                    break;
            }

        }

    }
    
}

function smpg_remove_the_events_calendar_json_ld( $data, $args ){
        
    return array();
}

function smpg_remove_yoast_product_json_ld(){
         
    global $wp_filter;
            
    if(isset($wp_filter['wp_footer']) && is_object($wp_filter['wp_footer'])){
      
     $callbacks =  $wp_filter['wp_footer']->callbacks;
     
     if(is_array($callbacks)){
     
         foreach($callbacks as $key=>$actions){
             
         if(is_array($actions)){
         
             foreach ($actions as $actualKey => $priorities){
             
                 if(is_array($priorities['function'])){
                 
                     if(is_object($priorities['function'][0])){
                     
                         if ($priorities['function'][0] instanceof WPSEO_WooCommerce_Schema && $priorities['function'][1] == 'output_schema_footer') {
                              unset($wp_filter['wp_footer']->callbacks[$key][$actualKey]);
                         }
                         
                     }
                                                                     
                 }
                                                                             
             }
             
         }    
                                        
       }
         
     }   
             
   }                       

 }
 function smpg_seo_press_remove_json_ld(){
    remove_action('wp_head', 'seopress_social_accounts_jsonld_hook',1);
    remove_action('wp_head', 'seopress_social_website_option',1);                                    
 }
 function smpg_remove_rank_math_json_ld($entry){
    return array();  
 }