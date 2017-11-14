<?php if ($listingInfo) { ?>
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
            <hr>
            <?php include(locate_template('template-parts/partials/mortgage-calculator.php')); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <p class="text-center">This listing no longer exists. <a href="/properties/">Try a search?</a></p>
    </div>
<?php } ?>