<?php

class OrderHandler
{
    private $conn;

    public function __construct($db)
    {
        // Connect to the database
        $this->conn = $db;
    }

    public function handleRequest()
    {
        // Set header to indicate JSON response
        header('Access-Control-Allow-Origin: http://localhost:3000');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-Type: application/json');

        // Initialize response array
        $response = array();

        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the raw data from the request body
            $jsonData = file_get_contents('php://input');

            // Decode the JSON data
            $data = json_decode($jsonData, true);

            // Check if decoding was successful
            if ($data !== null) {
                // Access the data
                $product = $data['product'];
                $orderCompany = $data['orderCompany'];
                $quantity = $data['quantity']; // Added quantity parameter
                $statuss = "Pending";

                // Insert the data into the orders table
                $sql = "INSERT INTO orders (product, order_company_name, quantity, statuss) 
                        VALUES ('$product', '$orderCompany', '$quantity', '$statuss')";

                if ($this->conn->query($sql) === TRUE) {
                    $response['status'] = 'success';
                    $response['message'] = 'New record created successfully';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Error: ' . $sql . '<br>' . $this->conn->error;
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Invalid JSON data';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid request method';
        }

        // Output the JSON response
        echo json_encode($response);
    }

    public function closeConnection()
    {
        // Close the database connection
        $this->conn->close();
    }
}

// Connect to the database
require_once('db.php');
$orderHandler = new OrderHandler($conn);

// Handle the request
$orderHandler->handleRequest();

// Close the database connection
$orderHandler->closeConnection();
?>
