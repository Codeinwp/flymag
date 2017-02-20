/* global tiAboutPageObject */
jQuery(document).ready(function () {
    'use strict';
    /* If there are required actions, add an icon with the number of required actions in the About page -> Actions required tab */
    var required_actions = parseInt(tiAboutPageObject.nr_actions_required);

    if (required_actions !== 0) {
        jQuery('#actions_required_handle a').append('<span class="ti-about-page-actions-count">' + required_actions + '</span>');
    }

    /* Dismiss required actions */
    jQuery('.ti-about-page-dismiss-required-action').click(function () {

        var id = jQuery(this).attr('id');
        jQuery.ajax({
            type: 'POST',
            data: {action: 'ti_about_page_dismiss_required_action', dismiss_id: id, nonce: tiAboutPageObject.nonce},
            dataType: 'json',
            url: tiAboutPageObject.ajaxurl,
            beforeSend: function () {
                jQuery('.ti-about-page-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + tiAboutPageObject.template_directory + '/ti-about-page/images/ajax-loader.gif" /></div>');
            },
            success: function (data) {
                jQuery('#temp_load').remove();
                if (data.success) {
                    console.log(data.data.id);
                    /* Remove loading gif */
                    jQuery('#' + data.data.id).parent().remove();
                    /* Remove required action box */

                    var ti_about_page_actions_count = parseInt(jQuery('.ti-about-page-actions-count').text());

                    /* Decrease or remove the counter for required actions */
                    if (ti_about_page_actions_count === 1) {
                        jQuery('.ti-about-page-actions-count').remove();
                        jQuery('.ti-about-page-tab-pane#actions_required').append('<p>' + tiAboutPageObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.ti-about-page-actions-count').text(parseInt(ti_about_page_actions_count) - 1);
                    }
                }
            },
            error: function () {
            }
        });
    });

});