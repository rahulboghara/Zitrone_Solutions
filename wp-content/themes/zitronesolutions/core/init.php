<?php

// ------------------------------------------------------------------------
// Add Redux Framework & extras
// ------------------------------------------------------------------------

require_once(get_template_directory() . '/core/options-init.php');
$redux_ThemeTek = get_option( 'redux_ThemeTek' );

define( 'ZS_THEME_PATH', dirname(dirname(__FILE__)) );
define( 'ZS_THEME_PLUGINS_DIR', ZS_THEME_PATH . '/plugins' );

// ------------------------------------------------------------------------
// Theme includes
// ------------------------------------------------------------------------

// Wordpress Bootstrap Menu
require_once ( get_template_directory() . '/core/assets/extra/wp_bootstrap_navwalker.php');

// ------------------------------------------------------------------------
// Enqueue scripts and styles front and admin
// ------------------------------------------------------------------------

	if( !function_exists('zitronesolutions_enqueue_front') ) {
		function zitronesolutions_enqueue_front() {

			$redux_ThemeTek = get_option( 'redux_ThemeTek' );
			// Bootstrap CSS
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/core/assets/css/bootstrap.min.css', '', '' );
			// Theme main style CSS
			wp_enqueue_style( 'zitronesolutions-style', get_stylesheet_uri() );
			// Dynamic Styles
			wp_enqueue_style( 'zitronesolutions-dynamic-styles', get_template_directory_uri() . '/core/assets/css/dynamic-zitronesolutions.css', '', '' );
			// Font Awesome
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/core/assets/css/font-awesome.min.css', '', '' );
			// Bootstrap JS
			wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/core/assets/js/bootstrap.min.js', array('jquery'), '', true );
			// Masonry
			if( is_front_page() || is_page_template('portfolio.php') ) {
				wp_enqueue_script( 'masonry' );
			}
			if( is_singular( 'portfolio' ) ) {
				wp_enqueue_style( 'photoswipe', get_template_directory_uri() . '/core/assets/css/photoswipe.css', '', '' );
				wp_enqueue_style( 'photoswipe-skin', get_template_directory_uri() . '/core/assets/css/photoswipe-default-skin.css', '', '' );
				wp_enqueue_script( 'photoswipejs', get_template_directory_uri() . '/core/assets/js/photoswipe.min.js', array('jquery'), '', true );
				wp_enqueue_script( 'photoswipejs-ui', get_template_directory_uri() . '/core/assets/js/photoswipe-ui-default.min.js', array('jquery'), '', true );
			}
			// Theme main scripts
			wp_enqueue_script( 'zitronesolutions-smooth-scroll', get_template_directory_uri() . '/core/assets/js/SmoothScroll.js', array(), '', true );
			wp_enqueue_script( 'zitronesolutions-scripts', get_template_directory_uri() . '/core/assets/js/scripts.js', array(), '', true );

			// Visual composer - move styles to head
			wp_enqueue_style( 'js_composer_front' );
			wp_enqueue_style( 'js_composer_custom_css' );

		}
	}
	add_action( 'wp_enqueue_scripts', 'zitronesolutions_enqueue_front' );

	if( !function_exists('zitronesolutions_enqueue_admin') ) {
		function zitronesolutions_enqueue_admin() {
					wp_enqueue_style( 'zitronesolutions_wp_admin_css', get_template_directory_uri() . '/core/assets/css/admin-styles.css', '', '' );
	        wp_enqueue_script( 'zitronesolutions_wp_admin_js', get_template_directory_uri() . '/core/assets/js/admin-scripts.js', '', '1.0.0' );
		}
	}
	add_action( 'admin_enqueue_scripts', 'zitronesolutions_enqueue_admin' );

// ------------------------------------------------------------------------
// Theme Setup
// ------------------------------------------------------------------------

	function zitronesolutions_setup(){
		if ( function_exists( 'add_theme_support' ) ) {
			// Add multilanguage support
			load_theme_textdomain( 'zitronesolutions', get_template_directory() . '/languages' );
			// Add theme support for feed links
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'custom-header', array() );
			add_theme_support( 'custom-background', array() );
			// Add theme support for menus
			if ( function_exists( 'register_nav_menus' ) ) {
				register_nav_menus(
					array(
					  'zitronesolutions-header-menu' => 'Header Menu',
						'zitronesolutions-footer-menu' => 'Footer Menu'
					)
				);
			}
			// Enable support for Blog Posts Thumbnails
			add_theme_support( 'post-thumbnails' );
			}
	}
	add_action( 'after_setup_theme', 'zitronesolutions_setup' );


// ------------------------------------------------------------------------
// Include plugin check, meta boxes, widgets, custom posts
// ------------------------------------------------------------------------

	// Theme activation and plugin check
	include( get_template_directory() . '/core/theme-activation.php' );

	// Add post meta boxes
	include( get_template_directory() . '/core/theme-pagemeta.php' );

	// Register widgetized areas
	include( get_template_directory() . '/core/theme-sidebars.php' );

	// Add theme custom widgets
	include( get_template_directory() . '/core/widgets/socials.php' );

// ------------------------------------------------------------------------
// Content Width
// ------------------------------------------------------------------------

	if ( ! isset( $content_width ) ) $content_width = 1240;

