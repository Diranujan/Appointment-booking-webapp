<?php

require_once '../conf/conf.php';
header('Content-Type: application/json');

// Check if form is submitted and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['facultyName']) && isset($_POST['deanId'])) {
    $facultyName = $_POST['facultyName'];
    $deanId = $_POST['deanId'];

    $sql = "INSERT INTO `faculties`(`name`, `dean`, `created_at`, `updated_at`) 
                    VALUES ('$facultyName','$deanId',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) { 
        echo json_encode(array("status" => "success", "message" => "Faculty created successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error creating faculty: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
