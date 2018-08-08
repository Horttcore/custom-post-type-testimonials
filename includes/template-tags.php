<?php
/**
 * Get testimonial company
 *
 * @param int $post_id Post ID
 * @return string Company
 **/
function get_testimonial_company(int $post_id = null)
{
    $post_id = ( null != $post_id ) ? $post_id : get_the_ID();
    return get_testimonial_meta( $post_id, 'company' );
}



/**
 * Get testimonial role
 *
 * @param int $post_id Post ID
 * @return string Role
 **/
function get_testimonial_role(int $post_id = null)
{
    $post_id = ( null != $post_id ) ? $post_id : get_the_ID();
    return get_testimonial_meta( $post_id, 'role' );
}


/**
 * Get testimonial meta
 *
 * @param int $post_id Post ID
 * @return void
 **/
function the_testimonial_company(int $post_id = null)
{
    $post_id = ( null != $post_id ) ? $post_id : get_the_ID();
    echo get_testimonial_company( $post_id );
}


/**
 * Get testimonial meta
 *
 * @param int $post_id Post ID
 * @return void
 **/
function the_testimonial_role(int $post_id = null)
{
    $post_id = ( null != $post_id ) ? $post_id : get_the_ID();
    echo get_testimonial_role( $post_id );
}


/**
 * Get testimonial meta
 *
 * @param int $post_id Post ID
 * @param string $key Meta Key
 * @return array
 **/
function get_testimonial_meta(int $post_id, string $key)
{
    $meta = get_post_meta( $post_id, '_meta', true );
    return ( isset( $meta[$key] ) ) ? $meta[$key] : null;
}
