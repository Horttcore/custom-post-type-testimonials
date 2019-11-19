<?php
/**
 * Plugin Name:     Custom Post Type Testimonials
 * Plugin URI:      https://horttcore.de
 * Description:     A WordPress Custom Post Type for Testimonials
 * Author:          Ralf Hortt
 * Author URI:      https://horttcore.de
 * Text Domain:     custom-post-type-testimonials
 * Domain Path:     /languages
 * Version:         1.0
 *
 * @package         RalfHortt/CustomPostTypeTestimonials
 */

namespace RalfHortt\CustomPostTypeTestimonials;

use RalfHortt\CustomPostTypeTestimonials\Testimonial;
use RalfHortt\CustomPostTypeTestimonials\MetaBoxes\Source;
use Horttcore\Plugin\PluginFactory;

// ------------------------------------------------------------------------------
// Prevent direct file access
// ------------------------------------------------------------------------------
if (!defined('WPINC')) :
    die;
endif;

// ------------------------------------------------------------------------------
// Autoloader
// ------------------------------------------------------------------------------
$autoloader = dirname(__FILE__).'/vendor/autoload.php';

if (is_readable($autoloader)) :
    require_once $autoloader;
endif;

// ------------------------------------------------------------------------------
// Bootstrap
// ------------------------------------------------------------------------------
PluginFactory::create()
    ->addTranslation('custom-post-type-testimonials', dirname(plugin_basename(__FILE__)).'/languages/')
    ->addService(Testimonial::class)
    ->addService(Source::class)
    ->boot();
