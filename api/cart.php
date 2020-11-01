<?php

include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/exception-handler.php';

$action = $_GET['action'] ?? null;

if (empty($_REQUEST['id']) && !in_array($action, ['cart:load', 'wishlist:load', 'wishlist:load:ids'])) {
    echo res_json_error("Item Id is Required");
    exit;
}

$id = $_REQUEST['id'] ?? null;

if ($action == 'cart:add') {
    $qty = 1;
    if (isset($_POST['qty'])) {
        $qty = $_POST['qty'];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['Qty'] += $qty;
    }
    else {
        $item = qb_query_parsed('bqxi9mn25', [3, 6, 9, 13, 14, 40, 60], "{3.EX.{$id}}");
        if (empty($item)) {
            echo res_json_error('Item Invalid');
            exit;
        }

        $_SESSION['cart'][$id] = $item[0];
        $_SESSION['cart'][$id]['Qty'] = $qty;
    }

    echo res_json_success('Item Added', $_SESSION['cart']);
    exit;
}
elseif ($action == 'cart:remove') {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    echo res_json_success('Item Removed', $_SESSION['cart']);
    exit;
}
elseif ($action == 'cart:change:qty') {
    if (!isset($_POST['qty'])) {
        echo res_json_error('Qty Required');
        exit;
    }

    $qty = $_POST['qty'];

    if (isset($_SESSION['cart'][$id])) {
        if (!$qty) {
            unset($_SESSION['cart'][$id]);
        }
        else {
            $_SESSION['cart'][$id]['Qty'] = $qty;
        }
    }

    echo res_json_success('Qty Changed', $_SESSION['cart']);
    exit;
}
elseif ($action == 'cart:load') {
    echo res_json_success('Cart', $_SESSION['cart'] ?? []);
    exit;
}
elseif ($action == 'wishlist:toggle') {
    if (isset($_SESSION['wishlist'][$id])) {
        unset($_SESSION['wishlist'][$id]);
        $done = 'removed';
    }
    else {
        $item = qb_query_parsed('bqxi9mn25', [3, 6, 9, 13, 14, 40, 60], "{3.EX.{$id}}");
        if (empty($item)) {
            echo res_json_error('Item Invalid');
            exit;
        }

        $_SESSION['wishlist'][$id] = $item[0];
        $done = 'added';
    }

    echo res_json_success('Item Added', ['action' => $done, 'id' => $id]);
    exit;
}
elseif ($action =='wishlist:remove') {
    if (isset($_SESSION['wishlist'][$id])) {
        unset($_SESSION['wishlist'][$id]);
    }

    echo res_json_success('Item Removed');
    exit;
}
elseif ($action =='wishlist:move') {
    if (!isset($_SESSION['wishlist'][$id])) {
        echo res_json_error('Item Not Found');
        exit;
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['Qty'] ++;
    }
    else {
        $_SESSION['cart'][$id] = $_SESSION['wishlist'][$id];
        $_SESSION['cart'][$id]['Qty'] = 1;
    }

    unset($_SESSION['wishlist'][$id]);

    echo res_json_success('Item Moved', ['cart' => $_SESSION['cart'], 'wishlist' => $id]);
    exit;
}
elseif ($action =='wishlist:load:ids') {
    echo res_json_success('Item Ids', array_keys($_SESSION['wishlist'] ?? []));
    exit;
}
elseif ($action =='wishlist:load') {
    echo res_json_success('Wishlist', $_SESSION['wishlist'] ?? []);
    exit;
}