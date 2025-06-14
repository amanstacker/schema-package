<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// MasterStudy LMS WordPress Plugin – for Online Courses and Education

add_filter( 'smpg_filter_course_json_ld', 'smpg_masterstudy_singular_automation',10,3 );

function smpg_masterstudy_singular_automation( $json_ld, $schema_data, $post_id ) {

    global $smpg_plugin_list;

    if ( ! empty( $schema_data['_automation_with'][0] ) ) {

        $automation = unserialize( $schema_data['_automation_with'][0] );

        if ( in_array( "masterstudy", $automation ) && isset( $smpg_plugin_list['masterstudy']['is_active'] ) ) {

            $json_ld = smpg_get_masterstudy_json_ld( $json_ld, $post_id );
                                
        }

    }

    return $json_ld;
}

function smpg_get_masterstudy_json_ld( $json_ld, $post_id ) {

    $reviews = [];

    $stm_reviews = get_posts( [
                            'post_type' 	     => 'stm-reviews', 
                            'posts_per_page'     => -1,   
                            'post_status'        => 'publish',
                    ] );
        
    if ( $stm_reviews ) {
        
        foreach ( $stm_reviews as $key => $value ) {
            
		    $mark   = get_post_meta( $value->ID, 'review_mark', true );
		    $user   = get_post_meta( $value->ID, 'review_user', true );
            $user_data  = get_user_by( 'id', $user );

            if ( is_wp_error( $user_data ) ) {
                continue;
            }            

            $reviews[] = [
                '@type' => 'Review',
                'reviewRating' => [
                    '@type'         => 'Rating',
                    'ratingValue'   => $mark,                    
                ],
                'author' => [
                    '@type'         => 'Person',
                    'name'          => $user_data->data->display_name,                    
                ],
                'reviewBody' => $value->post_content
            ];
        }
    }                

    if ( $reviews ) {

        $reviews_avg = get_post_meta( $post_id, 'course_mark_average', true );        

        $json_ld['review'] = $reviews;
        $json_ld['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingValue' => $reviews_avg,
            'reviewCount' => count( $reviews ),
        ];

    }

    return $json_ld;
}

add_filter('smpg_filter_product_json_ld', 'smpg_review_automation',10,3);
add_filter('smpg_filter_review_json_ld', 'smpg_review_automation',10,3);

function smpg_review_automation( $json_ld, $schema_data, $post_id ){

    global $smpg_plugin_list;

    if(!empty($schema_data['_automation_with'][0])){

        $automation = unserialize($schema_data['_automation_with'][0]);

        if ( in_array("absolutereviews", $automation) && isset($smpg_plugin_list['absolutereviews']['is_active']) ){

            $json_ld = smpg_get_absolutereviews_json_ld($json_ld, $post_id);
                                
        }

    }

    return $json_ld;
}

function smpg_get_absolutereviews_json_ld( $json_ld, $post_id ) {

        $abr_settings        = get_post_meta( $post_id, '_abr_review_settings', true );

        if ( ! empty( $abr_settings ) ) {

            $score_number        = get_post_meta( $post_id, '_abr_review_total_score_number', true );
            $review_type         = get_post_meta( $post_id, '_abr_review_type', true );
            $item_reviewed       = get_post_meta( $post_id, '_abr_review_schema_heading', true );
            $review_body         = get_post_meta( $post_id, '_abr_review_schema_desc', true );
            $author_type         = get_post_meta( $post_id, '_abr_review_schema_author', true );        
            $review_author       = get_post_meta( $post_id, '_abr_review_schema_author_custom', true );        

            $best_rating         = 5;
        
                switch ( $review_type ) {
                    case 'percentage':
                        $best_rating = 100;
                        break;
                    case 'point-5':
                        $best_rating = 5;
                        break;
                    case 'point-10':
                        $best_rating = 10;
                        break;
                    case 'star':
                        $best_rating = 5;
                        break;
            }
        

            if ( $json_ld['@type'] == 'Product' ) {

                    $json_ld['review']['@type']                       = 'Review';                 
                    $json_ld['review']['datePublished']               = smpg_get_published_date();

                    if ( $author_type == 'custom' && $review_author ) {
                                                                            
                        $json_ld['review']['author']['@type']      = 'Person';
                        $json_ld['review']['author']['name']       = $review_author;     

                    }else{
                        $json_ld['review']['author']                      = smpg_get_author_detail(); 
                    }                

                    if ( $review_body ) {
                        $json_ld['review']['reviewBody'] = $review_body;
                    }

                    $json_ld['review']['reviewRating']['@type']       =      'Rating';
                    $json_ld['review']['reviewRating']['ratingValue'] =      $score_number;            
                    $json_ld['review']['reviewRating']['bestRating']  =      $best_rating;
                    $json_ld['review']['reviewRating']['worstRating'] =      0;
                
            }

            if ( $json_ld['@type'] == 'Review' ) {

                if ( $item_reviewed ) {            
                    $json_ld['itemReviewed']['name'] = $item_reviewed;
                }
                if ( $review_body ) {
                    $json_ld['reviewBody'] = $review_body;
                }
                
                if ( $author_type == 'custom' && $review_author ) {
                    unset($json_ld['author']);
                    $json_ld['author']['@type']  = 'Person';
                    $json_ld['author']['name']   = $review_author;     
                }
                
                if ( ! empty( $abr_settings ) ) {
        
                    $json_ld['reviewRating']['@type']       =      'Rating';
                    $json_ld['reviewRating']['ratingValue'] =      $score_number;            
                    $json_ld['reviewRating']['bestRating']  =      $best_rating;
                    $json_ld['reviewRating']['worstRating'] =      0;
        
                }

            }        
                                 
            return $json_ld;

        }else{
            return [];
        }        
}

