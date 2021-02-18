<?php
// ------------------------------------------------------------------------
// Include the TGM_Plugin_Activation class
// ------------------------------------------------------------------------

include_once (get_template_directory() . '/core/assets/extra/class-tgm-plugin-activation.php');

// Register the required plugins for this theme.

if (!function_exists('zitronesolutions_register_plugins'))
	{
	function zitronesolutions_register_plugins()
		{
		$plugins = array(
			array(
				'name' => esc_html__('Zitronesolutions Framework', 'zitronesolutions'),
				'slug' => 'zitronesolutions-framework',
				'source' => ZS_THEME_PLUGINS_DIR . '/zitronesolutions-framework.zip',
				'required' => true,
				'force_activation' => false,
				'force_deactivation' => true,
				'external_url' => '',
				'version' => '3.6',
			),
			array(
				'name' => 'Wordpress Importer',
				'slug' => 'wordpress-importer',
				'source' => ZS_THEME_PLUGINS_DIR . '/wordpress-importer.zip',
				'required' => true,
				'version' => '',
				'force_activation' => false,
				'force_deactivation' => true,
				'external_url' => '',
			),
			array(
				'name' => 'WPBakery Visual Composer',
				'slug' => 'js_composer',
				'source' => ZS_THEME_PLUGINS_DIR . '/js_composer.zip',
				'required' => true,
				'version' => '5.4.2',
				'force_activation' => false,
				'force_deactivation' => true,
				'external_url' => '',
			),
			array(
				'name' => 'WPBakery Templatera',
				'slug' => 'templatera',
				'source' => ZS_THEME_PLUGINS_DIR . '/templatera.zip',
				'required' => false,
				'version' => '1.1.12',
				'force_activation' => false,
				'force_deactivation' => false,
				'external_url' => '',
			),
			array(
				'name' => 'Slider Revolution',
				'slug' => 'revslider',
				'source' => ZS_THEME_PLUGINS_DIR . '/revslider.zip',
				'required' => true,
				'version' => '5.4.6.3',
				'force_activation' => false,
				'force_deactivation' => true,
				'external_url' => '',
			),
			array(
				'name' => esc_html__('ZitroneSolutions Addon', 'zitronesolutions'),
				'slug' => 'zitronesolutions-addon',
				'source' => ZS_THEME_PLUGINS_DIR . '/zitronesolutions-addon.zip',
				'required' => true,
				'force_activation' => false,
				'force_deactivation' => true,
				'external_url' => '',
				'version' => '1.9.2',
			),
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
				'required' => false,
			),
			array(
				'name' => 'Contact Form 7',
				'slug' => 'contact-form-7',
				'required' => true,
			),
		);

		$config = array(
			'domain' => 'zitronesolutions',
			'default_path' => '',
			'parent_slug' => 'themes.php',
			'menu' => 'install-required-plugins',
			'has_notices' => true,
			'is_automatic' => true,
			'message' => '',
			'strings' => array(
				'page_title' => esc_html__('Install Required Plugins', 'zitronesolutions'),
				'menu_title' => esc_html__('Install Plugins', 'zitronesolutions'),
				'installing' => esc_html__('Installing Plugin: %s', 'zitronesolutions'),
				'oops' => esc_html__('Something went wrong with the plugin API.', 'zitronesolutions') ,
				'notice_can_install_required' => esc_html__('This theme requires the following plugin: %1$s.', 'zitronesolutions'),
				'notice_can_install_recommended' => esc_html__('This theme recommends the following plugin: %1$s.', 'zitronesolutions'),
				'notice_cannot_install' => esc_html__('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'zitronesolutions'),
				'notice_can_activate_required' => esc_html__('The following required plugin is currently inactive: %1$s.', 'zitronesolutions'),
				'notice_can_activate_recommended' => esc_html__('The following recommended plugin is currently inactive: %1$s.', 'zitronesolutions'),
				'notice_cannot_activate' => esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'zitronesolutions'),
				'notice_ask_to_update' => esc_html__('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'zitronesolutions'),
				'notice_cannot_update' => esc_html__('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'zitronesolutions'),
				'install_link' => esc_html__('Begin installing plugin', 'zitronesolutions') ,
				'activate_link' => esc_html__('Activate installed plugin', 'zitronesolutions') ,
				'return' => esc_html__('Return to Required Plugins Installer', 'zitronesolutions') ,
				'plugin_activated' => esc_html__('Plugin activated successfully.', 'zitronesolutions') ,
				'complete' => esc_html__('All plugins installed and activated successfully. %s', 'zitronesolutions'),
				'nag_type' => 'updated'
			)
		);
		tgmpa($plugins, $config);
		}
	}

add_action('tgmpa_register', 'zitronesolutions_register_plugins');
?>
