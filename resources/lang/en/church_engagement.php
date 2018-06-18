<?php

return [
    // ...

    'unavailable_audits' => 'No Church Engagement Audits available',

    'created' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] created this record via :audit_url',
        'modified' => [
            'name'   => 'Name: <strong>:new</strong>',
        ],
    ],

    'updated' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'name'   => 'Name has been modified from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    // ...
];