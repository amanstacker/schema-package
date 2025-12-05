<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_person( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'person',           
        'text'              => 'Person',
        'properties'        => [
                'id'                  => $id,
                'name'               => $name,
                'job_title'          => $job_title,
                'email'              => $email,
                'telephone'          => $telephone, 
                'url'                => $url,                                                                                                
                'street_address'     => $street_address,
                'address_locality'   => $address_locality,
                'address_region'     => $address_region,
                'postal_code'        => $postal_code,
                'address_country'    => $address_country,
                'image'              => $image,                                

        ]                      
    ];

    return $properties;
}