<?php

require_once '../conf/conf.php';
require_once './constants.php';
header('Content-Type: application/json');

// Check if form is submitted and necessary data is present
if (
    $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['time_0830'])
    && isset($_POST['time_0930']) && isset($_POST['time_1030'])
    && isset($_POST['time_1130']) && isset($_POST['time_1230'])
    && isset($_POST['time_1330']) && isset($_POST['time_1430'])
    && isset($_POST['time_1530']) && isset($_POST['staff_id'])
    && isset($_POST['date'])
) {


    $staff_id = $_POST['staff_id'];
    $date = $_POST['date'];
    

    // // Assuming $_POST['today_tomorrow'] contains the value "TODAY" or "TOMORROW"
    // if ($_POST['today_tomorrow'] == "Today") {
    //     // Your code for Today scenario
    //     $date = date('Y-m-d');
    // } else if ($_POST['today_tomorrow'] == "Tomorrow") {
    //     // Your code for Tomorrow scenario
    //     $date = date('Y-m-d', strtotime('+1 day'));
    // }

    // if ($_POST['today_tomorrow'] == TodayTomorrow::Today) {
    //     $date = date('Y-m-d');
    // } else if ($_POST['today_tomorrow'] == TodayTomorrow::Tomorrow) {
    //     $date = date('Y-m-d', strtotime('+1 day'));
    // }

    //if no records insert this record
    $time_0830 = $_POST['time_0830'];
    $time_0930 = $_POST['time_0930'];
    $time_1030 = $_POST['time_1030'];
    $time_1130 = $_POST['time_1130'];
    $time_1230 = $_POST['time_1230'];
    $time_1330 = $_POST['time_1330'];
    $time_1430 = $_POST['time_1430'];
    $time_1530 = $_POST['time_1530'];

    $fetchQuery = "SELECT * FROM `staff_available_time` WHERE staff_id = '$staff_id' AND available_date = '$date'";
    $result = mysqli_query($conn, $fetchQuery);

    if ($result) {
        // Check the number of rows returned
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            //if data in the DB


            $updateQuery = "UPDATE 
                                `staff_available_time`
                            SET
                                `time_0830` = '$time_0830',
                                `time_0930` = '$time_0930',
                                `time_1030` = '$time_1030',
                                `time_1130` = '$time_1130',
                                `time_1230` = '$time_1230',
                                `time_1330` = '$time_1330',
                                `time_1430` = '$time_1430',
                                `time_1530` = '$time_1530'
                            WHERE
                                `staff_id` = '$staff_id' AND `available_date` = '$date'";

            if ($conn->query($updateQuery) === TRUE) {
                echo json_encode(array("status" => "success", "message" => "staff_available_time updated successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error updating staff_available_time: " . $conn->error));
            }
        } else {
            //No entry

            $sql = "INSERT INTO `staff_available_time`  (`staff_id`, `available_date`, `time_0830`, `time_0930`, `time_1030`, `time_1130`, `time_1230`, `time_1330`, `time_1430`, `time_1530`) 
                    VALUES                              ('$staff_id','$date','$time_0830','$time_0930','$time_1030','$time_1130','$time_1230','$time_1330','$time_1430','$time_1530')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("status" => "success", "message" => "staff_available_time inserted successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error inserting staff_available_time: " . $conn->error));
            }
        }
    } else {
        // Query execution failed
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}
$conn->close();
