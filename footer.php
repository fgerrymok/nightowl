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
		<section class='nightowl-info'>
			<h3>Night Owl Cafe</h3>
			<address>
				#104-8580 Cambie Road, <br>
				Richmond, BC
			</address>
			<div class='footer-phone-number'>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 256 256" xml:space="preserve">
					<defs>
					</defs>
					<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
						<path d="M 58.074 71.853 c -1.611 0 -3.221 -0.35 -4.726 -1.052 c -15.453 -7.207 -26.942 -18.697 -34.149 -34.149 c -1.461 -3.134 -1.397 -6.72 0.176 -9.838 l 2.735 -5.422 c 0.925 -1.834 2.7 -3.036 4.747 -3.213 c 2.046 -0.173 4.001 0.7 5.229 2.347 l 6.101 8.184 c 1.393 1.868 1.552 4.386 0.405 6.415 l -1.344 2.377 c -0.314 0.556 -0.333 1.234 -0.047 1.77 c 3.119 5.858 7.671 10.41 13.528 13.528 c 0.536 0.285 1.215 0.267 1.77 -0.048 l 2.378 -1.343 c 2.027 -1.147 4.546 -0.989 6.414 0.404 l 8.185 6.102 c 1.647 1.229 2.524 3.184 2.347 5.23 c -0.179 2.046 -1.38 3.819 -3.214 4.745 l -5.422 2.734 C 61.566 71.442 59.818 71.853 58.074 71.853 z M 27.365 22.156 c -0.063 0 -0.117 0.003 -0.162 0.007 c -0.315 0.027 -1.094 0.182 -1.521 1.03 l -2.735 5.422 c -1.003 1.988 -1.049 4.36 -0.123 6.346 c 6.799 14.577 17.638 25.416 32.215 32.215 c 1.985 0.925 4.359 0.879 6.346 -0.122 h 0.001 l 5.422 -2.735 c 0.847 -0.428 1.002 -1.206 1.029 -1.521 c 0.027 -0.315 0.009 -1.109 -0.752 -1.677 L 58.9 55.02 c -0.598 -0.445 -1.406 -0.497 -2.056 -0.129 l -2.378 1.343 c -1.759 0.994 -3.86 1.031 -5.616 0.097 c -6.573 -3.499 -11.681 -8.606 -15.181 -15.18 c -0.935 -1.757 -0.898 -3.856 0.096 -5.617 l 1.344 -2.377 c 0.368 -0.65 0.317 -1.458 -0.13 -2.056 l -6.101 -8.184 C 28.393 22.263 27.74 22.156 27.365 22.156 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
						<path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z M 45 4 C 22.393 4 4 22.393 4 45 s 18.393 41 41 41 s 41 -18.393 41 -41 S 67.607 4 45 4 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
					</g>
				</svg>
				<a href="tel:604-276-0576">604-276-0576</a>
			</div>
		</section>
		<section class="site-info">
				<div>
					<p><?php echo esc_html("Delivery"); ?></p>
					<?php wp_nav_menu( array(
						'menu' => 'footer-delivery'
						) ); ?>
				</div>
				<div>
					<p><?php echo esc_html("Site Navigation"); ?></p>
					<?php wp_nav_menu( array(
					'menu' => 'footer-site-nav'
					) ); ?>
				</div>
			</section>

			<section class="footer-copyright">
				<p>Built By: <a href="<?php echo esc_url("https://wsstudio.ca/"); ?>" target="_blank"><?php echo esc_html("Whitespace Studio"); ?></a></p>
			</section>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>