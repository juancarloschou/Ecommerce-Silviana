<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Pleasant Lite
 */
?>
<div id="footer-wrapper">
    	<div class="container">
              <?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>             
               <?php endif; // end footer widget area ?>    
                        
               <?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>                                  	
               <?php endif; // end footer widget area ?>   
            
               <?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>                
               <?php endif; // end footer widget area ?>  
                
                
            <div class="clear"></div>
        </div><!--end .container--> 
        
        <div class="copyright-wrapper">
        	<div class="container">
            	<div class="copyright-txt">
				    <?php bloginfo('name'); ?> <?php _e('All Rights Reserved', 'pleasant-lite');?>                
       			 </div>
                <div class="design-by">
                 <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'pleasant-lite' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'pleasant-lite' ), 'WordPress' ); ?></a>	
                </div>
                <div class="clear"></div>
            </div>            
        </div><!--end .copyright-wrapper--> 
               
    </div><!--end .footer-wrapper--> 
<?php wp_footer(); ?>

</body>
</html>