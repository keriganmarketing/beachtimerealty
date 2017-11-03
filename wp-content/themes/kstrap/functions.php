<?php

use Includes\Modules\Agents\Agents;
use Includes\Modules\Slider\Slider;
use Includes\Modules\CPT\VirtualPage;
use Includes\Modules\Helpers\CleanWP;
use Includes\Modules\Layouts\Layouts;
use Includes\Modules\Members\Members;
use Includes\Modules\MLS\Communities;
use Includes\Modules\Leads\RequestInfo;
use Includes\Modules\MLS\AdminSettings;
use Includes\Modules\Leads\HomeValuation;
use Includes\Modules\MLS\FeaturedListings;
use Includes\Modules\Social\SocialSettingsPage;
use Includes\Modules\Testimonials\Testimonials;

require('vendor/autoload.php');

new CleanWP();

$leads = new RequestInfo;
$leads->setupAdmin();

$leads = new HomeValuation;
$leads->setupAdmin();

$layouts = new Layouts();
$layouts->createPostType();
//$layouts->createDefaultFormats();

$socialLinks = new SocialSettingsPage();
if (is_admin()) {
    $socialLinks->createPage();
}

$testimonials = new Testimonials();
$testimonials->createPostType();
$testimonials->createAdminColumns();

$slider = new Slider();
$slider->createPostType();
$slider->createAdminColumns();

$agents = new Agents();
$agents->createPostType();

$featuredListings = new FeaturedListings();
$featuredListings->createPostType();
$featuredListings->createAdminColumns();

$members = new Members();

$listingPage = new VirtualPage('mls');

$idxSettings = new AdminSettings();
$idxSettings->setupPage();

$communities = new Communities();
$communities->createPostType();

function kstrap_setup()
{
    load_theme_textdomain('kstrap', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'mobile-menu'     => esc_html__('Mobile Menu', 'kstrap'),
        'main-menu-left'  => esc_html__('Main Menu Left', 'kstrap'),
        'main-menu-right' => esc_html__('Main Menu Right', 'kstrap')
    ]);

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ]);

    function kstrap_inline()
    {
        ?>
        <style type="text/css">
            <?php echo file_get_contents(get_template_directory() . '/style.css'); ?>
        </style>
    <?php
    }

    add_action('wp_head', 'kstrap_inline');
}

add_action('after_setup_theme', 'kstrap_setup');

function kstrap_scripts()
{
    wp_register_script('scripts', get_template_directory_uri() . '/app.js', [], '0.0.1', true);
    wp_enqueue_script('scripts');
    //wp_enqueue_style( 'style', get_stylesheet_uri() );
}

// if (! wp_next_scheduled('send_notifications')) {
//     wp_schedule_event(time(), 'daily', 'notifications_hook');
// }

// add_action('notifications_hook', 'send_notifications');

// function send_notifications()
// {
//     wp_mail('your@email.com', 'Automatic email', 'Automatic scheduled email from WordPress.');
// }

add_action('wp_enqueue_scripts', 'kstrap_scripts');
