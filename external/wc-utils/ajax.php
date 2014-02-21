<?php

	//Formulario de contacto -----------------------------------------------------------------------
	add_action('wp_ajax_formulario_contacto', 'wc_formulario_contacto');
	add_action('wp_ajax_nopriv_formulario_contacto', 'wc_formulario_contacto');
	function wc_formulario_contacto(){

		// Verificando si viene lleno el formulario.
		if(isset($_POST["mail"]) && wp_verify_nonce($_POST['nonce'], 'formulario_contacto')):

			$nombre =		$_POST['nombre'];
			$mail =			$_POST['mail'];
			$telefono =		$_POST['telefono'];
			$comentarios =	$_POST['comentarios'];

			//Enviamos Mail
			$message = "<h1>Nuevo Correo de Contacto</h1>
			<p><strong>Nombre:</strong> $nombre</p>
			<p><strong>Mail:</strong> $mail</p>
			<p><strong>Telefono:</strong> $telefono</p>
			<p><strong>Comentarios:</strong> $comentarios</p>";

			require_once(TEMPLATEPATH . '/libs/swift/swift_required.php');

			// Create the Transport
			$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587)
			->setUsername('rodrigo.tejero@thewebchi.mp')
			->setPassword('2723e0df-e759-49a7-970e-eb2de33bd9f2');

			$mailer = Swift_Mailer::newInstance($transport);

			$message = Swift_Message::newInstance('Correo contacto')
			->setFrom(array('rodrigo.tejero@thewebchi.mp' => 'Rodrigo Tejero'))
			->setTo(array('rodrigo.tejero@thewebchi.mp'))
			->setBody($message, 'text/html');

			$result = $mailer->send($message);
		endif;

		echo "Gracias";

		die();
	}

?>