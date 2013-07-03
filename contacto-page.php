<?php
/**
 * Template Name: Contacto
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

<?php get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<section>
	<?php if(have_posts()) while(have_posts()): the_post(); ?>
	<h2 class="titulo"><?php the_title(); ?></h2>
	
	<div id="mapa">
	</div>
	
	<form id="forma-contacto" name="forma-contacto" method="post" action="">
		
		<?php wp_nonce_field('formulario_contacto','nonce'); ?>
		
		<p class="nombre">
			<label for="contacto-nombre">Nombre</label>
			<input type="text" name="nombre" id="contacto-nombre" />
		</p>
		<p class="email">
			<label for="contacto-email">Email</label>
			<input type="text" name="mail" id="contacto-email" />
		</p>
		<p class="telefono">
			<label for="contacto-telefono">Tel&eacute;fono</label>
			<input type="text" name="telefono" id="contacto-telefono" />
		</p>
		<p class="comentarios">
			<label for="contacto-comentarios">Comentarios</label>
			<textarea name="comentarios" id="contacto-comentarios"></textarea>
		</p>
		<p class="submit"><input type="submit" value="Enviar" /></p>
	</form>
	
	<div class="datos">
		<?php the_content(); ?>
	</div>
	
	<?php endwhile; ?>
</section>

<?php get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>