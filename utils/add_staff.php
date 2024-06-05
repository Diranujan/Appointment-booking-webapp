<?php

require_once '../conf/conf.php';
header('Content-Type: application/json');

// Check if form is submitted and necessary data is present
if ($_SERVER["REQUEST_METHOD"] == "POST" 
    && isset($_POST['first_name']) && isset($_POST['last_name'])
    && isset($_POST['email']) && isset($_POST['gender'])
    && isset($_POST['phone_number']) && isset($_POST['profession'])) {
        
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $profession_ID = $_POST['profession'];
    $contact_email=NULL; //not required
    $faculty_ID=NULL; //not required
    $department_ID=NULL; //not required

    
    if(isset($_POST['contact_email'])){
        $contact_email = $_POST['contact_email']; 
    }
    if(isset($_POST['faculty'])){
        $faculty_ID = $_POST['faculty'];
    }
    if(isset($_POST['department'])){
        $department_ID = $_POST['department'];
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `staffs`( `first_name`, `last_name`, `email`, `contact_email`, `password`, `gender`, `phone_number`,`faculty_id`, `department_id`, `profession_id`, `created_at`, `updated_at`) 
            VALUES              ('$first_name','$last_name','$email','$contact_email','$hashedPassword','$gender','$phone_number','$faculty_ID','$department_ID','$profession_ID',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Admin Created successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error creating admin: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}

$conn->close();
?>
