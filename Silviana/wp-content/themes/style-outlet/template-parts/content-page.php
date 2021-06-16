<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Style Outlet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			if( has_post_thumbnail() && ! post_password_required() ) :   
				the_post_thumbnail('style_outlet_blog_large_width'); 		
			endif;
			the_content(); ?>
    </div><!-- .entry-content --><?php

		wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'style-outlet' ),
				'after'  => '</div>',
			) );
		?>
	

	<?php if ( get_edit_post_link() ) : ?> 
		<footer class="entry-footer">
			<?php 
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'style-outlet' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
