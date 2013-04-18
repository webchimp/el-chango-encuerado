document.createElement('header');
document.createElement('hgroup');
document.createElement('nav');
document.createElement('menu');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');

jQuery(document).ready(function($) {
	
	// Your JavaScript goes here
	
	
	//Contacto -------------------------------------------------------------------------------------
	var forma_contacto_options = {
		url:		ajaxurl,
		data:		{ action: 'formulario_contacto' },
		success:	function(responseText, statusText, xhr, $form){
						alert(responseText);
					}
	};
	
	$('#forma-contacto').ajaxForm(forma_contacto_options);
});

