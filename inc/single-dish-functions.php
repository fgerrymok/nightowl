<?php

// Move Price below description
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 21);

// Remove SKU and category
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


// Remove description, additional info, and reviews
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

// Remove related products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);