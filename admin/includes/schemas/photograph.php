<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_photograph( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'photograph',
        'text'              => 'Photograph',
        'properties'        => [
                'id'                  => $id,
                'name'                 => $name, 
                'description'          => $description, 
                'url'                  => $url,
                'image'                => $image                                                                                                  
        ]                      
    ];

    return $properties;
}