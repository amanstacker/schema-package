<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_localbusiness( $schema_id, $common_properties ) {

    extract( $common_properties );

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

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => $schema_id,           
        'text'              => $business_type[$schema_id],
        'properties'        => [                                
            'id'               => $id,
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
    return $properties;
}