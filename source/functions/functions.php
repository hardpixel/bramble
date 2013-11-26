<?php

/*==================================================*/
/* Global Variables
/*==================================================*/

	$bramble = array(
		'theme_uri' => get_template_directory_uri(),
		'theme_ver' => '1.0'
	);


/*==================================================*/
/* Setup
/*==================================================*/

	add_action( 'after_setup_theme', 'bramble_setup' );

	function bramble_setup()
	{
		global $bramble;

		// Includes
		include( 'functions/cleanup.php' );
		include( 'includes/customizer/customizer.php' );

		include( 'includes/walkers/walker-menu.php' );
		include( 'includes/walkers/walker-comment.php' );

		// Textdomain
		load_theme_textdomain( 'bramble', $bramble['theme_uri'] . '/includes/languages' );

		// Content Width
		if ( ! isset( $content_width ) ) $content_width = 1280;

		// Theme support
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

		// Image sizes
		add_image_size( 'gallery', 300, 225, true );

		// Editor
		add_editor_style( 'includes/css/editor-style.css' );
	}


/*==================================================*/
/* Hooks
/*==================================================*/

	if( ! is_admin() )
	{
		// Headers, footers, body
		add_filter( 'the_generator', 		'remove_wp_version' );
		add_filter( 'body_class', 			'post_categories_body_class' );
		add_action( 'wp_head', 				'add_favicon' );

		// Styles
		add_action( 'wp_enqueue_scripts', 	'deregister_styles' );
		add_action( 'wp_enqueue_scripts', 	'register_styles' );
		add_action( 'wp_enqueue_scripts', 	'enqueue_styles' );
		add_action( 'wp_head', 				'add_specific_styles' );
		add_action( 'login_head', 			'register_login_styles' );

		// Scripts
		add_action( 'wp_enqueue_scripts', 	'deregister_scripts' );
		add_action( 'wp_enqueue_scripts', 	'register_scripts' );
		add_action( 'wp_enqueue_scripts', 	'enqueue_scripts' );

		// Excerpt
		add_filter( 'excerpt_length', 		'excerpt_length' );
		add_filter( 'excerpt_more', 		'excerpt_more' );

		// Menu
		add_filter( 'wp_nav_menu_objects', 	'add_extra_menu_classes' );
		add_filter( 'nav_menu_css_class', 	'fix_menu_class', 10, 2 );
	}
	else
	{
		// Styles
		add_action( 'admin_init', 			'register_admin_styles' );
		add_action( 'admin_print_styles', 	'enqueue_admin_styles' );

		// Scripts
		add_action( 'admin_init', 			'register_admin_scripts' );
		add_action( 'admin_enqueue_scripts','enqueue_admin_scripts' );

		// Admin menu
		add_action( 'admin_menu', 			'remove_menu_pages' );

		// Dashboard widgets
		add_action( 'wp_dashboard_setup', 	'remove_dashboard_widgets' );
		add_action( 'wp_dashboard_setup', 	'add_dashboard_widgets' );

		// User
		add_filter( 'user_contactmethods', 	'edit_contactmethods' );

		// Misc
		add_filter( 'mce_buttons', 			'enable_more_buttons' );
	}

	// Widgets / Sidebars
	add_action( 'widgets_init',         'register_extra_sidebars' );
	add_filter(' widget_text', 			'do_shortcode' );

	// Menus
	add_action( 'init', 				'register_menus' );

	// Mail
	add_filter( 'wp_mail_from', 		'new_mail_from' );
	add_filter( 'wp_mail_from_name', 	'new_mail_from_name' );


/*==================================================*/
/* Headers, footers, body
/*==================================================*/

	function remove_wp_version()
	{
		return '';
	}

	// Post category name in body class
	function post_categories_body_class( $classes )
	{
		if( is_single() )
		{
			global $post;
			foreach( ( get_the_category( $post->ID ) ) as $category )
				$classes[] = 'term-' . $category->category_nicename;
		}

		return $classes;
	}

	// Favicon
	function add_favicon()
	{
		global $bramble;

		echo '<link rel="shortcut icon" href="' . $bramble['theme_uri'] . '/images/favicon.png" type="image/x-icon">';
	}


