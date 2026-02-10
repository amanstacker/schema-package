<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_musicrelease( $schema_id, $common_properties ) {

    extract( $common_properties );

    $hours['label']    = 'Duration ( Hours )';
    $minutes['label']  = 'Duration ( minutes )';
    $seconds['label']  = 'Duration ( seconds )';

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
                    'label'       => 'Music Release Format',                    
                    'type'        => 'select',                                                        
                    'value'       => '',
                    'options'     => [
                            ''                           => 'Select',                                                
                            'CDFormat'                   => 'CD Format',
                            'CassetteFormat'             => 'Cassette Format',
                            'DVDFormat'                  => 'DVD Format',
                            'DigitalAudioTapeFormat'     => 'Digital Audio Tape Format',
                            'DigitalFormat'              => 'Digital Format',
                            'LaserDiscFormat'            => 'Laser Disc Format',
                            'VinylFormat'                => 'Vinyl Format',                                                                            
                    ],
                    'display'     => true
                ], 
                'hours'            => $hours,
                'minutes'          => $minutes,
                'seconds'          => $seconds,                
                'catalog_number'      => [                                                                                                                                              
                    'label'       => 'Catalog Number',                    
                    'type'        => 'text',                                    
                    'placeholder' => 'SWBO 101',                    
                    'value'       => '',
                    'display'     => true
                ],
                'genre'      => [                                                                                                                                              
                    'label'       => 'Genre',                    
                    'type'        => 'text',                                    
                    'placeholder' => 'Rock, Pop, Jazz...',                    
                    'value'       => '',
                    'display'     => true
                ],                
                'record_label'      => [                                                                                                                                              
                    'label'       => 'Record Label',                    
                    'type'        => 'text',                                    
                    'placeholder' => 'Record Label',                    
                    'value'       => '',
                    'display'     => true
                ],
                'record_label_id'      => [                                                                                                                                              
                    'label'       => 'Record Label ID',                    
                    'type'        => 'text',                                    
                    'placeholder' => 'Record Label ID',                    
                    'value'       => '',
                    'display'     => true
                ],
                'producers' => [                            
                    'label'         => 'Producers',    
                    'button_text'   => 'Add More Producers', 
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