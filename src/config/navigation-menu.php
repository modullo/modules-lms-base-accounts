<?php

return [
    'tenant-accounts-management' => [
        'audience' => 'tenant',
        'icon' => 'fa fa-user-cap',
        'dashboard' => 'all',
        'title' => 'User Management',
        'route' => '',
        'link' => 's',
        'clickable' => true,
        'navbar' => true,
        'visibility' => true,
        'order' => 0,
        'sub-menu' => [
            'learners' => [
                'icon' => 'fa fa-user',
                'dashboard' => 'all',
                'title' => 'Learners',
                'route' => '',
                'link' => '/tenant/learners',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
        ],
    ],
];
