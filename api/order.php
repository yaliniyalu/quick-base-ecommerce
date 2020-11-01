<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/exception-handler.php';

$action = $_GET['action'] ?? null;

if ($action === 'checkout') {
    $fields_map_contact = ['first_name' => 6, 'last_name' => 7, 'address_1' => 9, 'address_2' => 10, 'city' => 11, 'region' => 12, 'email' => 13, 'phone' => 14, 'postal_code' => 29];
    $fields_map_orders = ['payment_type' => 12, 'payment_status' => 13, 'shipping_method' => 14, 'customer' => 16, 'billing_details' => 19, 'shipping_details' => 20, 'payment_account' => 33];
    $fields_map_order_details = ['qty' => 7, 'order' => 12, 'item' => 13];

    $required = ['first_name', 'last_name', 'email', 'phone', 'address_1', 'address_2', 'city', 'region', 'postal_code'];
    foreach ($required as $item) {
        if (empty($_POST['b_' . $item])) {
            echo res_json_error("Billing {$item} is required.");
            exit;
        }

        if (empty($_POST['s_' . $item])) {
            echo res_json_error("Shipping {$item} is required.");
            exit;
        }
    }

    $required = ['delivery_method', 'payment_method'];
    foreach ($required as $item) {
        if (empty($_POST[$item])) {
            echo res_json_error("{$item} is required.");
            exit;
        }
    }

    $billing_contact = [];
    foreach ($fields_map_contact as $key => $id) {
        $billing_contact[$id] = $_POST['b_' . $key];
    }

    $shipping_contact = [];
    foreach ($fields_map_contact as $key => $id) {
        $shipping_contact[$id] = $_POST['s_' . $key];
    }

    $b_id = qb_insert('bqvgeh94y', $billing_contact);
    $s_id = qb_insert('bqvgeh94y', $shipping_contact);

    if (!($b_id && $s_id)) {
        echo res_json_error("Something went wrong. Error saving Contact.");
        exit;
    }

    $raw_order = [
        'payment_account' => 1,
        'payment_type' => $_POST['payment_method'],
        'payment_status' => 'Pending',
        'shipping_method' => $_POST['delivery_method'],
        'customer' => intval($_SESSION['user_id']),
        'billing_details' => $b_id,
        'shipping_details' => $s_id
    ];

    $order = [];
    foreach ($fields_map_orders as $key => $id) {
        $order[$id] = $raw_order[$key];
    }

    $id = qb_insert('bqxjkeb48', $order);
    if (!$id) {
        echo res_json_error("Something went wrong. Saving Order Failed.");
        exit;
    }

    $order_details = [];
    foreach ($_SESSION['cart'] ?? [] as $item) {
        $order_details[] = [
            7 => $item['Qty'],
            12 => $id,
            13 => $item['Record ID#'],
            28 => 'Placed'
        ];
    }

    $id = qb_insert_multi('bqxjmg5c7', $order_details);
    if (count($id) != count($order_details)) {
        echo res_json_error("Something went wrong. Saving Order Failed.");
        exit;
    }

    $_SESSION['cart'] = [];

    echo res_json_success("Order Placed");
    exit;
}