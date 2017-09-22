<?php
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
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo $headline; ?></h1>
                <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <section id="content" class="content section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="entry-content">
                            <?php
                            the_content();
                            ?>
                        </div><!-- .entry-content -->
                    </div>
                    <div class="col-lg-8">
                        <?php include(locate_template('template-parts/partials/contact-form.php')); ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="section-wrapper contact-map">

            <?php include(locate_template('template-parts/partials/contact-map.php')); ?>

        </div>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
