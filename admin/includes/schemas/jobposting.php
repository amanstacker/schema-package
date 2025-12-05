<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_jobposting( $schema_id, $common_properties ) {

    extract( $common_properties );

    $social_links = [                            
        'label'         => 'Social Links',
        'button_text'   => 'Add More Social Links', 
        'type'          => 'repeater', 
        'display'       => true,
        'elements'      => [
            [
                'url'     => $url,                                            
            ]
        ]                                                                                                                      
    ];

    $social_links['label'] = 'Hiring Organization Social Links';

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'jobposting',           
        'text'              => 'JobPosting',
        'properties'        => [
            'id'               => $id,
            'title'            => $title,    
            'description'      => $description,
            'url'              => $url,
            'date_posted'      => $date_posted,
            'valid_through'    => $valid_through,
            'employment_type'  => $employment_type,
            'job_location_type'      => [
                'label'       => 'JobLocation Type',                    
                'type'        => 'text',                                    
                'placeholder' => 'TELECOMMUTE',                    
                'value'       => '',
                'display'     => true
            ],
            'education_requirements'      => [                                                                                                                                              
                'label'       => 'Education Requirements',                    
                'type'        => 'text',                                    
                'placeholder' => 'bachelor degree',                    
                'value'       => '',
                'display'     => true
            ],
            'experience_requirements'      => [                                                                                                                                              
                'label'       => 'Experience Requirements',                    
                'type'        => 'text',                                    
                'placeholder' => '36',                    
                'value'       => '',
                'display'     => true
            ],
            'identifier_name'      => [                                                                                                                                              
                'label'       => 'Identifier Name',                    
                'type'        => 'text',                                    
                'placeholder' => 'MagsRUs Wheel Company',                    
                'value'       => '',
                'display'     => true
            ],
            'identifier_value'      => [                                                                                                                                              
                'label'       => 'Identifier Value',                    
                'type'        => 'number',                                    
                'placeholder' => '1234567',                    
                'value'       => '',
                'display'     => true
            ],
            'hiring_org_name'      => [                                                                                                                                              
                'label'       => 'Hiring Organization Name',                    
                'type'        => 'text',                                    
                'placeholder' => 'MagsRUs Wheel Company',                    
                'value'       => '',
                'display'     => true
            ],
            'social_links'  => $social_links,                                
            'hiring_org_logo'      => [                                                                                                                                              
                'label'       => 'Hiring Organization Logo',                    
                'type'        => 'media',                                                                                          
                'multiple'    => false,
                'value'       => [],
                'display'     => true
            ],
            'b_salary_currency' => [                                                                                                                                              
                'label'       => 'Base Salary Currency',                    
                'type'        => 'text',                                    
                'placeholder' => 'USD',                    
                'value'       => '',
                'display'     => true
            ],                                
            'b_salary' => [                                                                                                                                              
                'label'       => 'Base Salary',                    
                'type'        => 'number',                                    
                'placeholder' => '40.00',                    
                'value'       => '',
                'display'     => true
            ],
            'b_salary_min' => [                                                                                                                                              
                'label'       => 'Base Salary Minimum',                    
                'type'        => 'number',                                    
                'placeholder' => '40.00',                    
                'value'       => '',
                'display'     => true
            ],
            'b_salary_max' => [                                                                                                                                              
                'label'       => 'Base Salary Maximum',                    
                'type'        => 'number',                                    
                'placeholder' => '50.00',                    
                'value'       => '',
                'display'     => true
            ],
            'b_salary_unit_text' => [                                                                                                                                              
                'label'       => 'Base Salary Unit Text',                    
                'type'        => 'select',                                                                                            
                'value'       => 'HOUR',
                'options'     => [
                        'HOUR'    => 'HOUR',
                        'DAY'     => 'DAY',
                        'WEEK'    => 'WEEK',
                        'MONTH'   => 'MONTH',
                        'YEAR'    => 'YEAR'
                ],
                'display'     => true
            ],
            'job_location' => [                            
                'label'         => 'Job Location',    
                'button_text'   => 'Add More Location', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [
                    [
                        'street_address'     => $street_address,
                        'address_locality'   => $address_locality,
                        'address_region'     => $address_region,
                        'postal_code'        => $postal_code,
                        'address_country'    => $address_country
                        ]
                ]                                                                                                                      
            ],
            'image'            => $image,                                                            
        ]                      
    ];
        
    return $properties;
}