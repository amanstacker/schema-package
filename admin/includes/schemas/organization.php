<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_organization( $schema_id, $common_properties ) {

    extract( $common_properties );

    $social_links = [
        'label'       => esc_html__( 'Social Links', 'schema-package' ),
        'button_text' => esc_html__( 'Add Another Social Link', 'schema-package' ),
        'type'        => 'repeater',
        'display'     => true,
        'elements'    => [
            [
                'url' => $url,
            ],
        ],
    ];

    unset( $publisher_logo['parent_data'] );    

    $organization_type = [
        'organization'             => 'Organization',
        'airline'                  => 'Airline',
        'consortium'               => 'Consortium',
        'corporation'              => 'Corporation',
        'educationalorganization'  => 'EducationalOrganization',
        'school'                   => 'School',
        'governmentorganization'   => 'GovernmentOrganization',
        'librarysystem'            => 'LibrarySystem',
        'newsmediaorganization'    => 'NewsMediaOrganization',
        'ngo'                      => 'NGO',
        'performinggroup'          => 'PerformingGroup',
        'sportsorganization'       => 'SportsOrganization',
        'workersunion'             => 'WorkersUnion',        
    ];

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => $schema_id,           
        'text'              => $organization_type[ $schema_id ],
        'properties'        => [
            'id'               => $id,
            'name'             => $name,    
            'description'      => $description,
            'url'              => $url,
            'image'            => $image,                                                
            'street_address'   => $street_address,
            'address_locality' => $address_locality,
            'address_region'   => $address_region,
            'postal_code'      => $postal_code,
            'address_country'  => $address_country,
            'telephone'        => $telephone,
            'email'            => $email,
            'logo'             => $publisher_logo,
            'social_links'     => $social_links,
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,                                                                      
        ]                      
    ];

    return $properties;
}