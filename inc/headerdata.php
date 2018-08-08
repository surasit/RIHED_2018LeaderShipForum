<?php
/**
 * Headerdata
 *
 * @package WordPress
 * @subpackage event
 * @since event 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Include CSS
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wpl_css_include' ) ) {

	function wpl_css_include () {

		/*-----------------------------------------------------------
			Bootstrap
		-----------------------------------------------------------*/

		wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css', 'css', '');
		wp_enqueue_style('bootstrap');

		/*-----------------------------------------------------------
			Loads our main stylesheet.
		-----------------------------------------------------------*/
		wp_enqueue_style( 'event-style', get_stylesheet_uri(), array(), '2015-01-01' );

		/*-----------------------------------------------------------
			Animate
		-----------------------------------------------------------*/

		wp_register_style('animate', get_template_directory_uri().'/css/animate.min.css', 'css', '');
		wp_enqueue_style('animate');

		/*-----------------------------------------------------------
			Font Awesome
		-----------------------------------------------------------*/

		wp_register_style('font-awesome', get_template_directory_uri().'/css/font-awesome.css', 'css', '');
		wp_enqueue_style('font-awesome');

		/*-----------------------------------------------------------
			FlexSlider
		-----------------------------------------------------------*/

		wp_register_style('flexslider', get_template_directory_uri().'/css/flexslider.css', 'css', '');
		wp_enqueue_style('flexslider');

		/*-----------------------------------------------------------
			Fancy Select
		-----------------------------------------------------------*/

		wp_register_style('fancySelect', get_template_directory_uri().'/css/fancySelect.css', 'css', '');
		wp_enqueue_style('fancySelect');

		/*-----------------------------------------------------------
			Owl Carousel
		-----------------------------------------------------------*/

		wp_register_style('owlcarousel', get_template_directory_uri().'/css/owl.carousel.css', 'css', '');
		wp_enqueue_style('owlcarousel');

		/*-----------------------------------------------------------
			Owl Carousel
		-----------------------------------------------------------*/

		wp_register_style('responsive', get_template_directory_uri().'/css/responsive.css', 'css', '');
		wp_enqueue_style('responsive');



	}
	add_action( 'wp_enqueue_scripts', 'wpl_css_include' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include Java Scripts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_scripts_include' ) ) {

	function wpl_scripts_include() {

		/*-----------------------------------------------------------
			Include jQuery
		-----------------------------------------------------------*/

		wp_enqueue_script( 'jquery' );


		/*-----------------------------------------------------------
			This part loads a JavaScript file that enables old versions of Internet Explorer to recognize the new HTML5 element
		-----------------------------------------------------------*/

		global $is_IE;
		if ($is_IE) {
			wp_enqueue_script( 'html5',  get_template_directory_uri().'/js/html5.js', '', '', '' );
		}

		/*-----------------------------------------------------------
			Include Google Maps
		-----------------------------------------------------------*/
		if ( is_page_template('template-homepage.php') ) {
			$maps_api_key = ot_get_option( 'wpl_maps_api_browser_key' );

			if( !empty( $maps_api_key ) ) {
				wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=' . $maps_api_key );
			} else {
				wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp' );
			}

			wp_enqueue_script( 'wplook-google-maps', get_template_directory_uri() . '/js/google-maps.js', array( 'jquery', 'google-maps-api' ), false, true );
		}

		/*-----------------------------------------------------------
			Include comment reply script
		-----------------------------------------------------------*/
		if ( is_singular() ) {

			wp_enqueue_script( 'comment-reply' );

		}

		/*-----------------------------------------------------------
	    	Base custom scripts
	    -----------------------------------------------------------*/

	    wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', '', '', 'footer' );
	    wp_enqueue_script( 'SmoothScroll', get_template_directory_uri().'/js/SmoothScroll.js', '', '', 'footer' );
	    wp_enqueue_script( 'typed', get_template_directory_uri().'/js/typed.js', '', '', 'footer' );
	    wp_enqueue_script( 'navjs', get_template_directory_uri().'/js/jquery.nav.js', '', '', 'footer' );
	    wp_enqueue_script( 'stellar', get_template_directory_uri().'/js/jquery.stellar.js', '', '', 'footer' );
	    wp_enqueue_script( 'flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', '', '', 'footer' );
	    wp_enqueue_script( 'backgroundyoutube', get_template_directory_uri().'/js/jquery.youtubebackground.js', '', '', 'footer' );
	    wp_enqueue_script( 'placeholder', get_template_directory_uri().'/js/jquery.placeholder.js', '', '', 'footer' );
	    wp_enqueue_script( 'acc', get_template_directory_uri().'/js/jquery.accordion.js', '', '', 'footer' );
	    wp_enqueue_script( 'carousel', get_template_directory_uri().'/js/owl.carousel.min.js', '', '', 'footer' );
	    wp_enqueue_script( 'fancySelect', get_template_directory_uri().'/js/fancySelect.js', '', '', 'footer' );
	    wp_enqueue_script( 'wowminjs', get_template_directory_uri().'/js/wow.min.js', '', '', 'footer' );
	    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
	    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery', 'imagesloaded' ), '', true );
	    wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js', '', '', 'footer' );

	}
	add_action('wp_enqueue_scripts', 'wpl_scripts_include');
}
