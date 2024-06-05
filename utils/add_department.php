<?php

require_once '../conf/conf.php';
header('Content-Type: application/json');

// Check if form is submitted and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['departmentName']) && isset($_POST['facultyId']) && isset($_POST['HODId'])) {
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departmentName = $_POST['departmentName'];
    $HODId = $_POST['HODId'];
    $facultyId = $_POST['facultyId'];

    $sql = "INSERT INTO `departments`(`name`, `HOD`, `faculty_id`, `created_at`, `updated_at`) 
                        VALUES ('$departmentName','$HODId','$facultyId',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Department created successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error creating department: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
