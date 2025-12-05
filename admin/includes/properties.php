<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


function smpg_get_schema_properties( $schema_id, $post_id = null, $tag_id = null, $user_id = null ) {

    $common_prop = smpg_get_common_properties( $post_id );

    switch ( $schema_id ) {

        case 'article':
        case 'techarticle':
        case 'newsarticle':
        case 'advertisercontentarticle':
        case 'satiricalarticle':
        case 'scholarlyarticle':
        case 'socialmediaposting':
        case 'creativework':
        case 'report':
        case 'discussionforumposting':
            return smpg_schema_article( $schema_id, $common_prop );        
        case 'webpage':
            return smpg_schema_webpage( $schema_id, $common_prop );
        case 'qna':
            return smpg_schema_qna( $schema_id, $common_prop ); 
        case 'faqpage':
            return smpg_schema_faqpage( $schema_id, $common_prop );
        case 'howto':
            return smpg_schema_howto( $schema_id, $common_prop );
        case 'profilepage':
            return smpg_schema_profilepage( $schema_id, $common_prop );
        case 'book':
            return smpg_schema_book( $schema_id, $common_prop );
        case 'organization':
            return smpg_schema_organization( $schema_id, $common_prop );
        case 'course':
            return smpg_schema_course( $schema_id, $common_prop );
        case 'jobposting':
            return smpg_schema_jobposting( $schema_id, $common_prop );
        case 'vacationrental':
            return smpg_schema_vacationrental( $schema_id, $common_prop );
        case 'localbusiness':
        case 'store':
        case 'bakery':
        case 'barorpub':
        case 'cafeorcoffeeshop':
        case 'fastfoodrestaurant':
        case 'icecreamshop':
        case 'restaurant':
            return smpg_schema_localbusiness( $schema_id, $common_prop );
        case 'certification':
            return smpg_schema_certification( $schema_id, $common_prop );
        case 'service':
        case 'broadcastservice':
        case 'cableorsatelliteservice':
        case 'financialproduct':
        case 'foodservice':
        case 'governmentservice':
        case 'taxiservice':
        case 'webapi':
            return smpg_schema_service( $schema_id, $common_prop );
        case 'event':
            return smpg_schema_event( $schema_id, $common_prop );
        case 'recipe':
            return smpg_schema_recipe( $schema_id, $common_prop );
        case 'videoobject':
            return smpg_schema_videoobject( $schema_id, $common_prop );
        case 'review':
            return smpg_schema_review( $schema_id, $common_prop );
        case 'audioobject':
            return smpg_schema_audioobject( $schema_id, $common_prop );
        case 'softwareapplication':
            return smpg_schema_softwareapplication( $schema_id, $common_prop );
        case 'imagegallery':
            return smpg_schema_imagegallery( $schema_id, $common_prop );
        case 'mediagallery':
            return smpg_schema_mediagallery( $schema_id, $common_prop );
        case 'imageobject':
            return smpg_schema_imageobject( $schema_id, $common_prop );
        case 'photograph':
            return smpg_schema_photograph( $schema_id, $common_prop );
        case 'apartment':
            return smpg_schema_apartment( $schema_id, $common_prop );
        case 'house':
            return smpg_schema_house( $schema_id, $common_prop );
        case 'singlefamilyresidence':
            return smpg_schema_singlefamilyresidence( $schema_id, $common_prop );
        case 'mobileapplication':
            return smpg_schema_mobileapplication( $schema_id, $common_prop );
        case 'trip':
            return smpg_schema_trip( $schema_id, $common_prop );
        case 'musicplaylist':
            return smpg_schema_musicplaylist( $schema_id, $common_prop );
        case 'musicalbum':
            return smpg_schema_musicalbum( $schema_id, $common_prop );
        case 'liveblogposting':
            return smpg_schema_liveblogposting( $schema_id, $common_prop );
        case 'person':
            return smpg_schema_person( $schema_id, $common_prop );
        case 'product':
            return smpg_schema_product( $schema_id, $common_prop );
        case 'customschema':
            return smpg_schema_customschema( $schema_id, $common_prop );                                        
        default:        
            break;
    }

    return [];
}