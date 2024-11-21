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

// Remove Default Shop Loop
// Working on this

// Output Hero Section for Breakfast Menu
 function output_acf_fields_for_breakfast_menu_category() {
	if (is_product_category("breakfast")) {
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

// Output Custom Taxonomy "Breakfast Categories" Terms and Products Associated with Each Term
function output_breakfast_categories() {

    $terms = get_terms(array(
        'taxonomy' => 'noc-breakfast-subcategories',
        'hide_empty' => false,
    ));

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
            
            ?>
            <ul class="breakfast-menu-items">
            <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    wc_get_template_part('content', 'product');
                }
            }
            ?>
            <ul>
            <?php
            wp_reset_postdata();

        }
    }
}
add_action('woocommerce_before_shop_loop', 'output_breakfast_categories', 21);