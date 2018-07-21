<?php

return [
    '1' => [
        'key' => 'fam_reg_num_prf',
        'description' => 'Family Registration Number Prefix',
        'default_val' => 'A',
        'validation' => 'required|string',
    ],
    '2' => [
        'key' => 'gen_reg_no_for_bul_upl',
        'description' => 'Generate Random Registration Number for Family During Bulk Upload',
        'default_val' => '0',
        'validation' => 'required|string',
        'options' => [
            '1' => 'Yes',
            '0' => 'No'
        ]
    ],
];