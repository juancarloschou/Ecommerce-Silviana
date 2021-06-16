(function(jQuery) {
    "use strict";
 	 var social_link = jQuery('.social-share a:not(.email-share a)');
    social_link.click(function(){
        newwindow=window.open(jQuery(this).attr('href'),'','height=450,width=700');
        if (window.focus) {newwindow.focus()}
        return false;
    });
	jQuery('.pagination .prev').parent().addClass('prev-nav');jQuery('.pagination .next').parent().addClass('next-nav');
	jQuery('.main-nav .navbar-nav i.arrow').click(function(){
	jQuery(this).parent().find('ul').toggle();
  });
})
jQuery(window).load(function() {jQuery('.flexslider').flexslider({animation: "fade"});});
jQuery(function(n){jQuery('.sub-menu').before("<i class='fa fa-sort-down arrow'></i>");});jQuery(document).ready(function(){jQuery(".scrollToTop").click(function(){return jQuery("html, body").animate({scrollTop:0},800),!1})});
 jQuery(document).ready(function(e) { jQuery(".navbar-nav li").click(function(e) { e.stopPropagation(); jQuery(this).children('ul').toggle(); }); });
(jQuery);