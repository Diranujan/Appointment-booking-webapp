<?php

require_once '../conf/conf.php';

// Fetch department names from the database
if (isset($_GET['orderBy']) && isset($_GET['orderMethod'])) {
    $orderBy = $_GET['orderBy'];
    $orderMethod = $_GET['orderMethod'];

    //if where & orderby are exist
    if (isset($_GET['whereBy']) && isset($_GET['whereValue'])) {
        $whereBy = $_GET['whereBy'];
        $whereValue = $_GET['whereValue'];

        $sql = "SELECT 
            departments.id AS id,
            departments.name AS name,
            faculties.id AS faculty_id,
            faculties.name AS faculty_name,
            staffs.id AS HOD_id,
            staffs.first_name AS HOD_first_name,
            staffs.last_name AS HOD_last_name
        FROM 
            departments
        INNER JOIN 
            staffs ON departments.HOD = staffs.id
        INNER JOIN 
            faculties ON departments.faculty_id = faculties.id
        WHERE
            departments.`$whereBy`= $whereValue 
        ORDER BY 
            departments.`$orderBy` $orderMethod ;";
            
    } else {
        //if only orderby is exist
        $sql = "SELECT 
            departments.id AS id,
            departments.name AS name,
            faculties.id AS faculty_id,
            faculties.name AS faculty_name,
            staffs.id AS HOD_id,
            staffs.first_name AS HOD_first_name,
            staffs.last_name AS HOD_last_name
        FROM 
            departments
        INNER JOIN 
            staffs ON departments.HOD = staffs.id
        INNER JOIN 
            faculties ON departments.faculty_id = faculties.id
        ORDER BY 
            departments.`$orderBy` $orderMethod ;";
    }
} else {

    $sql = "SELECT 
                departments.id AS id,
                departments.name AS name,
                faculties.id AS faculty_id,
                faculties.name AS faculty_name,
                staffs.id AS HOD_id,
                staffs.first_name AS HOD_first_name,
                staffs.last_name AS HOD_last_name
            FROM 
                departments
            INNER JOIN 
                staffs ON departments.HOD = staffs.id
            INNER JOIN 
                faculties ON departments.faculty_id = faculties.id";
}



$result = $conn->query($sql);

$departments = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = array(
            'id' => $row['id'], 
            'name' => $row['name'], 
            'faculty_id' => $row['faculty_id'], 
            'faculty_name' => $row['faculty_name'], 
            'HOD_id' => $row['HOD_id'], 
            'HOD_name' => $row['HOD_first_name'] . " " . $row['HOD_last_name']
        );
    }
}

// Output faculty names as JSON
header('Content-Type: application/json');
echo json_encode($departments);

$conn->close();
