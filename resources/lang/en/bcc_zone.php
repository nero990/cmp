<?php

return [
    // ...

    'unavailable_audits' => 'No BCC Zone Audits available',

    'created' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] created this record via :audit_url',
        'modified' => [
            'name'   => 'Name: <strong>:new</strong>',
            'address'   => 'Address: <strong>:new</strong>',
            'streets'   => 'Streets: <strong>:new</strong>',
            'status'   => 'Status: <strong>:new</strong>',
        ],
    ],

    'updated' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'name'   => 'Name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'address'   => 'Address has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'streets'   => 'Streets has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'status'   => 'Status was changed from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    'deleted' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] deleted this record via :audit_url',
        'modified' => [
            'name'   => 'Name: <strong>:old</strong>',
            'address'   => 'Address: <strong>:old</strong>',
            'streets'   => 'Streets: <strong>:old</strong>',
            'status'   => 'Status: <strong>:old</strong>',
        ],
    ],

    // ...
];