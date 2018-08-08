<?php
/**
 * The default Custom post type for Sponsors
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php

if (!function_exists('wpl_sponsors_cpt')) {
	function wpl_sponsors_cpt(){
		
		$url_rewrite = ot_get_option('wpl_sponsors_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sponsor'; }

		$url_rewrite_name = ot_get_option('wpl_sponsors_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Sponsors', 'event-wpl' ); }

		register_post_type('post_sponsor',
			array(
				'labels' => array(
					'name' => __( 'Sponsors', 'event-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Sponsor', 'event-wpl' ),
					'add_new_item' => __( 'Add New Sponsor', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Sponsor', 'event-wpl' ),
					'new_item' => __( 'New Sponsor', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Sponsor', 'event-wpl' ),
					'search_items' => __( 'Search Sponsors', 'event-wpl' ),
					'not_found' => __( 'No Sponsors found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Sponsors found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Sponsor', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Sponsors.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-groups',
				'supports' => array('title','editor'),
			)
		);
	}
	add_action('init', 'wpl_sponsors_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Sponsors
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_sponsors_category')) {
	function wpl_sponsors_category() {

		$url_rewrite = ot_get_option('wpl_sponsors_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sponsor-category'; }

		register_taxonomy('wpl_sponsors_category', 'post_sponsor', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Sponsor Categories', 'event-wpl' ),
					  'singular_name' => __( 'Category', 'event-wpl' ),
					  'search_items' =>  __( 'Search in Category', 'event-wpl' ),
					  'popular_items' => __( 'Popular Categories', 'event-wpl' ),
					  'all_items' => __( 'All Categories', 'event-wpl' ),
					  'parent_item' => __( 'Parent Category', 'event-wpl' ),
					  'parent_item_colon' => __( 'Parent Category:', 'event-wpl' ),
					  'edit_item' => __( 'Edit Category', 'event-wpl' ),
					  'update_item' => __( 'Update Category', 'event-wpl' ),
					  'add_new_item' => __( 'Add New Category', 'event-wpl' ),
					  'new_item_name' => __( 'New Category Name', 'event-wpl' )
				),
				'show_ui' => true,
				'query_var' => true, 
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_sponsors_category');
}
