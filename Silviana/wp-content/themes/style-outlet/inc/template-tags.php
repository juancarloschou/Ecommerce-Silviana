<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Style Outlet
 */

if ( ! function_exists( 'style_outlet_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function style_outlet_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'style-outlet' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'style-outlet' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'style_outlet_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function style_outlet_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'style-outlet' ) );
		if ( $categories_list && style_outlet_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'style-outlet' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'style-outlet' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'style-outlet' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'style-outlet' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'style-outlet' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function style_outlet_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'style_outlet_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'style_outlet_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so style_outlet_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so style_outlet_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in style_outlet_categorized_blog.
 */
function style_outlet_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'style_outlet_categories' );
}
add_action( 'edit_category', 'style_outlet_category_transient_flusher' );
add_action( 'save_post',     'style_outlet_category_transient_flusher' );


/*  Site Layout Option  */
if ( ! function_exists( 'style_outlet_layout_class' ) ) :
	function style_outlet_layout_class() {
	     $sidebar_position = get_theme_mod( 'sidebar_position', 'right' ); 
		     if( 'fullwidth' == $sidebar_position ) {
		     	echo 'sixteen';  
		     }else{
		     	echo 'eleven';
		     }
		     if ( 'no-sidebar' == $sidebar_position ) {
		     	echo ' no-sidebar';
		     }
	}
endif;


if ( ! function_exists( 'style_outlet_author' ) ) {
	function style_outlet_author() {
		echo style_outlet_get_author();
	}
}

if ( ! function_exists( 'style_outlet_get_author' ) ) {
	function style_outlet_get_author() {
		$byline = sprintf(
			_x( ' %s', 'post author', 'style-outlet' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( get_the_author() ) . '</a></span>'
		);	

		return $byline;
	}
}


if ( ! function_exists( 'style_outlet_edit' ) ) {
	function style_outlet_edit() {
		edit_post_link( __( 'Edit', 'style-outlet' ), '<span class="edit-link"> ', '</span>' );
	}
}

if ( ! function_exists( 'style_outlet_comments_meta' ) ) {
	function style_outlet_comments_meta() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo ' <span class="comments-link"><i class="fa fa-comment"></i>';
			comments_popup_link( __( 'Leave a comment', 'style-outlet' ), __( '1 Comment', 'style-outlet' ), __( '% Comments', 'style-outlet' ) );
			echo '</span>';  
		}	
	}
}


