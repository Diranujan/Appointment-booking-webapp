<?php
require_once '../conf/conf.php';

if (isset($_GET['staff_id']) && isset($_GET['available_date'])) {
    $staff_id = $_GET['staff_id'];
    $available_date = $_GET['available_date'];

    $sql = "SELECT 
               `time_0830`, `time_0930`, `time_1030`, `time_1130`, `time_1230`, `time_1330`, `time_1430`, `time_1530` 
            FROM 
                `staff_available_time` 
            WHERE staff_id = $staff_id AND available_date = '$available_date'";

    $result = $conn->query($sql);
    $staff_available_time_data = array();

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $staff_available_time_data = array(
                'time_0830' => $row['time_0830'],
                'time_0930' => $row['time_0930'],
                'time_1030' => $row['time_1030'],
                'time_1130' => $row['time_1130'],
                'time_1230' => $row['time_1230'],
                'time_1330' => $row['time_1330'],
                'time_1430' => $row['time_1430'],
                'time_1530' => $row['time_1530'],
                
            );
        }

    } 
    echo json_encode($staff_available_time_data);
} else {
    echo json_encode(array("error" => "staff_id or available_date is not provided"));
}

// Output the fetched data as JSON
header('Content-Type: application/json');
$conn->close();
?>
