jQuery(document).ready(function($) {
    // When a radio button is clicked, update the hidden field
    $('input.variation-radio-option').on('change', function() {
        var attribute_name = $(this).attr('name'); // Get the attribute name (e.g., 'attribute_size')
        var attribute_value = $(this).val(); // Get the selected value

        // Set the hidden field value to the selected option
        $('input[name="' + attribute_name + '"]').val(attribute_value);

        // Trigger WooCommerce's variation price update logic
        var form = $('form.variations_form');
        form.trigger('check_variations');
    });
});
