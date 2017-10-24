<?php

use Includes\Modules\MLS\FullListing;

if (isset($_GET['mls'])) {
    $mlsNumber   = $_GET['mls'];
    $fl          = new FullListing($mlsNumber);
    $listingInfo = $fl->create();
    echo '<!--', print_r($listingInfo), '-->';
    $isOurs = false;

    $user_id     = get_current_user_id();
//    $buttonText  = $listing->isInBucket($user_id, $listingInfo->mls_account) ? 'REMOVE FROM BUCKET' : 'SAVE TO BUCKET';
    $buttonText = 'SAVE TO BUCKET';
    $title       = $listingInfo->street_number . ' ' . $listingInfo->street_name;

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
                        <?php if (in_array($listingInfo->class, array('G', 'A'), false)) { ?>
                            <div class="listing-residential">
                                <?php include(locate_template('template-parts/partials/full-listing-residential.php')); ?>
                            </div>
                        <?php } ?>
                        <?php if (in_array($listingInfo->class, array('C'), false)) { ?>
                            <div class="listing-land">
                                <?php include(locate_template('template-parts/partials/full-listing-land.php')); ?>
                            </div>
                        <?php } ?>
                        <?php if (in_array($listingInfo->class, array('E', 'J', 'F'), false)) { ?>
                            <div class="listing-commercial">
                                <?php include(locate_template('template-parts/partials/full-listing-commercial.php')); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($isOurs) { ?>
                        <div class="col-md-5">
                            <div class="listing-agent-box">
                                <?php //include(locate_template('template-parts/partials/full-listing-agent.php')); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <hr>
                <?php include(locate_template('template-parts/partials/full-listing-features.php')); ?>
            </div>
        </div>
        <hr>
        <div class="row location-info">
            <?php include(locate_template('template-parts/partials/full-listing-location.php')); ?>
        </div>
    </div>
</div>