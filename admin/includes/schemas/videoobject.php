<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_videoobject( $schema_id, $common_properties ) {

    extract( $common_properties );

    $hours['label']   = esc_html__( 'Duration ( Hours )', 'schema-package' );
    $minutes['label'] = esc_html__( 'Duration ( Minutes )', 'schema-package' );
    $seconds['label'] = esc_html__( 'Duration ( Seconds )', 'schema-package' );

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
                    'label'       => esc_html__( 'Thumbnail URL', 'schema-package' ),                  
                    'type'        => 'media',                                    
                    'multiple'    => false,
                    'value'       => [],
                    'recommended' => true,
                    'display'     => false,
                   	'tooltip'     => esc_html__( 'An image of the item. This can be a URL or a fully described ImageObject.', 'schema-package' ),
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