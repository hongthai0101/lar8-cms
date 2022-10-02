<?php

return [
    'theme' => [
        'layouts' => [
            'master' => 'core/base'
        ],
        'sidebar' => [
            'baseSidebar',
            'blogSidebar',
            'mailSidebar'
        ]
    ],
    'setting' => [
        'admin' => [
            'key' => [
                '__admin_title__' ,
                '__admin_copyright__',
                '__admin_favicon__',
                '__admin_logo__'
            ]
        ],
        'cache_file' => 'app/setting.json'
    ]
];
