<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', 'color_image_swatches_menu' );

function color_image_swatches_menu() {
	
	$plugin_dir_url = plugin_dir_url(dirname(__FILE__));

	add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, $plugin_dir_url.'/assets/images/logo-wp.png', 57 );

	add_submenu_page( 'phoeniixx', 'Color and Image Swatches', 'Color and Image Swatches', 'manage_options','settings_color_image_swatches',  'settings_color_image_swatches' ); 	
	
}

function settings_color_image_swatches()
{
	
	$plugin_dir_url = plugin_dir_url(dirname(__FILE__));
	
	?>
		
		<div id="profile-page" class="wrap">
		<?php
		$tab = isset($_GET['tab'])?sanitize_text_field($_GET['tab']):'';
		?>
		<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
			<a class="nav-tab <?php if($tab == 'set' || $tab == ''){ echo esc_attr( "nav-tab-active" ); } ?>" href="?page=settings_color_image_swatches&amp;tab=set"><?php _e('Settings', 'phoen-visual-attributes'); ?></a>
			<a class="nav-tab <?php if($tab == 'install'){ echo esc_attr( "nav-tab-active" ); } ?>" href="?page=settings_color_image_swatches&amp;tab=install"> <?php _e('How to Install', 'phoen-visual-attributes'); ?></a>
			<a class="nav-tab <?php if($tab == 'premium'){ echo esc_attr( "nav-tab-active" ); } ?>" href="?page=settings_color_image_swatches&amp;tab=premium"><?php _e('Premium Version', 'phoen-visual-attributes'); ?></a>
			
		</h2>
		<?php
		if($tab == 'set' || $tab == '')
		{
			
			if(isset($_POST['submit'])) {
				
				if ( ! isset( $_POST['color_image_swatches_setting_nonce'] ) || ! wp_verify_nonce( $_POST['color_image_swatches_setting_nonce'], 'color_image_swatches_setting_submit' ) ) 
				{

				   print 'Sorry, your nonce did not verify.';
				   exit;

				} 
				else {
					
					$color_image_swatches_check =  isset( $_POST['color_image_swatches_check'] ) ?sanitize_text_field( $_POST['color_image_swatches_check'] ):'';
					
					$color_image_swatches_check =  ($color_image_swatches_check == '' ? '0' : '1'); 
				
					update_option( 'color_image_swatches_check', $color_image_swatches_check );
					
				}

			}
			
			$color_image_swatches_check  = get_option( 'color_image_swatches_check' );
			
			?>
			<div class="meta-box-sortables phoe_setting_main" id="normal-sortables">
					
				<form novalidate="novalidate" method="post" action="" >
				   <?php wp_nonce_field( 'color_image_swatches_setting_submit', 'color_image_swatches_setting_nonce' ); ?>
					<h3><?php _e('General settings', 'phoen-visual-attributes'); ?></h3>

					<table class="form-table">

						<tbody>

							<tr class="user-nickname-wrap">

								<th><label for="color_image_swatches_check"><?php _e('Enable Color and Image Swatches', 'phoen-visual-attributes'); ?></label></th>

								<td><input type="checkbox" value="1" <?php if($color_image_swatches_check == 1){ echo "checked"; }  ?> id="color_image_swatches_check" name="color_image_swatches_check" ></label></td>

							</tr>
							
						</tbody>

					</table>	

					<p class="submit"><input type="submit" value="Save" class="button button-primary" id="submit" name="submit"></p>

				</form>
				
				<style>
					.phoe_video_main h3{
						color: #02c277;
						font-size: 28px;
						font-weight: bolder;
						margin: 20px 0;
						text-transform: capitalize
						display: inline-block;
					}
					.phoe_video_main {
						padding: 20px;
						text-align: center;
					}
					.phoe_setting_main {
						width: 79%;
						display: inline-block;
						float: left;
						margin-right: 23px;
						margin-top: 45px;
						
						background: #fff;
					}
					.phoe_setting_main h3, .phoe_setting_main p.submit{
						padding-left: 23px;
						font-size:24px;
					}
					
					.phoe_link_section {
						width: 15%;
						display: inline-block;
						
						padding: 20px;
						background: #ffffff;
						margin-top: 45px;
					}
					.phoe_link_section h3 {
						font-size: 24px;
						margin-top: 0px;
						padding-left: 0px;
					}
					.live_chat_link_btn {
						display: block;
						margin-bottom: 20px;
					}
					.phoe_link_section_inner a{
						text-decoration:none;
						color:#fff;
					}
					.live_chat_link_btn{
						padding: 10px 20px;
						display: table;
						background: #0085BA;
						border-radius: 3px;
						margin-bottom: 26px;
					}
					.phoe_link_section_inner {
						margin-top: 24px;
						padding-bottom: 10px;
					}
					p.email_link_btn {
						color: #000;
						font-size:14px!important;
					}
					.phoe_link_section_inner p {
						font-size: 18px;
						line-height: 0.6;
					}
				</style>
			
			</div>
			
			<div class="phoe_link_section">
				<h3><?php _e('Need Help??', 'phoen-visual-attributes'); ?></h3>
				<div class="phoe_link_section_inner">
					
					<p><?php _e('Start Chat', 'phoen-visual-attributes'); ?></p>
					<a href="<?php echo esc_url('http://www.phoeniixx.com/product/color-image-swatches-woocommerce/');?>" target="_blank" class="live_chat_link_btn"><?php _e('Click Here', 'phoen-visual-attributes'); ?></a>
					<p><?php _e('Email Us:', 'phoen-visual-attributes'); ?></p>
					<p class="email_link_btn"><?php _e('support@phoeniixx.com', 'phoen-visual-attributes'); ?></p>
				</div>
			</div>
			
			<?php
		
		}
		
		if($tab == 'premium')
		{
			require_once(dirname(__FILE__).'/premium-setting.php');
		}
		
		if($tab == 'install')
		{
			?>
			<div class="phoe_video_main">
				<h3><?php _e('How to set up plugin', 'phoen-visual-attributes'); ?></h3>
			
				<iframe width="800" height="360"
					src="<?php echo esc_url('https://www.youtube.com/embed/m8x8LvFQLw0');?>">
				</iframe> 
			</div>
			<div class="phoe_doc_main">
				<h3><?php _e('Free Documentation Link', 'phoen-visual-attributes'); ?></h3>
				<a href="<?php echo esc_url('http://colorandimageswatchesfree.phoeniixxdemo.com/wp-content/uploads/2018/04/Color-Swatches-Free-Documentation.pdf');?>"><?php _e('Click Here', 'phoen-visual-attributes'); ?></a>
			</div>
			<?php
		}
		
		?>	
		
		</div>
		
		<style>
		.phoe_doc_main a{
			padding: 10px 15px;
			background: #0085BA;
			border-radius: 3px;
			color: #fff;
			text-decoration: none;
			margin-left: 10px;
		}
		.form-table th {
			width: 270px;
			padding: 25px;
		}
		.form-table td {
			
			padding: 20px 10px;
		}
		.form-table {
			background-color: #fff;
		}
		h3 {
			padding: 10px;
		}
		
		.pho-upgrade-btn > a:focus {
			box-shadow: none !important;
		}
		</style>
		
	<?php
	
}

?>