<?php

use KeriganSolutions\FacebookFeed\FacebookFeed;


/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : get_the_archive_title());
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : get_the_archive_description());

$numberOfPosts = is_page('home') ? 3 : 9;
$feed    = new FacebookFeed();
$results = $feed->fetch($numberOfPosts);
$now     = time();

if (! property_exists($results, 'error')) { ?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo ($headline == 'Archives' ? 'Beach Blog' : $headline); ?></h1>
				<?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <section id="content" class="content section news">
            <div class="container">
                <div class="row">
                <?php
                foreach ($results->posts as $result) {
                    if(isset($result->message)) {
                        if (strlen($result->message) > 0) {
                            $trimmed = wp_trim_words($result->message, $num_words = 26, '...');
                        }
                    } else {
                        $trimmed = 'This just in...';
                    }


                    $photo_url = $result->full_picture;
                    ?>
                    <div class="col-md-6 col-lg-4 pb-4">
                        <?php include(locate_template('template-parts/partials/mini-article.php')); ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </section>
    </article>
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
