<?php
/**
 * Security, checks if WordPress is running
 **/
if (!function_exists( 'add_action' )) :
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
endif;



/**
*  Plugin
*/
final class Custom_Post_Type_Testimonials_Admin
{



    /**
     * Constructor
     *
     * @access public
     * @return void
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function __construct()
    {

        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );
        add_action( 'save_post', array( $this, 'save_post' ) );
    } // END __construct



    /**
     * Meta box
     *
     * @access public
     * @return void
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function add_meta_boxes()
    {

        add_meta_box( 'testimonial-meta', __( 'Information', 'custom-post-type-testimonials' ), array( $this, 'meta_box' ), 'testimonial' );
    } // END add_meta_boxes


    /**
     * Testimonials meta box
     *
     * @access public
     * @param obj $post Post object
     * @return void
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function meta_box($post)
    {

        $meta = get_post_meta( $post->ID, '_meta', true );
        wp_nonce_field( 'save-testimonial-meta', 'testimonial-meta-nounce' );

        ?>

        <table class="form-table">
            <tr>
                <th><label for="testimonial-role"><?php _e( 'Role', 'custom-post-type-testimonials' ); ?></label></th>
                <td><input type="text" class="regular-text" name="testimonial-role" id="testimonial-role" value="<?php if (isset( $meta['role'] )) : echo esc_attr( $meta['role'] ); endif ?>"></td>
            </tr>
            <tr>
                <th><label for="testimonial-company"><?php _e( 'Company', 'custom-post-type-testimonials' ); ?></label></th>
                <td><input type="text" class="regular-text" name="testimonial-company" id="testimonial-company" value="<?php if (isset( $meta['company'] )) : echo esc_attr( $meta['company'] ); endif ?>"></td>
            </tr>
        </table>

        <?php
    } // END meta_box



    /**
     * Post updated messages
     *
     * @access public
     * @param array $messages Update Messages
     * @return array Update Messages
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function post_updated_messages($messages)
    {

        $post             = get_post();
        $post_type        = 'testimonial';
        $post_type_object = get_post_type_object( $post_type );

        $messages[$post_type] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Testimonials updated.', 'custom-post-type-testimonials' ),
            2  => __( 'Custom field updated.' ),
            3  => __( 'Custom field deleted.' ),
            4  => __( 'Testimonials updated.', 'custom-post-type-testimonials' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonials restored to revision from %s', 'custom-post-type-testimonials' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Testimonials published.', 'custom-post-type-testimonials' ),
            7  => __( 'Testimonials saved.', 'custom-post-type-testimonials' ),
            8  => __( 'Testimonials submitted.', 'custom-post-type-testimonials' ),
            9  => sprintf( __( 'Testimonials scheduled for: <strong>%1$s</strong>.', 'custom-post-type-testimonials' ), date_i18n( __( 'M j, Y @ G:i', 'custom-post-type-testimonials' ), strtotime( $post->post_date ) ) ),
            10 => __( 'Testimonials draft updated.', 'custom-post-type-testimonials' )
        );

        if (!$post_type_object->publicly_queryable) {
            return $messages;
        }

        $permalink = get_permalink( $post->ID );

        $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View testimonial', 'custom-post-type-testimonials' ) );
        $messages[$post_type][1] .= $view_link;
        $messages[$post_type][6] .= $view_link;
        $messages[$post_type][9] .= $view_link;

        $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
        $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview testimonial', 'custom-post-type-testimonials' ) );
        $messages[$post_type][8]  .= $preview_link;
        $messages[$post_type][10] .= $preview_link;

        return $messages;
    } // END post_updated_messages


    /**
     * Callback to save the testimonial meta data
     *
     * @access public
     * @param int $post_id Post ID
     * @return void
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function save_post($post_id)
    {

        if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) :
            return;
        endif;

        if (!isset( $_POST['testimonial-meta-nounce'] ) || !wp_verify_nonce( $_POST['testimonial-meta-nounce'], 'save-testimonial-meta' )) :
            return;
        endif;

        update_post_meta( $post_id, '_meta', array(
            'role' => sanitize_text_field( $_POST['testimonial-role'] ),
            'company' => sanitize_text_field( $_POST['testimonial-company'] )
        ) );
    } // END save_post
} // END final class Custom_Post_Type_Testimonials_Admin

new Custom_Post_Type_Testimonials_Admin();
