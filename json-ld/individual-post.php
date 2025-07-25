<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function smpg_get_service_individual_json_ld( $json_ld, $properties, $schema_type ) {
    
    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );    

    if(!empty($properties['name']['value'])){
        $json_ld['name']        =      $properties['name']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['service_type']['value'])){
        $json_ld['serviceType']  =      $properties['service_type']['value'];
    }
    if(!empty($properties['terms_of_service']['value'])){
        $json_ld['termsOfService']  =      $properties['terms_of_service']['value'];
    }        
    
    $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
         $json_ld['image']              =  $image;   
     }     
     
    if(!empty($properties['provider_type']['value'])){
        $json_ld['provider']['@type']                = $properties['provider_type']['value'];
    }
    if(!empty($properties['provider_name']['value'])){
        $json_ld['provider']['name']                 = $properties['provider_name']['value'];
    }
    if(!empty($properties['provider_url']['value'])){
        $json_ld['provider']['url']                 = $properties['provider_url']['value'];
    }
    if(!empty($properties['provider_mobility']['value'])){
        $json_ld['provider']['providerMobility']     = $properties['provider_mobility']['value'];
    }     
    if(!empty($properties['street_address']['value'])){
        $json_ld['provider']['address']['@type']                = 'PostalAddress';
        $json_ld['provider']['address']['streetAddress']         =      $properties['street_address']['value'];
    }
    if(!empty($properties['address_locality']['value'])){
        $json_ld['provider']['address']['addressLocality']         =      $properties['address_locality']['value'];
    }
    if(!empty($properties['postal_code']['value'])){
        $json_ld['provider']['address']['postalCode']         =      $properties['postal_code']['value'];
    }
    if(!empty($properties['address_region']['value'])){
        $json_ld['provider']['address']['addressRegion']         =      $properties['address_region']['value'];
    }
    if(!empty($properties['address_country']['value'])){
        $json_ld['provider']['address']['addressCountry']         =      $properties['address_country']['value'];
    }

    if(!empty($properties['telephone']['value'])){
        $json_ld['provider']['telephone'] =      $properties['telephone']['value'];
    }
    if(!empty($properties['price_range']['value'])){
        $json_ld['provider']['priceRange'] =      $properties['price_range']['value'];
    }

    if(!empty($properties['latitude']['value']) && !empty($properties['longitude']['value']) ){
        $json_ld['provider']['geo']['@type']     = 'GeoCoordinates';
        $json_ld['provider']['geo']['latitude']  = $properties['latitude']['value'];
        $json_ld['provider']['geo']['longitude'] = $properties['longitude']['value'];        
    }
    
    if ( ! empty( $properties['area_served'] ) ) {
        $json_ld['areaServed'] =      smpg_get_commaa_seprated_value( $properties['area_served']['value'], 'City' );
    }
    if( $properties['offer_type']['value'] == 'Offer' ){

        if(isset($properties['offer_price']['value'])){

            $json_ld['offers']['@type']            = 'Offer';
            $json_ld['offers']['url']              = $properties['offer_url']['value'];
            $json_ld['offers']['priceCurrency']    = $properties['offer_currency']['value'];
            $json_ld['offers']['price']            = $properties['offer_price']['value'];
            $json_ld['offers']['priceValidUntil']  = $properties['offer_price_validuntil']['value'];
            $json_ld['offers']['itemCondition']    = $properties['offer_item_condition']['value'];
            $json_ld['offers']['availability']     = $properties['offer_availability']['value'];

            if(!empty($properties['eligible_customer_type']['value'])){
                $json_ld['offers']['eligibleCustomerType']  =      $properties['eligible_customer_type']['value'];
            }
    
         }

     }
	 
	 
	 if( $properties['offer_type']['value'] == 'AggregateOffer' ){

        if(isset($properties['high_price']['value']) && isset($properties['low_price']['value'])){

            $json_ld['offers']['@type']            = 'AggregateOffer';
            $json_ld['offers']['url']              = $properties['offer_url']['value'];
            $json_ld['offers']['priceCurrency']    = $properties['offer_currency']['value'];
            $json_ld['offers']['highPrice']        = $properties['high_price']['value'];
            $json_ld['offers']['lowPrice']         = $properties['low_price']['value'];
            $json_ld['offers']['offerCount']       = $properties['offer_count']['value'];
            $json_ld['offers']['priceValidUntil']  = $properties['offer_price_validuntil']['value'];
            $json_ld['offers']['itemCondition']    = $properties['offer_item_condition']['value'];
            $json_ld['offers']['availability']     = $properties['offer_availability']['value'];

            if(!empty($properties['eligible_customer_type']['value'])){
                $json_ld['offers']['eligibleCustomerType']  =      $properties['eligible_customer_type']['value'];
            }
    
         }

     }
    if(!empty($properties['service_offered']['value'])){

            $service_offer = [];

            $service_explode = explode(',', $properties['service_offered']['value']);
            foreach( $service_explode as $offer){
                $service_offer[] = [
                    '@type' => 'Offer',
                    'name'  => $offer
                ];
            }

        $json_ld['hasOfferCatalog'] = [
                        '@type'            => 'OfferCatalog',
                        'name'             => $properties['service_type_option']['value'],
                        'itemListElement'  => $service_offer,
        ];

    }
    if ( ! empty( $properties['additional_property']['elements'] ) ) {

        $loopdata = [];

        foreach ( $properties['additional_property']['elements'] as  $value ) {
                                    
            if ( $value['name']['value'] && $value['value']['value'] ) {

                $loopdata[] = [
                    '@type'      => 'PropertyValue',
                    'name'       => $value['name']['value'],
                    'value'      => $value['value']['value'],                
                ];

            }            
        }

        $json_ld['additionalProperty'] = $loopdata;
    }
    if ( ! empty( $properties['opening_hours']['elements'] ) ) {

        $loopdata = [];

        foreach ( $properties['opening_hours']['elements'] as  $value ) {
            
            $daysofweek = [];

            if(!empty($value['monday']['value'])){
                $daysofweek[] = 'Monday';
            }
            if(!empty($value['tuesday']['value'])){
                $daysofweek[] = 'Tuesday';
            }
            if(!empty($value['wednesday']['value'])){
                $daysofweek[] = 'Wednesday';
            }
            if(!empty($value['thursday']['value'])){
                $daysofweek[] = 'Thursday';
            }
            if(!empty($value['friday']['value'])){
                $daysofweek[] = 'Friday';
            }
            if(!empty($value['saturday']['value'])){
                $daysofweek[] = 'Saturday';
            }
            if(!empty($value['sunday']['value'])){
                $daysofweek[] = 'Sunday';
            }
            
            $loopdata[] = [
                '@type'      => 'openingHoursSpecification',
                'dayOfWeek'  => $daysofweek,
                'opens'      => $value['opens']['value'],
                'closes'     => $value['closes']['value'],
            ];
        }

        $json_ld['provider']['openingHoursSpecification'] = $loopdata;
    }
    
    return $json_ld;
    
}

