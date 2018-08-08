<?php 
/**
 * Register widget areas.
 *
 * @package WPlook
 * @subpackage Event
 * @since Event 1.0
 */


/*-----------------------------------------------------------
	Include Widgets
-----------------------------------------------------------*/
get_template_part( '/inc/widgets/widget', 'featurednews' );

// Initiate Speakers widget
if (ot_get_option('wpl_cpt_speakers') != 'off') {
	get_template_part( '/inc/widgets/widget', 'speakers' );
}

// Initiate Sponsors widget
if (ot_get_option('wpl_cpt_sponsors') != 'off') {
	get_template_part( '/inc/widgets/widget', 'sponsors' );
}

// Initiate Gallery widget
if (ot_get_option('wpl_cpt_galleries') != 'off') {
	get_template_part( '/inc/widgets/widget', 'gallery' );
}

// Initiate Staff widget
if (ot_get_option('wpl_cpt_staff') != 'off') {
	get_template_part( '/inc/widgets/widget', 'staff' );
}


// Initiate Testimonials
if (ot_get_option('wpl_cpt_testimonials') != 'off') {
	get_template_part( '/inc/widgets/widget', 'testimonials' );
}

// Initiate Testimonials
if (ot_get_option('wpl_cpt_shedules') != 'off') {
	get_template_part( '/inc/widgets/widget', 'schedule' );
}


get_template_part( '/inc/widgets/widget', 'tickets' );

get_template_part( '/inc/widgets/widget', 'quote' );
get_template_part( '/inc/widgets/widget', 'address' );
get_template_part( '/inc/widgets/widget', 'posts' );
get_template_part( '/inc/widgets/widget', 'flickr' );
get_template_part( '/inc/widgets/widget', 'page' );
get_template_part( '/inc/widgets/widget', 'pages' );

function wplook_widgets_init() {

	/*-----------------------------------------------------------
		Home page Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'First Home Page Widget area', 'event-wpl' ),
		'id' => 'front-1',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','event-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	) );


	/*-----------------------------------------------------------
		Pages widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Page Widget area', 'event-wpl' ),
		'id' => 'page-1',
		'description' => __('Widgets in this area will be shown on all Pages.','event-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );
	

	/*-----------------------------------------------------------
		Posts Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Press/Blog Widget area', 'event-wpl' ),
		'id' => 'post-1',
		'description' => __('Widgets in this area will be shown on all Posts.','event-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );


	/*-----------------------------------------------------------
		Contact page Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Contact Page Widget area', 'event-wpl' ),
		'id' => 'contact-1',
		'description' => __('Widgets in this area will be shown on Contact Pages.','event-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );

}
/** Register sidebars */
add_action( 'widgets_init', 'wplook_widgets_init' );
?>
