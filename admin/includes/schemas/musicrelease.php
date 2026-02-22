<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_musicrelease( $schema_id, $common_properties ) {

    extract( $common_properties );

    $hours['label']   = esc_html__( 'Duration ( Hours )', 'schema-package' );
    $minutes['label'] = esc_html__( 'Duration ( Minutes )', 'schema-package' );
    $seconds['label'] = esc_html__( 'Duration ( Seconds )', 'schema-package' );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'musicrelease',
        'text'              => 'MusicRelease',
        'properties'        => [
                'id'                   => $id,
                'name'                 => $name,
                'alternate_name'       => $alternate_name, 
                'description'          => $description,
                'url'                  => $url,
                'in_language'          => $in_language,
                'date_published'       => $date_published,
                'date_modified'        => $date_modified,                
                'image'                => $image,                
                'music_release_format' => [                                                                                                                                              
                    'label'   => esc_html__( 'Music Release Format', 'schema-package' ),                   
                    'type'        => 'select',                                                        
                    'value'       => '',
                    'options' => [
                        ''                         => esc_html__( 'Select', 'schema-package' ),
                        'CDFormat'                 => esc_html__( 'CD Format', 'schema-package' ),
                        'CassetteFormat'           => esc_html__( 'Cassette Format', 'schema-package' ),
                        'DVDFormat'                => esc_html__( 'DVD Format', 'schema-package' ),
                        'DigitalAudioTapeFormat'   => esc_html__( 'Digital Audio Tape Format', 'schema-package' ),
                        'DigitalFormat'            => esc_html__( 'Digital Format', 'schema-package' ),
                        'LaserDiscFormat'          => esc_html__( 'Laser Disc Format', 'schema-package' ),
                        'VinylFormat'              => esc_html__( 'Vinyl Format', 'schema-package' ),
                    ],
                    'display'     => true
                ], 
                'hours'            => $hours,
                'minutes'          => $minutes,
                'seconds'          => $seconds,                
                'catalog_number'      => [  
                    'placeholder' => esc_attr__( 'SWBO 101', 'schema-package' ),                                                                                                                                            
                    'label'       => esc_html__( 'Catalog Number', 'schema-package' ),                   
                    'type'        => 'text',                                                        
                    'value'       => '',
                    'display'     => true
                ],
                'genre'      => [       
                    'placeholder' => esc_attr__( 'Rock, Pop, Jazz...', 'schema-package' ),                                                                                                                                       
                    'label'       => esc_html__( 'Genre', 'schema-package' ),                    
                    'type'        => 'text',                                                        
                    'value'       => '',
                    'display'     => true
                ],                
                'record_label'      => [  
                    'placeholder' => esc_attr__( 'Record Label', 'schema-package' ),                                                                                                                                            
                    'label'       => esc_html__( 'Record Label', 'schema-package' ),                   
                    'type'        => 'text',                                                                          
                    'value'       => '',
                    'display'     => true
                ],
                'record_label_id'      => [    
                    'placeholder' => esc_attr__( 'Record Label ID', 'schema-package' ),                                                                                                                                          
                    'label'       => esc_html__( 'Record Label ID', 'schema-package' ),                    
                    'type'        => 'text',                                                        
                    'value'       => '',
                    'display'     => true
                ],
                'producers' => [                            
                    'label'       => esc_html__( 'Producers', 'schema-package' ),  
                    'button_text' => esc_html__( 'Add Another Producer', 'schema-package' ), 
                    'type'          => 'repeater', 
                    'display'     => true,
                    'elements'      => [    
                                            [
                                                'name'   => $name,                                                                                                                                                          
                                            ]
                                            
                                        ]
                ], 
                'rating_value'     => $rating_value,
                'best_rating'      => $best_rating,
                'worst_rating'     => $worst_rating,
                'rating_count'     => $rating_count,
                'review_count'     => $review_count,                                               

        ]                      
    ];

    return $properties;
}