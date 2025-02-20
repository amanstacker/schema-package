<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'save_post_smpg_singular_schema', 'smpg_cached_singular_schema_ids', 10, 3 );
add_action( 'save_post_smpg_carousel_schema', 'smpg_cached_carousel_schema_ids', 10, 3 );
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

function smpg_cached_schema_ids_on_delete( $post_id ) {
	
	if ( ! current_user_can( 'manage_options' ) )
		return;

		$post_type = get_post_type( $post_id );

		if ( $post_type == 'smpg_singular_schema' ) {

			$cache_key = 'smpg_cached_key_singular_schema';			
			
		}

		if ( $post_type == 'smpg_carousel_schema' ) {

			$cache_key = 'smpg_cached_key_carousel_schema';		
			
		}

		delete_transient( $cache_key );
		smpg_get_schema_ids( $cache_key, $post_type );
				
}

function smpg_cached_singular_schema_ids( $post_id, $post, $update ) {
	
	if( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || (defined( 'DOING_AJAX' ) && DOING_AJAX ) ) 
		return;
	if ( ! current_user_can( 'manage_options' ) ) 
		return;			

		$cache_key = 'smpg_cached_key_singular_schema';
		$post_type = 'smpg_singular_schema';
		delete_transient( $cache_key );
		smpg_get_schema_ids( $cache_key, $post_type );
		
}

function smpg_cached_carousel_schema_ids( $post_id, $post, $update ) {
	
	if( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || (defined( 'DOING_AJAX' ) && DOING_AJAX ) ) 
		return;
	if ( ! current_user_can( 'manage_options' ) ) 
		return;			

		$cache_key = 'smpg_cached_key_carousel_schema';
		$post_type = 'smpg_carousel_schema';
		delete_transient( $cache_key );
		smpg_get_schema_ids( $cache_key, $post_type );
		
}

