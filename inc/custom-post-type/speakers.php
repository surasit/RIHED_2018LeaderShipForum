<?php
/**
 * The default Custom post type for Speakers
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php 
if (!function_exists('wpl_speaker_cpt')) {
	function wpl_speaker_cpt(){
		
		$url_rewrite = ot_get_option('wpl_speaker_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'speaker'; }

		$url_rewrite_name = ot_get_option('wpl_speaker_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Speaker', 'event-wpl' ); }

		register_post_type('post_speaker',
			array(
				'labels' => array(
					'name' => __( 'Speakers', 'event-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Speaker', 'event-wpl' ),
					'add_new_item' => __( 'Add New Speaker', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Speaker', 'event-wpl' ),
					'new_item' => __( 'New Speaker', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Speakers', 'event-wpl' ),
					'search_items' => __( 'Search Speakers', 'event-wpl' ),
					'not_found' => __( 'No Speakers found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Speakers found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Speaker', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Speakers.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
				'menu_icon' => 'dashicons-businessman'
			)
		);
	}
	add_action('init', 'wpl_speaker_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for speakers
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_speakers_category')) {
	function wpl_speakers_category() {

		$url_rewrite = ot_get_option('wpl_speakers_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'speakers-category'; }

		register_taxonomy('wpl_speakers_category', 'post_speaker', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Speakers Categories', 'event-wpl' ),
					  'singular_name' => __( 'Department', 'event-wpl' ),
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
	add_action('init', 'wpl_speakers_category');
}
