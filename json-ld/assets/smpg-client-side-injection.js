jQuery(document).ready(function($) {

    var post_id       = smpg_client_local.post_id;    
    var spg_id        = smpg_client_local.spg_id;
    var page_type     = smpg_client_local.page_type;
    var is_home       = smpg_client_local.is_home;
    var is_front_page = smpg_client_local.is_front_page;

    $.post(
        smpg_client_local.ajax_url,
        {
            action: 'smpg_json_ld_client_side_output',
            post_id: post_id,
            spg_id: spg_id,
            page_type: page_type,
            is_home: is_home,
            is_front_page: is_front_page,
            security: smpg_client_local.smpg_security_nonce
        },
        function(response) {
            if (response && response.success && response.data) {

                var script = document.createElement('script');
                    script.type = 'application/ld+json';
                    script.className = 'smpg-json-ld';
                    script.textContent = JSON.stringify(response.data, null, 2);
                    document.head.appendChild(script);                                                
            } else {
                console.warn('SMPG: schema injection failed.', response);
            }
        },
        'json'
    ).fail(function(jqXHR, textStatus, errorThrown) {
        console.warn('SMPG AJAX error:', textStatus, errorThrown);
    });
});