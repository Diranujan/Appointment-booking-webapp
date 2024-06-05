<?php

require_once '../conf/conf.php';
header('Content-Type: application/json');


// Check if form is submitted and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['facultyId']) && isset($_POST['facultyName'])) {
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facultyId = $_POST['facultyId'];
    $facultyName = $_POST['facultyName'];
    $deanId = $_POST['deanId'];

    $sql = "UPDATE `faculties` 
            SET `name` = '$facultyName',`dean`=$deanId,`updated_at` = CURRENT_TIMESTAMP 
            WHERE `id` = $facultyId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Faculty updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating faculty: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
