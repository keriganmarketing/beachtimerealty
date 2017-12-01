<?php
namespace Includes\Modules\Notifications;

use GuzzleHttp\Client;
use Includes\Modules\Leads\Leads;

class ListingUpdated
{
    public function notify()
    {
        $users = $this->getUsersWithSavedProperties();

        foreach ($users as $user) {
            $changed = $this->userHasUpdatedFavorites($user->user_id);
            if (count($changed) > 0) {
                $this->notifyUserOfChanges($user->user_id, $changed);
            }
        }
    }

    private function userHasUpdatedFavorites($userId)
    {
        $favorites       = $this->flattenListings($this->favoritedListings($userId));
        $updatedListings = $this->flattenListings($this->fetchUpdatedListings());
        $changed         = [];

        foreach ($favorites as $favorite) {
            if (in_array($favorite, $updatedListings)) {
                $changed[] = $favorite;
            }
        }
        return $changed;
    }

    private function getUsersWithSavedProperties()
    {
        global $wpdb;

        $query   = "SELECT DISTINCT user_id from favorite_properties";
        $results = $wpdb->get_results($query);

        return $results;
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

    private function favoritedListings($userId)
    {
        global $wpdb;

        $query   = "SELECT DISTINCT mls_account FROM favorite_properties WHERE user_id = {$userId}";
        $results = $wpdb->get_results($query);

        return $results;
    }

    private function flattenListings($listings)
    {
        $mlsNumberArray = [];

        foreach ($listings as $listing) {
            array_push($mlsNumberArray, $listing->mls_account);
        }

        return $mlsNumberArray;
    }

    private function notifyUserOfChanges($userId, $mlsIds)
    {

        $user = get_userdata($userId);

        $to   = $user->user_nicename . ' <' . $user->user_email . '>';

        $tableData = '';
        foreach($mlsIds as $mlsId){

            $tableData .= '<tr><td>' . $mlsId . '</td></tr>';
        }

        $email = new Leads();

        $email->sendEmail(
            [
                'to'        => 'bryan@kerigan.com',
                'from'      => get_bloginfo() . ' <noreply@' . $email->domain . '>',
                'subject'   => 'Updated Property Alert',
                'cc'        => '',
                'bcc'       => $email->bccEmail,
                'replyto'   => '',
                'headline'  => 'Updated Property Alert',
                'introcopy' => 'One or more properties in your favorites have been updated. Details are below:',
                'leadData'  => $tableData
            ]
        );

    }
}
