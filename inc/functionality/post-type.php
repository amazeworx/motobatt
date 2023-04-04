<?php
/**
 * Custom Product Type
 * CPT for Motobatt Products
**/
// Register Product a Products Custom Product Type
add_action( 'init', 'register_cpt_products' );
function register_cpt_products() {

    $labels = array(
        'name' => _x( 'Products', 'motobatt' ),
        'singular_name' => _x( 'Products', 'motobatt' ),
        'add_new' => _x( 'Add New', 'motobatt' ),
        'add_new_item' => _x( 'Add New Product', 'motobatt' ),
        'edit_item' => _x( 'Edit Product', 'motobatt' ),
        'new_item' => _x( 'New Product', 'motobatt' ),
        'view_item' => _x( 'View Product', 'motobatt' ),
        'search_items' => _x( 'Search Products', 'motobatt' ),
        'not_found' => _x( 'No Products found', 'motobatt' ),
        'not_found_in_trash' => _x( 'No Products found in Trash', 'motobatt' ),
        'parent_item_colon' => _x( 'Parent Products:', 'motobatt' ),
        'menu_name' => _x( 'Products', 'motobatt' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => '',
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'genesis-cpt-archives-settings'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-feedback',
        'menu_position' => '5',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'products' ),
        'capability_type' => 'post'
    );

    register_post_type( 'motobatt_products', $args );

}

// Register Product Categories Taxonomy
add_action( 'init', 'product_categories', 0 );
function product_categories() {

    $labels = array(
        'name'                       => _x( 'Product Categories', 'Taxonomy General Name', 'motobatt' ),
        'singular_name'              => _x( 'Product Categories', 'Taxonomy Singular Name', 'motobatt' ),
        'menu_name'                  => __( 'Product Categories', 'motobatt' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'product_categories', array( 'motobatt_products' ), $args );

}

// Register Battery Applications Taxonomy
add_action( 'init', 'battery_applications', 0 );
function battery_applications() {

	$labels = array(
		'name'                       => _x( 'Battery Applications', 'Taxonomy General Name', 'motobatt' ),
		'singular_name'              => _x( 'Battery Applications', 'Taxonomy Singular Name', 'motobatt' ),
		'menu_name'                  => __( 'Battery Applications', 'motobatt' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'battery_applications', array( 'motobatt_products' ), $args );

}