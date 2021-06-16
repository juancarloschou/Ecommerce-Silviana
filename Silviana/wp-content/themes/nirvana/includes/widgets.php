<?php

/** 
 * PRESENTATION PAGE COLUMNS 
 */

// Counting the PP column widgets
global $nirvana_column_counter;
$nirvana_column_counter = 0;

class ColumnsWidget extends WP_Widget
{ 	
  var $nirvanas; // theme options read in the constructor
  
  public function __construct() { 
    $widget_ops = array('classname' => 'ColumnsWidget', 'description' => 'Add columns in the presentation page' );
	$control_ops = array('width' => 350, 'height' => 350); // making widget window larger
	parent::__construct('columns_widget', 'Cryout Column', $widget_ops, $control_ops);
	$this->nirvanas = nirvana_get_theme_options(); // reading theme options
  } // construct()

  public function ColumnsWidget() {
	self::__construct();  
  } // PHP4 constructor
  
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'image' => '', 'title' => '' , 'text' => '',  'link' => '',  'blank' => '' ) );
    $image = $instance['image'];
	$title = $instance['title'];
	$text = $instance['text'];
	$link = $instance['link'];
	$blank = $instance['blank'];?>
	<div>
		<p><label for="<?php echo $this->get_field_id('image'); ?>">Image: <input class="widefat slideimages" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_url($image); ?>" /></label><a class="upload_image_button button" href="#">Select / Upload Image</a></p>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Text: <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php echo esc_attr($text); ?></textarea></label></p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>">Link: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_url($link); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('blank'); ?>">Open in new Window: <input id="<?php echo $this->get_field_id('blank'); ?>" name="<?php echo $this->get_field_name('blank'); ?>" type="checkbox" <?php checked($blank, 1); ?> value="1" /></label></p>
	</div> <?php  
  } // form()

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['image'] = $new_instance['image'];
	$instance['title'] = $new_instance['title'];
	$instance['text'] = $new_instance['text'];
	$instance['link'] = $new_instance['link'];
	$instance['blank'] = $new_instance['blank'];
    return $instance;
  } // update()
  
  function widget($args, $instance) { 
	$nirvana_nrcolumns = $this->nirvanas['nirvana_nrcolumns']; // getting the number of columns setting
	global $nirvana_column_counter; // global counter for incrementing further
	
	if (!empty($instance['image']) || !empty($instance['title']) || !empty($instance['text'])): 
		$nirvana_column_counter++; // incrementing counter only if column is valid 
		$counter = $nirvana_column_counter; 
		$coldata = array(
			'colno' => (($counter%$nirvana_nrcolumns)?$counter%$nirvana_nrcolumns:$nirvana_nrcolumns),
			'counter' => $counter,
			'image' => esc_url($instance['image']),
			'link' => esc_url($instance['link']),
			'blank' => ($instance['blank']?'target="_blank"':''),
			'title' =>  $instance['title'],
			'text' => $instance['text'],
		);
		nirvana_singlecolumn_output($coldata);		
	endif; 
  } // widget() function
  
} // class ColumnsWidget

add_action( 'widgets_init', create_function('', 'return register_widget("ColumnsWidget");') );

function nirvana_widget_scripts() {
	// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
         wp_enqueue_media();
      }
      else {
         wp_enqueue_script('media-upload');
         wp_enqueue_script('thickbox');
         wp_enqueue_style('thickbox');
      }
	wp_register_script('admin', get_template_directory_uri().'/admin/js/widgets.js');
	wp_enqueue_script('admin'); 
}

add_action ('admin_print_scripts-widgets.php','nirvana_widget_scripts');

/**
 * presentation page column output
 */
if ( ! function_exists('nirvana_singlecolumn_output') ):
function nirvana_singlecolumn_output($data){
	extract($data);
	?>
		<div class="ppcolumn column<?php echo $colno; ?>">
				<div class="column-image">
					<a href="<?php echo $link; ?>" class="clickable-column">
						<?php if ($image) {	?><img src="<?php echo $image ?>" id="columnImage<?php echo $counter; ?>" alt="<?php echo ($title?wp_kses($title,array()):''); ?>" /><?php } ?>
					</a>

						<div class="column-image-inside">
						<a class="column-link" href="<?php echo $link ?>" <?php echo $blank ?>>&nbsp;	</a>
						<div class="column-image-inside-centered">
								<?php if ($title) { echo '<a href="'.$link.'" '.$blank.'><h3 class="column-header-image">'.$title.'</h3></a>'; } ?>
							<div class="column-text-separator"></div>
							<?php if ($text) { ?>
								<div class="column-text">
									<?php echo do_shortcode($text); ?>
								</div>
							<?php } ?>
						</div> <!--column-image-inside-centered-->
						</div> <!--column-image-inside-->
					
				</div><!--column-image-->
		</div><!-- column -->
	<?php
} // nirvana_singlecolumn_output()
endif;

// FIN