<?php

use Includes\Modules\MLS\FavoriteProperty;
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');

$listings = (new FavoriteProperty())->getSavedListings(get_current_user_id());
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo $headline; ?></h1>
                <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <section id="content" class="content section">
            <div class="row">
                <?php foreach ($listings as $result) { ?>
                <div class="col-sm-6 col-lg-3 text-center"> <?php include(locate_template('template-parts/partials/mini-listing.php')); ?>
                </div>
                <?php
                } ?>
            </div>
            <div class="container">
                <div class="entry-content">
                    <hr>
                    <div class="account-actions text-center">
                        <a class="btn btn-sm btn-primary btn-rounded mr-1" href="/my-account/edit-account/">Edit my account information</a>
                        <a class="btn btn-sm btn-primary btn-rounded" href="/my-account/change-password/">Change my password</a>
                    </div>
                    <hr>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
