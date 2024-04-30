<?php
include ('db.php');

if (isset($_GET['jobID'])) {
    $jobID = $_GET['jobID'];
    $delete_sql = "DELETE FROM jobs WHERE jobID = '$jobID'";
    mysqli_query($conn, $delete_sql);
    header("location:job.php");
}
?>