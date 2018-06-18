<?php

return [
    // ...

    'unavailable_audits' => 'No Member Audits available',

    'created' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] created this record via :audit_url',
        'modified' => [
            'first_name'   => 'First Name: <strong>:new</strong>',
            'middle_name'   => 'Middle Name: <strong>:new</strong>',
            'last_name'   => 'Last Name: <strong>:new</strong>',
            'email' => 'Email: <strong>:new</strong>',
            'phones' => 'Phones: <strong>:new</strong>',
            'family_name' => 'Family Name: <strong>:new</strong>',
            'gender' => 'Gender: <strong>:new</strong>',
            'age_group' => 'Age Group: <strong>:new</strong>',
            'role_name' => 'Role: <strong>:new</strong>',
            'marital_status' => 'Marital Status: <strong>:new</strong>',
            'occupation' => 'Occupation: <strong>:new</strong>',
            'deceased_at' => 'Deceased Date: <strong>:new</strong>',
        ],
    ],

    'updated' => [
        'metadata' => 'On :audit_created_at, <strong>:user_username</strong> [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'first_name'   => 'First name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'middle_name'   => 'Middle name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'last_name'   => 'Last name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'email' => 'Email address has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'phones' => 'Phone numbers where modified from <strong>:old</strong> to <strong>:new</strong>',
            'family_name' => 'Family name has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'gender' => 'Gender has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'age_group' => 'Age Group has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'role_name' => 'Role has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'marital_status' => 'Marital Status has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'occupation' => 'Occupation has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'deceased_at' => 'Deceased date has been modified from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    // ...
];