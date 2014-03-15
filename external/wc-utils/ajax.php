<?php

	//Formulario de contacto -----------------------------------------------------------------------
	add_action('wp_ajax_test_action', 'wc_test_action');
	add_action('wp_ajax_nopriv_test_action', 'wc_test_action');
	function wc_test_action(){

		print_a($_REQUEST);
		die();
	}

?>