<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_course( $schema_id, $common_properties ) {

    extract( $common_properties );

    $start_date['label'] = 'Course Schedule Start Date';
    $end_date['label']   = 'Course Schedule End Date';

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
                'label'         => 'Course Instance',
                'button_text'   => 'Add More Course Instance', 
                'type'          => 'repeater', 
                'display'     => true,
                'elements'      => [    
                                        [                                                          
                                            'course_mode' => [                                                                                                                                              
                                                'label'       => 'Course Mode',                    
                                                'type'        => 'select',                                                                                    
                                                'value'       => '',
                                                'options'     => [
                                                        ''           => 'Select',
                                                        'Online'     => 'Online',
                                                        'Onsite'     => 'Onsite',
                                                        'Blended'    => 'Blended',                                                                    
                                                ],
                                                'display'     => true
                                            ],
                                            'location' => [
                                                'label'       => 'Location',                    
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',
                                                'placeholder' => 'Example University',  
                                                'display'     => true
                                            ],
                                            'course_workload' => [
                                                'label'       => 'Course Workload',
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',
                                                'placeholder' => 'PT22H',  
                                                'display'     => true
                                            ],
                                            'repeat_count' => [
                                                'label'       => 'Course Schedule Repeat Count',
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',
                                                'placeholder' => '6',  
                                                'display'     => true
                                            ],
                                            'repeat_frequency' => [
                                                'label'       => 'Course Schedule Repeat Frequency',
                                                'type'        => 'select',                                                                                    
                                                'value'       => '',
                                                'options'     => [
                                                        ''           => 'Select',
                                                        'Daily'      => 'Daily',
                                                        'Weekly'     => 'Weekly',
                                                        'Monthly'    => 'Monthly',                                                                    
                                                        'Yearly'     => 'Yearly',                                                                    
                                                ],
                                                'display'     => true
                                            ],
                                            'duration' => [
                                                'label'       => 'Course Schedule Duration',
                                                'type'        => 'text',                                                                                    
                                                'value'       => '',
                                                'placeholder' => 'PT1H',  
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