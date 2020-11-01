<?php

function auth_session_start() {
    session_name('stationary_shop');
    session_start();
}

function auth_is_logged_in() {
    return ($_SESSION['logged_in'] ?? false) == true;
}

function auth_set_user($user) {
    $_SESSION['logged_in'] = true;
    $_SESSION['user_name'] = $user['Name'];
    $_SESSION['user_id'] = $user['Record ID#'];
    $_SESSION['user_contact'] = $user['Contact'];
}

function res_json_error($message, $data = []) {
    return json_encode(['success' => false, 'message' => $message, 'data' => $data]);
}

function res_json_success($message, $data = []) {
    return json_encode(['success' => true, 'message' => $message, 'data' => $data]);
}