/*==================================================*/
/* Styles
/*==================================================*/

	// Register styles
	function register_styles()
	{
		global $bramble;

		wp_register_style( 'bramble', $bramble['theme_uri'] . '/style.css', '', $bramble['theme_ver'], 'screen' );
	}

	// Deregister styles
	function deregister_styles()
	{
		// wp_deregister_style();
	}

	// Enqueue styles
	function enqueue_styles()
	{
		wp_enqueue_style( 'bramble' );
	}

	// Login screen styles
	function register_login_styles()
	{
		global $bramble;

		echo '<link rel="stylesheet" type="text/css" href="' . $bramble['theme_uri'] . '/includes/admin/login.css">';
	}

	// Register admin styles
	function register_admin_styles()
	{
		global $bramble;

		wp_register_style( 'admin-style', $bramble['theme_uri'] . '/includes/admin/admin.css', '', $bramble['theme_ver'], 'screen' );
	}

	// Enqueue / Print admin styles
	function enqueue_admin_styles()
	{
		wp_enqueue_style( 'admin-style' );
	}

	// Add specific styles
	function add_specific_styles()
	{
		global $bramble;

		echo '<!--[if lt IE9]><link rel="stylesheet" id="ie-css" href="' . $bramble['theme_uri'] . '/includes/extras/ie.css" type="text/css" media="screen"><![endif]-->';
	}


/*==================================================*/
/* Scripts
/*==================================================*/

	// Deregister scripts
	function deregister_scripts()
	{
		// wp_deregister_script( '' );
	}

	// Register scripts
	function register_scripts()
	{
		global $bramble;

		wp_register_script( 'bramble', $bramble['theme_uri'] . '/javascripts/theme.js', array( 'jquery' ), $bramble['theme_ver'], true );
	}

	// Enqueue scripts
	function enqueue_scripts()
	{
		wp_enqueue_script( 'bramble' );

		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

		localize_scripts();
	}

	function register_admin_scripts()
	{
		global $bramble;

		wp_register_script( 'admin', $bramble['theme_uri'] . '/javascripts/admin.js' );
	}

	function enqueue_admin_scripts()
	{
		wp_enqueue_script( 'admin' );
	}

	// Localise scripts
	function localize_scripts()
	{
		global $bramble;

		wp_localize_script( 'functions', 'Bramble', array(
			'theme_uri'			=> $bramble['theme_uri'],
			'home_url'			=> get_home_url(),
			'ajax_url'			=> admin_url( 'admin-ajax.php' )
		) );
	}


/*==================================================*/
/*  Menu
/*==================================================*/

	// Register menus
	function register_menus()
	{
		register_nav_menus(
			array(
				'main-menu'		=> __( 'Main Menu', 'bramble' ),
				'top-menu'		=> __( 'Top Menu', 'bramble' ),
				'footer-menu'	=> __( 'Footer Menu', 'bramble' )
			)
		);
	}

	// Add extra (first, last) classes to menu items
	function add_extra_menu_classes( $objects )
	{
		$objects[1]->classes[] = 'first';
		$objects[count( $objects )]->classes[] = 'last';

		return $objects;
	}

	// Fix menu, so the page_for_posts page won't highlight on post type archive
	function fix_menu_class( $classes = array(), $item = false )
	{
		$post_types = get_post_types( array( '_builtin' => false ) );
		$home 		= get_option( 'page_for_posts' );

		if ( is_singular( $post_types ) || is_post_type_archive( $post_types ) || is_author() || is_404() )
		{
			if( $home == $item->object_id )
			{
				if( in_array( 'current_page_parent', $classes ) )
					unset( $classes[array_search( 'current_page_parent', $classes )] );
			}

			if( is_singular() )
			{
				global $post;
				$post_type = get_post_type( $post->ID );

				if( in_array( 'archive_' . $post_type, $classes ) )
				{
					$classes[] = 'current_page_parent';
				}
			}
		}

		return $classes;
	}