add_filter('smpg_filter_jobposting_json_ld', 'smpg_jobposting_automation',10,3);

function smpg_jobposting_automation( $json_ld, $schema_data, $post_id ){

    global $smpg_plugin_list;

    if(!empty($schema_data['_automation_with'][0])){

        $automation = unserialize($schema_data['_automation_with'][0]);

        if ( in_array("simplejobboard", $automation) && isset($smpg_plugin_list['simplejobboard']['is_active']) ){

            $json_ld = smpg_get_simplejobboard_json_ld($json_ld, $post_id);
                                
        }

    }

    return $json_ld;
}

function smpg_get_simplejobboard_json_ld( $json_ld, $post_id ){

        $json_ld['title']            = smpg_get_the_title();
        $json_ld['description']      = smpg_get_description();
                        
        $job_category                = get_the_terms( $post_id, 'jobpost_category' );
        $job_type                    = get_the_terms( $post_id, 'jobpost_job_type' );
        $job_location                = get_the_terms( $post_id, 'jobpost_location' );

        if($job_type){

            $job_type_arr = [];

            foreach ($job_type as $value) {
                $job_type_arr[] = $value->name; 
            }

            $json_ld['employmentType']   = $job_type_arr;

        }
        
        if($job_location){

            $vanues_arr = [];

            foreach ($job_location as $value) {

                $vanue_meta = get_term_meta($value->term_id, '', true);
                
                $vanues_arr[] = [
                    '@type' => 'Place',
                    'name'  => $value->name,
                    'address' => [
                        '@type'           => 'PostalAddress',
                        'streetAddress'   => $value->name,                        
                    ]
                    
                ];

            }

            $json_ld['jobLocation'] = $vanues_arr;

        }
        
        unset($json_ld['baseSalary']);
        unset($json_ld['estimatedSalary']);

    return $json_ld;
}

add_filter('smpg_filter_book_json_ld', 'smpg_book_automation',10,3);

