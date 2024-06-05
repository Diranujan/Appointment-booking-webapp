<?php

require_once '../conf/conf.php';
require_once '../utils/constants.php';

// Fetch  HOD names from the database
$HODProfessionID = ProfessionID::HOD;

if(isset($_GET['orderBy']) && isset($_GET['orderMethod'])){
    $orderBy=$_GET['orderBy'];
    $orderMethod=$_GET['orderMethod'];
    

    $sql = "SELECT `first_name`,`last_name`,`id` 
            FROM `staffs` 
            WHERE `profession_id`= $HODProfessionID
            ORDER BY `staffs`.`$orderBy` $orderMethod ";
}else{

    $sql = "SELECT `first_name`,`last_name`,`id` 
            FROM `staffs` 
            WHERE `profession_id`= $HODProfessionID";

}




$result = $conn->query($sql);

$HODs = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $HODs[] = array('id' => $row['id'], 'first_name' => $row['first_name'],'last_name' => $row['last_name']);
    }
}

// Output HOD names as JSON
header('Content-Type: application/json');
echo json_encode($HODs);

$conn->close();
?>