<?php
require_once __DIR__ . "/http.php";
global $http;

//header("Expires: Sat, 26 Jul 2021 05:00:00 GMT");

$response = $http->get(trim($_GET['url'], '/'));
echo base64_decode($response->getBody());