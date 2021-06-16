<?php
get_template_part('banner','strip');?>
<!-- Container -->
<div class="container">
	<!-- Blog Section Content -->
	<div class="row-fluid">
		<!-- Blog Single Page -->
		<?php if ( class_exists( 'WooCommerce' ) ) {
					
					if( is_account_page() || is_cart() || is_checkout() ) {
							echo '<div class="span'.( !is_active_sidebar( "woocommerce" ) ?"12" :"8" ).' Blog_main">'; 
					}
					else{ 
				
					echo '<div class="span'.( !is_active_sidebar( "sidebar-primary" ) ?"12" :"8" ).' Blog_main">'; 
					
					}
					
				}
				else{ 
				
					echo '<div class="span'.( !is_active_sidebar( "sidebar-primary" ) ?"12" :"8" ).' Blog_main">';
					
					}
					?>
		
			<div class="blog_single_post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php  the_post(); ?>
			<?php $defalt_arg =array('class' => "img-responsive blog_section2_img" )?>
			<?php if(has_post_thumbnail()):?>
			<a  href="<?php the_permalink(); ?>" class="blog_pull_img2">
				<?php the_post_thumbnail('', $defalt_arg); ?>
			</a>
			<?php endif;?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php if (!class_exists( 'WooCommerce' ) ) {?>
			<div class="blog_section2_comment">
			<a href="<?php the_permalink(); ?>"><i class="fa fa-calendar icon-spacing"></i><?php the_time('M j,Y');?></a>
			<a class="post-comment" href="<?php the_permalink(); ?>"><i class="fa fa-comments icon-spacing"></i><?php comments_popup_link( __('Leave a comment','rambo' ) ); ?></a>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><i class="fa fa-user icon-spacing"></i> <?php _e('By','rambo');?>&nbsp;<?php the_author();?></a>
			</div>
			<?php }?>
			
			<?php  the_content( __('Read More','rambo') ); ?>
			</div>
			<?php comments_template( '', true );?>
		</div>
		<?php if ( class_exists( 'WooCommerce' ) ) {
					
					if( is_account_page() || is_cart() || is_checkout() ) {
							get_sidebar('woocommerce'); 
					}
					else{ 
				
					get_sidebar(); 
					
					}
					
				}
				else{ 
				
					get_sidebar(); 
					
					}?>
	</div>
</div>
<?php get_footer();?>