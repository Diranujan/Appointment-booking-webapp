<?php

require_once '../conf/conf.php';
require_once './constants.php';

// Fetch department names from the database
// $status = isset($_GET['status']) ? $_GET['status'] : MeetingStatus::Pending;
if (isset($_GET['orderBy']) && isset($_GET['orderMethod'])) {
    $orderBy = $_GET['orderBy'];
    $orderMethod = $_GET['orderMethod'];

    //if where & orderby are exist
    if (isset($_GET['whereBy']) && isset($_GET['whereValue'])) {
        $whereBy = $_GET['whereBy'];
        $whereValue = $_GET['whereValue'];

        // if where & orderby & status are exist
        if (isset($_GET['status'])) {
            $status = $_GET['status'];

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
                    user_meetings.`$whereBy`= $whereValue AND meetings.status = '$status'
                ORDER BY 
                    meetings.`$orderBy` $orderMethod ;";
        
        } else {

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
                    user_meetings.`$whereBy`= $whereValue 
                ORDER BY 
                    meetings.`$orderBy` $orderMethod ;";
        }
    } else {
        //if only orderby is exist
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
                    meetings.status = '$status'
                ORDER BY 
                    meetings.`$orderBy` $orderMethod ;";
    }
} else {

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
                meetings.additional_information As meeting_add_info,
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
                meetings.status = '$status'";
}



$result = $conn->query($sql);

// Check for errors
if (!$result) {
    echo "Error: " . $conn->error;
    // Handle the error appropriately (log, display, etc.)
} else {
    $meetingDetails = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $meetingDetails[] = array(
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




                // 'meeting_id' => isset($row['meeting_id']) ? $row['meeting_id'] : "",
                // 'student_id' => isset($row['student_id']) ? $row['student_id'] : "",
                // 'staff_id' => isset($row['staff_id']) ? $row['staff_id'] : "",

                // 'student_name' => isset($row['student_first_name'], $row['student_last_name']) ? $row['student_first_name'] . " " . $row['student_last_name'] : "",
                // 'student_reg_num' => isset($row['student_reg_num']) ? $row['student_reg_num'] : "",
                // 'student_year_of_study' => isset($row['student_year_of_study']) ? $row['student_year_of_study'] : "",

                // 'meeting_pref_time' => isset($row['meeting_pref_time']) ? $row['meeting_pref_time'] : "",
                // 'meeting_pref_date' => isset($row['meeting_pref_date']) ? $row['meeting_pref_date'] : "",

                // 'meeting_heading' => isset($row['meeting_heading']) ? $row['meeting_heading'] : "",
                // 'meeting_purpose' => isset($row['meeting_purpose']) ? $row['meeting_purpose'] : "",
                // 'meeting_outline' => isset($row['meeting_outline']) ? $row['meeting_outline'] : "",
                // 'meeting_add_info' => isset($row['meeting_add_info']) ? $row['meeting_add_info'] : "",
                // 'meeting_filename' => isset($row['meeting_filename']) ? $row['meeting_filename'] : "",
                // 'meeting_file_data_exist' => isset($row['meeting_file_data']) ? true : false

                // 'meeting_file_data' => isset($row['meeting_file_data']) ? $row['meeting_file_data'] : "",


            );
        }
    }
}


// Output faculty names as JSON
header('Content-Type: application/json');
echo json_encode($meetingDetails);

$conn->close();
