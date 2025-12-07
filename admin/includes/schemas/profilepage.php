<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_profilepage( $schema_id, $common_properties ) {

    extract( $common_properties );

    $social_links = [                            
        'label'         => 'Person Social Links',
        'button_text'   => 'Add More Social Links', 
        'type'          => 'repeater', 
        'display'       => true,
        'elements'      => [
            [
                'url'     => $url,                                            
            ]
        ]                                                                                                                      
    ];

    $image['label']          = 'Person Image';
    $name['label']           = 'Person Name';
    $alternate_name['label'] = 'Person Alternate Name';
    $description['label']    = 'Person Description';                        

    $properties = [
        'is_enable'         => true,
        'is_delete_popup'   => false, 
        'is_setup_popup'    => false,
        'has_warning'       => false,
        'id'                => 'profilepage',           
        'text'              => 'ProfilePage',
        'properties'        => [
            'id'               => $id,
            'date_created'     => $date_created,    
            'date_modified'    => $date_modified,
            'url'              => $url,
            'in_language'      => $in_language,
            'name'             => $name,
            'alternate_name'   => $alternate_name,
            'identifier'       => $identifier,
            'description'      => $description,
            'image'            => $image,
            'follow_count'     => $follow_count,                            
            'like_count'       => $like_count,                            
            'comment_count'    => $comment_count,
            'share_count'      => $share_count,
            'post_count'       => $post_count,
            'social_links'     => $social_links,
        ]                      
    ];

    return $properties;
}