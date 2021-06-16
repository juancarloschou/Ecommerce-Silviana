jQuery(document).ready(function(){

    jQuery("select#product_category").attr('multiple','multiple').attr('name','product_category[]');
    //jQuery("select.attributes_list").attr('multiple','multiple');
    
    jQuery(".stepsForm").stepsForm({ 
        active		:0,
        errormsg	:'Fill Required Fields',
        sendbtntext	:'Update Attributes',
        posturl		: ajaxurl,
        theme		:'green',
    });
    
    jQuery('#product_identity_type').change(function(){
        var selected_target = jQuery(this).find(":selected").attr('data-target');
        jQuery('li.step_1_options_hide').fadeOut('fast');
        jQuery('li#'+selected_target).fadeIn('slow');
        
    });
    
    jQuery(".meter > span").data("origWidth", jQuery(this).width()).width(0).animate({width: jQuery(this).data("origWidth")}, 1200);
    jQuery('div.meter').hide();
    jQuery('div.debug_log').hide();
})

function wc_bam_before_main_ajax_callback(){
    jQuery('button#sf-prev').remove();
    jQuery('#ajax_message').html('Processing Please Wait....');
    jQuery('button#sf-next').attr("disabled","disabled").html('Please Wait ... ').css('opacity','0.50').before( "<span id=\"wc_bam_spinner\" class=\"spinner\" style=\"float:right;\"></span>" );
    setTimeout(function(){jQuery('div.meter').show(); check_status(); get_attr_info();},200);
    jQuery('span#wc_bam_spinner').show().css('visibility', 'visible'); 
}

function check_status(){
    var data = {'action': 'wc_bam_check_status'};
    jQuery.post(ajaxurl, data, function(response) {
       var post_data = JSON.parse(response);
        jQuery('#ajax_message').html(post_data['msg']);
        jQuery(".meter > span").animate({width: post_data['width'] + '%'}, 100);
        jQuery('table#products_result_log tbody').html(post_data['table']);
        if(post_data['status'] == 'finished'){
            jQuery('button#sf-next').removeAttr("disabled").html('Completed').css('opacity','1');
            jQuery('span#wc_bam_spinner').remove();
            jQuery('button#sf-prev').remove();
            jQuery('div.meter').fadeOut("slow");
            return true;
        } else {
            check_status();
        }
        
        
    });
}

function get_attr_info(){
    jQuery('div.debug_log').slideDown();
    var attribute_value = '';
    jQuery('select.attributes_list').find(":selected").each(function(){ 
        attribute_value += '<tr><td>' + jQuery(this).parent().parent().find('h3').text() + '</td>';
        attribute_value += '<td>';
        attribute_value += jQuery(this).text() + ' , ';
        attribute_value += '</td></tr>';
    });
         
    jQuery('table#attribute_result_log tbody').append(attribute_value);
        
}
function wc_bam_final_ajax(){
}