function smpg_book_automation( $json_ld, $schema_data, $post_id ){

    global $smpg_plugin_list;

    if(!empty($schema_data['_automation_with'][0])){

        $automation = unserialize($schema_data['_automation_with'][0]);
        
        if ( in_array("mooberrybookmanager", $automation) && isset($smpg_plugin_list['mooberrybookmanager']['is_active']) ){

            $json_ld = smpg_get_mooberrybookmanager_json_ld($json_ld, $post_id);
                                
        }

    }

    return $json_ld;
}
/*
Compatibility with Mooberry Book Manager
Plugin URL : https://wordpress.org/plugins/mooberry-book-manager/
*/
function smpg_get_mooberrybookmanager_json_ld( $json_ld, $post_id ){

        global $wpdb;

        if ( get_post_type() != 'mbdb_book' ) {

            return $json_ld;

        }

        $tags    =  wp_get_post_terms( $post_id , 'mbdb_tag');
        $tag_str = '';    

        if ( ! is_wp_error( $tags ) ) {
        
            if(count($tags)>0){
                                                
                foreach ($tags as $tag) {
                    
                    $tag_str .= $tag->name.', '; 
                
                } 
                
            }

        }

        $genres     =  wp_get_post_terms( $post_id , 'mbdb_genre');
        $genres_str = '';      
        if(!is_wp_error($genres)){
        
            if(count($genres)>0){
                                                
                foreach ($genres as $genre) {
                    
                    $genres_str .= $genre->name.', '; 
                
                } 
                
            }

        }

        $illustrators     =  wp_get_post_terms( $post_id , 'mbdb_illustrator');
        $illustrator_arr  = [];

        if(!is_wp_error($illustrators)){
        
            if(count($illustrators)>0){
                                                
                foreach ($illustrators as $illu) {
                    
                    $illustrator_arr[] = [
                        '@type' => 'Person',
                        'name'  => $illu->name,
                    ];
                
                } 
                
            }

        }

        $editors       =  wp_get_post_terms( $post_id , 'mbdb_editor');
        $editors_arr  = [];

        if(!is_wp_error($editors)){
        
            if(count($editors)>0){
                                                
                foreach ($editors as $editor) {
                    
                    $editors_arr[] = [
                        '@type' => 'Person',
                        'name'  => $editor->name,
                    ];
                
                } 
                
            }

        }

        $editions = get_post_meta($post_id, '_mbdb_editions', true);   
        
        $editions_arr = [];

        $format = [ 'Hardcover', 'Paperback', 'ePub', 'Kindle', 'PDF', 'Audiobook' ];

        if ( ! empty( $editions ) ) {

            foreach ($editions as $value) {

                $editions_arr[] = [
                    '@type'         => 'Book',
                    'isbn'          => !empty($value['_mbdb_isbn']) ? $value['_mbdb_isbn'] : '' ,
                    'bookEdition'   => !empty($value['_mbdb_edition_title']) ? $value['_mbdb_edition_title'] : '',
                    'bookFormat'    => $format[$value['_mbdb_format']],
                    'inLanguage'    => !empty($value['_mbdb_language']) ? $value['_mbdb_language'] : '',
                    'numberOfPages' => !empty($value['_mbdb_length']) ? $value['_mbdb_length'] : '',
                    'offers'      => [
                                        '@type'         => 'Offer',
                                        'price'         => !empty($value['_mbdb_retail_price']) ? $value['_mbdb_retail_price'] : '',
                                        'priceCurrency' => !empty($value['_mbdb_currency']) ? $value['_mbdb_currency'] : ''
                    ],
                ];                    
            }
        }
        
        $publisher = [];
        $imprint   = [];
        $cache_key  = 'smpg_mbdb_books_cache_key_'.trim( $post_id );
        $book_table = wp_cache_get( $cache_key );  

        if ( false === $book_table ) {
            // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Reason: Custom table wp_mbdb_books
            $book_table = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}mbdb_books WHERE book_id = %d",trim($post_id)), 'ARRAY_A');  
            wp_cache_set( $cache_key, $book_table );

        }        
        
        if ( ! empty( $book_table ) ) {
        // Option key mbdb_options used to fetch options from Mooberry Book Manager plugin. We are not modifying its option here.   
        $mbdb_options   = get_option('mbdb_options');                        

        if(!empty($mbdb_options['publishers'])){

            foreach ($mbdb_options['publishers'] as $value) {

                if($value['uniqueID'] == $book_table['publisher_id']){
                    $publisher['@type'] = 'Organization';
                    $publisher['name']  = $value['name'];
                    $publisher['url']   = $value['website'];
                    break;
                }

            }

        }

        if(!empty($mbdb_options['imprints'])){

            foreach ($mbdb_options['imprints'] as $value) {

                if($value['uniqueID'] == $book_table['imprint_id']){
                    $imprint['@type'] = 'Organization';
                    $imprint['name']  = $value['name'];
                    $imprint['url']   = $value['website'];
                    break;
                }

            }

        }

        }
                        
        $json_ld['headline']                 = smpg_get_the_title();
        $json_ld['alternativeHeadline']      = $book_table['subtitle'];
        $json_ld['description']              = $book_table['summary'];               
        $json_ld['genre']                    = $genres_str;
        $json_ld['keywords']                 = $tag_str; 
        $json_ld['illustrator']              = $illustrator_arr; 
        $json_ld['editor']                   = $editors_arr;   
        $json_ld['author']                   = smpg_get_author_detail();         
        $json_ld['datePublished']            = get_the_date("c");   
        $json_ld['dateModified']             = get_the_modified_date("c"); 

        if(!empty($editions_arr)){
            $json_ld['workExample']   = $editions_arr; 
        }

        if(!empty($publisher)){
            $json_ld['publisher']            = $publisher;   
        }
        if(!empty($imprint)){
            $json_ld['publisherImprint']     = $imprint;   
        }

    return $json_ld;
}

add_filter('smpg_filter_faqpage_json_ld', 'smpg_faqpage_automation',10,3);

