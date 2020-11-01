<?php

include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/exception-handler.php';

$action = $_GET['action'] ?? null;

if ($action == 'contact') {
    $fields_map = ['name' => 6, 'email' => 7, 'subject' => 13, 'message' => 9];

    $required = ['name', 'email', 'subject', 'message'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    $message = [];
    foreach ($fields_map as $key => $id) {
        $message[$id] = $_POST[$key];
    }

    $id = qb_insert('bqxjpiimt', $message);

    if (!$id) {
        echo res_json_error("Something went wrong. Error saving Message.");
        exit;
    }

    echo res_json_success("Message Sent");
    exit;
}