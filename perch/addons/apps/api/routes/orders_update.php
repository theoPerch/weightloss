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

$data = json_decode(file_get_contents('php://input'), true);
$order = new PerchShop_Order();
$current = $order->find_by_id($id);

if (!$current || $current['memberID'] != $payload['user_id']) {
    http_response_code(403);
    echo json_encode(["error" => "Access denied"]);
    exit;
}

if ($order->update($id, $data)) {
    echo json_encode(["success" => true]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Update failed"]);
}
