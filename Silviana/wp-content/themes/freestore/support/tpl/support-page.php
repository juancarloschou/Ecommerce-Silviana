<div class="wrap support-page-wrap">
    
    <h2 class="support-page-title">
        <?php _e( 'Support Our Development', 'freestore' ); ?>
    </h2>
    
    <div class="support-page-inner-wrap">
        
        <div class="support-text">
            
            <p><?php printf( __( '<a href="%s" target="_blank">FreeStore</a> is a completely free theme packed with a bunch of settings.', 'freestore' ) , 'https://kairaweb.com/theme/freestore' ); ?></p>
            
            <p><?php printf( __( 'We\'d like to keep FreeStore as a free theme, so please support us by donating an amount of your choice and <a href="%s" target="_blank">Let us know</a> what features you\'d like added on.', 'freestore' ) , 'https://kairaweb.com/support-contact/' ); ?></p>
            
            <p><?php printf( __( 'If you would like to support our future theme development then please feel free to donate an amount of your choice. We\'d like to keep building onto FreeStore to make it a great theme for all users and create many different settings and styles and turn it into a power theme.', 'freestore' ) ); ?></p>
                
            <p><?php printf( __( 'Please send a donation to get <a href="%s" target="_blank">theme support</a> for FreeStore and help us build lots more onto this theme.', 'freestore' ) , 'https://kairaweb.com/support/' ); ?></p>
            
            <p><?php printf( __( 'You can select an amount we\'ve provided or enter your own amount below.', 'freestore' ) ); ?></p>
            
            <p><strong><?php printf( __( 'PayPal still takes a cut so that is why we make the least amount $15', 'freestore' ) ); ?></strong></p>
            
        </div>
        
        <div class="support-select">
            
            <p><?php printf( __( 'Select the amount you\'d like to donate.', 'freestore' ) ); ?></p>
            
            <div class="support-select-radios">
                
                <label for="support_value_fifteen" class="support-select-radio">
                    <input type="radio" name="support_amount" id="support_value_fifteen" class="support-radio-input" value="15" />
                    <span><?php _e( 'Donate $15 <b>(Budget Donation)</b>', 'freestore' ); ?></span>
                </label>
                <div class="clearboth"></div>
                
                <label for="support_value_twenty" class="support-select-radio support-select-radio-selected">
                    <input type="radio" name="support_amount" id="support_value_twenty" class="support-radio-input" value="20" checked/>
                    <span><?php _e( 'Donate $20 <b>(Appreciate the work done)</b>', 'freestore' ); ?></span>
                </label>
                <div class="clearboth"></div>
                
                <label for="support_value_twentyfive" class="support-select-radio">
                    <input type="radio" name="support_amount" id="support_value_twentyfive" class="support-radio-input" value="25" />
                    <span><?php _e( 'Donate $25 <b>(Thank you for a great theme)</b>', 'freestore' ); ?></span>
                </label>
                <div class="clearboth"></div>
                
                <label for="support_value_custom" class="support-select-radio support-select-radio-custom">
                    <input type="radio" name="support_amount" id="support_value_custom" class="support-radio-input" value="35" />
                    <span><?php _e( 'Enter my own amount <b>(Very Happy to support further development)</b>', 'freestore' ); ?></span>
                    <div class="support-value-custom-disable"></div>
                    <input type="number" value="35" class="support-amount-input" min="11" />
                </label>
                
            </div>
            
        </div>
        
        <div class="support-donate-low">
            <div class="support-donate-low-inner">
                <p><?php printf( __( 'Although we appreciate your donation, we can only offer prioritized support for orders of $11 or more.', 'freestore' ) ); ?></p>
                <p><?php printf( __( 'Support is prioritized by the amount paid.', 'freestore' ) ); ?></p>
            </div>
        </div>
        
        <div class="support-page-donate">
            
            <a href="http://kaira.fetchapp.com/sell/a9380c28?amount=20" id="support-purchase-link" target="_blank">
                <?php printf( __( "<span>Donate Now </span><em>$20</em>", 'freestore' ) ); ?>
            </a>
            
        </div>
        <div class="clearboth"></div>
    </div>
    
</div>