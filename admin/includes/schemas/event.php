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
                'label'   => esc_html__( 'Attendance Mode', 'schema-package' ),                                      
                'type'        => 'select',
                'options' => [
                    'https://schema.org/MixedEventAttendanceMode'   => esc_html__( 'Mixed', 'schema-package' ),
                    'https://schema.org/OfflineEventAttendanceMode' => esc_html__( 'Offline', 'schema-package' ),
                    'https://schema.org/OnlineEventAttendanceMode'  => esc_html__( 'Online', 'schema-package' ),                                      
                ],                                                                                        
                'value'       => 'https://schema.org/OfflineEventAttendanceMode',
                'display'     => true
            ], 
            'status'      => [                                                                                                                                              
                'label'   => esc_html__( 'Status', 'schema-package' ),                                        
                'type'        => 'select',
                'options' => [
                    'https://schema.org/EventScheduled'   => esc_html__( 'EventScheduled', 'schema-package' ),
                    'https://schema.org/EventCancelled'   => esc_html__( 'EventCancelled', 'schema-package' ),
                    'https://schema.org/EventMovedOnline' => esc_html__( 'EventMovedOnline', 'schema-package' ),
                    'https://schema.org/EventPostponed'   => esc_html__( 'EventPostponed', 'schema-package' ),
                    'https://schema.org/EventRescheduled' => esc_html__( 'EventRescheduled', 'schema-package' )
                ],                                                                                         
                'value'       => 'https://schema.org/EventScheduled',
                'display'     => true
            ],
            'v_location' => [
                'placeholder' => 'https://operaonline.stream5.com/',                    
                'label'       => esc_html__( 'Virtual Location', 'schema-package' ),
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
                    'label'       => esc_html__( 'Offer URL', 'schema-package' ),
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
                'label'         => esc_html__( 'Performer', 'schema-package' ),
                'button_text'   => esc_html__( 'Add More Performer', 'schema-package' ), 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'name'     => $name,                                            
                    ]
                ]                                                                                                                      
            ],
            'organizer' => [                            
                'label'         => esc_html__( 'Organizer', 'schema-package' ),
                'button_text'   => esc_html__( 'Add More organizer', 'schema-package' ), 
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