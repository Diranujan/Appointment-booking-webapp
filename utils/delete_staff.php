<?php
require_once '../conf/conf.php';
header('Content-Type: application/json');

// Check if DELETE method is used and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['id'])) {
    $staffId = $_GET['id'];

    $sql = "DELETE FROM `staffs` 
            WHERE `id` = $staffId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Staff deleted successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting staff: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
