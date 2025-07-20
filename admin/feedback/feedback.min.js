var strict;

jQuery(document).ready(function ($) {
    /**
     * DEACTIVATION FEEDBACK FORM
     */
    // show overlay when clicked on "deactivate"
    smpg_deactivate_link = $('.wp-admin.plugins-php tr[data-slug="schema-package"] .row-actions .deactivate a');
    smpg_deactivate_link_url = smpg_deactivate_link.attr('href');

    smpg_deactivate_link.click(function (e) {
        e.preventDefault();

        // only show feedback form once per 30 days
        var c_value = smpg_admin_get_cookie("smpg_keep_hidden_feedback_popup");

        if (c_value === undefined) {
            $('#smpg-feedback-overlay').show();
        } else {
            // click on the link
            window.location.href = smpg_deactivate_link_url;
        }
    });
    // show text fields
    
    $('input[name="smpg_disable_reason"]').on('change', function() {
        const selectedId = $(this).attr('id');

        // Hide all textareas first
        $('.smpg-reason-details textarea').addClass('smpg-d-none');

        // Show the matching textarea if it exists
        $('.smpg-reason-details textarea[data-id="' + selectedId + '"]').removeClass('smpg-d-none');
    });


    // send form or close it
    $('#smpg-feedback-content form').submit(function (e) {
        e.preventDefault();

        smpg_set_feedback_cookie();

        // Send form data
        $.post(smpg_feedback_local.ajax_url, {
            action: 'smpg_send_feedback',
            data: $('#smpg-feedback-content form').serialize() + "&smpg_security_nonce=" + smpg_feedback_local.smpg_security_nonce
        },
                function (data) {

                    if (data == 'sent') {
                        // deactivate the plugin and close the popup
                        $('#smpg-feedback-overlay').remove();
                        window.location.href = smpg_deactivate_link_url;
                    } else {
                        console.log('Error: ' + data);
                        alert(data);
                    }
                }
        );
    });

    $("#smpg-feedback-content .smpg-only-deactivate").click(function (e) {
        e.preventDefault();

        smpg_set_feedback_cookie();        
        $('#smpg-feedback-overlay').remove();
        window.location.href = smpg_deactivate_link_url;
    });

    // close form without doing anything
    $('.smpg-fd-stop-deactivation').click(function (e) {
        $('#smpg-feedback-content form')[0].reset();                
        $('.smpg-reason-details textarea').addClass('smpg-d-none');
        $('#smpg-feedback-overlay').hide();
        $(".smpg-reason-details").addClass('smpg-display-none')        
    });

    function smpg_admin_get_cookie(name) {
        var i, x, y, smpg_cookies = document.cookie.split(";");
        for (i = 0; i < smpg_cookies.length; i++)
        {
            x = smpg_cookies[i].substr(0, smpg_cookies[i].indexOf("="));
            y = smpg_cookies[i].substr(smpg_cookies[i].indexOf("=") + 1);
            x = x.replace(/^\s+|\s+$/g, "");
            if (x === name)
            {
                return unescape(y);
            }
        }
    }

    function smpg_set_feedback_cookie() {
        // set cookie for 30 days
        var exdate = new Date();
        exdate.setSeconds(exdate.getSeconds() + 2592000);
        document.cookie = "smpg_keep_hidden_feedback_popup=1; expires=" + exdate.toUTCString() + "; path=/";
    }
});