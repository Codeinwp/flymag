/* global tiAboutPageCustomizerObject */
jQuery(document).ready(function() {
    'use strict';
    var ti_aboutpage = tiAboutPageCustomizerObject.aboutpage;
    var ti_about_page_nr_actions_required = tiAboutPageCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof ti_aboutpage !== 'undefined') && (typeof ti_about_page_nr_actions_required !== 'undefined') && (ti_about_page_nr_actions_required !== 0)) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + ti_aboutpage + '"><span class="ti-about-page-actions-count">' + ti_about_page_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( '.zerif-upsells' ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section zerif-upsells">');
    }
    if (typeof ti_aboutpage !== 'undefined') {
        jQuery('.zerif-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + ti_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', tiAboutPageCustomizerObject.themeinfo));
    }
    if ( !jQuery( '.zerif-upsells' ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});