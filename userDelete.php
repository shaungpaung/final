<?php
include ('db.php');

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    $delete_sql = "DELETE FROM users WHERE userID = '$userID'";
    mysqli_query($conn, $delete_sql);
    header("location:index.php");
}
?>