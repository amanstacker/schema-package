<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_vacationrental( $schema_id, $common_properties ) {

    extract( $common_properties );

    $reviews_elements = [
        'name'                => $name,
        'date_published'      => $date_published,
        'author_name'         => $author_name,
        'review_body'         => $review_body,
        'rating_value'        => $rating_value,
        'best_rating'         => $best_rating,
        'worst_rating'        => $worst_rating,
    ];

    $reviews = [
        'label'       => esc_html__( 'Reviews', 'schema-package' ),
        'button_text' => esc_html__( 'Add Another Review', 'schema-package' ),
        'type'        => 'repeater',
        'display'     => true,
        'elements'    => [ $reviews_elements ],
    ];

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'vacationrental',           
        'text'              => 'VacationRental',                            
        'properties'        => [                                
            'id'               => $id,
            'name'             => $name,    
            'additional_type' => [
                'label'   => esc_html__( 'Vacation Rental Type', 'schema-package' ),
                'type'    => 'select',
                'value'   => '',
                'options' => [
                    ''                     => esc_html__( 'Select', 'schema-package' ),
                    'Villa'                => esc_html__( 'Villa', 'schema-package' ),
                    'House'                => esc_html__( 'House', 'schema-package' ),
                    'HolidayVillageRental' => esc_html__( 'Holiday Village Rental', 'schema-package' ),
                    'Gite'                 => esc_html__( 'Gite', 'schema-package' ),
                    'Cottage'              => esc_html__( 'Cottage', 'schema-package' ),
                    'Chalet'               => esc_html__( 'Chalet', 'schema-package' ),
                    'Cabin'                => esc_html__( 'Cabin', 'schema-package' ),
                    'Bungalow'             => esc_html__( 'Bungalow', 'schema-package' ),
                    'Apartment'            => esc_html__( 'Apartment', 'schema-package' ),
                ],
                'display' => true,
            ],
            'checkin_time' => [
                'placeholder' => '18:00:00+08:00',
                'label'       => esc_html__( 'Check-in Time', 'schema-package' ),
                'type'        => 'text',                
                'value'       => '',
                'display'     => true,
            ],

            'checkout_time' => [
                'placeholder' => '11:00:00+08:00',
                'label'       => esc_html__( 'Check-out Time', 'schema-package' ),
                'type'        => 'text',                
                'value'       => '',
                'display'     => true,
            ],
            'brand'            => $brand,
            'description'      => $description,
            'url'              => $url,                                                                                                                                                    
            'street_address'   => $street_address,
            'address_locality' => $address_locality,
            'address_region'   => $address_region,
            'postal_code'      => $postal_code,
            'address_country'  => $address_country,
            'telephone'        => $telephone,                                
            'identifier'       => $identifier,
            'latitude'         => $latitude,
            'longitude'        => $longitude,
            'type_of_room' => [
                'label'   => esc_html__( 'Type of Room', 'schema-package' ),
                'type'    => 'select',
                'value'   => 'EntirePlace',
                'options' => [
                    ''            => esc_html__( 'Select', 'schema-package' ),
                    'EntirePlace' => esc_html__( 'Entire Place', 'schema-package' ),
                    'PrivateRoom' => esc_html__( 'Private Room', 'schema-package' ),
                    'SharedRoom'  => esc_html__( 'Shared Room', 'schema-package' ),
                ],
                'display' => true,
            ],
            'occupancy' => [
                'label'       => esc_html__( 'Occupancy', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '2',
                'value'       => '',
                'display'     => true,
            ],
            'number_of_bathrooms_total' => [
                'label'       => esc_html__( 'Number of Bathrooms (Total)', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '1',
                'value'       => '',
                'display'     => true,
            ],
            'number_of_bedrooms' => [
                'label'       => esc_html__( 'Number of Bedrooms', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '3',
                'value'       => '',
                'display'     => true,
            ],
            'number_of_rooms' => [
                'label'       => esc_html__( 'Number of Rooms', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '5',
                'value'       => '',
                'display'     => true,
            ],
            'floor_size' => [
                'label'       => esc_html__( 'Floor Size', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '75',
                'value'       => '',
                'display'     => true,
            ],
            'floor_size_unit_text' => [
                'label'   => esc_html__( 'Floor Size Unit', 'schema-package' ),
                'type'    => 'select',
                'value'   => 'FTK',
                'options' => [
                    'FTK'  => esc_html__( 'FTK', 'schema-package' ),
                    'MTK'  => esc_html__( 'MTK', 'schema-package' ),
                    'SQFT' => esc_html__( 'SQFT', 'schema-package' ),
                    'SQM'  => esc_html__( 'SQM', 'schema-package' ),
                ],
                'display' => true,
            ],
            'bed' => [
                'label'         => esc_html__( 'Bed Details', 'schema-package' ),    
                'button_text'   => esc_html__( 'Add Another Bed', 'schema-package' ), 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'number_of_beds' => [                                                                                                                                              
                            'label'       => esc_html__( 'Number Of Beds', 'schema-package' ),
                            'type'        => 'text',                                                                                    
                            'value'       => '',
                            'display'     => true
                        ],
                        'type_of_bed' => [
                            'label'       => esc_html__( 'Type Of Bed', 'schema-package' ),                    
                            'type'        => 'select',                                                                                    
                            'value'       => 'Single',
                            'options'     => [
                                                'Single'         => esc_html__( 'Single', 'schema-package' ),
                                                'Double'         => esc_html__( 'Double', 'schema-package' ),
                                                'SemiDouble'     => esc_html__( 'SemiDouble', 'schema-package' ),
                                                'Full'           => esc_html__( 'Full', 'schema-package' ),
                                                'Queen'          => esc_html__( 'Queen', 'schema-package' ),
                                                'King'           => esc_html__( 'King', 'schema-package' ),
                                                'CaliforniaKing' => esc_html__( 'California King', 'schema-package' ),                                                                    
                                            ],
                            'display'     => true
                        ],                                           
                    ]
                ]                                                                                                                      
            ],
            'images' => [
                'label'       => esc_html__( 'Images', 'schema-package' ),
                'button_text' => esc_html__( 'Add Another Image', 'schema-package' ),
                'type'        => 'repeater',
                'display'     => true,
                'elements'    => [
                    [
                        'image' => $image,
                    ],
                ],
            ],
            'amenity_feature' => [
                'label'         => esc_html__( 'Amenity Feature', 'schema-package' ),    
                'button_text'   => esc_html__( 'Add Another Amenity', 'schema-package' ), 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'name' => [
                            'label'   => esc_html__( 'Name', 'schema-package' ),
                            'type'    => 'text',
                            'value'   => '',
                            'display' => true,
                        ],

                        'value' => [
                            'label'   => esc_html__( 'Value', 'schema-package' ),
                            'type'    => 'text',
                            'value'   => '',
                            'display' => true,
                        ],                                           
                    ]
                ]                                                                                                                      
            ],
            'knows_language' => [
                'label'       => esc_html__( 'Knows Language', 'schema-package' ),
                'button_text' => esc_html__( 'Add Another Language', 'schema-package' ),
                'type'        => 'repeater',
                'display'     => true,
                'elements'    => [
                    [
                        'language' => [
                            'label'   => esc_html__( 'Language', 'schema-package' ),
                            'type'    => 'text',
                            'value'   => '',
                            'display' => true,
                        ],
                    ],
                ],
            ],
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,                                
            'reviews'          => $reviews
        ]                      
    ];

    return $properties;
}