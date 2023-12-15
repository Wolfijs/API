<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once 'db.php';

class DeleteOrderHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function handleDelete()
    {
        // Retrieve order ID from the request parameters
        $orderId = $_GET['id'] ?? null;

        if (!$orderId) {
            http_response_code(400);
            echo json_encode(["error" => "Order ID is missing"]);
            return;
        }

        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $orderId);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Order deleted successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error deleting order: " . $stmt->error]);
        }

        $stmt->close();
    }
}

$deleteOrderHandler = new DeleteOrderHandler($conn);
$deleteOrderHandler->handleDelete();

?>
