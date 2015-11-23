/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	//Latest news
	wp.customize('latest_news_color',function( value ) {
		value.bind( function( newval ) {
			$('.news-ticker').css('background-color', newval );
		} );
	});
	//Header
	wp.customize('header_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-branding').css('background-color', newval );
		} );
	});
	//Site title
	wp.customize('site_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-title a').css('color', newval );
		} );
	});
	//Site desc
	wp.customize('site_desc_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('color', newval );
		} );
	});
	// Menu bg
	wp.customize('menu_bg_color',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation').css('background-color', newval );
		} );
	});	
	// Menu items
	wp.customize('menu_items_color',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation a, .main-navigation li::before').css('color', newval );
		} );
	});			
	// Body text color
	wp.customize('body_text_color',function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	});	
	// Widgets
	wp.customize('widgets_color',function( value ) {
		value.bind( function( newval ) {
			$('.widget-area .widget, .widget-area .widget a').css('color', newval );
		} );
	});	
	//Footer color
	wp.customize('footer_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-footer, .footer-widget-area ').css('background-color', newval );
		} );
	});		
	// Font sizes
	wp.customize('site_title_size',function( value ) {
		value.bind( function( newval ) {
			$('.site-title').css('font-size', newval + 'px' );
		} );
	});	
	wp.customize('site_desc_size',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('font-size', newval + 'px' );
		} );
	});
	wp.customize('menu_size',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation li').css('font-size', newval + 'px' );
		} );
	});					
	wp.customize('h1_size',function( value ) {
		value.bind( function( newval ) {
			$('h1').not('.site-title, .slide-title').css('font-size', newval + 'px' );
		} );
	});	
    wp.customize('h2_size',function( value ) {
        value.bind( function( newval ) {
            $('h2').not('.site-description').css('font-size', newval + 'px' );
        } );
    });	
    wp.customize('h3_size',function( value ) {
        value.bind( function( newval ) {
            $('h3').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('h4_size',function( value ) {
        value.bind( function( newval ) {
            $('h4').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('h5_size',function( value ) {
        value.bind( function( newval ) {
            $('h5').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('h6_size',function( value ) {
        value.bind( function( newval ) {
            $('h6').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('body_size',function( value ) {
        value.bind( function( newval ) {
            $('body').css('font-size', newval + 'px' );
        } );
    });
	//Logo size
	wp.customize('logo_size',function( value ) {
		value.bind( function( newval ) {
			$('.site-logo').css('max-width', newval + 'px' );
		} );
	});
	// Header padding
	wp.customize('branding_padding',function( value ) {
		value.bind( function( newval ) {
			$('.site-branding').css('padding-top', newval + 'px' );
			$('.site-branding').css('padding-bottom', newval + 'px' );		
		} );
	});		    
} )( jQuery );
