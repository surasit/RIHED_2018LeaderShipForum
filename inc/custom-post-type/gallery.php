<?php
/**
 * The default Custom post type for Galleries
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0.0
 */
?>
<?php

if (!function_exists('wpl_gallery_cpt')) {
	
	function wpl_gallery_cpt(){
		
		$url_rewrite = ot_get_option('wpl_gallery_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'gallery'; }

		$url_rewrite_name = ot_get_option('wpl_gallery_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Gallery', 'event-wpl' ); }

		register_post_type('post_gallery',
			array(
				'labels' => array(
					'name' => __( 'Galleries', 'event-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Gallery', 'event-wpl' ),
					'add_new_item' => __( 'Add New Gallery', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Gallery', 'event-wpl' ),
					'new_item' => __( 'New Gallery', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Gallery', 'event-wpl' ),
					'search_items' => __( 'Search Galleries', 'event-wpl' ),
					'not_found' => __( 'No Galleries found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Galleries found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Gallery', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Galleries.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-format-gallery',
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			)
		);
	}
	add_action('init', 'wpl_gallery_cpt');
}


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Galleries
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_gallery_category')) {
	
	function wpl_gallery_category() {

		$url_rewrite = ot_get_option('wpl_gallery_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'gallery-category'; }

		register_taxonomy('wpl_gallery_category', 'post_gallery', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Gallery Categories', 'event-wpl' ),
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
	add_action('init', 'wpl_gallery_category');
}	
