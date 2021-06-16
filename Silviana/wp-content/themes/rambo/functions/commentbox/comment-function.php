<?php
// code for comment
if ( ! function_exists( 'rambo_comment' ) ) :

function rambo_comment( $comment, $args, $depth ) 
{
	$GLOBALS['comment'] = $comment;

	//get theme data
	global $comment_data;

	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	__('Reply','rambo');?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body <?php if ($comment->comment_approved == '0') echo 'pending-comment'; ?> clearfix">
          <div class="media comment_box">
			<a class="pull-left">
            <?php echo get_avatar($comment,$size = '65'); ?>
            </a>
			<div class="media-body">
            <div class="blog_single_post_content">
			<h4 class="blog_single_post_heading"><?php printf(('%s'), get_comment_author_link()) ?> <small> | </small>
			<span><?php comment_time('M j,Y');?></span>
			<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    	    </div>
			</h4>
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','rambo'); ?></em>
			<br/>
			<?php endif; ?>
    	    <p><?php comment_text() ;?></p><!-- /comment-text -->
    	    </div><!-- /comment-content -->
			</div>
			
		  </div><!-- /comment-details -->
<?php
}
endif;
add_filter('get_avatar','rambo_add_gravatar_class');

function rambo_add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-circle", $class);
    return $class;
}
?>