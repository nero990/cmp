<?php

return [
    // ...

    'unavailable_audits' => 'No Family Audits available',

    'created' => [
        'metadata' => "On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] created this record via :audit_url",
        'modified' => [
            'name'   => 'Name: <strong>:new</strong>',
            'registration_number' => 'Registration Number: <strong>:new</strong>',
            'names_of_children' => 'Names of Children: <strong>:new</strong>',
            'type' => 'Type: <strong>:new</strong>',
            'state' => 'State: <strong>:new</strong>',
            'address' => 'Address: <strong>:new</strong>',
            'card_status' => 'Card Status: <strong>:new</strong>',
            'bcc_zone' => 'BCC Zone <strong>:new</strong>',
        ],
    ],

    'updated' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'name'   => 'Family name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'registration_number' => 'Registration number has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'names_of_children' => 'Names of Children where modified from <strong>:old</strong> to <strong>:new</strong>',
            'type' => 'Family Type has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'state' => 'State has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'address' => 'Address has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'card_status' => 'Card Status has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'bcc_zone' => 'The BCC ZONE has been modified from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    // ...
];