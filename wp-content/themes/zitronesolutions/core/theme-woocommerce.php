<?php



	// Add theme support for woocommerce

	add_theme_support( 'woocommerce' );



	// Remove WooCommerce enqueued styles

	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );



	// Remove WooCommerce prettyPhoto

	add_action( 'wp_enqueue_scripts', 'zitronesolutions_remove_woo_scripts', 99 );

	function zitronesolutions_remove_woo_scripts() {

	    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

	    wp_dequeue_script( 'prettyPhoto' );

	    wp_dequeue_script( 'prettyPhoto-init' );

	}



	// Return 9 products in shop page

	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );



	function zitronesolutions_enqueue_woocommerce() {



		wp_enqueue_style( 'zitronesolutions-woocommerce', get_template_directory_uri() . '/core/assets/css/woocommerce.css', array(), null, 'all' );

		wp_register_script( 'zitronesolutions-ajaxcart', get_template_directory_uri() . '/core/assets/js/woocommerce-zitronesolutions.js', array() , null );



		wp_localize_script(

			'zitronesolutions-ajaxcart',

			'zitronesolutions_menucart_ajax',array('nonce' => wp_create_nonce('zitronesolutions-ajaxcart'))

		);



		wp_enqueue_script( 'zitronesolutions-ajaxcart' );



	}

	add_action('wp_enqueue_scripts', 'zitronesolutions_enqueue_woocommerce');





	function zitronesolutions_get_cart_items() {

		global $woocommerce;



		$articles = sizeof( $woocommerce->cart->get_cart() );

		$cart = $items_total = '';



		if (  $articles > 0 ) {

			$items_total = $woocommerce->cart->cart_contents_count;

			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {

				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );



				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {



					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );

					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					$product_price = apply_filters( 'woocommerce_cart_item_price', $woocommerce->cart->get_product_price( $_product ), $cart_item, $cart_item_key );



					$cart .= '<li class="cart-item-list clearfix">';

					if ( ! $_product->is_visible() ) {

						$cart .= str_replace( array( 'http:', 'https:' ), '', $thumbnail );

					} else {

						$cart .= '<a class="cart-thumb" href="'.esc_url(get_permalink( $product_id )).'">

									'.str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '

								</a>';

					}



					$cart .= '<div class="cart-desc"><a class="cart-item" href="'.esc_url(get_permalink( $product_id )).'">' . $product_name . '</a>';



					$cart .= '<span class="product-quantity">'. apply_filters( 'woocommerce_widget_cart_item_quantity',  '<span class="quantity-container">' . sprintf( '%s &times; %s',$cart_item['quantity'] , '</span>' . $product_price ) , $cart_item, $cart_item_key ) . '</span>';

					$cart .= '</div>';

					$cart .= '</li>';

				}

			}



			$cart .= '<li class="subtotal"><span><strong>' . esc_html__('Subtotal:', 'zitronesolutions') . '</strong> ' . $woocommerce->cart->get_cart_total() . '</span></li>';



			$cart .= '<li class="buttons clearfix">

						<a href="'.wc_get_cart_url().'" class="wc-forward btn btn-link"><i class="fa fa-bag"></i>'.esc_html__( 'View Cart', 'zitronesolutions' ).'</a>

						<a href="'.wc_get_checkout_url().'" class="checkout wc-forward btn btn-link"><i class="fa fa-square-check"></i>'.esc_html__( 'Checkout', 'zitronesolutions' ).'</a>

					  </li>';

		}



		return array('cart' => $cart, 'articles' => $items_total);

	}



	function zitronesolutions_woomenucart_ajax() {

		if ( !wp_verify_nonce( $_REQUEST['nonce'], "zitronesolutions-ajaxcart")) {

				exit();

		}



		$cart = zitronesolutions_get_cart_items();



		echo json_encode($cart);



		die();

	}



	add_action( 'wp_ajax_woomenucart_ajax', 'zitronesolutions_woomenucart_ajax');

	add_action( 'wp_ajax_nopriv_woomenucart_ajax', 'zitronesolutions_woomenucart_ajax' );







	function zitronesolutions_add_cart_in_menu() {

		global $woocommerce;



		$items_total = $woocommerce->cart->cart_contents_count;

		$get_cart_items = zitronesolutions_get_cart_items();



		$cart_container = '<ul role="menu" class="drop-menu cart_list product_list_widget zitronesolutions-cart-dropdown">'.((isset($get_cart_items['cart']) && $get_cart_items['cart'] !=='') ? $get_cart_items['cart'] : '<li><span class="empty-cart">' . esc_html__('Your cart is currently empty','zitronesolutions') . '</span></li>').'</ul>';

		$zs_cart_items = '<div class="zitronesolutions-cart menu-item menu-item-has-children dropdown">

					      <a href="'.wc_get_cart_url().'" class="dropdown-toggle" title="cart">

						  <span class="cart-icon-container">';

		$zs_cart_items .= '<i class="fa nc-icon-outline-cart"></i>';

		$zs_cart_items .= (( $items_total !== 0 ) ? '<span class="badge">'.$items_total.'</span>' : '<span class="badge" style="display: none;"></span>').'</span></a>'.$cart_container.'</div>';



		return $zs_cart_items;

	}







	function zitronesolutions_wc_loop_add_to_cart_scripts() {

    if ( is_shop() || is_product_category() || is_product_tag() || is_product() ) : ?>



	<script>

		jQuery( document ).ready( function( $ ) {

			$( document ).on( 'change', '.quantity .qty', function() {

				$( this ).parent( '.quantity' ).next( '.add_to_cart_button' ).attr( 'data-quantity', $( this ).val() );

			});

		});

	</script>



	    <?php endif;

	}



	add_action( 'wp_footer', 'zitronesolutions_wc_loop_add_to_cart_scripts' );
?>
