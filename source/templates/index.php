<?php get_header(); ?>


	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<h1><?php the_title(); ?></h1>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>

	</article>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>