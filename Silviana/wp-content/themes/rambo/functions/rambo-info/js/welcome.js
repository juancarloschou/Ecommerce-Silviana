jQuery(document).ready(function() {

	/* If there are required actions, add an icon with the number of required actions in the About rambo page -> Actions required tab */
    var rambo_nr_actions_required = ramboLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof rambo_nr_actions_required !== 'undefined') && (rambo_nr_actions_required != '0') ) {
        jQuery('li.rambo-w-red-tab a').append('<span class="rambo-actions-count">' + rambo_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".rambo-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'rambo_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : ramboLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.rambo-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + ramboLiteWelcomeScreenObject.template_directory + '/inc/rambo-info/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var rambo_lite_actions_count = jQuery('.rambo-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof rambo_lite_actions_count !== 'undefined' ) {
                    if( rambo_lite_actions_count == '1' ) {
                        jQuery('.rambo-actions-count').remove();
                        jQuery('.rambo-tab-pane#actions_required').append('<p>' + ramboLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.rambo-actions-count').text(parseInt(rambo_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

	/* Tabs in welcome page */
	function rambo_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".rambo-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var rambo_actions_anchor = location.hash;

	if( (typeof rambo_actions_anchor !== 'undefined') && (rambo_actions_anchor != '') ) {
		rambo_welcome_page_tabs('a[href="'+ rambo_actions_anchor +'"]');
	}

    jQuery(".rambo-nav-tabs a").click(function(event) {
        event.preventDefault();
		rambo_welcome_page_tabs(this);
    });

		/* Tab Content height matches admin menu height for scrolling purpouses */
	 $tab = jQuery('.rambo-tab-content > div');
	 $admin_menu_height = jQuery('#adminmenu').height();
	 if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
	 {
		 $newheight = $admin_menu_height - 180;
		 $tab.css('min-height',$newheight);
	 }

});
