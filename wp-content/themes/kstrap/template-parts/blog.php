<?php

use Includes\Modules\KMAFacebook\FacebookController;

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
$facebook = new FacebookController();
$feed = $facebook->getFbPosts(9);
$now     = time();

?>
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
                <?php if(count($feed) > 0){ ?>
                    <?php foreach ($feed as $result) {
                        if(isset($result->post_content)) {
                            if (strlen($result->post_content) > 0) {
                                $trimmed = wp_trim_words($result->post_content, $num_words = 26, '...');
                            }
                        } else {
                            $trimmed = 'This just in...';
                        }


                        $photo_url = (isset($result->full_image_url) && $result->full_image_url != '' ? $result->full_image_url : null);
                        ?>
                        <div class="col-md-6 col-lg-4 pb-4">
                            <?php include(locate_template('template-parts/partials/mini-article.php')); ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>
        </section>
    </article>
</div>
<?php include(locate_template('template-parts/partials/bot.php'));
