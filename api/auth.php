<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/exception-handler.php';

$action = $_GET['action'] ?? null;

if ($action === 'register') {
    $fields_map_contact = ['first_name' => 6, 'last_name' => 7, 'address_1' => 9, 'address_2' => 10, 'city' => 11, 'region' => 12, 'email' => 13, 'phone' => 14, 'post-code' => 29];
    $fields_map_customer = ['first_name' => 24, 'last_name' => 25, 'email' => 7, 'phone' => 9, 'password' => 8, 'group' => 10, 'status' => 17, 'contact' => 15, 'newsletter' => 23];

    $required = ['first_name', 'last_name', 'email', 'phone', 'address_1', 'address_2', 'city', 'region', 'post-code', 'country', 'password', 'confirm_password'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    if (!isset($_POST['agree-privacy'])) {
        echo res_json_error("You must agree to our privacy policy before continue.");
        exit;
    }

    if ($_POST['password'] != $_POST['confirm_password']) {
        echo res_json_error("Passwords doesn't match");
        exit;
    }

    $_POST['status'] = 'Active';
    $_POST['group'] = 'Basic';

    $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (isset($_POST['newsletter'])) {
        $_POST['newsletter'] = 1;
    }

    $contact = [];
    foreach ($fields_map_contact as $key => $id) {
        $contact[$id] = $_POST[$key];
    }

    $_POST['contact'] = qb_insert('bqvgeh94y', $contact);

    if (!$_POST['contact']) {
        echo res_json_error("Something went wrong. Error saving Contact.");
        exit;
    }

    $customer = [];
    foreach ($fields_map_customer as $key => $id) {
        $customer[$id] = $_POST[$key];
    }

    $id = qb_insert('bqxjj8g7e', $customer);
    if (!$id) {
        echo res_json_error("Something went wrong");
        exit;
    }

    echo res_json_success("Registered");
    exit;
} elseif ($action == 'login') {
    $required = ['email', 'password'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    $customer = qb_query_parsed('bqxjj8g7e', [3, 6, 7, 8, 15], "{7.EX.'{$_POST['email']}'}");
    if (empty($customer)) {
        echo res_json_error('Email Id Not found');
        exit;
    }

    $customer = $customer[0];

    if (!password_verify($_POST['password'], $customer['Password'])) {
        echo res_json_error('Invalid Password');
        exit;
    }

    auth_set_user($customer);

    echo res_json_success("Access Granted");
    exit;
}