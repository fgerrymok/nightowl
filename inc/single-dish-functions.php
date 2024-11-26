<?php

// Move Price below description
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 21);


// Remove default add to cart button
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

// Remove SKU and category
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


// Remove description, additional info, and reviews
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

// Remove related products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Get product attributes
function get_product_attributes() {
    global $product;
    $attributes = $product->get_attributes();
    if ($attributes) {
        foreach($attributes as $attribute) {
            ?>
            <article class="menu-options-box">
                <h2><?php echo esc_html($attribute->get_name()); ?></h2>
                <?php
                $options = $attribute->get_options();
                if ($options) {
                    ?>
                    <ul>
                    <?php
                    foreach ($options as $option) {
                        ?>
                        <!-- Add structure for html radiobuttons -->
                        <li><?php echo esc_html($option); ?></li>
                        <?php
                    }
                    ?>
                    </ul>
                    <?php
                }
            ?>
            </article>
            <?php
        }
    }
}

add_action('woocommerce_after_single_product_summary', 'get_product_attributes', 21);

// Custom Add to cart button
function custom_add_to_cart() {
    ?>
    <button>Add To Cart</button>
    <?php
}
add_action('woocommerce_after_single_product_summary', 'custom_add_to_cart', 22);