function smpg_faqpage_automation( $json_ld, $schema_data, $post_id ){

    global $smpg_plugin_list;

    if(!empty($schema_data['_automation_with'][0])){

        $automation = unserialize($schema_data['_automation_with'][0]);

        if ( in_array("accordionfaq", $automation) && isset($smpg_plugin_list['accordionfaq']['is_active']) ){

            $json_ld = smpg_get_accordionfaq_json_ld($json_ld, $post_id);
                                
        }
        
        if ( in_array("accordion", $automation) && isset($smpg_plugin_list['accordion']['is_active']) ){

            $json_ld = smpg_get_accordion_json_ld($json_ld, $post_id);
                                
        }
        
        if ( in_array("quickandeasyfaq", $automation) && isset($smpg_plugin_list['quickandeasyfaq']['is_active']) ){

            $json_ld = smpg_get_quickandeasyfaq_json_ld( $json_ld, $post_id );
                             
        }
        
        if ( in_array("easyaccordion", $automation) && isset($smpg_plugin_list['easyaccordion']['is_active']) ){

            $json_ld = smpg_get_easyaccordion_json_ld( $json_ld, $post_id );
                                
        }

        if ( in_array("wpresponsivefaq", $automation) && isset($smpg_plugin_list['wpresponsivefaq']['is_active']) ){

            $json_ld = smpg_get_wpresponsivefaq_json_ld( $json_ld, $post_id );
                                
        }

        if ( in_array("arconixfaq", $automation) && isset($smpg_plugin_list['arconixfaq']['is_active']) ){

            $json_ld = smpg_get_arconixfaq_json_ld( $json_ld, $post_id );
                                
        }
                                

    }    

    return $json_ld;
}

function smpg_get_arconixfaq_json_ld( $json_ld, $post_id ){

    $faq_data = [];

    $content = get_post_field('post_content', $post_id);

    $shortcode_attr = smpg_extract_shortcode_attrs('faq', $content);

    if(!empty($shortcode_attr) && is_array($shortcode_attr)){

        foreach ($shortcode_attr as $atts) {
                        
            if ( isset( $atts['showposts'] ) ) {
                if ( 'all' !== $atts['showposts'] && $atts['showposts'] > 0 ) {
                    $atts['posts_per_page'] = $atts['showposts'];
                }
            }

            
            $query  = [
                'p'              => '',
                'order'          => 'ASC',
                'orderby'        => 'title',
                'skip_group'     => false,
                'style'          => 'toggle',
                'posts_per_page' => -1,
                'nopaging'       => true,
                'group'          => '',
                'exclude_group'  => '',
                'hide_title'     => false,
            ];
            
            $args = wp_parse_args( $atts, $query );

            $exclude = $args['exclude_group'];

            $terms = get_terms( 'group' );

            $skip_group = $args['skip_group'];

            if ( ! empty( $terms ) && false === $skip_group && empty( $args['p'] ) ) {

                foreach ( $terms as $term ) {

                    // If a user sets a specific group in the params, that's the only one we care about.
                    $group = $args['group'];
                    if ( isset( $group ) && '' !== $group && $term->slug != $group ) {
                        continue;
                    }
    
                    // Set up our standard query args.
                    $query_args = [
                        'post_type'      => 'faq',
                        'order'          => $args['order'],
                        'orderby'        => $args['orderby'],
                        'posts_per_page' => $args['posts_per_page'],
                        'tax_query'      => [ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
                            [
                                'taxonomy' => 'group',
                                'field'    => 'slug',
                                'terms'    => [ $term->slug ],
                                'operator' => 'IN',
                            ],
                        ],
                    ];
    
                    // New query just for the tax term we're looping through.
                    $q = new WP_Query( $query_args );
    
                    if ( $q->have_posts() ) {

                        if ( ! ( $exclude == $term->slug ) ) {
                                
                            // Loop through the rest of the posts for the term.
                            while ( $q->have_posts() ) :

                                $q->the_post();
    
                                $faq_data[] = [
                                    '@type' => 'Question',
                                    'name'  => smpg_get_the_title(),
                                        'acceptedAnswer' => [
                                            '@type' => 'Answer',
                                            'text'  => smpg_get_the_content()
                                        ]
                                ];
    
                            endwhile;
                                
                        }
                    } // end have_posts()
    
                    wp_reset_postdata();
                } // end foreach

                
            }else{

                // Set up our standard query args.
			$q = new WP_Query(
				[
					'post_type'      => 'faq',
					'p'              => $args['p'],
					'order'          => $args['order'],
					'orderby'        => $args['orderby'],
					'posts_per_page' => $args['posts_per_page'],
                ]
			);

			if ( $q->have_posts() ) {
				
				while ( $q->have_posts() ) :

					$q->the_post();

					$faq_data[] = [
                        '@type' => 'Question',
                        'name'  => smpg_get_the_title(),
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => smpg_get_the_content()
                            ]
                    ];

				endwhile;
				
			} // end have_posts()

			wp_reset_postdata();

            }
                      
            
        }

        if($faq_data){
            $json_ld['mainEntity'] = $faq_data;
        }
            
      }

    return $json_ld;
}

