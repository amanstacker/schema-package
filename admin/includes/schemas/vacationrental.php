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

    $reviews  =   [                            
                'label'         => 'Reviews',    
                'button_text'   => 'Add More Reviews', 
                'type'          => 'repeater',
                'display'       => true, 
                'elements'      => [ $reviews_elements ]
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
            'additional_type'          => [
                'label'       => 'Vacation Rental Type',
                'type'        => 'select',                                                                        
                'value'       => '',
                'options'     => [
                            ''                      => 'Select',                                                
                            'Villa'                 => 'Villa',
                            'House'                 => 'House',
                            'HolidayVillageRental'  => 'HolidayVillageRental',
                            'Gite'                  => 'Gite',
                            'Cottage'               => 'Cottage',
                            'Chalet'                => 'Chalet',
                            'Cabin'                 => 'Cabin',                                                
                            'Bungalow'              => 'Bungalow',  
                            'Apartment'             => 'Apartment',                                                 
                    ],
                'display'     => true
            ],
            'checkin_time'          => [
                'label'       => 'Checkin Time',                    
                'type'        => 'text',                                    
                'placeholder' => '18:00:00+08:00',                    
                'value'       => '',
                'display'     => true
            ],
            'checkout_time'          => [
                'label'       => 'Checkout Time',                    
                'type'        => 'text',                                    
                'placeholder' => '11:00:00+08:00',                    
                'value'       => '',
                'display'     => true
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
            'type_of_room'         => [
                'label'       => 'Type of room',
                'type'        => 'select',                                                                                         
                'value'       => 'EntirePlace',
                'options'     => [
                            ''             => 'Select',                                                
                            'EntirePlace'  => 'EntirePlace',
                            'PrivateRoom'  => 'PrivateRoom',
                            'SharedRoom'   => 'SharedRoom',                                                
                    ],
                'display'     => true
            ],
            'occupancy'          => [
                'label'       => 'Occupancy',                    
                'type'        => 'text',                                    
                'placeholder' => '2',                    
                'value'       => '',
                'display'     => true
            ],
            'number_of_bathrooms_total'          => [
                'label'       => 'Number Of Bathrooms Total',
                'type'        => 'text',                                    
                'placeholder' => '1',                    
                'value'       => '',
                'display'     => true
            ],
            'number_of_bedrooms'          => [
                'label'       => 'Number Of Bedrooms',                    
                'type'        => 'text',                                    
                'placeholder' => '3',                    
                'value'       => '',
                'display'     => true
            ],
            'number_of_rooms'          => [
                'label'       => 'Number Of Rooms',
                'type'        => 'text',                                    
                'placeholder' => '5',                    
                'value'       => '',
                'display'     => true
            ],
            'floor_size'          => [
                'label'       => 'Floor Size',                    
                'type'        => 'text',                                    
                'placeholder' => '75',                    
                'value'       => '',
                'display'     => true
            ],
            'floor_size_unit_text' => [                                                                                                                                              
                'label'       => 'Floor Size Unit Text',
                'type'        => 'select',                                                                                            
                'value'       => 'FTK',
                'options'     => [
                        'FTK'    => 'FTK',
                        'MTK'    => 'MTK',
                        'SQFT'   => 'SQFT',
                        'SQM'    => 'SQM',                                            
                ],
                'display'     => true
            ],
            'bed' => [
                'label'         => 'Bed Details',    
                'button_text'   => 'Add More Bed', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'number_of_beds' => [                                                                                                                                              
                            'label'       => 'Number Of Beds',
                            'type'        => 'text',                                                                                    
                            'value'       => '',
                            'display'     => true
                        ],
                        'type_of_bed' => [
                            'label'       => 'Type Of Bed',                    
                            'type'        => 'select',                                                                                    
                            'value'       => 'Single',
                            'options'     => [
                                                'Single'         => 'Single',
                                                'Double'         => 'Double',
                                                'SemiDouble'     => 'SemiDouble',
                                                'Full'           => 'Full',                                                                    
                                                'Queen'          => 'Queen',
                                                'King'           => 'King',
                                                'CaliforniaKing' => 'CaliforniaKing',                                                                    
                                            ],
                            'display'     => true
                        ],                                           
                    ]
                ]                                                                                                                      
            ],
            'images' => [
                'label'         => 'Images',    
                'button_text'   => 'Add More Image', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'image'    => $image,
                    ]
                ]                                                                                                                      
            ],
            'amenity_feature' => [
                'label'         => 'Amenity Feature',    
                'button_text'   => 'Add More Amenity', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'name' => [                                                                                                                                              
                            'label'       => 'Name',                    
                            'type'        => 'text',                                                                                    
                            'value'       => '',
                            'display'     => true
                        ],
                        'value' => [                                                                                                                                              
                            'label'       => 'Value',                    
                            'type'        => 'text',                                                                                    
                            'value'       => '',
                            'display'     => true
                        ],                                           
                    ]
                ]                                                                                                                      
            ],
            'knows_language' => [
                'label'         => 'Knows Language',    
                'button_text'   => 'Add More Language', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'language' => [                                                                                                                                              
                            'label'       => 'Language',
                            'type'        => 'text',                                                                                    
                            'value'       => '',
                            'display'     => true
                        ],                                                                                       
                    ]
                ]                                                                                                                      
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