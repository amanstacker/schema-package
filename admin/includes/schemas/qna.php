<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_qna( $schema_id, $common_properties ) {

    extract( $common_properties );

    $qna_answer = [
        'text' => [                     
            'placeholder' => esc_attr__( 'Enter answer text', 'schema-package' ),                                                                                                                         
            'label'       => esc_html__( 'Text', 'schema-package' ),                 
            'type'        => 'textarea',            
            'display'     => true,                    
            'value'       => ''
        ],
        'date_created' => $date_created,                
        'vote' => [                   
            'placeholder' => 1236,                                                                                                                           
            'label'       => esc_html__( 'Up Vote Count', 'schema-package' ),                    
            'type'        => 'number',             
            'display'     => true,                   
            'value'       => ''
        ],
        'url' => [                  
            'placeholder' => 'https://example.com/question1#acceptedAnswer',                                                                                                                            
            'label'       => esc_html__( 'URL', 'schema-package' ),                   
            'type'        => 'text',                                
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
                'placeholder' => esc_attr__( 'Enter question title', 'schema-package' ),                                                                                                                                       
                'label'       => esc_html__( 'Question Title', 'schema-package' ),                   
                'type'        => 'text',                
                'value'       => '',
                'display'     => true,
            ],
            'q_description' => [            
                'placeholder' => esc_attr__( 'Enter question description', 'schema-package' ),                                                                                                                                  
                'label'       => esc_html__( 'Question Description', 'schema-package' ),                   
                'type'        => 'textarea',                
                'value'       => '',
                'display'     => true,
            ],
            'q_up_vote_count' => [        
                'placeholder' => 26,                                                                                                                                        
                'label'       => esc_html__( 'Question Upvote Count', 'schema-package' ),                    
                'type'        => 'number',                                  
                'value'       => '',
                'display'     => true,
            ],
            'q_date_created' => [       
                'placeholder' => '2016-07-23T21:11Z',                                                                                                                                                           
                'label'       => esc_html__( 'Question Date Created', 'schema-package' ),                    
                'type'        => 'text',                
                'value'       => '',
                'display'     => true,
            ],
            'author_type' => $author_type,
            'author_name' => $author_name,  
            'a_count' => [                
                'placeholder' => 5,                                                                                                                                      
                'label'       => esc_html__( 'Answer Count', 'schema-package' ),                  
                'type'        => 'number',                            
                'value'       => '',
                'display'     => true,
            ],
            'accepted_answers' =>    [                            
                'label'       => esc_html__( 'Accepted Answers', 'schema-package' ),  
                'button_text' => esc_html__( 'Add Another Accepted Answer', 'schema-package' ), 
                'type'        => 'repeater',
                'display'     => true, 
                'elements'    => [$qna_answer]
            ],
            'suggested_answers' =>    [                            
                'label'       => esc_html__( 'Suggested Answers', 'schema-package' ),
			    'button_text' => esc_html__( 'Add Another Suggested Answer', 'schema-package' ), 
                'type'        => 'repeater',
                'display'     => true, 
                'elements'    => [$qna_answer]                                                                                        
            ]
        ]
    ];
    return $properties;
}