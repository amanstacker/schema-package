<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_liveblogposting( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'liveblogposting',
        'text'              => 'LiveBlogPosting',
        'properties'        => [
                'id'                   => $id,
                'headline'             => $headline, 
                'description'          => $description, 
                'url'                  => $url,
                'date_published'       => $date_published,
                'date_modified'        => $date_modified,
                'coverage_start_time' => [                        
                    'placeholder' => '2015-02-05T08:00:00+08:00',                    
                    'label'       => esc_html__( 'Coverage Start Time', 'schema-package' ),                   
                    'type'        => 'text',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => esc_html__( 'The time when the live blog will begin covering the Event.', 'schema-package' )
                ], 
                'coverage_end_time' => [                        
                    'placeholder' => '2015-02-05T08:00:00+08:00',                    
                    'label'       => esc_html__( 'Coverage End Time', 'schema-package' ),                   
                    'type'        => 'text',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => esc_html__( 'The time when the live blog will stop covering the Event. Note that coverage may continue after the Event concludes.', 'schema-package' )
                ],
                'live_blog_update' => [                            
                    'label'       => esc_html__( 'Live Blog Updates', 'schema-package' ),
                    'button_text' => esc_html__( 'Add Another Blog Update', 'schema-package' ),
                    'type'          => 'repeater', 
                    'display'     => true,
                    'elements'      => [    
                                            [
                                                'headline'             => $headline,                                                                                                 
                                                'date_published'       => $date_published,
                                                'article_body'         => $article_body,                                       
                                            ]
                                            
                                        ]
                    ],                                                                                               
            ]                      
    ];

    return $properties;
}