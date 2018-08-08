<?php
/*
 * Plugin Name: Recent galleries
 * Plugin URI: http://www.wplook.com
 * Description: Add galleries on home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_gallery_widget");'));
class wplook_gallery_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_gallery_widget',
			__( 'WPlook Gallery (Home page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying galleries', 'event-wpl' ), )
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
			$title = __( 'Gallery', 'event-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( '', 'event-wpl' );
		}

		if ( $instance ) {
			$description = esc_attr( $instance[ 'description' ] );
		}
		else {
			$description = __( '', 'event-wpl' );
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
				<label for="<?php echo $this->get_field_id('description'); ?>">
					<?php _e('Description:', 'event-wpl'); ?>
				</label>
				<textarea cols="25" rows="10" class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text"><?php echo $description; ?></textarea>

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
						'taxonomy'  => 'wpl_gallery_category' 
					) 
				); ?>
				
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of galleries:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of galleries you want to display', 'event-wpl'); ?></p>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>image-slider</strong>', 'event-wpl'); ?></p>
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
		$instance['description'] = $new_instance['description'];
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
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
		$description = apply_filters( 'widget_description', empty($instance['description']) ? '' : $instance['description'], $instance );
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		?>
		
		<?php

			if ( $categories < '1' ) {
				$args = array(
					'post_type' => 'post_gallery',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'post_type' => 'post_gallery',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_gallery_category',
							'field' => 'id',
							'terms' => $categories
						),
					),
				);
			}

			$gallery = null;
			$gallery = new WP_Query( $args ); ?>

			<?php if( $gallery->have_posts() ) : ?>
			
				<section id="image-slider" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
					<div class="row">
						<div class="col-md-5">
							<h2><?php echo $title; ?></h2>
							<?php if ( $subtitle != '') { ?>
								<h4>
									<?php echo $subtitle; ?>
								</h4>
							<?php } ?>
								
							<?php if ( $description != '') { ?>
								<p>
									<?php echo $description; ?>
								</p>
							<?php } ?>
						</div>
						<div class="col-md-7">
							<div id="slider" class="owl-carousel fit-right">
								<?php while( $gallery->have_posts() ) : $gallery->the_post(); ?>
									<!-- Images -->
									<?php if ( has_post_thumbnail() ) {?> 
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('gallery-widget'); ?>
										</a>
									<?php } ?>
								<?php endwhile; wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</section>

			<?php endif; ?>
		<?php
	}
}
?>