function smpg_get_schema_ids( $cache_key, $post_type ) {
	
	$added_ids = array();
	
	if ( false ===  get_transient( $cache_key )  ) {
		
			$args = array(
				'post_type'			=> $post_type,
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
			
     		set_transient( $cache_key, $added_ids );  

	}else{

		$added_ids = get_transient( $cache_key );
		
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
				
		global $menu;

		foreach ( $menu as $key => $item ) {
			
			if ( isset( $item[2] ) && $item[2] === 'schema_package' ) {

				if ( isset( $menu[$key][6] ) ) {
					$menu[$key][6] = SMPG_PLUGIN_URL.'admin/assets/img/icon-20x20.png';
				}
				
			}

		}
			
}
add_action( 'admin_menu', 'smpg_add_menu_links' );

function smpg_entry_page(){

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		
		echo '<div id="smpg-entry-div"></div>';
		echo '<div id="smpg-page-footer">
		<span>'.esc_html__( 'Thanks for choosing the Schema Package! Your feedback matters to us', 'schema-package' ).' — <a target="_blank" href="https://wordpress.org/support/plugin/schema-package/reviews/#new-post">'.esc_html__( 'share your thoughts to help us improve.', 'schema-package' ).'</a> </span>
		<span class="smpg-version-footer">'.esc_html__( 'Schema Package Version', 'schema-package' ).' '.SMPG_VERSION.'</span>
		</div>';		

}

function smpg_enqueue_admin_panel($hook){
	
	if($hook == 'toplevel_page_schema_package'){
			global $smpg_plugin_list;
			wp_enqueue_media();    
			//wp_enqueue_style('smpg-admin-style', SMPG_PLUGIN_URL.'admin/assets/react/dist/admin_panel.css', false, SMPG_VERSION);

			//wp_enqueue_style('smpg-semantic-css', SMPG_PLUGIN_URL.'admin/assets/css/semantic.min.css', false, SMPG_VERSION);			
			
			$data = apply_filters( 'smpg_local_filter', array(
				'smpg_plugin_url'      => SMPG_PLUGIN_URL,
				'rest_url'             => esc_url_raw( rest_url() ),
				'nonce'                => wp_create_nonce( 'wp_rest' ),
				'smpg_plugin_list'     => $smpg_plugin_list,
				'is_free'              => true
			) );

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

function smpg_meta_list() {

	$meta_list = [
		'textmeta'  =>  [
					[ 'key' => 'blogname', 'value' => 'blogname', 'text' => esc_html__( 'Site Title', 'schema-package' ) ],
					[ 'key' => 'blogdescription', 'value' => 'blogdescription', 'text' => esc_html__( 'Tagline', 'schema-package' ) ],
					[ 'key' => 'site_url', 'value' => 'site_url', 'text' => esc_html__( 'Site URL', 'schema-package' ) ],
					[ 'key' => 'post_title', 'value' => 'post_title', 'text' => esc_html__( 'Title', 'schema-package' ) ],
					[ 'key' => 'post_content', 'value' => 'post_content', 'text' => esc_html__( 'Content', 'schema-package' ) ],
					[ 'key' => 'post_category', 'value' => 'post_category', 'text' => esc_html__( 'Category', 'schema-package' ) ],
					[ 'key' => 'post_excerpt', 'value' => 'post_excerpt', 'text' => esc_html__( 'Excerpt', 'schema-package' ) ],
					[ 'key' => 'post_permalink', 'value' => 'post_permalink', 'text' => esc_html__( 'Permalink', 'schema-package' ) ],
					[ 'key' => 'author_name', 'value' => 'author_name', 'text' => esc_html__( 'Author Name', 'schema-package' ) ],
					[ 'key' => 'author_first_name', 'value' => 'author_first_name', 'text' => esc_html__( 'Author First Name', 'schema-package' ) ],
					[ 'key' => 'author_last_name', 'value' => 'author_last_name', 'text' => esc_html__( 'Author Last Name', 'schema-package' ) ],
					[ 'key' => 'post_date', 'value' => 'post_date', 'text' => esc_html__( 'Publish Date', 'schema-package' ) ],
					[ 'key' => 'post_modified', 'value' => 'post_modified', 'text' => esc_html__( 'Last Modify Date', 'schema-package' ) ],
					[ 'key' => 'taxonomy_term', 'value' => 'taxonomy_term', 'text' => esc_html__( 'Taxonomy Term', 'schema-package' ) ],
					[ 'key' => 'custom_text', 'value' => 'custom_text', 'text' => esc_html__( 'Custom Text', 'schema-package' ) ],
					[ 'key' => 'custom_field', 'value' => 'custom_field', 'text' => esc_html__( 'Custom Field', 'schema-package' ) ],
		],
		'imagemeta' => [
				[ 'key' => 'featured_img', 'value' => 'featured_img', 'text' => esc_html__( 'Featured Image', 'schema-package' ) ],
				[ 'key' => 'author_image', 'value' => 'author_image', 'text' => esc_html__( 'Author Image', 'schema-package' ) ],
				[ 'key' => 'site_logo', 'value' => 'site_logo', 'text' => esc_html__( 'Logo Image', 'schema-package' ) ],
				[ 'key' => 'custom_image', 'value' => 'custom_image', 'text' => esc_html__( 'Custom Image', 'schema-package' ) ],
				[ 'key' => 'custom_image_url', 'value' => 'custom_image_url', 'text' => esc_html__( 'Custom Image URL', 'schema-package' ) ],
				[ 'key' => 'custom_image_field', 'value' => 'custom_image_field', 'text' => esc_html__( 'Custom Image Field', 'schema-package' ) ],
				[ 'key' => 'no_image', 'value' => 'no_image', 'text' => esc_html__( 'No Image', 'schema-package' ) ],
			],
		];

	$meta_list = apply_filters( 'smpg_meta_list_filter', $meta_list );	
	return $meta_list;	  
}

add_filter( 'smpg_meta_list_filter', 'smpg_acf_meta_keys' );
add_filter( 'smpg_meta_list_filter', 'smpg_cpt_meta_keys' );

function smpg_acf_meta_keys( $fields ) {
            
	if ( function_exists( 'acf' ) && class_exists( 'acf' ) ) {

		$post_type = 'acf';

		if ( ( defined( 'ACF_PRO' ) && ACF_PRO ) || ( defined( 'ACF' ) && ACF ) ) {
			$post_type = 'acf-field-group';
		}
		$text_acf_field  = [];
		$image_acf_field = [];
		$args            = [
			'post_type'      => $post_type,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		];

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :

			while ( $the_query->have_posts() ) :

				$the_query->the_post();

				$post_id = get_the_ID();
				
				$acf_fields = apply_filters( 'acf/field_group/get_fields', [], $post_id );

				if ( 'acf-field-group' == $post_type ) {
					$acf_fields = acf_get_fields( $post_id );
				}

				if ( is_array( $acf_fields ) && ! empty( $acf_fields ) ) {
					foreach ( $acf_fields as $key => $value ) {

						if ( 'image' == $value['type'] ) {
							$image_acf_field[ $value['name'] ] = $value['label'];
						} else {
							$text_acf_field[ $value['name'] ] = $value['label'];
						}
					}
				}
			endwhile;
		endif;
		wp_reset_postdata();
		
		if ( ! empty( $text_acf_field ) ) {

			$fields['textmeta'][] = [
				'key'     => esc_html__( 'Advanced Custom Fields', 'schema-package' ),
				'value' => $text_acf_field,
				'text' => $text_acf_field,
				
			];
		}

		if ( ! empty( $image_acf_field ) ) {
			$fields['imagemeta'][] = [
				'key'     => esc_html__( 'Advanced Custom Fields', 'schema-package' ),
				'value' => $text_acf_field,
				'text' => $text_acf_field,
			];
		}
	}

	return $fields;
	
}


function smpg_cpt_meta_keys( $fields ) {
        
	$cpt_text_fields = [];
	$cpt_file_fields = [];

	if ( class_exists('CPT_Field_Groups') ) {
		
		$field_groups = cpt_field_groups()->get_registered_groups();

		$field_groups = get_posts(
			[
				'posts_per_page' => -1,
				'post_type'      => CPT_UI_PREFIX . '_field',
				'post_status'    => 'publish',
			]
		);

		if ( ! empty( $field_groups ) && is_array( $field_groups ) ) {

			foreach ( $field_groups as $grp_key => $grp_value ) {
				
				$cpt_fields = [];
				$cpt_fields       = ! empty( get_post_meta( $grp_value->ID, 'fields', true ) ) ? get_post_meta( $grp_value->ID, 'fields',true ) : [];

				if ( ! empty( $cpt_fields) && is_array($cpt_fields) ) {
					foreach ( $cpt_fields as $cpt_key => $cpt_value) {
						if ( ! empty( $cpt_value) && is_array($cpt_value) ) {
							if ( isset( $cpt_value['key']) && $cpt_value['label']){
								if ( 'file' == $cpt_value['type'] ) {
									$cpt_file_fields[$cpt_value['key']] = $cpt_value['label'];
								}else{
									$cpt_text_fields[$cpt_value['key']] = $cpt_value['label'];    
								}
							}
						}
					}
				}
			}
		}
		if ( ! empty( $cpt_text_fields ) ) {
			$fields['text'][] = [
				'group_label'     => esc_html__( 'TotalPress Custom Fields', 'schema-package' ),
				'meta-list' => $cpt_text_fields,
			];
		}

		if ( ! empty( $cpt_file_fields ) ) {
			$fields['image'][] = [
				'group_label'     => esc_html__( 'TotalPress Custom Fields', 'schema-package' ),
				'meta-list' => $cpt_file_fields,
			];
		}
	}

	return $fields;
}