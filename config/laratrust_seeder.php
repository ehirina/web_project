<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'projects' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'reports' => 'c,r,u,d',
            'assignments' => 'c,r,u,d',
        ],
        'user' => [
            'users' => 'r',
            'projects' => 'r',
            'clients' => 'r',
            'reports' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
