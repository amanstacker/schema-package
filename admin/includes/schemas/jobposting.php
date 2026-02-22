<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_jobposting( $schema_id, $common_properties ) {

    extract( $common_properties );

    $social_links = [                            
        'label'       => esc_html__( 'Hiring Organization Social Links', 'schema-package' ),
        'button_text' => esc_html__( 'Add Another Social Links', 'schema-package' ),
        'type'          => 'repeater', 
        'display'       => true,
        'elements'      => [
            [
                'url'     => $url,                                            
            ]
        ]                                                                                                                      
    ];    

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
                'placeholder' => esc_attr__( 'TELECOMMUTE', 'schema-package' ),
	            'label'       => esc_html__( 'Job Location Type', 'schema-package' ),                   
                'type'        => 'text',                                                    
                'value'       => '',
                'display'     => true
            ],
            'education_requirements'      => [                              
                'placeholder' => esc_attr__( 'Bachelor Degree', 'schema-package' ),
	            'label'       => esc_html__( 'Education Requirements', 'schema-package' ),                    
                'type'        => 'text',                                                        
                'value'       => '',
                'display'     => true
            ],
            'experience_requirements'      => [                             
                'placeholder' => '36',                                                                                                                       
                'label'       => esc_html__( 'Experience Requirements', 'schema-package' ),                   
                'type'        => 'text',                                                                  
                'value'       => '',
                'display'     => true
            ],
            'identifier_name'      => [                                     
                'placeholder' => esc_attr__( 'MagsRUs Wheel Company', 'schema-package' ),
	            'label'       => esc_html__( 'Identifier Name', 'schema-package' ),                   
                'type'        => 'text',                                                    
                'value'       => '',
                'display'     => true
            ],
            'identifier_value'      => [                                      
                'placeholder' => '1234567',                                                                                                         
                'label'       => esc_html__( 'Identifier Value', 'schema-package' ),                   
                'type'        => 'number',                                                                       
                'value'       => '',
                'display'     => true
            ],
            'hiring_org_name'      => [                                     
                'placeholder' => esc_attr__( 'MagsRUs Wheel Company', 'schema-package' ),
	            'label'       => esc_html__( 'Hiring Organization Name', 'schema-package' ),                    
                'type'        => 'text',                                                    
                'value'       => '',
                'display'     => true
            ],
            'social_links'  => $social_links,                                
            'hiring_org_logo'      => [                                                                                                                                              
                'label'    => esc_html__( 'Hiring Organization Logo', 'schema-package' ),                   
                'type'        => 'media',                                                                                          
                'multiple'    => false,
                'value'       => [],
                'display'     => true
            ],
            'b_salary_currency' => [                                        
                'placeholder' => esc_attr__( 'USD', 'schema-package' ),
	            'label'       => esc_html__( 'Base Salary Currency', 'schema-package' ),                   
                'type'        => 'text',                                                                       
                'value'       => '',
                'display'     => true
            ],                                
            'b_salary' => [                                                   
                'placeholder' => '40.00',                                                                                            
                'label'       => esc_html__( 'Base Salary', 'schema-package' ),                  
                'type'        => 'number',                                                                       
                'value'       => '',
                'display'     => true
            ],
            'b_salary_min' => [                                               
                'placeholder' => '40.00',                                                                                               
                'label'       => esc_html__( 'Base Salary Minimum', 'schema-package' ),                   
                'type'        => 'number',                                                                        
                'value'       => '',
                'display'     => true
            ],
            'b_salary_max' => [                                               
                'placeholder' => '50.00',                                                                                                
                'label'       => esc_html__( 'Base Salary Maximum', 'schema-package' ),                    
                'type'        => 'number',                                                                       
                'value'       => '',
                'display'     => true
            ],
            'b_salary_unit_text' => [                                                                                                                                              
                'label'   => esc_html__( 'Base Salary Unit Text', 'schema-package' ),                  
                'type'        => 'select',                                                                                            
                'value'       => 'HOUR',
                'options'     => [
                        'HOUR'  => esc_html__( 'HOUR', 'schema-package' ),
                        'DAY'   => esc_html__( 'DAY', 'schema-package' ),
                        'WEEK'  => esc_html__( 'WEEK', 'schema-package' ),
                        'MONTH' => esc_html__( 'MONTH', 'schema-package' ),
                        'YEAR'  => esc_html__( 'YEAR', 'schema-package' ),
                ],
                'display'     => true
            ],
            'job_location' => [                            
                'label'       => esc_html__( 'Job Location', 'schema-package' ),
	            'button_text' => esc_html__( 'Add Another Location', 'schema-package' ), 
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