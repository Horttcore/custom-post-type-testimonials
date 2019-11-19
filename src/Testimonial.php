<?php
namespace RalfHortt\CustomPostTypeTestimonials;

use Horttcore\CustomPostType\PostType;

/**
 * Service example
 */
class Testimonial extends PostType
{
    protected $slug = 'testimonial';

    public function getConfig(): array
    {
        return [
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => _x('testimonials', 'Post Type Slug', 'custom-post-type-testimonials'),
                'with_front' => false,
            ],
            'capability_type' => 'post',
            'has_archive'     => false,
            'hierarchical'    => false,
            'menu_position'   => null,
            'menu_icon'       => 'dashicons-megaphone',
            'supports'        => [
                'title',
                'editor',
                'thumbnail',
                'page-attributes',
            ],
            'show_in_rest' => true,
        ];
    }

    public function getLabels(): array
    {
        return [
            'name'                  => _x('Testimonials', 'post type general name', 'custom-post-type-testimonials'),
            'singular_name'         => _x('Testimonial', 'post type singular name', 'custom-post-type-testimonials'),
            'add_new'               => _x('Add New', 'Testimonial', 'custom-post-type-testimonials'),
            'add_new_item'          => __('Add New Testimonial', 'custom-post-type-testimonials'),
            'edit_item'             => __('Edit Testimonial', 'custom-post-type-testimonials'),
            'new_item'              => __('New Testimonial', 'custom-post-type-testimonials'),
            'view_item'             => __('View Testimonial', 'custom-post-type-testimonials'),
            'view_items'            => __('View Testimonials', 'custom-post-type-testimonials'),
            'search_items'          => __('Search Testimonials', 'custom-post-type-testimonials'),
            'not_found'             => __('No Testimonials found', 'custom-post-type-testimonials'),
            'not_found_in_trash'    => __('No Testimonials found in Trash', 'custom-post-type-testimonials'),
            'parent_item_colon'     => __('Parent Testimonial', 'custom-post-type-testimonials'),
            'all_items'             => __('All Testimonials', 'custom-post-type-testimonials'),
            'archives'              => __('Testimonial Archives', 'custom-post-type-testimonials'),
            'attributes'            => __('Testimonial Attributes', 'custom-post-type-testimonials'),
            'insert_into_item'      => __('Insert into testimonial', 'custom-post-type-testimonials'),
            'uploaded_to_this_item' => __('Uploaded to this page', 'custom-post-type-testimonials'),
            'featured_image'        => __('Logo', 'custom-post-type-testimonials'),
            'set_featured_image'    => __('Set logo', 'custom-post-type-testimonials'),
            'remove_featured_image' => __('Remove logo', 'custom-post-type-testimonials'),
            'use_featured_image'    => __('Use as logo', 'custom-post-type-testimonials'),
            'menu_name'             => _x('Testimonials', 'post type general name', 'custom-post-type-testimonials'),
            'filter_items_list'     => __('Testimonials', 'custom-post-type-testimonials'),
            'items_list_navigation' => __('Testimonials', 'custom-post-type-testimonials'),
            'items_list'            => __('Testimonials', 'custom-post-type-testimonials'),
        ];
    }

    public function getPostUpdateMessage(): array
    {
        return [
            'name'                  => _x('Testimonials', 'post type general name', 'custom-post-type-testimonials'),
            'singular_name'         => _x('Testimonial', 'post type singular name', 'custom-post-type-testimonials'),
            'add_new'               => _x('Add New', 'Testimonial', 'custom-post-type-testimonials'),
            'add_new_item'          => __('Add New Testimonial', 'custom-post-type-testimonials'),
            'edit_item'             => __('Edit Testimonial', 'custom-post-type-testimonials'),
            'new_item'              => __('New Testimonial', 'custom-post-type-testimonials'),
            'view_item'             => __('View Testimonial', 'custom-post-type-testimonials'),
            'view_items'            => __('View Testimonials', 'custom-post-type-testimonials'),
            'search_items'          => __('Search Testimonials', 'custom-post-type-testimonials'),
            'not_found'             => __('No Testimonials found', 'custom-post-type-testimonials'),
            'not_found_in_trash'    => __('No Testimonials found in Trash', 'custom-post-type-testimonials'),
            'parent_item_colon'     => __('Parent Testimonial', 'custom-post-type-testimonials'),
            'all_items'             => __('All Testimonials', 'custom-post-type-testimonials'),
            'archives'              => __('Testimonial Archives', 'custom-post-type-testimonials'),
            'attributes'            => __('Testimonial Attributes', 'custom-post-type-testimonials'),
            'insert_into_item'      => __('Insert into testimonial', 'custom-post-type-testimonials'),
            'uploaded_to_this_item' => __('Uploaded to this page', 'custom-post-type-testimonials'),
            'featured_image'        => __('Logo', 'custom-post-type-testimonials'),
            'set_featured_image'    => __('Set logo', 'custom-post-type-testimonials'),
            'remove_featured_image' => __('Remove logo', 'custom-post-type-testimonials'),
            'use_featured_image'    => __('Use as logo', 'custom-post-type-testimonials'),
            'menu_name'             => _x('Testimonials', 'post type general name', 'custom-post-type-testimonials'),
            'filter_items_list'     => __('Testimonials', 'custom-post-type-testimonials'),
            'items_list_navigation' => __('Testimonials', 'custom-post-type-testimonials'),
            'items_list'            => __('Testimonials', 'custom-post-type-testimonials'),
        ];
    }

    /**
     * Update messages.
     *
     * @param WP_Post      $post     Post object
     * @param string       $postType Post type slug
     * @param WP_Post_Type $postType Post type slug
     *
     * @return array Update messages
     **/
    public function getPostUpdateMessages(\WP_Post $post, string $postType, \WP_Post_Type $postTypeObjects) : array
    {
        $messages = [
            0  => '', // Unused. Messages start at index 1.
            1  => __('Testimonial updated.', 'custom-post-type-testimonials'),
            2  => __('Custom field updated.'),
            3  => __('Custom field deleted.'),
            4  => __('Testimonial updated.', 'custom-post-type-testimonials'),
            5  => isset($_GET['revision']) ? sprintf(__('Testimonial restored to revision from %s', 'custom-post-type-testimonials'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
            6  => __('Testimonial published.', 'custom-post-type-testimonials'),
            7  => __('Testimonial saved.', 'custom-post-type-testimonials'),
            8  => __('Testimonial submitted.', 'custom-post-type-testimonials'),
            9  => sprintf(__('Testimonial scheduled for: <strong>%1$s</strong>.', 'custom-post-type-testimonials'), date_i18n(__('M j, Y @ G:i', 'custom-post-type-testimonials'), strtotime($post->post_date))),
            10 => __('Testimonial draft updated.', 'custom-post-type-testimonials'),
        ];

        if (!$postTypeObjects->publicly_queryable) {
            return $messages;
        }

        $permalink = get_permalink($post->ID);
        $view_link = sprintf(' <a href="%s">%s</a>', esc_url($permalink), __('View testimonial', 'custom-post-type-testimonials'));
        $messages[1] .= $view_link;
        $messages[6] .= $view_link;
        $messages[9] .= $view_link;

        $preview_permalink = add_query_arg('preview', 'true', $permalink);
        $preview_link = sprintf(' <a target="_blank" href="%s">%s</a>', esc_url($preview_permalink), __('Preview testimonial', 'custom-post-type-testimonials'));
        $messages[8] .= $preview_link;
        $messages[10] .= $preview_link;

        return $messages;
    }
}
