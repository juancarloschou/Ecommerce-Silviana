<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Style Outlet
 */

get_header(); 
get_template_part( 'template-parts/breadcrumb' ); ?>

<div id="content" class="site-content">
	<div class="container">
        <?php $sidebar_position = get_theme_mod( 'sidebar_position', 'right' ); ?>
		<?php if( 'left' == $sidebar_position ) :?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main <?php style_outlet_layout_class(); ?> columns" role="main">
 
		<?php
		if ( have_posts() ) : ?>

			<header class="entry-header">
				<h1 class="entry-title"><span><?php printf( esc_html__( 'Search Results for: %s', 'style-outlet' ), get_search_query() ); ?></span></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;?>

			<?php 
				if(  get_theme_mod ('numeric_pagination',true)  ) : 
						the_posts_pagination();
					else :
						style_outlet_post_nav();     
					endif; 
			?>

			<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php if( 'right' == $sidebar_position ) :?>
			<?php get_sidebar(); ?>
	<?php endif; ?>
<?php get_footer();?>