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

$data = json_decode(file_get_contents('php://input'), true);
$data['memberID'] = $payload['user_id'];

$order = new PerchShop_Orders();
$new_id = $order->create($data);

if ($new_id) {
    echo json_encode(["order_id" => $new_id]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Order creation failed"]);
}
