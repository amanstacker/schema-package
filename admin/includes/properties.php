<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_get_schema_properties( $schema_id, $post_id = null, $tag_id = null){
    
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
            'tooltip'     => ''        
        ],
        'latitude' => [                        
            'placeholder' => '40.761293',                    
            'label'       => 'GeoCoordinates Latitude',
            'type'        => 'number',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => ''        
        ],
        'longitude' => [                        
            'placeholder' => '-73.982294',                    
            'label'       => 'GeoCoordinates Longitude',
            'type'        => 'number',
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
            'tooltip'     => ''        
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
            'value'       => smpg_get_the_title($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Name of the item'        
        ],
        'title' => [                        
            'placeholder' => 'Enter Title',                    
            'label'       => 'Title',
            'type'        => 'text',
            'value'       => smpg_get_the_title($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Title of the item'        
        ],
        'video_name' => [                        
            'placeholder' => 'Enter Name',                    
            'label'       => 'Name',
            'type'        => 'text',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_the_title($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Name of the item'        
        ],               
        'headline' => [                        
            'placeholder' => 'Headline',                    
            'label'       => 'Headline',
            'type'        => 'text',
            'value'       => smpg_get_the_title($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'Headline of the article.'        
        ],    
        'description' => [                        
            'placeholder' => 'Description',                    
            'label'       => 'Description',                    
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description($post_id),
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'A description of the item.'
        ],
        'video_description' => [                        
            'placeholder' => 'Description',                    
            'label'       => 'Description',                    
            'type'        => 'textarea',
            'class'       => ['smpg_common_properties'],
            'value'       => smpg_get_description($post_id),
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
        'inlanguage' => [                        
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
        'author_type' => [                                     
            'label'       => 'Author Type',                    
            'type'        => 'select',
            'value'       => 'Person',
            'options'      => [
                'Person'           => 'Person',
                'Organization'     => 'Organization',                        
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author type of this content'
        ],
        'employment_type' => [                          
            'label'       => 'Employment Type',                    
            'type'        => 'multiselect',
            'value'       => 'FULL_TIME',
            'options'      => [
                'FULL_TIME'     => 'FULL_TIME',
                'PART_TIME'     => 'PART_TIME',                        
                'CONTRACTOR'    => 'CONTRACTOR',
                'TEMPORARY'     => 'TEMPORARY',                        
                'INTERN'        => 'INTERN',
                'VOLUNTEER'     => 'VOLUNTEER',                        
                'PER_DIEM'      => 'PER_DIEM',
                'OTHER'         => 'OTHER',                        
            ],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author type of this content'
        ],
        'author_name' => [                                     
            'placeholder' => 'Author Name',                    
            'label'       => 'Author Name',                    
            'type'        => 'text',
            'value'       => '',            
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The author name of this content'
        ],
        'publisher_name' => [                        
            'placeholder' => 'Publisher Name',                    
            'label'       => 'Publisher Name',                    
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'The publisher of the creative work.'
        ],
        'publisher_logo' => [                                            
            'label'       => 'Logo',                    
            'type'        => 'media',
            'multiple'    => false,
            'value'       => [],
            'recommended' => true,
            'display'     => true,
            'tooltip'     => 'An associated logo.'
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
            'label'       => 'operatingSystem',                    
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
                'Offer'          => 'Offer',
                'AggregateOffer' => 'AggregateOffer'
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
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'low_price' => [                        
            'placeholder' => '12.36',                    
            'label'       => 'Low Price',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
        ],
        'offer_count' => [                        
            'placeholder' => '2',                    
            'label'       => 'Offer Count',
            'type'        => 'text',
            'value'       => '',
            'recommended' => true,
            'display'     => false,
            'tooltip'     => ''        
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

    extract($common_properties);
          
    switch ($schema_id) {
        
        case 'article':
            $properties = [                
                'is_enable'         => true,
                'is_delete_popup'   => false, 
                'is_setup_popup'    => false,
                'has_warning'       => false,
                'id'                => 'article',           
                'text'              => 'Article',
                'properties'        => [
                    'article_type' => [                                     
                            'label'       => 'Article Type',                    
                            'type'        => 'select',
                            'value'       => 'Article',
                            'options'      => [
                                'Article'                  => 'Article',
                                'TechArticle'              => 'TechArticle',  
                                'NewsArticle'              => 'NewsArticle',  
                                'AdvertiserContentArticle' => 'AdvertiserContentArticle',  
                                'SatiricalArticle'         => 'SatiricalArticle',  
                                'ScholarlyArticle'         => 'ScholarlyArticle',  
                                'SocialMediaPosting'       => 'SocialMediaPosting'                      
                            ],
                            'recommended' => true,
                            'display'     => true,
                            'tooltip'     => 'The author type of this content'
                    ],
                    'headline'            => $headline,
                    'description'         => $description,
                    'keywords'            => $keywords,
                    'word_count'          => $word_count,
                    'article_section'     => $article_section,
                    'url'                 => $url,
                    'inlanguage'          => $inlanguage,
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
                'date_created' => [                                                                                                                                              
                    'label'       => 'Date Created',                    
                    'type'        => 'text',
                    'placeholder' => '2016-11-02T21:11Z', 
                    'display'     => true,                   
                    'value'       => ''
                ],
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
                            'inlanguage'       => $inlanguage,
                            'image'            => $image,
                            'author_type'      => $author_type,
                            'author_name'      => $author_name,                            
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo                                                                      
                        ]                      
                    ];                    
                    break;

                case 'course':

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
                            'publisher_name'   => $publisher_name,
                            'publisher_logo'   => $publisher_logo    

                        ]                      
                    ];
                    break;
                    case 'jobposting':

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
                                'jobLocation_type'      => [                                                                                                                                              
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
                                'hiring_org_social_links' => [                            
                                    'label'         => 'Hiring Organization Social Links',    
                                    'button_text'   => 'Add More Social Links', 
                                    'type'          => 'repeater', 
                                    'display'       => true,
                                    'elements'      => [
                                        [
                                            'url'     => $url,                                            
                                        ]
                                    ]                                                                                                                      
                                ],
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

                        $properties = [
                            'is_enable'         => true,
                            'is_delete_popup'   => false, 
                            'is_setup_popup'    => false,
                            'has_warning'       => false,
                            'id'                => 'localbusiness',           
                            'text'              => 'LocalBusiness',
                            'properties'        => [
                                'business_type' =>  [                                     
                                        'label'       => 'Business Type',                    
                                        'type'        => 'select',
                                        'value'       => 'LocalBusiness',
                                        'options'      => [
                                            'LocalBusiness'            => 'LocalBusiness',
                                            'Store'                    => 'Store', 
                                            'Bakery'                   => 'Bakery',  
                                            'BarOrPub'                 => 'BarOrPub',  
                                            'CafeOrCoffeeShop'         => 'CafeOrCoffeeShop',  
                                            'FastFoodRestaurant'       => 'FastFoodRestaurant',  
                                            'IceCreamShop'             => 'IceCreamShop',  
                                            'Restaurant'               => 'Restaurant',                                                                                
                                        ],
                                        'recommended' => true,
                                        'display'     => true,
                                    'tooltip'     => 'The author type of this content'
                                ],
                                'name'             => $name,    
                                'description'      => $description,
                                'url'              => $url,                                                                                                                    
                                'image'            => $image,
                                'street_address'     => $street_address,
                                'address_locality'   => $address_locality,
                                'address_region'     => $address_region,
                                'postal_code'        => $postal_code,
                                'address_country'    => $address_country,
                                'telephone'          => [
                                    'label'       => 'Telephone',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => '+14088717984',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'price_range'          => [
                                    'label'       => 'Price Range',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => '$$$',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'latitude'           => $latitude,
                                'longitude'          => $longitude,
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

                        $properties = [
                            'is_enable'         => true,
                            'is_delete_popup'   => false, 
                            'is_setup_popup'    => false,
                            'has_warning'       => false,
                            'id'                => 'service',           
                            'text'              => 'Service',
                            'properties'        => [
                                'more_specific_service_type' =>  [ 
                                        'label'       => 'More Specific Service Types',
                                        'type'        => 'select',
                                        'value'       => 'Service',
                                        'options'     => [
                                            'Service'                   => 'Service',
                                            'BroadcastService'          => 'BroadcastService', 
                                            'CableOrSatelliteService'   => 'CableOrSatelliteService',  
                                            'FinancialProduct'          => 'FinancialProduct',  
                                            'FoodService'               => 'FoodService',  
                                            'GovernmentService'         => 'GovernmentService',  
                                            'TaxiService'               => 'TaxiService',  
                                            'WebAPI'                    => 'WebAPI',                                                                                
                                        ],
                                        'recommended' => true,
                                        'display'     => true,
                                    'tooltip'     => 'The author type of this content'
                                ],
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
                                'provider_type' =>  [ 
                                        'label'       => 'Provider Type',
                                        'type'        => 'select',
                                        'value'       => 'LocalBusiness',
                                        'options'     => [
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
                                'telephone'          => [
                                    'label'       => 'Telephone',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => '+14088717984',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'price_range'          => [
                                    'label'       => 'Price Range',                    
                                    'type'        => 'text',                                    
                                    'placeholder' => '$$$',                    
                                    'value'       => '',
                                    'display'     => true
                                ],
                                'latitude'           => $latitude,
                                'longitude'          => $longitude,
                                'image'              => $image,
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
                            'inlanguage'       => $inlanguage,
                            'image'            => $image,     
                            'date_published'   => $date_published,
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
                            'servings'        => [
                                    'placeholder' => '50',                    
                                    'label'       => 'Number Of Servings',
                                    'type'        => 'number',
                                    'value'       => '',
                                    'recommended' => true,
                                    'display'     => true,
                                    'tooltip'     => ''    
                            ], 
                            'recipe_category' => [
                                    'placeholder' => 'Dessert',                    
                                    'label'       => 'Recipe Category',
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
                                'tooltip'     => ''    
                            ],
                            'carbohydrate' => [
                                'placeholder' => '9 grams carbohydrates',                    
                                'label'       => 'Carbohydrate Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'cholesterol' => [
                                'placeholder' => '10 milligrams cholesterol',                    
                                'label'       => 'Cholesterol Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                        ],
                        'fat' => [
                            'placeholder' => '11 grams fat',                    
                            'label'       => 'Fat Content',
                            'type'        => 'text',
                            'value'       => '',
                            'recommended' => true,
                            'display'     => true,
                            'tooltip'     => ''    
                        ],
                        'fiber' => [
                            'placeholder' => '15 grams fiber',
                            'label'       => 'Fiber Content',
                            'type'        => 'text',
                            'value'       => '',
                            'recommended' => true,
                            'display'     => true,
                            'tooltip'     => ''    
                        ],
                        'protein' => [
                            'placeholder' => '10 grams protein',                    
                            'label'       => 'Protein Content',
                            'type'        => 'text',
                            'value'       => '',
                            'recommended' => true,
                            'display'     => true,
                            'tooltip'     => ''    
                        ],
                            'saturated_fat' => [
                                'placeholder' => '5 grams saturated fat',                    
                                'label'       => 'Saturated Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'sodium' => [
                                'placeholder' => '3 milligrams sodium',                    
                                'label'       => 'Sodium Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'sugar' => [
                                'placeholder' => '15 grams sugar',                    
                                'label'       => 'Sugar Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'trans_fat' => [
                                'placeholder' => '12 grams trans fat',                    
                                'label'       => 'Trans Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'unsaturated_fat' => [
                                'placeholder' => '16 grams unsaturated fat',                    
                                'label'       => 'Unsaturated Fat Content',
                                'type'        => 'text',
                                'value'       => '',
                                'recommended' => true,
                                'display'     => true,
                                'tooltip'     => ''    
                            ],
                            'keywords'            => $keywords, 
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
                            'ingredient' => [                            
                                'label'         => 'Ingredient',    
                                'button_text'   => 'Add More Ingredient', 
                                'type'          => 'repeater', 
                                'display'       => true,
                                'elements'      => [['name'   => $name ]]                                                                                                                      
                            ],
                            'steps'  =>   [                        
                                'label'         => 'Instructions',    
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
                            'inlanguage'       => $inlanguage,
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
                                'offer_price'          => $offer_price                                                                                              
        
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
                                'offer_availability'     => $offer_availability                        
                        ]                      
                    ];
        
                    break;  
        
        default:
        
            break;
    }
    
    return $properties;

}