// ------------------------------------------------------------------------
// Main menu custom child pages attribute
// ------------------------------------------------------------------------

	function zitronesolutions_special_nav_class($classes, $item){
    	$themetek_menu_locations = get_nav_menu_locations();
			$themetek_pageid = get_post_meta( $item->ID, '_menu_item_object_id', true );
      $themetek_parrent_bool = get_page( $themetek_pageid );
      if ( ! empty($themetek_parrent_bool) && is_a($themetek_parrent_bool, 'WP_Post') ) {
				if($themetek_parrent_bool->post_parent) {
					$classes[] = 'one-page-link';
				}
  	 	}

    	return $classes;
	}
	add_filter('nav_menu_css_class' , 'zitronesolutions_special_nav_class' , 10 , 2);

// ------------------------------------------------------------------------
// Blog functionality
// ------------------------------------------------------------------------

	// Custom blog navigation
	function zitronesolutions_link_attributes_1($themetek_output) {
			return str_replace('<a href=', '<a class="next" href=', $themetek_output);
	}
	function zitronesolutions_link_attributes_2($themetek_output) {
			return str_replace('<a href=', '<a class="prev" href=', $themetek_output);
	}

	add_filter('next_post_link', 'zitronesolutions_link_attributes_1');
	add_filter('previous_post_link', 'zitronesolutions_link_attributes_2');

	// Comment reply script enqueued
	function zitronesolutions_enqueue_comments_reply() {
		if( get_option( 'thread_comments' ) )  {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'comment_form_before', 'zitronesolutions_enqueue_comments_reply' );

	// Search filter
	add_action( 'pre_get_posts', function ( $q ) {
    if ( !is_admin() && $q->is_main_query() && $q->is_search() ) {
        $q->set( 'post_type', ['my_custom_post_type', 'post'] );
    }
	});

	// Excerpt length
	function zitronesolutions_excerpt_length($length) {
		return 23;
	}
	add_filter('excerpt_length', 'zitronesolutions_excerpt_length');

	function zitronesolutions_remove_api () {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	}
	add_action( 'after_setup_theme', 'zitronesolutions_remove_api' );

// ------------------------------------------------------------------------
// Output Visual Composer custom CSS
// ------------------------------------------------------------------------

add_action('wp_head', 'zitronesolutions_vc_custom_css');
function zitronesolutions_vc_custom_css() {
   $zitronesolutions_homePageID=get_the_ID();
   $zitronesolutions_args=array('post_type'=>'page','posts_per_page'=>-1,'post_parent'=>$zitronesolutions_homePageID,'post__not_in'=>array($zitronesolutions_homePageID),'order'=>'ASC','orderby'=>'menu_order');
   $zitronesolutions_parent=new WP_Query($zitronesolutions_args);
   while($zitronesolutions_parent->have_posts()) {
   $zitronesolutions_parent->the_post();
   $current_id = get_the_ID();
   wp_reset_postdata();
        if  ( $current_id ) {
            $shortcodes_custom_css = get_post_meta( $current_id, '_wpb_shortcodes_custom_css', true );
            if ( ! empty( $shortcodes_custom_css ) ) {
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.$current_id.'">';
                echo esc_html($shortcodes_custom_css);
                echo '</style>';
            }
		}
	}
}


add_action('wp_head', 'zitronesolutions_vc_custom_colors');
function zitronesolutions_vc_custom_colors() {
                echo '<style type="text/css">';
				$redux_ThemeTek = get_option( 'redux_ThemeTek' );
                include( get_template_directory() . '/core/colors-zitronesolutions.css.php' );
                echo '</style>';
}


// ------------------------------------------------------------------------
// Force Visual Composer to initialize as "built into the theme".
// ------------------------------------------------------------------------

	function zitronesolutions_vcSetAsTheme() {
		vc_set_as_theme($disable_updater = true);
	}
	add_action( 'vc_before_init', 'zitronesolutions_vcSetAsTheme' );

// ------------------------------------------------------------------------
// Output Theme Options custom CSS
// ------------------------------------------------------------------------

	function zitronesolutions_custom_theme_styles() {
		$redux_ThemeTek = get_option( 'redux_ThemeTek' );
		if ( isset($redux_ThemeTek['tek-css']) ) {
			echo '<style type="text/css" data-type="zitronesolutions-custom-css">';
			echo $redux_ThemeTek['tek-css'];
			echo '</style>';
		}
	}
	add_action('wp_head', 'zitronesolutions_custom_theme_styles');

// ------------------------------------------------------------------------
// Redirect
// ------------------------------------------------------------------------

	function zitronesolutions_redirect_visitors() {
		$redux_ThemeTek = get_option( 'redux_ThemeTek' );
		if (!isset($redux_ThemeTek['tek-coming-soon'])) $redux_ThemeTek['tek-coming-soon'] = '';
		if (!isset($redux_ThemeTek['tek-coming-soon-page'])) $redux_ThemeTek['tek-coming-soon-page'] = '';
		if ($redux_ThemeTek['tek-coming-soon']) {
		    if ( !is_user_logged_in() && is_front_page() || !is_user_logged_in() && is_home() )  {
		        wp_redirect( get_permalink($redux_ThemeTek['tek-coming-soon-page']));
		        exit;
		    }
		}
	}
	add_action( 'template_redirect', 'zitronesolutions_redirect_visitors' );


// ------------------------------------------------------------------------
// WooCommerce
// ------------------------------------------------------------------------
	if( class_exists( 'WooCommerce' ) && !empty($redux_ThemeTek['tek-woo-support']) && $redux_ThemeTek['tek-woo-support'] == 1 ) {
		require_once ( get_template_directory() . '/core/theme-woocommerce.php' );
	}
