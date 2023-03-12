function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$( document ).ready(function() {
		$(document.body).on('updated_cart_totals added_to_cart removed_from_cart', function () {
		    var data = {
		        'action': 'wc_confetti_cart_check'
		    };
		    $.post(confettiCookie.ajaxurl, data, function (response) {
		        if (response >= parseFloat(confettiCookie.amount) && getCookie('confettiCookie') != 'done') {
		            confetti.start();
		            setTimeout(setTimeout(function () {
		                confetti.stop();
		                $('.freeShipping').remove();
		                if (confettiCookie.blur) {
		                	$('#page').css({'filter':'none'});
		                }
		            }, confettiCookie.duration), confettiCookie.delay);
		            $('body').append('<span class="freeShipping">' + confettiCookie.text + '</span>');
		            $('.freeShipping').css({
		                'position'		: 'fixed',
		                'color'			: confettiCookie.color,
		                'background'	: confettiCookie.bg,
		                'padding'		: confettiCookie.pad,
		                'border'		: confettiCookie.border,
		                'font-size'		: confettiCookie.size,
		                'font-family'	: confettiCookie.font,
		                'z-index'		: '2147483647',
		                'left'			: '50%',
		                'top'			: '50%',
		                'margin-left': function () {
		                    return -$(this).outerWidth() / 2
		                },
		                'margin-top': function () {
		                    return -$(this).outerHeight() / 2
		                },
		            });
		            if (confettiCookie.blur) {
		            	$('#page').css({'filter':'blur(5px)'});
		            }
		            document.cookie = "confetti=done; path=/";
		        } else if (response < parseFloat(confettiCookie.amount)) {
		            document.cookie = "confetti=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		        }
		    });
		});
	});

})( jQuery );
