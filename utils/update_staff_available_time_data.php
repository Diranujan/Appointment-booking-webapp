<?php

require_once '../conf/conf.php';
header('Content-Type: application/json');


// Check if form is submitted and necessary data is present
if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['time_0830']) && isset($_POST['time_0930'])
    && isset($_POST['time_1030']) && isset($_POST['time_1130'])
    && isset($_POST['time_1230']) && isset($_POST['time_1330'])
    && isset($_POST['time_1430']) && isset($_POST['time_1530'])
    && isset($_POST['staff_id'])  && isset($_POST['available_date'])
) {
    
    $staff_id = $_POST['staff_id'];
    $available_date = $_POST['available_date'];
    // $tommorowPresence = $_POST['tommorowPresence'];
    $time_0830 = $_POST['time_0830'];
    $time_0930 = $_POST['time_0930'];
    $time_1030 = $_POST['time_1030'];
    $time_1130 = $_POST['time_1130'];
    $time_1230 = $_POST['time_1230'];
    $time_1330 = $_POST['time_1330'];
    $time_1430 = $_POST['time_1430'];
    $time_1530 = $_POST['time_1530'];


    $sql = "UPDATE 
            `staff_available_time` 
        SET 
            `time_0830`='$time_0830',
            `time_0930`='$time_0930',
            `time_1030`='$time_1030',
            `time_1130`='$time_1130',
            `time_1230`='$time_1230',
            `time_1330`='$time_1330',
            `time_1430`='$time_1430',
            `time_1530`='$time_1530'
        WHERE `staff_id` = $staff_id AND `available_date` = '$available_date'";


    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "staff_available_time updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating staff_available_time: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
