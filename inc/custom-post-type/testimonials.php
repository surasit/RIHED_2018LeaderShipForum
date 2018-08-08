<?php
/**
 * The default Custom post type for Testimonials
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php
if (!function_exists('wpl_testimonials_cpt')) {
	
	function wpl_testimonials_cpt(){
		
		$url_rewrite = ot_get_option('wpl_testimonials_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'testimonial'; }

		register_post_type('post_testimonials',
			array(
				'labels' => array(
					'name' => __( 'Testimonials', 'event-wpl' ),
					'singular_name' => __( 'Testimonial', 'event-wpl' ),
					'add_new' => __( 'Add New Testimonial', 'event-wpl' ),
					'add_new_item' => __( 'Add New Testimonial', 'event-wpl' ),
					'edit' => __( 'Edit', 'event-wpl' ),
					'edit_item' => __( 'Edit Testimonial', 'event-wpl' ),
					'new_item' => __( 'New Testimonial', 'event-wpl' ),
					'view' => __( 'View', 'event-wpl' ),
					'view_item' => __( 'View Testimonial', 'event-wpl' ),
					'search_items' => __( 'Search Testimonials', 'event-wpl' ),
					'not_found' => __( 'No Testimonials found', 'event-wpl' ),
					'not_found_in_trash' => __( 'No Testimonials found in Trash', 'event-wpl' ),
					'parent' => __( 'Parent Testimonial', 'event-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Testimonials.', 'event-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
				'menu_icon' => 'dashicons-testimonial'
			)
		); 
	}
	add_action('init', 'wpl_testimonials_cpt');
}	
