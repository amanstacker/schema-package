<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_faqpage( $schema_id, $common_properties ) {

    extract( $common_properties );

    $properties = [                
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'faqpage',
        'text'              => 'FAQs',
        'properties'        => [                    
                'main_entity' =>    [                            
                    'label'       => esc_html__( 'Main Entity', 'schema-package' ),
                    'button_text' => esc_html__( 'Add More Faqs', 'schema-package' ),
                    'type'          => 'repeater',
                    'display'     => true, 
                    'elements'      => [    
                                            [
                                                'question' => $question,
                                                'answer'   => $answer,                                                       
                                                'image'    => $image,
                                            ]                                                    
                                        ]
                    ]                                                                                        
        ]
    ];

    return $properties;
}