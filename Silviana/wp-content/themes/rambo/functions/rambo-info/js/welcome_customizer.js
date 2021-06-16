jQuery(document).ready(function() {
    var rambo_aboutpage = ramboLiteWelcomeScreenObject.aboutpage;
    var rambo_nr_actions_required = ramboLiteWelcomeScreenObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof rambo_aboutpage !== 'undefined') && (typeof rambo_nr_actions_required !== 'undefined') && (rambo_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + rambo_aboutpage + '"><span class="rambo-actions-count">' + rambo_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".rambo-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section rambo-upsells">');
    }
    if (typeof rambo_aboutpage !== 'undefined') {
        jQuery('.rambo-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + rambo_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', ramboLiteWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".rambo-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});