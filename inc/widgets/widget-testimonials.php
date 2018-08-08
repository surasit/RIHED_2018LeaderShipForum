<?php
/*
 * Plugin Name: Testimonials
 * Plugin URI: http://www.wplook.com
 * Description: Display the lates testimonials on home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_testimonials_widget");'));
class wplook_testimonials_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_testimonials_widget',
			__( 'WPlook Testimonials (Home Page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying Testimonials.', 'event-wpl' ), )
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
			$title = __( 'Testimonials', 'event-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( '', 'event-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '3', 'event-wpl' );
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = __( 'random', 'event-wpl' );
		}


		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>"> <?php _e('Subtitle:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of testimonials:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The number of testimonials you want to display.', 'event-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order:', 'event-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="rand" <?php selected( 'rand', $display_type ); ?>><?php _e('Random', 'event-wpl'); ?></option>
					<option value="date" <?php selected( 'date', $display_type ); ?>><?php _e('Latest', 'event-wpl'); ?></option>
				</select>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>testimonials</strong>', 'event-wpl'); ?></p>
			<br />

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['subtitle'] = sanitize_text_field($new_instance['subtitle']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = apply_filters( 'widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance );
		$nr_posts = apply_filters( 'widget_nr_posts', $instance['nr_posts'] );
		$display_type = apply_filters( 'widget', $instance['display_type'] );

		

		?>
		

		<!-- Testimonials -->
		<section id="testimonials" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header text-center">
						<h2><?php echo $title; ?></h2>
						<?php if ( $subtitle != '') { ?>
							<p>
								<?php echo $subtitle; ?>
							</p>
						<?php } ?>
					</div>
					<div id="carousel" class="owl-carousel">
						<?php $args = array( 'post_type' => 'post_testimonials','post_status' => 'publish', 'posts_per_page' => $nr_posts, 'orderby' => $display_type); ?>
						<?php $wp_query = null; ?>
						<?php $wp_query = new WP_Query( $args ); ?>
						<?php if ( $wp_query->have_posts() ) : ?>
							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
								<?php 
									$testimonial_email = get_post_meta($post->ID, 'wpl_testimonial_email', true );
									$testimonial_company = get_post_meta($post->ID, 'wpl_testimonial_company', true );
								?>
								
								<!-- Forth Testimonial -->
								<div class="testimonial">
									<div class="testimonial-content">
										<?php the_content(); ?>
									</div>
									<div class="testimonial-author">
										<?php 
											if ($testimonial_email != '') {
												echo get_avatar( $testimonial_email, $size = '60');
											} elseif ( has_post_thumbnail() ) {
												the_post_thumbnail('avatar-small', array( 'class' => 'avatar' ));
											}
										?>
										<div>
											<h4><?php the_title(); ?></h4>
											<!-- Company name -->
											<?php if ($testimonial_company) { ?>
												<?php echo $testimonial_company ?>
											<?php } ?>
										</div>
									</div>
								</div>


							<?php endwhile; wp_reset_postdata(); ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
<?php }
}
?>
