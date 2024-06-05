<?php
require_once '../conf/conf.php';

// Fetch data based on the provided ID (assuming 'id' is passed as a GET parameter)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SELECT query to fetch data by ID
    $sql = "SELECT 
                faculties.id AS id,
                faculties.name AS name,
                staffs.id AS dean_ID,
                staffs.first_name AS dean_first_name,
                staffs.last_name AS dean_last_name
            FROM 
                faculties
            INNER JOIN 
                staffs ON faculties.dean = staffs.id
            WHERE faculties.id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $facultyData = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $facultyData = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'dean_ID' => $row['dean_ID'],
                'dean_name' => $row['dean_first_name'] . " " . $row['dean_last_name']
            );
        }

        // Output the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($facultyData);
    } else {
        echo json_encode(array("error" => "No data found for the provided ID"));
    }
} else {
    echo json_encode(array("error" => "No ID provided"));
}

$conn->close();
?>
