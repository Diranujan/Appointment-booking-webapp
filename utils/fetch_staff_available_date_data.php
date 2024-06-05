<?php
require_once '../conf/conf.php';

if (isset($_GET['staff_id'])) {
    $staff_id = $_GET['staff_id'];

    $sql = "SELECT 
               `available_date` 
            FROM 
                `staff_available_time` 
            WHERE 
                staff_id = $staff_id ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $staff_available_date = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            // Use array_push to add elements to the array
            $staff_available_date[] = array(
                'available_date' => $row['available_date'],             
            );
        }

        // Output the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($staff_available_date);
    } else {
        echo json_encode(array("error" => "No data found for the provided staff_id"));
    }
} else {
    echo json_encode(array("error" => "staff_id is not provided"));
}

$conn->close();
?>
