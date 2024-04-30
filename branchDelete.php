<?php
include ('db.php');

if (isset($_GET['branchID'])) {
    $branchID = $_GET['branchID'];

    $delete_sql = "DELETE FROM branches WHERE branchID = '$branchID'";
    mysqli_query($conn, $delete_sql);
    header("location:branch.php");
}
?>