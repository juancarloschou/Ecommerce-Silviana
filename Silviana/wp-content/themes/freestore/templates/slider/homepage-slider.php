<?php if ( get_theme_mod( 'freestore-slider-type' ) == 'freestore-no-slider' ) : ?>
    
    <!-- No Slider -->

<?php elseif ( get_theme_mod( 'freestore-slider-type' ) == 'freestore-meta-slider' ) : ?>
    
    <?php
    $slider_code = '';
    if ( get_theme_mod( 'freestore-meta-slider-shortcode' ) ) {
        $slider_code = get_theme_mod( 'freestore-meta-slider-shortcode' );
    } ?>
    
    <?php echo ( $slider_code ) ? do_shortcode( esc_html( $slider_code ) ) : ''; ?>
    
<?php else : ?>
    
    <?php
    $slider_cats = '';
    if ( get_theme_mod( 'freestore-slider-cats' ) ) {
        $slider_cats = get_theme_mod( 'freestore-slider-cats' );
    } ?>
    
    <?php if( $slider_cats ) : ?>
        
        <?php $slider_query = new WP_Query( 'cat=' . esc_html( $slider_cats ) . '&posts_per_page=-1&orderby=date&order=DESC' ); ?>
        
        <?php if ( $slider_query->have_posts() ) : ?>

            <div class="home-slider-wrap home-slider-remove" data-auto="<?php echo ( get_theme_mod( 'freestore-slider-auto-scroll' ) ) ? 'false' : '6500'; ?>">
                <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
                <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                
                <div class="home-slider">
                    
                    <?php while ( $slider_query->have_posts() ) : $slider_query->the_post();
                        $slider_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                        
                        <?php if ( get_theme_mod( 'freestore-slider-linkto-post' ) ) : ?>
                        <a class="home-slider-block" href="<?php the_permalink(); ?>"<?php echo ( has_post_thumbnail() ) ? ' style="background-image: url(' . esc_url( $slider_thumbnail['0'] ) . ');"' : ''; ?>>
                        <?php else : ?>
                        <div class="home-slider-block"<?php echo ( has_post_thumbnail() ) ? ' style="background-image: url(' . esc_url( $slider_thumbnail['0'] ) . ');"' : ''; ?>>
                        <?php endif; ?>
                        
                            <?php if ( get_theme_mod( 'freestore-slider-size' ) == 'freestore-slider-size-small' ) : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_small.gif" />
                            <?php elseif ( get_theme_mod( 'freestore-slider-size' ) == 'freestore-slider-size-large' ) : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_large.gif" />
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_medium.gif" />
                            <?php endif; ?>
                            
                            <?php if ( !get_theme_mod( 'freestore-slider-remove-title' ) ) : ?>
                                <div class="home-slider-block-inner">
                                    <h3>
                                        <?php the_title(); ?>
                                    </h3>
                                    <?php if ( has_excerpt() ) : ?>
                                        <p><?php the_excerpt(); ?></p>
                                    <?php else : ?>
                                        <p><?php the_content(); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                        <?php if ( get_theme_mod( 'freestore-slider-linkto-post' ) ) : ?>
                        </a>
                        <?php else : ?>
                        </div>
                        <?php endif; ?>
                    
                    <?php endwhile; ?>
                    
                </div>
                <div class="home-slider-pager"></div>
                <?php do_action ( 'freestore_after_default_slider' ); ?>
            </div>
            
        <?php endif; wp_reset_query(); ?>
        
    <?php else : ?>
        
        <div class="home-slider-wrap home-slider-remove" data-auto="<?php echo ( get_theme_mod( 'freestore-slider-auto-scroll' ) ) ? 'false' : '6500'; ?>">
            <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
            <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                
            <div class="home-slider">
                
                <div class="home-slider-block" style="background-image: url(<?php echo get_template_directory_uri() ?>/images/demo/slider_default_01.jpg);">
                    
                    <?php if ( get_theme_mod( 'freestore-slider-size' ) == 'freestore-slider-size-small' ) : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_small.gif" />
                    <?php elseif ( get_theme_mod( 'freestore-slider-size' ) == 'freestore-slider-size-large' ) : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_large.gif" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_medium.gif" />
                    <?php endif; ?>
                    
                    <?php if ( !get_theme_mod( 'freestore-slider-remove-title' ) ) : ?>
                        
                        <div class="home-slider-block-inner">
                            <h3>
                                <?php _e( 'Free Online Store', 'freestore' ); ?>
                            </h3>
                            <p><?php _e( 'With FreeStore we give you the full premium theme', 'freestore' ); ?></p>
                        </div>
                        
                    <?php endif; ?>
                    
                </div>
                
                <div class="home-slider-block" style="background-image: url(<?php echo get_template_directory_uri() ?>/images/demo/slider_default_02.jpg);">
                    
                    <?php if ( get_theme_mod( 'freestore-slider-size' ) == 'freestore-slider-size-small' ) : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_small.gif" />
                    <?php elseif ( get_theme_mod( 'freestore-slider-size' ) == 'freestore-slider-size-large' ) : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_large.gif" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_medium.gif" />
                    <?php endif; ?>
                    
                    <?php if ( !get_theme_mod( 'freestore-slider-remove-title' ) ) : ?>
                        
                        <div class="home-slider-block-inner">
                            <h3>
                                <?php _e( 'Very Customizable', 'freestore' ); ?>
                            </h3>
                            <p><?php _e( 'Integrated with top WordPress plugins', 'freestore' ); ?></p>
                        </div>
                        
                    <?php endif; ?>
                    
                </div>
                
            </div>
            <div class="home-slider-pager"></div>
            
        </div>

    <?php endif; ?>
    
<?php endif; ?>