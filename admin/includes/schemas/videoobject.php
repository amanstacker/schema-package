<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_videoobject( $schema_id, $common_properties ) {

    extract( $common_properties );

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
            'id'               => $id,
            'video_name'       => $video_name,    
            'description'      => $description,
            'url'              => $url,
            'content_url'      => $content_url,
            'embed_url'        => $embed_url,
            'thumbnail_url'    => [                                                      
                    'label'       => 'Thumbnail URL',                    
                    'type'        => 'media',                                    
                    'multiple'    => false,
                    'value'       => [],
                    'recommended' => true,
                    'display'     => false,
                    'tooltip'     => 'An image of the item. This can be a URL or a fully described ImageObject.'
            ],
            'upload_date'      => $upload_date,
            'hours'            => $hours,
            'minutes'          => $minutes,
            'seconds'          => $seconds,
            'in_language'      => $in_language,
            'image'            => $image,                            
            'author_type'      => $author_type,
            'author_name'      => $author_name,                            
            'publisher_name'   => $publisher_name,
            'publisher_logo'   => $publisher_logo                                                                      
        ]                      
    ];

    return $properties;
}