function smpg_get_person_individual_json_ld( $json_ld, $properties, $schema_type ) {
    
    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );
    
    if(!empty($properties['name']['value'])){
        $json_ld['name']        =      $properties['name']['value'];
    }
    if(!empty($properties['email']['value'])){
        $json_ld['email']        =      $properties['email']['value'];
    }
    if(!empty($properties['job_title']['value'])){
        $json_ld['jobTitle']        =      $properties['job_title']['value'];
    }    
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }    
    if(!empty($properties['street_address']['value'])){
        $json_ld['address']['@type']                = 'PostalAddress';
        $json_ld['address']['streetAddress']         =      $properties['street_address']['value'];
    }
    if(!empty($properties['address_locality']['value'])){
        $json_ld['address']['addressLocality']         =      $properties['address_locality']['value'];
    }
    if(!empty($properties['postal_code']['value'])){
        $json_ld['address']['postalCode']         =      $properties['postal_code']['value'];
    }
    if(!empty($properties['address_region']['value'])){
        $json_ld['address']['addressRegion']         =      $properties['address_region']['value'];
    }
    if(!empty($properties['address_country']['value'])){
        $json_ld['address']['addressCountry']         =      $properties['address_country']['value'];
    }

    if(!empty($properties['telephone']['value'])){
        $json_ld['telephone'] =      $properties['telephone']['value'];
    }

    $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
         $json_ld['image']              =  $image;   
     }

     return $json_ld;

}

function smpg_get_webpage_individual_json_ld( $json_ld, $properties, $schema_type ) {

        $json_ld['@context']         = smpg_get_context_url();
        $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );
        
        if(!empty($properties['url']['value'])){
            $json_ld['url']                = $properties['url']['value'];
        }
        
        if(!empty($properties['headline']['value'])){
            $json_ld['headline']           = $properties['headline']['value'];
        }
        if(!empty($properties['description']['value'])){
            $json_ld['description']        = $properties['description']['value'];    
        }
        if(!empty($properties['keywords']['value'])){
            $json_ld['keywords']           = $properties['keywords']['value'];   
        }       

        if(!empty($properties['in_language']['value'])){
            $json_ld['inLanguage']         = $properties['in_language']['value'];
        }
        if(!empty($properties['date_published']['value'])){
            $json_ld['datePublished']      = $properties['date_published']['value'];
        }
        if(!empty($properties['date_modified']['value'])){
            $json_ld['dateModified']       = $properties['date_modified']['value'];
        }
        if(!empty($properties['author_type']['value'])){
            $json_ld['author']['@type']    = $properties['author_type']['value']; 
        }
        if(!empty($properties['author_name']['value'])){
            $json_ld['author']['name']     = $properties['author_name']['value']; 
        }
                                        
        if(!empty($properties['publisher_name']['value'])){
            $json_ld['publisher']['@type'] = 'Organization'; 
            $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
        }
        
        $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);
        $image = smpg_make_the_image_json($properties['image']['value'], true);

        if(!empty($logo)){
            $json_ld['publisher']['logo']  = $logo;  
        }
        
        if(!empty($image)){
            $json_ld['image']              =  $image;   
        }

    return $json_ld;

}

function smpg_get_profilepage_individual_json_ld( $json_ld, $properties, $schema_type ) {
    
    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );
    
    if(!empty($properties['date_created']['value'])){
        $json_ld['dateCreated']       = $properties['date_created']['value'];
    }
    if(!empty($properties['date_modified']['value'])){
        $json_ld['dateModified']       = $properties['date_modified']['value'];
    }   
    $json_ld['mainEntity']['@type']        =      'Person'; 
    if(!empty($properties['name']['value'])){
        $json_ld['mainEntity']['name']        =      $properties['name']['value'];
    }
    if(!empty($properties['alternate_name']['value'])){
        $json_ld['mainEntity']['alternateName']  =      $properties['alternate_name']['value'];
    }
    if(!empty($properties['identifier']['value'])){
        $json_ld['mainEntity']['identifier']        =      $properties['identifier']['value'];
    }        
    if(!empty($properties['url']['value'])){
        $json_ld['mainEntity']['url'] =      $properties['url']['value'];
    }    
    if(!empty($properties['street_address']['value'])){
        $json_ld['mainEntity']['address']['@type']                = 'PostalAddress';
        $json_ld['mainEntity']['address']['streetAddress']         =      $properties['street_address']['value'];
    }
    if(!empty($properties['address_locality']['value'])){
        $json_ld['mainEntity']['address']['addressLocality']         =      $properties['address_locality']['value'];
    }
    if(!empty($properties['postal_code']['value'])){
        $json_ld['mainEntity']['address']['postalCode']         =      $properties['postal_code']['value'];
    }
    if(!empty($properties['address_region']['value'])){
        $json_ld['mainEntity']['address']['addressRegion']         =      $properties['address_region']['value'];
    }
    if(!empty($properties['address_country']['value'])){
        $json_ld['mainEntity']['address']['addressCountry']         =      $properties['address_country']['value'];
    }

    if(!empty($properties['telephone']['value'])){
        $json_ld['mainEntity']['telephone'] =      $properties['telephone']['value'];
    }

    if(!empty($properties['social_links']['elements'])){
        $same_as = [];
        foreach ( $properties['social_links']['elements'] as $value ) {            
            $same_as[] = $value['url']['value']; 
        }
        $json_ld['mainEntity']['sameAs'] = $same_as;
    }

    $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
         $json_ld['mainEntity']['image']              =  $image;   
     }

     $statistic = [];

     if ( ! empty( $properties['follow_count']['value'] ) ) {
        $statistic[] =  [
            '@type'                => 'InteractionCounter',
            'interactionType'      => 'https://schema.org/FollowAction',
            'userInteractionCount' => $properties['follow_count']['value'],
        ];
     }
     if ( ! empty( $properties['like_count']['value'] ) ) {
        $statistic[] =  [
            '@type'                => 'InteractionCounter',
            'interactionType'      => 'https://schema.org/LikeAction',
            'userInteractionCount' => $properties['like_count']['value'],
        ];
     }
     if ( ! empty( $properties['comment_count']['value'] ) ) {
        $statistic[] =  [
            '@type'                => 'InteractionCounter',
            'interactionType'      => 'https://schema.org/CommentAction',
            'userInteractionCount' => $properties['comment_count']['value'],
        ];
     }
     if ( ! empty( $properties['share_count']['value'] ) ) {
        $statistic[] =  [
            '@type'                => 'InteractionCounter',
            'interactionType'      => 'https://schema.org/ShareAction',
            'userInteractionCount' => $properties['share_count']['value'],
        ];
     }
     if ( ! empty( $properties['post_count']['value'] ) ) {
        $statistic[] =  [
            '@type'                => 'InteractionCounter',
            'interactionType'      => 'https://schema.org/WriteAction',
            'userInteractionCount' => $properties['post_count']['value'],
        ];
     }

     if ( $statistic ) {
        $json_ld['mainEntity']['interactionStatistic'] = $statistic;
     }

     return $json_ld;

}

