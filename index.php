<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

<?php get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<section>
</section>

<?php get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>