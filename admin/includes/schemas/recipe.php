<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_recipe( $schema_id, $common_properties ) {

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
            'prep_time'        => [
                'placeholder' => 'MM',                    
                'label'       => 'Prepare Time',
                'type'        => 'number',
                'value'       => '',
                'recommended' => true,
                'display'     => true,
                'tooltip'     => ''    
            ],
            'cook_time'        => [
                    'placeholder' => '20',                    
                    'label'       => 'Cooking Time',
                    'type'        => 'number',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ],
            'total_time'        => [
                    'placeholder' => '30',                    
                    'label'       => 'Total Time',
                    'type'        => 'number',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ], 
            'recipe_yield'        => [
                    'placeholder' => '50',                    
                    'label'       => 'Number Of Servings',
                    'type'        => 'number',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ], 
            'recipe_category' => [
                    'placeholder' => 'Recipe Category',
                    'label'       => 'Recipe Category',
                    'type'        => 'text',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ],
            'recipe_cuisine' => [
                    'placeholder' => 'Recipe Cuisine',                    
                    'label'       => 'Recipe Cuisine',
                    'type'        => 'text',
                    'value'       => '',
                    'recommended' => true,
                    'display'     => true,
                    'tooltip'     => ''    
            ],                            
            'calories' => [
                'placeholder' => '240 calories',                    
                'label'       => 'Calories',
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
                'placeholder' => '9 grams carbohydrates',                    
                'label'       => 'Carbohydrate Content',
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
                'placeholder' => '10 milligrams cholesterol',                    
                'label'       => 'Cholesterol Content',
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
                'placeholder' => '11 grams fat',                    
                'label'       => 'Fat Content',
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
                'placeholder' => '15 grams fiber',
                'label'       => 'Fiber Content',
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
                'placeholder' => '10 grams protein',                    
                'label'       => 'Protein Content',
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
                'placeholder' => '5 grams saturated fat',                    
                'label'       => 'Saturated Fat Content',
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
                'placeholder' => '3 milligrams sodium',                    
                'label'       => 'Sodium Content',
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
                'placeholder' => '15 grams sugar',                    
                'label'       => 'Sugar Content',
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
                'placeholder' => '12 grams trans fat',                    
                'label'       => 'Trans Fat Content',
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
                'placeholder' => '16 grams unsaturated fat',                    
                'label'       => 'Unsaturated Fat Content',
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
                'label'         => 'Recipe Ingredient',
                'button_text'   => 'Add More Ingredient', 
                'type'          => 'repeater', 
                'display'       => true,
                'elements'      => [['name'   => $name ]]                                                                                                                      
            ],
            'recipe_instructions'  =>   [                        
                'label'         => 'Recipe Instructions',    
                'button_text'   => 'Add More Instructions', 
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