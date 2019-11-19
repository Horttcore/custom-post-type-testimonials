<?php
/**
 * Get testimonial company
 *
 * @param int $postId Post ID
 * @return string Company
 **/
function get_testimonial_company(int $postId = null): string
{
    $postId = (null != $postId) ? $postId : get_the_ID();
    return get_post_meta($postId, 'company', true);
}



/**
 * Get testimonial role
 *
 * @param int $postId Post ID
 * @return string Role
 **/
function get_testimonial_role(int $postId = null): string
{
    $postId = (null != $postId) ? $postId : get_the_ID();
    return get_post_meta($postId, 'role', true);
}


/**
 * Get testimonial meta
 *
 * @param string $before Before output
 * @param string $after After output
 * @param int $postId Post ID
 * @return void
 **/
function the_testimonial_company(string $before = '', string $after = '', int $postId = null): void
{
    $postId = $postId ?? get_the_ID();
    $company = get_testimonial_company($postId);
    if (!$company) {
        return;
    }
    
    echo $before . $company . $after;
}


/**
 * Get testimonial meta
 *
 * @param string $before Before output
 * @param string $after After output
 * @param int $postId Post ID
 * @return void
 **/
function the_testimonial_role(string $before = '', string $after = '', int $postId = null): void
{
    $postId = $postId ?? get_the_ID();
    $role = get_testimonial_role($postId);
    if (!$role) {
        return;
    }
    
    echo $before . $role . $after;
}
