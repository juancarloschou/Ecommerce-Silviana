
<?php if ( has_post_thumbnail() ) : ?>
    
    <?php echo ( !get_theme_mod( 'freestore-page-fimage-fullwidth' ) ) ? '<div class="site-container">' : ''; ?>
        
        <div class="page-fimage-banner <?php echo ( get_theme_mod( 'freestore-page-fimage-size' ) == 'freestore-page-fimage-size-actual' ) ? sanitize_html_class( 'page-fimage-banner-actual' ) : ''; ?>" <?php echo ( get_theme_mod( 'freestore-page-fimage-size' ) != 'freestore-page-fimage-size-actual' ) ? 'style="background-image: url(' . esc_url( get_the_post_thumbnail_url() ) . ');"' : ''; ?>>
            
            <?php if ( get_theme_mod( 'freestore-page-fimage-size' ) == 'freestore-page-fimage-size-actual' ) : ?>
                <?php the_post_thumbnail( 'full' ); ?>
            <?php elseif ( get_theme_mod( 'freestore-page-fimage-size' ) == 'freestore-page-fimage-size-extra-small' ) : ?>
                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_extra_small.gif" />
            <?php elseif ( get_theme_mod( 'freestore-page-fimage-size' ) == 'freestore-page-fimage-size-small' ) : ?>
                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_small.gif" />
            <?php elseif ( get_theme_mod( 'freestore-page-fimage-size' ) == 'freestore-page-fimage-size-large' ) : ?>
                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_large.gif" />
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_medium.gif" />
            <?php endif; ?>
            
        </div> <!-- .page-fimage-banner -->
        
    <?php echo ( !get_theme_mod( 'freestore-page-fimage-fullwidth' ) ) ? '</div>' : ''; ?>
    
<?php endif; ?>