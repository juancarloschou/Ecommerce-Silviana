<?php get_header(); ?>     
    <section id="content" class="wow fadeInUp">
    <div class="container">
      <div class="row"><article class="col-md-8 col-sm-8 col-xs-12">              
             <?php  if ( have_posts() ) : 
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part('template-parts/content', 'search');
			// End the loop.
			endwhile;
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'comley' ),
				'next_text'          => __( 'Next page', 'comley' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'comley' ) . ' </span>',
			) );
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>              
          <!--left-section-->          
        </article>
        <aside class="col-md-4 col-sm-4 col-xs-12">
        <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
  </section>
  <!--content-->
  <?php get_footer(); ?>