<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 ?>
<div class="sidebar">
<?php if ( is_active_sidebar( 'sidebar-one' ) ) : ?>
<?php dynamic_sidebar( 'sidebar-one' ); ?>
<?php else: ?>
<?php endif; ?>
</div>
<!--sidebar-->      
      