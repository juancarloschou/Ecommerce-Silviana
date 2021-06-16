<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		
		<input type="text"   name="s" id="s" placeholder="<?php esc_attr_e("Search",'rambo' ); ?>" />
		<input type="submit" class="search-btn" name="submit" value="<?php esc_attr_e("Search",'rambo' ); ?>" />

</form>