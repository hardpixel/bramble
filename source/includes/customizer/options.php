<?php

/**
 * Get Theme Customizer Fields
 */


/**
 * Helper function that holds array of theme options.
 *
 * @return	array	$options	Array of theme options
 * @uses	bramble_get_theme_customizer_fields()	defined in customizer/helpers.php
 */
function bramble_customizer_get_fields() {

	global $bramble;

	/*
	 * Using helper function to get default required capability
	 */
	$bramble_customizer_capability = bramble_customizer_capability();

	$customFontFamilies;

	$fonts['Ubuntu'] = array(
		'title' => 'Ubuntu',
		'location' => 'Ubuntu',
		'cssDeclaration' => '"Ubuntu", sans-serif',
		'cssClass' => 'ubuntu'
	);

	$fonts['Open Sans'] = array(
		'title' => 'Open Sans',
		'location' => 'Open+Sans',
		'cssDeclaration' => '"Open Sans", sans-serif',
		'cssClass' => 'open-sans'
	);

	$customFontFamilies = new Google_Font_Collection( $fonts );

	$bramble_options = array(

		/*
		 * Add fields to an existing Customizer section
		 */
		'title_tagline' => array(
			'existing_section' => true,
			'fields' => array(

				'title_tagline_description' => array(
					'control_args' => array(
						'description' => __( 'Change site title and tagline to your liking.', 'bramble' ),
						'type' => 'description',
						'priority' => 1
					)
				)

			)
		),

		/*
		 * Add fields to a new Customizer section
		 */

		'bramble_branding' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Branding', 'bramble' ),
				'description' => __( 'Set your logo and other branding details.', 'bramble' ),
				'priority' => 1
			),

			'fields' => array(

				'site_logo' => array(
					/*
					 * Setting related arguments
					 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
					 */
					'setting_args' => array(
						'default' => $bramble['theme_uri'] . '/images/logo.png',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					/*
					 * Control related arguments
					 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
					 */
					'control_args' => array(
						'label' => __( 'Logo', 'bramble' ),
						'description' => __( 'Upload your logo.', 'bramble' ),
						'type' => 'image',
						'priority' => 1
					)
				),

				'site_logo_retina' => array(

					'setting_args' => array(
						'default' => $bramble['theme_uri'] . '/images/logo_x2.png',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),

					'control_args' => array(
						'label' => __( 'Logo HDPI', 'bramble' ),
						'description' => __( 'Upload your logo for high resolution screens. Image should be twice as big.', 'bramble' ),
						'type' => 'image',
						'priority' => 2
					)
				),

				'site_favicon' => array(

					'setting_args' => array(
						'default' => $bramble['theme_uri'] . '/images/favicon.png',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),

					'control_args' => array(
						'label' => __( 'Favicon', 'bramble' ),
						'description' => __( 'Upload your favicon. Image must be 16x16px.', 'bramble' ),
						'type' => 'image',
						'priority' => 3
					)
				),

			)
		),

		'bramble_layout' => array(

			/*
			 * We're checking if this is an existing section
			 * or a new one that needs to be registered
			 */
			'existing_section' => false,
			/*
			 * Section related arguments
			 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
			 */
			'args' => array(
				'title' => __( 'Layout', 'bramble' ),
				'description' => __( 'Select the general layout for your pages, posts and homepage.', 'bramble' ),
				'priority' => 2
			),

			/*
			 * This array contains all the fields that need to be
			 * added to this section
			 */
			'fields' => array(

				// Field ID
				'content_width' => array(
					/*
					 * Setting related arguments
					 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
					 */
					'setting_args' => array(
						'default' => '1280',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					/*
					 * Control related arguments
					 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
					 */
					'control_args' => array(
						'label' => __( 'Page width', 'bramble' ),
						'description' => __( 'Set the maximum page width in pixels.', 'bramble' ),
						'type' => 'number', // Text field control
						'priority' => 1
					)
				),

				'home_layout' => array(

					'setting_args' => array(
						'default' => 'sidebar_r',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Homepage', 'bramble' ),
						'description' => __( 'Choose a layout for your homepage.', 'bramble' ),
						'type' => 'images_radio',
						'choices' => array(
							'no_sidebar' => array(
								'label' => __( 'No sidebar', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/no-sidebar.png'
							),
							'sidebar_r' => array(
								'label' => __( 'Sidebar right', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-r.png'
							),
							'sidebar_l' => array(
								'label' => __( 'Sidebar left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-l.png'
							),
							'sidebar_rl' => array(
								'label' => __( 'Sidebar right left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-rl.png'
							),
							'sidebar_rr' => array(
								'label' => __( 'Sidebar right right', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-rr.png'
							),
							'sidebar_ll' => array(
								'label' => __( 'Sidebar left left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-ll.png'
							),
						),
						'priority' => 2
					)
				),

				'page_layout' => array(

					'setting_args' => array(
						'default' => 'sidebar_r',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Page', 'bramble' ),
						'type' => 'images_radio',
						'choices' => array(
							'no_sidebar' => array(
								'label' => __( 'No sidebar', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/no-sidebar.png'
							),
							'sidebar_r' => array(
								'label' => __( 'Sidebar right', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-r.png'
							),
							'sidebar_l' => array(
								'label' => __( 'Sidebar left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-l.png'
							),
							'sidebar_rl' => array(
								'label' => __( 'Sidebar right left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-rl.png'
							),
							'sidebar_rr' => array(
								'label' => __( 'Sidebar right right', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-rr.png'
							),
							'sidebar_ll' => array(
								'label' => __( 'Sidebar left left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-ll.png'
							),
						),
						'priority' => 3
					)
				),

				'post_layout' => array(

					'setting_args' => array(
						'default' => 'sidebar_r',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Post', 'bramble' ),
						'type' => 'images_radio',
						'choices' => array(
							'no_sidebar' => array(
								'label' => __( 'No sidebar', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/no-sidebar.png'
							),
							'sidebar_r' => array(
								'label' => __( 'Sidebar right', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-r.png'
							),
							'sidebar_l' => array(
								'label' => __( 'Sidebar left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-l.png'
							),
							'sidebar_rl' => array(
								'label' => __( 'Sidebar right left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-rl.png'
							),
							'sidebar_rr' => array(
								'label' => __( 'Sidebar right right', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-rr.png'
							),
							'sidebar_ll' => array(
								'label' => __( 'Sidebar left left', 'bramble' ),
								'image_src' => $bramble['theme_uri'] . '/images/theme-options/sidebar-ll.png'
							),
						),
						'priority' => 4
					)
				),
			)
		),

		'bramble_typography' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Typography', 'bramble' ),
				'description' => __( 'Set general preferences for fonts.', 'bramble' ),
				'priority' => 3
			),

			'fields' => array(

				'text_font' => array(

					'setting_args' => array(
						'default' => 'Ubuntu',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Text', 'bramble' ),
						'description' => __( 'Font for text.', 'bramble' ),
						'type' => 'font_picker',
						'choices' => $customFontFamilies->getFontFamilyNameArray(),
						'fonts' => $customFontFamilies,
						'text' => __( 'Hello Text', 'bramble' ),
						'priority' => 1
					)
				),

				'text_font_size' => array(

					'setting_args' => array(
						'default' => '16',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Text font size', 'bramble' ),
						'description' => __( 'Font size for text in pixels.', 'bramble' ),
						'type' => 'range_slider',
						'range' => 'min',
						'min' => '10',
						'max' => '24',
						'step' => '1',
						'priority' => 2
					)
				),

				'text_font_weight' => array(

					'setting_args' => array(
						'default' => 'lighter',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Text font weight', 'bramble' ),
						'description' => __( 'Font weight for paragraphs.', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'lighter' => array(
								'label' => __( 'Lighter', 'bramble' )
							),
							'normal' => array(
								'label' => __( 'Normal', 'bramble' )
							),
							'bold' => array(
								'label' => __( 'Bold', 'bramble' )
							)
						),
						'priority' => 3
					)
				),

				'headings_font' => array(

					'setting_args' => array(
						'default' => 'Ubuntu',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Headings', 'bramble' ),
						'description' => __( 'Font for headings.', 'bramble' ),
						'type' => 'font_picker',
						'choices' => $customFontFamilies->getFontFamilyNameArray(),
						'fonts' => $customFontFamilies,
						'text' => __( 'Head Text', 'bramble' ),
						'priority' => 4
					)
				),

				'headings_font_size' => array(

					'setting_args' => array(
						'default' => '16,32',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Headings font size', 'bramble' ),
						'description' => __( 'Font size for titles in pixels.', 'bramble' ),
						'type' => 'range_slider',
						'range' => 'true',
						'min' => '14',
						'max' => '48',
						'step' => '2',
						'priority' => 5
					)
				),

				'headings_font_weight' => array(

					'setting_args' => array(
						'default' => 'lighter',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Headings font weight', 'bramble' ),
						'description' => __( 'Font weight for headings.', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'lighter' => array(
								'label' => __( 'Lighter', 'bramble' )
							),
							'normal' => array(
								'label' => __( 'Normal', 'bramble' )
							),
							'bold' => array(
								'label' => __( 'Bold', 'bramble' )
							)
						),
						'priority' => 7
					)
				),

			)
		),

		'bramble_header' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Header', 'bramble' ),
				'description' => __( 'Customize page header.', 'bramble' ),
				'priority' => 4
			),

			'fields' => array(

				'show_header' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show Header', 'bramble' ),
						'type' => 'checkbox_switch',
						'enables' => array( 'show_logo', 'show_title', 'show_tagline', 'show_search' ),
						'priority' => 1
					)
				),

				'show_logo' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show Logo', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 2
					)
				),

				'show_title' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show Title', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 3
					)
				),

				'show_tagline' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show Tagline', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 4
					)
				),

				'show_search' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show Search', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 5
					)
				),

			)
		),

		'bramble_navigation' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Navigation', 'bramble' ),
				'description' => __( 'Customize menu.', 'bramble' ),
				'priority' => 5
			),

			'fields' => array(

				'show_top_menu' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Top menu', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 1
					)
				),

				'top_menu_logo' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Top menu logo', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 2
					)
				),

				'top_menu_title' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Top menu title', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 3
					)
				),

				'show_main_menu' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show main menu', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 4
					)
				),

				'main_menu_position' => array(

					'setting_args' => array(
						'default' => 'middle',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Main menu position', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'top' => array(
								'label' => __( 'Top', 'bramble' )
							),
							'middle' => array(
								'label' => __( 'Middle', 'bramble' )
							),
							'bottom' => array(
								'label' => __( 'Bottom', 'bramble' )
							)
						),
						'priority' => 5
					)
				),

				'show_footer_menu' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show footer menu', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 6
					)
				),

				'footer_menu_position' => array(

					'setting_args' => array(
						'default' => 'middle',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Footer menu position', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'top' => array(
								'label' => __( 'Top', 'bramble' )
							),
							'middle' => array(
								'label' => __( 'Middle', 'bramble' )
							),
							'bottom' => array(
								'label' => __( 'Bottom', 'bramble' )
							)
						),
						'priority' => 7
					)
				),
			)
		),

		'bramble_slider' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Slider', 'bramble' ),
				'description' => __( 'Customize slider.', 'bramble' ),
				'priority' => 6
			),

			'fields' => array(

				'show_slider' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show slider', 'bramble' ),
						'type' => 'checkbox_switch',
						'enables' => array( 'home_slider', 'get_slides_from', 'slider_mode', 'slider_speed', 'slider_animation_duration', 'slider_bullets', 'slider_arrows', 'slider_thumbnails', 'slider_theme' ),
						'priority' => 1
					)
				),

				'home_slider' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show slider on homepage only', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 2
					)
				),

				'get_slides_from' => array(
					'setting_args' => array(
						'default' => 'post',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Get slides from', 'bramble' ),
						'type' => 'multi_select',
						'choices' => get_post_types( array( 'publicly_queryable' => true, 'capability_type' => 'post' ) ),
						'priority' => 3
					)
				),

				'slider_mode' => array(
					'setting_args' => array(
						'default' => 'normal',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Position', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'normal' => array(
								'label' => __( 'Normal', 'bramble' )
							),
							'background' => array(
								'label' => __( 'Background', 'bramble' )
							)
						),
						'priority' => 4
					)
				),

				'slider_speed' => array(
					'setting_args' => array(
						'default' => '5',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Animation speed', 'bramble' ),
						'description' => __( 'Set time between each slide in seconds.', 'bramble' ),
						'type' => 'number',
						'priority' => 6
					)
				),

				'slider_animation_duration' => array(

					'setting_args' => array(
						'default' => '0.5',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Animation duration', 'bramble' ),
						'description' => __( 'Set animation duration in seconds.', 'bramble' ),
						'type' => 'number',
						'priority' => 7
					)
				),

				'slider_bullets' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show navigation bullets', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 8
					)
				),

				'slider_arrows' => array(
					'setting_args' => array(
						'default' => false,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show navigation arrows', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 9
					)
				),

				'slider_thumbnails' => array(
					'setting_args' => array(
						'default' => false,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show navigation thumbnails', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 10
					)
				),

				'slider_theme' => array(

					'setting_args' => array(
						'default' => 'basic_slider',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Theme', 'bramble' ),
						'type' => 'slider_theme_picker',
						'priority' => 11
					)
				),
			)
		),

		'bramble_footer' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Footer', 'bramble' ),
				'description' => __( 'Set general preferences for footer.', 'bramble' ),
				'priority' => 7
			),

			'fields' => array(

				'show_widgets' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show widgets in footer area.', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 1
					)
				),

				'show_copyright' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show copyright.', 'bramble' ),
						'type' => 'checkbox_switch',
						'enables' => array( 'show_powered_by' ),
						'priority' => 2
					)
				),

				'show_powered_by' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Show powered by attribution.', 'bramble' ),
						'type' => 'checkbox_switch',
						'priority' => 3
					)
				),
			)

		),

		'bramble_colors' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Colors', 'bramble' ),
				'description' => __( 'Set the colors.', 'bramble' ),
				'priority' => 8
			),

			'fields' => array(

				'base_color' => array(

					'setting_args' => array(
						'default' => '#523F6D',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Primary', 'bramble' ),
						'description' => __( 'Color for buttons, links & selection.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 1
					)
				),

				'background_color' => array(

					'setting_args' => array(
						'default' => '#fafafa',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Page background', 'bramble' ),
						'description' => __( 'Color for page background.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 2
					)
				),

				'text_color' => array(

					'setting_args' => array(
						'default' => '#333333',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Text', 'bramble' ),
						'description' => __( 'Text color for paragraphs.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 3
					)
				),

				'headings_color' => array(

					'setting_args' => array(
						'default' => '#333333',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Headings', 'bramble' ),
						'description' => __( 'Color for headings.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 4
					)
				),

				'header_background' => array(

					'setting_args' => array(
						'default' => '#cccccc',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Header', 'bramble' ),
						'description' => __( 'Header background color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 5
					)
				),

				'header_color' => array(

					'setting_args' => array(
						'default' => '#cccccc',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Header text', 'bramble' ),
						'description' => __( 'Header text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 6
					)
				),

				'top_menu_background' => array(

					'setting_args' => array(
						'default' => '#333333',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Top menu', 'bramble' ),
						'description' => __( 'Top menu background color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 7
					)
				),

				'top_menu_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Top menu text', 'bramble' ),
						'description' => __( 'Top menu text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 8
					)
				),

				'main_menu_background' => array(

					'setting_args' => array(
						'default' => '#333333',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Main menu', 'bramble' ),
						'description' => __( 'Main menu background color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 9
					)
				),

				'main_menu_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Main menu text', 'bramble' ),
						'description' => __( 'Main menu text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 10
					)
				),

				'sidebar_left_text_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Left sidebar text', 'bramble' ),
						'description' => __( 'Left sidebar text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 11
					)
				),

				'sidebar_left_headings_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Left sidebar headings', 'bramble' ),
						'description' => __( 'Left sidebar headings color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 12
					)
				),

				'sidebar_right_text_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Right sidebar text', 'bramble' ),
						'description' => __( 'Right sidebar text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 13
					)
				),

				'sidebar_right_headings_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Right sidebar headings', 'bramble' ),
						'description' => __( 'Right sidebar headings color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 14
					)
				),

				'footer_background' => array(

					'setting_args' => array(
						'default' => '#cccccc',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Footer', 'bramble' ),
						'description' => __( 'Footer background color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 15
					)
				),

				'footer_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Footer text', 'bramble' ),
						'description' => __( 'Footer text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 16
					)
				),

				'footer_headings_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Footer headings', 'bramble' ),
						'description' => __( 'Footer headings color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 17
					)
				),

				'footer_menu_background' => array(

					'setting_args' => array(
						'default' => '#333333',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Footer menu', 'bramble' ),
						'description' => __( 'Footer menu background color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 18
					)
				),

				'footer_menu_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Footer menu text', 'bramble' ),
						'description' => __( 'Footer menu text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 19
					)
				),

				'credits_background' => array(

					'setting_args' => array(
						'default' => '#333333',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Credits', 'bramble' ),
						'description' => __( 'Credits background color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 20
					)
				),

				'credits_color' => array(

					'setting_args' => array(
						'default' => '#ffffff',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Credits text', 'bramble' ),
						'description' => __( 'Credits text color.', 'bramble' ),
						'type' => 'color_picker',
						'priority' => 21
					)
				),
			)
		),

		'bramble_background_images' => array(

			'existing_section' => false,

			'args' => array(
				'title' => __( 'Background Images', 'bramble' ),
				'description' => __( 'Set background images.', 'bramble' ),
				'priority' => 9
			),

			'fields' => array(

				'custom_header_image' => array(
					'setting_args' => array(
						'default' => $bramble['theme_uri'] .'/images/header.png',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Custom Header Image', 'bramble' ),
						'type' => 'image',
						'priority' => 1
					)
				),

				'header_image_size' => array(

					'setting_args' => array(
						'default' => 'cover',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Header image size', 'bramble' ),
						'description' => __( 'Set custom header image size.', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'contain' => array(
								'label' => __( 'Contain', 'bramble' )
							),
							'cover' => array(
								'label' => __( 'Cover', 'bramble' )
							),
							'repeat' => array(
								'label' => __( 'Repeat', 'bramble' )
							)
						),
						'priority' => 2
					)
				),

				'custom_background_image' => array(
					'setting_args' => array(
						'default' => $bramble['theme_uri'] .'/images/background.png',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Custom Background Image', 'bramble' ),
						'type' => 'image',
						'priority' => 3
					)
				),

				'background_image_size' => array(

					'setting_args' => array(
						'default' => 'repeat',
						'type' => 'option',
						'capability' => $bramble_customizer_capability,
						'transport' => 'refresh',
					),
					'control_args' => array(
						'label' => __( 'Background image size', 'bramble' ),
						'description' => __( 'Set custom background image size.', 'bramble' ),
						'type' => 'radio_switch',
						'choices' => array(
							'contain' => array(
								'label' => __( 'Contain', 'bramble' )
							),
							'cover' => array(
								'label' => __( 'Cover', 'bramble' )
							),
							'repeat' => array(
								'label' => __( 'Repeat', 'bramble' )
							)
						),
						'priority' => 4
					)
				),
			)
		),


	);


	/*
	 * 'bramble_customizer_options_array' filter hook will allow you to
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'bramble_customizer_options_array', $bramble_options );

}
