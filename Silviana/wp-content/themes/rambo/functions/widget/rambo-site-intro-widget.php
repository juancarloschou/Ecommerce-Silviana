<?php
add_action( 'widgets_init','rambo_site_intro_widget'); 
   function rambo_site_intro_widget() { return   register_widget( 'rambo_site_intro_widget' ); }
/**
 * Adds rambo_sidbar_usefull_page_widget widget.
 */
class rambo_site_intro_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'rambo_site_intro_widget', // Base ID
			__('WBR : Call To Action Top', 'rambo'), // Name
			array( 'description' => __( 'Display the Site Intro Section.', 'rambo' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$instance[ 'description' ] = isset($instance[ 'description' ])?$instance[ 'description' ]:'';
		$instance[ 'site_intro_text' ] = isset($instance[ 'site_intro_text' ])?$instance[ 'site_intro_text' ]:'';
		$instance[ 'site_intro_link' ] = isset($instance[ 'site_intro_link' ])?$instance[ 'site_intro_link' ]:'';
		$instance[ 'site_intro_target' ] = isset($instance[ 'site_intro_target' ])?$instance[ 'site_intro_target' ]:'';		
		
		//echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title']; ?>		
		
				
					<div class="span8">		
						<h1><?php echo  $instance[ 'description' ];?></h1>
					</div>
					<div class="span4">
						<?php
						if(($instance['site_intro_link'])!=null){
					
						echo '<a class="purchase_now_btn" href="'.$instance['site_intro_link'].'" '.($instance['site_intro_target']==true?'target="_blank"':'').' >'.$instance['site_intro_text'].'
					    </a>';					    
						}
						?>
					</div>
		<?php
		echo $args['after_widget'];		
		//echo $args['after_widget']; // end of sidbar usefull links widget		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
		public function form( $instance ) {
			
		
		$instance[ 'description' ] = isset($instance[ 'description' ])?$instance[ 'description' ]:'';	
		$instance[ 'site_intro_link' ] = isset($instance[ 'site_intro_link' ])?$instance[ 'site_intro_link' ]:'';	
		$instance[ 'site_intro_text' ] = isset($instance[ 'site_intro_text' ])?$instance[ 'site_intro_text' ]:'';	
		$instance[ 'site_intro_target' ] = isset($instance[ 'site_intro_target' ])?$instance[ 'site_intro_target' ]:'';	
		?>
		
		
		<h4 for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description','rambo' ); ?></h4>
		<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php if($instance[ 'description' ]) echo esc_attr($instance[ 'description' ]);?>" />
		
		<h4 for="<?php echo $this->get_field_id( 'site_intro_text' ); ?>"><?php _e('Button Text','rambo' ); ?></h4>
		<input class="widefat" id="<?php echo $this->get_field_id( 'site_intro_text' ); ?>" name="<?php echo $this->get_field_name( 'site_intro_text' ); ?>" type="text" value="<?php if($instance[ 'site_intro_text' ]) echo esc_attr($instance[ 'site_intro_text' ]);?>" />
		
		<h4 for="<?php echo $this->get_field_id( 'site_intro_link' ); ?>"><?php _e('Button Link','rambo' ); ?></h4>
		<input class="widefat" id="<?php echo $this->get_field_id( 'site_intro_link' ); ?>" name="<?php echo $this->get_field_name( 'site_intro_link' ); ?>" type="text" value="<?php if($instance[ 'site_intro_link' ]) echo esc_attr($instance[ 'site_intro_link' ]);?>" />
		
		<p>
		<input class="checkbox" type="checkbox" <?php if($instance['site_intro_target']==true){ echo 'checked'; } ?> id="<?php echo $this->get_field_id( 'site_intro_target' ); ?>" name="<?php echo $this->get_field_name( 'site_intro_target' ); ?>" /> 
		<label for="<?php echo $this->get_field_id( 'site_intro_target' ); ?>">
		<?php _e('Open link in new tab','rambo' ); ?></label>
		</p>
		
		
		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';		

		
		$instance['site_intro_text'] = ( ! empty( $new_instance['site_intro_text'] ) ) ? strip_tags( $new_instance['site_intro_text'] ) : '';

		
		$instance['site_intro_link'] = ( ! empty( $new_instance['site_intro_link'] ) ) ? strip_tags( $new_instance['site_intro_link'] ) : '';		
				

		$instance['site_intro_target'] = ( ! empty( $new_instance['site_intro_target'] ) ) ? strip_tags( $new_instance['site_intro_target'] ) : '';		
		
		return $instance;
	}

}
?>