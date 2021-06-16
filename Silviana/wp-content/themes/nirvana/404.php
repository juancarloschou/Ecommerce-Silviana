<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 0.5
 */

get_header(); ?>

	<div id="container" class="<?php echo nirvana_get_layout_class(); ?>">
	
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'nirvana' ); ?></h1>
				<div class="entry-content">
					<div class="contentsearch">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'nirvana' ); ?></p>
					<?php get_search_form(); ?>
					</div>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
<?php nirvana_get_sidebar(); ?>
	</div><!-- #container -->
<?php get_footer(); ?>