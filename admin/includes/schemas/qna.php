<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_qna( $schema_id, $common_properties ) {

    extract( $common_properties );

    $qna_answer = [
        'text' => [                                                                                                                                              
            'label'       => 'Text',                    
            'type'        => 'textarea',
            'placeholder' => 'Enter answer text',
            'display'     => true,                    
            'value'       => ''
        ],
        'date_created' => $date_created,                
        'vote' => [                                                                                                                                              
            'label'       => 'Up Vote Count',                    
            'type'        => 'number',
            'placeholder' => 1236, 
            'display'     => true,                   
            'value'       => ''
        ],
        'url' => [                                                                                                                                              
            'label'       => 'URL',                    
            'type'        => 'text',
            'placeholder' => 'https://example.com/question1#acceptedAnswer',                    
            'display'     => true,
            'value'       => ''
        ],
        'author_name' => $author_name                 
    ];

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'qna',
        'text'              => 'Q&A',
        'properties'        => [         
            'id'                  => $id,            
            'q_title' => [                                                                                                                                              
                'label'       => 'Question Title',                    
                'type'        => 'text',
                'placeholder' => 'Enter question title',                    
                'value'       => '',
                'display'     => true,
            ],
            'q_description' => [                                                                                                                                              
                'label'       => 'Question Description',                    
                'type'        => 'textarea',
                'placeholder' => 'Enter question description',                    
                'value'       => '',
                'display'     => true,
            ],
            'q_up_vote_count' => [                                                                                                                                              
                'label'       => 'Question Upvote Count',                    
                'type'        => 'number',
                'placeholder' => 26,                    
                'value'       => '',
                'display'     => true,
            ],
            'q_date_created' => [                                                                                                                                              
                'label'       => 'Question Date Created',                    
                'type'        => 'text',
                'placeholder' => '2016-07-23T21:11Z',                    
                'value'       => '',
                'display'     => true,
            ],
            'author_type' => $author_type,
            'author_name' => $author_name,  
            'a_count' => [                                                                                                                                              
                'label'       => 'Answer Count',                    
                'type'        => 'number',
                'placeholder' => 5,                    
                'value'       => '',
                'display'     => true,
            ],
            'accepted_answers' =>    [                            
                'label'         => 'Accepted Answers',    
                'button_text'   => 'Add More Accepted Answer', 
                'type'          => 'repeater',
                'display'     => true, 
                'elements'      => [$qna_answer]
            ],
            'suggested_answers' =>    [                            
                'label'         => 'Suggested Answer',    
                'button_text'   => 'Add More Suggested Answer', 
                'type'          => 'repeater',
                'display'     => true, 
                'elements'      => [$qna_answer]                                                                                        
            ]
        ]
    ];
    return $properties;
}