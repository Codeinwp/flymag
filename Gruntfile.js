// jshint node:true

module.exports = function( grunt ) {
    'use strict';

    var loader = require( 'load-project-config' ),
        config = require( 'grunt-theme-fleet' );
    config = config();
    config.files.php.push( '!inc/admin/**/*.php' );
    config.files.php.push( '!class-tgm-plugin-activation.php' );

    config.files.js.push( '!inc/admin/**/*.js' );
    config.files.js.push( '!js/imagesloaded.pkgd.js' );
    config.files.js.push( '!js/html5shiv.js' );
    config.files.js.push( '!js/imagesloaded.pkgd.min.js' );
    config.files.js.push( '!js/jquery.easy-ticker.js' );
    config.files.js.push( '!js/jquery.easy-ticker.min.js' );
    config.files.js.push( '!js/jquery.fitvids.js' );
    config.files.js.push( '!js/jquery.slicknav.js' );
    config.files.js.push( '!js/jquery.slicknav.min.js' );
    config.files.js.push( '!js/owl.carousel.js' );
    config.files.js.push( '!js/owl.carousel.min.js' );
    config.files.js.push( '!js/skip-link-focus-fix.js' );
    config.files.js.push( '!js/wow.js' );
    config.files.js.push( '!js/wow.min.js' );
    config.files.js.push( '!ti-about-page/**' );
    loader( grunt, config ).init();
};