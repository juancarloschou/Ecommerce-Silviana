<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Beautiplus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="pageholder">
<div class="header <?php if( !is_front_page() && !is_home() ){ ?>headerinner<?php } ?>">
        <div class="container">
            <div class="logo">
            			<?php beautiplus_the_custom_logo(); ?>
                        <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                         <?php $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <span><?php echo $description; ?></span>
                <?php endif; ?>       
            </div><!-- logo -->
         </div><!-- container --> 
         <div id="mainnavigation">
             <div class="container">
             <div class="toggle">
                <a class="toggleMenu" href="<?php echo esc_url('#');?>"><?php _e('Menu','beautiplus'); ?></a>
             </div><!-- toggle --> 
            
            <div class="sitenav">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </div><!-- site-nav -->            
            <div class="clear"></div>            
         </div><!-- container -->
        </div><!-- #mainnavigation -->
  </div><!--.header -->

<?php if ( is_front_page() && !is_home() ) { ?>
	<?php $hideslide = get_theme_mod('disabled_slides', '1'); ?>
		<?php if($hideslide == ''){ ?>
              <?php for($sld=7; $sld<10; $sld++) { ?>
                	<?php if( get_theme_mod('page-setting'.$sld)) { ?>
                	<?php $slidequery = new WP_query('page_id='.esc_attr( get_theme_mod('page-setting'.$sld,true))); ?>
                	<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
                			$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                			$img_arr[] = $image;
               				$id_arr[] = $post->ID;
                		endwhile; 
						wp_reset_postdata();
                	}
                }
                ?>
<?php if(!empty($id_arr)){ ?>
        <div id="slider" class="nivoSlider">
            <?php 
            $i=1;
            foreach($img_arr as $url){ ?>
            <?php if(!empty($url)){ ?>
            <img src="<?php echo $url; ?>" title="#slidecaption<?php echo $i; ?>" />
            <?php }else{ ?>
            <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo $i; ?>" />
            <?php } ?>
            <?php $i++; }  ?>
        </div>   
<?php 
	$i=1;
		foreach($id_arr as $id){ 
		$title = get_the_title( $id ); 
		$post = get_post($id); 
		$content = esc_html( wp_trim_words( $post->post_content, 22, '' ) );
?>                 
<div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
    <div class="slide_info">
    	<h2><?php echo $title; ?></h2>
    	<p><?php echo $content; ?></p>  
        <?php
		 $slider_readmore = get_theme_mod('slider_readmore');
		 if( !empty($slider_readmore) ){ ?>
          <a class="slidemore" href="<?php the_permalink(); ?>"><?php echo esc_attr($slider_readmore); ?></a>
	  	 <?php } ?>      
    </div>
</div>      
    <?php $i++; } ?>       
     </div><!--end .slider area-->    
<div class="clear"></div>        
<?php } ?>
<?php } } ?>
       
        
<?php if ( is_front_page() && ! is_home() ) { ?>  
	<?php
		$hidepageboxes = get_theme_mod('disabled_pgboxes', '1');
		if( $hidepageboxes == ''){
    ?>     
     <section id="wrapsecond">
            	<div class="container">
                    <div class="services-wrap">                       
                        <?php for($p=1; $p<4; $p++) { ?>       
                        <?php if( get_theme_mod('page-column'.$p,false)) { ?>          
                            <?php $queryvar = new WP_query('page_id='.esc_attr(get_theme_mod('page-column'.$p,true))); ?>				
                                    <?php while( $queryvar->have_posts() ) : $queryvar->the_post(); ?> 
                                    <div class="fourbox <?php if($p % 3 == 0) { echo "last_column"; } ?>">                                    
                                      <?php if(has_post_thumbnail() ) { ?>
                                        <div class="thumbbx"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail();?></a></div>
                                      <?php } ?>
                                     <div class="pagecontent">
                                     <h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>                                    
                                     <p><?php echo wp_trim_words( get_the_content(), 20, '...' );  ?></p>   
                                    <a class="ReadMore" href="<?php echo esc_url( get_permalink() ); ?>">                                      
                                     <?php _e('Read More','beautiplus'); ?>
                                    </a> 
                                     </div>                                   
                                    </div>
                                   <?php endwhile;
           								 wp_reset_postdata(); ?>                                    
      								<?php } } ?> 
                    <div class="clear"></div>  
               </div><!-- services-wrap-->
              <div class="clear"></div>
            </div><!-- container -->
       </section>     
 <?php } ?>  
  
<?php
	$hidewelcomepage = get_theme_mod('disabled_welcomepage', '1');
	if( $hidewelcomepage == ''){
?>   
       <section id="Appwrap">
            	<div class="container">
                   <div class="appointmentwrap">                   
					<?php if( get_theme_mod('page-setting1')) { ?>
                    <?php $queryvar = new WP_query('page_id='.esc_attr(get_theme_mod('page-setting1' ,true))); ?>
                    <?php while( $queryvar->have_posts() ) : $queryvar->the_post();?>     
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words( get_the_content(), 50, '...' );  ?></p>   
                        <div class="clear"></div>
                        <a class="ReadMore appbutton" href="<?php echo esc_url( get_permalink() ); ?>">
					 <?php _e('Read More','beautiplus'); ?>
                    </a> 
                    <?php endwhile; 
                    wp_reset_postdata();
                    } ?>             
               </div>                       
              <div class="clear"></div>
            </div><!-- container -->
       </section>         
<?php } ?> 		   
<?php } ?>