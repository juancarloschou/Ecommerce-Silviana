<?php
/**
 * The template for displaying search forms in FreeStore
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="<?php echo wp_kses_post( get_theme_mod( 'freestore-website-search-txt', __( 'Search &amp; hit enter&hellip;', 'freestore' ) ) ) ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( '&nbsp;', 'submit button', 'freestore' ); ?>" />
</form>