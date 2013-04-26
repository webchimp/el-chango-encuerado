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
	//define('WP_POST_REVISIONS', false);
	
	//Habilitamos el debug
	//define('WP_DEBUG', true);
	
	//Supports -------------------------------------------------------------------------------------
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	register_nav_menus(array('primary' => __( 'Primary Navigation', 'twentyten' )));
	
	/*	   ______           __                  _             __  _           
		  / ____/_  _______/ /_____  ____ ___  (_)___  ____ _/ /_(_)___  ____ 
		 / /   / / / / ___/ __/ __ \/ __ `__ \/ /_  / / __ `/ __/ / __ \/ __ \
		/ /___/ /_/ (__  ) /_/ /_/ / / / / / / / / /_/ /_/ / /_/ / /_/ / / / /
		\____/\__,_/____/\__/\____/_/ /_/ /_/_/ /___/\__,_/\__/_/\____/_/ /_/ 
		                                                                      */
	
	define('STICKY_FOOTER', true);
	
	//Image sizes para el sitio --------------------------------------------------------------------
	//add_image_size('nombre', x, y, true);
	
	//Ocultamos barra de administrador para usuarios no administradores ----------------------------
	if(!current_user_can('edit_posts')) { add_filter('show_admin_bar', '__return_false'); }
	
	//Estilo para el login del admin ---------------------------------------------------------------
	function wc_login_stylesheet(){ ?>
		<link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css'; ?>" type="text/css" media="all" />
	<?php }
	add_action('login_enqueue_scripts', 'wc_login_stylesheet');
	
	//Ocultar secciones en el administrador --------------------------------------------------------
	function wc_remove_menus(){
		global $menu;
		
		$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
		
		$restricted = array();
		
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL? $value[0]: "", $restricted)){ unset($menu[key($menu)]); }
		}
	}
	add_action('admin_menu', 'wc_remove_menus');
	
	//Sanitizamos subidas de archivos --------------------------------------------------------------
	function wc_sanitize_spanish_chars ($filename){
		
		$spanish_chars = array( '/á/', '/é/', '/í/', '/ó/', '/ú/', '/ü/', '/ñ/', '/Á/', '/É/', '/Í/', '/Ó/', '/Ú/', '/Ü/', '/Ñ/', '/º/', '/ª/' );
		$sanitized_chars = array('a', 'e', 'i', 'o', 'u', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'U', 'N', 'o', 'a');
		$friendly_filename = preg_replace($spanish_chars, $sanitized_chars, $filename);
		return $friendly_filename;
	}
	add_filter('sanitize_file_name', 'wc_sanitize_spanish_chars', 10);
	
	//Body class por browser -----------------------------------------------------------------------
	function wc_browser_body_class($classes){
		
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		if( $is_lynx ) $classes[] = 'lynx';
		elseif( $is_gecko ) $classes[] = 'gecko';
		elseif( $is_opera ) $classes[] = 'opera';
		elseif( $is_NS4 ) $classes[] = 'ns4';
		elseif( $is_safari ) $classes[] = 'safari';
		elseif( $is_chrome ) $classes[] = 'chrome';
		elseif( $is_IE ){
			$classes[] = 'ie';
			if( preg_match('/MSIE ( [0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) )
				$classes[] = 'ie' . $browser_version[1];
		} else $classes[] = 'unknown';
		if( $is_iphone ) $classes[] = 'iphone';
		return $classes;
	}
	add_filter( 'body_class','wc_browser_body_class' );
	
	//WP Ajax URL ----------------------------------------------------------------------------------
	add_action('wp_head','wc_ajaxurl');
	function wc_ajaxurl() {
		?>
		<script type="text/javascript">
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		</script>
		<?php
	}
	
	//Ocultamos todos los widgets del dashboard de WordPress ---------------------------------------
	function wc_remove_dashboard_widgets() {
		global $wp_meta_boxes;
		
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	}
	
	add_action('wp_dashboard_setup', 'wc_remove_dashboard_widgets' );
	
	/*	    ______                 __  _                      
		   / ____/_  ______  _____/ /_(_)___  ____  ___  _____
		  / /_  / / / / __ \/ ___/ __/ / __ \/ __ \/ _ \/ ___/
		 / __/ / /_/ / / / / /__/ /_/ / /_/ / / / /  __(__  ) 
		/_/    \__,_/_/ /_/\___/\__/_/\____/_/ /_/\___/____/  
		                                                      */
	
	//Obtener id por slug --------------------------------------------------------------------------
	function get_ID_by_slug($page_slug){
		
		$page = get_page_by_path($page_slug);
		if($page):	return $page->ID;
		else:		return null;
		endif;
	}
	
	//Función in_pages() ---------------------------------------------------------------------------
	function in_pages($pages){
		
		if(is_string($pages)) return is_page($pages);
		foreach($pages as $page) if(is_page($page)) return true;
		return false;
	}
	
	//Body Class Genérico --------------------------------------------------------------------------
	function wc_body_class($slug){
		
		global $el_slug;
		$el_slug = $slug;
		
		add_filter('body_class', function($classes){ global $el_slug; $classes[] = $el_slug; return $classes; });
	}
	
	//Image Folder Src -----------------------------------------------------------------------------
	function img($echo = true){
		
		if($echo)	echo get_bloginfo('template_url') . '/images';
		else		return get_bloginfo('template_url') . '/images';
	}
	
	//Multiple sizes excerpt -----------------------------------------------------------------------
	function wc_excerpt($limit, $readmore = '...', $wrap = true) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).$readmore;
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $wrap? '<p>' . $excerpt . '</p>' : $excerpt;
	}
	
	function wc_content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
			array_pop($content);
			$content = implode(" ",$content).'...';
		} else {
			$content = implode(" ",$content);
		}
		$content = preg_replace('/\[.+\]/','', $content);
		$content = apply_filters('the_content', $content); 
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
	
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