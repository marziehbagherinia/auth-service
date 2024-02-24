<?php
return [
    'user' =>[
        'permissions' => [
            'key' => 'user_permissions_user_',
            'ttl' => 600
        ],
        'roles' => [
            'key' => 'user_roles_user_',
            'ttl' => 600
        ],
        'reset_password' => [
            'token' => [
                'key' => 'reset_password_token_',
                'ttl' => 180
            ],
            'done' => [
                'key' => 'reset_password_done_',
                'ttl' => 86400
            ]
        ]
    ],
];
