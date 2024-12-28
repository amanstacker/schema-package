<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'save_post_smpg', 'smpg_cached_schema_ids', 10, 3 );
add_action( 'after_delete_post', 'smpg_cached_schema_ids_on_delete', 10, 1 );
add_action( 'plugins_loaded', 'smpg_set_all_global_data' );
add_action( 'admin_enqueue_scripts', 'smpg_enqueue_admin_panel', 10);

function smpg_set_all_global_data() {
                           
	global $smpg_settings, $smpg_misc_schema, $smpg_plugin_list; 
	
	$smpg_settings    = get_option( 'smpg_settings', smpg_default_settings_data());     	
	$smpg_misc_schema = get_option( 'smpg_misc_schema', smpg_default_misc_schema_data());   
	
	$smpg_plugin_list['simplejobboard'] = [
		'is_active'   	  	=> false,
		'has_own_json_ld' 	=> false,
		'id'          	  	=> 'simplejobboard',
		'name'        	  	=> 'Simple Job Board',		
		'slug_free_v' 	  	=> 'simple-job-board/simple-job-board.php',
		'slug_pro_v'  	  	=> 'simple-job-board/simple-job-board.php',
		'wp_org_url'  	  	=> 'https://wordpress.org/plugins/simple-job-board/'
	];

	$smpg_plugin_list['mooberrybookmanager'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'mooberrybookmanager',
		'name'        		=> 'Mooberry Book Manager',		
		'slug_free_v' 		=> 'mooberry-book-manager/mooberry-book-manager.php',
		'slug_pro_v'  		=> 'mooberry-book-manager/mooberry-book-manager.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/mooberry-book-manager'
	];
		
	$smpg_plugin_list['brandforwoocommerce'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'brandforwoocommerce',
		'name'        		=> 'Brands for WooCommerce',		
		'slug_free_v' 		=> 'brands-for-woocommerce/woocommerce-brand.php',
		'slug_pro_v'  		=> 'brands-for-woocommerce/woocommerce-brand.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/brands-for-woocommerce'
	];

	$smpg_plugin_list['pbfwoocommerce'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'pbfwoocommerce',
		'name'        		=> 'Perfect Brands for WooCommerce',		
		'slug_free_v' 		=> 'perfect-woocommerce-brands/perfect-woocommerce-brands.php',
		'slug_pro_v'  		=> 'perfect-woocommerce-brands/perfect-woocommerce-brands.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/perfect-woocommerce-brands'
	];	
	
	$smpg_plugin_list['ryviu'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'ryviu',
		'name'        		=> 'Ryviu – Product Reviews for WooCommerce',		
		'slug_free_v' 		=> 'ryviu/ryviu.php',
		'slug_pro_v'  		=> 'ryviu/ryviu.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/ryviu'
	];
	$smpg_plugin_list['crwoocommerce'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'crwoocommerce',
		'name'        		=> 'Customer Reviews for WooCommerce',		
		'slug_free_v' 		=> 'customer-reviews-woocommerce/ivole.php',
		'slug_pro_v'  		=> 'customer-reviews-woocommerce/ivole.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/customer-reviews-woocommerce'
	];	
	$smpg_plugin_list['yithbrandwoocommerce'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'yithbrandwoocommerce',
		'name'        		=> 'YITH WooCommerce Brands Add-On',		
		'slug_free_v' 		=> 'yith-woocommerce-brands-add-on/init.php',
		'slug_pro_v'  		=> 'yith-woocommerce-brands-add-on/init.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/yith-woocommerce-brands-add-on'
	];
	$smpg_plugin_list['ultimatereviews'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'ultimatereviews',
		'name'        		=> 'Ultimate Reviews',		
		'slug_free_v' 		=> 'ultimate-reviews/ultimate-reviews.php',
		'slug_pro_v'  		=> 'ultimate-reviews/ultimate-reviews.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/ultimate-reviews'
	];
	$smpg_plugin_list['yotposreviews'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'yotposreviews',
		'name'        		=> 'Yotpo: Product & Photo Reviews for WooCommerce',		
		'slug_free_v' 		=> 'yotpo-social-reviews-for-woocommerce/wc_yotpo.php',
		'slug_pro_v'  		=> 'yotpo-social-reviews-for-woocommerce/wc_yotpo.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/yotpo-social-reviews-for-woocommerce'
	];	
	$smpg_plugin_list['woocommerce'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'woocommerce',
		'name'        		=> 'WooCommerce',		
		'slug_free_v' 		=> 'woocommerce/woocommerce.php',
		'slug_pro_v'  		=> 'woocommerce/woocommerce.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/woocommerce'
	];

	$smpg_plugin_list['accordion'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'accordion',
		'name'        		=> 'Accordion By PickPlugins',
		'slug_free_v' 		=> 'accordions/accordions.php',
		'slug_pro_v'  		=> 'accordions/accordions.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/accordions'
	];

	$smpg_plugin_list['quickandeasyfaq'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'quickandeasyfaq',
		'name'        		=> 'Quick and Easy FAQs',
		'slug_free_v' 		=> 'quick-and-easy-faqs/quick-and-easy-faqs.php',
		'slug_pro_v'  		=> 'quick-and-easy-faqs/quick-and-easy-faqs.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/quick-and-easy-faqs/'
	];

	$smpg_plugin_list['accordionfaq'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'accordionfaq',
		'name'        		=> 'Accordion FAQ',
		'slug_free_v' 		=> 'responsive-accordion-and-collapse/responsive-accordion.php',
		'slug_pro_v'  		=> 'responsive-accordion-and-collapse/responsive-accordion.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/responsive-accordion-and-collapse'
	];
	
	$smpg_plugin_list['easyaccordion'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'easyaccordion',
		'name'        		=> 'Easy Accordion',
		'slug_free_v' 		=> 'easy-accordion-free/plugin-main.php',
		'slug_pro_v'  		=> 'easy-accordion-free/plugin-main.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/easy-accordion-free'
	];

	$smpg_plugin_list['wpresponsivefaq'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'wpresponsivefaq',
		'name'        		=> 'WP responsive FAQ with category plugin',
		'slug_free_v' 		=> 'sp-faq/faq.php',
		'slug_pro_v'  		=> 'sp-faq/faq.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/sp-faq'
	];

	$smpg_plugin_list['arconixfaq'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> false,
		'id'          		=> 'arconixfaq',
		'name'        		=> 'Arconix FAQ',
		'slug_free_v' 		=> 'arconix-faq/plugin.php',
		'slug_pro_v'  		=> 'arconix-faq/plugin.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/arconix-faq'
	];						
	
	$smpg_plugin_list['kkstarratings'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'kkstarratings',
		'name'        		=> 'kk Star Ratings',
		'slug_free_v' 		=> 'kk-star-ratings/index.php',
		'slug_pro_v'  		=> 'kk-star-ratings/index.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/kk-star-ratings/'
	];	
	$smpg_plugin_list['wooeventmanager'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'wooeventmanager',
		'name'        		=> 'WooCommerce Event Manager',
		'slug_free_v' 		=> 'mage-eventpress/woocommerce-event-press.php',
		'slug_pro_v'  		=> 'mage-eventpress/woocommerce-event-press.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/mage-eventpress/'
	];
	$smpg_plugin_list['wpeventmanager'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'wpeventmanager',
		'name'        		=> 'WP Event Manager',
		'slug_free_v' 		=> 'wp-event-manager/wp-event-manager.php',
		'slug_pro_v'  		=> 'wp-event-manager/wp-event-manager.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/wp-event-manager/'
	];
	$smpg_plugin_list['theeventscalendar'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'theeventscalendar',
		'name'        		=> 'The Events Calendar',
		'slug_free_v' 		=> 'the-events-calendar/the-events-calendar.php',
		'slug_pro_v'  		=> 'the-events-calendar/the-events-calendar.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/the-events-calendar/'
	];
	$smpg_plugin_list['wppostratings'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'wppostratings',
		'name'        		=> 'WP-PostRatings',
		'slug_free_v' 		=> 'wp-postratings/wp-postratings.php',
		'slug_pro_v'  		=> 'wp-postratings/wp-postratings.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/wp-postratings/'
	];
	$smpg_plugin_list['rankmath'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'rankmath',
		'name'        		=> 'Rank Math',
		'slug_free_v' 		=> 'seo-by-rank-math/rank-math.php',
		'slug_pro_v'  		=> 'seo-by-rank-math-premium/rank-math-premium.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/seo-by-rank-math/'
	];
	$smpg_plugin_list['yoastseo'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'yoastseo',
		'name'        		=> 'Yoast Seo',
		'slug_free_v' 		=> 'wordpress-seo/wp-seo.php',
		'slug_pro_v'  		=> 'wordpress-seo-premium/wp-seo-premium.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/wordpress-seo/'
	];	
	$smpg_plugin_list['theseoframework'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'theseoframework',
		'name'        		=> 'The SEO Framework',
		'slug_free_v' 		=> 'autodescription/autodescription.php',
		'slug_pro_v'  		=> 'autodescription/autodescription.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/autodescription/'
	];
	$smpg_plugin_list['squirrlyseo'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'squirrlyseo',
		'name'        		=> 'Squirrly SEO',
		'slug_free_v' 		=> 'squirrly-seo/squirrly.php',
		'slug_pro_v'  		=> 'squirrly-seo/squirrly.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/squirrly-seo/'
	];
	$smpg_plugin_list['smartcrawl'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'smartcrawl',
		'name'        		=> 'SmartCrawl Seo',
		'slug_free_v' 		=> 'smartcrawl-seo/wpmu-dev-seo.php',
		'slug_pro_v'  		=> 'wpmu-dev-seo/wpmu-dev-seo.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/smartcrawl-seo/'
	];
	$smpg_plugin_list['seopress'] = [
		'is_active'   		=> false,
		'has_own_json_ld' 	=> true,
		'id'          		=> 'seopress',
		'name'        		=> 'SEOPress',
		'slug_free_v' 		=> 'wp-seopress/seopress.php',
		'slug_pro_v'  		=> 'wp-seopress/seopress.php',
		'wp_org_url'  		=> 'https://wordpress.org/plugins/wp-seopress/'
	];
			
	if(!function_exists('is_plugin_active')){
		include_once(ABSPATH.'wp-admin/includes/plugin.php');
	}

	if( function_exists('is_plugin_active') ){

		foreach ($smpg_plugin_list as $key => $value) {
							
			if( is_plugin_active($value['slug_free_v']) || is_plugin_active($value['slug_pro_v']) ){
				
				$smpg_plugin_list[$key]['is_active'] = true;	
			}		

		}

	}
	
	
}

