<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_howto( $schema_id, $common_properties ) {

    extract( $common_properties );

    $hours['label']    = 'Duration ( Hours )';
    $minutes['label']  = 'Duration ( minutes )';
    $seconds['label']  = 'Duration ( seconds )';

    $video_name['display']        = false;
    $video_description['display'] = false;
    $content_url['display']       = false;
    $embed_url['display']         = false;
    $upload_date['display']       = false;
    $hours['display']             = false;
    $minutes['display']           = false;
    $seconds['display']           = false;                             

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'howto',
        'text'              => 'HowTo',
        'properties'        => [ 
                'id'                  => $id,
                'name'                => $name,
                'description'         => $description,                            
                'e_cost_currency'     => $e_cost_currency,
                'e_cost_value'        => $e_cost_value,
                'days_needed'         => $days_needed,
                'hours_needed'        => $hours_needed,
                'minutes_needed'      => $minutes_needed,
                'image'               => $image,
                'is_paywalled'        => $is_paywalled,
                'paywalled_selectors' => $paywalled_selectors,
                'include_video'       => $include_video,                              
                'video_name'          => $video_name,    
                'video_description'   => $video_description,                            
                'content_url'         => $content_url,
                'embed_url'           => $embed_url,
                'thumbnail_image'     => [                                                      
                        'label'       => 'Thumbnail Image',                    
                        'type'        => 'media',
                        'class'       => ['smpg_common_properties'],
                        'multiple'    => false,
                        'value'       => [],
                        'recommended' => true,
                        'display'     => false,
                        'tooltip'     => 'An image of the item. This can be a URL or a fully described ImageObject.'
                ],
                'upload_date'         => $upload_date,
                'hours'               => $hours,
                'minutes'             => $minutes,
                'seconds'             => $seconds,                            
                'supplies' => [                            
                    'label'         => 'Supplies',    
                    'button_text'   => 'Add More Supply', 
                    'type'          => 'repeater', 
                    'display'     => true,
                    'elements'      => [    
                                            [
                                                'name'   => $name,
                                                'url'   => $url,
                                                'image' => $image                                                           
                                            ]
                                            
                                        ]
                    ],
                'tools' => [                                
                            'label'         => 'Tools',    
                            'button_text'   => 'Add More Tool', 
                            'type'          => 'repeater',
                            'display'     => true, 
                            'elements'      => [    
                                        [
                                                'name'   => $name,
                                                'url'   => $url,
                                                'image' => $image                                                           
                                        ]
                                        
                                    ]
                        ],
                'steps'  =>   [                        
                'label'         => 'Steps',    
                'button_text'   => 'Add More Step', 
                'type'          => 'repeater',
                'display'     => true, 
                'elements'      => [    
                                [
                                    'name'           => $name,
                                    'description'    => $description,                                                                                                
                                    'image'          => $image,
                                    'clip_name'      => [                                                                                                                                              
                                        'label'       => 'Clip Name',                    
                                        'type'        => 'text',
                                        'class'       => ['smpg_common_properties'],
                                        'placeholder' => 'Name',                    
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                    'clip_start_offset'      => [                                                                                                                                              
                                        'label'       => 'Clip Start Offset',                    
                                        'type'        => 'number',
                                        'class'       => ['smpg_common_properties'],
                                        'placeholder' => '29',                    
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                    'clip_end_offset'      => [                                                                                                                                              
                                        'label'       => 'Clip End Offset',                    
                                        'type'        => 'number',
                                        'class'       => ['smpg_common_properties'],
                                        'placeholder' => '36',                    
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                ]
                                
                            ]
                ]

        ]
    ];

    return $properties;
}