<?php
namespace Includes\Modules\MLS;

use GuzzleHttp\Client;

/**
* MLS Listing - Made by Daron Adkins
*/
class FullListing
{
    private $mlsNumber;

    /**
     * Search Constructor
     * @param string $mlsNumber - Basically just the $_GET variables
     */
    public function __construct($mlsNumber)
    {
        $this->mlsNumber   = $mlsNumber;
    }


    public function show()
    {
        $client       = new Client(['base_uri' => 'http://mls.kerigan.com/api/listing/']);

        // make the API call
        $raw = $client->request(
            'GET',
            '?mls='. $this->mlsNumber
        );

        $results = json_decode($raw->getBody());

        return $results;
    }
}
