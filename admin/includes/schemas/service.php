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
            'service_type'          => [
                'label'       => 'Service Type',                    
                'type'        => 'text',                                    
                'placeholder' => 'Weekly home cleaning',                    
                'value'       => '',
                'display'     => true
            ],
            'provider_mobility'          => [
                'label'       => 'Provider Mobility',                    
                'type'        => 'text',                                    
                'placeholder' => 'e.g. static or dynamic',
                'value'       => '',
                'display'     => true
            ],
            'provider_name'          => [
                'label'       => 'Provider Name',                    
                'type'        => 'text',                                    
                'placeholder' => 'name',                    
                'value'       => '',
                'display'     => true
            ],
            'provider_url'    => [
                'label'       => 'Provider URL',                    
                'type'        => 'text',                                    
                'placeholder' => smpg_get_permalink($post_id),    
                'value'       => '',
                'display'     => true
            ],
            'provider_type' =>  [ 
                    'label'       => 'Provider Type',
                    'type'        => 'select',
                    'value'       => 'LocalBusiness',
                    'options'     => [
                            ''                             => 'Select',
                            'Organization'                 => 'Organization',
                            'LocalBusiness'                => 'Local Business',
                            'Airline'                      => 'Airline',
                            'Corporation'                  => 'Corporation',
                            'EducationalOrganization'      => 'Educational Organization',
                            'School'                       => 'School',
                            'GovernmentOrganization'       => 'Government Organization',                                                
                            'MedicalOrganization'          => 'Medical Organization',  
                            'NGO'                          => 'NGO', 
                            'PerformingGroup'              => 'Performing Group', 
                            'SportsOrganization'           => 'Sports Organization',
                    ],
                    'recommended' => true,
                    'display'     => true,
                'tooltip'     => 'The author type of this content'
            ],
            'area_served'          => [
                'label'       => 'Area Served',                    
                'type'        => 'textarea',                                    
                'placeholder' => 'New York, Los Angeles',                    
                'value'       => '',
                'display'     => true
            ],
            'service_offered'          => [
                'label'       => 'Service Offered',                    
                'type'        => 'textarea',                                    
                'placeholder' => 'Apartment light cleaning, carpet cleaning',
                'value'       => '',
                'display'     => true
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
            'eligible_customer_type'   => [
                'label'       => 'Eligible Customer Type',                    
                'type'        => 'text',                                    
                'placeholder' => '40 - 80 Years',                    
                'value'       => '',
                'display'     => true
            ],
            'terms_of_service'          => [
                'label'       => 'Terms Of Service',                    
                'type'        => 'text',                                    
                'placeholder' => 'Minimum Entry Age: 18 years, Maximum Entry Age: 85 years',                    
                'value'       => '',
                'display'     => true
            ],
            'annual_percentage_rate'    => [
                'label'       => 'Annual Percentage Rate',
                'type'        => 'text',                                    
                'placeholder' => '30%',                    
                'value'       => '',
                'display'     => true
            ],
            'interest_rate'          => [
                'label'       => 'Interest Rate',
                'type'        => 'text',                                    
                'placeholder' => '5%',                    
                'value'       => '',
                'display'     => true
            ],
            'fees_And_Commissions_Specification'  => [
                'label'       => 'Fees And Commissions Specification',
                'type'        => 'text',                                    
                'placeholder' => '',                    
                'value'       => '',
                'display'     => true
            ],
            'latitude'           => $latitude,
            'longitude'          => $longitude,
            'image'              => $image,
            'additional_property' => [                            
                'label'         => 'Additional Property',    
                'button_text'   => 'Add More Properties', 
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
                            'type'        => 'textarea',                                                                                    
                            'value'       => '',
                            'display'     => true
                        ],                                           
                    ]
                ]                                                                                                                      
            ],
            'opening_hours' => [                            
                'label'         => 'Opening Hours',    
                'button_text'   => 'Add More Opening Hours', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'monday' => [                                                                                                                                              
                            'label'       => 'Monday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'tuesday' => [                                                                                                                                              
                            'label'       => 'Tuesday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'wednesday' => [                                                                                                                                              
                            'label'       => 'Wednesday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'thursday' => [                                                                                                                                              
                            'label'       => 'Thursday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'friday' => [                                                                                                                                              
                            'label'       => 'Friday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'saturday' => [                                                                                                                                              
                            'label'       => 'Saturday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => true,
                            'display'     => true
                        ],
                        'sunday' => [                                                                                                                                              
                            'label'       => 'Sunday',                    
                            'type'        => 'checkbox',                                                                                    
                            'value'       => false,
                            'display'     => true
                        ],
                        'opens' => [                                                                                                                                              
                            'label'       => 'Opens',                    
                            'type'        => 'text',                                    
                            'placeholder' => '09:00',                    
                            'value'       => '',
                            'display'     => true
                        ],
                        'closes' => [                                                                                                                                              
                            'label'       => 'Closes',                    
                            'type'        => 'text',                                    
                            'placeholder' => '19:00',                    
                            'value'       => '',
                            'display'     => true
                        ],                                          
                    ]
                ]                                                                                                                      
            ],
        ]                      
    ];

    return $properties;
}