function smpg_get_event_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );
    
    if(!empty($properties['name']['value'])){
        $json_ld['name']        =      $properties['name']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['start_date']['value'])){
        $json_ld['startDate'] =      $properties['start_date']['value'];
    }
    if(!empty($properties['end_date']['value'])){
        $json_ld['endDate'] =      $properties['end_date']['value'];
    }
    
        $json_ld['eventAttendanceMode'] =      $properties['attendance_mode']['value'];
    
    if(!empty($properties['status']['value'])){
        $json_ld['eventStatus']         =      $properties['status']['value'];
    }

    $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
         $json_ld['image']              =  $image;   
     }
    
    $offline_loc = []; 
    $online_loc  = []; 

       $offline_loc['@type']         =      'Place';

    if(!empty($properties['place_name']['value'])){
        $offline_loc['name']         =      $properties['place_name']['value'];
    }

        $offline_loc['address']['@type']         =      'PostalAddress';

    if(!empty($properties['street_address']['value'])){
        $offline_loc['address']['streetAddress']         =      $properties['street_address']['value'];
    }
    if(!empty($properties['address_locality']['value'])){
        $offline_loc['address']['addressLocality']         =      $properties['address_locality']['value'];
    }
    if(!empty($properties['postal_code']['value'])){
        $offline_loc['address']['postalCode']         =      $properties['postal_code']['value'];
    }
    if(!empty($properties['address_region']['value'])){
        $offline_loc['address']['addressRegion']         =      $properties['address_region']['value'];
    }
    if(!empty($properties['address_country']['value'])){
        $offline_loc['address']['addressCountry']         =      $properties['address_country']['value'];
    }

    if(!empty($properties['v_location']['value'])){
        $online_loc['@type']   = 'VirtualLocation';
        $online_loc['url']     = $properties['v_location']['value'];
    }

    if($properties['attendance_mode']['value'] == 'https://schema.org/MixedEventAttendanceMode'){
        $json_ld['location'] = [$online_loc, $offline_loc];
    }else if($properties['attendance_mode']['value'] == 'https://schema.org/OfflineEventAttendanceMode'){
        $json_ld['location'] = $offline_loc;
    }else{
        $json_ld['location'] = $online_loc;
    }

    $json_ld['offers']['@type']         = 'Offer';

    if(!empty($properties['offer_price']['value'])){
        $json_ld['offers']['price']         = $properties['offer_price']['value'];
    }
    if(!empty($properties['offer_currency']['value'])){
        $json_ld['offers']['priceCurrency'] = $properties['offer_currency']['value'];
    }
    if(!empty($properties['offer_availability']['value'])){
        $json_ld['offers']['availability']  = $properties['offer_availability']['value'];
    }
    if(!empty($properties['valid_from']['value'])){
        $json_ld['offers']['validFrom']     = $properties['valid_from']['value'];
    }
    if(!empty($properties['offer_url']['value'])){
        $json_ld['offers']['url']     = $properties['offer_url']['value'];
    }
        
    if(!empty($properties['performer']['elements'])){

        $loopdata = [];

        foreach ($properties['performer']['elements'] as  $value) {
            
            $loopdata[] = [
                '@type' => 'PerformingGroup',
                'name'  => $value['name']['value']
            ];
        }

        $json_ld['performer'] = $loopdata;
    }
    
    if(!empty($properties['organizer']['elements'])){

        $loopdata = [];

        foreach ($properties['organizer']['elements'] as  $value) {
            
            $loopdata[] = [
                '@type' => 'Organization',
                'name'  => $value['name']['value'],
                'url'   => $value['url']['value'],
            ];
        }

        $json_ld['organizer'] = $loopdata;
    }

    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );
        
    return $json_ld;
}

function smpg_get_jobposting_individual_json_ld( $json_ld, $properties, $schema_type ) {

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['title']['value'])){
       $json_ld['title'] =      $properties['title']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
    if(!empty($properties['url']['value'])){
       $json_ld['url'] =      $properties['url']['value'];
    }

    if(!empty($properties['date_posted']['value'])){
        $json_ld['datePosted'] =      $properties['date_posted']['value'];
    }
    if(!empty($properties['valid_through']['value'])){
        $json_ld['validThrough'] =      $properties['valid_through']['value'];
    }
    
    if ( ! empty( $properties['employment_type']['elements'] ) ) {

        $emp_type = [];

        foreach ($properties['employment_type']['elements'] as $key => $value) {
            
            if ( ! empty( $value['value'] ) ) {
                $emp_type[] = strtoupper( $key );
            }

        }
        
        if ( $emp_type ) {
            $json_ld['employmentType'] =      $emp_type;
        }
        
    }

    if(!empty($properties['b_salary']['value']) || !empty($properties['b_salary_min']['value']) || !empty($properties['b_salary_max']['value'])){
        $json_ld['baseSalary']['@type']                =   'MonetaryAmount';
        $json_ld['baseSalary']['currency']             =   $properties['b_salary_currency']['value'];
        $json_ld['baseSalary']['value']['@type']       =  'QuantitativeValue';

        if( !empty($properties['b_salary_min']['value']) && !empty($properties['b_salary_max']['value']) ){
            $json_ld['baseSalary']['value']['minValue']    =  $properties['b_salary_min']['value'];
            $json_ld['baseSalary']['value']['maxValue']    =  $properties['b_salary_max']['value'];
        }else{
            if(!empty($properties['b_salary']['value'])){
                $json_ld['baseSalary']['value']['value']       =  $properties['b_salary']['value'];
            }
        }

        $json_ld['baseSalary']['value']['unitText']    =  $properties['b_salary_unit_text']['value'];
    }

    if(!empty($properties['hiring_org_name']['value'])){
       $json_ld['hiringOrganization']['@type'] = 'Organization'; 
       $json_ld['hiringOrganization']['name']  = $properties['hiring_org_name']['value'];    
    }
    if(!empty($properties['social_links']['elements'])){
        $same_as = [];
        foreach ( $properties['social_links']['elements'] as $value ) {            
            $same_as[] = $value['url']['value']; 
        }
        $json_ld['hiringOrganization']['sameAs'] = $same_as;
    }

    if(!empty($properties['job_location']['elements'])){

        $location = [];

        foreach ( $properties['job_location']['elements'] as $value ) { 

                $address['@type'] = 'PostalAddress';
            
            if(!empty($value['street_address']['value'])){
                $address['streetAddress'] = $value['street_address']['value'];
            }
            if(!empty($value['address_locality']['value'])){
                $address['addressLocality'] = $value['address_locality']['value'];
            }
            if(!empty($value['address_region']['value'])){
                $address['addressRegion'] = $value['address_region']['value'];
            }
            if(!empty($value['postal_code']['value'])){
                $address['postalCode'] = $value['postal_code']['value'];
            }
            if(!empty($value['address_country']['value'])){
                $address['addressCountry'] = $value['address_country']['value'];
            }
            
            $location[] = [
                '@type'   => 'Place',
                'address' => $address
            ];
            
        }

        $json_ld['jobLocation'] = $location;
    }

   $logo  = smpg_make_the_logo_json($properties['hiring_org_logo']['value']);

   if(!empty($logo)){
       $json_ld['hiringOrganization']['logo']  = $logo;  
   }
   
   return $json_ld;
}

