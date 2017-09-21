<?php

use Includes\Modules\MLS\FullListing;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

if (isset($_GET['mls'])) {
    $mlsNumber = $_GET['mls'];
    $fl = new FullListing($mlsNumber);
    $results = $fl->create();
    echo '<pre>',print_r($results),'</pre>';
}

include(locate_template('template-parts/partials/top.php'));
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
        </div>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content">
                    <?php
                        echo $_GET['mls'];
                    ?>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/partials/bot.php'));

