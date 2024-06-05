<?php
require_once '../conf/conf.php';

// Fetch data based on the provided ID (assuming 'id' is passed as a GET parameter)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SELECT query to fetch data by ID
    $sql = "SELECT 
                departments.id AS id,
                departments.name AS name,
                staffs.id AS HOD_ID,
                staffs.first_name AS HOD_first_name,
                staffs.last_name AS HOD_last_name,
                faculties.id AS faculty_ID,
                faculties.name AS faculty_name

            FROM 
            departments
            INNER JOIN 
                staffs ON departments.HOD = staffs.id
            INNER JOIN 
                faculties ON departments.faculty_id = faculties.id
            WHERE departments.id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $facultyData = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $facultyData = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'HOD_ID' => $row['HOD_ID'],
                'HOD_name' => $row['HOD_first_name'] . " " . $row['HOD_last_name'],
                'faculty_ID' => $row['faculty_ID'],
                'faculty_name' => $row['faculty_name']
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
