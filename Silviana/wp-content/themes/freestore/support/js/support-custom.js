/**
 * FreeStore Custom admin JS Functionality
 *
 */
( function( $ ) {
    
    var donate_min = Number( $( 'div.support-select-radios label.support-select-radio-custom .support-amount-input' ).attr( 'min' ) );
    
    jQuery( document ).ready( function() {
        
        // Change to selected radio amount
        $( 'div.support-select-radios label.support-select-radio' ).change( function() {
            var donate_value = $( this ).find( 'input.support-radio-input' ).val();
            
            $( 'div.support-select-radios label.support-select-radio' ).removeClass( 'support-select-radio-selected' );
            $( this ).addClass( 'support-select-radio-selected' );
            
            if ( $( this ).hasClass( 'support-select-radio-custom' ) ) {
                donate_value = $( 'div.support-select-radios label.support-select-radio-custom .support-amount-input' ).val();
                donate_value = parseFloat( donate_value ).toFixed( 0 );
                if ( isNaN( donate_value ) ) donate_value = donate_min;
                donate_value = Math.max( donate_value, donate_min );
            }
            
            $( 'a#support-purchase-link em' ).html( '$' + donate_value );
            
            var donate_link = $( 'a#support-purchase-link' ).attr( 'href' );
            var new_donate_link = donate_link.split( '=', 1 )[0];
            $( 'a#support-purchase-link' ).attr( 'href', new_donate_link + '=' + donate_value );
            
        });
        
        // Change amount to custom value
        $( 'div.support-select-radios label.support-select-radio-custom .support-amount-input' ).keyup( function() {
           
            var donate_custom_value = $( this ).val().replace( /[^0-9.]/g, '' );
            var donate_custom_value = parseFloat( donate_custom_value ).toFixed( 0 );
            if ( isNaN( donate_custom_value ) ) donate_custom_value = donate_min;
            donate_custom_value = Math.max( donate_custom_value, donate_min );
            
            var donate_link = $( 'a#support-purchase-link' ).attr( 'href' );
            var new_donate_link = donate_link.split( '=', 1 )[0];
            $( 'a#support-purchase-link' ).attr( 'href', new_donate_link + '=' + donate_custom_value );
            
            // Payment too low message
            if ( donate_custom_value >= 15 ) $( '.support-page-inner-wrap .support-donate-low' ).slideUp();
            else $( '.support-page-inner-wrap .support-donate-low' ).slideDown();
            
        }).change( function() { $(this).keyup(); });
        
        // Handle clicking the donate button
        $( 'a#support-purchase-link' ).click( function(e) {
            e.preventDefault();
            window.open( $(this).attr( 'href' ), '_blank', 'width=960,height=800,resizeable,scrollbars' );
            $( 'html, body' ).animate( {'scrollTop':0} );
            return false;
        });
        
    });
    
    $(window).resize(function () {
        
        
        
    }).resize();
    
    $(window).load(function() {
        
        
        
    });
    
} )( jQuery );