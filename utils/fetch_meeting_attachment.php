<?php
require_once "../conf/conf.php";

if (isset($_GET['id'])) {
    $meetingId = $_GET['id'];

    $query = "SELECT `filename`, `file_data` FROM `meetings` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $meetingId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $fileName, $fileContent);
            mysqli_stmt_fetch($stmt);

            // // Output file to the browser
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            // header("Content-Disposition: inline; filename=\"$fileName\"");
            


            echo $fileContent;
            exit;
        } else {
            echo "Meeting not found.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare statement.";
    }
}
mysqli_close($conn);
