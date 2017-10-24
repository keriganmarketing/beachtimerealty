<?php

use Includes\Modules\Slider\Slider;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper slider" >
            <div class="tagline" >
                <img src="<?php echo get_template_directory_uri().'/img/tagline.png'; ?>" alt="Selling the Beach at the Beach" class="img-fluid" >
            </div>
            <?php
                $slider = new Slider();
                echo $slider->getSlider('home-page-slider');
            ?>
        </div>
        <div class="section-wrapper quick-search">
            <div class="quick-search-box">
            <?php include(locate_template('template-parts/partials/quick-search.php')); ?>
            </div>
        </div>
        <div class="dotted-border"></div>
        <div class="section-wrapper feature-buttons">
        <?php include(locate_template('template-parts/partials/feature-buttons.php')); ?>
        </div>
        <div class="section-wrapper featured-properties">
            <?php include(locate_template('template-parts/partials/featured-listings.php')); ?>
        </div>
        <div class="section-wrapper home-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1><?php echo $headline; ?></h1>
                        <?php the_content(); ?>
                    </div>
                    <div class="col-lg-4">
                    <?php include(locate_template('template-parts/partials/random-testimonial.php')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dotted-border"></div>
        <div class="section-wrapper orange-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="section-title line-right">Recent&nbsp;News</h2>
<!--	                    --><?php //include(locate_template('template-parts/partials/facebook-minifeed.php')); ?>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="section-title line-right">Hot&nbsp;Property&nbsp;Alerts</h2>
	                    <?php include(locate_template('template-parts/partials/hot-property-signup.php')); ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
