<?php

namespace Includes\Modules\Leads;

use Includes\Modules\Agents\Agents;

class RequestInfo extends Leads
{
    public function __construct ()
    {
        parent::__construct ();
        parent::assembleLeadData(
            [
                'phone_number'       => 'Phone Number',
                'reason_for_contact' => 'Reason for Contact',
                'selected_agent'     => 'Selected Agent',
                'mls_number'         => 'MLS Number',
                'message'            => 'Message'
            ]
        );
    }

    public function handleLead ($dataSubmitted = [])
    {
        $fullName                   = (isset($dataSubmitted['full_name']) ? $dataSubmitted['full_name'] : null);
        $dataSubmitted['full_name'] = (isset($dataSubmitted['first_name']) && isset($dataSubmitted['last_name']) ? $dataSubmitted['first_name'] . ' ' . $dataSubmitted['last_name'] : $fullName);

        $agent = new Agents();
        $agentInfo = $agent->assembleAgentData($dataSubmitted['selected_agent']);
        parent::set($this->adminEmail, ($agentInfo['email'] != '' ? $agentInfo['email'] : $this->adminEmail));

    }


}