<?php

include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/exception-handler.php';

$action = $_GET['action'] ?? null;

if ($action === 'review') {
    $required = ['name', 'item', 'title', 'review', 'rating'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    $_POST['item']   = intval($_POST['item']);
    $_POST['rating'] = intval($_POST['rating']);

    $fields_map = ['name' => 7, 'email' => 8, 'item' => 15, 'title' => 17, 'review' => 10, 'rating' => 9];

    $review = [];
    foreach ($fields_map as $key => $id) {
        if (isset($_POST[$key])) {
            $review[$id] = $_POST[$key];
        }
    }


    $id = qb_insert('bqxjn8zkw', $review);

    if (!$id) {
        echo res_json_error("Something went wrong. Error saving Review.");
        exit;
    }

    echo res_json_success("Review Saved");
    exit;
}
