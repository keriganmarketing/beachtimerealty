<?php

use Includes\Modules\Agents\Agents;
use Includes\Modules\MLS\FullListing;
use Includes\Modules\MLS\FavoriteProperty;

if (isset($_GET['mls'])) {
    $mlsNumber   = $_GET['mls'];
    $fullListing = new FullListing($mlsNumber);
    $listingInfo = $fullListing->create();
    $isOurs = $fullListing->isOurs($listingInfo);
    $user_id     = get_current_user_id();
    $title       = $listingInfo->street_number . ' ' . $listingInfo->street_name;
    $buttonText  = $fullListing->isInFavorites($user_id, $listingInfo->mls_account) ? 'REMOVE FROM BUCKET' : 'SAVE TO BUCKET';
    if ($isOurs) {
        $listingMember = ($isOurs == 'listing_member_shortid' ? $listingInfo->listing_member_shortid : $listingInfo->colisting_member_shortid);
        $agents = new Agents;
        $mlsData = $agents->getAgentById($listingMember);
        $agentData = $agents->assembleAgentData($mlsData->data[0]->first_name. ' ' .$mlsData->data[0]->last_name);
    }
    if (isset($_POST['user_id'])) {
        echo "<meta http-equiv='refresh' content='0'>";
        $favorite  = new FavoriteProperty();
        $favorite->handleFavorite($_POST['user_id'], $_POST['mls_number']);
    }
}
?>
<div class="container-fluid">
    <div class="full-listing">
        <div class="row">
            <div class="col-lg-5 listing-left">
                <div class="listing-slider">
                    <?php include(locate_template('template-parts/partials/full-listing-photos.php')); ?>
                </div>
            </div>
            <div class="col-lg-7 listing-right">
                <div class="listing-core">
                    <?php include(locate_template('template-parts/partials/full-listing-core.php')); ?>
                </div>
                <div class="row">
                    <div class="col">
                        <?php if (in_array($listingInfo->class, ['G', 'A'], false)) {
    ?>
                            <div class="listing-residential">
                                <?php include(locate_template('template-parts/partials/full-listing-residential.php')); ?>
                            </div>
                        <?php
} ?>
                        <?php if (in_array($listingInfo->class, ['C'], false)) {
        ?>
                            <div class="listing-land">
                                <?php include(locate_template('template-parts/partials/full-listing-land.php')); ?>
                            </div>
                        <?php
    } ?>
                        <?php if (in_array($listingInfo->class, ['E', 'J', 'F'], false)) {
        ?>
                            <div class="listing-commercial">
                                <?php include(locate_template('template-parts/partials/full-listing-commercial.php')); ?>
                            </div>
                        <?php
    } ?>
                    </div>
                    <?php if ($isOurs && isset($agentData['name'])) {
        ?>
                        <div class="col-md-5">
                            <div class="listing-agent-box">
                                <?php include(locate_template('template-parts/partials/mini-agent.php')); ?>
                            </div>
                        </div>
                    <?php
    } ?>
                </div>
                <hr>
                <?php include(locate_template('template-parts/partials/full-listing-features.php')); ?>
            </div>
        </div>
        <hr>
        <div class="row location-info card-deck">
            <?php include(locate_template('template-parts/partials/full-listing-location.php')); ?>
        </div>
    </div>
</div>
