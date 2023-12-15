<?php
// Set header to indicate JSON response
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
// Connect to the database
require_once('db.php');

// Initialize response array
$response = array();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract the data from the POST request
    $regNumber = $_POST['regNumber'];
    $companyName = $_POST['companyName'];
    $sia = $_POST['sia'];
    $rekviziti = $_POST['rekviziti'];
    $juridiskaAdrese = $_POST['juridiskaAdrese'];
    $faktiskaAdrese = $_POST['faktiskaAdrese'];

    // Insert the data into the database
    $sql = "INSERT INTO Company (regNumber, companyName, sia, rekviziti, juridiskaAdrese, faktiskaAdrese) 
    VALUES ('$regNumber', '$companyName', '$sia', '$rekviziti', '$juridiskaAdrese', '$faktiskaAdrese')";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'New record created successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// Close the database connection
$conn->close();

// Output the JSON response
echo json_encode($response);
?>
