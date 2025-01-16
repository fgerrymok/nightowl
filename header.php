<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nightowlcafe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nightowlcafe' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header-content">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$nightowlcafe_description = get_bloginfo( 'description', 'display' );
			if ( $nightowlcafe_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $nightowlcafe_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<!-- mobile menu button -->
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->

		<div class="site-phone-number">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 256 256" xml:space="preserve">
				<defs>
				</defs>
				<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
					<path d="M 58.074 71.853 c -1.611 0 -3.221 -0.35 -4.726 -1.052 c -15.453 -7.207 -26.942 -18.697 -34.149 -34.149 c -1.461 -3.134 -1.397 -6.72 0.176 -9.838 l 2.735 -5.422 c 0.925 -1.834 2.7 -3.036 4.747 -3.213 c 2.046 -0.173 4.001 0.7 5.229 2.347 l 6.101 8.184 c 1.393 1.868 1.552 4.386 0.405 6.415 l -1.344 2.377 c -0.314 0.556 -0.333 1.234 -0.047 1.77 c 3.119 5.858 7.671 10.41 13.528 13.528 c 0.536 0.285 1.215 0.267 1.77 -0.048 l 2.378 -1.343 c 2.027 -1.147 4.546 -0.989 6.414 0.404 l 8.185 6.102 c 1.647 1.229 2.524 3.184 2.347 5.23 c -0.179 2.046 -1.38 3.819 -3.214 4.745 l -5.422 2.734 C 61.566 71.442 59.818 71.853 58.074 71.853 z M 27.365 22.156 c -0.063 0 -0.117 0.003 -0.162 0.007 c -0.315 0.027 -1.094 0.182 -1.521 1.03 l -2.735 5.422 c -1.003 1.988 -1.049 4.36 -0.123 6.346 c 6.799 14.577 17.638 25.416 32.215 32.215 c 1.985 0.925 4.359 0.879 6.346 -0.122 h 0.001 l 5.422 -2.735 c 0.847 -0.428 1.002 -1.206 1.029 -1.521 c 0.027 -0.315 0.009 -1.109 -0.752 -1.677 L 58.9 55.02 c -0.598 -0.445 -1.406 -0.497 -2.056 -0.129 l -2.378 1.343 c -1.759 0.994 -3.86 1.031 -5.616 0.097 c -6.573 -3.499 -11.681 -8.606 -15.181 -15.18 c -0.935 -1.757 -0.898 -3.856 0.096 -5.617 l 1.344 -2.377 c 0.368 -0.65 0.317 -1.458 -0.13 -2.056 l -6.101 -8.184 C 28.393 22.263 27.74 22.156 27.365 22.156 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					<path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z M 45 4 C 22.393 4 4 22.393 4 45 s 18.393 41 41 41 s 41 -18.393 41 -41 S 67.607 4 45 4 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				</g>
			</svg>
			<a href="tel:604-276-0576" class="phone-number">604-276-0576</a>
		</div>
		</div>
	</header><!-- #masthead -->


	<!-- FAB -->
	<div class="fab-wrapper">
        <button id="fab-main" class="fab">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 256 256" xml:space="preserve">
			<defs>
			</defs>
			<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
				<path d="M 84.2 60.906 h -0.901 c -0.563 -10.968 -5.738 -21.082 -14.395 -27.99 c -0.864 -0.689 -2.12 -0.548 -2.812 0.315 c -0.688 0.863 -0.548 2.122 0.315 2.811 c 7.7 6.146 12.325 15.12 12.883 24.864 H 38.47 c -1.104 0 -2 0.896 -2 2 s 0.896 2 2 2 h 42.88 H 84.2 c 0.992 0 1.8 0.807 1.8 1.799 s -0.808 1.8 -1.8 1.8 H 5.8 c -0.992 0 -1.8 -0.808 -1.8 -1.8 s 0.808 -1.799 1.8 -1.799 H 8.65 h 19.596 c 1.104 0 2 -0.896 2 -2 s -0.896 -2 -2 -2 H 10.708 c 1.04 -18.013 16.023 -32.35 34.292 -32.35 c 4.923 0 9.675 1.019 14.124 3.028 c 1.008 0.455 2.192 0.007 2.646 -1 c 0.455 -1.007 0.008 -2.191 -0.999 -2.646 c -2.783 -1.256 -5.673 -2.153 -8.64 -2.711 v -0.603 c 0 -3.932 -3.199 -7.13 -7.131 -7.13 s -7.13 3.199 -7.13 7.13 v 0.606 C 20.757 28.464 7.622 43.092 6.703 60.906 H 5.8 c -3.198 0 -5.8 2.602 -5.8 5.799 c 0 3.198 2.602 5.8 5.8 5.8 h 78.4 c 3.198 0 5.8 -2.602 5.8 -5.8 C 90 63.508 87.398 60.906 84.2 60.906 z M 41.87 24.625 c 0 -1.726 1.404 -3.13 3.13 -3.13 c 1.727 0 3.131 1.404 3.131 3.13 v 0.069 c -1.037 -0.083 -2.079 -0.138 -3.131 -0.138 c -1.055 0 -2.097 0.055 -3.13 0.138 V 24.625 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				<path d="M 18.607 53.872 c -0.257 0 -0.519 -0.051 -0.771 -0.156 c -1.019 -0.427 -1.499 -1.598 -1.072 -2.617 c 3.506 -8.375 10.481 -14.723 19.139 -17.415 c 1.055 -0.327 2.176 0.261 2.503 1.316 c 0.328 1.055 -0.261 2.175 -1.316 2.503 c -7.524 2.34 -13.588 7.859 -16.637 15.141 C 20.132 53.41 19.389 53.872 18.607 53.872 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				<path d="M 72.232 56.148 c -0.846 0 -1.632 -0.541 -1.904 -1.389 c -0.94 -2.925 -2.372 -5.646 -4.256 -8.088 c -0.675 -0.874 -0.514 -2.13 0.361 -2.805 c 0.873 -0.675 2.13 -0.514 2.805 0.362 c 2.168 2.809 3.815 5.94 4.898 9.307 c 0.338 1.052 -0.24 2.179 -1.292 2.517 C 72.641 56.117 72.435 56.148 72.232 56.148 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
			</g>
		</svg>
		Order Now</button>
        <div id="fab-menu" class="fab-menu hidden">
            <a href="https://www.doordash.com/store/night-owl-cafe-%E7%8C%AB%E5%A4%B4%E9%B9%B0-richmond-19[…]tid=AfmBOorFnVFKhQmHlsEnmLU0RhWfUNe3wEeZ-yYlOY3QzzfSGSZ5xpHq" target="_blank" class="fab-item">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/door-dash.png' ); ?>" alt="Doordash Logo" class="online-order-logo" />						
			</a>
            <a href="https://www.ubereats.com/ca/store/night-owl-cafe%E8%B2%93%E9%A0%AD%E9%B7%B9/KcdsAlX3R[…]Dc4JTJDJTIybG9uZ2l0dWRlJTIyJTNBLTEyMy4xMzU5NyU3RA%3D%3D&ps=1" target="_blank" class="fab-item">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uber-eats.png' ); ?>" alt="Uber Eats Logo" class="online-order-logo" />						
			</a>
            <button id="fab-close" class="fab-item svg">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 256 256" xml:space="preserve">
					<defs>
					</defs>
					<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
						<path d="M 8 90 c -2.047 0 -4.095 -0.781 -5.657 -2.343 c -3.125 -3.125 -3.125 -8.189 0 -11.314 l 74 -74 c 3.125 -3.124 8.189 -3.124 11.314 0 c 3.124 3.124 3.124 8.189 0 11.313 l -74 74 C 12.095 89.219 10.047 90 8 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
						<path d="M 82 90 c -2.048 0 -4.095 -0.781 -5.657 -2.343 l -74 -74 c -3.125 -3.124 -3.125 -8.189 0 -11.313 c 3.124 -3.124 8.189 -3.124 11.313 0 l 74 74 c 3.124 3.125 3.124 8.189 0 11.314 C 86.095 89.219 84.048 90 82 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					</g>
				</svg>
			</button>
        </div>
    </div>