function smpg_get_course_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

     if(!empty($properties['name']['value'])){
        $json_ld['name'] =      $properties['name']['value'];
     }
     if(!empty($properties['description']['value'])){
         $json_ld['description'] =      $properties['description']['value'];
     }
     if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
     }

     if(!empty($properties['publisher_name']['value'])){
        $json_ld['provider']['@type'] = 'Organization'; 
        $json_ld['provider']['name']  = $properties['publisher_name']['value'];    
     }

     if ( $properties['offer_type']['value'] == 'Offer' ) {

        if ( isset( $properties['offer_price']['value'] ) ) {

            $json_ld['offers']['@type']            = 'Offer';            
            $json_ld['offers']['category']         = $properties['offer_category']['value'];
            $json_ld['offers']['priceCurrency']    = $properties['offer_currency']['value'];
            $json_ld['offers']['price']            = $properties['offer_price']['value'];            
    
         }

     }  

     if ( $properties['offer_type']['value'] == 'AggregateOffer' ) {

        if ( isset( $properties['high_price']['value'] ) && isset( $properties['low_price']['value'] ) ) {

            $json_ld['offers']['@type']            = 'AggregateOffer';            
            $json_ld['offers']['category']         = $properties['offer_category']['value'];
            $json_ld['offers']['priceCurrency']    = $properties['offer_currency']['value'];
            $json_ld['offers']['highPrice']        = $properties['high_price']['value'];
            $json_ld['offers']['lowPrice']         = $properties['low_price']['value'];
            $json_ld['offers']['offerCount']       = $properties['offer_count']['value'];            
    
         }

    }
    
    if ( ! empty( $properties['has_course_instance']['elements'] ) ) {

        $course_instance = [];

        foreach ( $properties['has_course_instance']['elements'] as  $value ) {
                                    
            if ( ! empty( $value['course_mode']['value'] ) || ! empty( $value['course_workload']['value'] ) || ! empty( $value['repeat_count']['value'] ) ) {

                $loopdata = [];

                $loopdata['@type']      = 'CourseInstance';

                if ( ! empty( $value['course_mode']['value'] ) ) {
                    $loopdata['courseMode'] = $value['course_mode']['value'];
                }
                if ( ! empty( $value['location']['value'] ) ) {
                    $loopdata['location'] = $value['location']['value'];
                }
                if ( ! empty( $value['course_workload']['value'] ) ) {
                    $loopdata['courseWorkload'] = $value['course_workload']['value'];
                }

                //Schedule

                if ( ! empty( $value['repeat_count']['value'] ) ) {
                    $loopdata['courseSchedule']['@type'] = 'Schedule';
                    $loopdata['courseSchedule']['repeatCount'] = $value['repeat_count']['value'];
                }
                if ( ! empty( $value['repeat_frequency']['value'] ) ) {
                    $loopdata['courseSchedule']['@type'] = 'Schedule';
                    $loopdata['courseSchedule']['repeatFrequency'] = $value['repeat_frequency']['value'];
                }
                if ( ! empty( $value['duration']['value'] ) ) {
                    $loopdata['courseSchedule']['duration'] = $value['duration']['value'];
                }
                if ( ! empty( $value['start_date']['value'] ) ) {
                    $loopdata['courseSchedule']['startDate'] = $value['start_date']['value'];
                }
                if ( ! empty( $value['end_date']['value'] ) ) {
                    $loopdata['courseSchedule']['endDate'] = $value['end_date']['value'];
                }

                $course_instance[] = $loopdata;

            }            
        }

        $json_ld['hasCourseInstance'] = $course_instance;
    }

    $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);

    if(!empty($logo)){
        $json_ld['provider']['logo']  = $logo;  
    }

    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );
    
    return $json_ld;
}

function smpg_get_videoobject_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

     if(!empty($properties['video_name']['value'])){
        $json_ld['name'] =      $properties['video_name']['value'];
     }
     if(!empty($properties['description']['value'])){
         $json_ld['description'] =      $properties['description']['value'];
     }
     if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
     }
     if(!empty($properties['in_language']['value'])){
        $json_ld['inLanguage'] =      $properties['in_language']['value'];
     }
     if(!empty($properties['content_url']['value'])){
        $json_ld['contentUrl'] =      $properties['content_url']['value'];
     }
     if(!empty($properties['embed_url']['value'])){
        $json_ld['embedUrl '] =      $properties['embed_url']['value'];
     }
     if(!empty($properties['upload_date']['value'])){
        $json_ld['uploadDate'] =      $properties['upload_date']['value'];
     }
     $duration = '';
     if(!empty($properties['hours']['value'])){
        $duration .=      $properties['hours']['value'].'H';
     }
     if(!empty($properties['minutes']['value'])){
        $duration .=      $properties['minutes']['value'].'M';
     }
     if(!empty($properties['seconds']['value'])){
        $duration .=      $properties['seconds']['value'].'S';
     }
     if($duration){
        $json_ld['duration']              =  'PT'.$duration;    
     }
    $image = smpg_make_the_image_json($properties['image']['value'], false);

    if(!empty($image)){
        $json_ld['thumbnailUrl']              =  $image;   
    }
    if(!empty($properties['author_type']['value'])){
        $json_ld['author']['@type']    = $properties['author_type']['value']; 
    }
    if(!empty($properties['author_name']['value'])){
        $json_ld['author']['name']     = $properties['author_name']['value']; 
    }                
    if(!empty($properties['publisher_name']['value'])){
        $json_ld['publisher']['@type'] = 'Organization'; 
        $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
    }

    $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);

    if(!empty($logo)){
        $json_ld['publisher']['logo']  = $logo;  
    }

    return $json_ld;
}

