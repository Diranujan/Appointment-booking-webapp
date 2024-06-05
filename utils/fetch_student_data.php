<?php
require_once '../conf/conf.php';

if (isset($_GET['whereBy']) && isset($_GET['whereValue'])) {
    $whereBy = $_GET['whereBy'];
    $whereValue = $_GET['whereValue'];

    $sql =     "SELECT 
                    id, first_name, last_name, email, date_of_birth,
                    gender, phone_number,reg_num,   
                    year_of_study,faculty_id,department_id,contact_email
                FROM 
                    students
                WHERE 
                    $whereBy = '$whereValue'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $userData = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $userData = array(
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'date_of_birth' => $row['date_of_birth'],
                'phone_number' => $row['phone_number'],
                'reg_num' => $row['reg_num'],
                'year_of_study' => $row['year_of_study'],
                'faculty_id' => $row['faculty_id'],
                'department_id' => $row['department_id'],
                'contact_email' => $row['contact_email'],
            );
        }

        // Output the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($userData);
    } else {
        echo json_encode(array("error" => "No data found for the provided student email"));
    }
} else {
    echo json_encode(array("error" => "whereBy or whereValue is not provied"));
}

$conn->close();
