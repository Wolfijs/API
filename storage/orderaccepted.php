<?php
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow the following methods
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Allow the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Set content type to JSON
header("Content-Type: application/json");

include 'db.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"));

    // Check if the 'orderIds' property exists in the JSON data
    if (isset($data->orderIds) && is_array($data->orderIds)) {
        // Convert the array of order IDs to a comma-separated string
        $orderIdsString = implode(',', $data->orderIds);

        // Update the order status for the selected orders
        $updateQuery = "UPDATE orders SET statuss = 'Accepted' WHERE id IN ($orderIdsString)";

        if ($conn->query($updateQuery) === TRUE) {
            $response = array('success' => true, 'message' => 'Order status updated successfully');
        } else {
            $response = array('success' => false, 'message' => 'Error updating order status: ' . $conn->error);
        }
    } else {
        $response = array('success' => false, 'message' => 'Invalid request data');
    }
} else {
    $response = array('success' => false, 'message' => 'Invalid request method');
}

// Output the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>
