<?php

return [
    [
        'name' => 'Media',
        'flag' => 'admin.media.index',
    ],
    [
        'name'        => 'File',
        'flag'        => 'admin.files.index',
        'parent_flag' => 'admin.media.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'admin.files.create',
        'parent_flag' => 'admin.files.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'admin.files.edit',
        'parent_flag' => 'admin.files.index',
    ],
    [
        'name'        => 'Trash',
        'flag'        => 'admin.files.trash',
        'parent_flag' => 'admin.files.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'admin.files.destroy',
        'parent_flag' => 'admin.files.index',
    ],

    [
        'name'        => 'Folder',
        'flag'        => 'admin.folders.index',
        'parent_flag' => 'admin.media.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'admin.folders.create',
        'parent_flag' => 'admin.folders.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'admin.folders.edit',
        'parent_flag' => 'admin.folders.index',
    ],
    [
        'name'        => 'Trash',
        'flag'        => 'admin.folders.trash',
        'parent_flag' => 'admin.folders.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'admin.folders.destroy',
        'parent_flag' => 'admin.folders.index',
    ],
];