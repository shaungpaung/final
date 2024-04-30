<?php
include ('db.php');
if (isset($_POST['type']) && isset($_POST['maximumCarryingWeight']) && isset($_POST['maximumAvailableSpace']) && isset($_POST['homeBranchID'])) {
    $type = $_POST['type'];
    $maximumCarryingWeight = $_POST['maximumCarryingWeight'];
    $maximumAvailableSpace = $_POST['maximumAvailableSpace'];
    $homeBranchID = $_POST['homeBranchID'];
    $sql = "INSERT INTO vehicles (type, maximumCarryingWeight, maximumAvailableSpace, homeBranchID) 
            VALUES ('$type', $maximumCarryingWeight, $maximumAvailableSpace, $homeBranchID)";
    mysqli_query($conn, $sql);
    header("location:vehicle.php");
}