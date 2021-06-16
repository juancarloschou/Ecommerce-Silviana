<?php
/*	* @Theme Name	:	Rambopro
	* @file         :	404.php
	* @package      :	Rambopro
	* @author       :	Hari Maliya
	* @license      :	license.txt
	* @filesource   :	wp-content/themes/rambo-pro/404.php
*/
?>
<?php get_template_part('banner','strip'); ?>
	<div class="container">
		<!--- Main ---> 
		<div class="row-fluid">
			<div class="span8 Blog_main">
				<div class="blog_single_post">
				<h2><?php _e('Oops! Page not found', 'rambo' ); ?>
				</h2>
				<p><?php _e('We are sorry, but the page you are looking for does not exist.', 'rambo' ); ?>
				</p>
				<?php get_search_form(); ?>
				</div>
			</div>
			<?php get_sidebar (); ?>
		</div>
	</div>
<?php get_footer(); ?>