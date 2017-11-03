<?php

namespace Includes\Modules\Leads;

use Includes\Modules\Agents\Agents;

class HomeValuation extends Leads
{
    public function __construct ()
    {
        parent::__construct ();
        parent::set('postType','Home Valuation');
        parent::assembleLeadData(
            [
                'phone_number'       => 'Phone Number',
                'selected_agent'     => 'Selected Agent',
                'property_address'   => 'Property Address',
                'property_type'      => 'Property Type',
                'property_details'   => 'Property Details'
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