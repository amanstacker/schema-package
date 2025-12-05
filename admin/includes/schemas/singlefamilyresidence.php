<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_singlefamilyresidence( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'singlefamilyresidence',
        'text'              => 'SingleFamilyResidence',
        'properties'        => [
                'id'                  => $id,
                'name'                 => $name, 
                'description'          => $description, 
                'url'                  => $url                                                                                          

        ]                      
    ];

    return $properties;
}