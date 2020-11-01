<?php
set_exception_handler(function ($e) {
    echo json_encode(['success' => false, 'message' => "Internal Server Error. " . $e->getMessage(), 'data' => []]);
    exit;
});