<?php

use Includes\Modules\MLS\FeaturedListings;
use Includes\Modules\MLS\FullListing;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

$featuredLiastings = new FeaturedListings();
$listings = $featuredLiastings->getFeaturedListings();

?>
<div class="container-fluid">
    <div class="container-fluid">
        <h3 class="section-title text-center line-left line-right">Featured&nbsp;Real&nbsp;Estate</h3>

        <div class="row justify-content-center">
		<?php
        foreach($listings as $mlsNumber){
            $fl     = new FullListing($mlsNumber);
            $result = $fl->create();
            if(isset($result->mls_account)){
                // echo '<pre>',print_r($result),'</pre>';
            ?>
			<div class="col-sm-6 col-md-4 col-lg-3 text-center">
				<?php include( locate_template( 'template-parts/partials/mini-listing.php' ) ); ?>
			</div>
		<?php } } ?>
        </div>
        <div class="section-bottom">
            <div class="section-button text-center">
                <a class="btn btn-primary btn-outlined btn-reversed" href="/properties/" >Search All Listings</a>
            </div>
        </div>
    </div>
</div>
