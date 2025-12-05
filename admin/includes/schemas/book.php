<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_book( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'book',           
        'text'              => 'Book',
        'properties'        => [
            'id'               => $id,
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

    return $properties;
}