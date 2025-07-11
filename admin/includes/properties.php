<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_get_schema_properties( $schema_id, $post_id = null, $tag_id = null, $user_id = null ) {
    
    $properties = [];

    $common_properties = [  

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
        ],
        'address_locality' => [                        
            'placeholder' => 'Detroit',                    
            'label'       => 'Address Locality',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'address_region' => [                        
            'placeholder' => 'MI',                    
            'label'       => 'Address Region',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'postal_code' => [                        
            'placeholder' => '48201',                    
            'label'       => 'Postal Code',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'address_country' => [                        
            'placeholder' => 'US',                    
            'label'       => 'Address Country',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
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
            'label'       => 'Images',                    
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

    extract( $common_properties );

    $article_type = [
        'article'                  => 'Article',
        'techarticle'              => 'TechArticle',
        'newsarticle'              => 'NewsArticle',
        'advertisercontentarticle' => 'AdvertiserContentArticle',
        'satiricalarticle'         => 'SatiricalArticle',
        'scholarlyarticle'         => 'ScholarlyArticle',
        'socialmediaposting'       => 'SocialMediaPosting',
        'creativework'             => 'creativework',
    ];
    $service_type = [
            'service'                   => 'Service',
            'broadcastservice'          => 'BroadcastService', 
            'cableorsatelliteservice'   => 'CableOrSatelliteService',  
            'financialproduct'          => 'FinancialProduct',  
            'foodservice'               => 'FoodService',  
            'governmentservice'         => 'GovernmentService',  
            'taxiservice'               => 'TaxiService',  
            'webapi'                    => 'WebAPI',                                                                                
    ];
    $business_type = [
        'localbusiness'            => 'LocalBusiness',
        'store'                    => 'Store', 
        'bakery'                   => 'Bakery',  
        'barorpub'                 => 'BarOrPub',  
        'cafeorcoffeeshop'         => 'CafeOrCoffeeShop',  
        'fastfoodrestaurant'       => 'FastFoodRestaurant',  
        'icecreamshop'             => 'IceCreamShop',  
        'restaurant'               => 'Restaurant',
    ];

    $reviews_elements = [
        'name'                => $name,
        'date_published'      => $date_published,
        'author_name'         => $author_name,
        'review_body'         => $review_body,
        'rating_value'        => $rating_value,
        'best_rating'         => $best_rating,
        'worst_rating'        => $worst_rating,
    ];

    $reviews  =   [                            
                'label'         => 'Reviews',    
                'button_text'   => 'Add More Reviews', 
                'type'          => 'repeater',
                'display'       => true, 
                'elements'      => [ $reviews_elements ]
    ];

    $social_links = [                            
        'label'         => 'Social Links',
        'button_text'   => 'Add More Social Links', 
        'type'          => 'repeater', 
        'display'       => true,
        'elements'      => [
            [
                'url'     => $url,                                            
            ]
        ]                                                                                                                      
    ];

    switch ( $schema_id ) {
        
        case 'article':
        case 'techarticle':
        case 'newsarticle':
        case 'advertisercontentarticle':
        case 'satiricalarticle':
        case 'scholarlyarticle':
        case 'socialmediaposting':
        case 'creativework':
            $properties = [                
                'is_enable'         => true,
                'is_delete_popup'   => false, 
                'is_setup_popup'    => false,
                'has_warning'       => false,
                'id'                => $schema_id,           
                'text'              => $article_type[$schema_id],
                'properties'        => [                    
                    'headline'            => $headline,
                    'description'         => $description,
                    'keywords'            => $keywords,
                    'word_count'          => $word_count,
                    'article_section'     => $article_section,
                    'url'                 => $url,
                    'in_language'         => $in_language,
                    'date_published'      => $date_published,
                    'date_modified'       => $date_modified,
                    'author_type'         => $author_type,
                    'author_name'         => $author_name,
                    'publisher_name'      => $publisher_name,
                    'speakable'           => $speakable,
                    'speakable_selectors' => $speakable_selectors,        
                    'is_paywalled'        => $is_paywalled,
                    'paywalled_selectors' => $paywalled_selectors,
                    'publisher_logo'      => $publisher_logo,
                    'image'               => $image
                ]
            ];
            
            if ( $schema_id == 'creativework' ) {
                unset( $properties['properties']['word_count'] );
                unset( $properties['properties']['article_section'] );
            }

            break;        

        case 'webpage':
            $properties = [                
                'is_enable'         => true,
                'is_delete_popup'   => false, 
                'is_setup_popup'    => false,
                'has_warning'       => false,
                'id'                => 'webpage',
                'text'              => 'WebPage',
                'properties'        => [                    
                    'headline'            => $headline,
                    'description'         => $description,
                    'keywords'            => $keywords,
                    'word_count'          => $word_count,                    
                    'url'                 => $url,
                    'in_language'         => $in_language,
                    'date_published'      => $date_published,
                    'date_modified'       => $date_modified,
                    'author_type'         => $author_type,
                    'author_name'         => $author_name,
                    'publisher_name'      => $publisher_name,                    
                    'publisher_logo'      => $publisher_logo,
                    'image'               => $image
                ]
            ];
            
            if ( $schema_id == 'creativework' ) {
                unset( $properties['properties']['word_count'] );
                unset( $properties['properties']['article_section'] );
            }

            break;        

        case 'qna':

            $qna_answer = [
                'text' => [                                                                                                                                              
                    'label'       => 'Text',                    
                    'type'        => 'textarea',
                    'placeholder' => 'Enter answer text',
                    'display'     => true,                    
                    'value'       => ''
                ],
                'date_created' => $date_created,                
                'vote' => [                                                                                                                                              
                    'label'       => 'Up Vote Count',                    
                    'type'        => 'number',
                    'placeholder' => 1236, 
                    'display'     => true,                   
                    'value'       => ''
                ],
                'url' => [                                                                                                                                              
                    'label'       => 'URL',                    
                    'type'        => 'text',
                    'placeholder' => 'https://example.com/question1#acceptedAnswer',                    
                    'display'     => true,
                    'value'       => ''
                ],
                'author_name' => $author_name                 
            ];

            $properties = [                
                'is_enable'         => true,
                'is_delete_popup'   => false, 
                'is_setup_popup'    => false,
                'has_warning'       => false,
                'id'                => 'qna',
                'text'              => 'Q&A',
                'properties'        => [                     
                    'q_title' => [                                                                                                                                              
                        'label'       => 'Question Title',                    
                        'type'        => 'text',
                        'placeholder' => 'Enter question title',                    
                        'value'       => '',
                        'display'     => true,
                    ],
                    'q_description' => [                                                                                                                                              
                        'label'       => 'Question Description',                    
                        'type'        => 'textarea',
                        'placeholder' => 'Enter question description',                    
                        'value'       => '',
                        'display'     => true,
                    ],
                    'q_up_vote_count' => [                                                                                                                                              
                        'label'       => 'Question Upvote Count',                    
                        'type'        => 'number',
                        'placeholder' => 26,                    
                        'value'       => '',
                        'display'     => true,
                    ],
                    'q_date_created' => [                                                                                                                                              
                        'label'       => 'Question Date Created',                    
                        'type'        => 'text',
                        'placeholder' => '2016-07-23T21:11Z',                    
                        'value'       => '',
                        'display'     => true,
                    ],
                    'author_type' => $author_type,
                    'author_name' => $author_name,  
                    'a_count' => [                                                                                                                                              
                        'label'       => 'Answer Count',                    
                        'type'        => 'number',
                        'placeholder' => 5,                    
                        'value'       => '',
                        'display'     => true,
                    ],
                    'accepted_answers' =>    [                            
                        'label'         => 'Accepted Answers',    
                        'button_text'   => 'Add More Accepted Answer', 
                        'type'          => 'repeater',
                        'display'     => true, 
                        'elements'      => [$qna_answer]
                    ],
                    'suggested_answers' =>    [                            
                        'label'         => 'Suggested Answer',    
                        'button_text'   => 'Add More Suggested Answer', 
                        'type'          => 'repeater',
                        'display'     => true, 
                        'elements'      => [$qna_answer]                                                                                        
                    ]
                ]
            ];
            break;      
        case 'faqpage':
            $properties = [                
                'is_enable'         => true,
                'is_delete_popup'   => false, 
                'is_setup_popup'    => false,
                'has_warning'       => false,
                'id'                => 'faqpage',
                'text'              => 'FAQs',
                'properties'        => [                    
                        'main_entity' =>    [                            
                            'label'         => 'Main Entity',    
                            'button_text'   => 'Add More Faqs', 
                            'type'          => 'repeater',
                            'display'     => true, 
                            'elements'      => [    
                                                    [
                                                        'question' => $question,
                                                        'answer'   => $answer,                                                       
                                                        'image'    => $image,
                                                    ]                                                    
                                                ]
                            ]                                                                                        
                ]
            ];
            break;    

            case 'howto':

                $hours['label']    = 'Duration ( Hours )';
                $minutes['label']  = 'Duration ( minutes )';
                $seconds['label']  = 'Duration ( seconds )';

                $video_name['display']        = false;
                $video_description['display'] = false;
                $content_url['display']       = false;
                $embed_url['display']         = false;
                $upload_date['display']       = false;
                $hours['display']             = false;
                $minutes['display']           = false;
                $seconds['display']           = false;                             

                $properties = [                
                    'is_enable'         => true,
                    'is_delete_popup'   => false, 
                    'is_setup_popup'    => false,
                    'has_warning'       => false,
                    'id'                => 'howto',
                    'text'              => 'HowTo',
                    'properties'        => [ 
                            'name'                => $name,
                            'description'         => $description,                            
                            'e_cost_currency'     => $e_cost_currency,
                            'e_cost_value'        => $e_cost_value,
                            'days_needed'         => $days_needed,
                            'hours_needed'        => $hours_needed,
                            'minutes_needed'      => $minutes_needed,
                            'image'               => $image,
                            'is_paywalled'        => $is_paywalled,
                            'paywalled_selectors' => $paywalled_selectors,
                            'include_video'       => $include_video,                              
                            'video_name'          => $video_name,    
                            'video_description'   => $video_description,                            
                            'content_url'         => $content_url,
                            'embed_url'           => $embed_url,
                            'thumbnail_image'     => [                                                      
                                    'label'       => 'Thumbnail Image',                    
                                    'type'        => 'media',
                                    'class'       => ['smpg_common_properties'],
                                    'multiple'    => false,
                                    'value'       => [],
                                    'recommended' => true,
                                    'display'     => false,
                                    'tooltip'     => 'An image of the item. This can be a URL or a fully described ImageObject.'
                            ],
                            'upload_date'         => $upload_date,
                            'hours'               => $hours,
                            'minutes'             => $minutes,
                            'seconds'             => $seconds,                            
                            'supplies' => [                            
                                'label'         => 'Supplies',    
                                'button_text'   => 'Add More Supply', 
                                'type'          => 'repeater', 
                                'display'     => true,
                                'elements'      => [    
                                                        [
                                                          'name'   => $name,
                                                          'url'   => $url,
                                                          'image' => $image                                                           
                                                        ]
                                                        
                                                    ]
                                ],
                            'tools' => [                                
                                        'label'         => 'Tools',    
                                        'button_text'   => 'Add More Tool', 
                                        'type'          => 'repeater',
                                        'display'     => true, 
                                        'elements'      => [    
                                                    [
                                                          'name'   => $name,
                                                          'url'   => $url,
                                                          'image' => $image                                                           
                                                    ]
                                                    
                                                ]
                                 ],
                            'steps'  =>   [                        
                            'label'         => 'Steps',    
                            'button_text'   => 'Add More Step', 
                            'type'          => 'repeater',
                            'display'     => true, 
                            'elements'      => [    
                                            [
                                                'name'           => $name,
                                                'description'    => $description,                                                                                                
                                                'image'          => $image,
                                                'clip_name'      => [                                                                                                                                              
                                                    'label'       => 'Clip Name',                    
                                                    'type'        => 'text',
                                                    'class'       => ['smpg_common_properties'],
                                                    'placeholder' => 'Name',                    
                                                    'value'       => '',
                                                    'display'     => false
                                                ],
                                                'clip_start_offset'      => [                                                                                                                                              
                                                    'label'       => 'Clip Start Offset',                    
                                                    'type'        => 'number',
                                                    'class'       => ['smpg_common_properties'],
                                                    'placeholder' => '29',                    
                                                    'value'       => '',
                                                    'display'     => false
                                                ],
                                                'clip_end_offset'      => [                                                                                                                                              
                                                    'label'       => 'Clip End Offset',                    
                                                    'type'        => 'number',
                                                    'class'       => ['smpg_common_properties'],
                                                    'placeholder' => '36',                    
                                                    'value'       => '',
                                                    'display'     => false
                                                ],
                                            ]
                                            
                                        ]
                            ]

                    ]
                ];
                break;   
                
                case 'profilepage':

                    $image['label']          = 'Person Image';
                    $name['label']           = 'Person Name';
                    $alternate_name['label'] = 'Person Alternate Name';
                    $description['label']    = 'Person Description';                    
                    $social_links['label']   = 'Person Social Links';

                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'profilepage',           
                        'text'              => 'ProfilePage',
                        'properties'        => [
                            'date_created'     => $date_created,    
                            'date_modified'    => $date_modified,
                            'url'              => $url,
                            'in_language'      => $in_language,
                            'name'             => $name,
                            'alternate_name'   => $alternate_name,
                            'identifier'       => $identifier,
                            'description'      => $description,
                            'image'            => $image,
                            'follow_count'     => $follow_count,                            
                            'like_count'       => $like_count,                            
                            'comment_count'    => $comment_count,
                            'share_count'      => $share_count,
                            'post_count'       => $post_count,
                            'social_links'     => $social_links,
                        ]                      
                    ];                    
                    break;

                case 'book':

                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'book',           
                        'text'              => 'Book',
                        'properties'        => [
                            'name'             => $name,    
                            'description'      => $description,
                            'url'              => $url,
                            'in_language'      => $in_language,
                            'image'            => $image,
                            'author_type'      => $author_type,
                            'author_name'      => $author_name,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo,
                            'rating_value'     => $rating_value,
                            'best_rating'      => $best_rating,
                            'worst_rating'     => $worst_rating,
                            'rating_count'     => $rating_count,
                            'review_count'     => $review_count,                                                                      
                        ]                      
                    ];                    
                    break;

                case 'course':

                    $start_date['label'] = 'Course Schedule Start Date';
                    $end_date['label']   = 'Course Schedule End Date';

                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'course',           
                        'text'              => 'Course',
                        'properties'        => [
                            'name'             => $name,    
                            'description'      => $description,
                            'url'              => $url,                                                                                                                    
                            'image'            => $image,
                            'offer_type'       => $offer_type,                                                   
                            'offer_category'   => $offer_category,
                            'offer_price'      => $offer_price,
                            'low_price'        => $low_price,
                            'high_price'       => $high_price,
                            'offer_count'      => $offer_count,                             
                            'offer_currency'   => $offer_currency,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo,
                            'rating_value'     => $rating_value,
                            'best_rating'      => $best_rating,
                            'worst_rating'     => $worst_rating,
                            'rating_count'     => $rating_count,
                            'review_count'     => $review_count,
                            'has_course_instance' => [
                                'label'         => 'Course Instance',
                                'button_text'   => 'Add More Course Instance', 
                                'type'          => 'repeater', 
                                'display'     => true,
                                'elements'      => [    
                                                        [                                                          
                                                          'course_mode' => [                                                                                                                                              
                                                                'label'       => 'Course Mode',                    
                                                                'type'        => 'select',                                                                                    
                                                                'value'       => '',
                                                                'options'     => [
                                                                        ''           => 'Select',
                                                                        'Online'     => 'Online',
                                                                        'Onsite'     => 'Onsite',
                                                                        'Blended'    => 'Blended',                                                                    
                                                                ],
                                                                'display'     => true
                                                            ],
                                                            'location' => [
                                                                'label'       => 'Location',                    
                                                                'type'        => 'text',                                                                                    
                                                                'value'       => '',
                                                                'placeholder' => 'Example University',  
                                                                'display'     => true
                                                            ],
                                                            'course_workload' => [
                                                                'label'       => 'Course Workload',
                                                                'type'        => 'text',                                                                                    
                                                                'value'       => '',
                                                                'placeholder' => 'PT22H',  
                                                                'display'     => true
                                                            ],
                                                            'repeat_count' => [
                                                                'label'       => 'Course Schedule Repeat Count',
                                                                'type'        => 'text',                                                                                    
                                                                'value'       => '',
                                                                'placeholder' => '6',  
                                                                'display'     => true
                                                            ],
                                                            'repeat_frequency' => [
                                                                'label'       => 'Course Schedule Repeat Frequency',
                                                                'type'        => 'select',                                                                                    
                                                                'value'       => '',
                                                                'options'     => [
                                                                        ''           => 'Select',
                                                                        'Daily'      => 'Daily',
                                                                        'Weekly'     => 'Weekly',
                                                                        'Monthly'    => 'Monthly',                                                                    
                                                                        'Yearly'     => 'Yearly',                                                                    
                                                                ],
                                                                'display'     => true
                                                            ],
                                                            'duration' => [
                                                                'label'       => 'Course Schedule Duration',
                                                                'type'        => 'text',                                                                                    
                                                                'value'       => '',
                                                                'placeholder' => 'PT1H',  
                                                                'display'     => true
                                                            ],                                                           
                                                          'start_date'   => $start_date,
                                                          'end_date'     => $end_date,                                                                                                                    
                                                        ]
                                                        
                                                ]
                                ],    

                        ]                      
                    ];
                    break;
                    case 'jobposting':

                        $social_links['label'] = 'Hiring Organization Social Links';

                        $properties = [
                            'is_enable'         => true,
                            'is_delete_popup'   => false, 
                            'is_setup_popup'    => false,
                            'has_warning'       => false,
                            'id'                => 'jobposting',           
                            'text'              => 'JobPosting',
                            'properties'        => [
                                'title'            => $title,    
                                'description'      => $description,
                                'url'              => $url,
                                'date_posted'      => $date_posted,
                                'valid_through'    => $valid_through,
                                'employment_type'  => $employment_type,
                                'job_location_type'      => [
                                    'label'       => 'JobLocation Type',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'TELECOMMUTE',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'education_requirements'      => [                                                                                                                                              
                                    'label'       => 'Education Requirements',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'bachelor degree',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'experience_requirements'      => [                                                                                                                                              
                                    'label'       => 'Experience Requirements',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => '36',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'identifier_name'      => [                                                                                                                                              
                                    'label'       => 'Identifier Name',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'MagsRUs Wheel Company',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'identifier_value'      => [                                                                                                                                              
                                    'label'       => 'Identifier Value',                    
                                    'type'        => 'number',                                    
                                    'placeholder' => '1234567',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'hiring_org_name'      => [                                                                                                                                              
                                    'label'       => 'Hiring Organization Name',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'MagsRUs Wheel Company',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'social_links'  => $social_links,                                
                                'hiring_org_logo'      => [                                                                                                                                              
                                    'label'       => 'Hiring Organization Logo',                    
                                    'type'        => 'media',                                                                                          
                                    'multiple'    => false,
                                    'value'       => [],
                                    'display'     => true
                                ],
                                'b_salary_currency' => [                                                                                                                                              
                                    'label'       => 'Base Salary Currency',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'USD',                    
                                    'value'       => '',
                                    'display'     => true
                                ],                                
                                'b_salary' => [                                                                                                                                              
                                    'label'       => 'Base Salary',                    
                                    'type'        => 'number',                                    
                                    'placeholder' => '40.00',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'b_salary_min' => [                                                                                                                                              
                                    'label'       => 'Base Salary Minimum',                    
                                    'type'        => 'number',                                    
                                    'placeholder' => '40.00',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'b_salary_max' => [                                                                                                                                              
                                    'label'       => 'Base Salary Maximum',                    
                                    'type'        => 'number',                                    
                                    'placeholder' => '50.00',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'b_salary_unit_text' => [                                                                                                                                              
                                    'label'       => 'Base Salary Unit Text',                    
                                    'type'        => 'select',                                                                                            
                                    'value'       => 'HOUR',
                                    'options'     => [
                                            'HOUR'    => 'HOUR',
                                            'DAY'     => 'DAY',
                                            'WEEK'    => 'WEEK',
                                            'MONTH'   => 'MONTH',
                                            'YEAR'    => 'YEAR'
                                    ],
                                    'display'     => true
                                ],
                                'job_location' => [                            
                                    'label'         => 'Job Location',    
                                    'button_text'   => 'Add More Location', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'street_address'     => $street_address,
                                            'address_locality'   => $address_locality,
                                            'address_region'     => $address_region,
                                            'postal_code'        => $postal_code,
                                            'address_country'    => $address_country
                                         ]
                                    ]                                                                                                                      
                                ],
                                'image'            => $image,                                                            
                            ]                      
                        ];

                    break;  

                    case 'localbusiness':
                    case 'store':
                    case 'bakery':
                    case 'barorpub':
                    case 'cafeorcoffeeshop':
                    case 'fastfoodrestaurant':
                    case 'icecreamshop':
                    case 'restaurant':

                        $properties = [
                            'is_enable'         => true,
                            'is_delete_popup'   => false, 
                            'is_setup_popup'    => false,
                            'has_warning'       => false,
                            'id'                => $schema_id,           
                            'text'              => $business_type[$schema_id],
                            'properties'        => [                                
                                'name'             => $name,    
                                'description'      => $description,
                                'url'              => $url,                                                                                                                    
                                'image'            => $image,
                                'street_address'     => $street_address,
                                'address_locality'   => $address_locality,
                                'address_region'     => $address_region,
                                'postal_code'        => $postal_code,
                                'address_country'    => $address_country,
                                'telephone'          => $telephone,
                                'price_range'        => $price_range,
                                'latitude'           => $latitude,
                                'longitude'          => $longitude,
                                'rating_value'     => $rating_value,
                                'best_rating'      => $best_rating,
                                'worst_rating'     => $worst_rating,
                                'rating_count'     => $rating_count,
                                'review_count'     => $review_count,
                                'opening_hours' => [                            
                                    'label'         => 'Opening Hours',    
                                    'button_text'   => 'Add More Opening Hours', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'monday' => [                                                                                                                                              
                                                'label'       => 'Monday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'tuesday' => [                                                                                                                                              
                                                'label'       => 'Tuesday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'wednesday' => [                                                                                                                                              
                                                'label'       => 'Wednesday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'thursday' => [                                                                                                                                              
                                                'label'       => 'Thursday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'friday' => [                                                                                                                                              
                                                'label'       => 'Friday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'saturday' => [                                                                                                                                              
                                                'label'       => 'Saturday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'sunday' => [                                                                                                                                              
                                                'label'       => 'Sunday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => false,
                                                'display'     => true
                                            ],
                                            'opens' => [                                                                                                                                              
                                                'label'       => 'Opens',                    
                                                'type'        => 'text',                                    
                                                'placeholder' => '09:00',                    
                                                'value'       => '',
                                                'display'     => true
                                            ],
                                            'closes' => [                                                                                                                                              
                                                'label'       => 'Closes',                    
                                                'type'        => 'text',                                    
                                                'placeholder' => '19:00',                    
                                                'value'       => '',
                                                'display'     => true
                                            ],                                          
                                        ]
                                    ]                                                                                                                      
                                ],
                            ]                      
                        ];

                    break;  

                    case 'service':
                    case 'broadcastservice':
                    case 'cableorsatelliteservice':
                    case 'financialproduct':
                    case 'foodservice':
                    case 'governmentservice':
                    case 'taxiservice':
                    case 'webapi':

                        $properties = [
                            'is_enable'         => true,
                            'is_delete_popup'   => false, 
                            'is_setup_popup'    => false,
                            'has_warning'       => false,
                            'id'                => $schema_id,           
                            'text'              => $service_type[$schema_id],
                            'properties'        => [                                
                                'service_type'          => [
                                    'label'       => 'Service Type',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'Weekly home cleaning',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'provider_mobility'          => [
                                    'label'       => 'Provider Mobility',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'e.g. static or dynamic',
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'provider_name'          => [
                                    'label'       => 'Provider Name',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'name',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'provider_url'    => [
                                    'label'       => 'Provider URL',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => smpg_get_permalink($post_id),    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'provider_type' =>  [ 
                                        'label'       => 'Provider Type',
                                        'type'        => 'select',
                                        'value'       => 'LocalBusiness',
                                        'options'     => [
                                                ''                             => 'Select',
                                                'Organization'                 => 'Organization',
                                                'LocalBusiness'                => 'Local Business',
                                                'Airline'                      => 'Airline',
                                                'Corporation'                  => 'Corporation',
                                                'EducationalOrganization'      => 'Educational Organization',
                                                'School'                       => 'School',
                                                'GovernmentOrganization'       => 'Government Organization',                                                
                                                'MedicalOrganization'          => 'Medical Organization',  
                                                'NGO'                          => 'NGO', 
                                                'PerformingGroup'              => 'Performing Group', 
                                                'SportsOrganization'           => 'Sports Organization',
                                        ],
                                        'recommended' => true,
                                        'display'     => true,
                                    'tooltip'     => 'The author type of this content'
                                ],
                                'area_served'          => [
                                    'label'       => 'Area Served',                    
                                    'type'        => 'textarea',                                    
                                    'placeholder' => 'New York, Los Angeles',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'service_offered'          => [
                                    'label'       => 'Service Offered',                    
                                    'type'        => 'textarea',                                    
                                    'placeholder' => 'Apartment light cleaning, carpet cleaning',
                                    'value'       => '',
                                    'display'     => true
                                ],                                
                                'description'        => $description,
                                'url'                => $url,
                                'street_address'     => $street_address,
                                'address_locality'   => $address_locality,
                                'address_region'     => $address_region,
                                'postal_code'        => $postal_code,
                                'address_country'    => $address_country,
                                'telephone'          => $telephone,
                                'price_range'        => $price_range,
                                'brand'                  => $brand,     
                                'offer_type'             => $offer_type,                                                   
                                'offer_price'            => $offer_price,
                                'low_price'              => $low_price,
                                'high_price'             => $high_price,
                                'offer_count'            => $offer_count, 
                                'offer_url'              => $offer_url, 
                                'offer_currency'         => $offer_currency,
                                'offer_price_validuntil' => $offer_price_validuntil,                                                                      
                                'offer_item_condition'   => $offer_item_condition,
                                'offer_availability'     => $offer_availability,                        
                                'eligible_customer_type'   => [
                                    'label'       => 'Eligible Customer Type',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => '40 - 80 Years',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'terms_of_service'          => [
                                    'label'       => 'Terms Of Service',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => 'Minimum Entry Age: 18 years, Maximum Entry Age: 85 years',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'annual_percentage_rate'    => [
                                    'label'       => 'Annual Percentage Rate',
                                    'type'        => 'text',                                    
                                    'placeholder' => '30%',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'interest_rate'          => [
                                    'label'       => 'Interest Rate',
                                    'type'        => 'text',                                    
                                    'placeholder' => '5%',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'fees_And_Commissions_Specification'  => [
                                    'label'       => 'Fees And Commissions Specification',
                                    'type'        => 'text',                                    
                                    'placeholder' => '',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'latitude'           => $latitude,
                                'longitude'          => $longitude,
                                'image'              => $image,
                                'additional_property' => [                            
                                    'label'         => 'Additional Property',    
                                    'button_text'   => 'Add More Properties', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'name' => [                                                                                                                                              
                                                'label'       => 'Name',                    
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',
                                                'display'     => true
                                            ],
                                            'value' => [                                                                                                                                              
                                                'label'       => 'Value',                    
                                                'type'        => 'textarea',                                                                                    
                                                'value'       => '',
                                                'display'     => true
                                            ],                                           
                                        ]
                                    ]                                                                                                                      
                                ],
                                'opening_hours' => [                            
                                    'label'         => 'Opening Hours',    
                                    'button_text'   => 'Add More Opening Hours', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'monday' => [                                                                                                                                              
                                                'label'       => 'Monday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'tuesday' => [                                                                                                                                              
                                                'label'       => 'Tuesday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'wednesday' => [                                                                                                                                              
                                                'label'       => 'Wednesday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'thursday' => [                                                                                                                                              
                                                'label'       => 'Thursday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'friday' => [                                                                                                                                              
                                                'label'       => 'Friday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'saturday' => [                                                                                                                                              
                                                'label'       => 'Saturday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => true,
                                                'display'     => true
                                            ],
                                            'sunday' => [                                                                                                                                              
                                                'label'       => 'Sunday',                    
                                                'type'        => 'checkbox',                                                                                    
                                                'value'       => false,
                                                'display'     => true
                                            ],
                                            'opens' => [                                                                                                                                              
                                                'label'       => 'Opens',                    
                                                'type'        => 'text',                                    
                                                'placeholder' => '09:00',                    
                                                'value'       => '',
                                                'display'     => true
                                            ],
                                            'closes' => [                                                                                                                                              
                                                'label'       => 'Closes',                    
                                                'type'        => 'text',                                    
                                                'placeholder' => '19:00',                    
                                                'value'       => '',
                                                'display'     => true
                                            ],                                          
                                        ]
                                    ]                                                                                                                      
                                ],
                            ]                      
                        ];

                    break;  

                case 'event':

                        $place_name['parent_data'] = [
                            'key'       => 'location', 
                            'type'      => 'Place',
                            'child_key' => 'name'
                        ];
                        $latitude['parent_data'] = [
                            'key'       => 'location.geo', 
                            'type'      => 'Place.GeoCoordinates',
                            'child_key' => 'latitude'
                        ];
                        $longitude['parent_data'] = [
                            'key'       => 'location.geo', 
                            'type'      => 'Place.GeoCoordinates',
                            'child_key' => 'longitude'
                        ];
                        $street_address['parent_data'] = [
                            'key'       => 'location.address', 
                            'type'      => 'Place.PostalAddress',
                            'child_key' => 'streetAddress'
                        ];
                        $properties = [
                            'is_enable'         => true,
                            'is_delete_popup'   => false, 
                            'is_setup_popup'    => false,
                            'has_warning'       => false,
                            'id'                => 'event',           
                            'text'              => 'Event',
                            'properties'        => [
                                'name'             => $name,    
                                'description'      => $description,
                                'url'              => $url,
                                'start_date'       => $start_date,
                                'end_date'         => $end_date,
                                'attendance_mode'      => [                                                                                                                                              
                                    'label'       => 'Attendance Mode',                    
                                    'type'        => 'select',
                                    'options'     => [
                                        'https://schema.org/MixedEventAttendanceMode'   => 'Mixed',
                                        'https://schema.org/OfflineEventAttendanceMode' => 'Offline',
                                        'https://schema.org/OnlineEventAttendanceMode'  => 'Online',                                        
                                    ],                                                                                        
                                    'value'       => 'https://schema.org/OfflineEventAttendanceMode',
                                    'display'     => true
                                ], 
                                'status'      => [                                                                                                                                              
                                    'label'       => 'Status',                    
                                    'type'        => 'select',
                                    'options'     => [
                                        'https://schema.org/EventScheduled'   => 'EventScheduled',
                                        'https://schema.org/EventCancelled'   => 'EventCancelled',
                                        'https://schema.org/EventMovedOnline' => 'EventMovedOnline',
                                        'https://schema.org/EventPostponed'   => 'EventPostponed',
                                        'https://schema.org/EventRescheduled' => 'EventRescheduled'
                                    ],                                                                                        
                                    'value'       => 'https://schema.org/EventScheduled',
                                    'display'     => true
                                ],
                                'v_location' => [
                                    'placeholder' => 'https://operaonline.stream5.com/',                    
                                    'label'       => 'Virtual Location',
                                    'type'        => 'text',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                                ],
                                'place_name'           => $place_name,
                                'street_address'       => $street_address,
                                'address_locality'     => $address_locality,
                                'address_region'       => $address_region,
                                'postal_code'          => $postal_code,
                                'address_country'      => $address_country,
                                'latitude'             => $latitude,
                                'longitude'            => $longitude,
                                'offer_currency'       => $offer_currency,
                                'offer_price'          => $offer_price,
                                'offer_availability'   => $offer_availability,
                                'valid_from'           => $valid_from,                                                                                                         
                                'offer_url'            => [
                                        'placeholder' => 'https://operaonline.stream5.com/',                    
                                        'label'       => 'Offer URL',
                                        'type'        => 'text',
                                        'value'       => '',
                                        'recommended' => true,
                                        'display'     => true,
                                        'tooltip'     => ''    
                                ],
                                'image'                => $image,                                                            
                                'rating_value'     => $rating_value,
                                'best_rating'      => $best_rating,
                                'worst_rating'     => $worst_rating,
                                'rating_count'     => $rating_count,
                                'review_count'     => $review_count,
                                'performer' => [                            
                                    'label'         => 'Performer',    
                                    'button_text'   => 'Add More Performer', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'name'     => $name,                                            
                                        ]
                                    ]                                                                                                                      
                                ],
                                'organizer' => [                            
                                    'label'         => 'Organizer',    
                                    'button_text'   => 'Add More organizer', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'name'     => $name, 
                                            'url'      => $url,                                            
                                        ]
                                    ]                                                                                                                      
                                ],
                            ]                      
                        ];
    
                        break;  

                case 'recipe':

                    $hours['label']    = 'Duration ( Hours )';
                    $minutes['label']  = 'Duration ( minutes )';
                    $seconds['label']  = 'Duration ( seconds )';

                    $video_name['display']        = false;
                    $video_description['display'] = false;
                    $content_url['display']       = false;
                    $embed_url['display']         = false;
                    $upload_date['display']       = false;
                    $hours['display']             = false;
                    $minutes['display']           = false;
                    $seconds['display']           = false;   
                                                                                
                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'recipe',           
                        'text'              => 'Recipe',
                        'properties'        => [
                            'name'             => $name,    
                            'description'      => $description,
                            'url'              => $url,                                                                                    
                            'in_language'      => $in_language,
                            'image'            => $image,     
                            'date_published'   => $date_published,
                            'keywords'         => $keywords,
                            'prep_time'        => [
                                'placeholder' => 'MM',                    
                                'label'       => 'Prepare Time',
                                'type'        => 'number',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'cook_time'        => [
                                    'placeholder' => '20',                    
                                    'label'       => 'Cooking Time',
                                    'type'        => 'number',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                            ],
                            'total_time'        => [
                                    'placeholder' => '30',                    
                                    'label'       => 'Total Time',
                                    'type'        => 'number',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                            ], 
                            'recipe_yield'        => [
                                    'placeholder' => '50',                    
                                    'label'       => 'Number Of Servings',
                                    'type'        => 'number',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                            ], 
                            'recipe_category' => [
                                    'placeholder' => 'Recipe Category',
                                    'label'       => 'Recipe Category',
                                    'type'        => 'text',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                            ],
                            'recipe_cuisine' => [
                                    'placeholder' => 'Recipe Cuisine',                    
                                    'label'       => 'Recipe Cuisine',
                                    'type'        => 'text',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                            ],                            
                            'calories' => [
                                'placeholder' => '240 calories',                    
                                'label'       => 'Calories',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'calories'
                                ]                                
                            ],
                            'carbohydrate' => [
                                'placeholder' => '9 grams carbohydrates',                    
                                'label'       => 'Carbohydrate Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'carbohydrateContent'
                                ]
                            ],
                            'cholesterol' => [
                                'placeholder' => '10 milligrams cholesterol',                    
                                'label'       => 'Cholesterol Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'cholesterolContent'
                                ]
                            ],
                            'fat' => [
                                'placeholder' => '11 grams fat',                    
                                'label'       => 'Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'fatContent'
                                ]
                            ],
                            'fiber' => [
                                'placeholder' => '15 grams fiber',
                                'label'       => 'Fiber Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'fiberContent'
                                ]
                            ],
                            'protein' => [
                                'placeholder' => '10 grams protein',                    
                                'label'       => 'Protein Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'proteinContent'
                                ]
                            ],
                            'saturated_fat' => [
                                'placeholder' => '5 grams saturated fat',                    
                                'label'       => 'Saturated Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'saturatedFatContent'
                                ]
                            ],
                            'sodium' => [
                                'placeholder' => '3 milligrams sodium',                    
                                'label'       => 'Sodium Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'sodiumContent'
                                ]
                            ],
                            'sugar' => [
                                'placeholder' => '15 grams sugar',                    
                                'label'       => 'Sugar Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',                                
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'sugarContent'
                                ]
                            ],
                            'trans_fat' => [
                                'placeholder' => '12 grams trans fat',                    
                                'label'       => 'Trans Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',                                 
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'transFatContent'
                                ]
                            ],
                            'unsaturated_fat' => [
                                'placeholder' => '16 grams unsaturated fat',                    
                                'label'       => 'Unsaturated Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => '',
                                'parent_data'   => [
                                    'key'       => 'nutrition', 
                                    'type'      => 'NutritionInformation',
                                    'child_key' => 'unsaturatedFatContent'
                                ]
                            ],                            
                            'include_video'       => $include_video,                              
                            'video_name'          => $video_name,    
                            'video_description'   => $video_description,                            
                            'content_url'         => $content_url,
                            'embed_url'           => $embed_url,
                            'thumbnail_image'     => [                                                      
                                    'label'       => 'Thumbnail Image',                    
                                    'type'        => 'media',
                                    'class'       => ['smpg_common_properties'],
                                    'multiple'    => false,
                                    'value'       => [],
                                    'recommended' => true,
                                    'display'     => false,
                                    'tooltip'     => 'An image of the item. This can be a URL or a fully described ImageObject.'
                            ],
                            'upload_date'         => $upload_date,
                            'hours'               => $hours,
                            'minutes'             => $minutes,
                            'seconds'             => $seconds,                                                                  
                            'author_type'      => $author_type,
                            'author_name'      => $author_name,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo,
                            'rating_value'     => $rating_value,
                            'best_rating'      => $best_rating,
                            'worst_rating'     => $worst_rating,
                            'rating_count'     => $rating_count,
                            'review_count'     => $review_count,
                            'recipe_ingredient' => [
                                'label'         => 'Recipe Ingredient',
                                'button_text'   => 'Add More Ingredient', 
                                'type'          => 'repeater', 
                                'display'       => true,
                                'elements'      => [['name'   => $name ]]                                                                                                                      
                            ],
                            'recipe_instructions'  =>   [                        
                                'label'         => 'Recipe Instructions',    
                                'button_text'   => 'Add More Instructions', 
                                'type'          => 'repeater',
                                'display'     => true, 
                                'elements'      => [    
                                                [
                                                    'name'           => $name,
                                                    'description'    => $description,                                                                                                
                                                    'image'          => $image,
                                                    'clip_name'      => [                                                                                                                                              
                                                        'label'       => 'Clip Name',                    
                                                        'type'        => 'text',
                                                        'class'       => ['smpg_common_properties'],
                                                        'placeholder' => 'Name',                    
                                                        'value'       => '',
                                                        'display'     => false
                                                    ],
                                                    'clip_start_offset'      => [                                                                                                                                              
                                                        'label'       => 'Clip Start Offset',                    
                                                        'type'        => 'number',
                                                        'class'       => ['smpg_common_properties'],
                                                        'placeholder' => '29',                    
                                                        'value'       => '',
                                                        'display'     => false
                                                    ],
                                                    'clip_end_offset'      => [                                                                                                                                              
                                                        'label'       => 'Clip End Offset',                    
                                                        'type'        => 'number',
                                                        'class'       => ['smpg_common_properties'],
                                                        'placeholder' => '36',                    
                                                        'value'       => '',
                                                        'display'     => false
                                                    ],
                                                ]                                                
                                        ]
                                ]                                                                      
                        ]                      
                    ];

                    break;    

                case 'videoobject':

                    $image['label']    = 'Thumbnail Images';
                    $hours['label']    = 'Duration ( Hours )';
                    $minutes['label']  = 'Duration ( minutes )';
                    $seconds['label']  = 'Duration ( seconds )';

                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'videoobject',           
                        'text'              => 'VideoObject',
                        'properties'        => [
                            'video_name'       => $video_name,    
                            'description'      => $description,
                            'url'              => $url,
                            'content_url'      => $content_url,
                            'embed_url'        => $embed_url,
                            'upload_date'      => $upload_date,
                            'hours'            => $hours,
                            'minutes'          => $minutes,
                            'seconds'          => $seconds,
                            'in_language'       => $in_language,
                            'image'            => $image,                            
                            'author_type'      => $author_type,
                            'author_name'      => $author_name,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo                                                                      
                        ]                      
                    ];                    
                    break;    

                case 'review':  
                    
                    $name['label']                = 'Item Reviewed Name';
                    $description['label']         = 'Item Reviewed Description';
                    $price_range['label']         = 'Item Reviewed Price Range';
                    $telephone['label']           = 'Item Reviewed Telephone';
                    $url['label']                 = 'Item Reviewed URL';
                    $street_address['label']      = 'Item Reviewed Street Address';
                    $address_locality['label']    = 'Item Reviewed Locality';
                    $address_region['label']      = 'Item Reviewed Region';
                    $postal_code['label']         = 'Item Reviewed Postal Code';
                    $address_country['label']     = 'Item Reviewed Country';
                    $image['label']               = 'Item Reviewed Image';
                    $offer_price['label']          = 'Item Reviewed Price';
                    $offer_currency['label']       = 'Item Reviewed Currency';
                    $seller_type['label']          = 'Item Reviewed Seller Type';
                    $seller_name['label']          = 'Item Reviewed Seller Name';                    
                    $name['parent']                = 'itemReviewed';
                    $description['parent']         = 'itemReviewed';
                    $price_range['parent']         = 'itemReviewed';
                    $telephone['parent']           = 'itemReviewed';
                    $url['parent']                 = 'itemReviewed';
                    $street_address['parent']      = 'itemReviewed';
                    $address_locality['parent']    = 'itemReviewed';
                    $address_region['parent']      = 'itemReviewed';
                    $postal_code['parent']         = 'itemReviewed';
                    $address_country['parent']     = 'itemReviewed';
                    $image['parent']               = 'itemReviewed';
                    
                    unset( $rating_value['parent_data'], $best_rating['parent_data'], $worst_rating['parent_data'], $rating_count['parent_data'], $review_count['parent_data'] );
                                                                                                                                                                                                                 
                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'review',
                        'text'              => 'Review',
                        'properties'        => [                                                      
                            'review_body'         => $review_body,
                            'date_published'      => $date_published,
                            'item_reviewed' =>  [
                                        'label'       => 'Item Reviewed',
                                        'type'        => 'select',
                                        'value'       => 'LocalBusiness',
                                        'options'     => [
                                                ''                       => 'Select',
                                                'Book'                   => 'Book',
                                                'Course'                 => 'Course',
                                                'CreativeWorkSeason'     => 'CreativeWorkSeason',
                                                'CreativeWorkSeries'     => 'CreativeWorkSeries',
                                                'Episode'                => 'Episode',
                                                'Event'                  => 'Event',
                                                'Game'                   => 'Game',
                                                'LocalBusiness'          => 'LocalBusiness',                                                
                                                'MediaObject'            => 'MediaObject',  
                                                'Movie'                  => 'Movie', 
                                                'MusicPlaylist'          => 'MusicPlaylist', 
                                                'MusicRecording'         => 'MusicRecording',
                                                'Organization'           => 'Organization',
                                                'Product'                => 'Product',
                                                'Recipe'                 => 'Recipe',
                                                'SoftwareApplication'    => 'SoftwareApplication',
                                        ],
                                        'recommended' => true,
                                        'display'     => true,
                                    'tooltip'     => 'Select Item Reviewwed type'
                            ],                              
                            'name'             => $name,
                            'description'      => $description,
                            'url'              => $url,
                            'date_published'   => $date_published,
                            'price_range'      => $price_range,
                            'offer_price'      => $offer_price,
                            'offer_currency'   => $offer_currency,
                            'seller_type'      => $seller_type,
                            'seller_name'      => $seller_name,
                            'image'            => $image,
                            'street_address'   => $street_address,
                            'address_locality' => $address_locality,
                            'address_region'   => $address_region,
                            'postal_code'      => $postal_code,
                            'address_country'  => $address_country,
                            'telephone'        => $telephone,
                            'rating_value'     => $rating_value,
                            'worst_rating'     => $worst_rating,
                            'best_rating'      => $best_rating,
                            'review_aspect'    => $review_aspect,
                            'author_type'      => $author_type,
                            'author_name'      => $author_name,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo                                                                      
                        ]                      
                    ];                    
                    break;    

                case 'audioobject':

                    $image['label']    = 'Thumbnail Images';
                    $hours['label']    = 'Duration ( Hours )';
                    $minutes['label']  = 'Duration ( minutes )';
                    $seconds['label']  = 'Duration ( seconds )';

                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'audioobject',           
                        'text'              => 'AudioObject',
                        'properties'        => [
                            'name'             => $name,    
                            'description'      => $description,
                            'url'              => $url,
                            'content_url'      => $content_url,
                            'embed_url'        => $embed_url,
                            'upload_date'      => $upload_date,
                            'hours'            => $hours,
                            'minutes'          => $minutes,
                            'seconds'          => $seconds,
                            'in_language'       => $in_language,
                            'image'            => $image,                            
                            'author_type'      => $author_type,
                            'author_name'      => $author_name,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo                                                                      
                        ]                      
                    ];                    
                    break;    
                
                case 'softwareapplication':
        
                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'softwareapplication',           
                        'text'              => 'SoftwareApplication',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description,
                                'operating_system'     => $operating_system,
                                'application_category' => $application_category,                        
                                'image'                => $image,
                                'offer_currency'       => $offer_currency,
                                'offer_price'          => $offer_price,
                                'rating_value'         => $rating_value,
                                'best_rating'          => $best_rating,
                                'worst_rating'         => $worst_rating,
                                'rating_count'         => $rating_count,
                                'review_count'         => $review_count,                                                                                              
        
                        ]                      
                    ];
        
                    break;

                case 'imagegallery':
    
                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'imagegallery',
                        'text'              => 'ImageGallery',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description,                                
                                'url'                  => $url                                
        
                        ]                      
                    ];
        
                    break;
                
                case 'mediagallery':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'mediagallery',
                        'text'              => 'MediaGallery',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;    

                case 'imageobject':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'imageobject',
                        'text'              => 'ImageObject',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;
                    
                case 'photograph':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'photograph',
                        'text'              => 'Photograph',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url,
                                'image'                => $image                                                                                                  
                        ]                      
                    ];
        
                    break;

                case 'apartment':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'apartment',
                        'text'              => 'Apartment',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'house':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'house',
                        'text'              => 'House',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'singlefamilyresidence':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'singlefamilyresidence',
                        'text'              => 'SingleFamilyResidence',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'mobileapplication':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'mobileapplication',
                        'text'              => 'MobileApplication',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'trip':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'trip',
                        'text'              => 'Trip',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'musicplaylist':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'musicplaylist',
                        'text'              => 'MusicPlaylist',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'musicalbum':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'musicalbum',
                        'text'              => 'MusicAlbum',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'liveblogposting':

                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'liveblogposting',
                        'text'              => 'LiveBlogPosting',
                        'properties'        => [
                                'name'                 => $name, 
                                'description'          => $description, 
                                'url'                  => $url                                                                                          
        
                        ]                      
                    ];
        
                    break;

                case 'person':
    
                    $properties = [                
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'person',           
                        'text'              => 'Person',
                        'properties'        => [
                                'name'               => $name,
                                'job_title'          => $job_title,
                                'email'              => $email,
                                'telephone'          => $telephone, 
                                'url'                => $url,                                                                                                
                                'street_address'     => $street_address,
                                'address_locality'   => $address_locality,
                                'address_region'     => $address_region,
                                'postal_code'        => $postal_code,
                                'address_country'    => $address_country,
                                'image'              => $image,                                
        
                        ]                      
                    ];
        
                    break;
        
                case 'product':
        
                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'product',           
                        'text'              => 'Product',
                        'properties'        => [
                                'name'                   => $name,
                                'description'            => $description,                           
                                'image'                  => $image,
                                'sku'                    => $sku,
                                'mpn'                    => $mpn,
                                'brand'                  => $brand,     
                                'offer_type'             => $offer_type,                                                   
                                'offer_price'            => $offer_price,
                                'low_price'              => $low_price,
                                'high_price'             => $high_price,
                                'offer_count'            => $offer_count, 
                                'offer_url'              => $offer_url, 
                                'offer_currency'         => $offer_currency,
                                'offer_price_validuntil' => $offer_price_validuntil,                                                                      
                                'offer_item_condition'   => $offer_item_condition,
                                'offer_availability'     => $offer_availability,
                                'rating_value'           => $rating_value,
                                'best_rating'            => $best_rating,
                                'worst_rating'           => $worst_rating,
                                'rating_count'           => $rating_count,
                                'review_count'           => $review_count,
                                'reviews'                => $reviews
                        ]                      
                    ];
        
                    break;  

                case 'customschema':

                    $placeholder_json = '{
