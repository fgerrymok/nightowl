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

// Remove Category Title From Breakfast Menu
// Working on this.

// Remove Default Shop Loop
// Working on this

// Remove product loop from shop page
// function remove_woocommerce_shop_loop() {
//     remove_action( 'woocommerce_shop_loop', 'woocommerce_template_loop_product_thumbnail', 10 );
//     remove_action( 'woocommerce_shop_loop', 'woocommerce_template_loop_product_title', 10 );
//     remove_action( 'woocommerce_shop_loop', 'woocommerce_template_loop_price', 10 );
//     remove_action( 'woocommerce_shop_loop', 'woocommerce_template_loop_add_to_cart', 10 );
//     remove_action( 'woocommerce_shop_loop', 'woocommerce_template_loop_rating', 10 );
//     remove_action( 'woocommerce_shop_loop', 'woocommerce_template_loop_category', 10 );    
// }
// add_action( 'template_redirect', 'remove_woocommerce_shop_loop' );

// remove_action( 'woocommerce_shop_loop', 'wc_get_template_part', 10 );


// Output Hero Section for Breakfast Menu
 function output_acf_fields_for_breakfast_menu_category() {
	if (is_product_category('breakfast')) {
		$category = get_queried_object();

		if ($category) {
			$productCategory = 'product_cat_' . $category->term_id;
			$heroHeading = get_field('breakfast_menu_hero_heading', $productCategory);
			$heroDescription = get_field('breakfast_menu_hero_short_description', $productCategory);
			$heroImage = get_field('breakfast_menu_hero_image', $productCategory);

			if ($heroHeading && $heroDescription && $heroImage) {
				?>
				<h1><?php echo esc_html($heroHeading); ?></h1>
				<p><?php echo esc_html($heroDescription); ?></p>
				<?php
				echo wp_get_attachment_image($heroImage, 'full');
			}
		}
	}
}
add_action('woocommerce_archive_description', 'output_acf_fields_for_breakfast_menu_category');


// Output Subnavigation for Breakfast Terms
function output_subnavigation_for_breakfast_menu() {
    if (is_product_category('breakfast')) {
        $terms = get_terms(array(
            'taxonomy' => 'noc-breakfast-subcategories',
            'hide_empty' => false,
        ));
        
        if ($terms && !is_wp_error($terms)) {
            ?>
            <ul class="menu-subnav">
            <?php
            foreach($terms as $term) {
                ?>
                <li><?php echo esc_html($term->name); ?></li>
                <?php
            }
            ?>
            </ul>
            <?php
        }
    }
}
add_action('woocommerce_before_shop_loop','output_subnavigation_for_breakfast_menu',21);

// Output Custom Taxonomy "Breakfast Categories" Terms and Products Associated with Each Term
function output_breakfast_categories() {
    if (is_product_category('breakfast')) {
        $terms = get_terms(array(
            'taxonomy' => 'noc-breakfast-subcategories',
            'hide_empty' => false,
        ));
        ?>
        <ul class="menu-items">
        <?php
    
        foreach($terms as $term) {
            if ($term && !is_wp_error($term)) {
                ?>
                <h2><?php echo esc_html($term->name); ?></h2>
                <?php
        
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'noc-breakfast-subcategories',
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
            }
        }
        ?>
        <ul>
        <?php
    }
}
add_action('woocommerce_before_shop_loop', 'output_breakfast_categories', 22);