function smpg_get_wpresponsivefaq_json_ld( $json_ld, $post_id ){

    $faq_data = [];

    $content = get_post_field('post_content', $post_id);

    $shortcode_attr = smpg_extract_shortcode_attrs('sp_faq', $content);
    
    if(!empty($shortcode_attr) && is_array($shortcode_attr)){
        
        foreach ($shortcode_attr as $atts) {
            
            extract(shortcode_atts([
                "limit"             => '',
                "category"          => '',
                "single_open"       => '',
                "transition_speed"  => '',
            ], $atts));

            // Define limit
            if( $limit ) { 
                $posts_per_page = $limit; 
            } else {
                $posts_per_page = '-1';
            }   
            
            // Define Category
            if( $category ) { 
                $cat = $category; 
            } else {
                $cat = '';
            }
            
            $post_type 		= 'sp_faq';
            $orderby 		= 'post_date';
            $order 			= 'DESC';
             
            $args = [
                'post_type'      => $post_type, 
                'orderby'        => $orderby, 
                'order'          => $order,
                'posts_per_page' => $posts_per_page,           
            ];
            if ( $cat != "" ) {
                //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
                $args['tax_query'] = [ [ 'taxonomy' => 'faq_cat', 'field' => 'term_id', 'terms' => $cat ] ];
            }        
        
            $faq_posts = new \WP_Query( $args );

            if ( $faq_posts->have_posts() ) {
                    
                while ( $faq_posts->have_posts() ) : $faq_posts->the_post();                 
                
                $faq_data[] = [
                        '@type' => 'Question',
                        'name'  => smpg_get_the_title(),
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => smpg_get_the_content()
                            ]
                    ];
                
                endwhile;
                
                wp_reset_postdata();
                
            }

        }

        if($faq_data){
            $json_ld['mainEntity'] = $faq_data;
        }
        
    }

    return $json_ld;
}

function smpg_get_easyaccordion_json_ld( $json_ld, $post_id ){

    $faq_data = [];

    $content = get_post_field('post_content', $post_id);

    $shortcode_attr = smpg_extract_shortcode_attrs('sp_easyaccordion', $content);

    if(!empty($shortcode_attr) && is_array($shortcode_attr)){

        foreach ($shortcode_attr as $value) {
            
            if ( !empty( $value['id'] ) && ( get_post_status( $value['id'] ) === 'publish' ) ) {
                
                $post_id = intval( $value['id'] );

                $shortcode_data        = get_post_meta( $post_id, 'sp_eap_upload_options', true );
                
                if( !empty($shortcode_data) && isset($shortcode_data['accordion_content_source']) ){

                    foreach ($shortcode_data['accordion_content_source'] as $value) {
                        
                        $faq_data[] = [
                            '@type' => 'Question',
                            'name'  => $value['accordion_content_title'],
                                'acceptedAnswer' => [
                                    '@type' => 'Answer',
                                    'text'  => $value['accordion_content_description']
                                ]
                        ];

                    }


                }
                

            }

        }
        
        if($faq_data){
            $json_ld['mainEntity'] = $faq_data;
        }

    }

    return $json_ld;
}

function smpg_get_quickandeasyfaq_json_ld( $json_ld, $post_id ){

    $faq_data = [];

    $content = get_post_field('post_content', $post_id);

    $shortcode_attr = smpg_extract_shortcode_attrs('faqs', $content);
    
    if(!empty($shortcode_attr) && is_array($shortcode_attr)){

        foreach ($shortcode_attr as $value) {
        
            extract(
                shortcode_atts(
                    [
                        'style'   => '',    
                        'filter'  => false,
                        'orderby' => 'date',
                        'order'   => 'DESC',
                    ],
                    $value,
                    'faqs'
                )
            );
    
            // faq groups filter.
            if ( isset( $filter ) && ! empty( $filter ) && 'true' != $filter ) {
                $filter = explode( ',', $filter );
            }

            $query = [
                'post_type'      => 'faq',
                'posts_per_page' => - 1                
            ];

            if ( $filter && ! is_array( $filter ) ) {

                $terms = get_terms(
                    [
                        'taxonomy' => 'faq-group',
                        'fields'   => 'slugs',
                    ]
                );
                //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
                $query['tax_query'] = [
                    [
                        'taxonomy' => 'faq-group',
                        'field'    => 'slug',
                        'terms'    => $terms,
                    ],
                ];

            }

            $faq_posts = new \WP_Query( $query );

            if ( $faq_posts->have_posts() ) {
                    
                while ( $faq_posts->have_posts() ) : $faq_posts->the_post();                 
                
                $faq_data[] = [
                        '@type' => 'Question',
                        'name'  => smpg_get_the_title(),
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => smpg_get_the_content()
                            ]
                    ];
                
                endwhile;
                
                wp_reset_postdata();
                
            }            
            
        }

        if($faq_data){
            $json_ld['mainEntity'] = $faq_data;
        }
            
      }

    return $json_ld;
}

