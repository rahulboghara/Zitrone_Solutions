<?php
/*
	Plugin Name: ZitroneSolutions Addon
	Plugin URI: https://www.zitronesolutions.com
	Author: ZitroneSolutions
	Author URI: https://www.zitronesolutions.com
	Version: 1.9.5
	Description: ZitroneSolutions Core Plugin for Zitronesolutions Theme
	Text Domain: zitronesolutions
*/

/*
	If accesed directly, exit.
*/
if (!defined('ABSPATH')) die('-1');

if (!defined('ZITRONESOLUTIONS_PLUGIN_PATH')){
	define('ZITRONESOLUTIONS_PLUGIN_PATH', dirname(__FILE__));
}

if (!class_exists('ZITRONESOLUTIONS_ADDON_CLASS')) {

	add_action('admin_init','initiate_zitronesolutions_addon');
	function initiate_zitronesolutions_addon() {
		if( defined('WPB_VC_VERSION') ){
			if( version_compare( 5.4, WPB_VC_VERSION, '>' )){
				add_action( 'admin_notices', 'zitronesolutions_version_notice' );
				add_action( 'network_admin_notices','zitronesolutions_version_notice' );
			}
		} else {
			add_action( 'admin_notices', 'zitronesolutions_activation_notice' );
			add_action( 'network_admin_notices','zitronesolutions_activation_notice' );
		}
	}

	/* Verify VC version and activation */
	function zitronesolutions_version_notice() {
		$is_multisite = is_multisite();
		$is_network_admin = is_network_admin();
		if( ( $is_multisite && $is_network_admin ) || !$is_multisite ) {
			echo '<div class="updated">
				<p>'.__('The','zitronesolutions').' <strong>Keydesign Addon</strong> '.__('plugin requires','zitronesolutions').' <strong>WPBakery Page Builder</strong> '.__('version 5.4 or greater.','zitronesolutions').'</p>
			</div>';
		}
	}

	function zitronesolutions_activation_notice() {
		$is_multisite = is_multisite();
		$is_network_admin = is_network_admin();
		if( ( $is_multisite && $is_network_admin) || !$is_multisite ) {
			echo '<div class="updated">
				<p>'.__('The','zitronesolutions').' <strong>ZitroneSolutions Addon</strong> '.__('plugin requires','zitronesolutions').' <strong>WPBakery Page Builder</strong> '.__('Plugin installed and activated.','zitronesolutions').'</p>
			</div>';
		}
	}

	/*	Load plugin textdomain. */
	add_action( 'plugins_loaded', 'zitronesolutions_addon_load_textdomain' );
	function zitronesolutions_addon_load_textdomain() {
		load_plugin_textdomain( 'zitronesolutions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/* Activation hook */
	register_activation_hook( __FILE__, 'zitronesolutions_addon_activate' );
	function zitronesolutions_addon_activate() {
		update_option('zitronesolutions_addon_version', '1.9.5' );
	}

	/* Allow SVG icon upload */
	add_filter( 'upload_mimes', 'zitronesolutions_svg_upload' );
	function zitronesolutions_svg_upload( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/* Embed width and height */
	add_filter( 'embed_defaults', 'modify_embed_defaults' );
	function modify_embed_defaults() {
    return array(
        'width'  => 750,
        'height' => 375
    );
	}

	class ZITRONESOLUTIONS_ADDON_CLASS {
		function __construct() {
			$this->elements_folder	=	plugin_dir_path( __FILE__ ).'elements/';
			$this->params_dir = plugin_dir_path( __FILE__ ).'params/';
			add_action( 'after_setup_theme', array( $this, 'integrate_with_vc' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'zitronesolutions_load_front_scripts' ) );
			add_action( 'init', array( $this, 'zitronesolutions_init_portfolio_cpt' ), 1 );
		}

		public function integrate_with_vc() {
			if( class_exists( 'WPBakeryShortCode' ) ) {
				foreach(glob($this->elements_folder."/*.php") as $elem) {
					require_once($elem);
				}
				foreach(glob($this->params_dir."/*.php") as $param)
				{
					require_once($param);
				}
			}
		}

		public function zitronesolutions_init_portfolio_cpt() {
			require_once ( trailingslashit( ZITRONESOLUTIONS_PLUGIN_PATH ) . 'custom-post-type.php' );
		}

		public function zitronesolutions_load_front_scripts() {
			// Register & Load plug-in main style sheet
			wp_register_style( 'zs_addon_style', plugins_url('assets/css/zs_vc_front.css', __FILE__));
			wp_enqueue_style( 'zs_addon_style' );

			// Easing Script
			wp_register_script( 'zs_easing_script', plugins_url('assets/js/jquery.easing.min.js', __FILE__), array('jquery') );
			wp_enqueue_script ( 'zs_easing_script' );

			// OWL Carousel
			wp_register_script( 'zs_carousel_script', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery') );
			wp_enqueue_script ( 'zs_carousel_script' );

			// Easy Tabs
			wp_register_script( 'zs_easytabs_script', plugins_url('assets/js/jquery.easytabs.min.js', __FILE__), array('jquery') );
			wp_enqueue_script ( 'zs_easytabs_script' );

	    // Countdown Element
			wp_register_script( 'zs_countdown_script', plugins_url('assets/js/jquery.countdown.js', __FILE__), array('jquery') );

			// Pie Chart Element
			wp_register_script( 'zs_easypiechart_script', plugins_url('assets/js/jquery.easypiechart.min.js', __FILE__), array('jquery') );

			// Event session Element
			wp_register_script( 'zs_jquery_appear', plugins_url('assets/js/jquery.appear.js', __FILE__), array('jquery') );
			wp_enqueue_script ( 'zs_jquery_appear' );

			// Register & Load Photoswipe
			wp_register_style( 'photoswipe', plugins_url('assets/css/photoswipe.css', __FILE__));
			wp_register_style( 'photoswipe-skin', plugins_url('assets/css/photoswipe-default-skin.css', __FILE__));
			wp_register_script( 'photoswipejs', plugins_url('assets/js/photoswipe.min.js', __FILE__), array('jquery') );
			wp_register_script( 'photoswipejs-ui', plugins_url('assets/js/photoswipe-ui-default.min.js', __FILE__), array('jquery') );

			// Progressbar element
			wp_register_script( 'zs_progressbar', plugins_url('assets/js/zs_progressbar.js', __FILE__), array('jquery') );

			// Counter element
			wp_register_script( 'zs_countto', plugins_url('assets/js/zs_countto.js', __FILE__), array('jquery') );

			// Plugin Front End Script
			wp_register_script( 'zs_addon_script', plugins_url('assets/js/zs_addon_script.js', __FILE__), array('jquery') );
			wp_enqueue_script ( 'zs_addon_script' );
		}

	}
}
// Finally initialize code
new ZITRONESOLUTIONS_ADDON_CLASS();
