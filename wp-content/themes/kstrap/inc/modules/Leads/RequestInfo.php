<?php

namespace Includes\Modules\Leads;

use Includes\Modules\Agents\Agents;

class RequestInfo extends Leads
{

    public $additionalFields = [
        'full_name'          => 'Name',
        'email_address'      => 'Email Address',
        'phone_number'       => 'Phone Number',
        'reason_for_contact' => 'Reason for Contact',
        'selected_agent'     => 'Selected Agent',
        'mls_number'         => 'MLS Number',
        'message'            => 'Message'
    ];

    public function handleLead ($dataSubmitted = [])
    {
        $dataSubmitted['full_name'] = (isset($dataSubmitted['full_name']) ? $dataSubmitted['full_name'] :
            (isset($dataSubmitted['first_name']) ? $dataSubmitted['first_name'] . ' ' . $dataSubmitted['last_name'] : '')
        );

        if (function_exists( 'akismet_http_post')){
            $this->isSpam = $this->checkSpam($dataSubmitted);
        }

        if($this->isSpam){
            echo '<div class="alert alert-danger" role="alert">
            <strong>This message has been flagged as spam.</strong>
            </div>';
            return;
        }
        
        //Check for spammy stuff
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

        //Route to correct agent
        $agent = new Agents();
        $agentInfo = $agent->assembleAgentData($dataSubmitted['selected_agent']);
        $this->adminEmail = isset($agentInfo['email_address']) && $agentInfo['email_address'] != '' ? $agentInfo['email_address'] : $this->adminEmail;
        // $this->adminEmail = 'bryan@kerigan.com'; //temp

        if (function_exists( 'akismet_http_post')){
            $this->isSpam = $this->checkSpam($dataSubmitted);
        }

        if(!$this->validateSubmission($dataSubmitted)){ return false; }
        $this->addToDashboard($dataSubmitted);
        $this->sendNotifications($dataSubmitted);

    }


}