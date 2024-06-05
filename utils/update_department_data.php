<?php

require_once '../conf/conf.php';
header('Content-Type: application/json');


// Check if form is submitted and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['departmentId']) && isset($_POST['departmentName']) && isset($_POST['facultyId']) && isset($_POST['HODId'])) {
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departmentId = $_POST['departmentId'];
    $departmentName = $_POST['departmentName'];
    $facultyId = $_POST['facultyId'];
    $HODId = $_POST['HODId'];

    $sql = "UPDATE `departments` 
            SET `name`='$departmentName',`HOD`='$HODId',`faculty_id`='$facultyId',`updated_at`=CURRENT_TIMESTAMP
            WHERE `id` = $departmentId";


    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Department updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating department: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
