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
        var c_value = smpg_admin_get_cookie("smpg_hide_deactivate_feedback");

        if (c_value === undefined) {
            $('#smpg-reloaded-feedback-overlay').show();
        } else {
            // click on the link
            window.location.href = smpg_deactivate_link_url;
        }
    });
    // show text fields
    $('#smpg-reloaded-feedback-content input[type="radio"]').click(function () {
        // show text field if there is one
        $(".smpg-reason-details").removeClass('smpg-display-none')        
    });
    // send form or close it
    $('#smpg-reloaded-feedback-content form').submit(function (e) {
        e.preventDefault();

        smpg_set_feedback_cookie();

        // Send form data
        $.post(ajaxurl, {
            action: 'smpg_send_feedback',
            data: $('#smpg-reloaded-feedback-content form').serialize() + "&smpg_security_nonce=" + cn_toc_admin_data.smpg_security_nonce
        },
                function (data) {

                    if (data == 'sent') {
                        // deactivate the plugin and close the popup
                        $('#smpg-reloaded-feedback-overlay').remove();
                        window.location.href = smpg_deactivate_link_url;
                    } else {
                        console.log('Error: ' + data);
                        alert(data);
                    }
                }
        );
    });

    $("#smpg-reloaded-feedback-content .smpg-only-deactivate").click(function (e) {
        e.preventDefault();

        smpg_set_feedback_cookie();

        $('#smpg-reloaded-feedback-overlay').remove();
        window.location.href = smpg_deactivate_link_url;
    });

    // close form without doing anything
    $('.smpg-feedback-not-deactivate').click(function (e) {
        $('#smpg-reloaded-feedback-content form')[0].reset();        
        $('#smpg-reloaded-feedback-overlay').hide();
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
        document.cookie = "smpg_hide_deactivate_feedback=1; expires=" + exdate.toUTCString() + "; path=/";
    }
});