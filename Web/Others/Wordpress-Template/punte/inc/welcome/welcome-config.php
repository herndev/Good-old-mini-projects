<?php
	/**
	 * Welcome Page Initiation
	*/

	include get_template_directory() . '/inc/welcome/welcome.php';

	/** Plugins **/
	$plugins = array(
		// *** Companion Plugins
		'companion_plugins' => array(

			
		),

		// *** Displays on Import Demo section
		'req_plugins' => array(
			'access-demo-importer' => array(
					'slug' 		=> 'access-demo-importer',
					'name' 		=> esc_html__('Access Demo Importer', 'punte'),
					'filename' 	=>'access-demo-importer.php',
					'host_type' => 'wordpress', // Use either bundled, remote, wordpress
					'class' 	=> 'Access_Demo_Importer',
					'location' 	=> get_template_directory().'/inc/welcome/plugins/access-demo-importer.zip',
					'info' 		=> esc_html__('Access Demo Importer adds the feature to Import the Demo Conent with a single click.', 'punte'),
			),

		),

		//Displays on Required Plugins tab
		'required_plugins' => array(
			// Free Plugins
			'free_plugins' => array(

				'redux-framework' => array(
					'slug' 		=> 'redux-framework',
					'filename' 	=> 'redux-framework.php',
					'class' 	=> 'ReduxFramework',
				),

				'elementor' => array(
					'slug' 		=> 'elementor',
					'filename' 	=> 'elementor.php',
					'function' 	=> 'elementor_load_plugin_textdomain',
				),

				'ap-companion' => array(
					'slug' 		=> 'ap-companion',
					'filename' 	=> 'ap-companion.php',
					'class' 	=> 'Ap_Companion',
				),

			),
		),

		
	);

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' => esc_html__( 'Punte Setup', 'punte' ),
		'theme_short_description' => esc_html__( 'Meet Punte powerful multipurpose WordPress theme ready to publish any websites. The theme is fully compatible with most popular page builder Elementor so you can easily showcase your ideas into website within a moment.', 'punte' ),

		// Plugin Action Texts
		'install_n_activate' 	=> esc_html__('Install and Activate', 'punte'),
		'deactivate' 			=> esc_html__('Deactivate', 'punte'),
		'activate' 				=> esc_html__('Activate', 'punte'),

		// Getting Started Section
		'doc_heading' 		=> esc_html__('Step 1 - Documentation', 'punte'),
		'doc_description' 	=> esc_html__('Read the Documentation and follow the instructions to manage the site , it helps you to set up the theme more easily and quickly. The Documentation is very easy with its pictorial  and well managed listed instructions. ', 'punte'),
		'doc_read_now' 		=> esc_html__( 'Read Now', 'punte' ),
		'cus_heading' 		=> esc_html__('Step 2 - Customizer Panel', 'punte'),
		'cus_description' 	=> esc_html__('Using the Punte customizer panel you can easily customize every aspect of the theme.', 'punte'),
		'cus_read_now' 		=> esc_html__( 'Go to Customizer Panels', 'punte' ),

		// Recommended Plugins Section
		'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'punte' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'punte' ),

		

		// Demo Actions
		'activate_btn' 		=> esc_html__('Activate', 'punte'),
		'installed_btn' 	=> esc_html__('Activated', 'punte'),
		'demo_installing' 	=> esc_html__('Installing Demo', 'punte'),
		'demo_installed' 	=> esc_html__('Demo Installed', 'punte'),
		'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'punte'),

		// Actions Required
		'req_plugin_info' => esc_html__('All these required plugins will be installed and activated while importing demo. Or you can choose to install and activate them manually. If you\'re not importing any of the demos, you must install and activate these plugins manually.', 'punte' ),
		'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'punte' ),
		'customize_theme_btn' 	=> esc_html__( 'Customize Theme', 'punte' ),
	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new Punte_Welcome( $plugins, $strings );


	