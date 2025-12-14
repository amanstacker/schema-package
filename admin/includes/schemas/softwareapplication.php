<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_softwareapplication( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'softwareapplication',           
        'text'              => 'SoftwareApplication',
        'properties'        => [
                'id'                  => $id,
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

    return $properties;
}