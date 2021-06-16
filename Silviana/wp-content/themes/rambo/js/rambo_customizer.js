jQuery(document).ready(function() {
	
	/* Big Intro Below Slider Section */
	wp.customize.section( 'sidebar-widgets-site-intro-area' ).panel( 'site_intro' );
	wp.customize.section( 'sidebar-widgets-site-intro-area' ).priority( '3' );
	
	/* Service Section */
	wp.customize.section( 'sidebar-widgets-sidebar-service' ).panel( 'service_panel' );
	wp.customize.section( 'sidebar-widgets-sidebar-service' ).priority( '5' );
	
	/* Project Section */
	wp.customize.section( 'sidebar-widgets-sidebar-project' ).panel( 'project_panel' );
	wp.customize.section( 'sidebar-widgets-sidebar-project' ).priority( '5' );
	
	/* Latest News Section */
	wp.customize.section( 'sidebar-widgets-sidebar-news' ).panel( 'news_panel' );
	wp.customize.section( 'sidebar-widgets-sidebar-news' ).priority( '2' );
	
});