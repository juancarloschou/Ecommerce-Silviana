<div class="flexslider">
  <ul class="slides">
  <?php
  $slider_posts_cat=get_theme_mod('slider_category');
  $query_args = array(
      'cat' => $slider_posts_cat,
	  'post_type' => 'post',
      'posts_per_page' =>-1,'order'=>'DESC');
	   $slider_query = new WP_Query($query_args);
       if ($slider_query->have_posts() ) : while ($slider_query->have_posts()): $slider_query->the_post();
	   $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); 
	   $thumbnailURL = $image_url[0]; 
	  ?>
      <li>
      <div class="slider-image" style=" <?php if($thumbnailURL){ ?>background-image:url<?php echo esc_url($thumbnailURL); ?><?php } else{?>background-image:url(<?php echo get_template_directory_uri ();?>/images/slide.jpg);<?php }?>"></div>
   <?php if($thumbnailURL){?>
      <img src="<?php echo esc_url($thumbnailURL); ?>" alt=""/>
   <?php }else{ ?>
    <img src="<?php echo get_template_directory_uri ();?>/images/slide.jpg" alt=""/>
    <?php }?>
      <div class="flex-caption">
        <h2 class="banner-title"><?php the_title(); ?></h2>
        <h3 class="banner-description"><?php the_excerpt(); ?></h3>
      </div>
    </li>
    <?php endwhile; endif; ?>
  </ul>
</div>