<?php

use GuzzleHttp\Client;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');

$mapResults = (isset($_SESSION['map_search']) ? true : false);
if(!$mapResults) {
    $client  = new Client(['base_uri' => 'http://mothership.kerigan.com/api/v1/allMapListings']);
    $raw     = $client->request(
        'GET'
    );
    $results = json_decode($raw->getBody());
    $_SESSION['map_search'] = serialize($results);
}else{
    $results = unserialize($_SESSION['map_search']);
}
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo $headline; ?></h1>
                <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <section id="content" class="content map-search">
            <div class="container">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->
            </div>
            <div id="map-search" ></div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
?>
<script type="text/javascript">
    var map,
      bounds,
      mapElement,
      markers = [],
      markerClusterer,
      styles = [[{
          url: '<?php echo get_template_directory_uri() ?>/img/m1.png',
          height: 50,
          width: 50,
          anchor: [0, 0],
          textColor: '#333333',
          textSize: 12
      }, {
          url: '<?php echo get_template_directory_uri() ?>/img/m2.png',
          height: 60,
          width: 60,
          anchor: [0, 0],
          textColor: '#333333',
          textSize: 12
      }, {
          url: '<?php echo get_template_directory_uri() ?>/img/m3.png',
          width: 70,
          height: 70,
          anchor: [0, 0],
          textColor: '#333333',
          textSize: 13
      }, {
          url: '<?php echo get_template_directory_uri() ?>/img/m4.png',
          width: 80,
          height: 80,
          anchor: [0, 0],
          textColor: '#333333',
          textSize: 13
      }, {
          url: '<?php echo get_template_directory_uri() ?>/img/m5.png',
          width: 90,
          height: 90,
          anchor: [0, 0],
          textColor: '#333333',
          textSize: 14
      }]];

    function initMap() {

        var myLatLng = {lat: 30.250795, lng: -85.940390 };
        var mapOptions = {
            zoom: 11,
            center: myLatLng,
            disableDefaultUI: true,
            // This is where you would paste any style found on Snazzy Maps.

        };

        mapElement = document.getElementById('map-search');
        map = new google.maps.Map(mapElement, mapOptions);
        bounds = new google.maps.LatLngBounds();

    }

    //add the pins
    function addMarker(lat,lng,type,mlsnum,status) {
        var pinLocation = new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
          contentString = '',
          mls = mlsnum,
          pin;

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

        var infowindow = new google.maps.InfoWindow();

        var marker = new google.maps.Marker({
            position: pinLocation,
            map: map,
            icon: pin
        });

        markers.push(marker);

        marker.addListener('click', function(){
            var requestedDoc = '/wp-content/themes/kstrap/template-parts/partials/map-listing.php?mls=' + mlsnum,
              xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    var response = this.responseText.replace(/(\r\n|\n|\r)/gm,"");

                    infowindow.close(); // Close previously opened infowindow
                    infowindow.setOptions({
                        padding: 0,
                        borderRadius: 0,
                        arrowSize: 10,
                        borderWidth: 0,
                        pixelOffset: new google.maps.Size(15, 60),
                        backgroundClassName: 'transparent',
                        content: contentString
                    })
                    infowindow.setContent('<div class="map-listing text-center">' + response + '</div>');
                    infowindow.open(map, marker);
                }
            };
            xhttp.open("GET", requestedDoc, true);
            xhttp.send();

        });

        bounds.extend(pinLocation);
        map.fitBounds(bounds);

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyCRXeRhZCIYcKhtc-rfHCejAJsEW9rYtt4&callback=initMap" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer.js" ></script>
<script defer>
    <?php
    foreach ($results as $result) {
    $latBounds = ( $result->latitude > 29 && $result->latitude < 32 ? true : false );
    $lngBounds = ( $result->longitude > - 90 && $result->longitude < - 83 ? true : false );
    if($latBounds && $lngBounds){ ?>
    addMarker('<?php echo $result->latitude; ?>', '<?php echo $result->longitude; ?>', '<?php echo $result->class; ?>', '<?php echo $result->mls_account; ?>', '<?php echo strtolower( $result->status ); ?>');
    <?php } } ?>

    markerClusterer = new MarkerClusterer(map, markers, {
        maxZoom: 14,
        gridSize: 60,
        styles: styles[0]
    });

</script>
