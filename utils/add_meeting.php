<?php
require_once '../conf/conf.php';
require_once './constants.php';
header('Content-Type: application/json');

// Check if form is submitted and necessary data is present
if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['meeting_heading']) && isset($_POST['purpose_of_meeting'])
    && isset($_POST['brief_outline']) && isset($_POST['preferred_date'])
    && isset($_POST['preferred_time']) && isset($_POST['staff']) 
    && isset($_POST['year_of_study']) && isset($_POST['student_id'])
    && isset($_POST['contact_email']) && $_POST['staff'] > 0
) {
    $student_id = $_POST["student_id"];
    $year_of_study = $_POST["year_of_study"];
    $meeting_heading = $_POST["meeting_heading"];
    $purpose_of_meeting = $_POST["purpose_of_meeting"];
    $brief_outline = $_POST["brief_outline"];
    $preferred_date = $_POST["preferred_date"]; 
    $preferred_time = $_POST["preferred_time"];
    $staff_id = $_POST['staff'];
    $contact_email = $_POST['contact_email'];
    $status = MeetingStatus::Pending;
    $additional_information = isset($_POST['additional_information']) ? $_POST["additional_information"] : NULL;

    $fileName = NULL; //default value
    $fileContent = NULL; //default value




    if (isset($_FILES["attachment"]) && $_FILES["attachment"]["size"] > 0) {
        $fileName = $_FILES["attachment"]["name"]; // Get the uploaded file name
        $fileTmpName = $_FILES["attachment"]["tmp_name"]; // Get the temporary location of the uploaded file
        $fileContent = file_get_contents($fileTmpName); // Read the contents of the file into a variable
    }

    // Create meeting details using prepared statements
    $querymeetings = "INSERT INTO `meetings`(`heading`, `purpose`, `outline`, `additional_information`, `pref_date`, `pref_time`, `filename`, `file_data`, `status`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $querymeetings);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $meeting_heading, $purpose_of_meeting, $brief_outline, $additional_information, $preferred_date, $preferred_time, $fileName, $fileContent, $status);

        if (mysqli_stmt_execute($stmt)) {
            // Get the inserted last_meeting_id
            $last_meeting_id = mysqli_insert_id($conn);

            // Create user_meetings
            $queryusermeeting = "INSERT INTO `user_meetings` (`meeting_id`, `student_id`, `staff_id`)
                             VALUES (?, ?, ?)";

            $stmt2 = mysqli_prepare($conn, $queryusermeeting);
            mysqli_stmt_bind_param($stmt2, "sss", $last_meeting_id, $student_id, $staff_id);
            $result2 = mysqli_stmt_execute($stmt2);

            if ($result2) {
                // Update student's year_of_study and contact_email
                $queryUpdateStudent = "UPDATE `students` SET `year_of_study`=?, `contact_email`=? WHERE id = ?";
                $stmt3 = mysqli_prepare($conn, $queryUpdateStudent);
                mysqli_stmt_bind_param($stmt3, "sss", $year_of_study, $contact_email, $student_id);
                $result3 = mysqli_stmt_execute($stmt3);

                if ($result3) {
                    echo json_encode(array("status" => "success", "message" => "Meeting Created successfully"));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Error in updating student's 'year_of_study' and 'contact_email': " . mysqli_error($conn)));
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "Error in inserting 'user_meetings': " . mysqli_error($conn)));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Error executing prepared statement: " . mysqli_stmt_error($stmt)));
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("status" => "error", "message" => "Error preparing statement: " . mysqli_error($conn)));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request or missing data"));
}



$conn->close();
