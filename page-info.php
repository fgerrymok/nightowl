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

	<main id="primary" class="site-main page-info">

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
					if ( have_rows( 'business_hours_timetable' ) ) { 
						$current_day = date('l');
						
						?>
						<table>

							<!-- day of week in a row -->
							<?php while ( have_rows( 'business_hours_timetable' ) ) { the_row(); 
								
								 
								if ( get_sub_field( 'day_of_week' ) == $current_day ) {
									$isToday = true;
								} else {
									$isToday = false;
								}
								
								
								?>
								
								<tr class="<?php echo $isToday ? esc_html( 'business-hour-today' ) : ""; ?>">
									<td><?php 
										echo esc_html( get_sub_field( 'day_of_week' ) ); 
										echo $isToday ? ' (Today)' : '';
										?>
									</td>
									<td class='hours <?php echo get_sub_field( 'opening_time' ) ? 'open-time' : 'close-day'; ?>'><?php echo get_sub_field( 'opening_time' ) ? esc_html( get_sub_field( 'opening_time' ) ) : "Closed";?></td>
									<td class='hours close-time'><?php echo get_sub_field( 'closing_time' ) ? esc_html( get_sub_field( 'closing_time' ) ) : "";?></td>
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
					echo "<div class='address-wrapper'>";
					echo 	"<button class='address' id='copy-address'>" . esc_html( get_sub_field( 'address' ) ) . "</button>";
					echo 	"<div id='copy-popup'>Copied!</div>";
					echo "</div>"
					?>

					<!-- Map Image -->
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/map.jpg' ); ?>" alt="Restaurant Location" class="map-image" />

					<?php
					// Google Map ACF
					// $location = get_sub_field( 'map' );
					if( isset( $location ) ) { ?>

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
				
					<?php 
					} // ====== Google Map ACF end ====== // 
					?>
					<a href="https://maps.app.goo.gl/fmQWVpbEuJEkWJP48" target="_blank" class="map-link">Get the location</a>
				<?php
				}
				echo "</section>";
			}

		}
		?>

	</main><!-- #main -->

<?php
get_footer();
