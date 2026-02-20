<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_recipe( $schema_id, $common_properties ) {

    extract( $common_properties );

    $hours['label']   = esc_html__( 'Duration (Hours)', 'schema-package' );
    $minutes['label'] = esc_html__( 'Duration (Minutes)', 'schema-package' );
    $seconds['label'] = esc_html__( 'Duration (Seconds)', 'schema-package' );

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
        'id'                => 'recipe',           
        'text'              => 'Recipe',
        'properties'        => [
            'id'               => $id,
            'name'             => $name,    
            'description'      => $description,
            'url'              => $url,                                                                                    
            'in_language'      => $in_language,
            'image'            => $image,     
            'date_published'   => $date_published,
            'keywords'         => $keywords,
            'prep_time' => [
                'placeholder' => 'MM',
                'label'       => esc_html__( 'Preparation Time (Minutes)', 'schema-package' ),
                'type'        => 'number',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
            ],
            'cook_time' => [
                'placeholder' => '20',
                'label'       => esc_html__( 'Cooking Time (Minutes)', 'schema-package' ),
                'type'        => 'number',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
            ],
            'total_time'        => [
                    'placeholder' => '30',                    
                    'label'       => esc_html__( 'Total Time (Minutes)', 'schema-package' ),
                    'type'        => 'number',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ], 
            'recipe_yield'        => [
                    'placeholder' => '50',                    
                    'label'       => esc_html__( 'Number Of Servings', 'schema-package' ),
                    'type'        => 'number',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ], 
            'recipe_category' => [
                'placeholder' => esc_attr__( 'Recipe Category', 'schema-package' ),
                'label'       => esc_html__( 'Recipe Category', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
            ],
            'recipe_cuisine' => [
                'placeholder' => esc_attr__( 'Recipe Cuisine', 'schema-package' ),
                'label'       => esc_html__( 'Recipe Cuisine', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
            ],                            
            'calories' => [
                'placeholder' => esc_attr__( '240 calories', 'schema-package' ),
                'label'       => esc_html__( 'Calories', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'calories'
                ]                                
            ],
            'carbohydrate' => [
                'placeholder' => esc_attr__( '9 grams carbohydrates', 'schema-package' ),
                'label'       => esc_html__( 'Carbohydrate Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'carbohydrateContent'
                ]
            ],
            'cholesterol' => [
                'placeholder' => esc_attr__( '10 milligrams cholesterol', 'schema-package' ),
                'label'       => esc_html__( 'Cholesterol Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'cholesterolContent'
                ]
            ],
            'fat' => [
                'placeholder' => esc_attr__( '11 grams fat', 'schema-package' ),
                'label'       => esc_html__( 'Fat Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'fatContent'
                ]
            ],
            'fiber' => [
                'placeholder' => esc_attr__( '15 grams fiber', 'schema-package' ),
                'label'       => esc_html__( 'Fiber Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'fiberContent'
                ]
            ],
            'protein' => [
                'placeholder' => esc_attr__( '10 grams protein', 'schema-package' ),
                'label'       => esc_html__( 'Protein Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'proteinContent'
                ]
            ],
            'saturated_fat' => [
                'placeholder' => esc_attr__( '5 grams saturated fat', 'schema-package' ),
                'label'       => esc_html__( 'Saturated Fat Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'saturatedFatContent'
                ]
            ],
            'sodium' => [
                'placeholder' => esc_attr__( '3 milligrams sodium', 'schema-package' ),
                'label'       => esc_html__( 'Sodium Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'sodiumContent'
                ]
            ],
            'sugar' => [
                'placeholder' => esc_attr__( '15 grams sugar', 'schema-package' ),
                'label'       => esc_html__( 'Sugar Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',                                
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'sugarContent'
                ]
            ],
            'trans_fat' => [
                'placeholder' => esc_attr__( '12 grams trans fat', 'schema-package' ),
                'label'       => esc_html__( 'Trans Fat Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',                                 
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'transFatContent'
                ]
            ],
            'unsaturated_fat' => [
                'placeholder' => esc_attr__( '16 grams unsaturated fat', 'schema-package' ),
                'label'       => esc_html__( 'Unsaturated Fat Content', 'schema-package' ),
                'type'        => 'text',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => '',
                'parent_data'   => [
                    'key'       => 'nutrition', 
                    'type'      => 'NutritionInformation',
                    'child_key' => 'unsaturatedFatContent'
                ]
            ],                            
            'include_video'       => $include_video,                              
            'video_name'          => $video_name,    
            'video_description'   => $video_description,                            
            'content_url'         => $content_url,
            'embed_url'           => $embed_url,
            'thumbnail_image'     => [                                                      
                    'label' => esc_html__( 'Thumbnail Image', 'schema-package' ),                  
                    'type'        => 'media',
                    'class'       => ['smpg_common_properties'],
                    'multiple'    => false,
                    'value'       => [],
                    'recommended' => true,
                    'display'     => false,
                    'tooltip'     => esc_html__( 'An image of the item. This can be a URL or a fully described ImageObject.', 'schema-package' )
            ],
            'upload_date'         => $upload_date,
            'hours'               => $hours,
            'minutes'             => $minutes,
            'seconds'             => $seconds,                                                                  
            'author_type'      => $author_type,
            'author_name'      => $author_name,                            
            'publisher_name'   => $publisher_name,
            'publisher_logo'   => $publisher_logo,
            'rating_value'     => $rating_value,
            'best_rating'      => $best_rating,
            'worst_rating'     => $worst_rating,
            'rating_count'     => $rating_count,
            'review_count'     => $review_count,
            'recipe_ingredient' => [
                'label'         => esc_html__( 'Recipe Ingredient', 'schema-package' ),
                'button_text'   => esc_html__( 'Add Another Ingredient', 'schema-package' ), 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [['name'   => $name ]]                                                                                                                      
            ],
            'recipe_instructions'  =>   [                        
                'label'       => esc_html__( 'Recipe Instructions', 'schema-package' ),
                'button_text' => esc_html__( 'Add More Instructions', 'schema-package' ),
                'type'          => 'repeater',
                'display'     => true, 
                'elements'      => [    
                                [
                                    'name'           => $name,
                                    'description'    => $description,                                                                                                
                                    'image'          => $image,
                                    'clip_name'      => [                                                                                                                                              
                                        'label'       => esc_html__( 'Clip Name', 'schema-package' ),
                                        'type'        => 'text',
                                        'class'       => ['smpg_common_properties'],
                                        'placeholder' => esc_attr__( 'Name', 'schema-package' ),                    
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                    'clip_start_offset'      => [                                                                                                                                              
                                        'label'       => esc_html__( 'Clip Start Offset', 'schema-package' ),                    
                                        'type'        => 'number',
                                        'class'       => ['smpg_common_properties'],
                                        'placeholder' => '29',                    
                                        'value'       => '',
                                        'display'     => false
                                    ],
                                    'clip_end_offset'      => [                                                                                                                                              
                                        'label'       => esc_html__( 'Clip End Offset', 'schema-package' ),                    
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