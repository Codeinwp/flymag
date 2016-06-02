/*
Upsells
*/

jQuery(document).ready(function() {

	/* Upsells in customizer (Documentation link and Upgrade to PRO link */


	if( !jQuery( ".flymag-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section flymag-upsells" style="padding-bottom: 15px">');
		}

    if( jQuery( ".flymag-upsells" ).length ) {

  		jQuery('.flymag-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://docs.themeisle.com/article/310-flymag-documentation" class="button" target="_blank">{documentation}</a>'.replace('{documentation}', flymagCustomizerObject.documentation));
  		jQuery('.flymag-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://github.com/Codeinwp/flymag" class="button" target="_blank">{github}</a>'.replace('{github}', flymagCustomizerObject.github));
  		jQuery('.flymag-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/view/theme-reviews/flymag#postform" class="button" target="_blank">{review}</a>'.replace('{review}', flymagCustomizerObject.review));

  	}

	jQuery('.preview-notice').append('<a class="flymag-upgrade-to-pro-button" href="http://themeisle.com/themes/flymag-pro/" class="button" target="_blank">{pro}</a>'.replace('{pro}',flymagCustomizerObject.pro));

	if ( !jQuery( ".flymag-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('</li>');
	}
});
