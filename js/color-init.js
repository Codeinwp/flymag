/**
 * Color picker
 */

( function ($) {
    'use strict';

    function initColorPicker(widget) {
        widget.find('.color-picker').wpColorPicker({
            change: function () {
                $(this).trigger('change');
            }
        });
    }

    function onFormUpdate(event, widget) {
        initColorPicker(widget);
    }

    $(document).on('widget-added widget-updated', onFormUpdate);

    $(document).ready(function () {
        $('#widgets-right .widget:has(.color-picker)').each(function () {
            initColorPicker($(this));
        });
    });
}(jQuery) );