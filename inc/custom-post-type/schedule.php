<?php
/**
 * The default Custom post type for Shedules
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php

if (!function_exists('wpl_schedules_cpt')) {
	function wpl_schedules_cpt(){
		
		$url_rewrite = 'daily-agenda';

		register_post_type('post_shedules',
			array(
				'labels' => array(
					'name' => __( 'Daily Agenda', 'event-wpl' ),
					'singular_name' => __( 'Daily Agenda', 'event-wpl' ),
					'add_new' => __( 'Add New Daily Agenda', 'event-wpl' ),
					'add_new_item' => __( 'Add New Daily Agenda', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Daily Agenda', 'event-wpl' ),
					'new_item' => __( 'New Daily Agenda', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Daily Agenda', 'event-wpl' ),
					'search_items' => __( 'Search Daily Agenda', 'event-wpl' ),
					'not_found' => __( 'No Daily Agenda found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Daily Agenda found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Daily Agenda', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Daily Agenda.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title'),
				'menu_icon' => 'dashicons-schedule'
			)
		);
	}
	add_action('init', 'wpl_schedules_cpt');
}
