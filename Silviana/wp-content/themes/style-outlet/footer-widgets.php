<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Style Outlet
 */

if ( ! is_dynamic_sidebar( ) ) {
	return;
}
?>

		<div class="seven columns alpha">
			<?php dynamic_sidebar('footer'); ?>
		</div>

		<div class="three columns"> 
			<?php dynamic_sidebar('footer-2'); ?>
		</div>

		<div class="three columns">
			<?php dynamic_sidebar('footer-3'); ?>
		</div>

		<div class="three columns omega">
			<?php dynamic_sidebar('footer-4'); ?>
		</div>