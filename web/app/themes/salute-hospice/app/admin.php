<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/*
* Creating a function to create our Team CPT
*/
add_action( 'init', function () {
 
  // Set UI labels for Custom Post Type
  $labels = array(
      'name'                => _x( 'Team', 'Post Type General Name', 'Salute Hospice' ),
      'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'Salute Hospice' ),
      'menu_name'           => __( 'Team', 'Salute Hospice' ),
      'all_items'           => __( 'Everyone', 'Salute Hospice' ),
      'view_item'           => __( 'View Team', 'Salute Hospice' ),
      'add_new_item'        => __( 'Add New Team', 'Salute Hospice' ),
      'add_new'             => __( 'Add New', 'Salute Hospice' ),
      'edit_item'           => __( 'Edit Team', 'Salute Hospice' ),
      'update_item'         => __( 'Update Team', 'Salute Hospice' ),
      'search_items'        => __( 'Search Team', 'Salute Hospice' ),
      'not_found'           => __( 'Not Found', 'Salute Hospice' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'Salute Hospice' ),
  );
      
  // Set other options for Custom Post Type    
  $args = array(
      'label'               => __( 'movies', 'Salute Hospice' ),
      'description'         => __( 'Movie news and Teams', 'Salute Hospice' ),
      'labels'              => $labels,
      // Features this CPT supports in Post Editor
      'supports'            => array( 'title', 'editor', 'author', 'revisions', 'thumbnail'),
      // You can associate this CPT with a taxonomy or custom taxonomy. 
      // 'taxonomies'          => array( 'tours', 'category' ),
      /* A hierarchical CPT is like Pages and can have
      * Parent and child items. A non-hierarchical CPT
      * is like Posts.
      */ 
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_icon'           => 'dashicons-groups',
      'menu_position'       => 5,
      'can_export'          => true,
      'has_archive'         => false, // allows wp to read 'archive-recpies.php' as template
      'exclude_from_search' => false,
      'publicly_queryable'  => false,
      'capability_type'     => 'page',
      'show_in_rest'        => true, // enables block editor
  );

  // register a new taxonomy for teams
  // this keeps the categories separate from blog posts
  register_taxonomy(
    'team-categories',
    array('team'),
    array(
        'label' => __( 'Category' ),
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true
    ),

  );
      
  // Registering your Custom Post Type
  register_post_type( 'team', $args );
  
}, 0 );

/*
* Creating a function to create our Testimonial CPT
*/
add_action( 'init', function () {
 
  // Set UI labels for Custom Post Type
  $labels = array(
      'name'                => _x( 'Testimonial', 'Post Type General Name', 'Salute Hospice' ),
      'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'Salute Hospice' ),
      'menu_name'           => __( 'Testimonial', 'Salute Hospice' ),
      'all_items'           => __( 'Everyone', 'Salute Hospice' ),
      'view_item'           => __( 'View Testimonial', 'Salute Hospice' ),
      'add_new_item'        => __( 'Add New Testimonial', 'Salute Hospice' ),
      'add_new'             => __( 'Add New', 'Salute Hospice' ),
      'edit_item'           => __( 'Edit Testimonial', 'Salute Hospice' ),
      'update_item'         => __( 'Update Testimonial', 'Salute Hospice' ),
      'search_items'        => __( 'Search Testimonial', 'Salute Hospice' ),
      'not_found'           => __( 'Not Found', 'Salute Hospice' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'Salute Hospice' ),
  );
      
  // Set other options for Custom Post Type    
  $args = array(
      'label'               => __( 'movies', 'Salute Hospice' ),
      'description'         => __( 'Movie news and Testimonials', 'Salute Hospice' ),
      'labels'              => $labels,
      // Features this CPT supports in Post Editor
      // 'supports'            => array( 'title', 'editor', 'author', 'revisions'),
      // You can associate this CPT with a taxonomy or custom taxonomy. 
      // 'taxonomies'          => array( 'tours', 'category' ),
      /* A hierarchical CPT is like Pages and can have
      * Parent and child items. A non-hierarchical CPT
      * is like Posts.
      */ 
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_icon'           => 'dashicons-editor-quote',
      'menu_position'       => 5,
      'can_export'          => true,
      'has_archive'         => false,
      'exclude_from_search' => true,
      'publicly_queryable'  => false,
      'capability_type'     => 'page',
      'show_in_rest'        => true, // enables block editor
  );
      
  // Registering your Custom Post Type
  register_post_type( 'Testimonials', $args );

  // register a new taxonomy for testimonials
  // this keeps the categories separate from blog posts
  register_taxonomy(
    'testimonial-categories',
    array('testimonials'),
    array(
        'label' => __( 'Category' ),
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true
    ),

  );
  
}, 0 );