if ( ! function_exists( 'style_outlet_post_nav' ) ) :
/** 
 * Display navigation to next/previous post when applicable.
 */
	function style_outlet_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation clearfix" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'style-outlet' ); ?></h1>
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous">%link</div>',_x( '<span class="meta-nav"><i class="fa fa-angle-left"></i></span>&nbsp;%title', 'Previous post link', 'style-outlet' ) );
					next_post_link(     '<div class="nav-next">%link</div>',    _x( '%title&nbsp;<span class="meta-nav"><i class="fa fa-angle-right"></i></span>', 'Next post link',     'style-outlet' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

add_action('style_outlet_action_before_content','style_outlet_add_featured_slider');
if( ! function_exists ( 'style_outlet_add_featured_slider' )  ) {
	function style_outlet_add_featured_slider() {

		$slider_cat = get_theme_mod( 'slider_cat', '' );
		$slider_count = get_theme_mod( 'slider_count', 5 );   
		$slider_posts = array(   
			'cat' => absint($slider_cat),
			'posts_per_page' => intval($slider_count)             
		);
		
		$home_slider = get_theme_mod('slider_field',true); 
		if( $home_slider ):
		if ( $slider_cat ) { 
			$query = new WP_Query($slider_posts);        
			if( $query->have_posts()) : ?>
				<div class="flexslider free-flex">  
					<ul class="slides">
						<?php while($query->have_posts()) :
								$query->the_post();
								if( has_post_thumbnail() ) : ?>
								    <li>
								    	<div class="flex-image">
								    		<?php the_post_thumbnail('full'); ?>
								    	</div>
								    	<div class="flex-caption">
								    		<?php the_content( __('Read More','style-outlet') ); ?>
								    	</div>
								    </li>
							    <?php endif;?>			   
						<?php endwhile; ?>
					</ul>
				</div>
		
			<?php endif; ?>
		   <?php  
			$query = null;
			wp_reset_postdata();
			
		}
	    endif;
 	}


}

add_action('style_outlet_action_before_content','style_outlet_add_service_section',15);
if( ! function_exists ( 'style_outlet_add_service_section' ) ) {
	function style_outlet_add_service_section() { 
		$service_1 = get_theme_mod('service-1');
		$service_2 = get_theme_mod('service-2');
		$service_3 = get_theme_mod('service-3');
		$service_section = get_theme_mod('enable_service_section',true); 
		if( $service_section && ( $service_1 || $service_2 || $service_3 ) ) { 
			$service_pages = array($service_1,$service_2,$service_3);
			$args = array(
				'post_type' => 'page',
				'post__in' => $service_pages,  
				'posts_per_page' => -1,
				'orderby' => 'post__in'
			);
			$query = new WP_Query($args);
			if( $query->have_posts()) {?>
				<div id="content" class="site-content">
					<div class="container">
						<main id="main" class="site-main" role="main">
							<?php $i = 1;
							while($query->have_posts()) :
								$query->the_post(); ?>
									<div class="one-third service column">
										<?php if($i != 2): ?>
											<div class="service-wrapper">
												<?php if( has_post_thumbnail() ) : ?>
													<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('style_outlet_service_img'); ?></a>
												<?php endif; ?>
										<?php else :?>
											<div class="service-wrapper box-right">
												<?php if( has_post_thumbnail() ) : ?>
													<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('style_outlet_service_img'); ?></a>
												<?php endif; ?>
										<?php endif;?>
									    	<div class="service-content">
									    	    <?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
										    	<?php the_content(); ?>
									    	</div>
							   			 </div>
							   		</div>
							   		<?php $i++;
					   		 endwhile; ?>
					   		 
						</main>
					</div>
				</div>
			<?php } 
			$query = null;
			$args = null;
			wp_reset_postdata(); 
		}
	}
}

add_filter('woocommerce_show_page_title','style_outlet_show_page_title'); 
function style_outlet_show_page_title() { ?>
	<h1 class="page-title"><span><?php woocommerce_page_title(); ?></span></h1>
<?php }


/**
  * Generates Breadcrumb Navigation
  */
 
if( ! function_exists( 'style_outlet_breadcrumbs' )) {
 
	function style_outlet_breadcrumbs() {
		/* === OPTIONS === */
		$text['home']     = __( '<i class="fa fa-home"></i>','style-outlet' ); // text for the 'Home' link
		$text['category'] = __( 'Archive by Category "%s"','style-outlet' ); // text for a category page
		$text['search']   = __( 'Search Results for "%s" Query','style-outlet' ); // text for a search results page
		$text['tag']      = __( 'Posts Tagged "%s"','style-outlet' ); // text for a tag page
		$text['author']   = __( 'Articles Posted by %s','style-outlet' ); // text for an author page
		$text['404']      = __( 'Error 404','style-outlet' ); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$breadcrumb_char = get_theme_mod( 'breadcrumb_char', '1' );
		if ( $breadcrumb_char ) {
		 switch ( $breadcrumb_char ) {
		 	case '2' :
		 		$delimiter = ' &#47; ';
		 		break;
		 	case '3':
		 		$delimiter = ' &gt; ';
		 		break;
		 	case '1':
		 	default:
		 		$delimiter = ' &raquo; ';
		 		break;
		 }
		}

		$before      = '<span class="current">'; // tag before the current crumb
		$after       = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$homeLink = esc_url(home_url()) . '/';
		$linkBefore = '<span typeof="v:Breadcrumb">';
		$linkAfter = '</span>';
		$linkAttr = ' rel="v:url" property="v:title"';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . esc_url($homeLink) . '">' . $text['home'] . '</a></div>';

		} else {

			echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, esc_url($homeLink), $text['home']) . $delimiter;

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
				}
				echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time(__( 'Y', 'style-outlet') )), get_the_time(__( 'Y', 'style-outlet'))) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time(__( 'Y', 'style-outlet')),get_the_time(__( 'm', 'style-outlet'))), get_the_time(__( 'F', 'style-outlet'))) . $delimiter;
				echo $before . get_the_time(__( 'd', 'style-outlet')) . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time(__( 'Y', 'style-outlet'))), get_the_time(__( 'Y', 'style-outlet'))) . $delimiter;
				echo $before . get_the_time(__( 'F', 'style-outlet')) . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time(__( 'Y', 'style-outlet')) . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {  
					$post_type = get_post_type_object(get_post_type()); 
					printf($link, get_post_type_archive_link(get_post_type()), $post_type->labels->singular_name);
					if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {   
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
		 		global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page', 'style-outlet' ) . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</div>';

		}
	
	} // end style_outlet_breadcrumbs()

}



