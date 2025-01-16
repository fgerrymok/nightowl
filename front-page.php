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

 get_header();
?>

    <main class='site-main noc-home-page'>
        <?php
            while (have_posts()):
                the_post();
                get_template_part('template-parts/content', 'page');
        ?>
        <!-- Hero Section -->
        <section class='noc-hero-section home-section'>
            <?php
                if(have_rows('hero_section')){
                    while (have_rows('hero_section')):
                        the_row();
                        $hero_heading     = get_sub_field('hero_heading');
                        $hero_description = get_sub_field('hero_short_description');
                        $hero_image       = get_sub_field('hero_image');
                        $image_size       = 'large';
                    ?>
                    <div class='hero-wrapper'>
                        <div class='hero-info-wrapper'>
                            <!-- Hero Heading -->
                            <?php if($hero_heading): ?>
                                <h1><?php echo esc_html($hero_heading); ?></h1>
                            <?php endif; ?>

                            <!-- Hero Short Description -->
                            <?php if($hero_description): ?>
                                <p><?php echo esc_html($hero_description); ?></p>
                            <?php endif; ?>

                            <!-- Hero CTA Button -->
							<?php
							$current_hour = date("H");
							if ($current_hour < 12 ) {
								$category_slug = "breakfast";
							} else {
								$category_slug = "lunch";
							}
							
							$category = get_term_by('slug', $category_slug, 'product_cat');
							$menu_link = get_term_link($category);
							?>
							<a href='<?php echo esc_url($menu_link); ?>'>View Our Menu</a>
                        </div>

                        <!-- Hero Image -->
						<div class="hero-image-wrapper">
							<div class="hero-overlay"></div>
							<?php if($hero_image):
									echo wp_get_attachment_image($hero_image, $image_size);
								endif;
							?>
						</div>
                    </div>
                    <?php endwhile;
                    
                }
            ?>
        </section>
        <!-- Featured Section -->
        <section class='noc-featured-section home-section'>
            <h2>Discover Our Menu</h2>
            <article class='noc-featured-item item-1'>
                <div class="item-img">
                    <img src="<?php echo get_template_directory_uri();?>/assets/hearty-combo.png" alt="Hearty Combo Breakfast">    
                </div>
                <div class='item-info'>
                    <h3>Hearty Morning Combo</h3>
                    <p>A hearty breakfast platter featuring your choice of steak, buttered toast, two sides, and a variety of delicious options to start your day right.</p>
                </div>
            </article>

            <article class='noc-featured-item item-2'>
                <div class='item-info'>
                    <h3>Meat Lover's Steak Combo</h3>
                    <p>A hearty combination of tender beef steak, juicy pork chop steak, jumbo cheese sausage, crispy bacon, and a perfectly cooked egg for a satisfying, protein-packed meal.</p>
                </div>
                <div class="item-img">
                    <img src="<?php echo get_template_directory_uri();?>/assets/hearty-combo.png" alt="Hearty Combo Breakfast">
                </div>
            </article>

            <article class='noc-featured-item item-3'>
                <div class="item-img">
                    <img src="<?php echo get_template_directory_uri();?>/assets/hearty-combo.png" alt="Hearty Combo Breakfast">
                </div>
                <div class='item-info'>
                    <h3>Satay Beef Soup Noodle</h3>
                    <p>A flavourful noodle soup with tender beef and a rich, aromatic satay broth, offering a perfect blend of spices.</p>
                </div>
            </article>
        </section>

        <div class="test"></div>

        <!-- Order Now Section -->
        <section class='noc-order-section home-section'>
            <?php
                if(have_rows('order_section')){
                    while(have_rows('order_section')):
                        the_row();
                        $order_heading   = get_sub_field('section_heading');
                        $label_uberEats  = get_sub_field('cta_label_for_uber_eats');
                        $button_uberEats = get_sub_field('cta_button_for_uber_eats');
                        $label_doorDash  = get_sub_field('cta_label_for_doordash');
                        $button_doorDash = get_sub_field('cta_button_for_doordash');
            ?>

                <img src="<?php echo get_template_directory_uri();?>/assets/noc-banner.jpeg" alt="Night Owl Cafe Banner">
                <div class=banner-overlay></div>
                <div class="order-section-content">
                    <!-- Order Now Heading -->
                    <?php if($order_heading): ?>
                        <p class="order-now-heading"><?php echo esc_html($order_heading); ?></p>
                    <?php endif; ?>
    
                    <!-- UberEats CTA Button -->
                    <?php if($label_uberEats && $button_uberEats): ?>
                        <a href='<?php echo esc_url($button_uberEats); ?>'><?php echo esc_html($label_uberEats); ?></a>
                    <?php endif; ?>
    
                    <!-- DoorDash CTA Button -->
                    <?php if($label_doorDash && $button_doorDash): ?>
                        <a href='<?php echo esc_url($button_doorDash); ?>'><?php echo esc_html($label_doorDash); ?></a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php
                }
            ?>

        </section>

        <?php endwhile; ?>
    </main>
    <?php
    get_footer();