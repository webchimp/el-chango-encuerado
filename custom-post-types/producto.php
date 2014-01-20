<?php
	
	/* =============================================================================================
	Add Custom Post Type
	============================================================================================= */
	
	/**
	 * Registers the custom post type to Wordpress
	 *
	 * @return void
	 * @author Rodrigo Tejero
	 */
	
	add_action( 'init', 'register_cpt_producto' );
	
	function register_cpt_producto() {
		
		$labels = array( 
			'name' => _x( 'Productos', 'producto' ),
			'singular_name' => _x( 'Producto', 'producto' ),
			'add_new' => _x( 'Agregar nuevo', 'producto' ),
			'add_new_item' => _x( 'Agregar Nuevo Producto', 'producto' ),
			'edit_item' => _x( 'Editar Producto', 'producto' ),
			'new_item' => _x( 'Nuevo Producto', 'producto' ),
			'view_item' => _x( 'Ver Producto', 'producto' ),
			'search_items' => _x( 'Buscar Productos', 'producto' ),
			'not_found' => _x( 'Productos no econtrados', 'producto' ),
			'not_found_in_trash' => _x( 'No se encontraron productos en la papelera', 'producto' ),
			'parent_item_colon' => _x( 'Producto Padre:', 'producto' ),
			'menu_name' => _x( 'Productos', 'producto' ),
		);
		
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Productos de la tienda',
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'taxonomies' => array( 'category', 'post_tag' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post'
		);
		
		register_post_type( 'producto', $args );
	}
?>