<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$plugin_dir_url =  plugin_dir_url( __FILE__ );

?>
<style>
.premium-box{ width:100%; height:auto; background:#fff;  }
.premium-features{}
.premium-heading{  color: #484747;font-size: 40px;padding-top: 35px;text-align: center;text-transform: uppercase;}
.premium-features li{ width:100%; float:left;  padding: 80px 0; margin: 0; }
.premium-features li .detail{ width:50%; }
.premium-features li .img-box{ width:50%; }

.premium-features li:nth-child(odd) { background:#f4f4f9; }
.premium-features li:nth-child(odd) .detail{float:right; text-align:left; }
.premium-features li:nth-child(odd) .detail .inner-detail{}
.premium-features li:nth-child(odd) .detail p{ }
.premium-features li:nth-child(odd) .img-box{ float:left; text-align:right;}

.premium-features li:nth-child(even){  }
.premium-features li:nth-child(even) .detail{ float:left; text-align:right;}
.premium-features li:nth-child(even) .detail .inner-detail{ margin-right: 46px;}
.premium-features li:nth-child(even) .detail p{ float:right;} 
.premium-features li:nth-child(even) .img-box{ float:right;}

.premium-features .detail{}
.premium-features .detail h2{ color: #484747;  font-size: 24px; font-weight: 700; padding: 0;}
.premium-features .detail p{  color: #484747;  font-size: 13px;  max-width: 327px;}
/**images**/
.pincode-check{ background:url(<?php echo $plugin_dir_url; ?>../images/Enable_Disable_Plugin.png); width:448px; height:72px; display:inline-block; margin-right: 25px; margin-top: -2px; background-repeat:no-repeat;}

.sat-sun-off{ background:url(<?php echo $plugin_dir_url; ?>../images/Give_Your_Own_Title.png); width:515px; height:63px; display:inline-block; background-size:500px auto; margin-right:30px; margin-top: 20px; background-repeat:no-repeat;}

.bulk-upload{ background:url(<?php echo $plugin_dir_url; ?>../images/products_from_Product_Page.png); width:250px; height:322px; display:inline-block; margin-top: 25px; background-repeat:no-repeat;}

.cod-verify{background:url(<?php echo $plugin_dir_url; ?>../images/Many_Products_Single_Page.png); width:548px; height:338px; display:inline-block; margin-right:30px; margin-top: 20px; background-repeat:no-repeat;}

.delivery-date{background:url(<?php echo $plugin_dir_url; ?>../images/Customize_Text_For_total_Price.png); width:624px; height:132px; display:inline-block;margin-top:-6px; background-repeat:no-repeat;}

.number_of_selected_items {background:url(<?php echo $plugin_dir_url; ?>../images/number_selected_items.png); width:548px; height:145px; display:inline-block; margin-right:30px; margin-top: 20px; background-repeat:no-repeat;}

.Set_Thumbnail_Position{background:url(<?php echo $plugin_dir_url; ?>../images/Set_Thumbnail_Position.png); width:525px; height:73px; display:inline-block;margin-top:-6px; background-repeat:no-repeat;}



/*upgrade css*/

.upgrade{background:#f4f4f9;padding: 50px 0; width:100%; clear: both;}
.upgrade .upgrade-box{ background-color: #808a97;
    color: #fff;
    margin: 0 auto;
   min-height: 110px;
    position: relative;
    width: 60%;}

.upgrade .upgrade-box p{ font-size: 15px;
     padding: 19px 20px;
    text-align: center;}

.upgrade .upgrade-box a{background: none repeat scroll 0 0 #6cab3d;
    border-color: #ff643f;
    color: #fff;
    display: inline-block;
    font-size: 17px;
    left: 50%;
    margin-left: -150px;
    outline: medium none;
    padding: 11px 6px;
    position: absolute;
    text-align: center;
    text-decoration: none;
    top: 36%;
    width: 277px;}

.upgrade .upgrade-box a:hover{background: none repeat scroll 0 0 #72b93c;}

.premium-vr{ text-transform:capitalize;} 
.premium-box.premium-box-head {
    background: #eae8e7 none repeat scroll 0 0;
    height: 500px;
    text-align: center;
    width: 100%;
}
.premium-box .pho-upgrade-btn {
    text-align: center;
}

.premium-box .pho-upgrade-btn a {
    display: inline-block;
    margin-top: 75px;
}
.premium-box {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    height: auto;
    width: 100%;
}
.premium-box-head {
    background: #eae8e7 none repeat scroll 0 0;
    height: 500px;
    text-align: center;
    width: 100%;
}
.main-heading {
    background: #fff none repeat scroll 0 0;
    margin-bottom: -70px;
    text-align: center;
}
.main-heading h1 {
    margin: 0;
}
.main-heading img {
    margin-top: -200px;
}
.premium-box-container .description:nth-child(2n+1) {
    background: #fff none repeat scroll 0 0;
}
.premium-box-container .description {
    display: block;
    padding: 35px 0;
    text-align: center;
}
.premium-box-container .pho-desc-head::after {
    background: rgba(0, 0, 0, 0) url(<?php echo $plugin_dir_url; ?>../assets/images/head-arrow.png) no-repeat scroll 0 0;
    content: "";
    height: 98px;
    position: absolute;
    right: -40px;
    top: -6px;
    width: 69px;
}
.premium-box-container .pho-desc-head {
    margin: 0 auto;
    position: relative;
    width: 768px;
}
.premium-box-container .pho-desc-head h2,h3 {
    color: #02c277;
    font-size: 28px;
    font-weight: bolder;
    margin: 0;
    text-transform: capitalize;
	line-height:30px;
}
.pho-plugin-content {
    margin: 0 auto;
    overflow: hidden;
    width: 768px;
}
.phoendjdndjh {
    padding: 35px 0;
}
.phoendjdndjh h3 {
    text-align:center;
}
.phoen_feature_main{
	background:#EAE8E7;
}
.pho-plugin-content p {
    color: #212121;
    font-size: 18px;
    line-height: 32px;
	text-align: left;
}
.premium-box-container .description:nth-child(2n+1) .pho-img-bg {
    background: #f1f1f1 url(<?php echo $plugin_dir_url; ?>../assets/images/image-frame-odd.png) no-repeat scroll 100% top;
}
.description .pho-plugin-content .pho-img-bg {
    border-radius: 5px 5px 0 0;
    height: auto;
    margin: 0 auto;
    padding: 70px 0 40px;
    width: 750px;
}
.pho-plugin-content img {
    max-width: 100%;
    width: auto;
}
.premium-box-container .description:nth-child(2n) {
    background: #eae8e7 none repeat scroll 0 0;
}
.premium-box-container .description {
    display: block;
    padding: 35px 0;
    text-align: center;
}
.premium-box-container .description:nth-child(2n) .pho-img-bg {
    background: #f1f1f1 url(<?php echo $plugin_dir_url; ?>../assets/images/image-frame-even.png) no-repeat scroll 100% top;
}
.premium-box .pho-upgrade-btn {
    text-align: center;
}
.pho-upgrade-btn a {
    display: inline-block;
    margin-top: 75px;
}
.pho-upgrade-btn > a:focus {
	box-shadow: none !important;
}
.swatch_img{
	text-align:left;
}

</style>
<?php $plugin_dir_url = plugin_dir_url(dirname(__FILE__));?>

<div class="premium-box">

<div class="premium-box-head">
           <div class="pho-upgrade-btn">
		   
<a target="_blank" href="<?php echo esc_url('https://www.phoeniixx.com/product/color-image-swatches-woocommerce/');?>"><img src="<?php echo $plugin_dir_url;?>assets/images/premium-btn.png"></a>
<a target="blank" href="<?php echo esc_url('http://colorswatches.phoeniixxdemo.com/product/ship-your-idea-2/');?>"><img src="<?php echo $plugin_dir_url;?>assets/images/demo-btn.png"></a>
</div>
</div>
<div class="main-heading">
           <h1> <img src="<?php echo $plugin_dir_url;?>assets/images/premium-head.png">
           
          </h1>
</div>
<div class="premium-box-container">
	
	
	<div class="description">

					
				<div class="phoendjdndjh premium-box-container shop">
					<div class="pho-desc-head">
						<h3><?php _e('Frontend Shop Page View','phoen-visual-attributes'); ?></h3></div>
                
                    <div class="pho-plugin-content">
                        
                        <br><div class="pho-img">
						<img src="<?php echo $plugin_dir_url;?>assets/images/screen-shot2121.png">
                        </div>
                    </div>
				</div>
				
				<div class="phoendjdndjh premium-box-container shop">
					<div class="pho-desc-head">
						<h3><?php _e('Types of Swatches','phoen-visual-attributes'); ?></h3></div>
                
                    <div class="pho-plugin-content">
                        
						
						<div class="pho-plugin-content">
							<p><b><?php _e('1. COLOR SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/color.jpg">
								</div>
						</div>
						
						<div class="pho-plugin-content">
							<p><b><?php _e('2. BICOLOR SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/bicolor.jpg">
								</div>
						</div>
						
						<div class="pho-plugin-content">
							<p><b><?php _e('3. IMAGE SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/image.jpg">
								</div>
						</div>
						
						<div class="pho-plugin-content">
							<p><b><?php _e('4. ICON SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/ico.jpg">
								</div>
						</div>
						
						<div class="pho-plugin-content">
							<p><b><?php _e('5. TEXT SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/text-.jpg">
								</div>
						</div>
						
						<div class="pho-plugin-content">
							<p><b><?php _e('6. RADIO BUTTON SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/radio.jpg">
								</div>
						</div>
						
						<div class="pho-plugin-content">
							<p><b><?php _e('7. DROPDOWN SWATCH','phoen-visual-attributes'); ?></b></p>

							<br><div class="pho-img swatch_img">
									<img src="<?php echo $plugin_dir_url;?>assets/images/dropdown.jpg">
								</div>
						</div>
						
					</div>
					
					
				
				
					
				<div class="phoendjdndjh premium-box-container">
                
				<div class="pho-desc-head">
                <h3><?php _e('Frontend Product Page View','phoen-visual-attributes'); ?></h3></div>
                
                    <div class="pho-plugin-content">
                        
                        <br><div class="pho-img">
                        <img src="<?php echo $plugin_dir_url;?>assets/images/screenshot--5.png">
                        </div>
                    </div>
				</div>
				
				<div class="phoendjdndjh premium-box-container phoen_feature_main">
                
				<div class="pho-desc-head">
					<h3><?php _e('Additional Features','phoen-visual-attributes'); ?></h3>
				</div>
					<div class="pho-plugin-content">
						<p><b><?php _e('1. Tooltip on hover','phoen-visual-attributes'); ?></b></p>

						<br><div class="pho-img swatch_img">
								<img src="<?php echo $plugin_dir_url;?>assets/images/tooltip.jpg">
							</div>
					</div>
					<div class="pho-plugin-content">
						<p><b><?php _e('2. Image zoom on hover','phoen-visual-attributes'); ?></b></p>

						<br><div class="pho-img swatch_img">
								<img src="<?php echo $plugin_dir_url;?>assets/images/image-zoom.jpg">
							</div>
					</div>
				
				</div>
    </div>

				
	
	
	<div class="description">
                <div class="pho-desc-head">
                <h2><?php _e('General Settings','phoen-visual-attributes'); ?></h2></div>
                
                    <div class="pho-plugin-content">
                        <p>
						<b><?php _e('Options for shop page','phoen-visual-attributes'); ?></b>: <?php _e('can show variations on shop page, option to set add to cart button,','phoen-visual-attributes'); ?>
						
						<b><?php _e('Swatch Border Style','phoen-visual-attributes'); ?></b>: <?php _e('option is available in square and circle style,','phoen-visual-attributes'); ?>

<b><?php _e('Swatch Size','phoen-visual-attributes'); ?></b>,

<b><?php _e('Default Swatch Border Color','phoen-visual-attributes'); ?></b>,

<b><?php _e('Active Swatch Border Color','phoen-visual-attributes'); ?></b>,

<b><?php _e('Swatch Color','phoen-visual-attributes'); ?></b>,

<b><?php _e('Swatch Tooltip','phoen-visual-attributes'); ?></b>,

<b><?php _e('Select 2','phoen-visual-attributes'); ?></b>,

<b><?php _e('Swatch Hover Color','phoen-visual-attributes'); ?></b>,	</p>
                        <div class="pho-img-bg">
                        <img src="<?php echo $plugin_dir_url;?>assets/images/screenshot--2.png">
						
                        </div>
                    </div>
					
                    </div>
    </div>
	

<div class="phoendjdndjh premium-box-container">
              <div class="pho-desc-head">
                <h3><?php _e('Global Swatches','phoen-visual-attributes'); ?></h3></div>
                
                    <div class="pho-plugin-content">
                        <p><?php _e('Go to ','phoen-visual-attributes'); ?><b><?php _e('color and image swatch tab','phoen-visual-attributes'); ?></b><?php _e('&gt; select the ','phoen-visual-attributes'); ?><b><?php _e('type&gt;','phoen-visual-attributes'); ?></b> <b><?php _e('taxonomy color and images','phoen-visual-attributes'); ?></b><?php _e('is to be chosen to ','phoen-visual-attributes'); ?> <b><?php _e('add the swatches Globally.','phoen-visual-attributes'); ?></b></p>
                        <div class="pho-img-bg">
                        <img src="<?php echo $plugin_dir_url;?>assets/images/product_edit_pag.png">
                        </div>
                    </div>
</div>

<div class="phoendjdndjh premium-box-container">
	<div class="pho-desc-head">
                <h3><?php _e('Product Based Swatches','phoen-visual-attributes'); ?></h3></div>
	
		<div class="pho-plugin-content">
			<p><?php _e('Go to','phoen-visual-attributes'); ?> <b><?php _e('color and image swatch tab','phoen-visual-attributes'); ?></b><?php _e('&gt; select the','phoen-visual-attributes'); ?> <?php _e('<b>type</b>&gt; ','phoen-visual-attributes'); ?><b><?php _e('custom color and images','phoen-visual-attributes'); ?></b> <?php _e('is to be chosen to add the swatches type on per product basis','phoen-visual-attributes'); ?> <b><?php _e('add the swatch type.','phoen-visual-attributes'); ?></b></p>
			<div class="pho-img-bg">
			<img src="<?php echo $plugin_dir_url;?>assets/images/custom_option.png">
			</div>
		</div>
</div>



</div>
<div class="pho-upgrade-btn">
        <a target="_blank" href="<?php echo esc_url('https://www.phoeniixx.com/product/color-image-swatches-woocommerce/');?>"><img src="<?php echo $plugin_dir_url;?>assets/images/premium-btn.png"></a>
		<a target="blank" href="<?php echo esc_url('http://colorswatches.phoeniixxdemo.com/product/ship-your-idea-2/');?>"><img src="<?php echo $plugin_dir_url;?>assets/images/demo-btn.png"></a>
</div>

</div>
