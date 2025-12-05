<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_product( $schema_id, $common_properties ) {

    extract( $common_properties );

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

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'product',           
        'text'              => 'Product',
        'properties'        => [
                'id'                  => $id,
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

    return $properties;
}