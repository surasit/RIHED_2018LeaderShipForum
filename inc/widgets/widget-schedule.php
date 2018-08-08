<?php
/*
 * Plugin Name: Daily Schedule
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_schedule_widget");'));
class wplook_schedule_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_schedule_widget',
			__( 'WPlook Schedule (Home Page)', 'event-wpl' ),
			array( 'description' => __( 'A widget for displaying Schedules on home page', 'event-wpl' ), )
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
			$title = __( 'Schedule', 'event-wpl' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Schedules:', 'event-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
			</p>

			


			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>schedule</strong>', 'event-wpl'); ?></p>
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
			
			$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post_shedules',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					
				);

			$schedule = null;
			$schedule = new WP_Query( $args );
		?>

			<?php if( $schedule->have_posts() ) : ?>
		
			<section id="schedule" class="wow bounceInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
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
					<div class="col-sm-12">
						<div class="content-tabs">
							<ul class="nav nav-tabs">
								<?php if( $schedule->have_posts() ) : ?>
									<?php $count = 0; ?>
									<?php while ( $schedule->have_posts() ) : $schedule->the_post(); ?>
										<?php $count++; ?>
											<?php if ($count == 1) : ?>
												<li class="active"><a href="#tab<?php the_ID(); ?>" data-toggle="tab"><?php the_title() ?></a></li>
											<?php else : ?>
												<li><a href="#tab<?php the_ID(); ?>" data-toggle="tab"><?php the_title() ?></a></li>
											<?php endif; ?>

									<?php endwhile; wp_reset_postdata(); ?>
								<?php else : ?>
									<p><?php _e('Sorry, no aganda matched your criteria.', 'event-wpl'); ?></p>
								<?php endif; ?>
							</ul>

							<div class="tab-content">
							<?php if( $schedule->have_posts() ) : ?>
									<?php $count = 0; ?>
									<?php while ( $schedule->have_posts() ) : $schedule->the_post(); ?>
										<?php $count++; ?>
										<?php 
											$pid = $post->ID;
											$wpl_speech = get_post_meta($post->ID, 'wpl_speech', true);
										?>

										<?php if ($count == 1) : ?>

											<div class="tab-pane fade in active" id="tab<?php the_ID(); ?>">
												<ul class="accordion">
													<?php if ( ! empty( $wpl_speech ) ) {
													foreach( $wpl_speech as $item ) { ?>

														<li>
															<a class="accordion-heading">
																<!-- Agenda time -->
																<span class="schedule-time accent">
																	<?php echo $item['wpl_speech_start_time']; ?> - <?php echo $item['wpl_speech_end_time']; ?>
																</span>

																<!-- Speaker Avatar -->
																<?php if (isset($item["wpl_agenda_speaker"])) {
																	foreach( $item["wpl_agenda_speaker"] as $wpl_agenda_speaker ) { ?>

																		<div class="schedule-speaker">
																			<?php echo get_the_post_thumbnail( $wpl_agenda_speaker,'avatar-small',array('class' => 'large-2 right',)); ?>
																		</div>
																	<?php } 
																} ?>
																<!-- Accordeon Title -->
																<h4 class="accordion-title"><?php echo $item['wpl_speech_tematichs']; ?></h4>
															</a>
															<div class="accordion-body">
																<?php if ( $item['wpl_speech_short_desc'] ) { ?>
																	<p class="content">
																		<?php echo $item['wpl_speech_short_desc']; ?>
																	</p>
																<?php } ?>

																<?php if (isset($item["wpl_agenda_speaker"])) { ?>
																	<div class="schedule-speaker-list">
																		<b><?php _e('Speakers: ', 'event-wpl');?></b>
																		<?php foreach( $item["wpl_agenda_speaker"] as $wpl_agenda_speaker ) { ?>
																			<div class="schedule-speaker">
																				<?php echo get_the_post_thumbnail( $wpl_agenda_speaker,'avatar-small',array('class' => 'large-2 right',)); ?>
																				<h4><?php echo get_the_title($wpl_agenda_speaker);  ?></h4>
																			</div>
																		<?php } ?>
																	</div>
																<?php } ?>
															</div>
														</li>
													<?php }
												} ?>
												</ul>
											</div>
											
										<?php else : ?>

											<div class="tab-pane fade" id="tab<?php the_ID(); ?>">
												<ul class="accordion">
													<?php if ( ! empty( $wpl_speech ) ) {
													foreach( $wpl_speech as $item ) { ?>

														<li>
															<a class="accordion-heading">
																<!-- Agenda time -->
																<span class="schedule-time accent">
																	<?php echo $item['wpl_speech_start_time']; ?> - <?php echo $item['wpl_speech_end_time']; ?>
																</span>

																<!-- Speaker Avatar -->
																<?php if (isset($item["wpl_agenda_speaker"])) {
																	foreach( $item["wpl_agenda_speaker"] as $wpl_agenda_speaker ) { ?>

																		<div class="schedule-speaker">
																			<?php echo get_the_post_thumbnail( $wpl_agenda_speaker,'avatar-small',array('class' => 'large-2 right',)); ?>
																		</div>
																	<?php } 
																} ?>
																<!-- Accordeon Title -->
																<h4 class="accordion-title"><?php echo $item['wpl_speech_tematichs']; ?></h4>
															</a>
															<div class="accordion-body">
																<?php if ( $item['wpl_speech_short_desc'] ) { ?>
																	<p class="content">
																		<?php echo $item['wpl_speech_short_desc']; ?>
																	</p>
																<?php } ?>

																<?php if (isset($item["wpl_agenda_speaker"])) { ?>
																	<div class="schedule-speaker-list">
																		<b><?php _e('Speakers: ', 'event-wpl');?></b>
																		<?php foreach( $item["wpl_agenda_speaker"] as $wpl_agenda_speaker ) { ?>
																			<div class="schedule-speaker">
																				<?php echo get_the_post_thumbnail( $wpl_agenda_speaker,'avatar-small',array('class' => 'large-2 right',)); ?>
																				<h4><?php echo get_the_title($wpl_agenda_speaker);  ?></h4>
																			</div>
																		<?php } ?>
																	</div>
																<?php } ?>
															</div>
														</li>
													<?php }
												} ?>
												</ul>
											</div>

										<?php endif; ?>



								<?php endwhile; wp_reset_postdata(); ?>
								<?php else : ?>
									<p><?php _e('Sorry, no aganda matched your criteria.', 'event-wpl'); ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
					
			</section>

			<?php endif; ?>
		<?php
	}
}
?>
