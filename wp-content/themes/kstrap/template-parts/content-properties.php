<?php

use Includes\Modules\MLS\QuickSearch;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

if ($_GET['qs']) {
    $searchCriteria = $_GET;
    $qs             = new QuickSearch($searchCriteria);
    $results        = $qs->create();
    $listings       = $results->data;
    $lastPage       = $results->last_page;
    $totalResults   = $results->total;
    $currentPage    = (isset($_GET['pg']) ? $_GET['pg'] : 1);
    $currentUrl     = preg_replace("/&pg=\d+/", "", $_SERVER['REQUEST_URI']);
}

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo $headline; ?></h1>
                <?php echo($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <section id="content" class="content section">
            <div class="container-fluid">
                <div class="entry-content">
                    <?php the_content(); ?>

                    <div class="row">
                        <?php foreach ($listings as $result) {
    ?>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <?php include(locate_template('template-parts/partials/mini-listing.php')); ?>
                            </div>
                        <?php
} ?>
                    </div>
                    <div class="row justify-content-center">
                        <nav aria-label="search-pagination">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" <?php echo(1 != $currentPage ? 'href="'.$currentUrl.'&pg=1"' : 'disabled'); ?> aria-label="First">
                                        <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                                        <span class="sr-only">First</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" <?php echo(1 != $currentPage ? 'href="'.$currentUrl.'&pg='.($currentPage - 1).'"' : 'disabled'); ?> aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <span class="page-link disabled" ><?php echo $currentPage; ?></span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" <?php echo($lastPage != $currentPage ? 'href="'.$currentUrl.'&pg='.($currentPage + 1).'"' : 'disabled'); ?> aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" <?php echo($lastPage != $currentPage ? 'href="'.$currentUrl.'&pg='.$lastPage.'"' : 'disabled'); ?> aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                        <span class="sr-only">Last</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
