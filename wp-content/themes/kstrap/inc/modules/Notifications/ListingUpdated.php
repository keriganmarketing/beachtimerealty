<?php
namespace Includes\Modules\Notifications;

use GuzzleHttp\Client;

class ListingUpdated
{
    public function notify()
    {
        $updatedListings     = $this->fetchUpdatedListings();
        $favoritedListings   = $this->getAllFavoritedListings();
        $favoritedMlsNumbers = $this->flattenListings($favoritedListings);

        foreach ($updatedListings as $ul) {
            if (in_array($ul->mls_account, $favoritedMlsNumbers)) {
                $this->notifyUsersOfChange($ul->mls_account);
            }
        }
    }
    private function fetchUpdatedListings()
    {
        $client = new Client(['base_uri' => 'https://mothership.kerigan.com/api/v1/']);
        $raw    = $client->request(
            'GET',
            'updatedListings'
        );

        $updatedListings = json_decode($raw->getBody());

        return $updatedListings;
    }

    private function getAllFavoritedListings()
    {
        global $wpdb;

        $query   = "SELECT DISTINCT mls_account FROM favorite_properties";
        $results = $wpdb->get_results($query);

        return $results;
    }

    protected function flattenListings($listings)
    {
        $mlsNumberArray = [];

        foreach ($listings as $listing) {
            array_push($mlsNumberArray, $listing->mls_account);
        }

        return $mlsNumberArray;
    }

    protected function notifyUsersOfChange($mlsNumber)
    {
        global $wpdb;

        $query = "SELECT DISTINCT user_id FROM favorite_properties WHERE mls_account LIKE {$mlsNumber}";

        $results = $wpdb->get_results($query);

        foreach ($results as $result) {
            $to = get_userdata($result->user_id)->user_email;
            $subject = 'A listing you saved from Beachtime Realty has been recently updated';
            $message = 'We\'re notifying you of a change to Listing #'. $mlsNumber .'.';

            mail($to, $subject, $message);
        }
    }
}
