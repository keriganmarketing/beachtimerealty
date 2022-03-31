<?php

use Includes\Modules\Agents\Agents;
use Includes\Modules\MLS\FullListing;
use Includes\Modules\MLS\FavoriteProperty;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

if (isset($_GET['mls'])) {
    $mlsNumber   = $_GET['mls'];
    $fullListing = new FullListing($mlsNumber);
    $listingInfo = $fullListing->create();

    if ($listingInfo) {
        $fullListing->setListingSeo($listingInfo);
        $isOurs     = $fullListing->isOurs($listingInfo);
        $user_id    = get_current_user_id();
        $title      = $listingInfo->street_number . ' ' . $listingInfo->street_name . ' ' . $listingInfo->street_suffix;
        $buttonText = $fullListing->isInFavorites($user_id,
            $listingInfo->mls_account) ? 'REMOVE FROM BUCKET' : 'SAVE TO BUCKET';
        if ($isOurs && isset($listingInfo->agent->id)) {
            $listingMember = ($isOurs == 'listing_member_shortid' ? $listingInfo->listing_member_shortid : $listingInfo->colisting_member_shortid);
            $agents        = new Agents;
            $mlsData       = $agents->getAgentById($listingMember);
            $agentData     = $agents->assembleAgentData($mlsData->data[0]->first_name . ' ' . $mlsData->data[0]->last_name);
        }
        if (isset($_POST['user_id'])) {
            echo "<meta http-equiv='refresh' content='0'>";
            $favorite = new FavoriteProperty();
            $favorite->handleFavorite($_POST['user_id'], $_POST['mls_number']);
        }
    }

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
<?php } ?>