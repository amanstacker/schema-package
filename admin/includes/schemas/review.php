<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_review( $schema_id, $common_properties ) {

    extract( $common_properties );

    $name['label']             = esc_html__( 'Item Reviewed Name', 'schema-package' );
    $description['label']      = esc_html__( 'Item Reviewed Description', 'schema-package' );
    $price_range['label']      = esc_html__( 'Item Reviewed Price Range', 'schema-package' );
    $telephone['label']        = esc_html__( 'Item Reviewed Telephone', 'schema-package' );
    $url['label']              = esc_html__( 'Item Reviewed URL', 'schema-package' );
    $street_address['label']   = esc_html__( 'Item Reviewed Street Address', 'schema-package' );
    $address_locality['label'] = esc_html__( 'Item Reviewed Locality', 'schema-package' );
    $address_region['label']   = esc_html__( 'Item Reviewed Region', 'schema-package' );
    $postal_code['label']      = esc_html__( 'Item Reviewed Postal Code', 'schema-package' );
    $address_country['label']  = esc_html__( 'Item Reviewed Country', 'schema-package' );
    $image['label']            = esc_html__( 'Item Reviewed Image', 'schema-package' );
    $offer_price['label']      = esc_html__( 'Item Reviewed Price', 'schema-package' );
    $offer_currency['label']   = esc_html__( 'Item Reviewed Currency', 'schema-package' );
    $seller_type['label']      = esc_html__( 'Item Reviewed Seller Type', 'schema-package' );
    $seller_name['label']      = esc_html__( 'Item Reviewed Seller Name', 'schema-package' );

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
            'item_reviewed' => [
                'label'       => esc_html__( 'Item Reviewed', 'schema-package' ),
                'type'        => 'select',
                'value'       => 'LocalBusiness',
                'options'     => [
                    ''                    => esc_html__( 'Select', 'schema-package' ),
                    'Book'                => esc_html__( 'Book', 'schema-package' ),
                    'Course'              => esc_html__( 'Course', 'schema-package' ),
                    'CreativeWorkSeason'  => esc_html__( 'Creative Work Season', 'schema-package' ),
                    'CreativeWorkSeries'  => esc_html__( 'Creative Work Series', 'schema-package' ),
                    'Episode'             => esc_html__( 'Episode', 'schema-package' ),
                    'Event'               => esc_html__( 'Event', 'schema-package' ),
                    'Game'                => esc_html__( 'Game', 'schema-package' ),
                    'LocalBusiness'       => esc_html__( 'Local Business', 'schema-package' ),
                    'MediaObject'         => esc_html__( 'Media Object', 'schema-package' ),
                    'Movie'               => esc_html__( 'Movie', 'schema-package' ),
                    'MusicPlaylist'       => esc_html__( 'Music Playlist', 'schema-package' ),
                    'MusicRecording'      => esc_html__( 'Music Recording', 'schema-package' ),
                    'Organization'        => esc_html__( 'Organization', 'schema-package' ),
                    'Product'             => esc_html__( 'Product', 'schema-package' ),
                    'Recipe'              => esc_html__( 'Recipe', 'schema-package' ),
                    'SoftwareApplication' => esc_html__( 'Software Application', 'schema-package' ),
                ],
                'recommended' => true,
                'display'     => true,
                'tooltip'     => esc_html__( 'Select the item reviewed type.', 'schema-package' ),
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