<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 11/12/15
 * Time: 12:27 AM
 */
// adding the function to the Wordpress init
add_action( 'init', 'register_post_types');
function register_post_types()
{

    //listings
    register_post_type('project',
        // let's now add all the options for this post type
        array('labels' => array(
            'name' => __('Projects', 'zenerator'), /* This is the Title of the Group */
            'singular_name' => __('Project', 'zenerator'), /* This is the individual type */
            'all_items' => __('All Projects', 'zenerator'), /* the all items menu item */
            'add_new' => __('Add New', 'zenerator'), /* The add new menu item */
            'add_new_item' => __('Add New Project', 'zenerator'), /* Add New Display Title */
            'edit' => __('Edit', 'zenerator'), /* Edit Dialog */
            'edit_item' => __('Edit Project', 'zenerator'), /* Edit Display Title */
            'new_item' => __('New Project', 'zenerator'), /* New Display Title */
            'view_item' => __('View Project', 'zenerator'), /* View Display Title */
            'search_items' => __('Search Projects', 'zenerator'), /* Search Custom Type Title */
            'not_found' => __('Nothing found in the Database.', 'zenerator'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash', 'zenerator'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => 'Parent Projects:'
        ), /* end of arrays */
            'description' => __('Projects for the portfolio', 'zenerator'), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon' => 'dashicons-format-video', /* the icon for the custom post type menu */
            'rewrite' => array('slug' => 'project'), /* you can specify its url slug */
            'has_archive' => 'projects', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'revisions', 'sticky')
        ) /* end of options */
    ); /* end of register post type */

}

add_action( 'cmb2_admin_init', 'zenerator_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function zenerator_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_zenerator_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'project_attributes',
        'title'         => __( 'Project Attributes', 'zenerator' ),
        'object_types'  => array( 'project', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name'       => __( 'URL', 'zenerator' ),
        'desc'       => __( 'Features of the project', 'zenerator' ),
        'id'         => $prefix . 'url',
        'type'       => 'text_url',
    ) );
    $cmb->add_field( array(
        'name'       => __( 'Features', 'zenerator' ),
        'desc'       => __( 'Features of the project', 'zenerator' ),
        'id'         => $prefix . 'features',
        'type'       => 'text',
        'repeatable' => true
    ) );
    $cmb->add_field( array(
        'name'    => 'Languages and Frameworks',
        'desc'    => 'Any languages or frameworks used on the project',
        'id'      => $prefix . 'languages',
        'type'    => 'multicheck',
        'options' => array(
            'PHP'       => 'PHP',
            'JavaScript'=> 'JavaScript',
            'HTML5'     => 'HTML5',
            'CSS3'      => 'CSS3',
            'jQuery'    => 'jQuery',
            'Symfony2'  => 'Symfony2',
            'Compass'   => 'Compass',
            'SASS'      => 'SASS',
            'Susy'      => 'Susy',
            'Velocity'  => 'Velocity',
            'Bootstrap' => 'Bootstrap',
            'Twig'      => 'Twig',
            'Git'       => 'Git',
            'Grunt.js'  => 'Grunt.js',
            'Gulp.js'   => 'Gulp.js',
            'Composer'  => 'Composer',
            'Bower'     => 'Bower',
            'YAML'      => 'YAML',
            'Node.js'   => 'Node.js',
            'NPM'       => 'NPM (Node Package Manager)'
        )
    ) );
    $cmb->add_field( array(
        'name' => 'Other Images',
        'desc' => 'All images in addition to the featured image',
        'id'   => $prefix . 'other_images',
        'type' => 'file_list',
         'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // Optional, override default text strings
        'options' => array(
            'file_text' => 'Image', // default: "File:"
        ),
    ) );
}