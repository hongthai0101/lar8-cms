<?php

return [
    'model' => [
        'Messi\Base\Models\User',
        'Messi\Blog\Models\Post',
        'Messi\Blog\Models\Category',
        'Messi\Blog\Models\Tag'
    ],
    'setting' => [
        'header' => storage_path('templates/header.html'),
        'footer' => storage_path('templates/footer.html')
    ]
];
