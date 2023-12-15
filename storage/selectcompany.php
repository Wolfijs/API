<?php

class CompanyFetcher {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchCompanyNames() {
        $query = "SELECT companyName FROM company";
        $result = $this->conn->query($query);

        if ($result) {
            $companyNames = [];

            while ($row = $result->fetch_assoc()) {
                $companyNames[] = $row['companyName'];
            }

            return $companyNames;
        } else {
            // Handle error, you might want to log or return an error response
            return ['error' => 'Failed to fetch company names'];
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Include your database connection file
include('db.php');

// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Create an instance of the CompanyFetcher class
$companyFetcher = new CompanyFetcher($conn);

// Fetch company names using the class method
$companyNames = $companyFetcher->fetchCompanyNames();

// Output company names as JSON
echo json_encode($companyNames);

// Close the database connection using the class method
$companyFetcher->closeConnection();
?>
