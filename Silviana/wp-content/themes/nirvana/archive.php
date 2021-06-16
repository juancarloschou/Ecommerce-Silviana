<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
					<h1 class="page-title"><div class="page-title-text">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'nirvana' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'nirvana' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'nirvana' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'nirvana' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'nirvana' ) ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'nirvana' ); ?>
						<?php endif; ?>
					</div></h1>
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