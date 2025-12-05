<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_customschema( $schema_id, $common_properties ) {

    extract( $common_properties );

    $placeholder_json = '{
"@context": "https://schema.org",
"@type": "NewsArticle",
"headline": "Title of a News Article",
"image": [
    "https://example.com/photos/1x1/photo.jpg",                                                        
    ],
"datePublished": "2024-01-05T08:00:00+08:00",
"dateModified": "2024-02-05T09:20:00+08:00",
"author": [{
    "@type": "Person",
    "name": "Jane Doe",
    "url": "https://example.com/profile/janedoe123"
},{
    "@type": "Person",
    "name": "John Doe",
    "url": "https://example.com/profile/johndoe123"
    }]
}';
    
    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'customschema',           
        'text'              => 'CustomSchema',
        'properties'        => [                                                            
                'editor'            => [
                    'placeholder' => $placeholder_json,                    
                    'label'       => 'Editor',
                    'type'        => 'editor',                                                                        
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => 'Enter your custom schema (Json-ld). Must be Valid Json'
                ],                                
        ]                      
    ];

    return $properties;
}