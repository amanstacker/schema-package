<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_howto( $schema_id, $common_properties ) {

    extract( $common_properties );

    $hours['label']   = esc_html__( 'Duration ( Hours )', 'schema-package' );
    $minutes['label'] = esc_html__( 'Duration ( Minutes )', 'schema-package' );
    $seconds['label'] = esc_html__( 'Duration ( Seconds )', 'schema-package' );


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
                        'label'       => esc_html__( 'Thumbnail Image', 'schema-package' ),                    
                        'type'        => 'media',
                        'class'       => ['smpg_common_properties'],
                        'multiple'    => false,
                        'value'       => [],
                        'recommended' => true,
                        'display'     => false,
                        'tooltip'     => esc_html__( 'An image of the item. This can be a URL or a fully described ImageObject.', 'schema-package' ),
                ],
                'upload_date'         => $upload_date,
                'hours'               => $hours,
                'minutes'             => $minutes,
                'seconds'             => $seconds,                            
                'supplies' => [                            
                    'label'       => esc_html__( 'Supplies', 'schema-package' ),
                    'button_text' => esc_html__( 'Add Another Supply', 'schema-package' ),
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
                            'label'       => esc_html__( 'Tools', 'schema-package' ),
                            'button_text' => esc_html__( 'Add Another Tool', 'schema-package' ),
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
                'label'       => esc_html__( 'Steps', 'schema-package' ),
                'button_text' => esc_html__( 'Add Another Step', 'schema-package' ),
                'type'          => 'repeater',
                'display'     => true, 
                'elements'      => [    
                                [
                                    'name'           => $name,
                                    'description'    => $description,                                                                                                
                                    'image'          => $image,
                                    'clip_name'      => [                           
                                        'placeholder' => esc_attr__( 'Name', 'schema-package' ),
                                        'label'       => esc_html__( 'Clip Name', 'schema-package' ),
                                        'type'        => 'text',
                                        'class'       => ['smpg_common_properties'],                                                            
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                    'clip_start_offset'      => [                   
                                        'placeholder' => '29',                                                                                                                             
                                        'label'       => esc_html__( 'Clip Start Offset', 'schema-package' ),                    
                                        'type'        => 'number',
                                        'class'       => ['smpg_common_properties'],                                                          
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                    'clip_end_offset'      => [                     
                                        'placeholder' => '36',                                                                                                                           
                                        'label'       => esc_html__( 'Clip End Offset', 'schema-package' ),
                                        'type'        => 'number',
                                        'class'       => ['smpg_common_properties'],                                                          
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