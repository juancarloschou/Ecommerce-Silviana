<?php get_template_part('banner','strip'); ?>
<div class="container">
	<div class="row-fluid">
		<div class="<?php if( is_active_sidebar('sidebar-primary')) echo "span8"; else echo "span12";?> Blog_main">
			<div class="blog_single_post">
			<?php if ( have_posts() ) : ?>
			<h2><?php printf( __( "Search results for %s", 'rambo' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php $defalt_arg =array('class' => "img-responsive blog_section2_img" )?>
			<?php if(has_post_thumbnail()):?>
			<a  href="<?php the_permalink(); ?>" class="blog_pull_img2">
				<?php the_post_thumbnail('', $defalt_arg); ?>
			</a>
			<?php endif;?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="blog_section2_comment">
			<a href="<?php the_permalink(); ?>"><i class="fa fa-calendar icon-spacing"></i><?php the_time('M j,Y');?></a>
			<a class="post-comment" href="<?php the_permalink(); ?>"><i class="fa fa-comments icon-spacing"></i><?php comments_popup_link( __('Leave a comment','rambo' ) ); ?></a>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><i class="fa fa-user icon-spacing"></i> <?php _e("By",'rambo');?>&nbsp;<?php the_author();?></a>
			</div>
            <?php the_content();?><br>
           <?php endwhile; ?>
			<?php else : ?>

			<h2><?php _e( "Nothing Found",'rambo'); ?></h2>
			<div class="">
			<p><?php _e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'rambo' ); ?>
			</p>
			<?php get_search_form(); ?>
			</div><!-- .blog_con_mn -->
			<?php endif; ?>
            </div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php  get_footer() ?>