<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
<header class="main-header">
<div class="header-top">
<section class="container">
<div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
<?php comley_social_media_icons(); ?> 
       </div>
            <div class="col-md-6 col-sm-6 col-xs-12"> 
            <?php get_search_form();?>
             </div>
      </div>
    </section>
</div><!--header-top-->
  <div class="container">
    <?php $logo_placement=get_theme_mod('logo_placement'); ?>
    <div class="brandlogo <?php  if($logo_placement=='left') { echo 'alignleft'; } else if($logo_placement=='right') { echo 'alignright'; }else if($logo_placement=='center') { echo 'aligncenter'; } else{ echo 'aligncenter'; } ?>"><a href="<?php echo esc_url(home_url('/')); ?>">
      <?php if(function_exists( 'the_custom_logo')): if(has_custom_logo()): 
	  the_custom_logo();
	  else : if(display_header_text()): ?>
      <h1 class="brand-title">
        <?php bloginfo('name'); ?>
      </h1>
      <p class="brand-subtitle"><?php bloginfo('description'); ?></p>
      <?php endif; endif; else : if(display_header_text()): ?>
      <h1 class="brand-title">
        <?php bloginfo('name'); ?>
      </h1>
      <p class="brand-subtitle"><?php bloginfo('description'); ?></p>
      <?php endif; endif; ?>
      </a></div>
    <!--brandlogo--> 
  </div>
  <nav class="navbar main-nav">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
      <span class="menu"><?php _e('menu','comley'); ?></span>
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <?php wp_nav_menu( array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav', 'menu_id' => '')); ?>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    
    <!-- /.container-fluid --> 
    
  </nav>
</header>
 <?php if ((is_front_page() && is_page_template('page-templates/template-home.php')) || (is_page_template('page-templates/template-home.php'))) { ?>
<?php } elseif(is_front_page()){ ?> <div class="inner-title"><h1><?php the_title(); ?></h1></div> <?php } elseif( is_home() && get_option('page_for_posts') ) {
	$blog_page_id = get_option('page_for_posts');
	echo '<div class="inner-title"><h1>'.get_page($blog_page_id)->post_title.'</h1></div>';
     } elseif(is_404()){ ?>
       <div class="inner-title"><h1><?php _e('404 error', 'comley' ); ?></h1></div>
     <?php } else {?>
	<div class="inner-title"><h1><?php the_title(); ?></h1></div>
<?php } ?>