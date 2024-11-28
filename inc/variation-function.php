<?php

// 1. Display custom options from ACF fields on the product page
add_action('woocommerce_before_add_to_cart_button', 'display_variation');

function display_variation() {
    $product_id = get_the_ID();
    $options = get_field('option_field', $product_id);

    if ($options) {
        echo '<div class="product-custom-options">';

        foreach ($options as $option) {
            $header = $option['header'];
            $option_list = $option['option_list'];

            if ($header && $option_list) {
                // Retrieve the option type (e.g., Drink Options, Size) and other attributes
                $option_type = $header['option_type'];
                $limitation = $header['limitation']; // Single selection (Radio) or multiple (Checkbox)
                $is_it_required = $header['is_it_required']; // Whether the option is required

                // Display the option title
                echo '<div class="product-option">';
                echo '<h5>' . esc_html($option_type) . ($is_it_required ? ' (Required)' : '') . '</h5>';

                // Loop through each option in the list and display as a radio/checkbox input
                foreach ($option_list as $single_option) {
                    $option_label = esc_html($single_option['single_option_name']);
                    $option_price = number_format(floatval($single_option['single_option_price']), 2);

                    // Set input type based on limitation (radio for single, checkbox for multiple)
                    $input_type = ($limitation == 1) ? 'radio' : 'checkbox';
                    $input_name = ($limitation == 1) ? esc_attr($option_type) : esc_attr($option_type) . '[]';

                    echo '<label>';
                    echo '<input type="' . $input_type . '" name="custom_options[' . esc_attr($option_type) . '][]" value="' . esc_attr($option_label . '|' . $option_price) . '">';
                    echo $option_label . ' (+$' . $option_price . ')';
                    echo '</label>';
                }

                echo '</div>';
            }
        }

        echo '</div>';
    }
};

// 2. Add selected custom options to cart item data
add_filter('woocommerce_add_cart_item_data', 'selected_custom_options', 10, 2);

function selected_custom_options($cart_item_data, $product_id) {
    if (!empty($_POST['custom_options'])) {
        foreach ($_POST['custom_options'] as $option_type => $selected_options) {
            if (is_array($selected_options)) {
                foreach ($selected_options as $selected_option) {
                    // Store selected options grouped by their type (option title)
                    $cart_item_data['custom_options'][$option_type][] = sanitize_text_field($selected_option);
                }
            }
        }
    }
    return $cart_item_data;
};


// 3. Display selected custom options in the cart and checkout pages
add_filter('woocommerce_get_item_data', 'display_selected_custom_options_in_the_cart_checkout_page', 10, 2);

function display_selected_custom_options_in_the_cart_checkout_page($item_data, $cart_item) {
    if (!empty($cart_item['custom_options'])) {
        foreach ($cart_item['custom_options'] as $option_type => $selected_values) {
            $formatted_values = [];
            foreach ($selected_values as $option_value) {
                $option_parts = explode('|', $option_value); // Split option name and price
                $formatted_values[] = $option_parts[0] . ' (+$' . $option_parts[1] . ')'; // Format for display
            }
            // Add the formatted values as a single line under the option title
            $item_data[] = [
                'name' => ucfirst(str_replace('_', ' ', $option_type)),
                'value' => implode(', ', $formatted_values),
            ];
        }
    }
    return $item_data;
};

// 4. Add custom option prices to the cart total
add_action('woocommerce_before_calculate_totals', 'add_custom_option_prices', 10, 1);

function add_custom_option_prices($cart) {
    // Avoid affecting admin area or AJAX calls
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    foreach ($cart->get_cart() as $cart_item) {
        if (!empty($cart_item['custom_options'])) {
            $additional_price = 0;

            foreach ($cart_item['custom_options'] as $selected_values) {
                foreach ($selected_values as $option_value) {
                    $option_parts = explode('|', $option_value); // Split option name and price
                    $additional_price += floatval($option_parts[1]); // Add to total price
                }
            }

            // Add the additional price to the product's base price
            if ($additional_price > 0) {
                $cart_item['data']->set_price($cart_item['data']->get_price() + $additional_price);
            }
        }
    }
};
?>