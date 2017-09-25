<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 5/22/2017
 * Time: 2:08 PM
 */
?>
<div class="col" >
	<h3>Location Information</h3>
	<table class="table table-striped listing-data">
		<tbody>
		<?php if( isset($listingInfo->lot_description) ){ ?>
            <tr><td class="title">Area</td><td class="data">$<?php echo $listingInfo->lot_description; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->waterfront) && $listingInfo->waterfront != null){ ?>
        <tr><td class="title">Waterfront</td><td class="data"><?php echo $listingInfo->waterfront; ?></td></tr>
		<?php }else{ echo '<tr><td class="title">Waterfront</td><td class="data">No</td></tr>'; } ?>
		<?php if( isset($listingInfo->waterview_description) && $listingInfo->waterview_description != null ){ ?>
        <tr><td class="title">Waterfront</td><td class="data"><?php echo $listingInfo->waterview_description; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->elementary_school) ){ ?>
            <tr><td class="title">Elementary School</td><td class="data"><?php echo $listingInfo->elementary_school; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->middle_school) ){ ?>
            <tr><td class="title">Middle School</td><td class="data"><?php echo $listingInfo->middle_school; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->high_school) ){ ?>
            <tr><td class="title">High School</td><td class="data"><?php echo $listingInfo->high_school; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->county) ){ ?>
		<tr><td class="title">County</td><td class="data"><?php echo $listingInfo->county; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->zip) ){ ?>
		<tr><td class="title">Zip Code</td><td class="data"><?php echo $listingInfo->zip; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->sub_area) ){ ?>
		<tr><td class="title">Sub-area</td><td class="data"><?php echo $listingInfo->sub_area; ?></td></tr>
		<?php } ?>
		<?php if( isset($listingInfo->subdivision) ){ ?>
		<tr><td class="title">Subdivision</td><td class="data"><?php echo $listingInfo->subdivision; ?></td></tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="col-md-7">
    <div id="listing-map" style="height: 100%; min-height:200px; height: 350px;"></div>
	<script type="text/javascript">

        var map,
            marker,
            mapElement,
            mapOptions,
            myLatLng = {lat: <?php echo $listingInfo->latitude; ?>, lng: <?php echo $listingInfo->longitude; ?> },
            status = '<?php echo($listingInfo->status != '' ? strtolower($listingInfo->status) : ''); ?>',
            type = '<?php echo($listingInfo->property_type != '' ? $listingInfo->property_type : ''); ?>',
            pin;

            console.log(type);
            console.log(status);
            console.log(myLatLng);

        function initMap() {

            mapOptions = {
                zoom: 11,
                center: myLatLng,
                disableDefaultUI: true,
                zoomControl: true
            };

            mapElement = document.getElementById('listing-map');
            map = new google.maps.Map(mapElement, mapOptions);

            switch(type) {
                case 'G':
                case 'A':
                    pin = '/wp-content/themes/kstrap/img/residential-'+status+'-pin.png';
                    break;
                case 'E':
                case 'J':
                case 'F':
                    pin = '/wp-content/themes/kstrap/img/commercial-'+status+'-pin.png';
                    break;
                case 'C':
                    pin = '/wp-content/themes/kstrap/img/land-'+status+'-pin.png';
                    break;
                default:
                    pin = 'http://mt.googleapis.com/vt/icon/name=icons/spotlight/spotlight-poi.png&scale=1';
            }

            marker = new google.maps.Marker({
                title: '<?php echo $listingInfo->mls_account; ?>',
                position: myLatLng,
                map: map,
                icon: pin
            });

            console.log('map loaded');

        }

	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXeRhZCIYcKhtc-rfHCejAJsEW9rYtt4&callback=initMap" ></script>
</div>
