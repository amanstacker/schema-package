<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_service( $schema_id, $common_properties ) {

    extract( $common_properties );

    $service_type = [
            'service'                   => 'Service',
            'broadcastservice'          => 'BroadcastService', 
            'cableorsatelliteservice'   => 'CableOrSatelliteService',  
            'financialproduct'          => 'FinancialProduct',  
            'foodservice'               => 'FoodService',  
            'governmentservice'         => 'GovernmentService',  
            'taxiservice'               => 'TaxiService',  
            'webapi'                    => 'WebAPI',                                                                                
    ];

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => $schema_id,           
        'text'              => $service_type[$schema_id],
        'properties'        => [
            'id'              => $id,                                
            'service_type' => [
                'label'       => esc_html__( 'Service Type', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => esc_attr__( 'Weekly home cleaning', 'schema-package' ),
                'value'       => '',
                'display'     => true,
            ],
            'provider_mobility'          => [
                'label'       => esc_html__( 'Provider Mobility', 'schema-package' ),                    
                'type'        => 'text',                                    
                'placeholder' => esc_attr__( 'e.g. static or dynamic', 'schema-package' ),
                'value'       => '',
                'display'     => true
            ],
            'provider_name'          => [
                'label'       => esc_html__( 'Provider Name', 'schema-package' ),                    
                'type'        => 'text',                                    
                'placeholder' => esc_attr__( 'name', 'schema-package' ),                    
                'value'       => '',
                'display'     => true
            ],
            'provider_url'    => [
                'label'       => esc_html__( 'Provider URL', 'schema-package' ),                    
                'type'        => 'text',                                    
                'placeholder' => smpg_get_permalink($post_id),    
                'value'       => '',
                'display'     => true
            ],
            'provider_type' => [
                'label'       => esc_html__( 'Provider Type', 'schema-package' ),
                'type'        => 'select',
                'value'       => 'LocalBusiness',
                'options'     => [
                    ''                        => esc_html__( 'Select', 'schema-package' ),
                    'Organization'            => esc_html__( 'Organization', 'schema-package' ),
                    'LocalBusiness'           => esc_html__( 'Local Business', 'schema-package' ),
                    'Airline'                 => esc_html__( 'Airline', 'schema-package' ),
                    'Corporation'             => esc_html__( 'Corporation', 'schema-package' ),
                    'EducationalOrganization' => esc_html__( 'Educational Organization', 'schema-package' ),
                    'School'                  => esc_html__( 'School', 'schema-package' ),
                    'GovernmentOrganization'  => esc_html__( 'Government Organization', 'schema-package' ),
                    'MedicalOrganization'     => esc_html__( 'Medical Organization', 'schema-package' ),
                    'NGO'                     => esc_html__( 'NGO', 'schema-package' ),
                    'PerformingGroup'         => esc_html__( 'Performing Group', 'schema-package' ),
                    'SportsOrganization'      => esc_html__( 'Sports Organization', 'schema-package' ),
                ],
                'recommended' => true,
                'display'     => true,
                'tooltip'     => esc_html__( 'Select the provider type for this content.', 'schema-package' ),
            ],
            'area_served' => [
                'label'       => esc_html__( 'Area Served', 'schema-package' ),
                'type'        => 'textarea',
                'placeholder' => esc_attr__( 'New York, Los Angeles', 'schema-package' ),
                'value'       => '',
                'display'     => true,
            ],
            'service_offered' => [
                'label'       => esc_html__( 'Service Offered', 'schema-package' ),
                'type'        => 'textarea',
                'placeholder' => esc_attr__( 'Apartment light cleaning, carpet cleaning', 'schema-package' ),
                'value'       => '',
                'display'     => true,
            ],                                
            'description'        => $description,
            'url'                => $url,
            'street_address'     => $street_address,
            'address_locality'   => $address_locality,
            'address_region'     => $address_region,
            'postal_code'        => $postal_code,
            'address_country'    => $address_country,
            'telephone'          => $telephone,
            'price_range'        => $price_range,
            'brand'                  => $brand,     
            'offer_type'             => $offer_type,                                                   
            'offer_price'            => $offer_price,
            'low_price'              => $low_price,
            'high_price'             => $high_price,
            'offer_count'            => $offer_count, 
            'offer_url'              => $offer_url, 
            'offer_currency'         => $offer_currency,
            'offer_price_validuntil' => $offer_price_validuntil,                                                                      
            'offer_item_condition'   => $offer_item_condition,
            'offer_availability'     => $offer_availability,                        
            'eligible_customer_type' => [
                'label'       => esc_html__( 'Eligible Customer Type', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => esc_attr__( '40 - 80 Years', 'schema-package' ),
                'value'       => '',
                'display'     => true,
            ],
            'terms_of_service' => [
                'label'       => esc_html__( 'Terms of Service', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => esc_attr__( 'Minimum Entry Age: 18 years, Maximum Entry Age: 85 years', 'schema-package' ),
                'value'       => '',
                'display'     => true,
            ],
            'annual_percentage_rate' => [
                'label'       => esc_html__( 'Annual Percentage Rate', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '30%',
                'value'       => '',
                'display'     => true,
            ],
            'interest_rate' => [
                'label'       => esc_html__( 'Interest Rate', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '5%',
                'value'       => '',
                'display'     => true,
            ],
            'fees_and_commissions_specification' => [
                'label'       => esc_html__( 'Fees and Commissions Specification', 'schema-package' ),
                'type'        => 'text',
                'placeholder' => '',
                'value'       => '',
                'display'     => true,
            ],
            'latitude'           => $latitude,
            'longitude'          => $longitude,
            'image'              => $image,
            'additional_property' => [
                'label'       => esc_html__( 'Additional Property', 'schema-package' ),
                'button_text' => esc_html__( 'Add More Properties', 'schema-package' ),
                'type'        => 'repeater',
                'display'     => true,
                'elements'    => [
                    [
                        'name'  => [
                            'label'   => esc_html__( 'Name', 'schema-package' ),
                            'type'    => 'text',
                            'value'   => '',
                            'display' => true,
                        ],
                        'value' => [
                            'label'   => esc_html__( 'Value', 'schema-package' ),
                            'type'    => 'textarea',
                            'value'   => '',
                            'display' => true,
                        ],
                    ],
                ],
            ],
            'opening_hours' => [                            
                'label'         => esc_html__( 'Opening Hours', 'schema-package' ),
                'button_text'   => esc_html__( 'Add Another Opening Hour', 'schema-package' ), 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'monday' => [
                            'label'   => esc_html__( 'Monday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => true,
                            'display' => true,
                        ],
                        'tuesday' => [
                            'label'   => esc_html__( 'Tuesday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => true,
                            'display' => true,
                        ],
                        'wednesday' => [
                            'label'   => esc_html__( 'Wednesday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => true,
                            'display' => true,
                        ],
                        'thursday' => [
                            'label'   => esc_html__( 'Thursday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => true,
                            'display' => true,
                        ],
                        'friday' => [
                            'label'   => esc_html__( 'Friday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => true,
                            'display' => true,
                        ],
                        'saturday' => [
                            'label'   => esc_html__( 'Saturday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => true,
                            'display' => true,
                        ],
                        'sunday' => [
                            'label'   => esc_html__( 'Sunday', 'schema-package' ),
                            'type'    => 'checkbox',
                            'value'   => false,
                            'display' => true,
                        ],
                        'opens' => [
                            'label'       => esc_html__( 'Opens', 'schema-package' ),
                            'type'        => 'text',
                            'placeholder' => '09:00',
                            'value'       => '',
                            'display'     => true,
                        ],
                        'closes' => [
                            'label'       => esc_html__( 'Closes', 'schema-package' ),
                            'type'        => 'text',
                            'placeholder' => '19:00',
                            'value'       => '',
                            'display'     => true,
                        ],
                    ]
                ]                                                                                                                      
            ],
        ]                      
    ];

    return $properties;
}