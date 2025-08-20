<?php
// save_bill.php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "canteen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Read JSON input ---
$data = json_decode(file_get_contents("php://input"), true);

$roll_number  = $data['roll_number'] ?? null;
$token_number = $data['token_number'] ?? null;
$bill_items   = $data['items_html'] ?? null;
$total        = $data['total'] ?? null;

// Validate
if (!$roll_number || !$token_number || !$bill_items || !$total) {
    echo "Error: Missing required fields!";
    exit;
}

// Insert into DB
$sql = "INSERT INTO bills (roll_no, token_no, bill_items, total_amount) 
        VALUES ('$roll_number', '$token_number', '$bill_items', '$total')";

if ($conn->query($sql) === TRUE) {
    echo "Bill saved successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
