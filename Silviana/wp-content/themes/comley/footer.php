<footer>
  <section class="container"> <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="ftr_logo">
   <a href="<?php echo esc_url(home_url('/')); ?>">
      <?php if(function_exists( 'the_custom_logo')): if(has_custom_logo()): 
	  the_custom_logo();
	  else : if(display_header_text()): ?>
      <h1>
        <?php bloginfo('name'); ?>
      </h1>
      <p><?php bloginfo('description'); ?></p>
      <?php endif; endif; else : if(display_header_text()): ?>
      <h1>
        <?php bloginfo('name'); ?>
      </h1>
      <p><?php bloginfo('description'); ?></p>
      <?php endif; endif; ?>
      </a> 
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="ftr-right"> 
    <p><a href="#" class="scrollToTop"><?php _e('BACK TO TOP', 'comley'); ?></a></p>
     <?php if (get_theme_mod('hide_copyright')) :  else : ?>
       <?php if (get_theme_mod('copyright_textbox')) : ?> 
          <p><?php echo esc_html(get_theme_mod('copyright_textbox')); ?></p>
            <?php endif; ?>
            <?php endif; ?>
   </div><!--ftr-right-->
      <!--ftr-social--> 
    </div>
  </div>
</section>
</footer>
</div>
<?php wp_footer(); ?>
</body></html>