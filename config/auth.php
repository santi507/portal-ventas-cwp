<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuración de LDAP
    |--------------------------------------------------------------------------
    |
    | Estas son las opciones necesarias para el correcto funcionamiento de
    | autenticación con LDAP.
    |
    */
    'ldap' => [
        'domains' => [
            'CWP',
            'PANAMA', //GLOBAL - Call Center
        ],
        'connection' => [
            'CWP' => [
                'path' => 'LDAP://cwpanama.com',
                'dc' => 'OU=CWP Users,DC=cwpanama,DC=com'
            ],
            'PANAMA' => [
                'path' => 'LDAP://panama.global.local',
                'dc' => 'OU=Panama_Child,DC=panama,DC=global,DC=local'
            ]
        ],
        'static_users' => [
            'god' => [
                'username' => 'god',
                'password' => env('GOD_PASSWORD', '$2y$10$oOxNwr33YAHUauMBlFMggOQXu/mG3sMtkAX0N82ltNaLKALSgXkBO'),
                'groups' => [
                    'DL Desarrollo Aplicaciones Web',
                    '',
                ],
                'name'     => 'God',
                'photo'    => '',
                'position' => 'Super administrador'
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the authentication driver that will be utilized.
    | This driver manages the retrieval and authentication of the users
    | attempting to get access to protected areas of your application.
    |
    | Supported: "database", "eloquent"
    |
    */

    'driver' => 'eloquent',

    /*
    |--------------------------------------------------------------------------
    | Authentication Model
    |--------------------------------------------------------------------------
    |
    | When using the "Eloquent" authentication driver, we need to know which
    | Eloquent model should be used to retrieve your users. Of course, it
    | is often just the "User" model but you may use whatever you like.
    |
    */

    'model' => App\User::class,

    /*
    |--------------------------------------------------------------------------
    | Authentication Table
    |--------------------------------------------------------------------------
    |
    | When using the "Database" authentication driver, we need to know which
    | table should be used to retrieve your users. We have chosen a basic
    | default value but you may easily change it to any table you like.
    |
    */

    'table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | Here you may set the options for resetting passwords including the view
    | that is your password reset e-mail. You can also set the name of the
    | table that maintains all of the reset tokens for your application.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'password' => [
        'email'  => 'emails.password',
        'table'  => 'password_resets',
        'expire' => 60,
    ],

];
