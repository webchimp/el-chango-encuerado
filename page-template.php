<?php
/**
 * Template Name: Page Template
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php
	//Sticky Footer
	//get_template_parts(array('parts/shared/html-header', 'parts/stickyfooter/header', 'parts/shared/header'));
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

<?php
	//Sticky Footer
	//get_template_parts(array('parts/stickyfooter/footer', 'parts/shared/footer','parts/shared/html-footer'));
?>
<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>