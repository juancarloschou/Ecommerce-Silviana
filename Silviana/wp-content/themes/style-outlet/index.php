<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Style Outlet
 */

get_header(); ?>

<div id="content" class="site-content"> 
	<div class="container">

	<?php $sidebar_position = get_theme_mod( 'sidebar_position', 'right' ); ?>
		<?php if( 'left' == $sidebar_position ) :?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

		<div id="primary" class="content-area <?php style_outlet_layout_class(); ?>  columns">
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
					
				if(  get_theme_mod ('numeric_pagination',true) ) : 
						the_posts_pagination();
				else :
					style_outlet_post_nav();     
				endif; 
			?>

			<?php else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php if( 'right' == $sidebar_position ) :?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		
<?php get_footer(); ?>  