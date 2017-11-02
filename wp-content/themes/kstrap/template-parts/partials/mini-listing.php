<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 9/19/2017
 * Time: 1:29 PM
 */
?>

<div class="mini-listing-container">
    <a class="listing-link" href="/listing/?mls=<?php echo $result->mls_account; ?>"></a>
    <div class="embed-responsive embed-responsive-16by9">
        <div class="embed-responsive-item listing-tile-photo">

			<?php if ( $result->status == 'Sold' ) { ?>
                <span class="status-flag sold">Sold</span>
			<?php } ?>
			<?php if ( $result->status == 'Pending' ) { ?>
                <span class="status-flag under-contract">SALE PENDING</span>
			<?php } ?>
			<?php if ( $result->status == 'Contingent' ) { ?>
                <span class="status-flag contingent">SALE CONTINGENT</span>
			<?php } ?>
            <img src="<?php echo( $result->preferred_image != '' ? $result->preferred_image : get_template_directory_uri() . '/img/beachybeach-placeholder.png' ); ?>"
                 class="img-fluid lazy"
                 alt="MLS Property <?php echo $result->mls_account; ?> for sale in <?php echo $result->city; ?>"/>
        </div>
    </div>
    <div class="tile-info">

        <div class="tile-section address">
            <span class="addr1"><?php echo $result->street_number . ' ' . $result->street_name; ?></span><?php
			if ( $result->unit_number != '' ) { ?><span class="unit">
                , <?php echo $result->unit_number; ?></span><?php } ?>
            <br><span class="city"><?php echo $result->city; ?></span>,
            <span class="state"><?php echo $result->state; ?></span>
        </div>

        <?php if ($result->price > 0){ ?>
        <div class="tile-section price">
            <p>
                <span class="price"><?php echo( $result->price > 0 ? '$' . number_format( $result->price ) : '' ); ?></span>
            </p>
        </div>
        <?php }else{
            echo '<p></p>';
        } ?>

        <div class="tile-section attributes">
            <div class="row">
				<?php if ( $result->bedrooms > 0 || $result->bathrooms > 0 ) { //RESIDENTIAL LISTINGS ?>
                    <div class="col text-center">
                        <span class="icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <rect x="8.5" y="73.7" class="st0" width="187" height="37.8"/>
                                <rect x="108.1" y="40.8" class="st1" width="71.5" height="18.9"/>
                                <rect x="24.5" y="40.8" class="st1" width="71.5" height="18.9"/>
                                <polyline points="179.6,127.6 179.6,111.5 24.5,111.9 24.5,128 	"/>
                                <polygon points="11.5,73.3 22.2,59.6 181.9,59.6 192.5,73.3 	"/>
                            </svg>
                        </span>
                        <span class="baths-num icon-data"><?php echo $result->bedrooms; ?></span>
                        <span class="icon-label">BEDS</span>
                    </div>
                    <div class="col text-center">
                        <span class="icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <path d="M49.9,39.5v-11h-25v30h171c0,0,0,29-15.8,46.3c-22.4,24.6-49.8,24.8-49.8,24.8H73.9c0,0-32.5-2.8-51-26.3
                                    C7.7,83.9,7.2,58.5,7.2,58.5h17.8"/>
                                <polyline points="47.9,134.8 65.2,129.8 142.9,129.7 161.2,134.8 	"/>
                            </svg>
                        </span>
                        <span class="baths-num icon-data"><?php echo $result->bathrooms; ?></span>
                        <span class="icon-label">BATHS</span>
                    </div>
                    <div class="col text-xs-center">
                        <span class="icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <polyline points="7.9,33.2 7.9,21.5 195.9,21.5 195.9,132.3 7.9,132.3 7.9,61.3 	"/>
                                <line x1="144.9" y1="21.5" x2="144.9" y2="48.5"/>
                                <polyline points="196.3,76.8 101.9,78.2 101.9,55.5 101.9,97.5 	"/>
                            </svg>
                        </span>
                        <span class="baths-num icon-data"><?php echo number_format( $result->sq_ft ); ?></span>
                        <span class="icon-label">SQFT</span>
                    </div>
				<?php } elseif ( $result->sq_ft > 0 ) { //RESIDENTIAL LISTINGS ?>
                    <div class="col text-xs-center">
                        <span class="icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <polyline points="7.9,33.2 7.9,21.5 195.9,21.5 195.9,132.3 7.9,132.3 7.9,61.3 	"/>
                                <line x1="144.9" y1="21.5" x2="144.9" y2="48.5"/>
                                <polyline points="196.3,76.8 101.9,78.2 101.9,55.5 101.9,97.5 	"/>
                            </svg>
                        </span>
                        <span class="baths-num icon-data"><?php echo number_format( $result->sq_ft ); ?></span>
                        <span class="icon-label">SQFT</span>
                    </div>
                    <div class="col text-center">
                        <span class="icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <polygon points="142.9,37.9 101.3,69.5 59.7,37.9 101.3,6.3 	"/>
                                <polygon points="89.5,78.3 47.9,109.8 6.3,78.3 47.9,46.7 	"/>
                                <polygon points="196.3,78.3 154.7,109.8 113.1,78.3 154.7,46.7 	"/>
                                <polygon points="142.9,118.6 101.3,150.2 59.7,118.6 101.3,87 	"/>
                            </svg>
                        </span>
                        <span class="lot-dim-num icon-data"><?php echo $result->lot_dimensions ?></span>
                        <span class="icon-label">LOT SIZE</span>
                    </div>
				<?php } else { //LOTS & LAND ?>
                    <div class="col text-center">
                        <span class="icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <polygon points="142.9,37.9 101.3,69.5 59.7,37.9 101.3,6.3 	"/>
                                <polygon points="89.5,78.3 47.9,109.8 6.3,78.3 47.9,46.7 	"/>
                                <polygon points="196.3,78.3 154.7,109.8 113.1,78.3 154.7,46.7 	"/>
                                <polygon points="142.9,118.6 101.3,150.2 59.7,118.6 101.3,87 	"/>
                            </svg>
                        </span>
                        <span class="lot-dim-num icon-data"><?php echo( strlen( $result->lot_dimensions ) > 8 ? substr( $result->lot_dimensions,
									0, 8 ) . '...' : $result->lot_dimensions ); ?></span>
                        <span class="icon-label">LOT SIZE</span>
                    </div>
                    <div class="col text-center">
                        <span class="icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3;"
                                 xml:space="preserve">
                                <polygon points="44.4,25 15.7,62.5 29.9,62.5 10.2,101.5 27.9,101.5 7.4,137.5 97.9,137.5 72.9,100.5 92.9,100.5
                                    61.9,61.5 77.9,61.5 	"/>
                                <polygon points="84.5,6.5 60,41.6 68.6,51.3 77.9,61.5 61.9,61.5 92.9,100.5 72.9,100.5 97.9,137.5 101.5,137.5
                                    119.9,98.5 102.2,98.5 121.9,50.5 107.7,50.5 112,42 	"/>
                                <polygon points="136.4,7.5 107.7,50.5 121.9,50.5 102.2,98.5 119.9,98.5 99.4,144.5 189.9,143.5 164.9,97.5
                                    184.9,97.5 153.9,48.5 169.9,48.5 	"/>
                            </svg>
                        </span>
                        <span class="acres-num icon-data"><?php echo $result->acreage; ?></span>
                        <span class="icon-label">ACRES</span>
                    </div>
				<?php } ?>

            </div>
        </div>

        <div class="tile-section mls">
            <span class="mlsnum">MLS# <?php echo $result->mls_account; ?></span>
        </div>

    </div>
</div>