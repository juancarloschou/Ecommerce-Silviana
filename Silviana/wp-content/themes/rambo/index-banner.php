<?php
$current_options = wp_parse_args( get_option('rambo_pro_theme_options', array() ), theme_data_setup());
$slider_post_one = $current_options['slider_post'];
$slider_post = array($slider_post_one);
if($current_options['home_banner_enabled']==true)
{
$slider_post = array($slider_post_one);
if( $current_options['slider_post']!='' ){ 
 ?>
<div class="main_slider">
	<?php
			$slider_query = new WP_Query( array( 'post__in' => $slider_post));
				if( $slider_query->have_posts() ){                
					while( $slider_query->have_posts() ){
						$slider_query->the_post();		
			?>
		<div class="carousel-inner">
		<!-- Carousel items -->
			
				<div id="post-<?php the_ID(); ?>" class="item active">
				<?php 
					  $default_arg =array('class' => "img-responsive"); 
					  if(has_post_thumbnail()){ the_post_thumbnail('', $default_arg); }	
				?>
				<div class="container slider_con">
					<h2><?php echo the_title(); ?></h2>
					<h5 class="slide-title">
						<span>
							<?php remove_filter( 'the_content', 'wpautop' ); the_content(); ?>
						</span>
					</h5>
				</div>

			</div>
		</div>
		<?php } } ?>
</div>
<?php } else {
$rambo_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_theme_options', array() ), $rambo_theme_options );
?>
<div class="front_banner">
  <div class="banner">
    <li>
      <img  class="banner_img webrit_slides" src="<?php if($current_options['home_custom_image']!='') { echo $current_options['home_custom_image']; } ?>">
      <div class="banner_con">
        <h2><?php if(isset($current_options['home_image_title']))	{ echo $current_options['home_image_title']; } else { _e('Theme Feature Goes Here !','rambo'); } ?></h2>
        <h5 class="banner-title"><span><?php if(isset($current_options['home_image_description']))	{ echo $current_options['home_image_description']; } else { _e('This is Dummy Text. This is Dummy Text. This is Dummy Text.  I repeat.. This is Dummy Text.','rambo'); } ?></span></h5>
		<?php if($current_options['read_more_text'] != '') { ?>
		<a href="<?php echo $current_options['read_more_button_link']; ?>" <?php if( $current_options['read_more_link_target'] == 1 ) { echo "target='_blank'"; } ?> class="flex_btn"><?php echo $current_options['read_more_text']; ?></a>
		<?php } ?>
      </div>
    </li>
  </div>
</div>
<?php } } ?>