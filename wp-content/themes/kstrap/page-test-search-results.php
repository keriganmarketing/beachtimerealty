<?php

use Includes\Modules\MLS\QuickSearch;
use Includes\Modules\Notifications\ListingUpdated;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

get_header();

$l = (new ListingUpdated())->notify();

get_footer();
