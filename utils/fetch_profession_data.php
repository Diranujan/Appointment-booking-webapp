<?php
require_once '../conf/conf.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SELECT query to fetch data by ID
    $sql = "SELECT `name` FROM `professions` WHERE `id` = $id";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $profession = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $profession = array(
                'name' => $row['name']
            );
        }

        // Output the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($profession);
    } else {
        echo json_encode(array("error" => "No data found for the provided ID"));
    }
} else {
    echo json_encode(array("error" => "No ID provided"));
}

$conn->close();
?>
