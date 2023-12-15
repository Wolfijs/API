<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once('db.php');

class OrderHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPendingOrders() {
        // Modify the SQL query to select only records where status is "Pending" and not "Delivered"
        $sql = "SELECT * FROM orders WHERE `statuss` <> 'Delivered'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch data and store in an array
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // Return data as JSON
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(array('message' => 'No results'));
        }
    }

    public function closeConnection() {
        // Close connection
        $this->conn->close();
    }
}

// Create an instance of OrderHandler and use it to get pending orders
$orderHandler = new OrderHandler($conn);
$orderHandler->getPendingOrders();
$orderHandler->closeConnection();
?>
