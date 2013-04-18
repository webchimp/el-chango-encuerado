
<?php if(STICKY_FOOTER): ?>
	<div id="wrapper">
<?php endif; ?>
	
	<header>
		<h1 class="logo"><a href="<?php echo site_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php wp_nav_menu( array('container' => 'nav', 'container_class' => 'menu-header', 'theme_location' => 'primary')); ?>
		<?php //get_search_form(); ?>
	</header>
