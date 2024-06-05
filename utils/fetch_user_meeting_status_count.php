<?php

require_once '../conf/conf.php';
require_once './constants.php';

if (isset($_GET['whereBy']) && isset($_GET['whereValue'])) {
    $whereBy = $_GET['whereBy'];
    $whereValue = $_GET['whereValue'];

    if (isset($_GET['date'])) {
        $date = $_GET['date'];

        $sql = "SELECT 
                meetings.status As `status`,
                COUNT(*) AS status_count
            FROM 
                meetings
            JOIN 
                user_meetings ON user_meetings.meeting_id = meetings.id
            WHERE 
                user_meetings.$whereBy = $whereValue AND meetings.pref_date = '$date'
            GROUP BY 
                meetings.status";

    } else {
        
        $sql = "SELECT 
                meetings.status As `status`,
                COUNT(*) AS status_count
            FROM 
                meetings
            JOIN 
                user_meetings ON user_meetings.meeting_id = meetings.id
            WHERE 
                user_meetings.$whereBy = $whereValue
            GROUP BY 
                meetings.status";
    }

    $result = $conn->query($sql);

    // Initialize an array to hold the fetched data
    $meeting_status_count = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $meeting_status_count[] = array(
                'status' => $row['status'],
                'status_count' => $row['status_count']

            );
        }
        header('Content-Type: application/json');
        echo json_encode($meeting_status_count);
    } else {
        echo json_encode(array("error" => "No data found for the provided whereBy & whereValue or date"));
    }
} else {
    echo json_encode(array("error" => "whereBy or whereValue is not provied"));
}




$conn->close();
