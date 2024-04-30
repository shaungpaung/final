<?php
include ('db.php');

if (isset($_GET['vehicleID'])) {
    $vehicleID = $_GET['vehicleID'];

    $delete_sql = "DELETE FROM vehicles WHERE vehicleID = '$vehicleID'";
    mysqli_query($conn, $delete_sql);
    header("location:vehicle.php");
}
?>