<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Pleasant Lite
 */

get_header(); ?>

<?php if ( is_front_page() && ! is_home() ) { ?>
	<?php
        $hidewelcomepage = get_theme_mod('disabled_welcomepage', '1');
        if( $hidewelcomepage == ''){
    ?>  
<section id="welcomesection">
  <div class="container">
    <div class="welcomebx">
      <?php if( get_theme_mod('page-setting1')) { ?>
      <?php $queryvar = new WP_query('page_id='.esc_attr(get_theme_mod('page-setting1' ,true))); ?>
      <?php while( $queryvar->have_posts() ) : $queryvar->the_post();?>     
      <h2 class="headingtitle">
        <?php the_title(); ?>
      </h2>
      <p><?php echo wp_trim_words( get_the_content(), 50, '...' );  ?></p>   
      <div class="clear"></div>
       <?php endwhile; 
			 wp_reset_postdata();
		} ?>
    </div> <!-- welcomewrap-->
    <div class="clear"></div>
  </div> <!-- container -->
</section>
<?php } ?> 

<?php
	$hidepageboxes = get_theme_mod('disabled_pgboxes', '1');
	if( $hidepageboxes == ''){
?>  
<section id="wrapsecond">
  <div class="container">
    <div class="services-wrap">
      <?php for($p=1; $p<5; $p++) { ?>
      <?php if( get_theme_mod('page-column'.$p,false)) { ?>
      <?php $queryvar = new WP_query('page_id='.esc_attr(get_theme_mod('page-column'.$p,true))); ?>
      <?php while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>
      <div class="fourbox <?php if($p % 4 == 0) { echo "last_column"; } ?>">
          <?php if(has_post_thumbnail() ) { ?>
           <div class="thumbbx"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?> </a></div> 
          <?php } ?> 
           <div class="pagecontent">          
                <h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3> 
                <p><?php echo wp_trim_words( get_the_content(), 20, '...' );  ?></p>   
                 <a class="pagemore" href="<?php the_permalink(); ?>">
                 <?php _e('Read More','pleasant-lite'); ?>
                </a>
           </div>
        </div>
      <?php endwhile;
            wp_reset_postdata(); ?>                                    
      <?php } } ?> 
      <div class="clear"></div>
    </div><!-- services-wrap-->
  </div><!-- container -->
</section>
<?php } ?>
<?php } ?>

<div class="container">
      <div class="page_content">
    		 <section class="site-main">               
            		<?php while( have_posts() ) : the_post(); ?>                               
						<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>                               
                    <?php endwhile; ?>                     
            </section><!-- section-->   
     <?php get_sidebar();?>      
    <div class="clear"></div>
    </div><!-- .page_content --> 
 </div><!-- .container --> 
<?php get_footer(); ?>