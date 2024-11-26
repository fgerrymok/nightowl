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
        <section class='noc-hero-section'>
            <?php
                // Featured Section
                if(have_rows('hero_section')){
                    while (have_rows('hero_section')):
                        the_row();
                        $hero_heading     = get_sub_field('hero_heading');
                        $hero_description = get_sub_field('hero_short_description');
                        $hero_cta_btn     = get_sub_field('cta_button_link');
                        $hero_image       = get_sub_field('hero_image');
                        $image_size       = 'medium';    
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
                            <?php if($hero_cta_btn): ?>
                                <a href='<?php echo esc_url($hero_cta_btn); ?>'>View Our Menu</a>
                            <?php endif; ?>
                        </div>

                        <!-- Hero Image -->
                        <?php if($hero_image):
                                echo wp_get_attachment_image($hero_image, $image_size);
                            endif;
                        ?>
                    </div>
                    <?php endwhile; ?>
                    <?php
                }
            ?>
        </section>

        <section class='noc-featured-section'>
            <h2>Discover Our Menu</h2>
        </section>
        <?php endwhile; ?>
    </main>
    <?php