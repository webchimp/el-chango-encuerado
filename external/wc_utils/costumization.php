<?php

	/**
	 * WebChimp Utility - Costumization
	 *
	 * @package 	WordPress
	 * @subpackage 	El Chango Encuerado
	 * @since 		El Chango Encuerado 2.0
	 *
	 */
	
	/* =============================================================================================
	Theme Support
	============================================================================================= */
	
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	
	/* =============================================================================================
	Menus
	============================================================================================= */
	
	register_nav_menus(array('primary' => __( 'Primary Navigation', 'elchango' )));
	
	
	/* =============================================================================================
	Sticky Footer
	============================================================================================= */
	
	define('STICKY_FOOTER', true);

	/* =============================================================================================
	Custom Image Sizes
	============================================================================================= */
	
	//add_image_size('nombre', x, y, true);

	/* =============================================================================================
	Hide Admin Bar
	============================================================================================= */
	
	if(!current_user_can('edit_posts')) { add_filter('show_admin_bar', '__return_false'); }
	
	/* =============================================================================================
	Remove link rel='prev' and link rel='next'
	============================================================================================= */
	
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	
	/* =============================================================================================
	Worpdress Login Style
	============================================================================================= */
	
	function wc_login_stylesheet(){ ?>
		<link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css'; ?>" type="text/css" media="all" />
	<?php }
	
	add_action('login_enqueue_scripts', 'wc_login_stylesheet');

	/* =============================================================================================
	Hidding sections in the administator
	============================================================================================= */
	
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

	/* =============================================================================================
	File upload special chars sanitization
	============================================================================================= */
	
	function wc_sanitize_spanish_chars ($filename){

		$spanish_chars = array( '/á/', '/é/', '/í/', '/ó/', '/ú/', '/ü/', '/ñ/', '/Á/', '/É/', '/Í/', '/Ó/', '/Ú/', '/Ü/', '/Ñ/', '/º/', '/ª/' );
		$sanitized_chars = array('a', 'e', 'i', 'o', 'u', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'U', 'N', 'o', 'a');
		$friendly_filename = preg_replace($spanish_chars, $sanitized_chars, $filename);
		return $friendly_filename;
	}
	
	add_filter('sanitize_file_name', 'wc_sanitize_spanish_chars', 10);

	/* =============================================================================================
	Body Class per Browser
	============================================================================================= */
	
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

	/* =============================================================================================
	WP URLs
	============================================================================================= */
	add_action('wp_head','wc_ajaxurl');
	function wc_ajaxurl() {
		?>
		<script type="text/javascript">
			var ajaxurl =	"<?php echo admin_url('admin-ajax.php'); ?>";
			var wpurl =		"<?php bloginfo('template_directory'); ?>";
			var cssurl =	"<?php bloginfo('stylesheet_url'); ?>";
		</script>
		<?php
	}

	/* =============================================================================================
	Hide widgets from WP Dashboard
	============================================================================================= */
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
	