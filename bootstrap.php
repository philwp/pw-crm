<?php

use \pw\crm\start;
/**
 * Register Autoloader
 */
spl_autoload_register( function ( $class ) {
	$prefix = 'pw\\crm\\';
	$base_dir = __DIR__ . '/classes/';
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return;
	}
	$relative_class = substr( $class, $len );
	$file = $base_dir . str_replace('\\', '/', $relative_class ) . '.php';
	if ( file_exists( $file ) ) {
		require $file;
	}

});


/**
 * Go!
 */
add_action( 'init', 'pw_crm_register_cpt', 0 );
add_action( 'init', 'pw_crm_load_cmb2', 2 );
add_action( 'init', function() {
	new Start();
}, 1 );

/**
 * Add Customer
 */

// Register Custom Post Type
function pw_crm_register_cpt() {

	$labels = [
		'name'                  => _x( 'Customers', 'Post Type General Name', 'pw-crm' ),
		'singular_name'         => _x( 'Customer', 'Post Type Singular Name', 'pw-crm' ),
		'menu_name'             => __( 'Customers', 'pw-crm' ),
		'name_admin_bar'        => __( 'Customers', 'pw-crm' ),
		'archives'              => __( 'Customer Archives', 'pw-crm' ),
		'attributes'            => __( 'Customer Attributes', 'pw-crm' ),
		'parent_item_colon'     => __( 'Parent Customer:', 'pw-crm' ),
		'all_items'             => __( 'All Customers', 'pw-crm' ),
		'add_new_item'          => __( 'Add New Customer', 'pw-crm' ),
		'add_new'               => __( 'Add New', 'pw-crm' ),
		'new_item'              => __( 'New Customer', 'pw-crm' ),
		'edit_item'             => __( 'Edit Customer', 'pw-crm' ),
		'update_item'           => __( 'Update Customer', 'pw-crm' ),
		'view_item'             => __( 'View Customer', 'pw-crm' ),
		'view_items'            => __( 'View Customers', 'pw-crm' ),
		'search_items'          => __( 'Search Customer', 'pw-crm' ),
		'not_found'             => __( 'Not found', 'pw-crm' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'pw-crm' ),
		'featured_image'        => __( 'Featured Image', 'pw-crm' ),
		'set_featured_image'    => __( 'Set featured image', 'pw-crm' ),
		'remove_featured_image' => __( 'Remove featured image', 'pw-crm' ),
		'use_featured_image'    => __( 'Use as featured image', 'pw-crm' ),
		'insert_into_item'      => __( 'Insert into customer', 'pw-crm' ),
		'uploaded_to_this_item' => __( 'Uploaded to this customer', 'pw-crm' ),
		'items_list'            => __( 'Customers list', 'pw-crm' ),
		'items_list_navigation' => __( 'Customers list navigation', 'pw-crm' ),
		'filter_items_list'     => __( 'Filter customers list', 'pw-crm' ),
	];
	$args = [
		'label'                 => __( 'Customer', 'pw-crm' ),
		'description'           => __( 'Customer data', 'pw-crm' ),
		'labels'                => $labels,
		'supports'              => [ 'title' ],
		'taxonomies'            => [ 'category', 'post_tag' ],
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	];
	register_post_type( Start::POST_TYPE , $args );

}


/**
 * Load CMB2
 *
 * @since 0.0.1
 *
 * @uses init
 */
function pw_crm_load_cmb2() {
	include_once  __DIR__ . '/includes/CMB2/init.php';
}



