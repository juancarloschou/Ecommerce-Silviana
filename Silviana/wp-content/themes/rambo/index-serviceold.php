<?php
  /**
  * @Theme Name	:	rambo
  * @file         :	index-service.php
  * @package      :	rambo
  * @author       :	webriti
  * @license      :	license.txt
  * @filesource   :	wp-content/themes/rambo/index-service.php
  */
  $rambo_theme_options = theme_data_setup();
  $current_options = wp_parse_args(  get_option( 'rambo_theme_options', array() ), $rambo_theme_options );
?>
<div class="container">
  <!-- /Home Service Section -->
  <div class="row-fluid">
    <div class="span3 home_service">
      <?php if($current_options['home_service_one_icon']!='') { ?>
      <span class="fa-stack fa-4x icon_align_center">					
      <i class="fa  <?php echo $current_options['home_service_one_icon']; ?> home_media_icon_1x fa-inverse"></i>
      </span>
      <?php } ?>
      <h2><?php if(isset($current_options['home_service_one_title'])) { echo $current_options['home_service_one_title']; } ?></h2>
      <p> <?php if(isset($current_options['home_service_one_description'])) { echo $current_options['home_service_one_description']; } ?></p>
    </div>
    <div class="span3 home_service">
      <?php if($current_options['home_service_two_icon']!='') { ?>
      <span class="fa-stack fa-4x icon_align_center">					
      <i class="fa <?php echo $current_options['home_service_two_icon']; ?> home_media_icon_1x fa-inverse"></i>
      </span>
      <?php } ?>
      <h2><?php if(isset($current_options['home_service_two_title'])) { echo $current_options['home_service_two_title']; } ?></h2>
      <p> <?php if(isset($current_options['home_service_two_description'])) { echo $current_options['home_service_two_description']; } ?></p>
    </div>
    <div class="span3 home_service">
      <?php if($current_options['home_service_three_icon']!='') { ?>
      <span class="fa-stack fa-4x icon_align_center">					
      <i class="fa <?php echo $current_options['home_service_three_icon']; ?> home_media_icon_1x fa-inverse"></i>
      </span>
      <?php } ?>
      <h2><?php if(isset($current_options['home_service_three_title'])) { echo $current_options['home_service_three_title']; } ?></h2>
      <p> <?php if(isset($current_options['home_service_three_description'])) { echo $current_options['home_service_three_description']; } ?></p>
    </div>
    <div class="span3 home_service">
      <?php if($current_options['home_service_fourth_icon']!='')  { ?>	
      <span class="fa-stack fa-4x icon_align_center">								
      <i class="fa <?php  echo $current_options['home_service_fourth_icon']; ?> home_media_icon_1x fa-inverse"></i>					
      </span><?php } ?>
      <h2><?php if(isset($current_options['home_service_fourth_title'])) { echo $current_options['home_service_fourth_title']; } ?></h2>
      <p> <?php if(isset($current_options['home_service_fourth_description'])) { echo $current_options['home_service_fourth_description']; } ?></p>
    </div>
  </div>
  <!-- /Home Service Section -->	
</div>