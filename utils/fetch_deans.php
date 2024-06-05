<?php

require_once '../conf/conf.php';
require_once '../utils/constants.php';

// Fetch  Dean names from the database
$DeanProfessionID = ProfessionID::Dean;
if(isset($_GET['orderBy']) && isset($_GET['orderMethod'])){
    $orderBy=$_GET['orderBy']; 
    $orderMethod=$_GET['orderMethod']; 
    

    $sql = "SELECT `first_name`,`last_name`,`id` 
            FROM `staffs` 
            WHERE `profession_id`= $DeanProfessionID 
            ORDER BY `staffs` .`$orderBy` $orderMethod ;";
}else{

    $sql = "SELECT `first_name`,`last_name`,`id` 
            FROM `staffs` 
            WHERE `profession_id`= $DeanProfessionID";
}

$result = $conn->query($sql);

$deans = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $deans[] = array(
            'id' => $row['id'], 
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name']
        );
    }
}

// Output Deans names as JSON
header('Content-Type: application/json');
echo json_encode($deans);

$conn->close();
?>

