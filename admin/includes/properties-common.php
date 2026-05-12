<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_get_common_properties( $post_id ) {

    return [
        'start_date' => [                        
            'placeholder' => '2025-07-21T19:00-05:00', 
            'label'       => esc_html__( 'Start Date', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'prev_start_date' => [                        
            'placeholder' => '2025-07-21T23:00-05:00',
			'label'       => esc_html__( 'Previous Start Date', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'end_date' => [                        
            'placeholder' => '2025-07-21T23:00-05:00',
			'label'       => esc_html__( 'End Date', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'place_name' => [                        
            'placeholder' => esc_attr__( 'Snickerpark Stadium', 'schema-package' ),
			'label'       => esc_html__( 'Place Name', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',                                            
        ],
        'latitude' => [                        
            'placeholder' => '40.761293',
			'label'       => esc_html__( 'GeoCoordinates Latitude', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',                    
        ],
        'longitude' => [                        
            'placeholder' => '-73.982294',
			'label'       => esc_html__( 'GeoCoordinates Longitude', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',                    
        ],
        'rating_value' => [                        
            'placeholder' => '5',
			'label'       => esc_html__( 'Rating Value', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data' => [
                'key'       => 'aggregateRating', 
                'type'      => 'AggregateRating',
                'child_key' => 'ratingValue',
            ]       
        ],
        'rating_count' => [                        
            'placeholder' => '100',
			'label'       => esc_html__( 'Rating Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data' => [
                'key'       => 'aggregateRating', 
                'type'      => 'AggregateRating',
                'child_key' => 'ratingCount',
            ]        
        ],
        'review_count' => [                        
            'placeholder' => '100',                    
            'label'       => esc_html__( 'Review Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data' => [
                'key'       => 'aggregateRating', 
                'type'      => 'AggregateRating',
                'child_key' => 'reviewCount',
            ]        
        ],
        'best_rating' => [                        
            'placeholder' => '5',                    
            'label'       => esc_html__( 'Best Rating', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data' => [
                'key'       => 'aggregateRating', 
                'type'      => 'AggregateRating',
                'child_key' => 'bestRating',
            ]        
        ],
        'worst_rating' => [             
            'placeholder' => '0',                    
            'label'       => esc_html__( 'Worst Rating', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data' => [
                'key'       => 'aggregateRating', 
                'type'      => 'AggregateRating',
                'child_key' => 'worstRating',
            ]        
        ],        
        'review_aspect' => [                        
            'placeholder' => esc_attr__( 'Ambiance', 'schema-package' ),                    
            'label'       => esc_html__( 'Review Aspect', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],        
        'street_address' => [                        
            'placeholder' => esc_attr__( '555 Clancy St', 'schema-package' ),                    
            'label'       => esc_html__( 'Street Address', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data'   => [
                'key'       => 'address', 
                'type'      => 'PostalAddress',
                'child_key' => 'streetAddress'
            ]                                
        ],
        'address_locality' => [                        
            'placeholder' => esc_attr__( 'Detroit', 'schema-package' ),                    
            'label'       => esc_html__( 'Address Locality', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',        
            'parent_data'   => [
                'key'       => 'address', 
                'type'      => 'PostalAddress',
                'child_key' => 'addressLocality'
            ]
        ],
        'address_region' => [                        
            'placeholder' => esc_attr__( 'MI', 'schema-package' ),                    
            'label'       => esc_html__( 'Address Region', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data'   => [
                'key'       => 'address', 
                'type'      => 'PostalAddress',
                'child_key' => 'addressRegion'
            ]        
        ],
        'postal_code' => [                        
            'placeholder' => '48201',                    
            'label'       => esc_html__( 'Postal Code', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data'   => [
                'key'       => 'address', 
                'type'      => 'PostalAddress',
                'child_key' => 'postalCode'
            ]        
        ],
        'address_country' => [                        
            'placeholder' => esc_attr__( 'US', 'schema-package' ),                    
            'label'       => esc_html__( 'Address Country', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',
            'parent_data'   => [
                'key'       => 'address', 
                'type'      => 'PostalAddress',
                'child_key' => 'addressCountry'
            ]        
        ],
        'name' => [                        
            'placeholder' => esc_attr__( 'Enter Name', 'schema-package' ),                    
            'label'       => esc_html__( 'Name', 'schema-package' ),
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Name of the item', 'schema-package' )        
        ],
        'identifier' => [                        
            'placeholder' => esc_attr__( 'Enter Identifier', 'schema-package' ),                    
            'label'       => esc_html__( 'Identifier', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Identifier of the item', 'schema-package' )        
        ],
        'alternate_name' => [                        
            'placeholder' => esc_attr__( 'Enter Alternate Name', 'schema-package' ),                    
            'label'       => esc_html__( 'Alternate Name ', 'schema-package' ),
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Alternate Name of the item or person', 'schema-package' )
        ],
        'price_range' => [
            'placeholder' => '$$$',                    
            'label'       => esc_html__( 'Price Range', 'schema-package' ),                     
            'type'        => 'text',                                                
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Price Range of an item', 'schema-package' )        
        ],
        'email' => [
            'placeholder' => esc_attr__( 'Enter Email', 'schema-package' ),
            'label'       => esc_html__( 'Email', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Email of the Person'        
        ],
        'telephone'          => [
            'placeholder' => '+14088717984',                    
            'label'       => esc_html__( 'Telephone', 'schema-package' ),                                       
            'type'        => 'text',                                                                    
            'value'       => '',
            'display'     => true
        ],
        'job_title' => [                        
            'placeholder' => esc_attr__( 'Enter Job Title', 'schema-package' ),                    
            'label'       => esc_html__( 'Job Title', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Job Title of the item'
        ],
        'title' => [                        
            'placeholder' => esc_attr__( 'Enter Title', 'schema-package' ),                    
            'label'       => esc_html__( 'Title', 'schema-package' ),
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Title of the item', 'schema-package' )             
        ],
        'video_name' => [                        
            'placeholder' => esc_attr__( 'Enter Name', 'schema-package' ),                    
            'label'       => esc_html__( 'Name', 'schema-package' ),
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Name of the item', 'schema-package' )
        ],               
        'id' => [                        
            'placeholder' => 'https://example.com/blog/post_name/#schema_type',
            'label'       => esc_html__( 'ID', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Globally unique identifier (IRI/URL) that you assign to a particular entity.', 'schema-package' )        
        ],
        'headline' => [                        
            'placeholder' => esc_attr__( 'Headline', 'schema-package' ),                    
            'label'       => esc_html__( 'Headline', 'schema-package' ),
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Headline of the article.', 'schema-package' )              
        ],
        'description' => [                        
            'placeholder' => esc_attr__( 'Description', 'schema-package' ),                    
            'label'       => esc_html__( 'Description', 'schema-package' ),                     
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'A description of the item.', 'schema-package' )
        ],
        'review_body' => [                        
            'placeholder' => esc_attr__( 'Review Body Text', 'schema-package' ),                    
            'label'       => esc_html__( 'Review Body', 'schema-package' ),                     
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Review body content', 'schema-package' )
        ],
        'video_description' => [                        
            'placeholder' => esc_attr__( 'Description', 'schema-package' ),                    
            'label'       => esc_html__( 'Description', 'schema-package' ),                     
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'A description of the item.', 'schema-package' )
        ],
        'keywords' => [                        
            'placeholder' => esc_attr__( 'tag1, tag2, tag3', 'schema-package' ),                    
            'label'       => esc_html__( 'Keywords', 'schema-package' ), 
            'type'        => 'text',
            'value'       => smpg_get_post_tags($post_id),
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Keywords or tags used to describe this content. Multiple entries in a keywords list are typically delimited by commas.', 'schema-package' )
        ],
        'word_count' => [                        
            'placeholder' => '300',                    
            'label'       => esc_html__( 'Word Count (Opt.)', 'schema-package' ),                     
            'type'        => 'number',
            'value'       => smpg_get_word_count($post_id),
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'The number of words in the text of the Article.', 'schema-package' )
        ],
        'article_section' => [                        
            'placeholder' => esc_attr__( 'Sports, Lifestyle', 'schema-package' ),                    
            'label'       => esc_html__( 'Article Section (Opt.)', 'schema-package' ),                     
            'type'        => 'text',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Articles may belong to one or more sections in a magazine or newspaper, such as Sports, Lifestyle, etc.', 'schema-package' )
        ],
        'article_body' => [                        
            'placeholder' => esc_attr__( 'The full description of the post', 'schema-package' ),                    
            'label'       => esc_html__( 'Article Body (Opt.)', 'schema-package' ),                     
            'type'        => 'textarea',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'The body of the article.', 'schema-package' )
        ],
        'url' => [                        
            'placeholder' => 'https://example.com/post-name',                    
            'label'       => esc_html__( 'URL', 'schema-package' ),                    
            'type'        => 'text',
            'value'       => smpg_get_permalink($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'URL of the item.', 'schema-package' )
        ],
        'in_language' => [                        
            'placeholder' => esc_attr__( 'en', 'schema-package' ),                    
            'label'       => esc_html__( 'In Language', 'schema-package' ),                     
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_inlanguage($post_id),
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'The language of the content or performance or used in an action', 'schema-package' )
        ],                
        'date_published' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => esc_html__( 'Date Published', 'schema-package' ),                     
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Date of first broadcast/publication.', 'schema-package' )
        ],
        'date_posted' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => esc_html__( 'Date Posted', 'schema-package' ),                     
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Date of first broadcast/publication.', 'schema-package' )
        ],
        'valid_through' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => esc_html__( 'Valid Through', 'schema-package' ),                     
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Date of first broadcast/publication.', 'schema-package' )
        ],
        'valid_from' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => esc_html__( 'Valid From', 'schema-package' ),                
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Date of first broadcast/publication.', 'schema-package' )
        ],
        'date_modified' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => esc_html__( 'Date Modified', 'schema-package' ),                   
            'type'        => 'text',
            'value'       => smpg_get_modified_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The date on which the article was most recently modified', 'schema-package' )
        ],
        'date_created' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => esc_html__( 'Date Created', 'schema-package' ),                    
            'type'        => 'text',
            'value'       => smpg_get_modified_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The date on which things created', 'schema-package' )
        ],
        'author_type' => [                                     
            'label'       => esc_html__( 'Author Type', 'schema-package' ),                                    
            'type'        => 'select',
            'value'       => 'Person',
            'options'      => [
                ''             => esc_html__( 'Select', 'schema-package' ),
                'Person'       => esc_html__( 'Person', 'schema-package' ),
                'Organization' => esc_html__( 'Organization', 'schema-package' ),                        
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The author type of this content', 'schema-package' ),
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => '',
                'child_key' => '@type'
            ]
        ],
        'seller_type' => [                                     
            'label'       => esc_html__( 'Seller Type', 'schema-package' ),
            'type'        => 'select',
            'value'       => 'Person',
            'options'      => [
                ''             => esc_html__( 'Select', 'schema-package' ),
                'Person'       => esc_html__( 'Person', 'schema-package' ),
                'Organization' => esc_html__( 'Organization', 'schema-package' ),                        
            ],
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'The seller type for the product', 'schema-package' )
        ],
        'employment_type' => [                          
            'label'       => esc_html__( 'Employment Type', 'schema-package' ),                                       
            'type'        => 'groups',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'Employment types', 'schema-package' ),
            'elements'      => [
                'full_time' => [                                                                                                                                              
                    'label'   => esc_html__( 'Full Time', 'schema-package' ),                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'part_time' => [                                                                                                                                              
                    'label'       => esc_html__( 'Part Time', 'schema-package' ),                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'contractor' => [                                                                                                                                              
                    'label'       => esc_html__( 'Contractor', 'schema-package' ),                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'temporary' => [                                                                                                                                              
                    'label'       => esc_html__( 'Temporary', 'schema-package' ),                  
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'intern' => [                                                                                                                                              
                    'label'       => esc_html__( 'Intern', 'schema-package' ),                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'volunteer' => [
                    'label'       => esc_html__( 'Volunteer', 'schema-package' ),
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'per_diem' => [                                                                                                                                              
                    'label'       => esc_html__( 'Per Diem', 'schema-package' ),                   
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'other' => [                                                                                                                                              
                    'label'       => esc_html__( 'Other', 'schema-package' ),   
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],                
            ]            
        ],
        'author_name' => [                                     
            'placeholder' => esc_attr__( 'Author Name', 'schema-package' ),
            'label'       => esc_html__( 'Author Name', 'schema-package' ),                  
            'type'        => 'text',
            'value'       => '',            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The author name of this content', 'schema-package' ),
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => 'Person',
                'child_key' => 'name'
            ]
        ],
        'author_url' => [                                     
            'placeholder' => esc_attr__( 'Author URL', 'schema-package' ),
            'label'       => esc_html__( 'Author URL', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The author url of this content', 'schema-package' ),
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => 'Person',
                'child_key' => 'url'
            ]
        ],
        'author_image' => [            
            'label'       => esc_html__( 'Author Image', 'schema-package' ),                   
            'type'        => 'media',
            'multiple'    => false,
            'value'       => [],            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The author image of this content', 'schema-package' ),
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => 'Person',
                'child_key' => 'image'
            ]
        ],
        'seller_name' => [                                     
            'placeholder' => esc_attr__( 'Seller Name', 'schema-package' ),
            'label'       => esc_html__( 'Seller Name', 'schema-package' ),                  
            'type'        => 'text',
            'value'       => '',            
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'The seller name for the product', 'schema-package' )
        ],
        'publisher_name' => [                        
            'placeholder' => esc_attr__( 'Publisher Name', 'schema-package' ),
            'label'       => esc_html__( 'Publisher Name', 'schema-package' ),                  
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'The publisher of the creative work.', 'schema-package' ),
            'parent_data'   => [
                'key'       => 'publisher', 
                'type'      => 'Organization',
                'child_key' => 'name'
            ]
        ],
        'publisher_logo' => [                                            
            'label'       => esc_html__( 'Logo', 'schema-package' ),                 
            'type'        => 'media',
            'multiple'    => false,
            'value'       => [],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'An associated logo.', 'schema-package' ),
            'parent_data'   => [
                'key'       => 'publisher', 
                'type'      => 'Organization',
                'child_key' => 'logo'
            ]
        ],
        'image' => [                                                      
            'label'       => esc_html__( 'Image', 'schema-package' ),                                   
            'type'        => 'media',
            'multiple'    => true,
            'value'       => [],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => esc_html__( 'An image of the item. This can be a URL or a fully described ImageObject.', 'schema-package' )
        ],
        'operating_system' => [                        
            'placeholder' => esc_attr__( 'ANDROID', 'schema-package' ),                    
            'label'       => esc_html__( 'Operating System', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''
        ],
        'application_category' => [                                                    
            'label'       => esc_html__( 'Category', 'schema-package' ),                                        
            'type'        => 'select',
            'value'       => '',
            'options'      => [
                'GameApplication'               => esc_html__( 'GameApplication', 'schema-package' ),
                'SocialNetworkingApplication'   => esc_html__( 'SocialNetworkingApplication', 'schema-package' ),
                'TravelApplication'             => esc_html__( 'TravelApplication', 'schema-package' ),
                'ShoppingApplication'           => esc_html__( 'ShoppingApplication', 'schema-package' ),
                'SportsApplication'             => esc_html__( 'SportsApplication', 'schema-package' ),
                'LifestyleApplication'          => esc_html__( 'LifestyleApplication', 'schema-package' ),
                'BusinessApplication'           => esc_html__( 'BusinessApplication', 'schema-package' ),
                'DesignApplication'             => esc_html__( 'DesignApplication', 'schema-package' ),
                'DeveloperApplication'          => esc_html__( 'DeveloperApplication', 'schema-package' ),
                'DriverApplication'             => esc_html__( 'DriverApplication', 'schema-package' ),
                'EducationalApplication'        => esc_html__( 'EducationalApplication', 'schema-package' ),
                'HealthApplication'             => esc_html__( 'HealthApplication', 'schema-package' ),
                'FinanceApplication'            => esc_html__( 'FinanceApplication', 'schema-package' ),
                'SecurityApplication'           => esc_html__( 'SecurityApplication', 'schema-package' ),
                'BrowserApplication'            => esc_html__( 'BrowserApplication', 'schema-package' ),
                'CommunicationApplication'      => esc_html__( 'CommunicationApplication', 'schema-package' ),
                'DesktopEnhancementApplication' => esc_html__( 'DesktopEnhancementApplication', 'schema-package' ),
                'EntertainmentApplication'      => esc_html__( 'EntertainmentApplication', 'schema-package' ),
                'MultimediaApplication'         => esc_html__( 'MultimediaApplication', 'schema-package' ),
                'HomeApplication'               => esc_html__( 'HomeApplication', 'schema-package' ),
                'UtilitiesApplication'          => esc_html__( 'UtilitiesApplication', 'schema-package' ),
                'ReferenceApplication'          => esc_html__( 'ReferenceApplication', 'schema-package' ),
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''
        ],
        'offer_type' => [                                    
            'label'       => esc_html__( 'Offer Type', 'schema-package' ),
            'type'        => 'select',
            'value'       => 'Offer',
            'options'     => [
                ''               => esc_html__( 'Select', 'schema-package' ),
                'Offer'          => esc_html__( 'Offer', 'schema-package' ),
                'AggregateOffer' => esc_html__( 'AggregateOffer', 'schema-package' )
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_category' => [
            'label'       => esc_html__( 'Offer Category', 'schema-package' ),
            'type'        => 'select',
            'value'       => 'Free',
            'options'     => [
                 ''              => esc_html__( 'Select', 'schema-package' ),
                'Free'           => esc_html__( 'Free', 'schema-package' ),
                'Paid'           => esc_html__( 'Paid', 'schema-package' ),
                'Partially Free' => esc_html__( 'Partially Free', 'schema-package' ),
                'Subscription'   => esc_html__( 'Subscription', 'schema-package' ),                
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_url' => [                        
            'placeholder' => 'https://example.com/anvil',                    
            'label'       => esc_html__( 'Offer URL', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_currency' => [                        
            'placeholder' => esc_attr__( 'USD', 'schema-package' ),                    
            'label'       => esc_html__( 'Offer Currency', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'high_price' => [                        
            'placeholder' => '25.36',                    
            'label'       => esc_html__( 'High Price', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'low_price' => [                        
            'placeholder' => '12.36',                    
            'label'       => esc_html__( 'Low Price', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'offer_count' => [                        
            'placeholder' => '2',                    
            'label'       => esc_html__( 'Offer Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'follow_count' => [                        
            'placeholder' => '2',                    
            'label'       => esc_html__( 'Follow Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Number of times the profile has been followed', 'schema-package' )               
        ],
        'like_count' => [                        
            'placeholder' => '2',                    
            'label'       => esc_html__( 'Like Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Number of likes received', 'schema-package' )        
        ],
        'comment_count' => [                        
            'placeholder' => '10',                    
            'label'       => esc_html__( 'Comment Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Number of comments', 'schema-package' )             
        ],
        'share_count' => [                        
            'placeholder' => '5',                    
            'label'       => esc_html__( 'Share Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Number of times the profile has been shared', 'schema-package' )        
        ],
        'post_count' => [                        
            'placeholder' => '100',                    
            'label'       => esc_html__( 'Post Count', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => esc_html__( 'Number of posts/articles written by the profile owner', 'schema-package' )        
        ],
        'offer_price' => [                        
            'placeholder' => '119.99',                    
            'label'       => esc_html__( 'Offer Price', 'schema-package' ),
            'type'        => 'number',
            'value'       => '0',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_price_validuntil' => [                        
            'placeholder' => '2023-11-20',                    
            'label'       => esc_html__( 'Price ValidUntil', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'sku' => [                        
            'placeholder' => '0446310786',                    
            'label'       => esc_html__( 'SKU', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'mpn' => [                        
            'placeholder' => '925872',                    
            'label'       => esc_html__( 'MPN', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'brand' => [                        
            'placeholder' => esc_attr__( 'ACME', 'schema-package' ),                    
            'label'       => esc_html__( 'Brand', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_item_condition' => [                                                                        
            'label'       => esc_html__( 'Item Condition', 'schema-package' ),
            'type'        => 'select',
            'options'      => [
                     ''                                             => esc_html__( 'Select', 'schema-package' ),
                     'https://schema.org/NewCondition'              => esc_html__( 'New', 'schema-package' ),
                     'https://schema.org/UsedCondition'             => esc_html__( 'Used', 'schema-package' ),
                     'https://schema.org/RefurbishedCondition'      => esc_html__( 'Refurbished', 'schema-package' ),
                     'https://schema.org/DamagedCondition'          => esc_html__( 'Damaged', 'schema-package' ),
            ],
            'value'       => 'https://schema.org/NewCondition',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],        
        'offer_availability' => [                                                       
            'label'       => esc_html__( 'Availability', 'schema-package' ),
            'type'        => 'select',
            'value'       => 'https://schema.org/InStock',
            'options'      => [
                ''                                        => esc_html__( 'Select', 'schema-package' ),
                'https://schema.org/InStock'              => esc_html__( 'InStock', 'schema-package' ),
                'https://schema.org/OutOfStock'           => esc_html__( 'OutOfStock', 'schema-package' ),
                'https://schema.org/SoldOut'              => esc_html__( 'SoldOut', 'schema-package' ),    
                'https://schema.org/BackOrder'            => esc_html__( 'BackOrder', 'schema-package' ),
                'https://schema.org/Discontinued'         => esc_html__( 'Discontinued', 'schema-package' ),                
                'https://schema.org/InStoreOnly'          => esc_html__( 'InStoreOnly', 'schema-package' ),                         
                'https://schema.org/LimitedAvailability'  => esc_html__( 'LimitedAvailability', 'schema-package' ),
                'https://schema.org/OnlineOnly'           => esc_html__( 'OnlineOnly', 'schema-package' ),                
                'https://schema.org/PreOrder'             => esc_html__( 'PreOrder', 'schema-package' ),                         
                'https://schema.org/PreSale'              => esc_html__( 'PreSale', 'schema-package' ),                             
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'question' => [             
            'placeholder' => esc_attr__( 'Enter your question', 'schema-package' ),                                                                                                                                         
            'label'       => esc_html__( 'Question', 'schema-package' ),                                 
            'type'        => 'text',            
            'display'     => true,                    
            'value'       => ''
        ],                                                        
        'answer' => [                                             
            'placeholder' => esc_attr__( 'Enter your answer', 'schema-package' ),                  
            'label'       => esc_html__( 'Answer', 'schema-package' ),                                   
            'type'        => 'textarea',            
            'display'     => true,                    
            'value'       => ''
        ],
        'e_cost_currency' => [                        
            'placeholder' => esc_attr__( 'USD', 'schema-package' ),                    
            'label'       => esc_html__( 'Estimated Cost Currency', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],        
        'e_cost_value' => [                        
            'placeholder' => '100',                    
            'label'       => esc_html__( 'Estimated Cost Value', 'schema-package' ),
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'days_needed' => [                        
            'placeholder' => esc_attr__( 'DD', 'schema-package' ),                    
            'label'       => esc_html__( 'Days Needed', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'hours_needed' => [                        
            'placeholder' => esc_attr__( 'HH', 'schema-package' ),                    
            'label'       => esc_html__( 'Hours Needed', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],         
        'minutes_needed' => [                        
            'placeholder' => esc_attr__( 'MM', 'schema-package' ),                    
            'label'       => esc_html__( 'Minutes Needed', 'schema-package' ),
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],                
        'content_url' => [                              
            'placeholder' => 'https://www.example.com/video/how-to-tie-a-tie/file.mp4',                                                                                                                                    
            'label'       => esc_html__( 'Content URL', 'schema-package' ),                              
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],            
            'value'       => '',
            'display'     => true,
        ],
        'embed_url' => [                                
            'placeholder' => 'https://www.example.com/embed/how-to-tie-a-tie',                                                                                                                                  
            'label'       => esc_html__( 'Embed URL', 'schema-package' ),                                     
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],            
            'value'       => '',
            'display'     => true,
        ],
        'upload_date' => [                              
            'placeholder' => '2019-02-28T08:00:00+08:00',                                                                                                                                    
            'label'       => esc_html__( 'Upload Date', 'schema-package' ),                                    
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],            
            'value'       => '',
            'display'     => true,
        ],
        'hours' => [                                    
            'placeholder' => '2',
            'label'       => esc_html__( 'Hours', 'schema-package' ),                     
            'type'        => 'number',
            'class'       => ['smpg_common_properties'],            
            'value'       => '',
            'display'     => true,
        ],
        'minutes' => [                                  
            'placeholder' => '30',
            'label'       => esc_html__( 'Minutes', 'schema-package' ),                    
            'type'        => 'number',
            'class'       => ['smpg_common_properties'],             
            'value'       => '',
            'display'     => true,
        ],
        'seconds' => [                                  
            'placeholder' => '55',
            'label'       => esc_html__( 'Seconds', 'schema-package' ),                    
            'type'        => 'number',
            'class'       => ['smpg_common_properties'],             
            'value'       => '',
            'display'     => true,
        ],
        'speakable' => [                                                                                                                                              
            'label'       => esc_html__( 'Speakable', 'schema-package' ),                                        
            'type'        => 'checkbox',                             
            'value'       => false,
            'display'     => true,
        ],
        'speakable_selectors' => [                                                                                                                                              
            'placeholder' => esc_attr__( 'title, *description, #elementid, .elementclass', 'schema-package' ),
            'label'       => esc_html__( 'Speakable Selectors', 'schema-package' ),                   
            'type'        => 'textarea',                             
            'value'       => '',            
            'tooltip'     => esc_html__( 'Separate selectors with comma ( , ).', 'schema-package' ),
            'display'     => false,
        ],
        'is_paywalled' => [                                                                                                                                              
            'label'       => esc_html__( 'Is Paywalled Content ?', 'schema-package' ),                                       
            'type'        => 'checkbox',                             
            'value'       => false,
            'display'     => true,
        ],
        'paywalled_selectors' => [                                                                                                                                              
            'placeholder' => esc_attr__( '.section1, .section2', 'schema-package' ),
            'label'       => esc_html__( 'Paywalled Content Selectors', 'schema-package' ),                   
            'type'        => 'textarea',                             
            'value'       => '',            
            'tooltip'     => esc_html__( 'Separate selectors with comma ( , ).', 'schema-package' ),
            'display'     => false,
        ],
        'include_video' => [                                                                                                                                              
            'label'       => esc_html__( 'Include Video', 'schema-package' ),                                       
            'type'        => 'checkbox',                             
            'value'       => false,                        
            'display'     => true,
        ],
        'opening_hours' => [                            
                'label'         => esc_html__( 'Opening Hours', 'schema-package' ),    
                'button_text'   => esc_html__( 'Add More Opening Hours', 'schema-package' ), 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'monday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Monday', 'schema-package' ),                                      
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'tuesday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Tuesday', 'schema-package' ),                                      
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'wednesday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Wednesday', 'schema-package' ),                                       
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'thursday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Thursday', 'schema-package' ),                                        
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'friday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Friday', 'schema-package' ),                                        
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'saturday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Saturday', 'schema-package' ),                                       
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'sunday' => [                                                                                                                                              
                            'label'       => esc_html__( 'Sunday', 'schema-package' ),                                        
                            'type'        => 'checkbox',                                                                                    
                            'value'       => false,
                            'display'     => true
                        ],
                        'opens' => [                                                                                                                                              
                            'label'       => esc_html__( 'Opens', 'schema-package' ),                                       
                            'type'        => 'text',                                    
                            'placeholder' => '09:00',                    
                            'value'       => '',
                            'display'     => true
                        ],
                        'closes' => [                                                                                                                                              
                            'label'       => esc_html__( 'Closes', 'schema-package' ),                                        
                            'type'        => 'text',                                    
                            'placeholder' => '19:00',                    
                            'value'       => '',
                            'display'     => true
                        ],                                          
                    ]
                ]                                                                                                                      
            ]
    ];
}