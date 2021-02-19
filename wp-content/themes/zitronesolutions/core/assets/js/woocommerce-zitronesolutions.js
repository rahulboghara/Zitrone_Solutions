(function($){
	"use strict";
	
	function get_cart(){
		if(window.wc_add_to_cart_params!=undefined){
			$.post({
				url: wc_add_to_cart_params.ajax_url,
				dataType: 'JSON',
				data: {action: 'woomenucart_ajax', nonce: zitronesolutions_menucart_ajax.nonce},
				success: function(data, textStatus, XMLHttpRequest){
					$('.zitronesolutions-cart-dropdown').html(data.cart);
					if(data.articles < 1) { $('.zitronesolutions-cart-dropdown').html('<li><span class="empty-cart">Your cart is currently empty</span></li>'); }
					if(data!='') {
						if($('.zitronesolutions-cart .badge, .mobile-shopping-cart .badge').length){
							if(data.articles>0){
								$('.zitronesolutions-cart .badge, .mobile-shopping-cart .badge').html(data.articles);
								$('.zitronesolutions-cart .badge, .mobile-shopping-cart .badge').show();
							} else {
								$('.zitronesolutions-cart .badge, .mobile-shopping-cart .badge').hide();
							}
						} else $('.zitronesolutions-cart .cart-icon-container').append('<span class="badge">'+data.articles+'</span>');
					}
				}
			});
		}
	}

	$(document).ready(function(){
		$('body').bind("added_to_cart",get_cart);
		$('body').bind("wc_fragments_refreshed",get_cart);
	});
	
})(jQuery);