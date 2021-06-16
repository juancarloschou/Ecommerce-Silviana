<?php
class rambo_dummy_import extends WP_Customize_Section {
	
	public $type = 'rambo_import_section';
	protected function render_template() {
	?>
		<li>

				<h3 class="accordion-section-title">
					<?php _e('Import Dummy Data','rambo'); ?>
				</h3>
				<div class="updated notice notice-success notice-alt is-dismissible">
				<p><?php printf( esc_html__( 'Save time by importing our demo data and make your site ready in minutes. %s', 'rambo' ), '</br></br><a class="button button-blue-secondary" href="'.esc_url( add_query_arg( array( 'page' => 'rambo-info#demo_import' ), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Import Demo Data', 'rambo' ).'</a>'  ); ?></p>
				</div>
			</li>
	<?php }
}
