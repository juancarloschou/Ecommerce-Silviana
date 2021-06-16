<?php /*
 * Comments related functions - comments.php
 *
 * @package nirvana
 * @subpackage Functions
 */

if ( ! function_exists( 'nirvana_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own nirvana_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since nirvana 0.5
 */
function nirvana_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'nirvana' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'nirvana'), ' ' ); ?></p>
	<?php
		break;
		case '' :
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo "<div class='avatar-container' >".get_avatar( $comment, 60 )."</div>"; ?>
			<div class="comment-details">
				<?php printf(  '%s ', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php /* translators: 1: date, 2: time */
					printf(  '%1$s '.__('at', 'nirvana' ).' %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'nirvana' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</div> <!-- .comment-details -->
		</div><!-- .comment-author .vcard -->

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span class="comment-await"><em><?php _e( 'Your comment is awaiting moderation.', 'nirvana' ); ?></em></span>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="crycon-reply"></i>'.__('Reply','nirvana'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div>

	</div><!-- #comment-##  -->
	<?php
		break;
	endswitch;
} // nirvana_comment()
endif;

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since nirvana 0.5
 */
function nirvana_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
} // nirvana_remove_recent_comments_style()

add_action( 'widgets_init', 'nirvana_remove_recent_comments_style' );

if ( ! function_exists( 'nirvana_comments_on' ) ) :
/**
 * Number of comments on loop post if comments are enabled.
 */
function nirvana_comments_on() {
	global $nirvanas;
	if ( comments_open() && ! post_password_required() && $nirvanas['nirvana_blog_show']['comments'] && ! is_single()) :
		echo '<span class="comments-link">';
		comments_popup_link(
			'<i class="crycon-comments crycon-metas" title="' . __('Leave a comment', 'nirvana') . '"></i><b>0</b>',
			'<i class="crycon-comments crycon-metas" title="' .
				sprintf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'nirvana' ), number_format_i18n( get_comments_number() )) .
			 '"></i><b>1</b>',
			'<i class="crycon-comments crycon-metas" title="' .
				sprintf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'nirvana' ), number_format_i18n( get_comments_number() )) .
			'"></i><b>%</b>',
			'',
			'' );
		echo '</span>';          
	endif;
} // nirvana_comments_on()
endif;

/**
 * The number of comments title
 */
function nirvana_number_comments() { ?>
	<h3 id="comments-title">
		<span><?php  printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'nirvana' ),
				number_format_i18n( get_comments_number() )); ?>
		</span>
	</h3>
<?php
} // nirvana_number_comments()
add_action('cryout_before_comments_hook','nirvana_number_comments');

/**
 * The comments navigation in case of comments on multiple pages (both top and bottom)
 */
function nirvana_comments_navigation() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( '<i class="crycon-reply"></i>'.__('Older Comments', 'nirvana' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'nirvana' ).'<i class="crycon-forward"></i>' ); ?></div>
		</div> <!-- .navigation --><?php
	endif; // check for comment navigation
} // nirvana_comments_navigation()

//add_action('cryout_before_comments_hook','nirvana_comments_navigation');
add_action('cryout_after_comments_hook','nirvana_comments_navigation');

/*
* Listing the actual comments
*
* Loop through and list the comments. Tell wp_list_comments()
* to use nirvana_comment() to format the comments.
* If you want to overload this in a child theme then you can
* define nirvana_comment() and that will be used instead.
* See nirvana_comment() in nirvana/functions.php for more.
 */
function nirvana_list_comments() {
	wp_list_comments( array( 'callback' => 'nirvana_comment' ) );
} // nirvana_list_comments()
add_action('cryout_comments_hook','nirvana_list_comments');

/*
 * If there are no comments and comments are closed
 */
function nirvana_comments_off() {
	if ( ! comments_open() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'nirvana' ); ?></p>
	<?php endif; // end !comments_open()
} // nirvana_comments_off()
add_action('cryout_nocomments_hook','nirvana_comments_off');

/*
 * Edit comments form
 * Removing labels and adding them as placeholders
 */
function nirvana_comments_form($arg) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$arg =  array(
	'author' =>
		'<p class="comment-form-author"><label for="author">' . __( 'Name', 'nirvana' ) .  ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		'<input id="author" placeholder="'. __( 'Name*', 'nirvana' ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30"' . $aria_req . ' /></p>',

	'email' =>
		'<p class="comment-form-email"><label for="email">' . __( 'Email', 'nirvana' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		'<input id="email" placeholder="'. __( 'Email*', 'nirvana' ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		'" size="30"' . $aria_req . ' /></p>',

	'url' =>
		'<p class="comment-form-url"><label for="url">' . __( 'Website', 'nirvana' ) . '</label>' .
		'<input id="url" placeholder="'. __( 'Website', 'nirvana' ) .'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" /></p>',
	);

	return $arg;
} // nirvana_comments_form()
add_filter('comment_form_default_fields', 'nirvana_comments_form');


function nirvana_comments_form_textarea($arg) {
	$arg =
		'<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'nirvana' ) .
		'</label><textarea placeholder="'. _x( 'Comment', 'noun', 'nirvana' ) .'" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>';
	return $arg;
} // nirvana_comments_form_textarea()
add_filter('comment_form_field_comment', 'nirvana_comments_form_textarea');

?>
