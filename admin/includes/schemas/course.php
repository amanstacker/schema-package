<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_course( $schema_id, $common_properties ) {

    extract( $common_properties );

    $start_date['label'] = esc_html__( 'Course Schedule Start Date', 'schema-package' );
    $end_date['label']   = esc_html__( 'Course Schedule End Date', 'schema-package' );


    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'course',           
        'text'              => 'Course',
        'properties'        => [
            'id'               => $id,
            'name'             => $name,    
            'description'      => $description,
            'url'              => $url,                                                                                                                    
            'image'            => $image,
            'offer_type'       => $offer_type,                                                   
            'offer_category'   => $offer_category,
            'offer_price'      => $offer_price,
            'low_price'        => $low_price,
            'high_price'       => $high_price,
            'offer_count'      => $offer_count,                             
            'offer_currency'   => $offer_currency,                            
            'publisher_name'   => $publisher_name,
            'publisher_logo'   => $publisher_logo,
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,
            'has_course_instance' => [
                'label'       => esc_html__( 'Course Instance', 'schema-package' ),
                'button_text' => esc_html__( 'Add More Course Instance', 'schema-package' ),
                'type'          => 'repeater', 
                'display'     => true,
                'elements'      => [    
                                        [                                                          
                                            'course_mode' => [                                                                                                                                              
                                                'label' => esc_html__( 'Course Mode', 'schema-package' ),                 
                                                'type'        => 'select',                                                                                    
                                                'value'       => '',
                                                'options' => [
                                                    ''        => esc_html__( 'Select', 'schema-package' ),
                                                    'Online'  => esc_html__( 'Online', 'schema-package' ),
                                                    'Onsite'  => esc_html__( 'Onsite', 'schema-package' ),
                                                    'Blended' => esc_html__( 'Blended', 'schema-package' ),
                                                ],
                                                'display'     => true
                                            ],
                                            'location' => [
                                                'placeholder' => esc_attr__( 'Example University', 'schema-package' ),  
                                                'label'       => esc_html__( 'Location', 'schema-package' ),                    
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',                                                
                                                'display'     => true
                                            ],
                                            'course_workload' => [
                                                'placeholder' => 'PT22H',  
                                                'label'       => esc_html__( 'Course Workload', 'schema-package' ),
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',                                                
                                                'display'     => true
                                            ],
                                            'repeat_count' => [
                                                'placeholder' => '6',  
                                                'label'       => esc_html__( 'Course Schedule Repeat Count', 'schema-package' ),
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',                                                
                                                'display'     => true
                                            ],
                                            'repeat_frequency' => [
                                                'label'   => esc_html__( 'Course Schedule Repeat Frequency', 'schema-package' ),
                                                'type'        => 'select',                                                                                    
                                                'value'       => '',
                                                'options' => [
                                                    ''        => esc_html__( 'Select', 'schema-package' ),
                                                    'Daily'   => esc_html__( 'Daily', 'schema-package' ),
                                                    'Weekly'  => esc_html__( 'Weekly', 'schema-package' ),
                                                    'Monthly' => esc_html__( 'Monthly', 'schema-package' ),                                                                    
                                                    'Yearly'  => esc_html__( 'Yearly', 'schema-package' ),                                                                    
                                                ],
                                                'display'     => true
                                            ],
                                            'duration' => [
                                                'placeholder' => 'PT1H',  
                                                'label'       => esc_html__( 'Course Schedule Duration', 'schema-package' ),
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',                                                
                                                'display'     => true
                                            ],                                                           
                                            'start_date'   => $start_date,
                                            'end_date'     => $end_date,                                                                                                                    
                                        ]
                                        
                                ]
                ],    

        ]                      
    ];

    return $properties;
}