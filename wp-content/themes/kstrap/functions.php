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
use Includes\Modules\Notifications\ListingUpdated;
use Includes\Modules\KMAFacebook\FacebookController;


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

$facebook = new FacebookController();
$facebook->setupAdmin();

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

if (! wp_next_scheduled('notifications_hook')) {
    wp_schedule_event(time(), 'daily', 'notifications_hook');
}

//if(isset($_GET['test_email']) && $_GET['test_email'] == 'send') {
//    $listingUpdated = new ListingUpdated();
//    $listingUpdated->notify();
//}

add_action('notifications_hook', function()
{
    $listingUpdated = new ListingUpdated();
    $listingUpdated->notify();
});


add_action('wp_enqueue_scripts', 'kstrap_scripts');

add_filter( 'yoast_seo_development_mode', '__return_true' );

add_filter( 'wpseo_schema_webpage', 'change_yoast_schema' );

/**
 * Changes @type of Article Schema data.
 * @param array $data Schema.org Article data array.
 * @return array Schema.org Article data array.
 */
function change_yoast_schema( $data ) {
    
    $data['@context']  = "https://schema.org";
    $data['@type']     = "LocalBusiness";
    $data['name']      = "Beachtime Realty";
    $data['image']     = "https://beachtimerealty.com/themes/kstrap/screenshot.png";
    $data['@id']       = get_permalink(get_the_ID());
    $data['url']       = get_permalink(get_the_ID());
    $data['isPartOf']  = ['@id' => get_permalink(get_option('page_on_front')) ];
    $data['telephone'] = "(850)588-7791";
    $data['address']   = [
        "@type" => "PostalAddress",
        "streetAddress" => "305 North Arnold Drive",
        "addressLocality" => "Panama City Beach",
        "addressRegion" => "FL",
        "postalCode" => "32413",
        "addressCountry" => "US"
    ];
    $data['geo']   = [
        '@type' => "GeoCoordinates",
        'latitude' => 30.2327252,
        'longitude' => -85.88696039999999
    ];
    $data['openingHoursSpecification'][0] = [
        '@type' => "OpeningHoursSpecification",
        'dayOfWeek' => [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday",
        ],
        'opens' => "09:00",
        'closes' => "19:00"
    ];

    $data['areaServed'] = [
        [
        '@type' => "City",
        'name' => "Panama City Beach",
        'sameAs' => "https://en.wikipedia.org/wiki/Panama_City_Beach,_Florida"
        ],
        [
        '@type' => "City",
        'name' => "Panama City",
        'sameAs' => "https://en.wikipedia.org/wiki/Panama_City,_Florida"
        ],
        [
        '@type' => "City",
        'name' => "Upper Grand Lagoon",
        'sameAs' => "https://en.wikipedia.org/wiki/Upper_Grand_Lagoon,_Florida"
        ],
        [
        '@type' => "City",
        'name' => "Lower Grand Lagoon",
        'sameAs' => "https://en.wikipedia.org/wiki/Lower_Grand_Lagoon,_Florida"
        ],
        '@type' => "City",
        'name' => "Laguna Beach",
        'sameAs' => "https://en.wikipedia.org/wiki/Laguna_Beach,_Florida"
        ],
        [
        '@type' => "City",
        'name' => "Sunnyside",
        'sameAs' => "https://en.wikipedia.org/wiki/Sunnyside,_Florida"
        ],
        [
        '@type' => "City",
        'name' => "Rosemary Beach",
        'sameAs' => "https://en.wikipedia.org/wiki/Rosemary_Beach,_Florida"
        ],
        [
        '@type' => "City",
        'name' => "Destin",
        'sameAs' => "https://en.wikipedia.org/wiki/Destin,_Florida"
        ]
    ];

    $data['sameAs'] = [
        "https://www.facebook.com/beachtimerealtypcb/",
        "https://beachtimerealty.com/"
    ];

    $data['department'] = [
        $data['@type']     = "LocalBusiness";
        $data['name']      = "Beachtime Realty - Thomas Drive Location";
        $data['image']     = "https://beachtimerealty.com/themes/kstrap/screenshot.png";
        $data['@id']       = get_permalink(get_the_ID());
        $data['url']       = get_permalink(get_the_ID());
        $data['isPartOf']  = ['@id' => get_permalink(get_option('page_on_front')) ];
        $data['telephone'] = "(850)588-7791";
        $data['address']   = [
            "@type" => "PostalAddress",
            "streetAddress" => "9902 S. Thomas Drive",
            "addressLocality" => "Panama City Beach",
            "addressRegion" => "FL",
            "postalCode" => "32408",
            "addressCountry" => "US"
        ];
        $data['geo']   = [
            '@type' => "GeoCoordinates",
            'latitude' => 30.1765721,
            'longitude' => -85.88696039999999
        ];
        $data['openingHoursSpecification'][0] = [
            '@type' => "OpeningHoursSpecification",
            'dayOfWeek' => [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday",
            ],
            'opens' => "09:00",
            'closes' => "19:00"
        ];

        $data['areaServed'] = [
            [
            '@type' => "City",
            'name' => "Panama City Beach",
            'sameAs' => "https://en.wikipedia.org/wiki/Panama_City_Beach,_Florida"
            ],
            [
            '@type' => "City",
            'name' => "Panama City",
            'sameAs' => "https://en.wikipedia.org/wiki/Panama_City,_Florida"
            ],
            [
            '@type' => "City",
            'name' => "Upper Grand Lagoon",
            'sameAs' => "https://en.wikipedia.org/wiki/Upper_Grand_Lagoon,_Florida"
            ],
            [
            '@type' => "City",
            'name' => "Lower Grand Lagoon",
            'sameAs' => "https://en.wikipedia.org/wiki/Lower_Grand_Lagoon,_Florida"
            ],
            '@type' => "City",
            'name' => "Laguna Beach",
            'sameAs' => "https://en.wikipedia.org/wiki/Laguna_Beach,_Florida"
            ],
            [
            '@type' => "City",
            'name' => "Sunnyside",
            'sameAs' => "https://en.wikipedia.org/wiki/Sunnyside,_Florida"
            ],
            [
            '@type' => "City",
            'name' => "Rosemary Beach",
            'sameAs' => "https://en.wikipedia.org/wiki/Rosemary_Beach,_Florida"
            ],
            [
            '@type' => "City",
            'name' => "Destin",
            'sameAs' => "https://en.wikipedia.org/wiki/Destin,_Florida"
            ]
        ];

        $data['sameAs'] = [
            "https://www.facebook.com/beachtimerealtypcb/",
            "https://beachtimerealty.com/"
        ];    
    return $data;
}
