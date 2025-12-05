<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_organization( $schema_id, $common_properties ) {

    extract( $common_properties );

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

    unset( $publisher_logo['parent_data'] );    

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'organization',           
        'text'              => 'Organization',
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
            'social_links'     => $social_links,
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,                                                                      
        ]                      
    ];

    return $properties;
}