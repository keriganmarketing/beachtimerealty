<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

query_posts('posts_per_page=1&post_type=post');
get_header();
include(locate_template('template-parts/partials/top.php'));
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
        </div>
        <section id="content" class="content section">
            <div class="section-wrapper">
                <?php include(locate_template('template-parts/partials/full-listing.php')); ?>
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/partials/bot.php'));
get_footer();
?>
<script src="/wp-content/themes/kstrap/js/mortgageCalculator.js" ></script>
