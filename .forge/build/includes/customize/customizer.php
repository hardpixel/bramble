<?php

class Bramble_Customizer
{
	function __construct()
	{
		add_action( 'customize_register', array( &$this, 'register' ) );
	}

	function register( $customize )
	{
		$this->add_sections( $customize );
		$this->add_settings( $customize );
		$this->add_controls( $customize );
	}

	function add_sections( $customize )
	{
		// Header
		$customize->add_section( 'header', array(
			'title'			=> __( 'Header', 'bramble' ),
			'priority'		=> 10
		) );

		// Main
		$customize->add_section( 'main', array(
			'title'			=> __( 'Main', 'bramble' ),
			'priority'		=> 11
		) );

		// Footer
		$customize->add_section( 'footer', array(
			'title'			=> __( 'Footer', 'bramble' ),
			'priority'		=> 12
		) );
	}

	function add_settings( $customize )
	{
		// Header
		$customize->add_setting( 'header_bg' );

		// Main
		$customize->add_setting( 'main_bg' );

		// Footer
		$customize->add_setting( 'footer_bg' );
	}

	function add_controls( $customize )
	{
		// Header Background
		$customize->add_control( 'header_bg', array(
			'section'  	=> 'header',
			'settings' 	=> 'header_bg',
			'label'   	=> 'Header Background',
			'type'		=> 'text'
		));
	}
}

$customizer = new Bramble_Customizer();