<?php
namespace Includes\Modules\MLS;

use GuzzleHttp\Client;

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
        $propertyType = implode('|', $this->getPropertyTypes($this->searchCriteria['propertyType']));
        $minPrice     = $this->searchCriteria['minPrice'];
        $maxPrice     = $this->searchCriteria['maxPrice'];
        $page         = isset($this->searchCriteria['pg']) ? $this->searchCriteria['pg'] : 1;

        $client       = new Client(['base_uri' => 'http://mls.kerigan.com/api/']);

        // make the API call
        $raw = $client->request(
            'GET',
            'search?city='. $omni .'&class='. $propertyType .'&status=Active&minPrice='. $minPrice .'&maxPrice='. $maxPrice .'&page='. $page
        );

        $results = json_decode($raw->getBody());

        return $results;
    }

    private function getPropertyTypes($class = null)
    {
        $typeArray = [
            'Single Family Home'   => ['Detached Single Family'],
            'Condo / Townhome'     => ['Condominium', 'Townhouse', 'Townhomes'],
            'Commercial'           => ['Office', 'Retail', 'Industrial', 'Income Producing', 'Unimproved Commercial', 'Business Only', 'Auto Repair', 'Improved Commercial', 'Hotel/Motel'],
            'Lots / Land'          => ['Vacant Land', 'Residential Lots', 'Land', 'Land/Acres', 'Lots/Land'],
            'Multi-Family Home'    => ['Duplex Multi-Units', 'Triplex Multi-Units'],
            'Rental'               => ['Apartment', 'House', 'Duplex', 'Triplex', 'Quadruplex', 'Apartments/Multi-family'],
            'Manufactured'         => ['Mobile Home', 'Mobile/Manufactured'],
            'Farms / Agricultural' => ['Farm', 'Agricultural', 'Farm/Ranch', 'Farm/Timberland'],
            'Other'                => ['Attached Single Unit', 'Attached Single Family', 'Dock/Wet Slip', 'Dry Storage', 'Mobile/Trailer Park', 'Mobile Home Park', 'Residential Income', 'Parking Space', 'RV/Mobile Park']
        ];

        if ($class != null) {
            return $typeArray[$class];
        }

        return $typeArray;
    }
}
