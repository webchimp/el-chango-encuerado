<?php

	/**
	 * WebChimp Utility Functions v.1.0
	 *
	 * @package 	WordPress
	 * @subpackage 	El Chango Encuerado
	 * @since 		El Chango Encuerado 2.0
	 *
	 */
	//WP Config ------------------------------------------------------------------------------------
	//Deshabilitamos las revisiones
	define('WP_POST_REVISIONS', false);
	
	//Supports -------------------------------------------------------------------------------------
	add_theme_support('menus');
	register_nav_menus(array('primary' => __( 'Primary Navigation', 'twentyten' )));
	
	//Image sizes para el sitio --------------------------------------------------------------------
	//add_image_size('nombre', x, y, true);
	
	//Estilo para el login del admin ---------------------------------------------------------------
	function wc_login_stylesheet(){ ?>
	<link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css'; ?>" type="text/css" media="all" />
	<?php }
	add_action('login_enqueue_scripts', 'wc_login_stylesheet');
	
	//Ocultar secciones en el administrador --------------------------------------------------------
	function wc_remove_menus(){
		global $menu;
		
		//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
		
		$restricted = array();
		
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL? $value[0]: "", $restricted)){ unset($menu[key($menu)]); }
		}
	}
	add_action('admin_menu', 'wc_remove_menus');
	
	//Obtener id por slug --------------------------------------------------------------------------
	function get_ID_by_slug($page_slug){
		
		$page = get_page_by_path($page_slug);
		if($page):	return $page->ID;
		else:		return null;
		endif;
	}
	
	//Sanitizamos subidas de archivos --------------------------------------------------------------
	function wc_sanitize_spanish_chars ($filename){
		$spanish_chars = array( '/á/', '/é/', '/í/', '/ó/', '/ú/', '/ü/', '/ñ/', '/Á/', '/É/', '/Í/', '/Ó/', '/Ú/', '/Ü/', '/Ñ/', '/º/', '/ª/' );
		$sanitized_chars = array('a', 'e', 'i', 'o', 'u', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'U', 'N', 'o', 'a');
		$friendly_filename = preg_replace($spanish_chars, $sanitized_chars, $filename);
		return $friendly_filename;
	}
	add_filter('sanitize_file_name', 'wc_sanitize_spanish_chars', 10);