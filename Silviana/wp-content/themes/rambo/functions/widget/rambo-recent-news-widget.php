<?php
/**
 * Register Resent News widget
 *
 */
add_action('widgets_init','rambo_resent_news_widget');
function rambo_resent_news_widget(){
	
	return register_widget('rambo_resent_news_widget');
}

class rambo_resent_news_widget extends WP_Widget{
	
	function __construct() {
		parent::__construct(
			'rambo_recent_news_widget', // Base ID
			__('WBR : Recent News Widget', 'rambo'), // Name
			array( 'description' => __('Recent News widget','rambo'), ) // Args
		);
	}
	
	public function widget( $args , $instance ) {
		$instance['title'] = isset($instance['title']) ? $instance['title'] : '';
		$instance['show_news'] = isset($instance['show_news']) ? $instance['show_news'] : 3;
		$current_options = wp_parse_args( get_option('rambo_pro_theme_options', array() ), theme_data_setup());
		
		$loop = array();
		
		$loop['post_type'] = 'post';
		
		$loop['showposts'] = $instance['show_news'];
		
		$loop['ignore_sticky_posts'] = 1;
		
		if( $current_options['home_slider_post_enable'] == false )
		{
			$loop['category__not_in'] = $current_options['slider_category'];
		}
		
		$news_query = new WP_Query($loop);
		
		echo $args['before_widget'];
			
			if($instance['title']):
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			endif;
			
		if( $news_query->have_posts() ) : 
			
			echo '<div class="row">';
			
			while ( $news_query->have_posts() ) : $news_query->the_post();
				?>
				
					<div class="span4 latest_news_section">		
					<?php $defalt_arg =array('class' => "img-responsive latest_news_img");?>
						<?php if(has_post_thumbnail()){ ?>
							<a href="<?php the_permalink(); ?>" >
							<?php the_post_thumbnail('',$defalt_arg);?></a>
							<?php } ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title() ;?></a></h3>
						<p><?php  echo get_the_excerpt(); ?></p>				
						<div class="latest_news_comment">
							<!--<a class="pull-left" href="#"><i class="fa fa-calendar icon-spacing"></i><?php //echo get_the_date('M j,Y');?></a> -->
							<a class="pull-left" href="<?php the_permalink(); ?>"><i class="fa fa-calendar icon-spacing"></i><?php the_time('M j,Y');?></a>
							<a class="pull-right" href="<?php comments_link(); ?>"><i class="fa fa-comment icon-spacing"></i><?php echo get_comments_number();?></a>
						</div>
					</div>
				
				<?php
			endwhile;
			
			echo '</div>';
			
		endif;
		
		echo $args['after_widget'];
	}
	
	public function form( $instance ) {
		$instance['title'] = isset($instance['title']) ? $instance['title'] : '';
		$instance['show_news'] = isset($instance['show_news']) ? $instance['show_news'] : 3;
	?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','rambo' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'show_news' ); ?>"><?php _e('Number of post to show','rambo' ); ?></label> 
		<input size="3" maxlength="2" id="<?php echo $this->get_field_id( 'show_news' ); ?>" name="<?php echo $this->get_field_name( 'show_news' ); ?>" type="number" value="<?php echo $instance['show_news']; ?>" />
	</p>
		
	<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['show_news'] = ( ! empty( $new_instance['show_news'] ) ) ? $new_instance['show_news'] : '';
		
		return $instance;
	}
}