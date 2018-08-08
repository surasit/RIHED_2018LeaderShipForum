<?php
/*
 * Plugin Name: Page
 * Plugin URI: http://www.wplook.com
 * Description: Add Page widget to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_pages_widget");'));
class wplook_pages_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_pages_widget',
			__( 'WPlook Page without Speakers (Home Page)', 'event-wpl' ),
			array( 'description' => __( 'A widget to displaying the page content without Speakers and Tickets', 'event-wpl' ), )
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
			$title = __( '', 'event-wpl' );
		}

		if( isset( $instance['page_id'] ) ) {
        $page_id = $instance['page_id'];
		} else {
		    $page_id = 0;
		} ?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('pages'); ?>"> <?php _e('Page:', 'event-wpl'); ?> </label>
				
				<?php
				$args = array(
				    'id' => $this->get_field_id('page_id'),
				    'name' => $this->get_field_name('page_id'),
				    'selected' => $page_id
				);
				wp_dropdown_pages( $args );
				?>
			</p>
			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>pagecontentclean</strong>', 'event-wpl'); ?></p>
			<br />
		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['page_id'] = sanitize_text_field($new_instance['page_id']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$page_id = isset( $instance['page_id'] ) ? esc_attr( $instance['page_id'] ) : '';
		
		?>
			<section id="<?php echo $this->id; ?>">	
				<div class="row">
					<div class="col-sm-12 col-md-2">
						<div class="section-header text-left">
							<h2><?php echo $title; ?></h2>
						</div>
					</div>
					<div class="col-sm-12 col-md-10">
						<?php $my_query = new WP_Query('page_id='.$page_id);
						while ($my_query->have_posts()) : $my_query->the_post();
							$do_not_duplicate = $post->ID;
							global $more;
							$more = 0; ?>
							
							<?php the_content(); ?>

						<?php endwhile; ?>
					</div>
				</div>
			</section>

		<?php
	}
}
?>
