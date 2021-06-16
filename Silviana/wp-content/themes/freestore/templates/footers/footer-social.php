<footer id="colophon" class="site-footer site-footer-social" role="contentinfo">
	
	<div class="site-footer-icons">
        <div class="site-container">
        	
        	<?php if ( ! get_theme_mod( 'freestore-footer-hide-social' ) ) : ?>
	            
	            <?php
				if( get_theme_mod( 'freestore-social-email' ) ) :
				    echo '<a href="' . esc_url( 'mailto:' . antispambot( get_theme_mod( 'freestore-social-email' ), 1 ) ) . '" title="' . __( 'Send Us an Email', 'freestore' ) . '" class="footer-social-icon footer-social-email"><i class="fa fa-envelope-o"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-skype' ) ) :
				    echo '<a href="skype:' . esc_html( get_theme_mod( 'freestore-social-skype' ) ) . '?userinfo" title="' . __( 'Contact Us on Skype', 'freestore' ) . '" class="footer-social-icon footer-social-skype"><i class="fa fa-skype"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-facebook' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-facebook' ) ) . '" target="_blank" title="' . __( 'Find Us on Facebook', 'freestore' ) . '" class="footer-social-icon footer-social-facebook"><i class="fa fa-facebook"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-twitter' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-twitter' ) ) . '" target="_blank" title="' . __( 'Follow Us on Twitter', 'freestore' ) . '" class="footer-social-icon footer-social-twitter"><i class="fa fa-twitter"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-google-plus' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-google-plus' ) ) . '" target="_blank" title="' . __( 'Find Us on Google Plus', 'freestore' ) . '" class="footer-social-icon footer-social-gplus"><i class="fa fa-google-plus"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-snapchat' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-snapchat' ) ) . '" target="_blank" title="' . __( 'Follow Us on SnapChat', 'freestore' ) . '" class="footer-social-icon footer-social-snapchat"><i class="fa fa-snapchat"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-etsy' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-etsy' ) ) . '" target="_blank" title="' . __( 'Find Us on Etsy', 'freestore' ) . '" class="footer-social-icon footer-social-etsy"><i class="fa fa-etsy"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-yelp' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-yelp' ) ) . '" target="_blank" title="' . __( 'Find Us on Yelp', 'freestore' ) . '" class="footer-social-icon footer-social-yelp"><i class="fa fa-yelp"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-youtube' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-youtube' ) ) . '" target="_blank" title="' . __( 'View our YouTube Channel', 'freestore' ) . '" class="footer-social-icon footer-social-youtube"><i class="fa fa-youtube-play"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-vimeo' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-vimeo' ) ) . '" target="_blank" title="' . __( 'View our Vimeo Channel', 'freestore' ) . '" class="footer-social-icon footer-social-vimeo"><i class="fa fa-vimeo"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-instagram' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-instagram' ) ) . '" target="_blank" title="' . __( 'Follow Us on Instagram', 'freestore' ) . '" class="footer-social-icon footer-social-instagram"><i class="fa fa-instagram"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-pinterest' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-pinterest' ) ) . '" target="_blank" title="' . __( 'Pin Us on Pinterest', 'freestore' ) . '" class="footer-social-icon footer-social-pinterest"><i class="fa fa-pinterest"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-medium' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-medium' ) ) . '" target="_blank" title="' . __( 'Find us on Medium', 'freestore' ) . '" class="footer-social-icon social-medium"><i class="fa fa-medium"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-behance' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-behance' ) ) . '" target="_blank" title="' . __( 'Find us on Behance', 'freestore' ) . '" class="footer-social-icon social-behance"><i class="fa fa-behance"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-product-hunt' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-product-hunt' ) ) . '" target="_blank" title="' . __( 'Find us on Product Hunt', 'freestore' ) . '" class="footer-social-icon social-product-hunt"><i class="fa fa-product-hunt"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-slack' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-slack' ) ) . '" target="_blank" title="' . __( 'Find us on Slack', 'freestore' ) . '" class="footer-social-icon social-slack"><i class="fa fa-slack"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-linkedin' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-linkedin' ) ) . '" target="_blank" title="' . __( 'Find Us on LinkedIn', 'freestore' ) . '" class="footer-social-icon footer-social-linkedin"><i class="fa fa-linkedin"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-tumblr' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-tumblr' ) ) . '" target="_blank" title="' . __( 'Find Us on Tumblr', 'freestore' ) . '" class="footer-social-icon footer-social-tumblr"><i class="fa fa-tumblr"></i></a>';
				endif;

				if( get_theme_mod( 'freestore-social-flickr' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-flickr' ) ) . '" target="_blank" title="' . __( 'Find Us on Flickr', 'freestore' ) . '" class="footer-social-icon footer-social-flickr"><i class="fa fa-flickr"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-houzz' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-houzz' ) ) . '" target="_blank" title="' . __( 'Find our profile on Houzz', 'freestore' ) . '" class="footer-social-icon social-houzz"><i class="fa fa-houzz"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-vk' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-vk' ) ) . '" target="_blank" title="' . __( 'Find Us on VK', 'freestore' ) . '" class="footer-social-icon social-vk"><i class="fa fa-vk"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-tripadvisor' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-tripadvisor' ) ) . '" target="_blank" title="' . __( 'Find Us on TripAdvisor', 'freestore' ) . '" class="footer-social-icon footer-social-tripadvisor"><i class="fa fa-tripadvisor"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-github' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-github' ) ) . '" target="_blank" title="' . __( 'Find Us on GitHub', 'freestore' ) . '" class="footer-social-icon footer-social-github"><i class="fa fa-github"></i></a>';
				endif;
				
				if( get_theme_mod( 'freestore-social-custom-class' ) && get_theme_mod( 'freestore-social-custom-url' ) ) :
				    echo '<a href="' . esc_url( get_theme_mod( 'freestore-social-custom-url' ) ) . '" target="_blank" class="footer-social-icon footer-social-custom"><i class="fa ' . sanitize_html_class( get_theme_mod( 'freestore-social-custom-class' ) ) . '"></i></a>';
				endif; ?>
			
			<?php endif; ?>
			
			<?php if ( get_theme_mod( 'freestore-website-site-add' ) ) : ?>
	        	<div class="site-footer-social-ad">
	        		<i class="fa fa-map-marker"></i> <?php echo wp_kses_post( get_theme_mod( 'freestore-website-site-add' ) ) ?>
	        	</div>
	        <?php endif; ?>
			
			<?php if ( get_theme_mod( 'freestore-website-txt-copy' ) ) : ?>
				<div class="site-footer-social-copy">
					<?php echo wp_kses_post( get_theme_mod( 'freestore-website-txt-copy' ) ) ?>
				</div>
			<?php endif; ?>
            
            <div class="clearboth"></div>
        </div>
    </div>
    
</footer>

<?php if ( get_theme_mod( 'freestore-footer-bottombar' ) == 0 ) : ?>
	
	<div class="site-footer-bottom-bar">
	
		<div class="site-container">
			
	        <?php wp_nav_menu( array( 'theme_location' => 'footer-bar','container' => false, 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
                
	    </div>
		
        <div class="clearboth"></div>
	</div>
	
<?php endif; ?>