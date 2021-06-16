<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Cryout Creations
 * @subpackage Nirvana
 * @since Nirvana 1.0
 */

get_header(); ?>

		<section id="container" class="<?php echo nirvana_get_layout_class(); ?>">
			<div id="content" role="main">
			<?php cryout_before_content_hook(); ?>
			
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><div class="page-title-text"><?php
						printf( __( 'Category Archives: %s', 'nirvana' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></div></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content/content', get_post_format() );
					?>

				<?php endwhile; ?>

					<?php if($nirvanas['nirvana_pagination']=="Enable") nirvana_pagination(); else nirvana_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'nirvana' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'nirvana' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
			
			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
		<?php nirvana_get_sidebar(); ?>
		</section><!-- #primary -->

<?php get_footer(); ?>
