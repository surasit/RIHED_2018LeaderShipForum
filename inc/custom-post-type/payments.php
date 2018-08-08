<?php
/**
 * The default Custom post type Payments
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php

if (!function_exists('wpl_pledges_cpt')) {
	function wpl_pledges_cpt(){
		
		$url_rewrite = 'pledges';

		register_post_type('post_pledges',
			array(
				'labels' => array(
					'name' => __( 'Payments', 'event-wpl' ),
					'singular_name' => __( 'Payment', 'event-wpl' ),
					'add_new' => __( 'Add New Payment', 'event-wpl' ),
					'add_new_item' => __( 'Add New Payment', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Payment', 'event-wpl' ),
					'new_item' => __( 'New Payment', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Payments', 'event-wpl' ),
					'search_items' => __( 'Search Payments', 'event-wpl' ),
					'not_found' => __( 'No Payments found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Payments found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Payment', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Payments.', 'event-wpl' ),
				'public' => false,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'thumbnail'),
				'menu_icon' => 'dashicons-money'
			)
		);
	}
	add_action('init', 'wpl_pledges_cpt');
}	
