<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nightowlcafe
 */

?>

	<footer id="colophon" class="site-footer">
		<section class="site-info">
			<div class="footer-site-map">
				<div>
					<h2>Delivery</h2>
					<?php wp_nav_menu( array(
						'menu' => 'footer-delivery'
						) ); ?>
				</div>
				<div>
					<h2>Site Navigation</h2>
					<?php wp_nav_menu( array(
					'menu' => 'footer-site-nav'
					) ); ?>
				</div>
			</section>

			<section class="footer-copyright">
				<p>&copy; <?php echo date('Y');?> Credits:</p>
				<a href="<?php echo esc_url("https://frazermok.com"); ?>" target="_blank">Frazer Mok,</a>
				<a href="<?php echo esc_url("https://dongwonkang.info"); ?>" target="_blank">Dongwon Kang,</a>
				<a href="<?php echo esc_url("https://keannabayaua.com/"); ?>" target="_blank">Keanna Bayaua,</a> & 
				<a href="<?php echo esc_url("https://www.fatimanassari.com/"); ?>" target="_blank">Fatima Pournassari</a>
			</section>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
