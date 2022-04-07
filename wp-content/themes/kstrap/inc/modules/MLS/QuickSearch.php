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
        $omni         = $this->searchCriteria['omniField'] ?? '';
        $propertyType = isset($this->searchCriteria['propertyType']) && $this->searchCriteria['propertyType'] != '' ?
            implode('|', self::getPropertyTypes($this->searchCriteria['propertyType'])) : '';
        $minPrice     = $this->searchCriteria['minPrice'] ?? '';
        $maxPrice     = $this->searchCriteria['maxPrice'] ?? '';
        $bedrooms     = $this->searchCriteria['bedrooms'] ?? '';
        $bathrooms    = $this->searchCriteria['bathrooms'] ?? '';
        $sq_ft        = $this->searchCriteria['sq_ft'] ?? '';
        $acreage      = $this->searchCriteria['acreage'] ?? '';
        $waterfront   = $this->searchCriteria['waterfront'] ?? '';
        $pool         = $this->searchCriteria['pool'] ?? '';
        $page         = $this->searchCriteria['pg'] ?? 1;
        $sortBy       = $this->searchCriteria['sortBy'] ?? 'date_modified';
        $orderBy      = $this->searchCriteria['orderBy'] ?? 'DESC';
        $status       = isset($this->searchCriteria['status']) && $this->searchCriteria['status'] != '' ?
            implode('|', self::setStatus($this->searchCriteria['status'])) : '';

        $client = new Client([
            'base_uri' => 'https://mothership2.kerigan.com/api/v1/',
            'http_errors' => false,
            'headers' => [
                'Referrer' => $_SERVER['HTTP_USER_AGENT']
            ]
        ]);

        // make the API call
        $apiCall = $client->request(
            'GET',
            'search?'
            .'city='.          $omni
            .'&propertyType='. $propertyType
            .'&status='.       $status
            .'&minPrice='.     $minPrice
            .'&maxPrice='.     $maxPrice
            .'&bedrooms='.     $bedrooms
            .'&bathrooms='.    $bathrooms
            .'&sq_ft='.        $sq_ft
            .'&acreage='.      $acreage
            .'&waterfront='.   $waterfront
            .'&pool='.         $pool
            .'&page='.         $page
            .'&sortBy='.       $sortBy
            .'&orderBy='.      $orderBy
        );

        $results = json_decode($apiCall->getBody());

        return $results;
    }

    public static function getPropertyTypes($array = [])
    {
        if(!is_array($array)){
            $array = explode('|',$array);
        }

        $typeArray = [
            'Single Family Home'   => ['Detached Single Family', 'Detached', 'SingleFamilyResidence'],
            'Condo / Townhome'     => ['Condominium', 'Townhouse', 'Townhomes'],
            'Commercial'           => ['Income Producing','BuildingBusiness', 'Unimproved Commercial', 'Business Only', 'Auto Repair', 'Improved Commercial', 'Hotel/Motel','Business','Commercial'],
            'Lots / Land'          => ['Vacant Land', 'Residential Lots', 'Land', 'Land/Acres', 'Lots/Land','Acreage', 'Residential'],
            'Multi-Family Home'    => ['Duplex Multi-Units', 'Triplex Multi-Units','MultiFamily', 'Multi Family', 'Attached', 'Duplex', 'Quadruplex', 'Triplex'],
            'Rental'               => ['Rental'],
            'Manufactured'         => ['Mobile Home', 'Mobile/Manufactured','MobileHome','ModularHome'],
            'Farms / Agricultural' => ['Farm', 'Agricultural', 'Farm/Ranch', 'Farm/Timberland','Agriculture','Ranch'],
            'Other'                => ['Attached Single Unit', 'Attached Single Family', 'Dock/Wet Slip', 'Dry Storage', 'Mobile/Trailer Park', 'Mobile Home Park', 'Residential Income', 'Parking Space', 'RV/Mobile Park','Dockominium']
        ];

        $value = [];

        foreach($array as $item){
            if(isset($typeArray[$item])){
                $value = array_merge($value, $typeArray[$item]);
            }
        }

        return $value;
    }

    public function setStatus($array)
    {
        if(!is_array($array)){
            $array = explode('|',$array);
        }

        $statusArray = [
            'Active'                    => ['Active'],
            'Active Under Contract'     => ['Active Under Contract'],
            'Pending'                   => ['Pending'],
            'Sold'                      => ['Sold','Closed'],
        ];

        $value = [];

        foreach($array as $item){
            if(isset($statusArray[$item])){
                $value = array_merge($value, $statusArray[$item]);
            }
        }

        return $value;
    }
}
