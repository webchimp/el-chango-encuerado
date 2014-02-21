<?php

	/**
	 * WebChimp Utility Functions v.1.0
	 *
	 * @package 	WordPress
	 * @subpackage 	El Chango Encuerado
	 * @since 		El Chango Encuerado 2.0
	 *
	 */
	
	require_once('wc-utils/costumization.php');
	require_once('wc-utils/ajax.php');
	
	//Supports -------------------------------------------------------------------------------------
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	register_nav_menus(array('primary' => __( 'Primary Navigation', 'elchango' )));

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
	$wc_slugs = array();

	function wc_body_class($slugs){
		global $wc_slugs;
		if (is_array($slugs)):
			$wc_slugs = array_merge($wc_slugs, $slugs);
		else:
			$wc_slugs[] = $slugs;
		endif;
		return $wc_slugs;
	}

	add_filter('body_class','wc_body_class');

	// add_filter('body_class', function($classes) {
	// 	global $wc_slugs;

	// 	if(is_array($wc_slugs)):
	// 		foreach($wc_slugs as $slug):
	// 			$classes[] = $slug;
	// 		endforeach;
	// 	else:
	// 		$classes[] = $wc_slugs;
	// 	endif;

	// 	return $classes;
	// });

	//Image Folder Src -----------------------------------------------------------------------------
	function img($path = '', $echo = true){

		if($echo)	echo get_bloginfo('template_url') . "/images/$path";
		else		return get_bloginfo('template_url') . "/images/$path";
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

	//Get current URL ------------------------------------------------------------------------------
	function wc_cur_page_url($echo = false) {
		
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		if ($echo) {
			echo $pageURL;
		}
		return $pageURL;
	}

	//Slugify string -------------------------------------------------------------------------------
	function wc_slugify($str, $echo = false, $replace = array(), $delimiter = '-') {
		
		setlocale(LC_ALL, 'en_US.UTF8');
		# Remove spaces
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}
		# Remove non-ascii characters
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		# Remove non alphanumeric characters and lowercase the result
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		# Remove other unwanted characters
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		if ($echo) {
			echo $clean;
		}
		return $clean;
	}