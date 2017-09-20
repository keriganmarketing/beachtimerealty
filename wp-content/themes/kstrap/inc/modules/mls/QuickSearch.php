<?php
namespace Includes\Modules\MLS;

/**
* MLS Search - Made by Daron Adkins
*/
class QuickSearch
{
    private $searchCriteria;

    /**
     * Search Constructor
     * @param array $searchCriteria - Basically just the $_GET variables
     */
    public function __construct($searchCriteria)
    {
        $this->searchCriteria   = $searchCriteria;
    }


    public function create()
    {
        $omni         = $this->searchCriteria['omniField'];
        $propertyType = $this->searchCriteria['propertyType'];
        $priceRange   = $this->searchCriteria['priceRange'];
    }
}
