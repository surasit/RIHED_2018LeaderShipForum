<?php 
/**
 * Comments List for page/post/image
 *
 * @package WPlook
 * @subpackage Event
 * @since Event 1.0
*/

if ( ! function_exists( 'wplook_comment' ) ) :

function wplook_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-box">
			<div class="comment-author">
				<?php echo get_avatar( $comment, 80 ); ?>
			</div>
			<div class="comment-body">
				<div class="comment-author-info">
					<a href="#" rel="external nofollow" class="comment-author-name"><?php echo get_the_author(); ?></a>
					<span class="comment-meta"><?php echo get_comment_date() ?> @ <?php echo get_comment_time() ?></span>
					<a class="comment-reply-link" href=""><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></a>
				</div>
				<div class="entry-comment">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="comment-awaiting-moderation">
						<?php _e( 'Your comment is awaiting moderation.', 'event-wpl' ); ?>
					</div>
					<br />
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
			</div>
		</div>
	</li>


<?php
	break;
	case 'pingback' :
	case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="trackback-<?php comment_ID(); ?>">
		<div class="row">
			<div class="columns small-3 medium-2 large-2 comment-gravatar">
				<img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=identicon&s=50">
			</div>
			<div class="columns small-9 medium-10 large-10">
				<div class="row">
					<div class="columns small-12 medium-6 large-6">
						<h3 class="comment-author"><?php _e( 'Pingback/Trackback', 'event-wpl' ); ?></h3> 
					</div>
					<div class="columns small-12 medium-6 large-6">
						<p class="text-right">
							<span class="comment-date fleft"><?php echo get_comment_date() ?> @ <?php echo get_comment_time() ?></span>
							<a class="comment-reply-link" href=""><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></a>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="columns small-12 medium-12 large-12 comment-body">
						<div class="entry-content">
							<?php if ( $comment->comment_approved == '0' ) : ?>
							<div class="comment-awaiting-moderation">
								<?php _e( 'Your comment is awaiting moderation.', 'event-wpl' ); ?>
							</div>
							<br />
							<?php endif; ?>
							<?php comment_author_link(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</li>
	
<?php break; 	endswitch; 
} endif; ?>
<?php
// create new comment form
// Credits: http://snipplr.com
function wplook_comment_form( $args = array(), $post_id = null ) {
	global $user_identity, $id;
	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(

		'author' => '<div class="half-row">' . '<span for="author">' . __( 'Name', 'event-wpl' ) . '</span> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="author" placeholder="Name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email'  => '<div class="half-row"><span for="email">' . __( 'Email', 'event-wpl' ) . '</span> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
		'url'    => '<div class="comment-form-url"><span for="url">' . __( 'Website', 'event-wpl' ) . '</span>' .
		'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
	);
	$required_text = sprintf( ' ' . __('Required fields are marked %s', 'event-wpl' ), '<span class="required"><a>*</a></span>' );
	$defaults = array(
		'fields'		=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'		=> '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'event-wpl' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'		=> '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'event-wpl' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'		=> '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'event-wpl' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'event-wpl' ) . ( $req ? $required_text : '' ) . '</p>',
		'id_form'						=> 'commentform',
		'id_submit'					=> 'submit',
		'title_reply'				=> __( 'Leave a Comment', 'event-wpl' ),
		'title_reply_to'		=> __( 'Leave a Reply to %s', 'event-wpl' ),
		'cancel_reply_link'	=> __( 'or Cancel reply', 'event-wpl' ),
		'label_submit'			=> __( 'Send Comment', 'event-wpl' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond">
				<header class="page-header"><h3 class="block-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?>   <?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></h3></header>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo $args['comment_notes_before']; ?>
								<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
							do_action( 'comment_form_after_fields' );
							?>
							<?php endif; ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							<?php //echo $args['comment_notes_after']; ?>
								<input class="button button-active" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
								<?php comment_id_fields(); ?>
							<?php do_action( 'comment_form', $post_id ); ?>
						</ul>	
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}
