<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_schema_article( $schema_id, $common_properties ) {

    extract( $common_properties );

    $article_type = [
        'article'                  => 'Article',
        'techarticle'              => 'TechArticle',
        'newsarticle'              => 'NewsArticle',
        'advertisercontentarticle' => 'AdvertiserContentArticle',
        'satiricalarticle'         => 'SatiricalArticle',
        'scholarlyarticle'         => 'ScholarlyArticle',
        'socialmediaposting'       => 'SocialMediaPosting',
        'creativework'             => 'CreativeWork',
        'report'                   => 'Report',
        'discussionforumposting'   => 'DiscussionForumPosting',
    ];

    $properties = [                
            'is_enable'         => true,
            'is_delete_popup'   => false, 
            'is_setup_popup'    => false,
            'has_warning'       => false,
            'id'                => $schema_id,           
            'text'              => $article_type[$schema_id],
            'properties'        => [                    
                'id'                  => $id,
                'headline'            => $headline,
                'description'         => $description,
                'keywords'            => $keywords,
                'word_count'          => $word_count,
                'article_section'     => $article_section,
                'url'                 => $url,
                'in_language'         => $in_language,
                'date_published'      => $date_published,
                'date_modified'       => $date_modified,
                'author_type'         => $author_type,
                'author_name'         => $author_name,
                'author_url'          => $author_url,
                'author_image'        => $author_image,
                'publisher_name'      => $publisher_name,
                'speakable'           => $speakable,
                'speakable_selectors' => $speakable_selectors,        
                'is_paywalled'        => $is_paywalled,
                'paywalled_selectors' => $paywalled_selectors,
                'publisher_logo'      => $publisher_logo,
                'image'               => $image
            ]
        ];

        if ( $schema_id == 'report' ) {
            
            $properties['properties']['report_number'] = [
                                'label'       => 'Report Number',
                                'type'        => 'text',
                                'placeholder' => '75847575',
                                'value'       => '',
                                'display'     => true
                        ];
        }
        
        if ( $schema_id == 'creativework' ) {
            unset( $properties['properties']['word_count'] );
            unset( $properties['properties']['article_section'] );
        }

    return $properties;
}