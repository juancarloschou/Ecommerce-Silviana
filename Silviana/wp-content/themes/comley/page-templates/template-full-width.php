<?php
/*
Template Name: Full Width Page
*/
get_header(); ?>    
    <section id="content" class="wow fadeInUp">
    <section class="container">
          <?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			// Include the page content template.
			get_template_part('template-parts/content', 'page');
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		// End the loop.
		endwhile;
		?>
<?php wp_link_pages( array(
	'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'comley' ) . '</span>',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
	) );
?>
    </section>
  </section>
  <!--content-->
  <?php get_footer(); ?>