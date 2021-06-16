<?php get_header(); ?>
<!--banner-->
<section id="content" class="wow fadeInUp">
  <div class="container">
    <div class="row">
    <?php if(get_theme_mod('blog_layouts') && get_theme_mod('blog_layouts')=='blogwithleftsidebar'): ?>
    <aside class="col-md-4 col-sm-4 col-xs-12 leftbar">
        <?php get_sidebar(); ?>
        </aside>
        <?php endif; ?>
      <?php if ( have_posts() ) : ?>
      <?php if(get_theme_mod('blog_layouts') && get_theme_mod('blog_layouts')=='blogfullwidth'): ?>
      <article class="col-md-12 col-sm-12 col-xs-12">
      <?php else : ?>
      <article class="col-md-8 col-sm-8 col-xs-12">
      <?php endif; ?>
        <div class="left-section wow fadeInUp">
          <?php while(have_posts()): the_post(); 
                  get_template_part('template-parts/content', get_post_format() );
                  endwhile;
          ?>
          <!--entry--> 
        </div>
        <!--full-section-->
        <nav class="pagination wow fadeInUp">
          <div class="alignleft">
            <?php previous_posts_link(__('previous','comley')); ?>
          </div>
          <div class="alignright">
            <?php next_posts_link(__('next','comley')); ?>
          </div>
        </nav>
      </article>
     <?php else: get_template_part('template-parts/content', 'none'); endif; if(get_theme_mod('blog_layouts')=='blogwithrightsidebar') { ?>
       <aside class="col-md-4 col-sm-4 col-xs-12">
        <?php get_sidebar(); ?>
      </aside>
      <?php }else if(get_theme_mod('blog_layouts')=='blogfullwidth'){}else { ?>
      <aside class="col-md-4 col-sm-4 col-xs-12">
        <?php get_sidebar(); ?>
      </aside>
      <?php } ?>
    </div>
  </div>
</section>
<!--content-->
<?php get_footer(); ?>