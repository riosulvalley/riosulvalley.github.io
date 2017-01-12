<?php

/* ----------------------------------------------------------------
   REGISTER CPT 'PORTFOLIO'
-----------------------------------------------------------------*/

add_action( 'init', 'mighty_register_cpt', 1 );

function mighty_register_cpt() {

	// Register Portfolio Custom Post Type

	register_post_type( 'portfolio', array (
		'label' => 'Portfolio',
		'description' => 'Showcase your work',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'menu_position' => 5,
		'hierarchical' => false,
		'rewrite' => array (
			'slug' => 'project',
			'with_front' => false
		),
		'query_var' => true,
		'has_archive' => true,
		'supports' => array (
			'title',
			'editor',
			'excerpt',
			'revisions',
			'page-attributes',
			'thumbnail',
			'custom-fields',
			'comments'
		),
		'exclude_from_search' => true,
		'labels' => array (
			'name' => 'Portfolio',
			'singular_name' => 'Project',
			'menu_name' => 'Portfolio',
			'add_new' => 'Add Project',
			'add_new_item' => 'Add New Project',
			'edit' => 'Edit',
			'edit_item' => 'Edit Project',
			'new_item' => 'New Project',
			'view' => 'View Project',
			'view_item' => 'View Project',
			'search_items' => 'Search Portfolio',
			'not_found' => 'No Projects Found',
			'not_found_in_trash' => 'No Projects Found in Trash',
			'parent' => 'Parent Project'
		)
	) );
	
}


/* ----------------------------------------------------------------
   REGISTER TAXONOMY TYPES
-----------------------------------------------------------------*/

function mighty_taxonomy_portfolio_type() {
	
	register_taxonomy( 'portfolio-type', 'portfolio', array (
			'hierarchical' => true, 
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array (
				'slug' => 'portfolio-type',
				'hierarchical' => true
			),
			'labels' => array (
		        'name' => 'Terms',
		        'singular_name' => 'Term',
		        'search_items' => 'Search Terms',
		        'popular_items' => 'Popular Terms',
		        'all_items' => 'All Terms',
		        'parent_item' => null,
		        'parent_item_colon' => null,
		        'edit_item' => 'Edit Term',
		        'update_item' => 'Update Term',
		        'add_new_item' => 'Add New Term',
		        'new_item_name' => 'New Term Name',
		        'separate_items_with_commas' => 'Separate terms with commas',
		        'add_or_remove_items' => 'Add or remove terms',
		        'choose_from_most_used' => 'Choose from the most used terms'
			)
		)
	); 
}

add_action( 'init', 'mighty_taxonomy_portfolio_type', 1 );


/* ----------------------------------------------------------------
   CORRECT PARENT CLASS FOR CPT PORTFOLIO
-----------------------------------------------------------------*/

function remove_parent_classes( $class ) {
	return ( $class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item' ) ? FALSE : TRUE;
}

function add_class_to_wp_nav_menu( $classes ) {
	switch ( get_post_type() ) {
		case 'portfolio':
			$classes = array_filter( $classes, "remove_parent_classes" );
			if ( in_array( 'portfolio', $classes ) ) {
				$classes[] = 'current_page_parent';
			}
		break;
	}
	return $classes;
}

add_filter( 'nav_menu_css_class', 'add_class_to_wp_nav_menu' );

