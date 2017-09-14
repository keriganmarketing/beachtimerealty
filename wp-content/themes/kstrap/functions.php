<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

require('vendor/autoload.php');
require('inc/bootstrap-wp-navwalker.php');
include('inc/CustomPostType/CustomPostType.php');
include('inc/modules/social/sociallinks.php');
include('inc/modules/testimonials/testimonials.php');
include('inc/modules/slider/Slider.php');

$socialLinks = new SocialSettingsPage();
if(is_admin()) {
	$socialLinks->createPage();
}

$testimonials = new Testimonials();
$testimonials->createPostType();
$testimonials->createAdminColumns();
$testimonials->createShortcode();

$slider = new Slider();
$slider->createPostType();
$slider->createAdminColumns();

//$book = new CustomPostType('Book');
//$book->addTaxonomy('category');
//$book->addTaxonomy('author');
//
//$book->addMetaBox(
//    'Book Info',
//    array(
//        'Year'               => 'text',
//        'Genre'              => 'text',
//        'Description'        => 'textarea',
//        'Featured'           => 'boolean',
//        'Favorite Cat Photo' => 'image',
//        'Start Date'         => 'date'
//    )
//);
//
//$book->addMetaBox(
//    'Formatted Description',
//    array(
//        'html'        => 'wysiwyg'
//    )
//);

if ( ! function_exists('kstrap_setup')) :

    function kstrap_setup()
    {

        load_theme_textdomain('kstrap', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        register_nav_menus(array(
	        'mobile-menu'     => esc_html__( 'Mobile Menu', 'kstrap' ),
	        'main-menu-left'  => esc_html__( 'Main Menu Left', 'kstrap' ),
	        'main-menu-right' => esc_html__( 'Main Menu Right', 'kstrap' )
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));

        function kstrap_inline()
        { ?>
            <style type="text/css">
                <?php echo file_get_contents(get_template_directory() . '/style.css'); ?>
            </style>
        <?php }

        add_action('wp_head', 'kstrap_inline');

        wp_register_script('scripts', get_template_directory_uri() . '/app.js', array(), '0.0.1', true);

    }
endif;
add_action('after_setup_theme', 'kstrap_setup');

function kstrap_scripts()
{
    wp_enqueue_script('scripts');
    //wp_enqueue_style( 'style', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'kstrap_scripts');