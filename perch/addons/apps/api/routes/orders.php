<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../PerchShop_Orders.class.php';

$token = get_bearer_token();
$payload = verify_token($token);

if (!$payload) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$orders = new PerchShop_Orders();
$results = $orders->find_by_member_id($payload['user_id']);

echo json_encode($results);
