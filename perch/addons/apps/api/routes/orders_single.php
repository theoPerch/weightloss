<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../PerchShop_Order.class.php';

$token = get_bearer_token();
$payload = verify_token($token);

if (!$payload) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(["error" => "Missing order ID"]);
    exit;
}

$order = new PerchShop_Order();
$data = $order->find_by_id($id);

if ($data && $data['memberID'] == $payload['user_id']) {
    echo json_encode($data);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Order not found or access denied"]);
}