function smpg_get_audioobject_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

     if(!empty($properties['video_name']['value'])){
        $json_ld['name'] =      $properties['video_name']['value'];
     }
     if(!empty($properties['description']['value'])){
         $json_ld['description'] =      $properties['description']['value'];
     }
     if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
     }
     if(!empty($properties['in_language']['value'])){
        $json_ld['inLanguage'] =      $properties['in_language']['value'];
     }
     if(!empty($properties['content_url']['value'])){
        $json_ld['contentUrl'] =      $properties['content_url']['value'];
     }
     if(!empty($properties['embed_url']['value'])){
        $json_ld['embedUrl '] =      $properties['embed_url']['value'];
     }
     if(!empty($properties['upload_date']['value'])){
        $json_ld['uploadDate'] =      $properties['upload_date']['value'];
     }
     $duration = '';
     if(!empty($properties['hours']['value'])){
        $duration .=      $properties['hours']['value'].'H';
     }
     if(!empty($properties['minutes']['value'])){
        $duration .=      $properties['minutes']['value'].'M';
     }
     if(!empty($properties['seconds']['value'])){
        $duration .=      $properties['seconds']['value'].'S';
     }
     if($duration){
        $json_ld['duration']              =  'PT'.$duration;    
     }
    $image = smpg_make_the_image_json($properties['image']['value'], false);

    if(!empty($image)){
        $json_ld['thumbnailUrl']              =  $image;   
    }
    if(!empty($properties['author_type']['value'])){
        $json_ld['author']['@type']    = $properties['author_type']['value']; 
    }
    if(!empty($properties['author_name']['value'])){
        $json_ld['author']['name']     = $properties['author_name']['value']; 
    }                
    if(!empty($properties['publisher_name']['value'])){
        $json_ld['publisher']['@type'] = 'Organization'; 
        $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
    }

    $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);

    if(!empty($logo)){
        $json_ld['publisher']['logo']  = $logo;  
    }

    return $json_ld;
}

function smpg_get_qna_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    $json_ld['mainEntity']['@type'] = 'Question';

     if(!empty($properties['q_title']['value'])){
        $json_ld['mainEntity']['name'] =      $properties['q_title']['value'];
     }
     if(!empty($properties['q_description']['value'])){
        $json_ld['mainEntity']['text'] =      $properties['q_description']['value'];
     }
     if(!empty($properties['q_up_vote_count']['value'])){
        $json_ld['mainEntity']['upvoteCount'] =      $properties['q_up_vote_count']['value'];
     }
     if(!empty($properties['q_date_created']['value'])){
        $json_ld['mainEntity']['dateCreated'] =      $properties['q_date_created']['value'];
     }
     if(!empty($properties['author_name']['value'])){
        $json_ld['mainEntity']['author']['@type']    = 'Person';
        $json_ld['mainEntity']['author']['name']     = $properties['author_name']['value']; 
     }
     if(!empty($properties['a_count']['value'])){
        $json_ld['mainEntity']['answerCount'] =      $properties['a_count']['value'];
     }     
     if(!empty($properties['accepted_answers']['elements'])){        
        $json_ld['mainEntity']['acceptedAnswer'] = smpg_prepare_qna_answers($properties['accepted_answers']['elements']);
     }
     if(!empty($properties['suggested_answers']['elements'])){
        $json_ld['mainEntity']['suggestedAnswer'] = smpg_prepare_qna_answers($properties['suggested_answers']['elements']);
     }          
    return $json_ld;
}

function smpg_get_book_individual_json_ld($json_ld, $properties, $schema_type){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );
        
     if(!empty($properties['name']['value'])){
        $json_ld['name'] =      $properties['name']['value'];
     }
     if(!empty($properties['description']['value'])){
         $json_ld['description'] =      $properties['description']['value'];
     }
     if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
     }
     if(!empty($properties['in_language']['value'])){
        $json_ld['inLanguage'] =      $properties['in_language']['value'];
     }     

    if(!empty($properties['author_type']['value'])){
        $json_ld['author']['@type']    = $properties['author_type']['value']; 
    }
    if(!empty($properties['author_name']['value'])){
        $json_ld['author']['name']     = $properties['author_name']['value']; 
    }
                
    if(!empty($properties['publisher_name']['value'])){
        $json_ld['publisher']['@type'] = 'Organization'; 
        $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
    }

    $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);

    if(!empty($logo)){
        $json_ld['publisher']['logo']  = $logo;  
    }

    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );

    return $json_ld;
}
function smpg_get_custom_schema_individual_json_ld( $json_ld, $properties, $schema_type ) {

    if ( ! empty ( $properties['editor']['value'] ) ) {

        $js_decoded = json_decode( $properties['editor']['value'], true );
        
        if ( json_last_error() === JSON_ERROR_NONE ) {

            $json_ld = $js_decoded;

        }

    }

    return $json_ld;

}
function smpg_get_recipe_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

     if(!empty($properties['name']['value'])){
        $json_ld['name'] =      $properties['name']['value'];
     }
     if(!empty($properties['description']['value'])){
         $json_ld['description'] =      $properties['description']['value'];
     }
     
     if(!empty($properties['date_published']['value'])){
        $json_ld['datePublished'] =      $properties['date_published']['value'];
    }
    if(!empty($properties['prep_time']['value'])){
        $json_ld['prepTime'] =      'PT'.$properties['prep_time']['value'].'M';
    }
    if(!empty($properties['cook_time']['value'])){
        $json_ld['cookTime'] =      'PT'.$properties['cook_time']['value'].'M';
    }
    if(!empty($properties['total_time']['value'])){
        $json_ld['totalTime'] =      'PT'.$properties['total_time']['value'].'M';
    }
    if(!empty($properties['keywords']['value'])){
        $json_ld['keywords'] =      $properties['keywords']['value'];
    }
    if(!empty($properties['recipe_yield']['value'])){
        $json_ld['recipeYield'] =      $properties['recipe_yield']['value'];
    }
    if(!empty($properties['recipe_category']['value'])){
        $json_ld['recipeCategory'] =      $properties['recipe_category']['value'];
    }
    if(!empty($properties['recipe_cuisine']['value'])){
        $json_ld['recipeCuisine'] =      $properties['recipe_cuisine']['value'];
    }

    $json_ld['nutrition']['@type'] = 'NutritionInformation';

    if(!empty($properties['calories']['value'])){
        $json_ld['nutrition']['calories'] =      $properties['calories']['value'];
    }
    if(!empty($properties['carbohydrate']['value'])){
        $json_ld['nutrition']['carbohydrateContent'] =      $properties['carbohydrate']['value'];
    }
    if(!empty($properties['cholesterol']['value'])){
        $json_ld['nutrition']['cholesterolContent'] =      $properties['cholesterol']['value'];
    }
    if(!empty($properties['fat']['value'])){
        $json_ld['nutrition']['fatContent'] =      $properties['fat']['value'];
    }
    if(!empty($properties['fiber']['value'])){
        $json_ld['nutrition']['fiberContent'] =      $properties['fiber']['value'];
    }
    if(!empty($properties['protein']['value'])){
        $json_ld['nutrition']['proteinContent'] =      $properties['protein']['value'];
    }
    if(!empty($properties['saturated_fat']['value'])){
        $json_ld['nutrition']['saturatedFatContent'] =      $properties['saturated_fat']['value'];
    }
    if(!empty($properties['sodium']['value'])){
        $json_ld['nutrition']['sodiumContent'] =      $properties['sodium']['value'];
    }
    if(!empty($properties['sugar']['value'])){
        $json_ld['nutrition']['sugarContent'] =      $properties['sugar']['value'];
    }
    if(!empty($properties['trans_fat']['value'])){
        $json_ld['nutrition']['transFatContent'] =      $properties['trans_fat']['value'];
    }
    if(!empty($properties['unsaturated_fat']['value'])){
        $json_ld['nutrition']['unsaturatedFatContent'] =      $properties['unsaturated_fat']['value'];
    }

    $json_ld = smpg_get_video_json_ld( $json_ld, $properties );
    
    if(!empty($properties['recipe_ingredient']['elements'])){

        $ing_data = [];    
        $ing      = $properties['recipe_ingredient']['elements'];

        foreach ($ing as $value) {
            $ing_data[] = $value['name']['value'];    
        }

       $json_ld['recipeIngredient'] = $ing_data;     
    }

    $json_ld = smpg_get_steps_json_ld( $json_ld, $properties, 'recipe' );

     $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
         $json_ld['image']              =  $image;   
     }

     if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
     }
     if(!empty($properties['in_language']['value'])){
        $json_ld['inLanguage'] =      $properties['in_language']['value'];
     }     

    if(!empty($properties['author_type']['value'])){
        $json_ld['author']['@type']    = $properties['author_type']['value']; 
    }
    if(!empty($properties['author_name']['value'])){
        $json_ld['author']['name']     = $properties['author_name']['value']; 
    }
                
    if(!empty($properties['publisher_name']['value'])){
        $json_ld['publisher']['@type'] = 'Organization'; 
        $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
    }

    $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);

    if(!empty($logo)){
        $json_ld['publisher']['logo']  = $logo;  
    }

    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );
        
    return $json_ld;
}

