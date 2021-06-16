<?php
/**
 * Custom template tags for Comley
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Comley
 * @since Comley 1.0
 */
define('COMLEY_POST_CONTENT_LENGTH', 100);
// Custom Excerpt 
function excerpt($limit) {
$excerpt = explode(' ', get_the_excerpt(), $limit);
if (count($excerpt)>=$limit) {
array_pop($excerpt);
$excerpt = implode(" ",$excerpt).'...';
} else {
$excerpt = implode(" ",$excerpt);
} 
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
return $excerpt;
}
if(!function_exists('comley_comment_nav')) :
function comley_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
    <nav class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'comley'); ?></h2>
        <div class="nav-links">
            <?php
                if ( $prev_link = get_previous_comments_link(__('Older Comments', 'comley'))):
                    printf( '<div class="nav-previous">%s</div>', $prev_link );
                endif;
 
                if ( $next_link = get_next_comments_link(__('Newer Comments', 'comley'))) :
                    printf('<div class="nav-next">%s</div>', $next_link);
                endif;
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .comment-navigation -->
    <?php
    endif;
}
endif;
if (!function_exists( 'comley_post_thumbnail')) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Comley 1.0
 */
 function comley_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail()) {
		return;
		//echo '<img src="' . get_stylesheet_directory_uri() . '/images/no_image_available.jpg" alt="'.get_the_title().'" >';
	}
	if ( is_singular() ) :
	?>
	<div class="entry-summary">
		<?php the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title())); ?>
	</div><!-- .post-thumbnail -->
	<?php else : ?>
	<a href="<?php the_permalink(); ?>">
		<?php
			the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title()));
		?>
	</a>
	<?php endif; // End is_singular()
}
endif;
if(!function_exists( 'comley_post_title')) :     
    function comley_post_title()
    {
      if ( is_single() ) :
 ?>
          <?php the_title(); ?>
          <?php else: ?>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php endif;    
    }    
endif;
function comley_excerpt_length($length) {
  return COMLEY_POST_CONTENT_LENGTH;
}
function comley_remove_more_link_scroll( $link ) {
  $link = preg_replace( '|#more-[0-9]+|', '', $link );
  return $link;
}
add_filter( 'the_content_more_link', 'comley_remove_more_link_scroll' );
function comley_excerpt_more($more) {
  return '';
}
add_filter('excerpt_length', 'comley_excerpt_length');
add_filter('excerpt_more', 'comley_excerpt_more');
/* Start tribute front page setting */
function comley_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'comley_front_page_template' );
/* End tribute front page setting */
function comley_author_bio( $content ) {
  global $post;
	if ( is_single() && isset( $post->post_author ) ) {
		$display_name = get_the_author_meta( 'display_name', $post->post_author );
		if ( empty( $display_name ) )
			$display_name = get_the_author_meta( 'nickname', $post->post_author );
		$user_description = get_the_author_meta( 'user_description', $post->post_author );
		if ( ! empty($display_name ))
			$author_details = '<p class="author_name">About ' . $display_name . '</p>';
		if ( ! empty( $user_description ) )
			$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';
		$content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
	}
	return $content;
}
// executes the 'uniqueprefix_author_bio' function below the post content
add_action( 'the_content', 'comley_author_bio' );
?>