function smpg_default_settings_data(){
        	
	$defaults = array(
																						
	);	  		
	
	return $defaults;

}

function smpg_default_misc_schema_data(){
        	
	$defaults = array(
																						
	);	  		
	
	return $defaults;

}

function smpg_cached_schema_ids_on_delete($post_id){
	
	if ( ! current_user_can( 'manage_options' ) )
		return;

	if( get_post_type($post_id) == 'smpg' ) {
		delete_transient( 'smpg_cached_schema_ids' );
		smpg_get_added_schema_ids();
	}
				
}

function smpg_cached_schema_ids( $post_id, $post, $update ) {
	
	if( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || (defined( 'DOING_AJAX' ) && DOING_AJAX ) ) 
		return;
	if ( ! current_user_can( 'manage_options' ) ) 
		return;			

		delete_transient( 'smpg_cached_schema_ids' );
		smpg_get_added_schema_ids();
		
}

function smpg_get_added_schema_ids() {
	
	$added_ids = array();
	
	if ( false ===  get_transient( 'smpg_cached_schema_ids' )  ) {
		
			$args = array(
				'post_type'			=> 'smpg',
				'post_status'		=> 'publish',
				'posts_per_page'	=> -1
			);
		
			$schemas_query = new WP_Query( $args );

			$schemas = $schemas_query->get_posts();

			if ( empty($schemas) ) return array();

			foreach( $schemas as $schema ) : 
													
				$added_ids[] = $schema->ID;

			endforeach;

			wp_reset_postdata();			
			
     		set_transient('smpg_cached_schema_ids', $added_ids);  

	}else{

		$added_ids = get_transient('smpg_cached_schema_ids');
		
	}
		
	return $added_ids;
}

