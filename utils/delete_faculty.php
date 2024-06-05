<?php
require_once '../conf/conf.php';
header('Content-Type: application/json');

// Check if DELETE method is used and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['id'])) {
    $facultyId = $_GET['id'];

    $sql = "DELETE FROM `faculties` 
            WHERE `id` = $facultyId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Faculty deleted successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting data: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