function smpg_get_howto_individual_json_ld( $json_ld, $properties, $schema_type){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }

    $json_ld = smpg_get_video_json_ld( $json_ld, $properties );

    $image = smpg_make_the_image_json($properties['image']['value'], true);

    if(!empty($image)){
        $json_ld['image']              =  $image;   
    }


    if(!empty($properties['supplies']['elements'])){

        $supplies      = $properties['supplies']['elements'];
        $supplies_data = [];

        foreach ($supplies as $key => $value) {

            $supply = [];

            if(!empty($value['name']['value'])){

                $supply['@type'] = 'HowToSupply';
                $supply['name']  = $value['name']['value'];
                $supply['url']   = $value['url']['value'];                                 
                $supply['image'] = smpg_make_the_image_json($value['image']['value'], true);
            }   
            
            $supplies_data[] = $supply;
        }

        $json_ld['supply'] = $supplies_data;
    }

    if(!empty($properties['tools']['elements'])){

        $tools      = $properties['tools']['elements'];
        $tools_data = [];

        foreach ($tools as $key => $value) {

            $tool = [];

            if(!empty($value['name']['value'])){

                $tool['@type'] = 'HowToTool';
                $tool['name']  = $value['name']['value'];
                $tool['url']   = $value['url']['value'];                                 
                $tool['image'] = smpg_make_the_image_json($value['image']['value'], true);
            }   
            
            $tools_data[] = $tool;
        }

        $json_ld['tool'] = $tools_data;
    }
    
    $json_ld = smpg_get_steps_json_ld( $json_ld, $properties, 'howto' );
    
    
    if( !empty($properties['days_needed']['value']) || !empty($properties['hours_needed']['value']) || !empty($properties['minutes_needed']['value']) ) {
                     
        $json_ld['totalTime'] = 'P'. 
        
        ((!empty($properties['days_needed']['value']))    ? $properties['days_needed']['value'].'D':''). 'T'. 
        ((!empty($properties['hours_needed']['value']))   ? $properties['hours_needed']['value'].'H':''). 
        ((!empty($properties['minutes_needed']['value'])) ? $properties['minutes_needed']['value'].'M':''); 
        
    } 

    if(!empty($properties['e_cost_currency']['value']) && !empty($properties['e_cost_value']['value'])){
                
        $json_ld['estimatedCost']['@type']   = 'MonetaryAmount';
        $json_ld['estimatedCost']['currency']= $properties['e_cost_currency']['value'];
        $json_ld['estimatedCost']['value']   = $properties['e_cost_value']['value'];
        
     }

     $json_ld = smpg_get_paywalled_json_ld( $json_ld, $properties );  
    
    return $json_ld;
    
}

function smpg_get_softwareapplication_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }

    $image = smpg_make_the_image_json($properties['image']['value'], true);

    if(!empty($image)){
       $json_ld['image']              =  $image;   
    }

    if(!empty($properties['operating_system']['value'])){
       $json_ld['operatingSystem'] =      $properties['operating_system']['value'];
    }
    if(!empty($properties['application_category']['value'])){
       $json_ld['applicationCategory'] =      $properties['application_category']['value'];
    }
        
    $json_ld['offers']['@type']            = 'Offer';       
    $json_ld['offers']['priceCurrency']    = !empty($properties['offer_currency']['value']) ? $properties['offer_currency']['value'] : 'USD';
    $json_ld['offers']['price']            = isset($properties['offer_price']['value']) ? $properties['offer_price']['value'] : 0;       

    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );
                       
   return $json_ld;
}

function smpg_get_imagegallery_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_mediagallery_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_imageobject_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_photograph_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }

    $image = smpg_make_the_image_json($properties['image']['value'], true);

    if(!empty($image)){
        $json_ld['image']              =  $image;   
    }
                           
   return $json_ld;
}