/*==================================================*/
/* Excerpt
/*==================================================*/

	function excerpt_length( $length )
	{
		return 55;
	}

	function excerpt_more( $more )
	{
		return ' [...]';
	}

/*==================================================*/
/* Sidebars, widgets
/*==================================================*/

	// Register sidebars
	function register_extra_sidebars()
	{
			register_sidebar( array(
					'name'			=> 'Sidebar',
					'id'			=> 'sidebar',
					'description'	=> __( 'Main Sidebar', 'bramble' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'	=> '</section>',
					'before_title'	=> '<h3 class="widget-title">',
					'after_title'	=> '</h3>',
				)
			);
	}

/*==================================================*/
/* Admin
/*==================================================*/

	// Remove unnecessary pages
	function remove_menu_pages()
	{
		remove_menu_page( 'link-manager.php' );
	}

	// Add new dasboard widgets
	function add_dashboard_widgets()
	{
		// wp_add_dashboard_widget( 'dashboard_widget', 'Dashboard Widget', 'dashboard_widget' );
	}

	// Remove dashboard widgets
	function remove_dashboard_widgets()
	{
		global $wp_meta_boxes;

		// Core
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
		// unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] );
		// unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	}


/*==================================================*/
/* User
/*==================================================*/

	// Remove unneccesary contactmethods
	function edit_contactmethods( $methods )
	{
		unset( $methods['aim'] );
		unset( $methods['jabber'] );
		unset( $methods['yim'] );

		return $methods;
	}

/*==================================================*/
/* Mail
/*==================================================*/

	function new_mail_from( $email )
	{
		$email = get_bloginfo( 'admin_email' );

		return $email;
	}

	function new_mail_from_name( $name ) {
		$name = get_bloginfo( 'name' );

		return $name;
	}

/*==================================================*/
/* Misc
/*==================================================*/

	function enable_more_buttons( $buttons )
	{
		$buttons[] = 'hr';

		return $buttons;
	}

/*==================================================*/
/* Pagination
/*==================================================*/

	// Pagination helper function
	function pagination( $pages = '', $range = 2 )
	{
		 $showitems = ( $range * 2 ) + 1;

		 global $paged;
		 if( empty( $paged ) ) $paged = 1;

		 if( $pages == '' )
		 {
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if( ! $pages )
			 {
				 $pages = 1;
			 }
		 }

		 if( 1 != $pages )
		 {
			 echo '<div class="pagination">';
			 if( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) echo '<a href="' . get_pagenum_link( 1 ) . '">&laquo;</a>';
			 if( $paged > 1 && $showitems < $pages) echo '<a href="' . get_pagenum_link( $paged - 1 ) . '">&lsaquo;</a>';

			 for ( $i = 1; $i <= $pages; $i++ )
			 {
				 if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ))
				 {
					 echo ( $paged == $i ) ? '<span class="current">' . $i . '</span>'
						: '<a href="' . get_pagenum_link( $i ) . '" class="inactive" >' . $i . '</a>';
				 }
			 }

			 if ( $paged < $pages && $showitems < $pages) echo '<a href="' . get_pagenum_link( $paged + 1 ) . '">&rsaquo;</a>';
			 if ( $paged < $pages - 1 && $paged+$range - 1 < $pages && $showitems < $pages )
				echo '<a href="' . get_pagenum_link($pages) . '">&raquo;</a>';
			 echo '</div>';
		 }
	}

	function register_extra_slider_theme( $themes ) {
		global $bramble;

		$themes['full_image'] = array(
			'id'	=> 'full_image_slider',
			'label' => __( 'Full Image', 'bramble' ),
			'image' => $bramble['theme_uri'] . '/images/theme-options/default-slider.png',
		);

		return $themes;
	}

	add_filter( 'bramble_customizer_register_slider_theme', 'register_extra_slider_theme' );