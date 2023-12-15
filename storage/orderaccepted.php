<?php

class OrderUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleRequest() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Content-Type: application/json");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->processPostRequest();
        } else {
            $this->sendResponse(false, 'Invalid request method');
        }

        $this->conn->close();
    }

    private function processPostRequest() {
        $data = json_decode(file_get_contents("php://input"));

        if ($this->isValidRequestData($data)) {
            $orderIdsString = implode(',', $data->orderIds);
            $updateQuery = "UPDATE orders SET statuss = 'Accepted' WHERE id IN ($orderIdsString)";

            if ($this->conn->query($updateQuery) === TRUE) {
                $this->sendResponse(true, 'Order status updated successfully');
            } else {
                $this->sendResponse(false, 'Error updating order status: ' . $this->conn->error);
            }
        } else {
            $this->sendResponse(false, 'Invalid request data');
        }
    }

    private function isValidRequestData($data) {
        return isset($data->orderIds) && is_array($data->orderIds);
    }

    private function sendResponse($success, $message) {
        $response = array('success' => $success, 'message' => $message);
        echo json_encode($response);
    }
}

// Usage
include 'db.php';
$orderUpdater = new OrderUpdater($conn);
$orderUpdater->handleRequest();
?>
