<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Schema Type → File Mapping
 * Multiple schema types load the same PHP file.
 */
$smpg_schema_map = [

    // -------------------------------
    // Article-based schemas → article.php
    // -------------------------------
    'article'                   => 'article.php',
    'techarticle'               => 'article.php',
    'newsarticle'               => 'article.php',
    'advertisercontentarticle'  => 'article.php',
    'satiricalarticle'          => 'article.php',
    'scholarlyarticle'          => 'article.php',
    'socialmediaposting'        => 'article.php',
    'creativework'              => 'article.php',
    'report'                    => 'article.php',
    'discussionforumposting'    => 'article.php',

    // -------------------------------
    // LocalBusiness-based schemas → localbusiness.php
    // -------------------------------
    'localbusiness'             => 'localbusiness.php',
    'store'                     => 'localbusiness.php',
    'bakery'                    => 'localbusiness.php',
    'barorpub'                  => 'localbusiness.php',
    'cafeorcoffeeshop'          => 'localbusiness.php',
    'fastfoodrestaurant'        => 'localbusiness.php',
    'icecreamshop'              => 'localbusiness.php',
    'restaurant'                => 'localbusiness.php',

    // -------------------------------
    // Service-based schemas → service.php
    // -------------------------------
    'service'                   => 'service.php',
    'broadcastservice'          => 'service.php',
    'cableorsatelliteservice'   => 'service.php',
    'financialproduct'          => 'service.php',
    'foodservice'               => 'service.php',
    'governmentservice'         => 'service.php',
    'taxiservice'               => 'service.php',
    'webapi'                    => 'service.php',

    // -------------------------------
    // Standalone schemas (1:1 mapping)
    // -------------------------------
    'product'                   => 'product.php',
    'softwareapplication'       => 'softwareapplication.php',
    'book'                      => 'book.php',
    'faqpage'                   => 'faqpage.php',
    'howto'                     => 'howto.php',
    'qna'                       => 'qna.php',
    'event'                     => 'event.php',
    'recipe'                    => 'recipe.php',
    'videoobject'               => 'videoobject.php',
    'course'                    => 'course.php',
    'jobposting'                => 'jobposting.php',
    'customschema'              => 'customschema.php',
    'liveblogposting'           => 'liveblogposting.php',
    'person'                    => 'person.php',
    'musicalbum'                => 'musicalbum.php',
    'musicplaylist'             => 'musicplaylist.php',
    'audioobject'               => 'audioobject.php',
    'trip'                      => 'trip.php',
    'mobileapplication'         => 'mobileapplication.php',
    'singlefamilyresidence'     => 'singlefamilyresidence.php',
    'house'                     => 'house.php',
    'apartment'                 => 'apartment.php',
    'photograph'                => 'photograph.php',
    'imageobject'               => 'imageobject.php',
    'mediagallery'              => 'mediagallery.php',
    'imagegallery'              => 'imagegallery.php',
    'review'                    => 'review.php',
    'profilepage'               => 'profilepage.php',
    'webpage'                   => 'webpage.php',
    'organization'              => 'organization.php',
    'certification'             => 'certification.php',
    'vacationrental'            => 'vacationrental.php',
];

/**
 * Common properties loader
 */
require_once SMPG_PLUGIN_DIR_PATH . 'admin/includes/properties-common.php';

/**
 * Auto-load all schema files based on mapping
 */
foreach ( $smpg_schema_map as $schema_type => $file_name ) {

    $file = SMPG_PLUGIN_DIR_PATH . 'admin/includes/schemas/' . $file_name;

    if ( file_exists( $file ) ) {
        require_once $file;
    }
}
