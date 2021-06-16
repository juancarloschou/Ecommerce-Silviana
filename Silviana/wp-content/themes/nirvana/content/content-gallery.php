<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Cryout Creations
 * @subpackage Nirvana
 * @since Nirvana 1.1
 */

$nirvanas = nirvana_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
			<h2 class="entry-title"><span class="entry-format"><i class="crycon-gallery" title="<?php _e( 'Gallery', 'nirvana' ); ?>"></i></span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nirvana' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php cryout_post_title_hook(); ?>
		<div class="entry-meta">
			<?php	cryout_post_meta_hook();  ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<?php cryout_post_before_content_hook();
	?><?php if ( is_search() ) : // Only display Excerpts for search pages ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
				<?php
				$images = nirvana_get_gallery_images();
				if ( $images ) :
				$total_images = count( $images );
				$image = array_shift( $images );

				if (is_sticky() && $nirvanas['nirvana_excerptsticky'] == "Full Post")  $sticky_test=1; else $sticky_test=0;
				if ($nirvanas['nirvana_excerpthome'] != "Full Post" && $sticky_test==0):
					nirvana_set_featured_thumb();
				?>
					<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'nirvana' ),
						'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'nirvana' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						number_format_i18n( $total_images )
					); ?></em></p>
				<?php
					the_excerpt();
				else:
				    the_content();
				endif; ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nirvana' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
		<footer class="entry-meta">
			<?php cryout_post_after_content_hook();  ?>
		</footer>
</article><!-- #post-<?php the_ID(); ?> -->
