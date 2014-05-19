<?php
$taxonomy_portfolio_category_labels = array(
 'name' => 'Portfolio Types',
 'singular_name' => 'Portfolio Types',
 'search_items' => 'Search Portfolio Types',
 'popular_items' => 'Popular Portfolio Types',
 'all_items' => 'All Portfolio Types',
 'parent_item' => 'Parent Portfolio Type',
 'parent_item_colon' => 'Parent Portfolio Type:',
 'edit_item' => 'Edit Portfolio Type',
 'update_item' => 'Update Portfolio Type',
 'add_new_item' => 'Add New Portfolio Type',
 'new_item_name' => 'New Portfolio Type Name',
 'separate_items_with_commas' => 'Separate Portfolio type with commas',
 'add_or_remove_items' => 'Add or remove Portfolio types',
 'choose_from_most_used' => 'Choose from the most used Portfolio types',
 'menu_name' => 'Portfolio Types',
 );

$taxonomy_portfolio_category_args = array(
 'labels' => $taxonomy_portfolio_category_labels,
 'public' => true,
 'show_ui' => true,
 'hierarchical' => true,
 'rewrite' => array('slug' => 'portfolio-type' , 'with_front' => false),
 'query_var' => true,
 'singular_label' => 'Portfolio Type',
 );

add_action( 'init', 'portfolio-type' );
    register_post_type( 'portfolio',
    array(
        'labels' => array(
        'name' => __( 'Portfolio' ),
        'singular_name' => __( 'Portfolio' )
	),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields')
    )
    );
register_taxonomy( 'portfolio-type', array( 'portfolio' ), $taxonomy_portfolio_category_args );
?>
