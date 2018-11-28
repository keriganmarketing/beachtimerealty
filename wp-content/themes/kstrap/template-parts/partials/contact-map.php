<?php
use Includes\Modules\Agents\Agents;
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>

<script type="text/javascript">

    var map,
        bounds,
        mapElement,
        myLatLng,
        mapOptions;

    function initMap() {

        myLatLng = {lat: 30.250795, lng: -85.940390 };
        mapOptions = {
            zoom: 10,
            center: myLatLng,
            disableDefaultUI: true,
            zoomControl: true
        };

        mapElement = document.getElementById('contact-map');
        map = new google.maps.Map(mapElement, mapOptions);
        bounds = new google.maps.LatLngBounds();
    }

    function addMarker(lat,lng,type,address) {
        var pinLocation = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
        var contentString =
            '<div class="community-map-info ' + type + '">' +
            '<div class="comm-text">' +
            '<p>' + address + '</p>' +
            '<a class="btn btn-primary btn-rounded btn-block" target="_blank" href="https://www.google.com/maps/dir//' + lat + ',' + lng + '/" >Get Directions</a>' +
            '</div>' +
            '</div>';

        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 279,
            content: contentString
        });

        var marker = new google.maps.Marker({
            position: pinLocation,
            map: map,
            icon: '<?php echo get_template_directory_uri() ?>/img/' + type + '-pin.png'
        });

        marker.addListener('click', function () {
            infoWindow.open(map, marker);
        });

        bounds.extend(pinLocation);
        map.fitBounds(bounds);
    }
</script>
<div id="contact-map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRThzvtP_UzOiLMxOWjKyswCK4KH3BViU&callback=initMap" ></script>
<script>
<?php
    $agents = new Agents();
    $offices = $agents->getOffices();
    foreach($offices as $office) { ?>
        addMarker(<?php echo $office['latitude'];?>,<?php echo $office['longitude'];?>,'office','<?php echo preg_replace( "/\r|\n/", "", $office['address']);?>');
<?php } ?>
</script>