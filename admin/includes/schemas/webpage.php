<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_webpage( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'webpage',
        'text'              => 'WebPage',
        'properties'        => [                    
            'id'                  => $id,
            'headline'            => $headline,
            'description'         => $description,
            'keywords'            => $keywords,
            'word_count'          => $word_count,                    
            'url'                 => $url,
            'in_language'         => $in_language,
            'date_published'      => $date_published,
            'date_modified'       => $date_modified,
            'author_type'         => $author_type,
            'author_name'         => $author_name,
            'publisher_name'      => $publisher_name,                    
            'publisher_logo'      => $publisher_logo,
            'image'               => $image
        ]
    ];
    
    if ( $schema_id == 'creativework' ) {
        unset( $properties['properties']['word_count'] );
        unset( $properties['properties']['article_section'] );
    }

    return $properties;
}