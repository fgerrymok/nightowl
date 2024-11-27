<?php
// Display custom options on the product page
add_action('woocommerce_before_add_to_cart_button', function () {
    echo '<div class="product-custom-options">';
    echo '<h4>Custom Options</h4>';

    // Option 1: Egg Style (Radio)
    echo '<div class="product-option">';
    echo '<h5>Egg Style</h5>';
    echo '<label><input type="radio" name="egg_style" value="sunny_side_up"> Sunny Side Up</label><br>';
    echo '<label><input type="radio" name="egg_style" value="hard_boiled"> Hard Boiled</label><br>';
    echo '<label><input type="radio" name="egg_style" value="scrambled"> Scrambled</label>';
    echo '</div>';

    // Option 2: Drink (Checkbox)
    echo '<div class="product-option">';
    echo '<h5>Drink (+ extra cost)</h5>';
    echo '<label><input type="checkbox" name="drink[]" value="tea"> Tea (+$1)</label><br>';
    echo '<label><input type="checkbox" name="drink[]" value="soda"> Soda (+$2)</label><br>';
    echo '<label><input type="checkbox" name="drink[]" value="coffee"> Coffee (+$3)</label>';
    echo '</div>';

    // Option 3: Add More (Checkbox)
    echo '<div class="product-option">';
    echo '<h5>Add More</h5>';
    echo '<label><input type="checkbox" name="add_more[]" value="lettuce"> Lettuce</label><br>';
    echo '<label><input type="checkbox" name="add_more[]" value="tomato"> Tomato</label><br>';
    echo '<label><input type="checkbox" name="add_more[]" value="cheese"> Cheese (+$1)</label><br>';
    echo '<label><input type="checkbox" name="add_more[]" value="ham"> Ham (+$2)</label>';
    echo '</div>';

    echo '</div>';
});

// Pass custom option data to the cart
add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id) {
    if (isset($_POST['egg_style'])) {
        $cart_item_data['egg_style'] = sanitize_text_field($_POST['egg_style']);
    }
    if (!empty($_POST['drink'])) {
        $cart_item_data['drink'] = array_map('sanitize_text_field', $_POST['drink']);
    }
    if (!empty($_POST['add_more'])) {
        $cart_item_data['add_more'] = array_map('sanitize_text_field', $_POST['add_more']);
    }
    return $cart_item_data;
}, 10, 2);

// Display custom options in cart and checkout
add_filter('woocommerce_get_item_data', function ($item_data, $cart_item) {
    if (!empty($cart_item['egg_style'])) {
        $item_data[] = ['name' => 'Egg Style', 'value' => ucfirst(str_replace('_', ' ', $cart_item['egg_style']))];
    }
    if (!empty($cart_item['drink'])) {
        foreach ($cart_item['drink'] as $drink) {
            $price = ($drink === 'tea' ? '+$1' : ($drink === 'soda' ? '+$2' : '+$3'));
            $item_data[] = ['name' => ucfirst($drink), 'value' => $price];
        }
    }
    if (!empty($cart_item['add_more'])) {
        foreach ($cart_item['add_more'] as $extra) {
            $price = ($extra === 'cheese' ? '+$1' : ($extra === 'ham' ? '+$2' : 'Free'));
            $item_data[] = ['name' => ucfirst($extra), 'value' => $price];
        }
    }
    return $item_data;
}, 10, 2);

// Adjust cart item prices based on selected options
add_action('woocommerce_before_calculate_totals', function ($cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    foreach ($cart->get_cart() as $cart_item) {
        $additional_price = 0;

        // Calculate additional prices for drinks
        if (!empty($cart_item['drink'])) {
            foreach ($cart_item['drink'] as $drink) {
                if ($drink === 'tea') {
                    $additional_price += 1;
                } elseif ($drink === 'soda') {
                    $additional_price += 2;
                } elseif ($drink === 'coffee') {
                    $additional_price += 3;
                }
            }
        }

        // Calculate additional prices for extras
        if (!empty($cart_item['add_more'])) {
            foreach ($cart_item['add_more'] as $extra) {
                if ($extra === 'cheese') {
                    $additional_price += 1;
                } elseif ($extra === 'ham') {
                    $additional_price += 2;
                }
            }
        }

        // Update the product price
        if ($additional_price > 0) {
            $cart_item['data']->set_price($cart_item['data']->get_price() + $additional_price);
        }
    }
}, 10, 1);