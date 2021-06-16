<?php
// function for post meta
if ( ! function_exists( 'rambo_post_meta_content' ) ) :

function rambo_post_meta_content()
{ ?>
<div class="blog_section2_comment">
    <a href="<?php the_permalink(); ?>"><i class="fa fa-calendar icon-spacing"></i><?php the_time(get_option('date_format'));?></a>
    <a href="<?php the_permalink(); ?>"><i class="fa fa-comments icon-spacing"></i><?php comments_popup_link(__('leave a comment','rambo') ); ?></a>
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><i class="fa fa-user icon-spacing"></i> <?php _e("By",'rambo');?>&nbsp;<?php the_author();?></a>
</div>
<?php } endif; 
// check weither the function with the same name exsist or not
if(!function_exists( 'rambo_post_pagination' )) :

function rambo_post_pagination()
{
?>
<div class="pagination_section">	
		<div class="pagination text-center">
	 <ul>
		<?php
				// Previous/next page navigation.
				the_posts_pagination( array(
				'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
				'next_text'          => '<i class="fa fa-angle-double-right"></i>',
				) );
				?>
	</ul>
	</div>
</div>
<?php } endif; 
// this function fetch the post featured images also you can specify the class
if(!function_exists( 'rambo_post_thumbnail' )) :

function rambo_post_thumbnail($class){
$defalt_arg =array('class' => $class );
if(has_post_thumbnail()):?>
			<a  href="<?php the_permalink(); ?>" class="pull-left blog_pull_img2">
				<?php the_post_thumbnail('media-object', $defalt_arg); ?>
			</a>
			<?php endif;
} endif;

// This Function Check whether Sidebar active or Not
if(!function_exists( 'rambo_post_layout_class' )) :

function rambo_post_layout_class(){
if( is_active_sidebar('sidebar-primary')) echo "span8"; else echo "span12";
} endif;

//Call Permalink Exerpt 
if(!function_exists( 'rambo_post_parmalink_excerpt' )) :
 
function rambo_post_parmalink_excerpt(){ ?>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><?php the_excerpt();?></p><br>
<?php } endif; ?>