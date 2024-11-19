<?php

function noc_register_taxonomies() {
    // Add Breakfast Subcategories Taxonomy
    $labels = array(
        'name'              => _x( 'Breakfast Subcategories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Breakfast Subcategory', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Breakfast Subcategories' ),
        'all_items'         => __( 'All Breakfast Subcategory' ),
        'parent_item'       => __( 'Parent Breakfast Subcategory' ),
        'parent_item_colon' => __( 'Parent Breakfast Subcategory:' ),
        'edit_item'         => __( 'Edit Breakfast Subcategory' ),
        'view_item'         => __( 'Vview Breakfast Subcategory' ),
        'update_item'       => __( 'Update Breakfast Subcategory' ),
        'add_new_item'      => __( 'Add New Breakfast Subcategory' ),
        'new_item_name'     => __( 'New Breakfast Subcategory Name' ),
        'menu_name'         => __( 'Breakfast Subcategories' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'breakfast-subcategories' ),
    );
    register_taxonomy( 'noc-breakfast-subcategories', array( 'product' ), $args );
}
add_action( 'init', 'noc_register_taxonomies');