function smpg_get_accordion_json_ld( $json_ld, $post_id ){

    $faq_data = [];

    $content = get_post_field('post_content', $post_id);

    $shortcode_attr = smpg_extract_shortcode_attrs('accordions', $content);
   
    if(!$shortcode_attr){
        $shortcode_attr = smpg_extract_shortcode_attrs('accordions_pplugins', $content);
    }

    if(!empty($shortcode_attr) && is_array($shortcode_attr)){

        foreach ($shortcode_attr as $atts) {
                                                            
            $atts = shortcode_atts( [ 'id' => "" ], $atts );
        
            $post_id = $atts['id'];
            $accordions_options = get_post_meta($post_id,'accordions_options', true);           

            $accordions_content = isset($accordions_options['content']) ? $accordions_options['content'] : [];
            
            if(!empty($accordions_content)){

                foreach ($accordions_content as $value) {
                    
                    $faq_data[] = [
                        '@type' => 'Question',
                        'name'  => $value['header'],
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => $value['body']
                            ]
                    ];

                }

            }
            
        }

        if($faq_data){
            $json_ld['mainEntity'] = $faq_data;
        }
            
      }

    return $json_ld;
}

function smpg_get_accordionfaq_json_ld($json_ld, $post_id){

    $faq_data = [];

    $content = get_post_field('post_content', $post_id);
    
    $shortcode_attr = smpg_extract_shortcode_attrs('WPSM_AC', $content);
    
    if(!empty($shortcode_attr) && is_array($shortcode_attr)){

        foreach ($shortcode_attr as $value) {
            
            $ac_post_type = "responsive_accordion";

            if(isset($value['id'])){

                $query = [  'p' => $value['id'], 'post_type' => $ac_post_type, 'orderby' => 'ASC' ];
                
                $faq_posts = new WP_Query( $query );

                if ( $faq_posts->have_posts() ) {
                        
                    while ( $faq_posts->have_posts() ) : $faq_posts->the_post();    
                    
                    $accordion_data = unserialize(get_post_meta( get_the_ID(), 'wpsm_accordion_data', true));
                    
                    if(!empty($accordion_data) && is_array($accordion_data)){

                            foreach ($accordion_data as $value) {

                                $faq_data[] = [
                                    '@type' => 'Question',
                                    'name'  => $value['accordion_title'],
                                        'acceptedAnswer' => [
                                            '@type' => 'Answer',
                                            'text'  => $value['accordion_desc']
                                        ]
                                ];

                            }

                    }
                                                    
                    endwhile;
                    
                    wp_reset_postdata();
                    
                }


            }
            
        }
        
        if(!empty($faq_data)){
            $json_ld['mainEntity'] = $faq_data;
        }

    }
    
    return $json_ld;
}

add_filter('smpg_filter_product_json_ld', 'smpg_woocommerce_product_singular_automation',10,3);

/* WooCommerce Plugin By Automattic
   Plugin URL : https://wordpress.org/plugins/woocommerce/
*/
function smpg_woocommerce_product_singular_automation( $json_ld, $schema_data, $post_id ){

    global $smpg_plugin_list;
    
    if ( ! empty( $schema_data['_automation_with'][0] ) ) {

        $automation = unserialize($schema_data['_automation_with'][0]);

        if ( in_array("woocommerce", $automation) && isset($smpg_plugin_list['woocommerce']['is_active']) ){
                        
            $product        = wc_get_product($post_id); 

            if ( $product ) {

                $json_ld['name']        = $product->get_title();
                
                if($product->get_attributes()){
                 
                    foreach ($product->get_attributes() as $attribute) {

                        switch (strtolower($attribute['name'])) {

                            case 'isbn':
                                $json_ld['isbn']        =  $attribute['options'][0];   
                                break;

                            case 'mpn':
                                $json_ld['mpn']         =  $attribute['options'][0];   
                                break;  

                            case 'gtin8':
                                $json_ld['gtin8']       =  $attribute['options'][0];   
                                break;

                            case 'gtin12':
                                $json_ld['gtin12']      =  $attribute['options'][0];   
                                break;  

                            case 'gtin13':
                                $json_ld['gtin13']      =  $attribute['options'][0];   
                                break; 

                            case 'brand':
                                $json_ld['brand']['@type'] = 'Brand';
                                $json_ld['brand']['name']  =  $attribute['options'][0];   
                                break;            
                            
                            default:
                                # code...
                                break;
                        }                                                 
                        
                    }
                    
                }

                if($product->get_sku()){
                    $json_ld['sku']  = $product->get_sku();
                }
                
                    $description            = '';     
                if($product->get_description()){
                    $description = $product->get_description();
                }else if($product->get_short_description()){
                    $description = $product->get_short_description();
                }else {
                    $description = $product->get_the_excerpt();
                }                

                $json_ld['description'] = wp_strip_all_tags(strip_shortcodes(do_shortcode($description)));
                
                $simple_price        = 0;
                $currency            = get_option( 'woocommerce_currency' );                                 
                
                if( get_woocommerce_currency() ){
                   $currency = get_woocommerce_currency();     
                }

                if($product->get_price()){
                    $simple_price = $product->get_price();
                }
                if( function_exists('wc_get_price_including_tax')) {
                    $simple_price = wc_get_price_including_tax($product);
                } 
                               
                $sale_date = $product->get_date_on_sale_to();
                                                                
                $json_ld['offers']['@type']           = 'Offer'; 
                $json_ld['offers']['price']           = $simple_price; 

                $json_ld['offers']['priceCurrency']   = $currency; 
                $json_ld['offers']['priceValidUntil'] = $sale_date ? $sale_date->date('Y-m-d G:i:s') : get_the_modified_date("c"); 
                $json_ld['offers']['availability']    = smpg_convert_into_supported_format($product->get_stock_status()); 
                $json_ld['offers']['url']             = smpg_get_permalink($post_id); 

                $image = smpg_get_image();

                if(!empty($image)){                     
                    $json_ld = array_merge($json_ld,$image);                 
                }

                $json_ld = smpg_get_product_automated_brand($json_ld, $post_id, $automation);
                $json_ld = smpg_get_product_automated_reviews($json_ld, $post_id, $automation);
                                        
            }                        
        }        
    }
  
    return $json_ld;
}

