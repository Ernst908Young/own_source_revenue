<?php

// This is the database connection configuration.
return array(
    'connectionString' => 'mysql:host='.DB_SERVER.';dbname='.DB_NAME,
    'emulatePrepare' => true,
    'username' => DB_USER,
    'password' => DB_PASS,
    'charset' => 'utf8',
);
