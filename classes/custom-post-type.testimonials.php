<?php
/**
*  Plugin
*/
class Custom_Post_Type_Testimonails
{


    /**
     * Constructor
     *
     * @access public
     * @since v1.1.0
     * @author Ralf Hortt
     **/
    public function __construct()
    {
        add_action( 'custom-post-type-testimonials-widget-output', 'Custom_Post_Type_Testimonials_Widget::widget_output', 10, 3 );
        add_action( 'custom-post-type-testimonials-widget-loop-output', 'Custom_Post_Type_Testimonials_Widget::widget_loop_output', 10, 3 );
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
        add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
        add_filter( 'widgets_init', array( $this, 'widgets_init' ) );

    } // END __construct


    /**
     * Load plugin textdomain
     *
     * @access public
     * @since v1.1.0
     * @author Ralf Hortt
     **/
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain( 'custom-post-type-testimonials', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/../languages/'  );

    } // END load_plugin_textdomain


    /**
     * Default order
     *
     * @param WP_Query $query WP Query object
     * @return void
     **/
    public function pre_get_posts(WP_Query $query)
    {
        if (!$query->is_main_query()) {
            return;
        }

        if ($query->get('order')) {
            return;
        }

        $query->set( 'orderby', array('menu_order', 'date') );
        $query->set( 'order', 'ASC');

    }


    /**
     * Register post type
     *
     * @access public
     * @since v1.1.0
     * @author Ralf Hortt
     **/
    public function register_post_type()
    {
        register_post_type( 'testimonial', array(
            'labels' => array(
                'name' => _x( 'Testimonials', 'post type general name', 'custom-post-type-testimonials' ),
                'singular_name' => _x( 'Testimonial', 'post type singular name', 'custom-post-type-testimonials' ),
                'add_new' => _x( 'Add New', 'Testimonial', 'custom-post-type-testimonials' ),
                'add_new_item' => __( 'Add New Testimonial', 'custom-post-type-testimonials' ),
                'edit_item' => __( 'Edit Testimonial', 'custom-post-type-testimonials' ),
                'new_item' => __( 'New Testimonial', 'custom-post-type-testimonials' ),
                'view_item' => __( 'View Testimonial', 'custom-post-type-testimonials' ),
                'view_items' => __( 'View Testimonials', 'custom-post-type-testimonials' ),
                'search_items' => __( 'Search Testimonials', 'custom-post-type-testimonials' ),
                'not_found' => __( 'No Testimonials found', 'custom-post-type-testimonials' ),
                'not_found_in_trash' => __( 'No Testimonials found in Trash', 'custom-post-type-testimonials' ),
                'parent_item_colon' => __( 'Parent Testimonial:', 'custom-post-type-testimonials' ),
                'all_items' => __( 'All Testimonials', 'custom-post-type-testimonials' ),
                'archives' => __( 'Testimonial Archives', 'custom-post-type-testimonials' ),
                'attributes' => __( 'Testimonial Attributes', 'custom-post-type-testimonials' ),
                'insert_into_item' => __( 'Insert into testimonial', 'custom-post-type-testimonials' ),
                'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'custom-post-type-testimonials' ),
                'featured_image' => __( 'Featured Image', 'custom-post-type-testimonials' ),
                'set_featured_image' => __( 'Set featured image', 'custom-post-type-testimonials' ),
                'remove_featured_image' => __( 'Remove featured image', 'custom-post-type-testimonials' ),
                'use_featured_image' => __( 'Use as featured image', 'custom-post-type-testimonials' ),
                'filter_items_list' => __( 'Filter testimonials list', 'custom-post-type-testimonials' ),
                'items_list_navigation' => __( 'Testimonials list navigation', 'custom-post-type-testimonials' ),
                'items_list' => __( 'Testimonials list', 'custom-post-type-testimonials' ),
            ),
            'public' => FALSE,
            'publicly_queryable' => TRUE,
            'show_ui' => TRUE,
            'show_in_menu' => TRUE,
            'query_var' => TRUE,
            'rewrite' => array(
                'slug' => _x( 'testimonials', 'post type slug', 'custom-post-type-testimonials' ),
                'with_front' => FALSE,
            ),
            'capability_type' => 'post',
            'has_archive' => FALSE,
            'hierarchical' => FALSE,
            'menu_position' => NULL,
            'menu_icon' => 'dashicons-admin-comments',
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
        ) );

    } // END register_post_type


    /**
     * Widget init
     *
     * @access public
     * @since 0.5.0
     * @author Ralf Hortt
     */
    public function widgets_init()
    {
        register_widget( 'Custom_Post_Type_Testimonials_Widget' );

    } // END widgets_init


} // END Custom_Post_Type_Testimonails

new Custom_Post_Type_Testimonails;
