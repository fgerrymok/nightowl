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
        ?>
        <form action="#">
            <fieldset>
                <?php
                foreach($attributes as $attribute) {
                    ?>
                    <legend><?php echo esc_html($attribute->get_name()); ?></legend>
                    <div class="all-options">
                    <?php
                    $options = $attribute->get_options();
                    if ($options) {
                        $index = 0;
                        foreach ($options as $option) {
                            ?>
                            <div class="one-option">
                                <input type="radio" id="<?php echo esc_html($option); ?>" name="<?php echo esc_html($attribute->get_name()); ?>" value="<?php echo esc_html($option); ?>">
                                <label for="<?php echo esc_html($option); ?>"><?php echo esc_html($option); ?></label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    </div>
                    <?php
                }
                ?>
                <div>
                    <button><?php echo esc_html("Add To Cart"); ?></button>
                </div>
            </fieldset>
        </form>
        <?php
    }
}

add_action('woocommerce_after_single_product_summary', 'get_product_attributes', 21);