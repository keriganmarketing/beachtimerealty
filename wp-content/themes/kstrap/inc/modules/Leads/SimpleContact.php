<?php

namespace Includes\Modules\Leads;

class SimpleContact extends Leads
{

    public $additionalFields = [
        'full_name'     => 'Name',
        'email_address' => 'Email Address',
        'message' => 'Message'
    ];

}