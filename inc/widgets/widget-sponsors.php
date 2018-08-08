<?php
/*
 * Plugin Name: Sponsors
 * Plugin URI: http://www.wplook.com
 * Description: Add Sponsors to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_sponsors_widget");'));
class wplook_sponsors_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_sponsors_widget',
			__( 'WPlook Sponsors (Home page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying Sponsors on Home Page', 'event-wpl' ), )
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
			$title = __( 'Sponsors', 'event-wpl' );
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
			$nr_posts = __( '4', 'event-wpl' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Sponsors:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of Sponsors you want to display', 'event-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order by:', 'event-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'event-wpl'); ?></option>
					<option value="Latest" <?php selected( 'Latest', $display_type ); ?>><?php _e('Latest', 'event-wpl'); ?></option>
				</select>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>partners</strong>', 'event-wpl'); ?></p>
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

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = apply_filters( 'widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance );
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$display_type = isset( $instance['display_type'] ) ? esc_attr( $instance['display_type'] ) : '';
		?>

		<?php
			if ( $display_type == 'random') {
				$args = array(
					'post_type' => 'post_sponsor',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'orderby' => 'rand'
				);
			} else {
				$args = array(
					'post_type' => 'post_sponsor',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts
				);
			}


			$sponsors = null;
			$sponsors = new WP_Query( $args );
		?>

			<?php if( $sponsors->have_posts() ) : ?>
				<!-- Sponsors -->
				<section id="partners" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
					<div class="row">
						<div class="col-sm-12">
							<div class="section-header text-center">
								<h2><?php echo $title; ?></h2>
								<?php if ( $subtitle != '') { ?>
									<p>
										<?php echo $subtitle; ?>
									</p>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="partners">

							<?php while( $sponsors->have_posts() ) : $sponsors->the_post(); ?>
								<?php
									$pid = $post->ID;
									$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
								?>

								<?php
									$pid = $post->ID;
									$logo_image = get_post_meta($post->ID, 'wpl_logo_image', true);
								?>

									<div id="post-<?php the_ID(); ?>" <?php post_class('col-xs-12 col-sm-6 col-md-3 partner'); ?>>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php echo $logo_image; ?>" width="240" height="100" alt="<?php the_title(); ?>">
										</a>
									</div>

							<?php endwhile; wp_reset_postdata(); ?>

						</div>
					</div>
				</section>
			<?php endif; ?>
		<?php
	}
}
?>
