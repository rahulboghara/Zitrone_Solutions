<?php
	function zitronesolutions_importer() {
		add_theme_page('import-demo-full-custom', 'import-demo-full-custom', 'manage_options', 'import-demo', 'zitronesolutions_import_demo' );
	}
	add_action( 'admin_menu', 'zitronesolutions_importer' );

	function zitronesolutions_import_demo() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.','zitronesolutions' ) );
		}
		require plugin_dir_path( __FILE__ ) . '/import.php';
	}

	function zitronesolutions_check_import_files($zitronesolutions_demo_content, $rev_slider) {
		$zitronesolutions_response = array();

		$zitronesolutions_file_headers = @get_headers( $zitronesolutions_demo_content );
		if( !strpos( $zitronesolutions_file_headers[0], '200' ) ) {
		    $zitronesolutions_response['errors'][] = 'demo_content.xml';
		}
		$zitronesolutions_file_headers = @get_headers( $rev_slider );
		if( !strpos( $zitronesolutions_file_headers[0], '200' ) ) {
		    $zitronesolutions_response['errors'][] = 'revolution_slider.zip';
		}
		return $zitronesolutions_response;
	}

	function zitronesolutions_import_theme_files($upload_dir, $zitronesolutions_demo_content, $rev_slider) {

	file_put_contents( $upload_dir.'/revolution_slider.zip', fopen( str_replace( " ", "%20",$rev_slider ), 'r' ) );
	file_put_contents( $upload_dir.'/demo_content.xml_.txt', fopen( str_replace( " ", "%20",$zitronesolutions_demo_content ), 'r' ) );



	return array(
			'demo' => $upload_dir.'/demo_content.xml_.txt',
			'slider' => $upload_dir.'/revolution_slider.zip'
		);
	}
