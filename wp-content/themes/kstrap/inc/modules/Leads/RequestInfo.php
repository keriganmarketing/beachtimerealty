<?php

namespace Includes\Modules\Leads;

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

}