function smpg_get_apartment_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_house_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_review_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['review_body']['value'])){
        $json_ld['reviewBody'] =      $properties['review_body']['value'];
    }
    if(!empty($properties['date_published']['value'])){
        $json_ld['datePublished']      = $properties['date_published']['value'];
    }
    if(!empty($properties['item_reviewed']['value'])){
        $json_ld['itemReviewed']['@type'] =      $properties['item_reviewed']['value'];
    }
    if(!empty($properties['name']['value'])){
       $json_ld['itemReviewed']['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['itemReviewed']['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['itemReviewed']['description'] =      $properties['description']['value'];
    }
    $image = smpg_make_the_image_json($properties['image']['value'], true);

    if(!empty($image)){
        $json_ld['itemReviewed']['image']              =  $image;   
    }
    if(!empty($properties['street_address']['value'])){
        $json_ld['itemReviewed']['address']['@type']                = 'PostalAddress';
        $json_ld['itemReviewed']['address']['streetAddress']         =      $properties['street_address']['value'];
    }
    if(!empty($properties['address_locality']['value'])){
        $json_ld['itemReviewed']['address']['addressLocality']         =      $properties['address_locality']['value'];
    }
    if(!empty($properties['postal_code']['value'])){
        $json_ld['itemReviewed']['address']['postalCode']         =      $properties['postal_code']['value'];
    }
    if(!empty($properties['address_region']['value'])){
        $json_ld['itemReviewed']['address']['addressRegion']         =      $properties['address_region']['value'];
    }
    if(!empty($properties['address_country']['value'])){
        $json_ld['itemReviewed']['address']['addressCountry']         =      $properties['address_country']['value'];
    }

    if(!empty($properties['telephone']['value'])){
        $json_ld['itemReviewed']['telephone'] =      $properties['telephone']['value'];
    }
    if(!empty($properties['price_range']['value'])){
        $json_ld['itemReviewed']['priceRange'] =      $properties['price_range']['value'];
    }    
    if(!empty($properties['offer_price']['value'])){
        $json_ld['itemReviewed']['offers']['@type']         = 'Offer';
        $json_ld['itemReviewed']['offers']['price']         = $properties['offer_price']['value'];
    }    
    if(!empty($properties['offer_currency']['value'])){
        $json_ld['itemReviewed']['offers']['priceCurrency'] = $properties['offer_currency']['value'];
    }

    if(!empty($properties['seller_type']['value'])){
        $json_ld['itemReviewed']['offers']['seller']['@type']    = $properties['seller_type']['value']; 
    }
    if(!empty($properties['seller_name']['value'])){
        $json_ld['itemReviewed']['offers']['seller']['name']    = $properties['seller_name']['value']; 
    }    
    if(!empty($properties['author_type']['value'])){
        $json_ld['author']['@type']    = $properties['author_type']['value']; 
    }
    if(!empty($properties['author_name']['value'])){
        $json_ld['author']['name']     = $properties['author_name']['value']; 
    }                
    if(!empty($properties['publisher_name']['value'])){
        $json_ld['publisher']['@type'] = 'Organization'; 
        $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
    }

    $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);

    if(!empty($logo)){
        $json_ld['publisher']['logo']  = $logo;  
    }
     
    if(!empty($properties['rating_value']['value'])){
        $json_ld['reviewRating']['@type']       =      'Rating';
        $json_ld['reviewRating']['ratingValue'] =      $properties['rating_value']['value'];
    }

    if(isset($properties['worst_rating']['value'])){        
        $json_ld['reviewRating']['worstRating'] =      $properties['worst_rating']['value'];
    }
    if(isset($properties['best_rating']['value'])){
        $json_ld['reviewRating']['bestRating'] =      $properties['best_rating']['value'];
    }
    if(!empty($properties['review_aspect']['value'])){
        $json_ld['reviewRating']['reviewAspect'] =      $properties['review_aspect']['value'];
    }

   return $json_ld;
   
}

function smpg_get_singlefamilyresidence_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_mobileapplication_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_trip_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_musicplaylist_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_musicalbum_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_liveblogposting_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
       $json_ld['name'] =      $properties['name']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
                           
   return $json_ld;
}

function smpg_get_product_individual_json_ld( $json_ld, $properties, $schema_type ){

    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

     if(!empty($properties['name']['value'])){
        $json_ld['name'] =      $properties['name']['value'];
     }
     if(!empty($properties['description']['value'])){
         $json_ld['description'] =      $properties['description']['value'];
     }

     $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
        $json_ld['image']              =  $image;   
     }

     if(!empty($properties['sku']['value'])){
        $json_ld['sku'] =      $properties['sku']['value'];
     }
     if(!empty($properties['mpn']['value'])){
        $json_ld['mpn'] =      $properties['mpn']['value'];
     }
     if(!empty($properties['brand']['value'])){
        $json_ld['brand']['@type'] = 'Brand';
        $json_ld['brand']['name']  = $properties['brand']['value'];
     }

     if( $properties['offer_type']['value'] == 'Offer' ){

        if(isset($properties['offer_price']['value'])){

            $json_ld['offers']['@type']            = 'Offer';
            $json_ld['offers']['url']              = $properties['offer_url']['value'];
            $json_ld['offers']['priceCurrency']    = $properties['offer_currency']['value'];
            $json_ld['offers']['price']            = $properties['offer_price']['value'];
            $json_ld['offers']['priceValidUntil']  = $properties['offer_price_validuntil']['value'];
            $json_ld['offers']['itemCondition']    = $properties['offer_item_condition']['value'];
            $json_ld['offers']['availability']     = $properties['offer_availability']['value'];
    
         }

     }  

     if( $properties['offer_type']['value'] == 'AggregateOffer' ){

        if(isset($properties['high_price']['value']) && isset($properties['low_price']['value'])){

            $json_ld['offers']['@type']            = 'AggregateOffer';
            $json_ld['offers']['url']              = $properties['offer_url']['value'];
            $json_ld['offers']['priceCurrency']    = $properties['offer_currency']['value'];
            $json_ld['offers']['highPrice']        = $properties['high_price']['value'];
            $json_ld['offers']['lowPrice']         = $properties['low_price']['value'];
            $json_ld['offers']['offerCount']       = $properties['offer_count']['value'];
            $json_ld['offers']['priceValidUntil']  = $properties['offer_price_validuntil']['value'];
            $json_ld['offers']['itemCondition']    = $properties['offer_item_condition']['value'];
            $json_ld['offers']['availability']     = $properties['offer_availability']['value'];
    
         }

    }     

    if ( ! empty( $properties['reviews']['elements'] ) ) {
        $json_ld = smpg_prepare_reviews( $json_ld, $properties['reviews']['elements'] );
    }
                    
    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );

    return $json_ld;
}


