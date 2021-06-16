<?php get_header(); ?>
  <section id="content" class="wow fadeInUp">
    <section class="container">
      <section class="error-404">
        <section class="error-header">
          <h2 class="error-title"><?php _e('PAGE YOU ARE LOOKING IS NOT FOUND', 'comley' ); ?></h2>
          <p class="error-text">
              <?php _e( ' THE PAGE YOU ARE LOOKING FOR DOES NOT EXIST. IT MAY HAVE BEEN MOVED, OR REMOVED ALTOGETHER. PERHAPS YOU CAN RETURN BACK TO THE SITES
 HOMEPAGE AND SEE IF YOU CAN FIND WHAT YOU ARE LOOKING FOR.', 'comley' ); ?></p>
          <a href="<?php echo esc_url(home_url()); ?>" class="btn"><?php _e('back to home page', 'comley' ); ?></a>
        </section>
      </section>
    </section>
  </section>
  <!--content-->
  <?php get_footer(); ?>