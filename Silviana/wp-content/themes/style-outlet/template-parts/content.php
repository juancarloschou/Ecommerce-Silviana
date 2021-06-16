<?php
/**
 * @package Style Outlet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		$featured_image = get_theme_mod( 'featured_image',true );
	    $featured_image_size = get_theme_mod ('featured_image_size','1');
		if( $featured_image && has_post_thumbnail() ) : 
		        if ( $featured_image_size == '1' ) :?>		
						<div class="post-thumb">
						  <?php	if( $featured_image && has_post_thumbnail() ) : 
								    the_post_thumbnail('style_outlet_blog_large_width');
								 
			                     endif;?>
			            </div> <?php
		        else: ?>
		 	            <div class="post-thumb">
		 	                 <?php if( has_post_thumbnail() && ! post_password_required() ) :   
					               the_post_thumbnail('style_outlet_small_featured_image_width');
								
								endif;?>
			             </div>  <?php				 
	            endif; 
		endif; ?> 
 
		<header class="entry-header">  
			<div class="title-meta">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<span class="dd">				
						<i class="fa fa-calendar"></i><?php the_time(get_option('date_format')); ?></span>		
					<?php style_outlet_author(); ?> 
					<?php style_outlet_comments_meta(); ?> 
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</div>
			<br class="clear">
	   </header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Read More', 'style-outlet' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>
		</div><!-- .entry-content -->


			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages: ', 'style-outlet' ),
					'after'  => '</div>',
				) );
			?>

</article><!-- #post-## -->