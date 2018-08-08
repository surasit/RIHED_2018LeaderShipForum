<?php
/*
 * Plugin Name: Recent Tickets
 * Plugin URI: http://www.wplook.com
 * Description: Add latest tickets to home page.
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_tickets_widget");'));
class wplook_tickets_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_tickets_widget',
			__( 'WPlook Tickets (Home Page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying Tickets', 'event-wpl' ), )
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
			$title = __( 'Tickets', 'event-wpl' );
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
			$nr_columns = esc_attr( $instance[ 'nr_columns' ] );
		}
		else {
			$nr_columns = __( '3', 'event-wpl' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Tickets:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The Number of Tickets you want to display', 'event-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_columns'); ?>"> <?php _e('Number of Columns:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_columns'); ?>" name="<?php echo $this->get_field_name('nr_columns'); ?>" type="text" value="<?php echo $nr_columns; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The Number of Columns you want to display. Ex: for 4 columns, 12/4=3', 'event-wpl'); ?></p>
			</p>


			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>tickets</strong>', 'event-wpl'); ?></p>
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
		$instance['nr_columns'] = sanitize_text_field($new_instance['nr_columns']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$nr_columns = isset( $instance['nr_columns'] ) ? esc_attr( $instance['nr_columns'] ) : '';
		$subtitle = apply_filters( 'widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance );
			
			$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post_tickets',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					
				);

			$tickets = null;
			$tickets = new WP_Query( $args );
		?>

			<?php if( $tickets->have_posts() ) : ?>
				<!-- Buy tickets -->
				<section id="tickets" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
					<div class="row">
						<div class="col-sm-12">
							<div class="section-header text-left">
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
								
						<?php while( $tickets->have_posts() ) : $tickets->the_post(); ?>
							<?php
								$pid = $post->ID;
								$ticket_price = get_post_meta( $pid, 'wpl_ticket_price', true);
								$eventbride_url = get_post_meta( $pid, 'wpl_eventbride_url', true);
								$tickets_options = get_post_meta($post->ID, 'wpl_tickets_options', true);
								$highlight_ticket = get_post_meta($post->ID, 'wpl_highlight_ticket', true);

							?>
							<div class="col-sm-6 col-md-<?php echo $nr_columns; ?>">
								<div class="pricing-table <?php if ( $highlight_ticket == 'on'){ echo "highlight";} ?>">
									<div class="table-header">
										<!-- Ticket Title -->
										<h3><?php the_title(); ?></h3>

										<!-- Ticket price -->
										<?php if ($ticket_price) { ?>
											<b class="accent"><?php echo $ticket_price; ?> <sup><?php echo ot_get_option('wpl_curency_code') ?></sup></b>
										<?php } ?>
									</div>
									<ul class="table-features">
										<!-- Share items -->
										<?php if ( ! empty( $tickets_options ) ) {
											foreach( $tickets_options as $item ) { ?>
												<li <?php if ( $item['wpl_ticekt_option_active'] =='on') { echo "class='on'"; } ?>> <?php echo $item['wpl_ticekt_option_title']; ?></li>
											<?php }
										} ?>


										<?php if ($eventbride_url) { ?>
											<li class="buy-eventbride"><a href="<?php echo $eventbride_url; ?>"><?php _e('Buy Ticket', 'event-wpl'); ?></a></li>
										<?php } else { ?>
										<li class="buy-tickets">

											<form class="buy" action="<?php echo get_template_directory_uri() ?>/inc/paypal/buy.php" method="post">
												<label>
													<input name="price" type="hidden" value="<?php echo $ticket_price; ?>">
												</label>
												<label>
													<input name="ticket" type="hidden" value="<?php echo get_the_ID(); ?>|#| <?php the_title(); ?>">
												</label>
												<label class="btn_buy_ticket">
													<input class="buy-ticket button" value="<?php _e('Buy ticket', 'event-wpl'); ?>" type="submit">
												</label>
												<label>
													<input type="hidden" name="submitted" value="true">
												</label>
											</form>
										</li>	

									<?php } ?>

									</ul>
								</div>
							</div>

						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</section>

			<?php endif; ?>
		<?php
	}
}
?>
