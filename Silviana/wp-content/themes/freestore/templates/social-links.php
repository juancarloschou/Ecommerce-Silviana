<?php
if( get_theme_mod( 'freestore-social-email' ) ) :
    echo '<a href="' . esc_url( 'mailto:' . antispambot( get_theme_mod( 'freestore-social-email' ), 1 ) ) . '" title="' . __( 'Send Us an Email', 'freestore' ) . '" class="header-social-icon social-email"><i class="fa fa-envelope-o"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-skype' ) ) :
    echo '<a href="skype:' . esc_html( get_theme_mod( 'freestore-social-skype' ) ) . '?userinfo" title="' . __( 'Contact Us on Skype', 'freestore' ) . '" class="header-social-icon social-skype"><i class="fa fa-skype"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-facebook' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-facebook' ) ) . '" target="_blank" title="' . __( 'Find Us on Facebook', 'freestore' ) . '" class="header-social-icon social-facebook"><i class="fa fa-facebook"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-twitter' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-twitter' ) ) . '" target="_blank" title="' . __( 'Follow Us on Twitter', 'freestore' ) . '" class="header-social-icon social-twitter"><i class="fa fa-twitter"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-google-plus' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-google-plus' ) ) . '" target="_blank" title="' . __( 'Find Us on Google Plus', 'freestore' ) . '" class="header-social-icon social-gplus"><i class="fa fa-google-plus"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-snapchat' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-snapchat' ) ) . '" target="_blank" title="' . __( 'Follow Us on SnapChat', 'freestore' ) . '" class="header-social-icon social-snapchat"><i class="fa fa-snapchat"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-etsy' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-etsy' ) ) . '" target="_blank" title="' . __( 'Find Us on Etsy', 'freestore' ) . '" class="header-social-icon social-etsy"><i class="fa fa-etsy"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-yelp' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-yelp' ) ) . '" target="_blank" title="' . __( 'Find Us on Yelp', 'freestore' ) . '" class="header-social-icon social-yelp"><i class="fa fa-yelp"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-youtube' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-youtube' ) ) . '" target="_blank" title="' . __( 'View our YouTube Channel', 'freestore' ) . '" class="header-social-icon social-youtube"><i class="fa fa-youtube-play"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-instagram' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-instagram' ) ) . '" target="_blank" title="' . __( 'Follow Us on Instagram', 'freestore' ) . '" class="header-social-icon social-instagram"><i class="fa fa-instagram"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-pinterest' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-pinterest' ) ) . '" target="_blank" title="' . __( 'Pin Us on Pinterest', 'freestore' ) . '" class="header-social-icon social-pinterest"><i class="fa fa-pinterest"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-medium' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-medium' ) ) . '" target="_blank" title="' . __( 'Find us on Medium', 'freestore' ) . '" class="header-social-icon social-medium"><i class="fa fa-medium"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-behance' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-behance' ) ) . '" target="_blank" title="' . __( 'Find us on Behance', 'freestore' ) . '" class="header-social-icon social-behance"><i class="fa fa-behance"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-product-hunt' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-product-hunt' ) ) . '" target="_blank" title="' . __( 'Find us on Product Hunt', 'freestore' ) . '" class="header-social-icon social-product-hunt"><i class="fa fa-product-hunt"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-slack' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-slack' ) ) . '" target="_blank" title="' . __( 'Find us on Slack', 'freestore' ) . '" class="header-social-icon social-slack"><i class="fa fa-slack"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-linkedin' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-linkedin' ) ) . '" target="_blank" title="' . __( 'Find Us on LinkedIn', 'freestore' ) . '" class="header-social-icon social-linkedin"><i class="fa fa-linkedin"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-tumblr' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-tumblr' ) ) . '" target="_blank" title="' . __( 'Find Us on Tumblr', 'freestore' ) . '" class="header-social-icon social-tumblr"><i class="fa fa-tumblr"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-flickr' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-flickr' ) ) . '" target="_blank" title="' . __( 'Find Us on Flickr', 'freestore' ) . '" class="header-social-icon social-flickr"><i class="fa fa-flickr"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-houzz' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-houzz' ) ) . '" target="_blank" title="' . __( 'Find our profile on Houzz', 'freestore' ) . '" class="header-social-icon social-houzz"><i class="fa fa-houzz"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-vk' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-vk' ) ) . '" target="_blank" title="' . __( 'Find Us on VK', 'freestore' ) . '" class="header-social-icon social-vk"><i class="fa fa-vk"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-tripadvisor' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-tripadvisor' ) ) . '" target="_blank" title="' . __( 'Find Us on TripAdvisor', 'freestore' ) . '" class="header-social-icon social-tripadvisor"><i class="fa fa-tripadvisor"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-github' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-github' ) ) . '" target="_blank" title="' . __( 'Find Us on GitHub', 'freestore' ) . '" class="header-social-icon social-github"><i class="fa fa-github"></i></a>';
endif;

if( get_theme_mod( 'freestore-social-custom-class' ) && get_theme_mod( 'freestore-social-custom-url' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-custom-url' ) ) . '" target="_blank" class="header-social-icon social-custom"><i class="fa ' . sanitize_html_class( get_theme_mod( 'freestore-social-custom-class' ) ) . '"></i></a>';
endif;