// Related Posts Function by Tags (call using style_outlet_related_posts(); ) /NecessarY/ May be write a shortcode?
if ( ! function_exists( 'style_outlet_related_posts' ) ) :
	function style_outlet_related_posts() {
		echo '<ul id="style_outlet_related_posts">';
		global $post;
		$post_hierarchy = get_theme_mod('related_posts_hierarchy','1');
		$relatedposts_per_page  =  get_option('post_per_page') ;
		if($post_hierarchy == '1') {
			$related_post_type = wp_get_post_tags($post->ID);
			$tag_arr = '';
			if($related_post_type) {
				foreach($related_post_type as $tag) { $tag_arr .= $tag->slug . ','; }
		        $args = array(
		        	'tag' => esc_html($tag_arr),
		        	'numberposts' => intval( $relatedposts_per_page ), /* you can change this to show more */
		        	'post__not_in' => array($post->ID)
		     	);
		   }
		}else {
			$related_post_type = get_the_category($post->ID); 
			if ($related_post_type) {
				$category_ids = array();
				foreach($related_post_type as $category) {
				     $category_ids = $category->term_id; 
				}  
				$args = array(
					'category__in' => absint($category_ids), 
					'post__not_in' => array($post->ID),
					'numberposts' => intval($relatedposts_per_page),
		        );
		    }
		}
		if( $related_post_type ) {
	        $related_posts = get_posts($args);
	        if($related_posts) {
	        	foreach ($related_posts as $post) : setup_postdata($post); ?>
		           	<li class="related_post">
		           		<a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('recent-work'); ?></a>
		           		<a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		           	</li>
		        <?php endforeach; }
		    else {
	            echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'style-outlet' ) . '</li>'; 
			 }
		}else{
			echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'style-outlet' ) . '</li>';
		}
		wp_reset_postdata();
		
		echo '</ul>';
	}
endif;

/* Admin notice */
/* Activation notice */
add_action( 'load-themes.php',  'style_outlet_one_activation_admin_notice'  );

if( !function_exists('style_outlet_one_activation_admin_notice') ) {
	function style_outlet_one_activation_admin_notice() {
        global $pagenow;
	    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
	        add_action( 'admin_notices', 'style_outlet_admin_notice' );
	    }   
	} 
}  

/**
 * Add admin notice when active theme
 *
 * @return bool|null
 */
function style_outlet_admin_notice() { ?>
    <div class="updated notice notice-alt notice-success is-dismissible">  
        <p><?php printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'style-outlet' ), 'Style Outlet', esc_url( admin_url( 'themes.php?page=style_outlet_upgrade' ) ) ); ?></p>
        <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=style_outlet_upgrade' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Style Outlet', 'style-outlet' ); ?></a></p>
    </div><?php
}