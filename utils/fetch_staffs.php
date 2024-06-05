<?php

require_once '../conf/conf.php';

// Fetch names from the database
$sql1 = "SELECT `first_name`,`id`, `last_name`,profession_id FROM `staffs` WHERE id > 0";
$result1 = $conn->query($sql1);

$staffs = array();
if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
        $profession_id = $row['profession_id'];
        $sql2 = "SELECT `name` FROM professions WHERE id=$profession_id";
        //$sql3 = "SELECT `name` FROM faculties WHERE HOD={$row['id']}"; // Fix the query
        
        $result2 = $conn->query($sql2);
       // $result3 = $conn->query($sql3);
       // if ($result2->num_rows > 0 && $result3->num_rows > 0)
        if ($result2->num_rows > 0) {
            $profession_row = $result2->fetch_assoc();
            $profession_name = $profession_row['name'];
            
          //  $faculty_row = $result3->fetch_assoc();
           // $faculty_name = $faculty_row['name'];

            $staffs[] = array(
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'profession' => $profession_name,
                //'facultyName' => $faculty_name
            );
        }
    }
}

// Output staff information as JSON
header('Content-Type: application/json');
echo json_encode($staffs);

$conn->close();
?>
