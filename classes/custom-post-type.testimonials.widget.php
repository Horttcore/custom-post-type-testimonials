<?php
/**
 * Widget
 *
 * @author Ralf Hortt
 */
if (class_exists( 'Custom_Post_Type_Testimonials_Widget' )) {
    return;
}

class Custom_Post_Type_Testimonials_Widget extends WP_Widget
{


    /**
     * Constructor
     *
     * @access public
     * @since v2.0
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function __construct()
    {
        $widget_ops  = array(
            'classname' => 'widget-testimonials',
            'description' => __( 'List testimonial logos', 'custom-post-type-testimonials' ),
        );
        $control_ops = array( 'id_base' => 'widget-testimonials' );
        parent::__construct( 'widget-testimonials', __( 'Testimonials', 'custom-post-type-testimonials' ), $widget_ops, $control_ops );

    } // END __construct


    /**
     * Output
     *
     * @access public
     * @param array $args     Arguments
     * @param array $instance Widget instance
     * @since v2.0
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function widget($args, $instance)
    {
        $query = array(
            'post_type' => 'testimonial',
            'showposts' => $instance['limit'],
            'orderby' => $instance['orderby'],
            'order' => $instance['order'],
        );

        if (0 != $instance['testimonial-category']) :
            $query['tax_query'] = array(
            array(
                'taxonomy' => 'testimonial-category',
                'field' => 'term_id',
                'terms' => $instance['testimonial-category'],
            )
            );
        endif;

        if ('event-date' == $instance['orderby']) :
            $query['orderby']      = 'meta_value_num';
            $query['meta_query'][] = array(
                'key' => '_event-date-end',
                'value' => time(),
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
        endif;

        $query = new WP_Query( $query );

        if ($query->have_posts()) :
            /**
             * Widget output
             *
             * @param array $args Arguments
             * @param array $instance Widget instance
             * @param obj $query WP_Query object
             * @hooked Custom_Post_Type_Widget::widget_output - 10
             */
            do_action( 'custom-post-type-testimonials-widget-output', $args, $instance, $query );
        endif;

        wp_reset_query();

    } // END widget


    /**
     * Save widget settings
     *
     * @access public
     * @param array $new_instance New widget instance
     * @param array $old_instance Old widget instance
     * @author Ralf Hortt <me@horttcore.de>
     **/
    public function update($new_instance, $old_instance)
    {
        $instance            = $old_instance;
        $instance['title']   = $new_instance['title'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['order']   = $new_instance['order'];
        $instance['limit']   = $new_instance['limit'];

        $instance['testimonial-category'] = ( isset( $new_instance['testimonial-category'] ) ) ? $new_instance['testimonial-category'] : FALSE;

        return $instance;

    } // END update


    /**
     * Widget settings
     *
     * @access public
     * @param array $instance Widget instance
     * @author Ralf Hortt <me@horttcore.de>
     * @since v2.0
     **/
    public function form($instance)
    {
        ?>

        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label><br>
            <input class="regular-text" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if (isset( $instance['title'] )) : echo esc_attr( $instance['title'] ); endif; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'orderby' ); ?>"><?php _e( 'Order by:', 'custom-post-type-testimonials' ); ?></label><br>
            <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_name( 'orderby' ); ?>">
                <option <?php selected( $instance['orderby'], '' ) ?> value=""><?php _e( 'Default' ); ?></option>
                <option <?php selected( $instance['orderby'], 'title' ) ?> value="title"><?php _e( 'Title' ); ?></option>
                <option <?php selected( $instance['orderby'], 'menu_order' ) ?> value="menu_order"><?php _e( 'Menu order' ); ?></option>
                <option <?php selected( $instance['orderby'], 'date' ) ?> value="date"><?php _e( 'Publishing date' ); ?></option>
                <option <?php selected( $instance['orderby'], 'rand' ) ?> value="rand"><?php _e( 'Random' ); ?></option>
                <option <?php selected( $instance['orderby'], 'ID' ) ?> value="ID"><?php _e( 'ID', 'custom-post-type-testimonials' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'order' ); ?>"><?php _e( 'Order:' ); ?></label><br>
            <select name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_name( 'order' ); ?>">
                <option <?php selected( $instance['order'], 'ASC') ?> value="ASC"><?php _e( 'Ascending', 'custom-post-type-testimonials' ); ?></option>
                <option <?php selected( $instance['order'], 'DESC') ?> value="DESC"><?php _e( 'Descending', 'custom-post-type-testimonials' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'limit' ); ?>"><?php _e( 'Count:', 'custom-post-type-testimonials' ); ?></label><br>
            <input class="regular-text" type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php if (isset( $instance['limit'] )) : echo esc_attr( $instance['limit'] ); endif; ?>">
        </p>
        <?php

    } // END form


    /**
     * Widget loop output
     *
     * @static
     * @access public
     * @param array $args     Arguments
     * @param array $instance Widget instance
     * @param obj   $query    WP_Query object
     * @author Ralf Hortt <me@horttcore.de>
     * @since v2.0
     **/
    public static function widget_loop_output($args, $instance, $query)
    {
        ?>
        <div class="testimonial__item">

            <figure class="testimonial__item__image">
                <?php the_post_thumbnail( 'thumbnail' ) ?>
            </figure>

            <blockquote class="testimonial__item__blockquote">

                <div class="testimonial__item__content">
                    <?php the_content() ?>
                </div>

                <footer class="testimonial__item__footer">
                    <cite class="testimonial__item__cite">
                        <div class="testimonial__item__title"><?php the_title() ?></div>
                        <?php printf( _x( '%s at %s', 'Role at Company' ,'custom-post-type-testimonials' ), get_testimonial_role(), get_testimonial_company() ) ?>
                    </cite>
                </footer>

            </blockquote>

        </div>
        <?php

    } // END widget_loop_output


    /**
     * Widget output
     *
     * @static
     * @access public
     * @param array $args     Arguments
     * @param array $instance Widget instance
     * @param obj   $query    WP_Query object
     * @author Ralf Hortt <me@horttcore.de>
     * @since v2.0
     **/
    public static function widget_output($args, $instance, $query)
    {
        echo $args['before_widget'];

        echo $args['before_title'] . $instance['title'] . $args['after_title'];

        ?>
        <ul class="testimonial__list">
            <?php
            while ($query->have_posts()) :
                $query->the_post();

                /**
                 * Loop output
                 *
                 * @param array $args Arguments
                 * @param array $instance Widget instance
                 * @param obj $query WP_Query object
                 * @hooked Custom_Post_Type::widget_loop_output - 10
                 */
                do_action( 'custom-post-type-testimonials-widget-loop-output', $args, $instance, $query );
            endwhile;
            ?>
        </ul>
        <?php
        echo $args['after_widget'];

    } // END widget_output


} // END class Custom_Post_Type_Testimonials_Widget
