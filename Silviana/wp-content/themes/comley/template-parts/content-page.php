<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Comley
 * @since Comley 1.0
 */
?>
<div class="left-section wow fadeInUp">
  <?php if (post_password_required() || is_attachment() || ! has_post_thumbnail()) {
		//return;
	} else {
		the_post_thumbnail('page-thumbnail', array( 'alt' => get_the_title(),'class'=> "img-responsive"));		
		} ?>
    <?php the_content(); ?>  
</div>
<!--entry--> 