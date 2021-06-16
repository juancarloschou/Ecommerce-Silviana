<?php
//Pro Button
function rambo_help_customizer( $wp_customize ) {
class WP_help_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-box">
       <a href="<?php echo esc_url('http://webriti.com/themes/dummydata/lite/RamboLite.zip');?>" target="_blank" class="upgrade" id="review_pro"><?php _e('DOWNLOAD IMPORT FILE','rambo' ); ?></a>
		
	</div>
    <?php
    }
}
$wp_customize->add_section( 'rambo_help_section' , array(
		'title'      => __('HELP', 'rambo'),
		'priority'   => 1100,
   	) );

$wp_customize->add_setting(
    'dwn_import',
    array(
       'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_help_Customize_Control( $wp_customize, 'dwn_import', array(
		'section' => 'rambo_help_section',
		'setting' => 'dwn_import',
    ))
);

class WP_video_setup_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
	  <div class="pro-box">
     <a href="<?php echo esc_url('http://webriti.com/rambo-theme-video-documentation/');?>" target="_blank" class="review" id="review_pro"><?php _e('VIDEO SETUP GUIDE','rambo' ); ?></a>
	 </div>
    <?php
    }
}

$wp_customize->add_setting(
    'video_setup',
    array(
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_video_setup_Customize_Control( $wp_customize, 'video_setup', array(	
		'section' => 'rambo_help_section',
		'setting' => 'video_setup',
    ))
);


class WP_fur_support_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
      <div class="pro-box">
	 <a href="<?php echo esc_url('https://wordpress.org/support/theme/rambo/');?>" target="_blank" class="document" id="review_pro">
	 <?php _e( 'THEME SUPPORT','rambo' ); ?></a>
	 
	 <div>
	 <div class="pro-vesrion">
	 <?php //_e('Buy the pro version and give us a chance to serve you better.Buy the pro version and give us a chance to serve you better. ','rambo');?>
	 </div>
    <?php
    }
}

$wp_customize->add_setting(
    'fur_support',
    array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_fur_support_Customize_Control( $wp_customize, 'fur_support', array(	
		'section' => 'rambo_help_section',
		'setting' => 'fur_support',
    ))
);

}
add_action( 'customize_register', 'rambo_help_customizer' );
?>