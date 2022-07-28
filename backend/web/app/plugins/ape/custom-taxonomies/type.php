<?php

/**
 * Registers the `type` (term) taxonomy,
 * for use with 'event' (custom type)
 */

function type_init() {

	register_taxonomy( 'type', [ 'event' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],

		'labels'                => [
			'name'                       => __( 'Types', 'ape' ),
			'singular_name'              => _x( 'Type', 'taxonomy general name', 'ape' ),
			'search_items'               => __( 'Search Types', 'ape' ),
			'popular_items'              => __( 'Popular Types', 'ape' ),
			'all_items'                  => __( 'All Types', 'ape' ),
			'parent_item'                => __( 'Parent Type', 'ape' ),
			'parent_item_colon'          => __( 'Parent Type:', 'ape' ),
			'edit_item'                  => __( 'Edit Type', 'ape' ),
			'update_item'                => __( 'Update Type', 'ape' ),
			'view_item'                  => __( 'View Type', 'ape' ),
			'add_new_item'               => __( 'Add New Type', 'ape' ),
			'new_item_name'              => __( 'New Type', 'ape' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'ape' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'ape' ),
			'choose_from_most_used'      => __( 'Choose from the most used types', 'ape' ),
			'not_found'                  => __( 'No types found.', 'ape' ),
			'no_terms'                   => __( 'No types', 'ape' ),
			'menu_name'                  => __( 'Types', 'ape' ),
			'items_list_navigation'      => __( 'Types list navigation', 'ape' ),
			'items_list'                 => __( 'Types list', 'ape' ),
			'most_used'                  => _x( 'Most Used', 'type', 'ape' ),
			'back_to_items'              => __( '&larr; Back to Types', 'ape' ),
		],

		'show_in_rest'          => true,
		'rest_base'             => 'types',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'type_init' );


