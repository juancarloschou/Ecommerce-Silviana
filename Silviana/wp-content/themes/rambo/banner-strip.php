<?php 
get_header();

//For pages
$slider_enable_page = sanitize_text_field( get_post_meta( get_the_ID(), 'slider_enable_page', true ));

if($slider_enable_page == true){
get_template_part('index','slider');
}

//For post
$slider_enable_post = sanitize_text_field( get_post_meta( get_the_ID(), 'slider_enable_post', true ));
if($slider_enable_post == true){
get_template_part('index','slider');
}




?>
<!-- Header Strip -->
<div class="hero-unit-small">
	<div class="container">
		<div class="row-fluid about_space">
			<div class="span8">
				<h2 class="page_head"><?php
				if(is_search())
				{
					printf( __( "Search results for %s", 'rambo' ), get_search_query() );
				}
				elseif(is_404())
				{
				 _e('Oops! Page not found', 'rambo' );	
				}
				else
				{
				$page_title = $wp_query->post->post_title;
				echo $page_title; } ?></h2>
			</div>
			
			<div class="span4">
				<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="input-append search_head pull-right">
					<input type="text"   name="s" id="s" placeholder="<?php esc_attr_e( "Search", 'rambo' ); ?>" />
					<button type="submit" class="Search_btn" name="submit" ><?php esc_attr_e( "Go", 'rambo' ); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Header Strip -->