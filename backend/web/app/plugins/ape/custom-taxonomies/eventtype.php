<?php

/**
 * Registers the `eventtype` taxonomy,
 * for use with 'event'.
 */
function eventtype_init() {
	register_taxonomy( 'eventtype', [ 'event' ], [
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
			'name'                       => __( 'Eventtypes', 'ape' ),
			'singular_name'              => _x( 'Eventtype', 'taxonomy general name', 'ape' ),
			'search_items'               => __( 'Search Eventtypes', 'ape' ),
			'popular_items'              => __( 'Popular Eventtypes', 'ape' ),
			'all_items'                  => __( 'All Eventtypes', 'ape' ),
			'parent_item'                => __( 'Parent Eventtype', 'ape' ),
			'parent_item_colon'          => __( 'Parent Eventtype:', 'ape' ),
			'edit_item'                  => __( 'Edit Eventtype', 'ape' ),
			'update_item'                => __( 'Update Eventtype', 'ape' ),
			'view_item'                  => __( 'View Eventtype', 'ape' ),
			'add_new_item'               => __( 'Add New Eventtype', 'ape' ),
			'new_item_name'              => __( 'New Eventtype', 'ape' ),
			'separate_items_with_commas' => __( 'Separate eventtypes with commas', 'ape' ),
			'add_or_remove_items'        => __( 'Add or remove eventtypes', 'ape' ),
			'choose_from_most_used'      => __( 'Choose from the most used eventtypes', 'ape' ),
			'not_found'                  => __( 'No eventtypes found.', 'ape' ),
			'no_terms'                   => __( 'No eventtypes', 'ape' ),
			'menu_name'                  => __( 'Eventtypes', 'ape' ),
			'items_list_navigation'      => __( 'Eventtypes list navigation', 'ape' ),
			'items_list'                 => __( 'Eventtypes list', 'ape' ),
			'most_used'                  => _x( 'Most Used', 'eventtype', 'ape' ),
			'back_to_items'              => __( '&larr; Back to Eventtypes', 'ape' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'eventtype',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'eventtype_init' );

/**
 * Sets the post updated messages for the `eventtype` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `eventtype` taxonomy.
 */
function eventtype_updated_messages( $messages ) {

	$messages['eventtype'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Eventtype added.', 'ape' ),
		2 => __( 'Eventtype deleted.', 'ape' ),
		3 => __( 'Eventtype updated.', 'ape' ),
		4 => __( 'Eventtype not added.', 'ape' ),
		5 => __( 'Eventtype not updated.', 'ape' ),
		6 => __( 'Eventtypes deleted.', 'ape' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'eventtype_updated_messages' );
