<?php

/**
 * Theme Customizer Boilerplate
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2012, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
*/


/**
 * Arrays of options
 */
require( dirname(__FILE__) . '/options.php' );

/**
 * Helper functions
 */
require( dirname(__FILE__) . '/helpers.php' );




/**
 * Adds Customizer Sections, Settings and Controls
 *
 * - Require Custom Customizer Controls
 * - Add Customizer Sections
 *   -- Add Customizer Settings
 *   -- Add Customizer Controls
 *
 * @uses	bramble_get_theme_customizer_sections()	Defined in helpers.php
 * @uses	bramble_settings_page_capability()			Defined in helpers.php
 * @uses	bramble_get_theme_customizer_fields()		Defined in options.php
 *
 * @link	$wp_customize->add_section				http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
 * @link	$wp_customize->add_setting				http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
 * @link	$wp_customize->add_control				http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
 */
function bramble_customizer_customize_register( $wp_customize ) {

	/**
	 * Custom controls
	 */
	require( dirname(__FILE__) . '/custom-controls.php' );


	/*
	 * Get all the fields using a helper function
	 */
	$bramble_sections = bramble_customizer_get_fields();


	/*
	 * Get name of DB entry under which options will be stored
	 */
	$bramble_customizer_option = bramble_customizer_option();


	/**
	 * Loop through the array and add Customizer sections
	 */
	foreach( $bramble_sections as $bramble_section_key => $bramble_section_value ) {

		/**
		 * Adds Customizer section, if needed
		 */
		if( ! $bramble_section_value['existing_section'] ) {

			$bramble_section_args = $bramble_section_value['args'];

			// Add section
			$wp_customize->add_section(
				$bramble_section_key,
				$bramble_section_args
			);

		} // end if

		/*
		 * Loop through 'fields' array in each section
		 * and add settings and controls
		 */
		$bramble_section_fields = $bramble_section_value['fields'];
		foreach( $bramble_section_fields as $bramble_field_key => $bramble_field_value ) {

			/*
			 * Check if 'option' or 'theme_mod' is used to store option
			 *
			 * If nothing is set, $wp_customize->add_setting method will default to 'theme_mod'
			 * If 'option' is used as setting type its value will be stored in an entry in
			 * {prefix}_options table. Option name is defined by bramble_customizer_option() function
			 */
			if ( isset( $bramble_field_value['setting_args']['type'] ) && 'option' == $bramble_field_value['setting_args']['type'] ) {
				$setting_control_id = $bramble_customizer_option . '[' . $bramble_field_key . ']';
			} else {
				$setting_control_id = $bramble_field_key;
			}

			/*
			 * Add default callback function, if none is defined
			 */
			if ( ! isset( $bramble_field_value['setting_args']['sanitize_cb'] ) ) {
				$bramble_field_value['setting_args']['sanitize_cb'] = 'bramble_customizer_sanitize_cb';
			}

			/**
			 * Adds Customizer settings
			 */
			$wp_customize->add_setting(
				$setting_control_id,
				$bramble_field_value['setting_args']
			);

			/**
			 * Adds Customizer control
			 *
			 * 'section' value must be added to 'control_args' array
			 * so control can get added to current section
			 */
			$bramble_field_value['control_args']['section'] = $bramble_section_key;

			/*
			 * $wp_customize->add_control method requires 'choices' to be a simple key => value pair
			 */
			if ( isset( $bramble_field_value['control_args']['choices'] ) ) {
				$bramble_customizer_choices = array();
				foreach( $bramble_field_value['control_args']['choices'] as $bramble_customizer_choice_key => $bramble_customizer_choice_value ) {
					$bramble_customizer_choices[$bramble_customizer_choice_key] = $bramble_customizer_choice_value['label'];
				}
				$bramble_field_value['control_args']['choices'] = $bramble_customizer_choices;
			}


			// Check
			if ( 'color_picker' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Color_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'image' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Image_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'upload' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new WP_Customize_Upload_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'text' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Text_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'number' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Number_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'description' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Description_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'textarea' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Textarea_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'images_radio' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Images_Radio_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'radio_switch' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Radio_Switch_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'checkbox_switch' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Checkbox_Switch_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'select' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Select_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'multi_select' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Multi_Select_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'slider_theme_picker' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Slider_Theme_Picker_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'font_picker' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Google_Font_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} elseif ( 'range_slider' == $bramble_field_value['control_args']['type'] ) {
				$wp_customize->add_control(
					new Bramble_Customizer_Range_Slider_Control(
						$wp_customize,
						$setting_control_id,
						$bramble_field_value['control_args']
					)
				);
			} else {
				$wp_customize->add_control(
					$setting_control_id,
					$bramble_field_value['control_args']
				);
			}

		} // end foreach

	} // end foreach


	// Remove built-in Customizer sections
	$bramble_customizer_remove_sections = apply_filters( 'bramble_customizer_remove_sections', array() );
	if ( is_array( $bramble_customizer_remove_sections) ) {
		foreach( $bramble_customizer_remove_sections as $bramble_customizer_remove_section ) {
			$wp_customize->remove_section( $bramble_customizer_remove_section );
		}
	}

	// Remove built-in Customizer settings
	$bramble_customizer_remove_settings = apply_filters( 'bramble_customizer_remove_settings', array() );
	if ( is_array( $bramble_customizer_remove_settings) ) {
		foreach( $bramble_customizer_remove_settings as $bramble_customizer_remove_setting ) {
			$wp_customize->remove_setting( $bramble_customizer_remove_setting );
		}
	}

	// Remove built-in Customizer controls
	$bramble_customizer_remove_controls = apply_filters( 'bramble_customizer_remove_controls', array() );
	if ( is_array( $bramble_customizer_remove_controls) ) {
		foreach( $bramble_customizer_remove_controls as $bramble_customizer_remove_control ) {
			$wp_customize->remove_control( $bramble_customizer_remove_control );
		}
	}

}
add_action( 'customize_register', 'bramble_customizer_customize_register', 11 );


/**
 * Theme Customizer sanitization callback function
 */
function bramble_customizer_sanitize_cb( $input ) {

	return wp_kses_post( $input );

}