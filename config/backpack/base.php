<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Look & feel customizations
    |--------------------------------------------------------------------------
    |
    | Make it yours.
    |
    */

    'organization' => env('ORGANIZATION'),

    // Project name. Shown in the breadcrumbs and a few other places.
    'project_name' => 'Supplies Inventory Management System',

    // Menu logos
    'logo_lg'   => '<b>S</b>upplies <b>I</b>nventory',
    'logo_mini' => 'SI',

    // Developer or company name. Shown in footer.
    'developer_name' => 'College Of Computer and Information Sciences - Server',

    // Developer website. Link in footer.
    'developer_link' => '#',

    // Show powered by Laravel Backpack in the footer?
    'show_powered_by' => false,

    // The AdminLTE skin. Affects menu color and primary/secondary colors used throughout the application.
    'skin' => 'skin-black',
    // Options: skin-black, skin-blue, skin-purple, skin-red, skin-yellow, skin-green, skin-blue-light, skin-black-light, skin-purple-light, skin-green-light, skin-red-light, skin-yellow-light

    // Date & Datetime Format Syntax: https://github.com/jenssegers/date#usage
    // (same as Carbon)
    'default_date_format'     => 'j F Y',
    'default_datetime_format' => 'j F Y H:i',

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | Choose whether new users are allowed to register.
    | This will show up the Register button in the menu and allow access to the
    | Register functions in AuthController.
    |
    */

    'registration_open' => (env('APP_ENV') == 'local') ? true : false,

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    // The prefix used in all base routes (the 'admin' in admin/dashboard)
    'route_prefix' => '',

    // Set this to false if you would like to use your own AuthController and PasswordController
    // (you then need to setup your auth routes manually in your routes.php file)
    'setup_auth_routes' => false,

    // Set this to false if you would like to skip adding the dashboard routes
    // (you then need to overwrite the login route on your AuthController)
    'setup_dashboard_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    */

    // Fully qualified namespace of the User model
    'user_model_fqn' => '\App\User',

    'username' => 'Username',

    /*
    |--------------------------------------------------------------------------
    | License Code
    |--------------------------------------------------------------------------
    |
    | If you, your employer or your client make money by using Backpack, you need
    | to purchase a license code. A license code will be provided after purchse,
    | which you can put here on in your ENV file.
    |
    | More info and payment form on:
    | https://www.backpackforlaravel.com
    |
    */

    'license_code' => env('BACKPACK_LICENSE', false),

];