function smpg_get_different_localbusiness_individual_json_ld( $json_ld, $properties, $schema_type ){
    
    $json_ld['@context']         = smpg_get_context_url();
    $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

    if(!empty($properties['name']['value'])){
        $json_ld['name']        =      $properties['name']['value'];
    }
    if(!empty($properties['description']['value'])){
        $json_ld['description'] =      $properties['description']['value'];
    }
    if(!empty($properties['url']['value'])){
        $json_ld['url'] =      $properties['url']['value'];
    }    

    $image = smpg_make_the_image_json($properties['image']['value'], true);

     if(!empty($image)){
         $json_ld['image']              =  $image;   
     }     

    if(!empty($properties['street_address']['value'])){
        $json_ld['address']['@type']                = 'PostalAddress';
        $json_ld['address']['streetAddress']         =      $properties['street_address']['value'];
    }
    if(!empty($properties['address_locality']['value'])){
        $json_ld['address']['addressLocality']         =      $properties['address_locality']['value'];
    }
    if(!empty($properties['postal_code']['value'])){
        $json_ld['address']['postalCode']         =      $properties['postal_code']['value'];
    }
    if(!empty($properties['address_region']['value'])){
        $json_ld['address']['addressRegion']         =      $properties['address_region']['value'];
    }
    if(!empty($properties['address_country']['value'])){
        $json_ld['address']['addressCountry']         =      $properties['address_country']['value'];
    }

    if(!empty($properties['telephone']['value'])){
        $json_ld['telephone'] =      $properties['telephone']['value'];
    }
    if(!empty($properties['price_range']['value'])){
        $json_ld['priceRange'] =      $properties['price_range']['value'];
    }

    if(!empty($properties['latitude']['value']) && !empty($properties['longitude']['value']) ){
        $json_ld['geo']['@type']     = 'GeoCoordinates';
        $json_ld['geo']['latitude']  = $properties['latitude']['value'];
        $json_ld['geo']['longitude'] = $properties['longitude']['value'];        
    }

    if(!empty($properties['opening_hours']['elements'])){

        $loopdata = [];

        foreach ($properties['opening_hours']['elements'] as  $value) {
            
            $daysofweek = [];

            if(!empty($value['monday']['value'])){
                $daysofweek[] = 'Monday';
            }
            if(!empty($value['tuesday']['value'])){
                $daysofweek[] = 'Tuesday';
            }
            if(!empty($value['wednesday']['value'])){
                $daysofweek[] = 'Wednesday';
            }
            if(!empty($value['thursday']['value'])){
                $daysofweek[] = 'Thursday';
            }
            if(!empty($value['friday']['value'])){
                $daysofweek[] = 'Friday';
            }
            if(!empty($value['saturday']['value'])){
                $daysofweek[] = 'Saturday';
            }
            if(!empty($value['sunday']['value'])){
                $daysofweek[] = 'Sunday';
            }
            
            $loopdata[] = [
                '@type'      => 'openingHoursSpecification',
                'dayOfWeek'  => $daysofweek,
                'opens'      => $value['opens']['value'],
                'closes'     => $value['closes']['value'],
            ];
        }

        $json_ld['openingHoursSpecification'] = $loopdata;
    }

    $json_ld = smpg_prepare_aggregate_rating( $json_ld, $properties );
    
    return $json_ld;
}

function smpg_get_different_article_individual_json_ld( $json_ld, $properties, $schema_type ){

        $json_ld['@context']         = smpg_get_context_url();
        $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );
        
        if(!empty($properties['url']['value'])){
            $json_ld['url']                = $properties['url']['value'];
        }
        
        if(!empty($properties['headline']['value'])){
            $json_ld['headline']           = $properties['headline']['value'];
        }
        if(!empty($properties['description']['value'])){
            $json_ld['description']        = $properties['description']['value'];    
        }
        if(!empty($properties['keywords']['value'])){
            $json_ld['keywords']           = $properties['keywords']['value'];   
        }

        if ( $schema_type != 'creativework' ) {

            if(!empty($properties['word_count']['value'])){
                $json_ld['wordCount']          = $properties['word_count']['value'];   
            }
            if(!empty($properties['article_section']['value'])){
                $json_ld['articleSection']     = $properties['article_section']['value'];   
            }
        }        

        if(!empty($properties['in_language']['value'])){
            $json_ld['inLanguage']         = $properties['in_language']['value'];
        }
        if(!empty($properties['date_published']['value'])){
            $json_ld['datePublished']      = $properties['date_published']['value'];
        }
        if(!empty($properties['date_modified']['value'])){
            $json_ld['dateModified']       = $properties['date_modified']['value'];
        }
        if(!empty($properties['author_type']['value'])){
            $json_ld['author']['@type']    = $properties['author_type']['value']; 
        }
        if(!empty($properties['author_name']['value'])){
            $json_ld['author']['name']     = $properties['author_name']['value']; 
        }
    
        $json_ld = smpg_get_speakable_xpath( $json_ld, $properties ); 
        $json_ld = smpg_get_paywalled_json_ld( $json_ld, $properties );    
                    
        if(!empty($properties['publisher_name']['value'])){
            $json_ld['publisher']['@type'] = 'Organization'; 
            $json_ld['publisher']['name']  = $properties['publisher_name']['value'];    
        }
        
        $logo  = smpg_make_the_logo_json($properties['publisher_logo']['value']);
        $image = smpg_make_the_image_json($properties['image']['value'], true);

        if(!empty($logo)){
            $json_ld['publisher']['logo']  = $logo;  
        }
        
        if(!empty($image)){
            $json_ld['image']              =  $image;   
        }


    return $json_ld;

}

function smpg_get_faq_individual_json_ld( $json_ld, $properties, $schema_type ) {

        $json_ld['@context']         = smpg_get_context_url();
        $json_ld['@type']            = smpg_get_schema_type_text( $schema_type );

        $main_entity = [];
        $data        = [];
        
        if ( ! empty( $properties['main_entity']['elements'] ) ) {

            $data = $properties['main_entity']['elements'];

            foreach ( $data as $value ) {
                
                if ( ! empty( $value['question']['value'] ) && ! empty( $value['answer']['value'] ) ) {

                    $entity = [];

                    $entity['@type']                   = 'Question';
                    $entity['name']                    = $value['question']['value'];

                    if ( ! empty( $value['image']['value'] ) ) {
                        $entity['image'] = smpg_make_the_image_json( $value['image']['value'], true );
                    }

                    $entity['acceptedAnswer']['@type'] = 'Answer';
                    $entity['acceptedAnswer']['text']  = $value['answer']['value'];                    

                    $main_entity[] = $entity;

                }
                
            }

            if ( $main_entity ) {
                $json_ld['mainEntity'] = $main_entity;
            }
            
        }

        return $json_ld;
}