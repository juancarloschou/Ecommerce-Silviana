<?php
/**
 * side bar template
 *
 * @package WordPress
 * @subpackage spasalon
 */
?>

<div class="span4">
<?php if ( is_active_sidebar( 'woocommerce' )  ) : ?>
<!--Sidebar-->
<?php dynamic_sidebar( 'woocommerce' ); ?>
<!--/End of Sidebar-->
<?php endif; ?>
</div>