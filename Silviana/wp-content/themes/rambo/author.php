<?php get_header(); 
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
				<h2 class="page_head">
				<?php printf( __( 'Author Archive %s', 'rambo'), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' ); ?>
				</h2>
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

<div class="container">
	<!-- Blog Section Content -->
	<div class="row-fluid">
		<!-- Blog Main -->
		<div class="<?php if( is_active_sidebar('sidebar-primary')) echo "span8"; else echo "span12";?> Blog_main">
			<?php 				
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$author_id=get_query_var('author');
				$args = array( 'post_type' => 'post','paged'=>$paged,'author' => $author_id);
				$post_type_data = new WP_Query( $args );
				while($post_type_data->have_posts()):
				$post_type_data->the_post();
					global $more;
					$more = 0; ?>
			<div class="blog_section2" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php $defalt_arg =array('class' => "blog_section2_img" )?>
					<?php if(has_post_thumbnail()):?>
					<a  href="<?php the_permalink(); ?>" class="pull-left blog_pull_img2">
					<?php the_post_thumbnail('', $defalt_arg); ?>
					</a>
					<?php endif;?>
					<h2><a href="<?php the_permalink(); ?>"title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<div class="blog_section2_comment">
						<a href="<?php the_permalink(); ?>"><i class="fa fa-calendar icon-spacing"></i><?php the_time('M j,Y');?></a>
						<a href="<?php the_permalink(); ?>"><i class="fa fa-comments icon-spacing"></i><?php comments_popup_link( __('Leave a comment', 'rambo' ) ); ?></a>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><i class="fa fa-user icon-spacing"></i> <?php _e("By",'rambo');?>&nbsp;<?php the_author();?></a>
					</div>					
					<?php  the_content(''); ?>								
					<p class="tags_alignment">
					<?php $posttags = get_the_tags(); 
						if ($posttags) { ?>
						<span class="blog_tags"><i class="fa fa-tags"></i><a href="<?php the_permalink(); ?>"><?php the_tags(__('Tags','rambo'));?></a></span>
					<?php }  ?>
					<?php $ismore = strpos( $post->post_content, '<!--more-->');
						if ($ismore) {	?>
						<a class="blog_section2_readmore pull-right" href="<?php the_permalink(); ?>">
						<?php _e('Read More','rambo'); ?></a>
					<?php } ?>
					</p>
			</div>
			<?php endwhile; ?>
			<?php rambo_post_pagination(); // call post pagination ?>
		</div>
		 <?php get_sidebar();?>
	</div>
</div>
<?php get_footer();?>