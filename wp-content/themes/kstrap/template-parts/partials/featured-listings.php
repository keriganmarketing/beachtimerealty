<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
?>
<div class="container-fluid">
	<h2 class="section-title text-center line-left line-right">Featured&nbsp;Listings</h2>
	<div class="row">
		<?php

        for ($i = 0; $i < 4; $i++) {
	        $result = (object) [
		        'status'          => 'Active',
		        'preferred_image' => 'http://cdn.resize.sparkplatform.com/bc/1024x768/true/20170823152242322341000000-o.jpg',
		        'mls_account'     => '662356',
		        'street_number'   => '5436',
		        'street_name'     => 'Hopetown',
		        'unit_number'     => '',
		        'city'            => 'Panama City Beach',
		        'state'           => 'FL',
		        'price'           => '449555',
		        'bedrooms'        => '3',
		        'bathrooms'       => '4',
		        'sq_ft'           => '2428',
		        'lot_dimensions'  => '1x1',
		        'lot_acreage'     => '.5'
	        ];
            ?>
			<div class="col-sm-6 col-lg-3 text-center">
				<?php include( locate_template( 'template-parts/partials/mini-listing.php' ) ); ?>
			</div>
		<?php } ?>
	</div>
	<div class="section-bottom">
		<div class="section-button text-center">
			<a class="btn btn-primary btn-outlined btn-reversed" href="/properties/" >Search All Property Types</a>
		</div>
	</div>
</div>