function smpg_get_product_automated_brand($json_ld, $post_id, $automation){

    global $smpg_plugin_list;

    if (in_array("pbfwoocommerce", $automation) && isset($smpg_plugin_list['pbfwoocommerce']['is_active']) ){
        
        $result = smpg_get_custom_post_terms($post_id, 'pwb-brand');
        
        if( !empty($result[0]) ){

            $json_ld['brand']['@type']        = 'Brand';
            $json_ld['brand']['name']         = $result[0]['term']['name'];
            $json_ld['brand']['description']  = $result[0]['term']['description'];
            
            $image = smpg_get_post_image_by_id($result[0]['term_meta']['pwb_brand_image'][0]);

            if(!empty($image)){
                $json_ld['brand']['image'] = $image;
            }

        }
        
    }

    if (in_array("yithbrandwoocommerce", $automation) && isset($smpg_plugin_list['yithbrandwoocommerce']['is_active']) ){
        
        $result = smpg_get_custom_post_terms($post_id, 'yith_product_brand');
        
        if( !empty($result[0]) ){

            $json_ld['brand']['@type']        = 'Brand';
            $json_ld['brand']['name']         = $result[0]['term']['name'];
            $json_ld['brand']['description']  = $result[0]['term']['description'];
            
            $image = smpg_get_post_image_by_id($result[0]['term_meta']['thumbnail_id'][0]);

            if(!empty($image)){
                $json_ld['brand']['image'] = $image;
            }
            
        }
        
    }

    if (in_array("brandforwoocommerce", $automation) && isset($smpg_plugin_list['brandforwoocommerce']['is_active']) ){
        
        $result = smpg_get_custom_post_terms($post_id, 'berocket_brand');
        
        if( !empty($result[0]) ){

            $json_ld['brand']['@type']        = 'Brand';
            $json_ld['brand']['name']         = $result[0]['term']['name'];
            $json_ld['brand']['description']  = $result[0]['term']['description'];
            
            if(!empty( $result[0]['term_meta']['brand_image_url'][0] )){
                $json_ld['brand']['image'] = $result[0]['term_meta']['brand_image_url'][0];
            }            
            
        }
        
    }

    return $json_ld;
}

function smpg_get_product_automated_reviews($json_ld, $post_id, $automation){

    global $smpg_plugin_list;
    $reviews_data = [];

        if(get_option( 'woocommerce_enable_review_rating' ) == 'yes'){

            $reviews_data =     smpg_get_post_native_reviews($post_id); 
            
            if(!empty($reviews_data['reviews'])){
                $json_ld['review'] = $reviews_data['reviews'];
            }
            if(!empty($reviews_data['ratings'])){
                $json_ld['AggregateRating'] = $reviews_data['ratings'];
            }
        }
        
        if (in_array("yotposreviews", $automation) && isset($smpg_plugin_list['yotposreviews']['is_active']) ){

            $reviews_data = smpg_get_yotpo_product_reviews($post_id);   
            
            if(!empty($reviews_data['reviews'])){
                $json_ld['review'] = $reviews_data['reviews'];
            }
            if(!empty($reviews_data['ratings'])){
                $json_ld['AggregateRating'] = $reviews_data['ratings'];
            }
        }
        
        if (in_array("ryviu", $automation) && isset($smpg_plugin_list['ryviu']['is_active']) ){

            $reviews_data = smpg_get_ryviu_product_reviews($post_id);  
            
            if(!empty($reviews_data['reviews'])){
                $json_ld['review'] = $reviews_data['reviews'];
            }
            if(!empty($reviews_data['ratings'])){
                $json_ld['AggregateRating'] = $reviews_data['ratings'];
            }
        }
                
    return $json_ld;
}

