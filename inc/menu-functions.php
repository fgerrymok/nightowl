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
                <h2><?php echo esc_html($term->name); ?></h2>
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
            }
        }
        ?>
        <ul>
        <?php
    }
}
add_action('woocommerce_before_shop_loop', 'output_menu_titles_and_items', 22);