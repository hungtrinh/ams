<?php

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/data/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/data/db/seeds',
    ],//paths
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'ams',
            'user' => 'ams',
            'pass' => 'ams',
            'port' => '3306',
            'charset' => 'utf8',
        ],//development
        'testing' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'ams_test',
            'user' => 'ams_test',
            'pass' => 'ams_test',
            'port' => '3306',
            'charset' => 'utf8',
        ],//testing
    ],//environments
];
