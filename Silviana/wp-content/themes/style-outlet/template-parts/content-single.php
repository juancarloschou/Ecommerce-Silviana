<?php
/**
 * @package Style Outlet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"> 
		<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<span class="dd">				
						<i class="fa fa-calendar"></i><?php the_time(get_option('date_format')); ?></span>		
					<?php style_outlet_author(); ?> 
					<?php style_outlet_comments_meta(); ?> 
				</div><!-- .entry-meta -->
				<?php endif; ?>

			<br class="clear">
	</header><!-- .entry-header -->
<?php
	$single_featured_image = get_theme_mod( 'single_featured_image',true );
	$single_featured_image_size = get_theme_mod ('single_featured_image_size','1');
	if ( $single_featured_image &&  has_post_thumbnail() ) :
	    if ( $single_featured_image_size == '1' ) :?>
	 		<div class="post-thumb"><?php  
		 	    if( has_post_thumbnail() && ! post_password_required() ) :   
					the_post_thumbnail('style_outlet_blog_large_width'); 		
				endif;?>
			</div><?php
		else: ?>
		 	<div class="post-thumb"><?php
			 	if( has_post_thumbnail() && ! post_password_required() ) :   
						the_post_thumbnail('style_outlet_small_featured_image_width');
				endif;?>
			</div><?php
	    endif; 
	endif ?>



	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages: ', 'style-outlet' ),
			'after'  => '</div>',
		) );
	?>

	<?php style_outlet_post_nav(); ?>
</article><!-- #post-## -->
