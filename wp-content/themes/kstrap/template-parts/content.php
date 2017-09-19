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
                <div class="entry-content">
                    <?php
                    the_content(sprintf(
                        /* translators: %s: Name of current post. */
                        wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'kmaevent'), [ 'span' => [ 'class' => [] ] ]),
                        the_title('<span class="screen-reader-text">"', '"</span>', false)
                    ));

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'kmaevent'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
