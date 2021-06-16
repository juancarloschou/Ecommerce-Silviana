<?php
if ( ! function_exists('Comley_setup')):
function Comley_setup() {
load_theme_textdomain('comley', get_template_directory() . '/languages');
// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );
/* Load scripts. */
add_theme_support( 
	'Comley-scripts', 
	array( 'comment-reply' ) 
);
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_image_size('page-thumbnail', 750, 329, TRUE);
add_theme_support('content-width', 770);
// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'comley'),
) );
add_theme_support('html5', array(
	'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );
add_editor_style( array('editor-style.css', comley_google_web_fonts_url()));
$args = array(
'default-color' => '',
'default-image' => '',
);
add_theme_support( 'custom-background', $args);
$args = array(
        'default-text-color' => '5b5b5b',
        'default-image' => '',
        'height' => 250,
        'width' => 1060,
        'max-width' => 2000,
        'flex-height' => true,
        'flex-width' => true,
        'random-default' => false,
        'wp-head-callback' => 'comley_header_style',
       
    );
    add_theme_support('custom-header', $args );
	add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 300,
        'flex-width' => true,
        'flex-height' => true,
    ));
}
endif; // Comley_setup
add_action('after_setup_theme', 'Comley_setup');
/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Comley 1.8
 */
function comley_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'comley_content_width', 1170);
}
add_action( 'after_setup_theme', 'comley_content_width', 0 );
function comley_header_style() {
    $text_color = get_header_textcolor();
    ?>
    <style type="text/css">
    <?php if (!display_header_text() ) : ?>
        .brand-title{ color:#4b4b4b;  }
    <?php else : ?>
        .brand-title{ color:#<?php echo esc_html($text_color); ?>;   }
    <?php endif; ?>
     
    </style>
    <?php } ?>