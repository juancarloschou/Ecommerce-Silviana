<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Freestore_Premium_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'includes/freestore-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Freestore_Premium_Customize_Section' );

		// Register sections.
		$manager->add_section(
			new Freestore_Premium_Customize_Section(
				$manager,
				'freestore_premium',
				array(
					'title'    => esc_html__( 'FreeStore', 'freestore' ),
					'pro_text' => esc_html__( 'Support FreeStore', 'freestore' ),
					'pro_url'  => 'https://kairaweb.com/theme/freestore/#purchase-premium'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'freestore-customize-controls', trailingslashit( get_template_directory_uri() ) . 'includes/freestore-pro/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'freestore-customize-controls', trailingslashit( get_template_directory_uri() ) . 'includes/freestore-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Freestore_Premium_Customize::get_instance();
