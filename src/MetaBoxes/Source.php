<?php
namespace RalfHortt\CustomPostTypeTestimonials\MetaBoxes;

use Horttcore\MetaBoxes\MetaBox;

class Source extends MetaBox
{
    protected $identifier = 'source';
    protected $screen = ['testimonial'];
    protected $priority = 'high';

    /**
     * Constructor
     **/
    public function __construct()
    {
        $this->name = __('Source', 'custom-post-type-testimonials');
    }

    /**
     * Render meta box
     *
     * @param WP_Post $post Post object
     * @return void
     **/
    public function render(\WP_Post $post): void
    {
        ?>
		<table class="form-table">
            <tr>
                <th><label for="testimonial-role"><?php _e('Role', 'custom-post-type-testimonials'); ?></label></th>
                <td><input type="text" class="regular-text" name="testimonial-role" id="testimonial-role" value="<?= esc_attr(get_testimonial_role($post->ID)) ?>"></td>
            </tr>
            <tr>
                <th><label for="testimonial-company"><?php _e('Company', 'custom-post-type-testimonials'); ?></label></th>
                <td><input type="text" class="regular-text" name="testimonial-company" id="testimonial-company" value="<?= esc_attr(get_testimonial_role($post->ID)) ?>"></td>
            </tr>
        </table>
		<?php
    }

    /**
     * Save meta
     *
     * @param int $postId Post ID
     * @return void
     **/
    public function save(int $postId): void
    {
        update_post_meta($postId, 'role', sanitize_text_field($_POST['testimonial-role']));
        update_post_meta($postId, 'company', sanitize_text_field($_POST['testimonial-company']));
    }
}
