<footer id="colophon" class="site-footer site-footer-centered" role="contentinfo">
	
    <div class="site-container">
        <ul>
            <?php dynamic_sidebar( 'freestore-site-footer-centered' ); ?>
        </ul>
        <div class="clearboth"></div>
    </div>
	
</footer>

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