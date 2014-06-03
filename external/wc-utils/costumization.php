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

	if(!current_user_can('edit_posts')){ add_filter('show_admin_bar', '__return_false'); }

	/* =============================================================================================
	Remove link rel='prev' and link rel='next'
	============================================================================================= */

	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	/* =============================================================================================
	Worpdress Login Style
	============================================================================================= */

	function wc_login_stylesheet(){ ?>
		<link rel="stylesheet" id="wc_wp_admin_css"  href="<?php echo get_bloginfo('stylesheet_directory') . '/login.css'; ?>" type="text/css" media="all">
	<?php }

	add_action('login_enqueue_scripts', 'wc_login_stylesheet');

	/* =============================================================================================
	Hiding super admin (ID 1) user
	============================================================================================= */
	function wc_pre_user_query($user_search) {

		$user = wp_get_current_user();
		if ($user->ID!=1) {

			global $wpdb;
			$user_search->query_where = str_replace('WHERE 1=1', "WHERE 1=1 AND {$wpdb->users}.ID <> 1", $user_search->query_where);
		}
	}

	add_action('pre_user_query','wc_pre_user_query');

	/* =============================================================================================
	Hiding sections in the administator
	============================================================================================= */

	function wc_remove_menus(){

		global $menu;

		$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));

		if(!current_user_can('edit_posts')) {
			$restricted = array(__('Media'), __('Links'), __('Appearance'), __('Tools'), __('Settings'), __('Comments'), __('Plugins'));
		}

		$restricted = array();

		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != null? $value[0]: "", $restricted)){ unset($menu[key($menu)]); }
		}
	}

	add_action('admin_menu', 'wc_remove_menus');

	/* =============================================================================================
	File upload special chars sanitization
	============================================================================================= */

	function wc_upload_sanitize_accents($filename){

		return remove_accents($filename);
	}

	add_filter('sanitize_file_name', 'wc_upload_sanitize_accents', 10);

	/* =============================================================================================
	Body Class per Browser
	============================================================================================= */

	function wc_browser_body_class($classes){

		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		if($is_lynx)		$classes[] = 'lynx';
		elseif($is_gecko)	$classes[] = 'gecko';
		elseif($is_opera)	$classes[] = 'opera';
		elseif($is_NS4)		$classes[] = 'ns4';
		elseif($is_safari)	$classes[] = 'safari';
		elseif($is_chrome)	$classes[] = 'chrome';
		elseif($is_IE){
			$classes[] = 'ie';
			if(preg_match('/MSIE ( [0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
				$classes[] = 'ie' . $browser_version[1];
		} else $classes[] = 'unknown';

		if($is_iphone) $classes[] = 'iphone';

		return $classes;
	}

	add_filter('body_class', 'wc_browser_body_class');

	/* =============================================================================================
	WP URLs
	============================================================================================= */

	function wc_ajaxurl() {
		?>
		<script type="text/javascript">
			var ajaxurl =	"<?php echo admin_url('admin-ajax.php'); ?>";
			var wpurl =		"<?php bloginfo('template_directory'); ?>";
		</script>
		<?php
	}

	add_action('wp_head', 'wc_ajaxurl');
