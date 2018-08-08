<?php
/**
 * The default Custom post type for Tickets
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php

if (!function_exists('wpl_tickets_cpt')) {
	function wpl_tickets_cpt(){
		
		$url_rewrite = 'tickets';

		register_post_type('post_tickets',
			array(
				'labels' => array(
					'name' => __( 'Tickets', 'event-wpl' ),
					'singular_name' => __( 'Ticket', 'event-wpl' ),
					'add_new' => __( 'Add New Ticket', 'event-wpl' ),
					'add_new_item' => __( 'Add New Ticket', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Ticket', 'event-wpl' ),
					'new_item' => __( 'New Ticket', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Ticket', 'event-wpl' ),
					'search_items' => __( 'Search Tickets', 'event-wpl' ),
					'not_found' => __( 'No Tickets found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Tickets found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Ticket', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Tickets.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title','editor'),
				'menu_icon' => 'dashicons-tickets-alt'
			)
		);
	}
	add_action('init', 'wpl_tickets_cpt');
}	
