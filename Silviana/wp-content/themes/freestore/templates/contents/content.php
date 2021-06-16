<?php
/**
 * @package FreeStore
 */
$post_blog_layout = 'blog-post-standard-layout';
if ( get_theme_mod( 'freestore-blog-layout' ) ) {
    $post_blog_layout = get_theme_mod( 'freestore-blog-layout' );
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_blog_layout ); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink() ?>" class="post-loop-thumbnail">
		
		<?php
		if ( get_theme_mod( 'freestore-blog-layout' ) == 'blog-post-top-layout' ) {
            the_post_thumbnail( 'freestore_blog_img_top' );
        } else {
            the_post_thumbnail( 'freestore_blog_img_side' );
        } ?>
		
	</a>
	<?php endif; ?>
	
	<div class="post-loop-content">
		
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php freestore_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php if ( has_excerpt() ) : ?>
			
				<?php the_excerpt(); ?>
				
			<?php else : ?>
			
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'freestore' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>
				
			<?php endif; ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'freestore' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php freestore_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		
	</div>
	<div class="clearboth"></div>
	
</article><!-- #post-## -->