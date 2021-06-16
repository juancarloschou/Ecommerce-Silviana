<footer id="colophon" class="site-footer site-footer-standard" role="contentinfo">
	
	<div class="site-footer-widgets">
        <div class="site-container">
            <?php if ( is_active_sidebar( 'freestore-site-footer-standard' ) ) : ?>
	            <ul>
	                <?php dynamic_sidebar( 'freestore-site-footer-standard' ); ?>
	            </ul>
	        <?php else : ?>
	        	<div class="site-footer-no-widgets">
	        		<?php _e( 'Add your own widgets here', 'freestore' ); ?>
	        	</div>
	    	<?php endif; ?>
            <div class="clearboth"></div>
        </div>
    </div>
    
    <?php if ( get_theme_mod( 'freestore-footer-bottombar' ) == 0 ) : ?>
		
		<div class="site-footer-bottom-bar">
		
			<div class="site-container">
				
				<div class="site-footer-bottom-bar-left">
	                
	                <?php echo wp_kses_post( get_theme_mod( 'freestore-website-txt-copy' ) ) ?>
	                
				</div>
		        
		        <div class="site-footer-bottom-bar-right">
	                
		            <?php wp_nav_menu( array( 'theme_location' => 'footer-bar','container' => false, 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
		            
		            <?php if ( ! get_theme_mod( 'freestore-footer-hide-social' ) ) : ?>
		            
		            	<?php get_template_part( '/templates/social-links' ); ?>
		            	
		            <?php endif; ?>
	                
		        </div>
		        
		    </div>
			
	        <div class="clearboth"></div>
		</div>
		
	<?php endif; ?>
	
</footer>