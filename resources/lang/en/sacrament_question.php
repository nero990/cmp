<?php

return [
    // ...

    'unavailable_audits' => 'No Sacrament Question Audits available',

    'created' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] created this record via :audit_url',
        'modified' => [
            'question'   => 'Question: <strong>:new</strong>',
            'status'   => 'Status: <strong>:new</strong>',
        ],
    ],

    'updated' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'question'   => 'Question has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'status'   => 'Status was changed from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    // ...
];