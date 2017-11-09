<?php
use KeriganSolutions\MLS\FullListing;

$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

if(isset($_GET['mls'])) {

    $fl     = new FullListing($_GET['mls']);
    $result = $fl->create();

    include(locate_template('template-parts/partials/mini-listing.php'));

}
