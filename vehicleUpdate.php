<?php
include ('db.php');
if (isset($_POST['vehicleID']) && isset($_POST['type']) && isset($_POST['maximumCarryingWeight']) && isset($_POST['maximumAvailableSpace']) && isset($_POST['homeBranchID'])) {
    $id = $_POST['vehicleID'];
    $type = $_POST['type'];
    $maximumCarryingWeight = $_POST['maximumCarryingWeight'];
    $maximumAvailableSpace = $_POST['maximumAvailableSpace'];
    $homeBranchID = $_POST['homeBranchID'];
    $sql = "UPDATE vehicles SET type = '$type', maximumCarryingWeight = '$maximumCarryingWeight', maximumAvailableSpace = '$maximumAvailableSpace', homeBranchID = '$homeBranchID' WHERE vehicleID = '$id'";
    mysqli_query($conn, $sql);
    header("location:vehicle.php");
    exit();
}