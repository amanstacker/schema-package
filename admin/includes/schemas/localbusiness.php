<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_localbusiness( $schema_id, $common_properties ) {

    extract( $common_properties );

    $social_links = [
        'label'       => esc_html__( 'Social Links', 'schema-package' ),
        'button_text' => esc_html__( 'Add Another Social Link', 'schema-package' ),
        'type'        => 'repeater',
        'display'     => true,
        'elements'    => [
            [
                'url' => $url,
            ],
        ],
    ];

    unset( $publisher_logo['parent_data'] ); 

    $business_type = [
        'localbusiness'            => 'LocalBusiness',
        'store'                    => 'Store', 
        'bakery'                   => 'Bakery',  
        'barorpub'                 => 'BarOrPub',  
        'cafeorcoffeeshop'         => 'CafeOrCoffeeShop',  
        'fastfoodrestaurant'       => 'FastFoodRestaurant',  
        'icecreamshop'             => 'IceCreamShop',  
        'restaurant'               => 'Restaurant',
        'legalservice'             => 'LegalService',
        'healthandbeautybusiness'  => 'HealthAndBeautyBusiness',
        'beautysalon'              => 'BeautySalon',
        'hairsalon'                => 'HairSalon',
        'dayspa'                   => 'DaySpa',
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
            'street_address'   => $street_address,
            'address_locality' => $address_locality,
            'address_region'   => $address_region,
            'postal_code'      => $postal_code,
            'address_country'  => $address_country,
            'telephone'        => $telephone,
            'email'            => $email,
            'logo'             => $publisher_logo,
            'price_range'      => $price_range,
            'latitude'         => $latitude,
            'longitude'        => $longitude,
            'social_links'     => $social_links,
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,
            'opening_hours'    => $opening_hours,       
        ]                      
    ];
    return $properties;
}