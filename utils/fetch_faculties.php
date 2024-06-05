<?php

require_once '../conf/conf.php';

// Fetch faculty names from the database

if(isset($_GET['orderBy']) && isset($_GET['orderMethod'])){
    $orderBy=$_GET['orderBy'];
    $orderMethod=$_GET['orderMethod'];
    

    $sql = "SELECT 
            faculties.id AS id,
            faculties.name AS name,
            staffs.first_name AS dean_first_name,
            staffs.last_name AS dean_last_name
        FROM 
            faculties
        INNER JOIN 
            staffs ON faculties.dean = staffs.id
        ORDER BY 
            faculties.`$orderBy` $orderMethod ;";
}else{

    $sql = "SELECT 
            faculties.id AS id,
            faculties.name AS name,
            staffs.first_name AS dean_first_name,
            staffs.last_name AS dean_last_name
        FROM 
            faculties
        INNER JOIN 
            staffs ON faculties.dean = staffs.id";

}



$result = $conn->query($sql);

$faculties = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faculties[] = array('id' => $row['id'], 'name' => $row['name'], 'dean' => $row['dean_first_name'] . " " . $row['dean_last_name']);
    }
}

// Output faculty names as JSON
header('Content-Type: application/json');
echo json_encode($faculties);

$conn->close();
