<?php

namespace Includes\Modules\Leads;

use Includes\Modules\Agents\Agents;

class HomeValuation extends Leads
{
    public $postType   = 'Home Valuation';
    public $additionalFields = [
        'full_name'     => 'Name',
        'email_address' => 'Email Address',
        'phone_number'       => 'Phone Number',
        'selected_agent'     => 'Selected Agent',
        'property_address'   => 'Property Address',
        'property_type'      => 'Property Type',
        'property_details'   => 'Property Details'
    ];

    public function handleLead ($dataSubmitted = [])
    {
        $dataSubmitted['full_name'] = (isset($dataSubmitted['full_name']) ? $dataSubmitted['full_name'] :
            (isset($dataSubmitted['first_name']) ? $dataSubmitted['first_name'] . ' ' . $dataSubmitted['last_name'] : '')
        );

        $dataSubmitted['property_address'] = parent::toFullAddress(
            $dataSubmitted['listing_address'], $dataSubmitted['listing_address_2'],
            $dataSubmitted['listing_city'], $dataSubmitted['listing_state'], $dataSubmitted['listing_zip']
        );

        $agent = new Agents();
        $agentInfo = $agent->assembleAgentData($dataSubmitted['selected_agent']);

        $this->adminEmail = isset($agentInfo['email_address']) && $agentInfo['email_address'] != '' ? $agentInfo['email_address'] : $this->adminEmail;
        // $this->adminEmail ='bryan@kerigan.com'; //temp

        if (function_exists( 'akismet_http_post')){
            $this->isSpam = $this->checkSpam($dataSubmitted);
        }

        if($this->isSpam){
            echo '<div class="alert alert-danger" role="alert">
            <strong>This message has been flagged as spam.</strong>
            </div>';
            return;
        }

        if($this->validateSubmission($dataSubmitted)){
            echo '<div class="alert alert-success" role="alert">
            <strong>Your request has been received. We will review your submission and get back with you soon.</strong>
            </div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">
            <strong>Errors were found. Please correct the indicated fields below.</strong>
            </div>';
            return;
        }

        $this->addToDashboard($dataSubmitted);
        $this->sendNotifications($dataSubmitted);

    }

    public function checkSpam($data)
    {
        global $akismet_api_host, $akismet_api_port;

        // data package to be delivered to Akismet
        $commentData = [
          'comment_author_email'  => $data['email_address'], //required
          'blog'                  => site_url(),
          'blog_lang'             => 'en_US',
          'blog_charset'          => 'UTF-8',
          'is_test'               => TRUE,
        ];
    
        if(isset($data['ip_address'])){
          $commentData['user_ip'] = $data['ip_address'];
        }
    
        if(isset($data['user_agent'])){
          $commentData['user_agent'] = $data['user_agent'];
        }
    
        if(isset($data['referrer'])){
          $commentData['referrer'] = $data['referrer'];
        }
    
        if(isset($data['full_name'])){
          $commentData['comment_author'] = $data['full_name'];
        }
    
        if(isset($data['property_details'])){
          $commentData['comment_content'] = $data['property_details'];
        }
    
        // construct the query string
        $query_string = http_build_query( $commentData );
        // post it to Akismet
        $response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );
    
        // the result is the second item in the array, boolean
        return $response[1] == 'true' ? true : false;
    }

}