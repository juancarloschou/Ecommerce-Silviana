jQuery(document).ready(function() {
	
	/* Service Section */
	wp.customize.section( 'sidebar-widgets-workpress-sidebar-service' ).panel( 'service_panel' );
	wp.customize.section( 'sidebar-widgets-workpress-sidebar-service' ).priority( '5' );
	
	/* Project Section */
	wp.customize.section( 'sidebar-widgets-workpress-sidebar-project' ).panel( 'project_panel' );
	wp.customize.section( 'sidebar-widgets-workpress-sidebar-project' ).priority( '5' );
	
});