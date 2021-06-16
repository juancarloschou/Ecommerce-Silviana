<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'rambo' ); ?>
	</p>
	<?php return;endif;?>
         <?php if ( have_comments() ) : ?>
		<div class="comment_mn">
			<div class="blog_single_post_head_title">
			<h3><?php _e('Comments','rambo');?></h3>
			</div>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
		
			<nav id="comment-nav-above">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'rambo' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'rambo' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'rambo' ) ); ?></div>
			</nav>
			<?php endif;  ?>
		
		<?php wp_list_comments( array( 'callback' => 'rambo_comment' ) ); ?>
		</div><!-- comment_mn -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'rambo' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'rambo' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'rambo' ) ); ?></div>
		</nav>
		<?php endif;  ?>
		<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : 
        _e("Comments are closed",'rambo');?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php echo sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment','rambo' ), site_url( 'wp-login.php' ) . '?redirect_to=' .  urlencode(get_permalink())); ?></p>
<?php else : ?>

<div class="comment_section">

<?php  
 $fields=array(
    'author' => '<label>Name<span>*</span></label>
				<input class="span9 leave_comment_field" name="author" id="author" type="text"/><br/><br/>',
    'email'  => '<label>Email<span>*</span></label>
	<input class="span9 leave_comment_field" name="email" id="email" type="text" ><br/><br/>',
	'website'=>	'<label>Website</label>
	<input class="span9 leave_comment_field" name="website" id="website" type="text" ><br/><br/>',
	);
 
function my_fields($fields) {
 
	return $fields;
}
add_filter('comment_form_default_fields','my_fields');
 
	$defaults = array(
     'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'comment_field'        => '<label>Comment<span>*</span></label>
	<textarea id="comments" rows="7" class="span12 leave_comment_field" name="comment" type="text"></textarea>',		
	 'logged_in_as' => '<p class="logged-in-as">' . __("Logged in as",'rambo').' '.'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="Logout of this account">'.' '.__("Logout",'rambo').'</a>' . '</p>',
	 'id_submit'            => 'comment_btn',
	'label_submit'         =>__('Send Message','rambo'),
	'comment_notes_after'  => '',
	 'title_reply'       => '<div class="blog_single_post_head_title"><h3>'.__('Leave a Reply','rambo').'</h3></div>',
	 'id_form'      => 'action'
	);
comment_form($defaults);?>
					
</div><!-- leave_comment_mn -->

<?php endif; // If registration required and not logged in ?>

<?php endif;  ?>