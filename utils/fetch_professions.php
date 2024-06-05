<?php

require_once '../conf/conf.php';

// Fetch  professions from the database
$sql = "SELECT `id`, `name` FROM `professions` WHERE `id` > 0";
$result = $conn->query($sql);

$professions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $professions[] = array('id' => $row['id'], 'name' => $row['name']);
    }
}

// Output professions as JSON
header('Content-Type: application/json');
echo json_encode($professions);

$conn->close();
?>