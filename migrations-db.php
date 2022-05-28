<?php

return [
    'dbname' => $_ENV["DATABASE_NAME"],
    'user' => $_ENV["DATABASE_USER"],
    'password' => $_ENV["DATABASE_PASSWORD"],
    'host' => $_ENV["DATABASE_HOST"],
    'driver' => 'pdo_mysql',
];
