
<?php
function ExecuteQuery($query, $connect)
{
    $result = mysqli_query($connect, $query);

    if ($result) {
        $message = "Query executed successfully.";
    } else {
        $message = "Error: " . mysqli_error($connect);
    }

    return $message;
}
?>
