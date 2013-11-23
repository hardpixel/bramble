<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<title><?php echo wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="document-header" role="banner">
		<div class="header-inner">
			<?php echo 'Header'; ?>
		</div>
	</header>

	<main role="main">
		<section id="content">