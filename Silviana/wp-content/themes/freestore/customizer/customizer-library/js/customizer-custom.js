/**
 * Customizer Custom Functionality
 */
( function( $ ) {
    
    $( window ).load( function() {
        
        var site_layout_select_value = $( '#customize-control-freestore-site-layout select' ).val();
        freestore_customizer_site_layout_check( site_layout_select_value );
        
        $( '#customize-control-freestore-site-layout select' ).on( 'change', function() {
            var site_layout_value = $( this ).val();
            freestore_customizer_site_layout_check( site_layout_value );
        } );
        
        function freestore_customizer_site_layout_check( site_layout_value ) {
            if ( site_layout_value == 'freestore-site-boxed' ) {
                $( '#sub-accordion-section-colors #customize-control-freestore-boxed-bg-color' ).show();
            } else {
                $( '#sub-accordion-section-colors #customize-control-freestore-boxed-bg-color' ).hide();
            }
        }
        
        //Show / Hide Color selector for slider setting
        var the_slider_select_value = $( '#customize-control-freestore-slider-type select' ).val();
        freestore_customizer_slider_check( the_slider_select_value );
        
        $( '#customize-control-freestore-slider-type select' ).on( 'change', function() {
            var slider_select_value = $( this ).val();
            freestore_customizer_slider_check( slider_select_value );
        } );
        
        function freestore_customizer_slider_check( slider_select_value ) {
            if ( slider_select_value == 'freestore-slider-default' ) {
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-meta-slider-shortcode' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-cats' ).show();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-size' ).show();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-linkto-post' ).show();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-remove-title' ).show();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-auto-scroll' ).show();
            } else if ( slider_select_value == 'freestore-meta-slider' ) {
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-cats' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-size' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-linkto-post' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-remove-title' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-auto-scroll' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-meta-slider-shortcode' ).show();
            } else {
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-cats' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-size' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-linkto-post' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-remove-title' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-slider-auto-scroll' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-slider #customize-control-freestore-meta-slider-shortcode' ).hide();
            }
        }
        
        //Show / Hide Color selector for blocks layout setting
        var the_body_blocks_select_value = $( '#customize-control-freestore-page-styling select' ).val();
        freestore_customizer_page_style_check( the_body_blocks_select_value );
        
        $( '#customize-control-freestore-page-styling select' ).on( 'change', function() {
            var body_style_select_value = $( this ).val();
            freestore_customizer_page_style_check( body_style_select_value );
        } );
        
        function freestore_customizer_page_style_check( body_style_select_value ) {
            if ( body_style_select_value == 'freestore-page-styling-flat' ) {
                $( '#sub-accordion-section-freestore-panel-layout-section-layout #customize-control-freestore-page-styling-color' ).hide();
            } else {
                $( '#sub-accordion-section-freestore-panel-layout-section-layout #customize-control-freestore-page-styling-color' ).show();
            }
        }
        
        // Show / Hide Page Featured Image Layout
        var freestore_page_layout_value = $( '#customize-control-freestore-page-fimage-layout select' ).val();
        freestore_page_layout_type_check( freestore_page_layout_value );
        
        $( '#customize-control-freestore-page-fimage-layout select' ).on( 'change', function() {
            var freestore_page_select_value = $( this ).val();
            freestore_page_layout_type_check( freestore_page_select_value );
        });
        
        function freestore_page_layout_type_check( freestore_page_select_value ) {
            if ( freestore_page_select_value == 'freestore-page-fimage-layout-banner' ) {
                $( '#sub-accordion-section-freestore-panel-layout-section-pages #customize-control-freestore-page-fimage-size' ).show();
                $( '#sub-accordion-section-freestore-panel-layout-section-pages #customize-control-freestore-page-fimage-fullwidth' ).show();
            } else {
                $( '#sub-accordion-section-freestore-panel-layout-section-pages #customize-control-freestore-page-fimage-size' ).hide();
                $( '#sub-accordion-section-freestore-panel-layout-section-pages #customize-control-freestore-page-fimage-fullwidth' ).hide();
            }
        }
        
        //Show / Hide Color depending on footer selected
        var the_footer_select_value = $( '#customize-control-freestore-footer-layout select' ).val();
        freestore_customizer_footer_check( the_footer_select_value );
        
        $( '#customize-control-freestore-footer-layout select' ).on( 'change', function() {
            var footer_selected_value = $( this ).val();
            freestore_customizer_footer_check( footer_selected_value );
        } );
        
        function freestore_customizer_footer_check( footer_selected_value ) {
            if ( footer_selected_value == 'freestore-footer-layout-standard' ) {
                $( '#sub-accordion-section-colors #customize-control-freestore-footer-bg-color' ).removeClass( 'hide-section' );
                $( '#sub-accordion-section-colors #customize-control-freestore-footer-font-color' ).removeClass( 'hide-section' );
            } else if ( footer_selected_value == 'freestore-footer-layout-none' ) {
                $( '#sub-accordion-section-colors #customize-control-freestore-footer-bg-color' ).addClass( 'hide-section' );
                $( '#sub-accordion-section-colors #customize-control-freestore-footer-font-color' ).addClass( 'hide-section' );
            } else {
                $( '#sub-accordion-section-colors #customize-control-freestore-footer-bg-color' ).addClass( 'hide-section' );
                $( '#sub-accordion-section-colors #customize-control-freestore-footer-font-color' ).removeClass( 'hide-section' );
            }
        }
        
    } );
    
} )( jQuery );