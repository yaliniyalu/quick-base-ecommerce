<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/exception-handler.php';

$action = $_GET['action'] ?? null;

$fields_map_contact = ['first_name' => 6, 'last_name' => 7, 'address_1' => 9, 'address_2' => 10, 'city' => 11, 'region' => 12, 'email' => 13, 'phone' => 14, 'postal_code' => 29];
$fields_map_customer = ['first_name' => 24, 'last_name' => 25, 'email' => 7, 'phone' => 9, 'password' => 8, 'group' => 10, 'status' => 17, 'contact' => 15, 'newsletter' => 23];

if ($action == 'update-info') {
    $required = ['first_name', 'last_name', 'email', 'phone'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    $customer = [];
    foreach ($required as $value) {
        $customer[$fields_map_customer[$value]] = $_POST[$value];
    }

    $customer[3] = $_SESSION['user_id'];

    $id = qb_insert('bqxjj8g7e', $customer);
    if (!$id) {
        echo res_json_error("Something went wrong");
        exit;
    }

    echo res_json_success("Info Updated");
    exit;
}
elseif ($action == 'newsletter') {
    if (empty($_POST['type'])) {
        echo res_json_error("Type is required");
        exit;
    }

    $customer = [
        3 => $_SESSION['user_id'],
        23 => $_POST['type'] == 'subscribe' ? 1 : 0
    ];

    $id = qb_insert('bqxjj8g7e', $customer);
    if (!$id) {
        echo res_json_error("Something went wrong");
        exit;
    }

    echo res_json_success("Newsletter {$_POST['type']}d");
    exit;
}
elseif ($action == 'update-contact') {
    $required = ['first_name', 'last_name', 'email', 'phone', 'address_1', 'address_2', 'city', 'region', 'postal_code'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    $contact = [];
    foreach ($required as $value) {
        $contact[$fields_map_contact[$value]] = $_POST[$value];
    }

    $contact[3] = $_SESSION['user_contact'];

    $id = qb_insert('bqvgeh94y', $contact);
    if (!$id) {
        echo res_json_error("Something went wrong. Error saving Contact.");
        exit;
    }

    echo res_json_success("Contact Updated");
    exit;
}
elseif ($action == 'update-password') {
    $required = ['old_password', 'password', 'confirm_password'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    if ($_POST['password'] != $_POST['confirm_password']) {
        echo res_json_error("Passwords doesn't match");
        exit;
    }

    $customer = qb_query_parsed('bqxjj8g7e', [3, 8], "{3.EX.'{$_SESSION['user_id']}'}");
    if (empty($customer)) {
        echo res_json_error("User not found");
        exit;
    }

    if (!password_verify($_POST['old_password'], $customer[0]['Password'])) {
        echo res_json_error("Invalid Password");
        exit;
    }

    $customer = [
        3 => $_SESSION['user_id'],
        8 =>  password_hash($_POST['password'], PASSWORD_BCRYPT)
    ];

    $id = qb_insert('bqxjj8g7e', $customer);
    if (!$id) {
        echo res_json_error("Something went wrong. Error saving Contact.");
        exit;
    }

    echo res_json_success("Contact Updated");
    exit;
}