<?php

$baseDir = dirname(__DIR__);

return [
    'db' => [
        'host' => 'localhost',
        'name' => 'contact_form',
        'user' => 'root',
        'password' => ''
    ],
    'template' => [
        'templatesDir' => "{$baseDir}/views",
        'layoutDir' => "{$baseDir}/views/layout"
    ]
];
