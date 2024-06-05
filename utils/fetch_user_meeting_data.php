<?php

require_once '../conf/conf.php';
require_once './constants.php';

// Fetch meeting details from the database
if (isset($_GET['whereBy']) && isset($_GET['whereValue'])) {
    $whereBy = $_GET['whereBy'];
    $whereValue = $_GET['whereValue'];



    $sql = "SELECT 
                    meetings.status AS meeting_status,
                    meetings.reject_reason AS meeting_reject_reason,
                    user_meetings.meeting_id AS meeting_id,
                    user_meetings.student_id AS student_id,
                    user_meetings.staff_id AS staff_id,
                    students.first_name As student_first_name,
                    students.last_name As student_last_name,
                    students.reg_num As student_reg_num,
                    students.year_of_study As student_year_of_study,
                    meetings.pref_time As meeting_pref_time,
                    meetings.pref_date As meeting_pref_date,

                    meetings.heading As meeting_heading,
                    meetings.purpose As meeting_purpose,
                    meetings.outline As meeting_outline,
                    meetings.additional_information As meeting_additional_information,
                    meetings.filename As meeting_filename,
                    meetings.file_data As meeting_file_data,

                    meetings.created_at AS meeting_created_at,
                    meetings.updated_at AS meeting_updated_at,

                    staffs.first_name AS staff_first_name,
                    staffs.last_name AS staff_last_name,
                    professions.name AS staff_profession

                FROM 
                    user_meetings
                INNER JOIN 
                    staffs ON user_meetings.staff_id = staffs.id
                INNER JOIN 
                    students ON user_meetings.student_id = students.id
                INNER JOIN 
                    meetings ON user_meetings.meeting_id = meetings.id
                INNER JOIN
                    professions ON staffs.profession_id = professions.id
                WHERE
                    user_meetings.`$whereBy`= '$whereValue' ";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize an array to hold the fetched data
        $meeting = array();

        // Fetch data and store in the array
        while ($row = $result->fetch_assoc()) {
            $meeting = array(
                'meeting_status' => $row['meeting_status'],
                'meeting_id' => $row['meeting_id'],
                'student_id' => $row['student_id'],
                'staff_id' => $row['staff_id'],
                'student_name' => $row['student_first_name'] . " " . $row['student_last_name'],
                'student_reg_num' => $row['student_reg_num'],
                'student_year_of_study' => $row['student_year_of_study'],
                'meeting_pref_time' => $row['meeting_pref_time'],
                'meeting_pref_date' => $row['meeting_pref_date'],
                'meeting_heading' => $row['meeting_heading'],
                'meeting_purpose' => $row['meeting_purpose'],
                'meeting_outline' => $row['meeting_outline'],
                'meeting_add_info' => isset($row['meeting_add_info']) ? $row['meeting_add_info'] : "",
                'meeting_filename' => $row['meeting_filename'],
                'meeting_file_data_exist' => isset($row['meeting_file_data']) ? true : false,
                'meeting_created_at' => $row['meeting_created_at'],
                'meeting_updated_at' => $row['meeting_updated_at'],
                'staff_first_name' => $row['staff_first_name'],
                'staff_last_name' => $row['staff_last_name'],
                'staff_profession' => $row['staff_profession'],
                'meeting_reject_reason' => $row['meeting_reject_reason']

            );
        }

        // Output the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($meeting);
    } else {
        echo json_encode(array("error" => "No data found for the provided whereValue"));
    }
} else {
    echo json_encode(array("error" => "whereBy or whereValue is not provied"));
}

$conn->close();
