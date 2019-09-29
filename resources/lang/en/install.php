<?php
return [
    'next'                  => 'Next',
    'refresh'               => 'Refresh',
    'steps' => [
        'requirements'      => 'Please, ask your hosting provider to fix the errors!',
        'language'          => 'Step 1/3 : Language Selection',
        'database'          => 'Step 2/3 : Database Setup',
        'settings'          => 'Step 3/3 : Company and Admin Details',
    ],
    'language' => [
        'select'            => 'Select Language',
    ],
    'requirements' => [
        'php_version'       => 'Your PHP version must be :version',
        'param_size'        => 'The minimum value of the :param parameter in PHP.ini should be :minimum',
        'enabled'           => ':feature needs to be enabled!',
        'disabled'          => ':feature needs to be disabled!',
        'extension'         => ':extension extension needs to be installed and loaded!',
        'directory'         => ':directory directory needs to be writable!',
    ],
    'database' => [
        'hostname'          => 'Hostname',
        'username'          => 'Username',
        'password'          => 'Password',
        'name'              => 'Database',
    ],
    'settings' => [
        'company_name'      => 'Company Name',
        'company_email'     => 'Company Email',
        'admin_email'       => 'Admin Email',
        'admin_password'    => 'Admin Password',
    ],
    'error' => [
        'connection'        => 'Could not connect to the database! Please, make sure the details are correct.',
    ],
];