"@context": "https://schema.org",
"@type": "NewsArticle",
"headline": "Title of a News Article",
"image": [
    "https://example.com/photos/1x1/photo.jpg",                                                        
    ],
"datePublished": "2024-01-05T08:00:00+08:00",
"dateModified": "2024-02-05T09:20:00+08:00",
"author": [{
    "@type": "Person",
    "name": "Jane Doe",
    "url": "https://example.com/profile/janedoe123"
},{
    "@type": "Person",
    "name": "John Doe",
    "url": "https://example.com/profile/johndoe123"
    }]
}';
    
                    $properties = [
                        'is_enable'         => true,
                        'is_delete_popup'   => false, 
                        'is_setup_popup'    => false,
                        'has_warning'       => false,
                        'id'                => 'customschema',           
                        'text'              => 'CustomSchema',
                        'properties'        => [                                                            
                                'editor'            => [
                                    'placeholder' => $placeholder_json,                    
                                    'label'       => 'Editor',
                                    'type'        => 'editor',                                                                        
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => 'Enter your custom schema (Json-ld). Must be Valid Json'
                                ],                                
                        ]                      
                    ];
        
                    break;  
        
        default:
        
            break;
    }
    
    return apply_filters( 'smpg_filter_schema_and_properties', $properties );

}