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
    $test           = $qs->create();

    echo '<pre>',print_r($test),'</pre>';
}

get_footer();
