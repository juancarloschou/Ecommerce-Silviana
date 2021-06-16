<?php
/*
Template Name: Home Page
*/
get_header();?>
<?php $front_placement=get_theme_mod('front_placement') ; ?> 
<?php  if($front_placement=='slider') { get_template_part('home', 'slider'); } else if($front_placement=='banner') { get_template_part('front', 'banner');  }?>
<!--banner-->
<section id="content" class="wow fadeInUp">
  <div class="container">
    <div class="row">
      <?php 
	  $query_args = array(
      'post_type' => 'post',
      'posts_per_page' => 5,
      'order' => 'ASC'
     );
  // create a new instance of WP_Query
  $the_query = new WP_Query( $query_args );
  if ($the_query->have_posts() ) : ?>
      <article class="col-md-12">
        <div class="full-section wow fadeInUp">
          <?php while($the_query->have_posts()): $the_query->the_post(); 
                  get_template_part('template-parts/content', get_post_format() );
                 endwhile;
                 ?>
          <!--entry--> 
        </div>
        <!--full-section-->
      </article>
      <?php else: get_template_part('template-parts/content', 'none');  endif; ?>
    </div>
  </div>
</section>
<!--content-->
<?php get_footer(); ?>