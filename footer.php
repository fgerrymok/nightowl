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
					<h2><?php echo esc_html("Delivery"); ?></h2>
					<?php wp_nav_menu( array(
						'menu' => 'footer-delivery'
						) ); ?>
				</div>
				<div>
					<h2><?php echo esc_html("Site Navigation"); ?></h2>
					<?php wp_nav_menu( array(
					'menu' => 'footer-site-nav'
					) ); ?>
				</div>
			</section>

			<section class="footer-copyright">
				<p>Built By: <a href="<?php echo esc_url("https://wsstudio.ca/"); ?>" target="_blank"><?php echo esc_html("Whitespace Studio"); ?></a></p>
			</section>

		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>