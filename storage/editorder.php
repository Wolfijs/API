<?php

class OrderUpdater {
    private $conn;

    public function __construct() {
        // Set header to indicate JSON response
        header('Access-Control-Allow-Origin: http://localhost:3000');
        header('Access-Control-Allow-Methods: POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-Type: application/json');

        // Connect to the database
        require_once('db.php');
        $this->conn = $conn;
    }

    public function updateStatus() {
        // Initialize response array
        $response = array();

        // Check if the request is a PUT request
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // Extract the data from the PUT request
            $data = json_decode(file_get_contents("php://input"), true);
            $orderId = $data['orderId'];
            $newStatus = $data['newStatus'];

            // Update the status in the database
            $sql = "UPDATE Orders SET statuss = '$newStatus' WHERE id = $orderId";

            if ($this->conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'Status updated successfully';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error updating status: ' . $this->conn->error;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid request method';
        }

        // Close the database connection
        $this->conn->close();

        // Output the JSON response
        echo json_encode($response);
    }
}

// Create an instance of the OrderUpdater class and call the updateStatus method
$orderUpdater = new OrderUpdater();
$orderUpdater->updateStatus();
?>
