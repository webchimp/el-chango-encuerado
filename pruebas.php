<?php
/**
 * Template Name: Pruebas
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */

	$registro = new ChimpRegistry();

	//Definimos los datos basicos del registro
	$registro->registry_form = 'forma-prueba'; //La forma en la que se va a insertar
	$registro->registry_name = 'Rodrigo Tejero';
	$registro->registry_email = 'rodrigo.tejero@thewebchi.mp';
	$registro->registry_comments = 'Hola, que bueno está el plugin de Wordpress de Contact, WOW!';

	$registro->addMeta('apaterno', 'de la Torre', 'Apellido Paterno');
	$registro->addMeta('amaterno', 'Tejero', 'Apellido Materno');

	print_a($registro);

	$registro->insert();
?>