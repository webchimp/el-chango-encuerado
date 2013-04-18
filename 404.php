<?php
/**
 * The template for displaying 404 pages (Not Found)
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
	<h2 class="titulo">Page not found</h2>
</section>

<?php
	//Sticky Footer
	//get_template_parts(array('parts/stickyfooter/footer', 'parts/shared/footer','parts/shared/html-footer'));
?>
<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>