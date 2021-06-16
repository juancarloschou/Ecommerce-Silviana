<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Style Outlet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="title-meta">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<span class="dd">				
					<i class="fa fa-calendar"></i>	<?php the_time(get_option('date_format')); ?></span>		
				<?php style_outlet_author(); ?> 
				<?php style_outlet_comments_meta(); ?> 
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</div>
		<br class="clear">
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary --> 

</article><!-- #post-## -->