function smpg_get_yotpo_product_reviews($product_id){
    
    $response      = [];
    $comments      = [];
    $ratings       = [];

    $yotpo_settings = get_option( 'yotpo_settings' );

    if ( isset( $yotpo_settings['app_key'] ) ) {

        $i          = 1;
        $loop_count = 1; 

        do{
            
            $url     = esc_raw_url( 'https://api.yotpo.com/v1/widget/'.$yotpo_settings['app_key'].'/products/'.$product_id.'/reviews.json?per_page=150&page='.$i );
            
            $result  = wp_remote_get( $url );

            if(wp_remote_retrieve_response_code($result) == 200 && wp_remote_retrieve_body($result)){
                
                $reviews = json_decode(wp_remote_retrieve_body($result),true);

                if($reviews['response']['reviews']){
                    
                    if(isset($reviews['response']['bottomline']['total_review'])){

                        $total = $reviews['response']['bottomline']['total_review'];

                        $ratings =  [
                            '@type'         => 'AggregateRating',
                            'ratingValue'	=> $reviews['response']['bottomline']['average_score'],
                            'reviewCount'   => $total
                        ];
                        
                        if ( $total > 150 ) {
                            $loop_count = ceil( $total / 150 );
                        }

                    }
                    
                    foreach ( $reviews['response']['reviews'] as  $value ) {

                        $comments[] = [
                            '@type'         => 'Review',
                            'datePublished' => $value['created_at'],
                            'description'   => wp_strip_all_tags($value['content']),
                            'author'        => [
                                                    '@type' => 'Person',
                                                    'name'  => $value['user']['display_name']                                            
                            ],
                            'reviewRating'  => [
                                    '@type'	        => 'Rating',
                                    'bestRating'	=> '5',
                                    'ratingValue'	=> $value['score'],
                                    'worstRating'	=> '1',
                            ]
                        ];                       

                    }
                    
                }
            }

            $i++;

        } while ($i <= $loop_count);
        
    }

    if ( $comments ) {
        $response = [ 'reviews' => $comments, 'ratings' => $ratings ];
    }
    
    return $response;
}
/*

Function to get ryviu product reviews
Since: 1.0
return array
*/

function smpg_get_ryviu_product_reviews ( $product_id ) {
        
    $shop_url = site_url();
    $shop_url = str_replace( [ 'https://', 'http://' ], '', $shop_url );
    $handle   = get_post_field( 'post_name', get_post() );
    
    $response      = [];
    $comments      = [];
    $ratings       = [];

    if ( ! empty( $shop_url ) ) {

        $i           = 1;
        $loop_count  = 1; 
        $sumofrating = 0;
        $avg_rating  = 1;

        do{
            
            $url  = esc_url_raw( "https://app.ryviu.io/frontend/client/get-more-reviews?domain=". $shop_url );

            $body = [
                "domain" 	    => $shop_url,                
                "handle" 	    => $handle,                
                "page" 		    => $i,
                "product_id"    => $product_id,
                "type"          => "load-more",                
            ];            
            
            $result = wp_remote_post(
                $url, [
                    'headers'   => [ 'Content-Type' => 'application/json' ],
                    'body'       => wp_json_encode( $body ),
                ]
            );
            
            if ( wp_remote_retrieve_response_code( $result ) == 200 && wp_remote_retrieve_body( $result ) ) {
                
                $reviews = json_decode( wp_remote_retrieve_body( $result ), true );
                
                if($reviews['more_reviews']){
                    
                    foreach ($reviews['more_reviews'] as  $value) {

                        $comments[] = [
                            '@type'         => 'Review',
                            'datePublished' => $value['created_at'],
                            'description'   => wp_strip_all_tags($value['body_text']),
                            'author'        => [
                                                    '@type' => 'Person',
                                                    'name'  => $value['author']                                            
                            ],
                            'reviewRating'  => [
                                    '@type'	        => 'Rating',
                                    'bestRating'	=> '5',
                                    'ratingValue'	=> $value['rating'],
                                    'worstRating'	=> '1',
                            ]
                        ];   

                        $sumofrating += $value['rating'];

                    }
                    
                    if( $sumofrating> 0 ){
                       $avg_rating = $sumofrating /  $reviews['total']; 
                    }

                    $ratings =  [
                        '@type'         => 'AggregateRating',
                        'ratingValue'	=> $avg_rating,
                        'reviewCount'   => $reviews['total']
                    ];
                                       
                    if($reviews['total'] > 10){
                        $loop_count = ceil($reviews['total'] / 10);
                    }

                    
                }
            }

            $i++;

        } while ($i <= $loop_count);
        
    }
    
    if($comments){
        $response = [ 'reviews' => $comments, 'ratings' => $ratings ];
    }

    return $response;

}