function smpg_get_schema_type_text($id){

	$response = array();

	$response = [
		'article'  				    => 'Article',		
		'product'                   => 'Product' ,
		'softwareapplication'       => 'SoftwareApplication' ,
		'book'                      => 'Book' ,
		'faqpage'                   => 'FAQPage',    
		'howto'                     => 'HowTo',    
		'qna'                       => 'QAPage' ,
		'event'                     => 'Event' ,
		'recipe'                    => 'Recipe' ,
		'videoobject'               => 'VideoObject',
		'course'                    => 'Course',
		'jobposting'                => 'JobPosting',
		'localbusiness'             => 'LocalBusiness',
		'service'                   => 'Service'
	];	

	if(array_key_exists($id, $response)){
		return $response[$id];
	}

	return '';
	
}

function smpg_add_menu_links() {	
                       
	add_menu_page(
				esc_html__( 'Schema Package', 'schema-package' ),
				esc_html__( 'Schema Package', 'schema-package' ),
				'manage_options',
				'schema_package', 
				'smpg_entry_page'
				);	                                           
														
}
add_action( 'admin_menu', 'smpg_add_menu_links' );

function smpg_entry_page(){

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		
		echo '<div id="smpg-entry-div"></div>';
		echo '<div id="smpg-page-footer"><span style="font-style:italic;font-size:15px;">'.esc_html__( 'Thanks for choosing the Schema Package! Your feedback matters to us', 'schema-package' ).' — <a target="_blank" href="https://wordpress.org/support/plugin/schema-package/reviews/#new-post">'.esc_html__( 'share your thoughts to help us improve.', 'schema-package' ).'</a> </span></div>';		

}

