<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_review( $schema_id, $common_properties ) {

    extract( $common_properties );

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
            'id'                  => $id,
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
    
    return $properties;
}