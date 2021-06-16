<?php
/**
 * The default template for displaying content
 *
 * @package Cryout Creations
 * @subpackage Nirvana
 * @since Nirvana 1.0
 */

$nirvanas = nirvana_get_theme_options(); ?>
<?php cryout_before_article_hook(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( (( is_sticky() && is_page_template() )?'sticky':'') ); ?>>
				
		<header class="entry-header">			
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'nirvana' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php cryout_post_title_hook(); ?>
			<div class="entry-meta">
				<?php	cryout_post_meta_hook();  ?>
			</div><!-- .entry-meta -->	
		</header><!-- .entry-header -->
		
			<?php cryout_post_before_content_hook();  
			?><?php if ( is_archive() || is_search() || is_page() ) : // Display excerpts for archives, search and page templates ?>
			
						<?php if ($nirvanas['nirvana_excerptarchive'] != "Full Post" ){ ?>
						<div class="entry-summary">
						<?php nirvana_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nirvana' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }   ?>
			
		<?php else : 
				if (is_sticky() && $nirvanas['nirvana_excerptsticky'] == "Full Post")  $sticky_test=1; else $sticky_test=0;
				if ($nirvanas['nirvana_excerpthome'] != "Full Post" && $sticky_test==0){ ?>
					
					
						<div class="entry-summary">
						<?php nirvana_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary --> 
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nirvana' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }  

			endif; ?>

		<footer class="entry-meta">
			<?php cryout_post_after_content_hook();  ?>
		</footer>
	</article><!-- #post-<?php the_ID(); ?> -->
	
	
<?php cryout_after_article_hook(); ?>