function smpg_enqueue_admin_panel($hook){
	
	if($hook == 'toplevel_page_schema_package'){
			global $smpg_plugin_list;
			wp_enqueue_media();    
			wp_enqueue_style('smpg-admin-style', SMPG_PLUGIN_URL.'admin/assets/react/dist/admin_panel.css', false, SMPG_VERSION);

			wp_enqueue_style('smpg-semantic-css', SMPG_PLUGIN_URL.'admin/assets/css/semantic.min.css', false, SMPG_VERSION);			

			$data = array(
				'smpg_plugin_url'      => SMPG_PLUGIN_URL,
				'rest_url'             => esc_url_raw( rest_url() ),
				'nonce'                => wp_create_nonce( 'wp_rest' ),
				'smpg_plugin_list'     => $smpg_plugin_list           
			);

			wp_register_script( 'smpg-admin-script', SMPG_PLUGIN_URL . 'admin/assets/react/dist/admin_panel.js', array( 'wp-i18n' ), SMPG_VERSION, true );

			wp_localize_script( 'smpg-admin-script', 'smpg_local', $data );            
			wp_enqueue_script( 'smpg-admin-script');

	}
		
}

function smpg_on_plugin_activation(){
 		
    $first_installation = get_option('smpg_first_installation_date');
    
    if(!$first_installation){
        
        update_option( 'smpg_first_installation_date', gmdate("Y-m-d") );
        
    }
                                              
}

function smpg_on_plugin_uninstall() {
        		 
	$options = get_option( 'smpg_settings' );
		
	if ( isset( $options['remove_data_on_uninstall'] ) ) {
	 
		if ( is_multisite() ) {

			foreach ( get_sites() as $site ) {

                switch_to_blog( $site->blog_id );
                smpg_remove_data_on_uninstall();
                restore_current_blog();

            }

		 } else {

			smpg_remove_data_on_uninstall();				  

		 }
			   
	}            
									   
 }

 function smpg_all_notices_from_smpg_dashboard(){
    
    $screen_id = ''; 
    $current_screen = get_current_screen();
    
    if(is_object($current_screen)){
        $screen_id =  $current_screen->id;

		if( $screen_id =='toplevel_page_schema_package' ){
        
			remove_all_actions('admin_notices'); 						
						
		 }

    }        
        
}

add_action('in_admin_header', 'smpg_all_notices_from_smpg_dashboard',999);