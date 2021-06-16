<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Comley
 * @since Comley 1.0
 */
 if(get_theme_mod('blog_posts_layouts')=='gridlayout' && get_theme_mod('blog_layouts')=='blogwithrightsidebar'){
	$classes = array(
		'col-md-6',
		'col-sm-6',
		'col-xs-12',
		'blog-col'
	);
}elseif(get_theme_mod('blog_posts_layouts')=='gridlayout' && get_theme_mod('blog_layouts')=='blogwithleftsidebar'){
	$classes = array(
		'col-md-6',
		'col-sm-6',
		'col-xs-12',
		'blog-col'
	);
}elseif(get_theme_mod('blog_posts_layouts')=='gridlayout')
{
	$classes = array(
		'col-md-6',
		'col-sm-6',
		'col-xs-12',
		'blog-col'
	);
	
}else 
{
	$classes='';
}
?>
<?php if(get_theme_mod('blog_layouts')=='blogfullwidth'){
	$listclassimage='col-md-5 col-sm-5';
	$listclasstext='col-md-7 col-sm-7';
	
}
else
{
	$listclassimage='col-md-6 col-sm-6';
	$listclasstext='col-md-6 col-sm-6';
}
?>
<div id="post-<?php the_ID(); ?>" <?php  post_class($classes); ?>>
<article class="<?php echo $listclassimage;?> col-xs-12">
<div class="entry-summary wow fadeInUp">
<?php if(has_post_thumbnail()): ?>
    <?php the_post_thumbnail('comley-post-thumbnails'); ?>
    <?php endif; ?>
  </div>
        </article>
         <article class="<?php echo $listclasstext;?> col-xs-12">
         <header class="entry-header wow fadeInUp">
    <h1 class="entry-title">
      <?php comley_post_title(); ?>
    </h1>
    <div class="entry-meta">  <?php _e('by', 'comley'); ?> 
      <?php the_author_posts_link() ?>
     <?php the_time('l,F j, Y') ?>
    </div>    
    <!--entry-meta--> 
	<p><?php echo esc_html(substr(get_the_excerpt(), 0,100)); ?></p>
	<?php echo '<a class="btn btn-default" href="'.esc_url(get_permalink()).'">'.__('Continue Reading', 'comley').'</a>'; ?>   
  </header>  
</article>
</div>
<!--entry--> 