<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="rambo-tab-pane active">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="rambo-info-title text-center"><?php echo __('About Rambo Theme','rambo'); ?><?php if( !empty($rambo['Version']) ): ?> <sup id="rambo-theme-version"><?php echo esc_attr( $rambo['Version'] ); ?> </sup><?php endif; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
				<p><?php esc_html_e( 'Rambo is an ideal WordPress theme for those who wish to create an impressive web presence. Rambo is easy to use, provides everything you need to create great looking website. It is professional, smooth and sleek, with a clean modern layout, for almost any business types: agency, freelance, blog, startup, portfolio, corporate, firms, law firms, digital media agency , architecture firms, real estate firms, food , fashion etc etc. The theme is developed using Bootstrap 3 CSS framework that makes it friendly for all the modern devices like mobiles, tablets, laptops etc.','rambo');?></p>

				<p><?php esc_html_e( 'In Rambo Lite, you can easily set Featured Banner, Services, Portfolio and 4 column widgetized footer. Page templates like Homepage, Full Width Page and Blog left sidebar template will be there.','rambo');?></p>
				
				<p>
				<?php esc_html_e( 'In the premium version, you will get caption Slider, Site Intro, unlimited Services, unlimited Projects, Latest News, Footer Callout, Wide & Boxed Layout, 5 predefined color schemes, feature for creating custom color scheme and Layout Manager. Page templates like About Us, Services, Portfolio, Contact Us etc are there. The theme supports popular plugins like WPML, Polylang, Contact Form 7, WP Google Maps and JetPack Gallery Extensions. Just navigate to Appearance > Customize to start customizing. Both the lite and premium version of Rambo themes are completely translated in Spanish Language.', 'rambo' ); ?>
				</p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/functions/rambo-info/img/rambo.png'; ?>" alt="<?php esc_html_e( 'rambo Blue Child Theme', 'rambo' ); ?>" />
				</div>
			</div>	
		</div>
	
	
		 <div class="row">
		 
			<div class="rambo-tab-center">

				<h1><?php esc_html_e( "Useful Links", 'rambo' ); ?></h1>

			</div>
			
			<div class="col-md-6"> 
				<div class="rambo-tab-pane-half rambo-tab-pane-first-half">

					<a href="<?php echo 'http://webriti.com/demo/wp/lite/rambo/'; ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-desktop info-icon"></div>
					<p class="info-text"><?php echo __('Lite Demo','rambo'); ?></p></a>
					
					
					<a href="<?php echo 'http://webriti.com/demo/wp/preview/?prev=rambo/'; ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div>
					<p class="info-text"><?php echo __('View Pro','rambo'); ?></p></a>
					
					<a href="<?php echo 'http://webriti.com/support/categories/rambo'; ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo __('Premium Theme Support','rambo'); ?></p></a>
					
				</div>
			</div>
			
			<div class="col-md-6">	
				<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
					
					<a href="<?php echo 'https://wordpress.org/support/theme/rambo/reviews/#new-post'; ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-smiley info-icon"></div>
					<p class="info-text"><?php echo __('Rate This Theme','rambo'); ?></p></a>
					
					<a href="<?php echo 'https://wordpress.org/support/theme/rambo'; ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo __('Support','rambo'); ?></p></a>
				</div>
			</div>
			
		</div>	
	</div>
</div>	