<?php
class rambo_customize_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof rambo_customize_import_dummy_data ) ) {
			self::$instance = new rambo_customize_import_dummy_data;
			self::$instance->rambo_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function rambo_setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'rambo_customize_register' ) );

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'rambo_import_customize_scripts' ), 0 );

	}

	public function rambo_import_customize_scripts() {

	wp_enqueue_script( 'rambo-import-customizer-js', get_template_directory_uri() . '/js/rambo-import-customizer.js', array( 'customize-controls' ) );
	}

	public function rambo_customize_register( $wp_customize ) {

		require_once get_template_directory() . '/functions/custom_control/class-dummy-import-control.php';
		
		$wp_customize->register_section_type( 'rambo_dummy_import' );

		$wp_customize->add_section(
			new rambo_dummy_import(
				$wp_customize,
				'rambo_import_section',
				array(
					'priority' => 0,
				)
			)
		);

	}
}

$import_customizer = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
rambo_customize_import_dummy_data::init( apply_filters( 'rambo_import_customizer', $import_customizer ) );
