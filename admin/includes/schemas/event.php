<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_event( $schema_id, $common_properties ) {

    extract( $common_properties );

    $place_name['parent_data'] = [
        'key'       => 'location', 
        'type'      => 'Place',
        'child_key' => 'name'
    ];
    $latitude['parent_data'] = [
        'key'       => 'location.geo', 
        'type'      => 'Place.GeoCoordinates',
        'child_key' => 'latitude'
    ];
    $longitude['parent_data'] = [
        'key'       => 'location.geo', 
        'type'      => 'Place.GeoCoordinates',
        'child_key' => 'longitude'
    ];
    $street_address['parent_data'] = [
        'key'       => 'location.address', 
        'type'      => 'Place.PostalAddress',
        'child_key' => 'streetAddress'
    ];
    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'event',           
        'text'              => 'Event',
        'properties'        => [
            'id'               => $id,
            'name'             => $name,    
            'description'      => $description,
            'url'              => $url,
            'start_date'       => $start_date,
            'end_date'         => $end_date,
            'attendance_mode'      => [                                                                                                                                              
                'label'       => 'Attendance Mode',                    
                'type'        => 'select',
                'options'     => [
                    'https://schema.org/MixedEventAttendanceMode'   => 'Mixed',
                    'https://schema.org/OfflineEventAttendanceMode' => 'Offline',
                    'https://schema.org/OnlineEventAttendanceMode'  => 'Online',                                        
                ],                                                                                        
                'value'       => 'https://schema.org/OfflineEventAttendanceMode',
                'display'     => true
            ], 
            'status'      => [                                                                                                                                              
                'label'       => 'Status',                    
                'type'        => 'select',
                'options'     => [
                    'https://schema.org/EventScheduled'   => 'EventScheduled',
                    'https://schema.org/EventCancelled'   => 'EventCancelled',
                    'https://schema.org/EventMovedOnline' => 'EventMovedOnline',
                    'https://schema.org/EventPostponed'   => 'EventPostponed',
                    'https://schema.org/EventRescheduled' => 'EventRescheduled'
                ],                                                                                        
                'value'       => 'https://schema.org/EventScheduled',
                'display'     => true
            ],
            'v_location' => [
                'placeholder' => 'https://operaonline.stream5.com/',                    
                'label'       => 'Virtual Location',
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => ''    
            ],
            'place_name'           => $place_name,
            'street_address'       => $street_address,
            'address_locality'     => $address_locality,
            'address_region'       => $address_region,
            'postal_code'          => $postal_code,
            'address_country'      => $address_country,
            'latitude'             => $latitude,
            'longitude'            => $longitude,
            'offer_currency'       => $offer_currency,
            'offer_price'          => $offer_price,
            'offer_availability'   => $offer_availability,
            'valid_from'           => $valid_from,                                                                                                         
            'offer_url'            => [
                    'placeholder' => 'https://operaonline.stream5.com/',                    
                    'label'       => 'Offer URL',
                    'type'        => 'text',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ],
            'image'                => $image,                                                            
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,
            'performer' => [                            
                'label'         => 'Performer',    
                'button_text'   => 'Add More Performer', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'name'     => $name,                                            
                    ]
                ]                                                                                                                      
            ],
            'organizer' => [                            
                'label'         => 'Organizer',    
                'button_text'   => 'Add More organizer', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'name'     => $name, 
                        'url'      => $url,                                            
                    ]
                ]                                                                                                                      
            ],
        ]                      
    ];

    return $properties;
}