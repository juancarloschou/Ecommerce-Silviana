<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package FreeStore
 */
?>
		<div class="clearboth"></div>
	</div><!-- #content -->

	<?php if ( get_theme_mod( 'freestore-footer-layout', false ) == 'freestore-footer-layout-centered' ) : ?>

	    <?php get_template_part( '/templates/footers/footer-centered' ); ?>

	<?php elseif ( get_theme_mod( 'freestore-footer-layout', false ) == 'freestore-footer-layout-standard' ) : ?>

	    <?php get_template_part( '/templates/footers/footer-standard' ); ?>

	<?php elseif ( get_theme_mod( 'freestore-footer-layout', false ) == 'freestore-footer-layout-none' ) : ?>

	    <?php get_template_part( '/templates/footers/footer-none' ); ?>

	<?php else : ?>

		<?php get_template_part( '/templates/footers/footer-social' ); ?>

	<?php endif; ?>

<?php echo ( get_theme_mod( 'freestore-site-layout' ) == 'freestore-site-boxed' ) ? '</div>' : ''; ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
