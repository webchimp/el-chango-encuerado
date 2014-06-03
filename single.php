<?php
/**
 * The Template for displaying all single posts
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

<?php get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<section>
	<?php if(have_posts()) while(have_posts()): the_post(); ?>

		<article>
			<h2><?php the_title(); ?></h2>
			<div class="the-content">
				<?php the_content(); ?>
			</div>
		</article>

	<?php endwhile; ?>
</section>

<?php get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>