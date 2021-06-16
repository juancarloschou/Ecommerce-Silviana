<?php get_header(); ?> 
    <section id="content" class="wow fadeInUp">
    <div class="container">
      <div class="row">
      <?php if(have_posts()): ?>
      <article class="col-md-8 col-sm-8 col-xs-12">
      <?php
	 // Start the loop.
		while ( have_posts() ) : the_post();
			// Include the page content template.
			get_template_part('template-parts/content', 'page' );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		// End the loop.
		endwhile;
        wp_link_pages( array(
			  'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'comley' ) . '</span>',
			  'after'       => '</div>',
			  'link_before' => '<span>',
			  'link_after'  => '</span>',
		   ));
     ?>
          <!--left-section--> 
        </article>
        <?php else: get_template_part('template-parts/content', 'none');  endif; ?>
        <aside class="col-md-4 col-sm-4 col-xs-12">
        <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
  </section>
  <!--content-->
  <?php get_footer(); ?>