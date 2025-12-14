<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_get_schema_properties( $schema_id, $post_id = null, $tag_id = null, $user_id = null ) {

    $common_prop = smpg_get_common_properties( $post_id );

    // ---------------------------------
    // Core schema → callback mapping
    // ---------------------------------
    $handlers = [

        // Article family
        'article'                   => 'smpg_schema_article',
        'techarticle'               => 'smpg_schema_article',
        'newsarticle'               => 'smpg_schema_article',
        'advertisercontentarticle'  => 'smpg_schema_article',
        'satiricalarticle'          => 'smpg_schema_article',
        'scholarlyarticle'          => 'smpg_schema_article',
        'socialmediaposting'        => 'smpg_schema_article',
        'creativework'              => 'smpg_schema_article',
        'report'                    => 'smpg_schema_article',
        'discussionforumposting'    => 'smpg_schema_article',

        // Individual handlers
        'webpage'               => 'smpg_schema_webpage',
        'qna'                   => 'smpg_schema_qna',
        'faqpage'               => 'smpg_schema_faqpage',
        'howto'                 => 'smpg_schema_howto',
        'profilepage'           => 'smpg_schema_profilepage',
        'book'                  => 'smpg_schema_book',
        'organization'          => 'smpg_schema_organization',
        'course'                => 'smpg_schema_course',
        'jobposting'            => 'smpg_schema_jobposting',
        'vacationrental'        => 'smpg_schema_vacationrental',

        // Local business family
        'localbusiness'         => 'smpg_schema_localbusiness',
        'store'                 => 'smpg_schema_localbusiness',
        'bakery'                => 'smpg_schema_localbusiness',
        'barorpub'              => 'smpg_schema_localbusiness',
        'cafeorcoffeeshop'      => 'smpg_schema_localbusiness',
        'fastfoodrestaurant'    => 'smpg_schema_localbusiness',
        'icecreamshop'          => 'smpg_schema_localbusiness',
        'restaurant'            => 'smpg_schema_localbusiness',

        // Service family
        'certification'         => 'smpg_schema_certification',
        'service'               => 'smpg_schema_service',
        'broadcastservice'      => 'smpg_schema_service',
        'cableorsatelliteservice'=> 'smpg_schema_service',
        'financialproduct'      => 'smpg_schema_service',
        'foodservice'           => 'smpg_schema_service',
        'governmentservice'     => 'smpg_schema_service',
        'taxiservice'           => 'smpg_schema_service',
        'webapi'                => 'smpg_schema_service',

        // Media & misc schemas
        'event'                 => 'smpg_schema_event',
        'recipe'                => 'smpg_schema_recipe',
        'videoobject'           => 'smpg_schema_videoobject',
        'review'                => 'smpg_schema_review',
        'audioobject'           => 'smpg_schema_audioobject',
        'softwareapplication'   => 'smpg_schema_softwareapplication',
        'imagegallery'          => 'smpg_schema_imagegallery',
        'mediagallery'          => 'smpg_schema_mediagallery',
        'imageobject'           => 'smpg_schema_imageobject',
        'photograph'            => 'smpg_schema_photograph',

        // Real estate
        'apartment'             => 'smpg_schema_apartment',
        'house'                 => 'smpg_schema_house',
        'singlefamilyresidence' => 'smpg_schema_singlefamilyresidence',

        // Misc
        'mobileapplication'     => 'smpg_schema_mobileapplication',
        'trip'                  => 'smpg_schema_trip',
        'musicplaylist'         => 'smpg_schema_musicplaylist',
        'musicalbum'            => 'smpg_schema_musicalbum',
        'liveblogposting'       => 'smpg_schema_liveblogposting',
        'person'                => 'smpg_schema_person',
        'product'               => 'smpg_schema_product',
        'customschema'          => 'smpg_schema_customschema',
    ];

    // Allow PRO to inject new schema handlers
    $handlers = apply_filters( 'smpg_extra_schema_handlers', $handlers );

    // Return mapped handler if available
    if ( isset( $handlers[ $schema_id ] ) && function_exists( $handlers[ $schema_id ] ) ) {        

        $result = call_user_func( $handlers[ $schema_id ], $schema_id, $common_prop );
        $result = apply_filters( 'smpg_change_properties', $result );

        return $result;
    }

    return [];
}
