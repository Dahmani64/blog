<?php
return [
    'Dashboard' => [
        'role'   => 'redac',
        'route'  => 'admin',
        'icon'   => 'tachometer-alt',
    ],
    'Posts' => [
        'icon' => 'file-alt',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'All posts',
                'role'  => 'redac',
                'route' => 'posts.index',
            ],
            [
                'name'  => 'New posts',
                'role'  => 'admin',
                'route' => 'posts.indexnew',
            ],
            [
                'name'  => 'Add',
                'role'  => 'redac',
                'route' => 'posts.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'posts.edit',
            ],
        ],
    ],
    'Categories' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All categories',
                'role'  => 'admin',
                'route' => 'categories.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'categories.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'categories.edit',
            ],
        ],
    ],
    'Users' => [
        'icon' => 'user',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All users',
                'role'  => 'admin',
                'route' => 'users.index',
            ],
            [
                'name'  => 'New users',
                'role'  => 'admin',
                'route' => 'users.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'users.edit',
            ],
        ],
    ],
    'Comments' => [
        'icon' => 'comment',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'All comments',
                'role'  => 'redac',
                'route' => 'comments.index',
            ],
            [
                'name'  => 'New comments',
                'role'  => 'redac',
                'route' => 'comments.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'comments.edit',
            ],
        ],
    ],
    'Contacts' => [
        'icon' => 'envelope',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All contacts',
                'role'  => 'admin',
                'route' => 'contacts.index',
            ],
            [
                'name'  => 'New contacts',
                'role'  => 'admin',
                'route' => 'contacts.indexnew',
            ],
        ],
    ],
    'Follows' => [
        'icon' => 'share-alt',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All follows',
                'role'  => 'admin',
                'route' => 'follows.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'follows.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'follows.edit',
            ],
        ],
    ],
    'Pages' => [
        'icon' => 'file',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All pages',
                'role'  => 'admin',
                'route' => 'pages.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'pages.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'pages.edit',
            ],
        ],
    ],
    

];