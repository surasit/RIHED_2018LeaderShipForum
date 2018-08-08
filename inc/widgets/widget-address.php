<?php
/*
 * Plugin Name: Address
 * Plugin URI: http://www.wplook.com
 * Description: Add the address and map to the home page.
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_address_widget");'));
class wplook_address_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_address_widget',
			__( 'WPlook Address (Home Page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying Contact address on home page', 'event-wpl' ), )
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Event venue', 'event-wpl' );
		}

		if ( $instance ) {
			$street_address = esc_attr( $instance[ 'street_address' ] );
		}
		else {
			$street_address = __( '', 'event-wpl' );
		}

		if ( $instance ) {
			$google_maps_address = isset( $instance[ 'google_maps_address' ] ) ? esc_attr( $instance[ 'google_maps_address' ] ) : '';
		}
		else {
			$google_maps_address = __( '', 'event-wpl' );
		}

		if ( $instance ) {
			$phone = esc_attr( $instance[ 'phone' ] );
		}
		else {
			$phone = __( '', 'event-wpl' );
		}

		if ( $instance ) {
			$email = esc_attr( $instance[ 'email' ] );
		}
		else {
			$email = __( '', 'event-wpl' );
		}


		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('street_address'); ?>">
					<?php _e('Address:', 'event-wpl'); ?>
				</label>
				<textarea cols="25" rows="3" class="widefat" id="<?php echo $this->get_field_id('street_address'); ?>" name="<?php echo $this->get_field_name('street_address'); ?>" type="text"><?php echo $street_address; ?></textarea>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"><?php _e('User-friendly address of the event which will be displayed above the map in the information panel. Consider including some directions or a description of your event location to make it easier to find.', 'event-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('google_maps_address'); ?>">
					<?php _e('Google Maps address:', 'event-wpl'); ?>
				</label>
				<textarea cols="25" rows="3" class="widefat" id="<?php echo $this->get_field_id('google_maps_address'); ?>" name="<?php echo $this->get_field_name('google_maps_address'); ?>" type="text"><?php echo $google_maps_address; ?></textarea>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"><?php printf( __( 'Maps are dispayed using <a href="%s">Google Maps</a>, so check your location is displayed correctly there before pasting it in here.<br><br>Remember to include your Google Maps API key on the <a href="%s">Theme Options</a> page for maps to be displayed correctly.', 'event-wpl' ), 'https://maps.google.com', admin_url( 'themes.php?page=ot-theme-options' ) ); ?></p>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('phone'); ?>"> <?php _e('Phone:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add Phone Number', 'event-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('email'); ?>"> <?php _e('Email:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add Email Address', 'event-wpl'); ?></p>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>location</strong>', 'event-wpl'); ?></p>
			<br />

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);

		if ( current_user_can('unfiltered_html') )
			$instance['street_address'] =  $new_instance['street_address'];
		else
			$instance['street_address'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['street_address']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);

		$instance['google_maps_address'] = sanitize_text_field($new_instance['google_maps_address']);
		$instance['phone'] = sanitize_text_field($new_instance['phone']);
		$instance['email'] = sanitize_text_field($new_instance['email']);

		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$wpl_lat = isset( $instance['wpl_lat'] ) ? apply_filters( 'widget', $instance['wpl_lat'] ) : '';
		$wpl_long = isset( $instance['wpl_long'] ) ? apply_filters( 'widget', $instance['wpl_long'] ) : '';
		$street_address = apply_filters( 'widget', $instance['street_address'] );
		$google_maps_address = isset( $instance['google_maps_address'] ) ? apply_filters( 'widget', $instance['google_maps_address'] ) : '';
		$phone = apply_filters( 'widget', $instance['phone'] );
		$email = apply_filters( 'widget', $instance['email'] );
		?>
		
		<section id="location" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
			<div class="row">
				<div class="col-sm-12 col-md-7">
					<?php
						if( !empty( $google_maps_address ) || ( !empty( $wpl_lat ) || !empty( $wpl_long ) ) ) {
							$options = array(
								'api_key' => ot_get_option( 'wpl_maps_api_server_key' )
							);

							$maps = new WPlook_Google_Maps( $options );

							$maps->generate_map( array(
								'maps_address' => $google_maps_address,
								'marker' => get_template_directory_uri() . '/images/pin.png',
								'latitude' => $wpl_lat,
								'longitude' => $wpl_long,
								'class' => 'map fit-left'
							) );
						}
					?>
				</div>
				<div class="col-sm-12 col-md-5">
					<h2><?php echo $title; ?></h2>
					<ul class="contact">
						<!-- Address -->
						<?php if ($street_address) { ?>
							<li class="contact-info">
								<em class="fa fa-map-marker"></em>
								<span><?php echo $street_address; ?></span>
							</li>
						<?php } ?>

						<!-- Phone -->
						<?php if ($phone) { ?>
							<li class="contact-info telephone">
								<em class="fa fa-phone"></em>
								<span><?php echo $phone; ?></span>
							</li>
						<?php } ?>

						<!-- Email -->
						<?php if ($email) { ?>
							<li class="contact-info">
								<em class="fa fa-envelope"></em>
								<span><?php echo $email; ?></span>
							</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</section>
		
		<?php
	}
}
?>
