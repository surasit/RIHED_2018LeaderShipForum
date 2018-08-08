<?php
/**
 * The default Theme Options
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the options before anything else. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_theme_options', 1 );

/*-----------------------------------------------------------------------------------*/
/*	Build the custom settings & update OptionTree.
/*-----------------------------------------------------------------------------------*/
if (!function_exists('wpl_theme_options')) {
	
	function wpl_theme_options() {

		/*-----------------------------------------------------------
			Get a copy of the saved settings array.
		-----------------------------------------------------------*/

		$saved_settings = get_option( 'option_tree_settings', array() );
	  

		/*-----------------------------------------------------------
			Custom settings array that will eventually be  passes 
			to the OptionTree Settings API Class.
		-----------------------------------------------------------*/

		$custom_settings = array(
			'contextual_help' => array(

				'content'       => array( 
					array(
						'id'        => 'general_help',
						'title'     => __( 'General', 'event-wpl' ),
						'content'   => __( '<p>Help content goes here!</p>', 'event-wpl' )
					)
				),

				'sidebar'       => __( '<p>Sidebar content goes here!</p>', 'event-wpl' ),
			),

			'sections'        => array(


				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => __( 'General settings', 'event-wpl' ),
					'id'          => 'general_settings'
				),


				/*-----------------------------------------------------------
					Teaser Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => __( 'Slider Settings', 'event-wpl' ),
					'id'          => 'slider_settings'
				),


				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Blog settings', 'event-wpl' ),
					'id'          => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Speaker settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Speakers settings', 'event-wpl' ),
					'id'          => 'speakers_settings'
				),


				/*-----------------------------------------------------------
					Staff settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Staff settings', 'event-wpl' ),
					'id'          => 'staff_settings'
				),


				/*-----------------------------------------------------------
					Sponsor settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Sponsors settings', 'event-wpl' ),
					'id'          => 'sponsors_settings'
				),


				/*-----------------------------------------------------------
					Daily Agenda settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Daily Agenda settings', 'event-wpl' ),
					'id'          => 'daily_agenda_settings'
				),


				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Gallery settings', 'event-wpl' ),
					'id'          => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Testimonials settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Tesimonials settings', 'event-wpl' ),
					'id'          => 'testimonials_settings'
				),


				/*-----------------------------------------------------------
					Ticket settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Ticket settings', 'event-wpl' ),
					'id'          => 'tickets_settings'
				),


				/*-----------------------------------------------------------
					PayPal settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Payment settings', 'event-wpl' ),
					'id'          => 'paypal_settings'
				),

				/*-----------------------------------------------------------
					Google Maps settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Google Maps settings', 'event-wpl' ),
					'id'          => 'google_maps_settings'
				)
				
			),

			'settings'        => array(

				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				/*array(
					'label'       => 'Logo Image',
					'id'          => 'wpl_logo',
					'type'        => 'upload',
					'desc'        => 'Upload your own logo',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),*/
				array(
					'label'       => __( 'Second site description', 'event-wpl' ),
					'id'          => 'wpl_site_description',
					'type'        => 'text',
					'desc'        => __( 'Site description', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Custom Cascading Style Sheets', 'event-wpl' ),
					'id'          => 'wpl_css',
					'type'        => 'css',
					'desc'        => __( 'Add custom CSS to your theme', 'event-wpl' ),
					'std'         => '',
					'rows'        => '10',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Total number of tickets', 'event-wpl' ),
					'id'          => 'wpl_number_tickets',
					'type'        => 'text',
					'desc'        => __( 'Display the number of tickets', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Breadcrumb', 'event-wpl' ),
					'id'          => 'wpl_breadcrumbs',
					'type'        => 'on-off',
					'desc'        => __( 'Activate or deactivate the breadcrumb', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Share Buttons', 'event-wpl' ),
					'id'          => 'wpl_share_buttons',
					'type'        => 'on-off',
					'desc'        => __( 'Activate or deactivate share buttons.', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Google Analytics Tracking Code', 'event-wpl' ),
					'id'          => 'wpl_google_analytics_tracking_code',
					'type'        => 'textarea-simple',
					'desc'        => __( 'Insert the complete tracking script from analytics.google.com', 'event-wpl' ),
					'std'         => '',
					'rows'        => '8',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Social Network', 'event-wpl' ),
					'id'          => 'social_media_share',
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
							'desc'        => __( '<strong>NOTICE</strong>: Choose one item from the next list: <br />fa-facebook, <br />fa-github, <br />fa-twitter, <br />fa-pinterest, <br />fa-linkedin, <br />fa-google-plus, <br />fa-youtube, <br />fa-skype, <br />fa-vimeo-square', 'event-wpl' ),
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
					'section'     => 'general_settings'
				),


				array(
					'label'       => __( 'Copyright', 'event-wpl' ),
					'id'          => 'wpl_copyright',
					'type'        => 'text',
					'desc'        => __( 'Enter your Copyright notice displayed in the footer of the website', 'event-wpl' ),
					'std'         => __( 'Copyright &copy; 2016.', 'event-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),


				/*-----------------------------------------------------------
					Teaser Settings
				-----------------------------------------------------------*/
				array(
					'label'       => 'Slides',
					'id'          => 'wpl_sliders',
					'type'        => 'list-item',
					'desc'        => __( 'Press the <strong>Add New</strong> button in order to add a new slider.', 'event-wpl' ),
					'settings'    => array(
						array(
							'label'       => __( 'Slider Image', 'event-wpl' ),
							'id'          => 'wpl_slider_item_image',
							'type'        => 'upload',
							'desc'        => __( '<strong>Recommended image size:</strong> 1920x714px.', 'event-wpl' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'class'       => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),

						array(
							'label'       => __( 'Alt text', 'event-wpl' ),
							'id'          => 'wpl_slider_item_alt',
							'type'        => 'text',
							'desc'        => __( 'Enter a slide Alt text.', 'event-wpl' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'class'       => '',
							'taxonomy'    => '',
							'section'     => ''
						),


					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),
				

				array(
					'label'       => __( 'YouTube Video ID', 'event-wpl' ),
					'id'          => 'wpl_youtube_video_id',
					'type'        => 'text',
					'desc'        => __( 'Add YouTube Video ID', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),
				


				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Excerpt limit for list template', 'event-wpl' ),
					'id'          => 'wpl_blog_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for blog excerpt', 'event-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Number of news per page', 'event-wpl' ),
					'id'          => 'wpl_blog_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many cause do you want to display on blog template', 'event-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				// Single post settimgs

				array(
					'label'       => __( 'Single Post Settings', 'event-wpl' ),
					'id'          => 'single-post-settings',
					'type'        => 'textblock-titled',
					'desc'        => __( 'Single post settings.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Featured image on single post', 'event-wpl' ),
					'id'          => 'wpl_featured_image_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the Featured image on single post', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Date on single post', 'event-wpl' ),
					'id'          => 'wpl_date_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the date on single post', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Author on single post', 'event-wpl' ),
					'id'          => 'wpl_author_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the author on single post', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Category on single post', 'event-wpl' ),
					'id'          => 'wpl_category_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the category on single post', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				// Blog post settings
				array(
					'label'       => __( 'Blog Post Settings', 'event-wpl' ),
					'id'          => 'blog-post-settings',
					'type'        => 'textblock-titled',
					'desc'        => __( 'Blog post settings.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Author on Blog post', 'event-wpl' ),
					'id'          => 'wpl_author_blog_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the author on blog post', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),



				/*-----------------------------------------------------------
					Speakers settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Speaker', 'event-wpl' ),
					'id'          => 'wpl_cpt_speakers',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Speaker', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_speaker_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'speaker',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'URL Rewrite name', 'event-wpl' ),
					'id'          => 'wpl_speaker_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'event-wpl' ),
					'std'         => __( 'Speakers', 'event-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_speakers_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'speaker-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'Number of Speakers per page', 'event-wpl' ),
					'id'          => 'wpl_speaker_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many Speakers do you want to display on speaker template', 'event-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'Speakers Page', 'event-wpl' ),
					'id'          => 'wpl_speaker_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying speakers to link to it in the breadcrumbs.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),


				/*-----------------------------------------------------------
					Staff settings
				-----------------------------------------------------------*/
				
				array(
					'label'       => __( 'Custom Post Type Staff', 'event-wpl' ),
					'id'          => 'wpl_cpt_staff',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Staff', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_staff_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'staff',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'event-wpl' ),
					'id'          => 'wpl_staff_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'event-wpl' ),
					'std'         => __( 'Staff', 'event-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_staff_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'staff-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Number of staff per page', 'event-wpl' ),
					'id'          => 'wpl_staff_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many staff members do you want to display on staff template', 'event-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Staff Page', 'event-wpl' ),
					'id'          => 'wpl_staff_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying staff to link to it in the breadcrumbs.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),


				/*-----------------------------------------------------------
					Sponsors settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Sponsors', 'event-wpl' ),
					'id'          => 'wpl_cpt_sponsors',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Sponsors', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Number of Sponsor to display', 'event-wpl' ),
					'id'          => 'wpl_sponsors_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many sponsors do you want to display', 'event-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Sponsors Page', 'event-wpl' ),
					'id'          => 'wpl_sponsors_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying sponsors to link to it in the breadcrumbs.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_sponsors_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'sponsor',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'URL Rewrite name', 'event-wpl' ),
					'id'          => 'wpl_sponsors_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'event-wpl' ),
					'std'         => __( 'Sponsor', 'event-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_sponsors_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'sponsor-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Sponsors Page', 'event-wpl' ),
					'id'          => 'wpl_sponsors_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying sponsors to link to it in the breadcrumbs.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),



				/*-----------------------------------------------------------
					Daily Agenda settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Daily Agenda', 'event-wpl' ),
					'id'          => 'wpl_cpt_shedules',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Daily Agenda', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'daily_agenda_settings'
				),

				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Gallery', 'event-wpl' ),
					'id'          => 'wpl_cpt_galleries',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Gallery', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),
				array(
					'label'       => __( 'Author on Single gallery page', 'event-wpl' ),
					'id'          => 'wpl_author_single_gallery',
					'type'        => 'on-off',
					'desc'        => __( 'Activate / Deactivate the author on single gallery', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_gallery_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'gallery',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'event-wpl' ),
					'id'          => 'wpl_gallery_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'event-wpl' ),
					'std'         => __( 'Galleries', 'event-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_gallery_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'gallery-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Number of galleries per page', 'event-wpl' ),
					'id'          => 'wpl_galleries_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many galleries do you want to display on gallery template', 'event-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Galleries Page', 'event-wpl' ),
					'id'          => 'wpl_galleries_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying the gallery to link to it in the breadcrumbs.', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Testimonials settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Testimonials', 'event-wpl' ),
					'id'          => 'wpl_cpt_testimonials',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Testimonials', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'testimonials_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'event-wpl' ),
					'id'          => 'wpl_testimonials_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'event-wpl' ),
					'std'         => 'testimonials',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'testimonials_settings'
				),


				/*-----------------------------------------------------------
					Tickets settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Tickets', 'event-wpl' ),
					'id'          => 'wpl_cpt_tickets',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Tickets', 'event-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'tickets_settings'
				),


				/*-----------------------------------------------------------
					Payment settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'PayPal API Username', 'event-wpl' ),
					'id'          => 'wpl_pp_api_username',
					'type'        => 'text',
					'desc'        => __( 'PayPal API Username', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal API Password', 'event-wpl' ),
					'id'          => 'wpl_pp_api_password',
					'type'        => 'text',
					'desc'        => __( 'PayPal API Password', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal API Signature', 'event-wpl' ),
					'id'          => 'wpl_pp_api_signature',
					'type'        => 'text',
					'desc'        => __( 'PayPal API Signature', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal Page return', 'event-wpl' ),
					'id'          => 'wpl_pp_return_page',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will return back after successful payment', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal Page Cancel', 'event-wpl' ),
					'id'          => 'wpl_pp_return_cancel',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will return back after canceled payment process', 'event-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'Currency Code', 'event-wpl' ),
					'id'          => 'wpl_curency_code',
					'type'        => 'text',
					'desc'        => __( 'Add currency code, for ex: USD, EUR, CAD', 'event-wpl' ),
					'std'         => 'USD',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				/*-----------------------------------------------------------
					Google Maps settings
				-----------------------------------------------------------*/

				array(
					'label'       => '',
					'id'          => 'wpl_maps_description',
					'type'        => 'textblock',
					'desc'        => sprintf( __( 'Enter your Google Maps API keys here. These are a free code which allows maps to be displayed on your site. To create keys, follow instructions in the <a href="%s">WPlook Themes documentation</a>.', 'event-wpl' ), 'https://wplook.com/docs/google-maps-api/' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_maps_settings'
				),

				array(
					'label'       => __( 'Browser key', 'event-wpl' ),
					'id'          => 'wpl_maps_api_browser_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_maps_settings'
				),

				array(
					'label'       => __( 'Server key', 'event-wpl' ),
					'id'          => 'wpl_maps_api_server_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_maps_settings'
				),
			)
		);
		/* settings are not the same update the DB */
		if ( $saved_settings !== $custom_settings ) {
			update_option( 'option_tree_settings', $custom_settings ); 
		}
	}
}
