<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 5/22/2017
 * Time: 2:08 PM
 */
$extfeatures  = explode(',', $listingInfo->exterior);
$amenities    = explode(',', $listingInfo->amenities);
$intfeatures  = explode(',', $listingInfo->interior);
$appliances   = explode(',', $listingInfo->appliances);
$energy       = explode(',', $listingInfo->energy_features);
$construction = explode(',', $listingInfo->construction);
$utilities    = explode(',', $listingInfo->utilities);
?>
<div class="card-columns">
    <?php if (count($intfeatures) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Interior</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($intfeatures as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (count($appliances) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Appliances</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($appliances as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (count($extfeatures) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Exterior</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($extfeatures as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (count($amenities) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Amenities</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($amenities as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (count($energy) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Energy</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($energy as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (count($construction) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Construction</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($construction as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (count($utilities) > 1) { ?>
        <div class="card">
            <div class="card-header">
                <strong>Utilities</strong>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($utilities as $feat) { ?>
                    <li class="list-group-item"><?php echo $feat; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>