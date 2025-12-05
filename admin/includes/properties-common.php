<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_get_common_properties( $post_id ) {

    return [
        'start_date' => [                        
            'placeholder' => '2025-07-21T19:00-05:00',                    
            'label'       => 'Start Date',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'prev_start_date' => [                        
            'placeholder' => '2025-07-21T23:00-05:00',                    
            'label'       => 'Previous Start Date',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'end_date' => [                        
            'placeholder' => '2025-07-21T23:00-05:00',                    
            'label'       => 'End Date',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'place_name' => [                        
            'placeholder' => 'Snickerpark Stadium',                    
            'label'       => 'Place Name',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',                                            
        ],
        'latitude' => [                        
            'placeholder' => '40.761293',                    
            'label'       => 'GeoCoordinates Latitude',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',                    
        ],
        'longitude' => [                        
            'placeholder' => '-73.982294',                    
            'label'       => 'GeoCoordinates Longitude',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => '',                    
        ],
        'rating_value' => [                        
            'placeholder' => '5',                    
            'label'       => 'Rating Value',
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
            'label'       => 'Rating Count',
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
            'label'       => 'Review Count',
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
            'label'       => 'Best Rating',
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
            'label'       => 'Worst Rating',
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
            'placeholder' => 'Ambiance',                    
            'label'       => 'Review Aspect',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],        
        'street_address' => [                        
            'placeholder' => '555 Clancy St',                    
            'label'       => 'Street Address',
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
            'placeholder' => 'Detroit',                    
            'label'       => 'Address Locality',
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
            'placeholder' => 'MI',                    
            'label'       => 'Address Region',
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
            'label'       => 'Postal Code',
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
            'placeholder' => 'US',                    
            'label'       => 'Address Country',
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
            'placeholder' => 'Enter Name',                    
            'label'       => 'Name',
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Name of the item'        
        ],
        'identifier' => [                        
            'placeholder' => 'Enter Identifier',                    
            'label'       => 'Identifier',
            'type'        => 'text',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Identifier of the item'        
        ],
        'alternate_name' => [                        
            'placeholder' => 'Enter Alternate Name',                    
            'label'       => 'Alternate Name ',
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Alternate Name of the item or person'
        ],
        'price_range' => [
            'placeholder' => '$$$',                    
            'label'       => 'Price Range',                    
            'type'        => 'text',                                                
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Price Range of an item'        
        ],
        'email' => [
            'placeholder' => 'Enter Email',
            'label'       => 'Email',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Email of the Person'        
        ],
        'telephone'          => [
            'label'       => 'Telephone',                    
            'type'        => 'text',                                    
            'placeholder' => '+14088717984',                    
            'value'       => '',
            'display'     => true
        ],
        'job_title' => [                        
            'placeholder' => 'Enter Job Title',                    
            'label'       => 'Job Title',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Job Title of the item'
        ],
        'title' => [                        
            'placeholder' => 'Enter Title',                    
            'label'       => 'Title',
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Title of the item'        
        ],
        'video_name' => [                        
            'placeholder' => 'Enter Name',                    
            'label'       => 'Name',
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Name of the item'        
        ],               
        'id' => [                        
            'placeholder' => 'https://example.com/blog/post_name/#schema_type',
            'label'       => 'ID',
            'type'        => 'text',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Globally unique identifier (IRI/URL) that you assign to a particular entity.'        
        ],
        'headline' => [                        
            'placeholder' => 'Headline',                    
            'label'       => 'Headline',
            'type'        => 'text',
            'value'       => smpg_get_the_title( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Headline of the article.'        
        ],
        'description' => [                        
            'placeholder' => 'Description',                    
            'label'       => 'Description',                    
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'A description of the item.'
        ],
        'review_body' => [                        
            'placeholder' => 'Review Body Text',                    
            'label'       => 'Review Body',                    
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Review body content'
        ],
        'video_description' => [                        
            'placeholder' => 'Description',                    
            'label'       => 'Description',                    
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description( $post_id ),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'A description of the item.'
        ],
        'keywords' => [                        
            'placeholder' => 'tag1, tag2, tag3',                    
            'label'       => 'Keywords',                    
            'type'        => 'text',
            'value'       => smpg_get_post_tags($post_id),
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Keywords or tags used to describe this content. Multiple entries in a keywords list are typically delimited by commas.'
        ],
        'word_count' => [                        
            'placeholder' => '300',                    
            'label'       => 'Word Count (Opt.)',                    
            'type'        => 'number',
            'value'       => smpg_get_word_count($post_id),
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'The number of words in the text of the Article.'
        ],
        'article_section' => [                        
            'placeholder' => 'Sports, Lifestyle',                    
            'label'       => 'Article Section (Opt.)',                    
            'type'        => 'text',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Articles may belong to one or more \'sections\' in a magazine or newspaper, such as Sports, Lifestyle, etc.'
        ],
        'url' => [                        
            'placeholder' => 'https://example.com/post-name',                    
            'label'       => 'URL',                    
            'type'        => 'text',
            'value'       => smpg_get_permalink($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'URL of the item.'
        ],
        'in_language' => [                        
            'placeholder' => 'en',                    
            'label'       => 'In Language',                    
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_inlanguage($post_id),
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'The language of the content or performance or used in an action'
        ],                
        'date_published' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => 'Date Published',                    
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Date of first broadcast/publication.'
        ],
        'date_posted' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => 'Date Posted',                    
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Date of first broadcast/publication.'
        ],
        'valid_through' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => 'Valid Through',                    
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Date of first broadcast/publication.'
        ],
        'valid_from' => [                        
            'placeholder' => '2015-02-05T08:00:00+08:00',                    
            'label'       => 'Valid From',                    
            'type'        => 'text',
            'value'       => smpg_get_published_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Date of first broadcast/publication.'
        ],
        'date_modified' => [                        
            'placeholder' => '2015-02-05T09:20:00+08:00',                    
            'label'       => 'Date Modified',                    
            'type'        => 'text',
            'value'       => smpg_get_modified_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The date on which the article was most recently modified'
        ],
        'date_created' => [                        
            'placeholder' => '2015-02-05T09:20:00+08:00',                    
            'label'       => 'Date Created',                    
            'type'        => 'text',
            'value'       => smpg_get_modified_date($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The date on which things created'
        ],
        'author_type' => [                                     
            'label'       => 'Author Type',                    
            'type'        => 'select',
            'value'       => 'Person',
            'options'      => [
                ''                 => 'Select',
                'Person'           => 'Person',
                'Organization'     => 'Organization',                        
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author type of this content',
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => '',
                'child_key' => '@type'
            ]
        ],
        'seller_type' => [                                     
            'label'       => 'Seller Type',
            'type'        => 'select',
            'value'       => 'Person',
            'options'      => [
                ''                 => 'Select',
                'Person'           => 'Person',
                'Organization'     => 'Organization',                        
            ],
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'The seller type for the product'
        ],
        'employment_type' => [                          
            'label'       => 'Employment Type',                    
            'type'        => 'groups',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Employment types',
            'elements'      => [
                'full_time' => [                                                                                                                                              
                    'label'       => 'Full Time',                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'part_time' => [                                                                                                                                              
                    'label'       => 'Part Time',                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'contractor' => [                                                                                                                                              
                    'label'       => 'Contractor',                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'temporary' => [                                                                                                                                              
                    'label'       => 'Temporary',                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'intern' => [                                                                                                                                              
                    'label'       => 'Intern',                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'volunteer' => [
                    'label'       => 'Volunteer',
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'per_diem' => [                                                                                                                                              
                    'label'       => 'Per Diem',                    
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],
                'other' => [                                                                                                                                              
                    'label'       => 'Other',        
                    'type'        => 'checkbox',                                                                                    
                    'value'       => true,
                    'display'     => true
                ],                
            ]            
        ],
        'author_name' => [                                     
            'placeholder' => 'Author Name',                    
            'label'       => 'Author Name',                    
            'type'        => 'text',
            'value'       => '',            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author name of this content',
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => 'Person',
                'child_key' => 'name'
            ]
        ],
        'author_url' => [                                     
            'placeholder' => 'Author URL',                    
            'label'       => 'Author URL',                    
            'type'        => 'text',
            'value'       => '',            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author url of this content',
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => 'Person',
                'child_key' => 'url'
            ]
        ],
        'author_image' => [            
            'label'       => 'Author Image',                    
            'type'        => 'media',
            'multiple'    => false,
            'value'       => [],            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author image of this content',
            'parent_data'   => [
                'key'       => 'author', 
                'type'      => 'Person',
                'child_key' => 'image'
            ]
        ],
        'seller_name' => [                                     
            'placeholder' => 'Seller Name',                    
            'label'       => 'Seller Name',                    
            'type'        => 'text',
            'value'       => '',            
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'The seller name for the product'
        ],
        'publisher_name' => [                        
            'placeholder' => 'Publisher Name',                    
            'label'       => 'Publisher Name',                    
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The publisher of the creative work.',
            'parent_data'   => [
                'key'       => 'publisher', 
                'type'      => 'Organization',
                'child_key' => 'name'
            ]
        ],
        'publisher_logo' => [                                            
            'label'       => 'Logo',                    
            'type'        => 'media',
            'multiple'    => false,
            'value'       => [],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'An associated logo.',
            'parent_data'   => [
                'key'       => 'publisher', 
                'type'      => 'Organization',
                'child_key' => 'logo'
            ]
        ],
        'image' => [                                                      
            'label'       => 'Image',                    
            'type'        => 'media',
            'multiple'    => true,
            'value'       => [],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'An image of the item. This can be a URL or a fully described ImageObject.'
        ],
        'operating_system' => [                        
            'placeholder' => 'ANDROID',                    
            'label'       => 'Operating System',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''
        ],
        'application_category' => [                                                    
            'label'       => 'Category',                    
            'type'        => 'select',
            'value'       => '',
            'options'      => [
                'GameApplication'               => 'GameApplication',
                'SocialNetworkingApplication'   => 'SocialNetworkingApplication',
                'TravelApplication'             => 'TravelApplication',
                'ShoppingApplication'           => 'ShoppingApplication',                         
                'SportsApplication'             => 'SportsApplication',
                'LifestyleApplication'          => 'LifestyleApplication',
                'BusinessApplication'           => 'BusinessApplication',
                'DesignApplication'             => 'DesignApplication',                         
                'DeveloperApplication'          => 'DeveloperApplication',
                'DriverApplication'             => 'DriverApplication',
                'EducationalApplication'        => 'EducationalApplication',
                'HealthApplication'             => 'HealthApplication',                         
                'FinanceApplication'            => 'FinanceApplication',
                'SecurityApplication'           => 'SecurityApplication',
                'BrowserApplication'            => 'BrowserApplication',
                'CommunicationApplication'      => 'CommunicationApplication',                                 
                'DesktopEnhancementApplication' => 'DesktopEnhancementApplication', 
                'EntertainmentApplication'      => 'EntertainmentApplication', 
                'MultimediaApplication'         => 'MultimediaApplication', 
                'HomeApplication'               => 'HomeApplication', 
                'UtilitiesApplication'          => 'UtilitiesApplication', 
                'ReferenceApplication'          => 'ReferenceApplication', 
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''
        ],
        'offer_type' => [                                    
            'label'       => 'Offer Type',
            'type'        => 'select',
            'value'       => 'Offer',
            'options'     => [
                ''               => 'Select',
                'Offer'          => 'Offer',
                'AggregateOffer' => 'AggregateOffer'
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_category' => [
            'label'       => 'Offer Category',
            'type'        => 'select',
            'value'       => 'Free',
            'options'     => [
                ''               => 'Select',
                'Free'           => 'Free',
                'Paid'           => 'Paid',
                'Partially Free' => 'Partially Free',
                'Subscription'   => 'Subscription',                
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_url' => [                        
            'placeholder' => 'https://example.com/anvil',                    
            'label'       => 'Offer URL',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_currency' => [                        
            'placeholder' => 'USD',                    
            'label'       => 'Offer Currency',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'high_price' => [                        
            'placeholder' => '25.36',                    
            'label'       => 'High Price',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'low_price' => [                        
            'placeholder' => '12.36',                    
            'label'       => 'Low Price',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'offer_count' => [                        
            'placeholder' => '2',                    
            'label'       => 'Offer Count',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'follow_count' => [                        
            'placeholder' => '2',                    
            'label'       => 'Follow Count',
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Number of times the profile has been followed'        
        ],
        'like_count' => [                        
            'placeholder' => '2',                    
            'label'       => 'Like Count',
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Number of likes received'        
        ],
        'comment_count' => [                        
            'placeholder' => '10',                    
            'label'       => 'Comment Count',
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Number of comments'        
        ],
        'share_count' => [                        
            'placeholder' => '5',                    
            'label'       => 'Share Count',
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Number of times the profile has been shared'        
        ],
        'post_count' => [                        
            'placeholder' => '100',                    
            'label'       => 'Post Count',
            'type'        => 'number',
            'value'       => '',
            'recommended' => false,
            'display'     => true,
            'tooltip'     => 'Number of posts/articles written by the profile owner'        
        ],
        'offer_price' => [                        
            'placeholder' => '119.99',                    
            'label'       => 'Offer Price',
            'type'        => 'number',
            'value'       => '0',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_price_validuntil' => [                        
            'placeholder' => '2023-11-20',                    
            'label'       => 'Price ValidUntil',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'sku' => [                        
            'placeholder' => '0446310786',                    
            'label'       => 'SKU',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'mpn' => [                        
            'placeholder' => '925872',                    
            'label'       => 'MPN',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'brand' => [                        
            'placeholder' => 'ACME',                    
            'label'       => 'Brand',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'offer_item_condition' => [                                                                        
            'label'       => 'Item Condition',
            'type'        => 'select',
            'options'      => [
                     ''                                             => 'Select',
                     'https://schema.org/NewCondition'              => 'New',
                     'https://schema.org/UsedCondition'             => 'Used',
                     'https://schema.org/RefurbishedCondition'      => 'Refurbished',
                     'https://schema.org/DamagedCondition'          => 'Damaged',                         
            ],
            'value'       => 'https://schema.org/NewCondition',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],        
        'offer_availability' => [                                                       
            'label'       => 'Availability',
            'type'        => 'select',
            'value'       => 'https://schema.org/InStock',
            'options'      => [
                ''                                        => 'Select',
                'https://schema.org/InStock'              => 'InStock',
                'https://schema.org/OutOfStock'           => 'OutOfStock',
                'https://schema.org/SoldOut'              => 'SoldOut',    
                'https://schema.org/BackOrder'            => 'BackOrder',
                'https://schema.org/Discontinued'         => 'Discontinued',                
                'https://schema.org/InStoreOnly'          => 'InStoreOnly',                         
                'https://schema.org/LimitedAvailability'  => 'LimitedAvailability',
                'https://schema.org/OnlineOnly'           => 'OnlineOnly',                
                'https://schema.org/PreOrder'             => 'PreOrder',                         
                'https://schema.org/PreSale'              => 'PreSale'                            
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'question' => [                                                                                                                                                      
            'label'       => 'Question',                    
            'type'        => 'text',
            'placeholder' => 'Enter your question',
            'display'     => true,                    
            'value'       => ''
        ],                                                        
        'answer' => [                                                               
            'label'       => 'Answer',                    
            'type'        => 'textarea',
            'placeholder' => 'Enter your Answer',
            'display'     => true,                    
            'value'       => ''
        ],
        'e_cost_currency' => [                        
            'placeholder' => 'USD',                    
            'label'       => 'Estimated Cost Currency',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],        
        'e_cost_value' => [                        
            'placeholder' => '100',                    
            'label'       => 'Estimated Cost Value',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'days_needed' => [                        
            'placeholder' => 'DD',                    
            'label'       => 'Days Needed',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'hours_needed' => [                        
            'placeholder' => 'HH',                    
            'label'       => 'Hours Needed',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],         
        'minutes_needed' => [                        
            'placeholder' => 'MM',                    
            'label'       => 'Minutes Needed',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],                
        'content_url' => [                                                                                                                                              
            'label'       => 'Content URL',                    
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'placeholder' => 'https://www.example.com/video/how-to-tie-a-tie/file.mp4',                    
            'value'       => '',
            'display'     => true,
        ],
        'embed_url' => [                                                                                                                                              
            'label'       => 'Embed URL',                    
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'placeholder' => 'https://www.example.com/embed/how-to-tie-a-tie',                    
            'value'       => '',
            'display'     => true,
        ],
        'upload_date' => [                                                                                                                                              
            'label'       => 'Upload Date',                    
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'placeholder' => '2019-02-28T08:00:00+08:00',                    
            'value'       => '',
            'display'     => true,
        ],
        'hours' => [                                                                                                                                              
            'label'       => 'Hours',                    
            'type'        => 'number',
            'class'       => ['smpg_common_properties'],
            'placeholder' => 2,                    
            'value'       => '',
            'display'     => true,
        ],
        'minutes' => [                                                                                                                                              
            'label'       => 'Minutes',                    
            'type'        => 'number',
            'class'       => ['smpg_common_properties'],
            'placeholder' => 30,                    
            'value'       => '',
            'display'     => true,
        ],
        'seconds' => [                                                                                                                                              
            'label'       => 'Seconds',                    
            'type'        => 'number',
            'class'       => ['smpg_common_properties'],
            'placeholder' => 55,                    
            'value'       => '',
            'display'     => true,
        ],
        'speakable' => [                                                                                                                                              
            'label'       => 'Speakable',                    
            'type'        => 'checkbox',                             
            'value'       => false,
            'display'     => true,
        ],
        'speakable_selectors' => [                                                                                                                                              
            'label'       => 'Speakable Selectors',                    
            'type'        => 'textarea',                             
            'value'       => '',
            'placeholder' => 'title, *description, #elementid, .elementclass',
            'tooltip'     => 'Separate selectors with comma ( , ).',
            'display'     => false,
        ],
        'is_paywalled' => [                                                                                                                                              
            'label'       => 'Is Paywalled Content ?',                    
            'type'        => 'checkbox',                             
            'value'       => false,
            'display'     => true,
        ],
        'paywalled_selectors' => [                                                                                                                                              
            'label'       => 'Paywalled Content Selectors',                    
            'type'        => 'textarea',                             
            'value'       => '',
            'placeholder' => '.section1, .section2',
            'tooltip'     => 'Separate selectors with comma ( , ).',
            'display'     => false,
        ],
        'include_video' => [                                                                                                                                              
            'label'       => 'Include Video',                    
            'type'        => 'checkbox',                             
            'value'       => false,                        
            'display'     => true,
        ]
    ];
}
