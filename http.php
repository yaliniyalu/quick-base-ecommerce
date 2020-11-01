<?php
include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/env.php';

$http = new \GuzzleHttp\Client([
    "headers" => [
        "QB-Realm-Hostname" => QUICK_BASE_REALM,
        "Authorization" => "QB-USER-TOKEN " . QUICK_BASE_TOKEN
    ],
    'base_uri' => QUICK_BASE_BASE_URL . '/'
]);