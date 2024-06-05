<?php
require_once '../conf/conf.php';
require_once './constants.php';

// Check if form is submitted and necessary data is present
if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['id']) && isset($_POST['status'])
) {

    $meeting_id = $_POST["id"];
    $meeting_status = $_POST["status"];
    $reject_reason = $_POST["status"] === MeetingStatus::Rejected  ? $_POST["reject_reason"] : NULL;

    $sql = "UPDATE  
                `meetings` 
            SET 
                `status` = '$meeting_status',
                `reject_reason`='$reject_reason',
                `updated_at` = CURRENT_TIMESTAMP 
            WHERE 
                `id` = $meeting_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Meeting status updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating meeting status: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}
header('Content-Type: application/json');


$conn->close();
