<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nightowlcafe
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', 'page' );


			// === Business Hours Section === //
			if ( have_rows( 'business_hours_section' ) ) {
				echo "<section class='business-hours-section'>";

				while ( have_rows( 'business_hours_section' ) ) {
					the_row();

					// section title
					echo "<h2 class='section-heading'>" . esc_html( get_sub_field( 'section_heading' ) ) . "</h2>";
					

					// business time table
					if ( have_rows( 'business_hours_timetable' ) ) { ?>
						<table>
						<tr>
							<th>Day</th>
							<th>Opening Time</th>
							<th>Closing Time</th>
						</tr>

						<!-- day of week in a row -->
						<?php while ( have_rows( 'business_hours_timetable' ) ) {
							the_row(); ?>
							
							<tr>
								<td><?php echo esc_html( get_sub_field( 'day_of_week' ) );?></td>
								<td><?php echo esc_html( get_sub_field( 'opening_time' ) );?></td>
								<td><?php echo esc_html( get_sub_field( 'closing_time' ) );?></td>
							</tr>

						<?php } ?>
					
						</table>
					<?php
					}
				}
				echo "</section>";
			}

			
			// === Contact Us Section === //
			if ( have_rows( 'contact_us_section' ) ) {
				echo "<section class='contact-us-section'>";

				while ( have_rows( 'contact_us_section' ) ) {
					the_row();

					echo "<h2 class='section-heading'>" . esc_html( get_sub_field( 'section_heading' ) ) . "</h2>";
					echo "<p class='phone-number'>" . esc_html( get_sub_field( 'phone_number' ) ) . "</p>";
				}
				echo "</section>";
			}
	
			// === Location Section === //
			if ( have_rows( 'location_section' ) ) {
				echo "<section class='location-section'>";

				while ( have_rows( 'location_section' ) ) {
					the_row();

					echo "<h2 class='section-heading'>" . esc_html( get_sub_field( 'section_heading' ) ) . "</h2>";
					echo "<p class='address'>" . esc_html( get_sub_field( 'address' ) ) . "</p>";

					// Google Map ACF
					$location = get_sub_field( 'map' );
					if( $location ) { ?>

						<div id="map" style="width: 100%; height: 400px;"></div>
						<script>
							function initMap() {
								// Map options
								const location = { lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?> };
								const map = new google.maps.Map(document.getElementById('map'), {
									zoom: 14,
									center: location,
								});

								// Marker
								new google.maps.Marker({
									position: location,
									map: map,
								});
							}
						</script>

						<?php $google_api_key = 'ADD API KEY LATER HERE';?>
						<script async defer 
							src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key; ?>&callback=initMap">
						</script>
				
					<?php // ====== Google Map ACF end ====== // 
				
					}
				}
				echo "</section>";
			}

		}
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
