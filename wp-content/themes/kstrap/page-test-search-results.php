<?php

use Includes\Modules\MLS\QuickSearch;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

get_header();

if ($_GET['qs']) {
    $searchCriteria = $_GET;
    $qs             = new QuickSearch($searchCriteria);
    $results        = $qs->create();
    $listings       = $results->data;

    echo '<pre>',print_r($listings),'</pre>';
}

get_footer();
