<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section>
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h2 class="titulo"><?php the_title(); ?></h2>
		<div class="the-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
	
</section>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>