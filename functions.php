<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* =============================================================================================
	Required external files
	============================================================================================= */

	require_once('external/starkers-utilities.php');
	require_once('external/webchimp-utilities.php');

	/* =============================================================================================
	Actions and Filters
	============================================================================================= */

	add_action('wp_enqueue_scripts', 'script_enqueuer');
	add_filter('body_class', 'add_slug_to_body_class');

	/* =============================================================================================
	Custom Post Types - include custom post types and taxonimies here e.g.
	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	============================================================================================= */

	//require_once('custom-post-types/nombre.php');

	/* =============================================================================================
	Scripts
	============================================================================================= */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function script_enqueuer(){

		//JS
		if(in_pages(array('contacto', 'contact'))):
			wp_register_script('google.maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false');
			wp_enqueue_script('google.maps');
		endif;

		wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js');
		wp_enqueue_script('modernizr');

		wp_register_script('html5shiv', '//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js');
		wp_enqueue_script('html5shiv');

		wp_register_script('jquery.cycle.all.min', '//cdnjs.cloudflare.com/ajax/libs/jquery.cycle/3.03/jquery.cycle.all.min.js', array('jquery'));
		wp_enqueue_script('jquery.cycle.all.min');

		//wp_register_script('jquery.cyclewrap', get_template_directory_uri() . '/js/jquery.cyclewrap.min.js', array('jquery.cycle.all.min'));
		//wp_enqueue_script('jquery.cyclewrap');

		wp_register_script('jquery.magnific-popup.min', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js', array('jquery'));
		wp_enqueue_script('jquery.magnific-popup.min');

		//wp_register_script('jquery.slimscroll.min', '//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js', array('jquery'));
		//wp_enqueue_script('jquery.slimscroll.min');

		wp_register_script('jquery.validator2', get_template_directory_uri() . '/js/jquery.validator2.js', array('jquery'));
		wp_enqueue_script('jquery.validator2');

		wp_register_script('site', get_template_directory_uri() . '/js/site.js', array('jquery', 'jquery-form', 'jquery-color'));
		wp_enqueue_script('site');

		//CSS
		wp_register_style('screen', get_template_directory_uri() . '/style.css', '', '', 'screen');
		wp_enqueue_style('screen');

		wp_register_style('magnific-popup', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/magnific-popup.css', '', '', 'screen');
		wp_enqueue_style('magnific-popup');

		wp_register_style('site', get_template_directory_uri() . '/site.css', '', '', 'screen');
		wp_enqueue_style('site');
	}

	/* =============================================================================================
	Comments
	============================================================================================= */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif; ?>
		</li>
		<?php
	}