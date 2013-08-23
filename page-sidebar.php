<?php
/**
 * Template Name: Page con Sidebar
 *
 * @package 	WordPress
 * @subpackage 	El Chango Encuerado
 * @since 		El Chango Encuerado 2.0
 */
?>

<?php get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<section>
	
	<div class="contenido con-sidebar">
		<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<h2 class="titulo"><?php the_title(); ?></h2>
			<div class="the-content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
	
	<aside>
		<?php get_sidebar(); ?>
	</aside>
	
</section>

<?php get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>