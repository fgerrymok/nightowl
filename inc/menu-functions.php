<?php

/**
 * Functions for Breakfast Menu Page
 */

// Remove Sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Remove Results Count
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove Woocommerce Sorting Function
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Output Hero Section for Breakfast Menu
 function output_menu_acf_hero_fields() {
	if (is_product_category()) {
		$categoryObject = get_queried_object();
		if ($categoryObject) {
			$productCategory = 'product_cat_' . $categoryObject->term_id;
			$heroHeading = get_field($categoryObject->slug . '_menu_hero_heading', $productCategory);
			$heroDescription = get_field($categoryObject->slug . '_menu_hero_short_description', $productCategory);
			$heroImage = get_field($categoryObject->slug . '_menu_hero_image', $productCategory);

			if ($heroHeading && $heroDescription && $heroImage) {
				?>
                <div class="noc-hero-section">
                    <div class='hero-wrapper'>
                        <div class='hero-info-wrapper'>
                            <h1><?php echo esc_html($heroHeading); ?></h1>
                            <p><?php echo esc_html($heroDescription); ?></p>
                        </div>
                        <div class="hero-image-wrapper">
                            <div class="hero-overlay"></div>
                            <?php
                            echo wp_get_attachment_image($heroImage, 'full');
                            ?>
                        </div>
                    </div>
                </div>
            <?php
			}
		}
	}
}
add_action('woocommerce_archive_description', 'output_menu_acf_hero_fields');

// Output Subnavigation for Breakfast Terms
function output_menu_subnavigation() {
    if (is_product_category()) {
            $categoryObject = get_queried_object();
            $taxonomy = 'noc-' . $categoryObject->slug . '-subcategories';
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ));
        
            if ($terms && !is_wp_error($terms)) {
                ?>
                <div class='all-menus-wrapper'>
                <div class='sidebar-menu-wrapper'>
                        <svg class='sidebar-menu-button' clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22 16.75c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75z" fill-rule="nonzero"/></svg>
                        <div class='sidebar-dismiss-wrapper'>
                            <ul class="menu-subnav sidebar-menu-nav">
                            <?php
                            foreach($terms as $term) {
                                ?>
                                <li class='sidebar-menu-item' data-term="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></li>
                                <?php
                            }
                            ?>
                            </ul>
                            <button class='dismiss-btn'>Dismiss</button>
                        </div>
                    </div>
                    <div class='top-menu-wrapper'>
                        <ul class="menu-subnav top-menu-nav">
                        <?php
                        foreach($terms as $term) {
                            ?>
                            <li class='top-menu-item' data-term="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></li>
                            <?php
                        }
                        ?>
                        </ul>
                        <div class="tab-indicator"></div>
                        <div class='tab-indicator-wrapper'></div>
                    </div>
                </div>
                <?php
            }
            
    }
}
add_action('woocommerce_before_shop_loop','output_menu_subnavigation',21);

// Output Custom Taxonomy Terms and Menu Items
function output_menu_titles_and_items() {
    if (is_product_category()) {
        $categoryObject = get_queried_object();
        $taxonomy = 'noc-' . $categoryObject->slug . '-subcategories';
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ));
        ?>
        <ul class="menu-items">
        <?php
    
        foreach($terms as $term) {
            if ($term && !is_wp_error($term)) {
                ?>
                <div class="single-category-wrapper" data-term="<?php echo esc_attr($term->slug); ?>">
                    <h2><?php echo esc_html($term->name); ?></h2>
                    <div class="single-category-container">
                <?php
        
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'slug',
                            'terms' => $term
                        )
                    )
                );
        
                $query = new WP_Query($args);
            
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        wc_get_template_part('content', 'product');
                    }
                }
                wp_reset_postdata();
                    echo "</div>";
                echo "</div>";
            }
        }
        ?>
        <ul>
        <?php
    }
}
add_action('woocommerce_before_shop_loop', 'output_menu_titles_and_items', 22);

// Display Dish Excerpt
function display_dish_excerpt() {
    global $product;
    if ($product) {
        ?>
        <p class="text"><?php echo esc_html($product->get_short_description()); ?></p>
        <?php
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'display_dish_excerpt', 20);

// Remove Add to Cart Button from Shop Loop
// remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);