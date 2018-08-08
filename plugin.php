<?php
/**
 * Plugin Name: Custom Post Type Testimonials
 * Plugin URI: https://horttcore.de
 * Description: Manage testimonials
 * Version: 1.0.0
 * Author: Ralf Hortt
 * Author URI: https://horttcore.de
 * Text Domain: custom-post-type-testimonials
 * Domain Path: /languages/
 * License: GPL2
 */

require( 'classes/custom-post-type.testimonials.php' );
require( 'classes/custom-post-type.testimonials.widget.php' );
require( 'includes/template-tags.php');
if (is_admin()) {
    require( 'classes/custom-post-type.testimonials.admin.php' );
}
