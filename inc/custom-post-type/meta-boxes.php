<?php
/**
 * The default Meta Box Settings
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the meta boxes. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_meta_boxes' );

function wpl_meta_boxes() {

	/*-----------------------------------------------------------
		Custom meta box for pages
	-----------------------------------------------------------*/
	
	$page_meta_box = array(
		'id'          => 'page_meta_box',
		'title'       => __( 'Page Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(

			array(
				'label'       => __( 'Right Sidebar', 'event-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'event-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $page_meta_box );
	

	/*-----------------------------------------------------------
  		Speakers
  	-----------------------------------------------------------*/

	$speakers_meta_box = array(
		'id'          => 'speakers_meta_box',
		'title'       => __( 'Speaker Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_speaker' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Company Name', 'event-wpl' ),
				'id'          => 'wpl_speaker_company',
				'type'        => 'text',
				'desc'        => __( 'Company name', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Company URL', 'event-wpl' ),
				'id'          => 'wpl_speaker_company_url',
				'type'        => 'text',
				'desc'        => __( 'Company url', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Social Network links', 'event-wpl' ),
				'id'          => 'candidate_share',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links.', 'event-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Service Name', 'event-wpl' ),
						'id'          => 'wpl_share_item_name',
						'type'        => 'text',
						'desc'        => __( 'The name of the social network site, for example: "Facebook"', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'URL', 'event-wpl' ),
						'id'          => 'wpl_share_item_url',
						'type'        => 'text',
						'desc'        => __( 'Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					), 
					array(
						'label'       => __( 'Icon', 'event-wpl' ),
						'id'          => 'wpl_share_item_icon',
						'type'        => 'text',
						'desc'        => __( '<strong>NOTICE</strong>: Choose one item from the next list: <br />fa-facebook, <br />fa-github, <br />fa-twitter, <br />fa-pinterest, <br />fa-linkedin, <br />fa-google-plus, <br />fa-youtube, <br />fa-flickr', 'event-wpl' ),
						'std'         => 'fa-',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					), 
				),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'toolbar'
			),

			array(
				'label'       => __( 'Right Sidebar', 'event-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'event-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)

		)
	);
	ot_register_meta_box( $speakers_meta_box );


	/*-----------------------------------------------------------
  		Gallery
  	-----------------------------------------------------------*/

	$gallery_meta_box = array(
		'id'          => 'gallery_meta_box',
		'title'       => __( 'Gallery Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_gallery' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Gallery', 'event-wpl' ),
				'id'          => 'wpl_cpt_gallery',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add images to gallery.', 'event-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Gallery Image', 'event-wpl' ),
						'id'          => 'wpl_cpt_image',
						'type'        => 'upload',
						'desc'        => __( 'The required dimensions:  (1200 x 800 px)', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
				),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'social_media'
			),

			array(
				'label'       => __( 'Right Sidebar', 'event-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'event-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			
		)
	);
	ot_register_meta_box( $gallery_meta_box );


	/*-----------------------------------------------------------
  		Payments
  	-----------------------------------------------------------*/

	$pledges_meta_box = array(
		'id'          => 'pledges_meta_box',
		'title'       => __( 'Cause Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_pledges' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Choose the ticket', 'event-wpl' ),
				'id'          => 'wpl_pledge_ticket',
				'type'        => 'custom-post-type-select',
				'desc'        => __( 'Choose the ticket', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => 'post_tickets',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Transaction ID/Token', 'event-wpl' ),
				'id'          => 'wpl_pledge_transaction_id',
				'type'        => 'text',
				'desc'        => __( 'Add the transaction ID', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'First name', 'event-wpl' ),
				'id'          => 'wpl_pledge_first_name',
				'type'        => 'text',
				'desc'        => __( 'Add the first name', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Last name', 'event-wpl' ),
				'id'          => 'wpl_pledge_last_name',
				'type'        => 'text',
				'desc'        => __( 'Add the last name', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Country', 'event-wpl' ),
				'id'          => 'wpl_pledge_country',
				'type'        => 'text',
				'desc'        => __( 'Add the Postal Code', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Email', 'event-wpl' ),
				'id'          => 'wpl_pledge_email',
				'type'        => 'text',
				'desc'        => __( 'Add the Email address', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Payment Amount', 'event-wpl' ),
				'id'          => 'wpl_pledge_payment_amount',
				'type'        => 'text',
				'desc'        => __( 'Add the Payment Amount', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Payment Source', 'event-wpl' ),
				'id'          => 'wpl_pledge_payment_source',
				'type'        => 'select',
				'desc'        => __( 'Choose the pledge payment source', 'event-wpl' ),
				'choices'     => array(
					array(
						'label'       => __( 'Manual', 'event-wpl' ),
						'value'       => 'manual'
					),
					array(
						'label'       => __( 'PayPal', 'event-wpl' ),
						'value'       => 'paypal'
					),
					array(
						'label'       => __( 'Check/Cash', 'event-wpl' ),
						'value'       => 'check_cash'
					),
				),        
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Payment Status', 'event-wpl' ),
				'id'          => 'wpl_pledge_payment_status',
				'type'        => 'select',
				'desc'        => __( 'Choose the pledge payment status', 'event-wpl' ),
				'choices'     => array(
					array(
						'label'       => __( 'Completed', 'event-wpl' ),
						'value'       => 'Completed'
					),
					array(
						'label'       => __( 'Refunded', 'event-wpl' ),
						'value'       => 'Refunded'
					),
					array(
						'label'       => __( 'Canceled', 'event-wpl' ),
						'value'       => 'Canceled'
					),
				),        
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $pledges_meta_box );
	

	/*-----------------------------------------------------------
  		Staff
  	-----------------------------------------------------------*/

	$staff_meta_box = array(
		'id'          => 'staff_meta_box',
		'title'       => __( 'Staff Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_staff' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Position', 'event-wpl' ),
				'id'          => 'wpl_candidate_position',
				'type'        => 'text',
				'desc'        => __( 'Candidate position, (ex: CEO/Co-Founder)', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Social Network links', 'event-wpl' ),
				'id'          => 'candidate_share',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links.', 'event-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Service Name', 'event-wpl' ),
						'id'          => 'wpl_share_item_name',
						'type'        => 'text',
						'desc'        => __( 'The name of the social network site, for example: "Facebook"', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'URL', 'event-wpl' ),
						'id'          => 'wpl_share_item_url',
						'type'        => 'text',
						'desc'        => __( 'Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					), 
					array(
						'label'       => __( 'Icon', 'event-wpl' ),
						'id'          => 'wpl_share_item_icon',
						'type'        => 'text',
						'desc'        => __( '<strong>NOTICE</strong>: Choose one item from the next list: <br />fa-facebook, <br />fa-github, <br />fa-twitter, <br />fa-pinterest, <br />fa-linkedin, <br />fa-google-plus, <br />fa-youtube, <br />fa-flickr', 'event-wpl' ),
						'std'         => 'fa-',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					), 
				),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'toolbar'
			),

			array(
				'label'       => __( 'Right Sidebar', 'event-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'event-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $staff_meta_box );
	

	/*-----------------------------------------------------------
  		Sponsors
  	-----------------------------------------------------------*/

	$sponsor_meta_box = array(
		'id'          => 'sponsor_meta_box',
		'title'       => __( 'Media Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_sponsor' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Logo', 'event-wpl' ),
				'id'          => 'wpl_logo_image',
				'type'        => 'upload',
				'desc'        => __( '*  <br /> The required dimensions:  (240x100px)', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'URL', 'event-wpl' ),
				'id'          => 'wpl_sponsor_url',
				'type'        => 'text',
				'desc'        => __( 'Add a sponsor URL, ex: http://wplook.com', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

		)
	);
	ot_register_meta_box( $sponsor_meta_box );

	/*-----------------------------------------------------------
  		Tickets
  	-----------------------------------------------------------*/

	$tickets_meta_box = array(
		'id'          => 'tickets_meta_box',
		'title'       => __( 'Tickets Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_tickets' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Price', 'event-wpl' ),
				'id'          => 'wpl_ticket_price',
				'type'        => 'text',
				'desc'        => __( 'Ticket price, ex: 200 or 200.00', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Tickets options', 'event-wpl' ),
				'id'          => 'wpl_tickets_options',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add a new option.', 'event-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Title', 'event-wpl' ),
						'id'          => 'wpl_ticekt_option_title',
						'type'        => 'Text',
						'desc'        => __( 'Add title', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),

					array(
						'label'       => __( 'Option is:', 'event-wpl' ),
						'id'          => 'wpl_ticekt_option_active',
						'type'        => 'on-off',
						'desc'        => __( 'Make the option active', 'event-wpl' ),
						'std'         => 'on',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
				),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'toolbar'
			),

			array(
				'label'       => __( 'Custom URL', 'event-wpl' ),
				'id'          => 'wpl_eventbride_url',
				'type'        => 'text',
				'desc'        => __( 'Set a custom URL for this ticket, the url will be applied to "buy button".', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Highlight', 'event-wpl' ),
				'id'          => 'wpl_highlight_ticket',
				'type'        => 'on-off',
				'desc'        => '',
				'std'         => 'off',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $tickets_meta_box );


	/*-----------------------------------------------------------
  		Testimonials
  	-----------------------------------------------------------*/

	$testimonials_meta_box = array(
		'id'          => 'testimonials_meta_box',
		'title'       => __( 'Testimonial Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_testimonials' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Company', 'event-wpl' ),
				'id'          => 'wpl_testimonial_company',
				'type'        => 'text',
				'desc'        => __( 'Company', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Email', 'event-wpl' ),
				'id'          => 'wpl_testimonial_email',
				'type'        => 'text',
				'desc'        => __( 'Email', 'event-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $testimonials_meta_box );


	/*-----------------------------------------------------------
  		Schedule
  	-----------------------------------------------------------*/

	$schedule_meta_box = array(
		'id'          => 'schedule_meta_box',
		'title'       => __( 'Schedule Options', 'event-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_shedules' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Sessions', 'event-wpl' ),
				'id'          => 'wpl_speech',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add a new sessions for this day.', 'event-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Speaker', 'event-wpl' ),
						'id'          => 'wpl_agenda_speaker',
						'type'        => 'custom-post-type-checkbox',
						'desc'        => __( 'Select the Speaker for this session', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => 'post_speaker',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Thematics', 'event-wpl' ),
						'id'          => 'wpl_speech_tematichs',
						'type'        => 'text',
						'desc'        => __( 'Add the thematic', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Short Description', 'event-wpl' ),
						'id'          => 'wpl_speech_short_desc',
						'type'        => 'textarea-simple',
						'desc'        => __( 'Add a shord description', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Start time', 'event-wpl' ),
						'id'          => 'wpl_speech_start_time',
						'type'        => 'text',
						'desc'        => __( 'Session start time', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'End time', 'event-wpl' ),
						'id'          => 'wpl_speech_end_time',
						'type'        => 'text',
						'desc'        => __( 'Session end time', 'event-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
				),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'toolbar'
			),


		)
	);
	ot_register_meta_box( $schedule_meta_box );	

}
