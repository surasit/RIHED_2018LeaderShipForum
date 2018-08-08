<?php
/**
 * The default Custom post type for Staff
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php

if (!function_exists('wpl_staff_cpt')) {
	function wpl_staff_cpt(){
		
		$url_rewrite = ot_get_option('wpl_staff_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff'; }

		$url_rewrite_name = ot_get_option('wpl_staff_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Staff', 'event-wpl' ); }

		register_post_type('post_staff',
			array(
				'labels' => array(
					'name' => __( 'Staff', 'event-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Candidate', 'event-wpl' ),
					'add_new_item' => __( 'Add New Candidate', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Candidate', 'event-wpl' ),
					'new_item' => __( 'New Candidate', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Candidate', 'event-wpl' ),
					'search_items' => __( 'Search for Candidates', 'event-wpl' ),
					'not_found' => __( 'No Candidates found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Candidates found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Candidate', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Staff.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-nametag',
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			)
		);
	}
	add_action('init', 'wpl_staff_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Staff
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_staff_category')) {
	function wpl_staff_category() {

		$url_rewrite = ot_get_option('wpl_staff_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff-items'; }

		register_taxonomy('wpl_staff_category', 'post_staff', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Staff Departaments', 'event-wpl' ),
					  'singular_name' => __( 'Department', 'event-wpl' ),
					  'search_items' =>  __( 'Search in Department', 'event-wpl' ),
					  'popular_items' => __( 'Popular Departments', 'event-wpl' ),
					  'all_items' => __( 'All Departments', 'event-wpl' ),
					  'parent_item' => __( 'Parent Department', 'event-wpl' ),
					  'parent_item_colon' => __( 'Parent Department:', 'event-wpl' ),
					  'edit_item' => __( 'Edit Department', 'event-wpl' ),
					  'update_item' => __( 'Update Department', 'event-wpl' ),
					  'add_new_item' => __( 'Add New Department', 'event-wpl' ),
					  'new_item_name' => __( 'New Department Name', 'event-wpl' )
				),
				'show_ui' => true,
				'query_var' => true, 
				'rewrite' => array('slug' => $url_rewrite)
			) 
		);
	}
	add_action('init', 'wpl_staff_category');
}
