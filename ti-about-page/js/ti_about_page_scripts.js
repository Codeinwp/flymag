jQuery(document).ready(function() {

    /* If there are required actions, add an icon with the number of required actions in the About page -> Actions required tab */
    var ti_about_page_nr_actions_required = tiAboutPageObject.nr_actions_required;

    if ( (typeof ti_about_page_nr_actions_required !== 'undefined') && (ti_about_page_nr_actions_required != '0') ) {
        jQuery('li.ti-about-page-lite-w-red-tab a').append('<span class="ti-about-page-lite-actions-count">' + ti_about_page_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".ti-about-page-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'ti_about_page_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : tiAboutPageObject.ajaxurl,
            beforeSend : function(data,settings){
                jQuery('.ti-about-page-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + tiAboutPageObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
                jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var ti_about_page_actions_count = jQuery('.ti-about-page-lite-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof ti_about_page_actions_count !== 'undefined' ) {
                    if( ti_about_page_actions_count == '1' ) {
                        jQuery('.ti-about-page-actions-count').remove();
                        jQuery('.ti-about-page-tab-pane#actions_required').append('<p>' + tiAboutPageObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.ti-about-page-actions-count').text(parseInt(ti_about_page_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

    /* Tabs in welcome page */
    function ti_about_page_welcome_page_tabs(event) {
        jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".ti-about-page-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
    }

    var ti_about_page_actions_anchor = location.hash;

    if( (typeof ti_about_page_actions_anchor !== 'undefined') && (ti_about_page_actions_anchor != '') ) {
        ti_about_page_welcome_page_tabs('a[href="'+ ti_about_page_actions_anchor +'"]');
    }

    jQuery(".ti-about-page-nav-tabs a").click(function(event) {
        event.preventDefault();
        ti_about_page_welcome_page_tabs(this);
    });

    /* Tab Content height matches admin menu height for scrolling purpouses */
    $tab = jQuery('.ti-about-page-tab-content > div');
    $admin_menu_height = jQuery('#adminmenu').height();
    if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
    {
        $newheight = $admin_menu_height - 180;
        $tab.css('min-height',$newheight);
    }

});