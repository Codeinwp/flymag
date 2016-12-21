//Masonry init
jQuery(function ($) {
    'use strict';
    var $container = $('.home-wrapper');
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.hentry',
            columnWidth: function (containerWidth) {
                return containerWidth / 2;
            },
            isAnimated: true,
            isFitWidth: true,
            animationOptions: {
                duration: 500,
                easing: 'linear',
            }
        });
    });
});