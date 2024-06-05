<?php
require_once '../conf/conf.php';

if (isset($_GET['whereBy']) && isset($_GET['whereValue'])) {
    $whereBy = $_GET['whereBy'];
    $whereValue = $_GET['whereValue'];

    $sql =     "SELECT 
                    id, first_name, last_name, email, contact_email,
                    gender, phone_number,   
                    faculty_id,department_id,profession_id
                FROM 
                    staffs
                WHERE 
                    $whereBy = '$whereValue'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $staffData = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $staffData = array(
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'contact_email' => $row['contact_email'],
                'gender' => $row['gender'],
                'phone_number' => $row['phone_number'],
                'faculty_id' => $row['faculty_id'],
                'department_id' => $row['department_id'],
                'profession_id' => $row['profession_id'],
            );
        }

        // Output the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($staffData);
    } else {
        echo json_encode(array("error" => "No data found for the provided staff email"));
    }
} else {
    echo json_encode(array("error" => "whereBy or whereValue is not provied"));
}

$conn->close();
