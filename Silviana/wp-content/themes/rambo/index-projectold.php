<?php
$rambo_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_theme_options', array() ), $rambo_theme_options );
?>
<div class="span3 featured_port_projects">
	<div class="thumbnail">
	<?php if($current_options['project_one_thumb']) { ?>
		  <img src="<?php echo $current_options['project_one_thumb']; ?>">
	<?php } ?>
		
		  <div class="featured_service_content">
			<?php if($current_options['project_one_title']) { ?>
			<h3><a href="#"><?php echo $current_options['project_one_title']; ?></a></h3>
			<?php } ?>
			<?php if($current_options['project_one_text']) { ?>
			<p><?php echo $current_options['project_one_text']; ?></p>
			<?php } ?>
		  </div>
	</div>
</div>
<div class="span3 featured_port_projects">
	<div class="thumbnail">
	<?php if($current_options['project_two_thumb']) { ?>
		  <img src="<?php echo $current_options['project_two_thumb']; ?>">
	<?php } ?>
		
		  <div class="featured_service_content">
			<?php if($current_options['project_two_title']) { ?>
			<h3><a href="#"><?php echo $current_options['project_two_title']; ?></a></h3>
			<?php } ?>
			<?php if($current_options['project_two_text']) { ?>
			<p><?php echo $current_options['project_two_text']; ?></p>
			<?php } ?>
		  </div>
	</div>
</div>
<div class="span3 featured_port_projects">
	<div class="thumbnail">
	<?php if($current_options['project_three_thumb']) { ?>
		  <img src="<?php echo $current_options['project_three_thumb']; ?>">
	<?php } ?>
		
		  <div class="featured_service_content">
			<?php if($current_options['project_three_title']) { ?>
			<h3><a href="#"><?php echo $current_options['project_three_title']; ?></a></h3>
			<?php } ?>
			<?php if($current_options['project_three_text']) { ?>
			<p><?php echo $current_options['project_three_text']; ?></p>
			<?php } ?>
		  </div>
	</div>
</div>
<div class="span3 featured_port_projects">
	<div class="thumbnail">
	<?php if($current_options['project_four_thumb']) { ?>
		  <img src="<?php echo $current_options['project_four_thumb']; ?>">
	<?php } ?>
		
		  <div class="featured_service_content">
			<?php if($current_options['project_four_title']) { ?>
			<h3><a href="#"><?php echo $current_options['project_four_title']; ?></a></h3>
			<?php } ?>
			<?php if($current_options['project_four_text']) { ?>
			<p><?php echo $current_options['project_four_text']; ?></p>
			<?php } ?>
		  </div>
	</div>
</div>