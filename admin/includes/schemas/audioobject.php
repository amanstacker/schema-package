<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_audioobject( $schema_id, $common_properties ) {

    extract( $common_properties );

    $image['label']    = 'Thumbnail Images';
    $hours['label']    = 'Duration ( Hours )';
    $minutes['label']  = 'Duration ( minutes )';
    $seconds['label']  = 'Duration ( seconds )';

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'audioobject',           
        'text'              => 'AudioObject',
        'properties'        => [
            'id'               => $id,
            'name'             => $name,    
            'description'      => $description,
            'url'              => $url,
            'content_url'      => $content_url,
            'embed_url'        => $embed_url,
            'upload_date'      => $upload_date,
            'hours'            => $hours,
            'minutes'          => $minutes,
            'seconds'          => $seconds,
            'in_language'       => $in_language,
            'image'            => $image,                            
            'author_type'      => $author_type,
            'author_name'      => $author_name,                            
            'publisher_name'   => $publisher_name,
            'publisher_logo'   => $publisher_logo                                                                      
        ]                      
    ];

    return $properties;
}