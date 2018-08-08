<?php
/*
 * Plugin Name: Staff
 * Plugin URI: http://www.wplook.com
 * Description: Add Staff members to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_staff_widget");'));
class wplook_staff_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_staff_widget',
			__( 'WPlook Staff (Home page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying staff members on Home Page', 'event-wpl' ), )
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
			$title = __( 'Staff', 'event-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( '', 'event-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'event-wpl' );
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

		if ( $instance ) {
			$read_more_link = esc_attr( $instance[ 'read_more_link' ] );
		}
		else {
			$read_more_link = __( '', 'event-wpl' );
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
				<label for="<?php echo $this->get_field_id('categories'); ?>">
					<?php _e('Category:', 'event-wpl'); ?>
					<br />
				</label>

				<?php wp_dropdown_categories(
					array(
						'name'	=> $this->get_field_name("categories"),
						'show_option_all'    => __('All', 'event-wpl'),
						'show_count'	=> 1,
						'selected' => $categories,
						'taxonomy'  => 'wpl_staff_category'
					)
				); ?>

			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Staff members:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of Staff members you want to display', 'event-wpl'); ?></p>
			</p>


			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order by:', 'event-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'event-wpl'); ?></option>
					<option value="Latest" <?php selected( 'Latest', $display_type ); ?>><?php _e('Latest', 'event-wpl'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Staff members:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all staff members URL', 'event-wpl'); ?></p>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>staff</strong>', 'event-wpl'); ?></p>
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
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
		$instance['read_more_link'] = sanitize_text_field($new_instance['read_more_link']);
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
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$display_type = isset( $instance['display_type'] ) ? esc_attr( $instance['display_type'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';
		?>

		<?php
			if ( $categories < '1' ) {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'post_staff',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand'
					);
				} else {
					$args = array(
						'post_type' => 'post_staff',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts
					);
				}
			} else {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'post_staff',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_staff_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				} else {
					$args = array(
						'post_type' => 'post_staff',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_staff_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				}
			}

			$speaker = null;
			$speaker = new WP_Query( $args );
		?>

			<?php if( $speaker->have_posts() ) : ?>
				<!-- Staff -->
				<section id="staff" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
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
						<?php while( $speaker->have_posts() ) : $speaker->the_post(); ?>
							<?php
								$pid = $post->ID;
								$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
							?>

							<?php
								$pid = $post->ID;
								$speaker_company = get_post_meta( $pid, 'wpl_speaker_company', true);
								$candidate_share_items = get_post_meta($post->ID, 'candidate_share', true);
							?>
							<!-- Speackers -->
							<div id="post-<?php the_ID(); ?>" <?php post_class('col-xs-12 col-sm-6 col-md-3'); ?>>
								<div class="speaker">
									<?php if ( has_post_thumbnail() ) {?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('speaker-thumb'); ?></a>
										<?php } ?>
									<div class="speaker-info">
										<h3><?php the_title(); ?></h3>
										<p><!-- Speaker company -->
											<?php if ( $speaker_company !='' ) { ?>
												<div class="company"><?php echo $speaker_company; ?></div>
											<?php } ?>
										</p>
									</div>
									<ul class="speaker-contacts">
										<!-- Share items -->
										<?php if ( ! empty( $candidate_share_items ) ) {
											foreach( $candidate_share_items as $item ) { ?>
												<li><a href="<?php echo $item['wpl_share_item_url']; ?>" target="_blank" class="fa <?php echo $item['wpl_share_item_icon']; ?>"></a></li>
											<?php }
										} ?>
									</ul>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>

						<?php if ($read_more_link) { ?>
							<!-- View all Staff Button -->
							<div class="col-sm-12 col-md-12">
								<button class="button button-icon pull-right"><a href="<?php echo $read_more_link ?>" title="<?php _e('View all Staff', 'event-wpl'); ?>" ><?php _e('View all Staff', 'event-wpl'); ?></a> <span class="fa fa-chevron-down"></span></button>
							</div>
						<?php } ?>
					</div>
			</section>
			<?php endif; ?>
		<?php
	}
}
?>
