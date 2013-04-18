<?php
/**
 * Search results page
 * 
 * Please see /external/starkers-utilities.php for info on get_template_parts()
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
	<?php if ( have_posts() ): ?>
		<h2 class="titulo">Search Results for '<?php echo get_search_query(); ?>'</h2>	
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<time datetime="<?php the_time( 'Y-m-D' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	<?php else: ?>
		<h2>No results found for '<?php echo get_search_query(); ?>'</h2>
	<?php endif; ?>
</section>

<?php
	//Sticky Footer
	//get_template_parts(array('parts/stickyfooter/footer', 'parts/shared/footer','parts/shared/html-footer'));
?>
<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>