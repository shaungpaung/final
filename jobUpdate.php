<?php
include ('db.php');
if (
    isset($_POST['jobID']) &&
    isset($_POST['quantity']) &&
    isset($_POST['weight']) &&
    isset($_POST['size']) &&
    isset($_POST['hazardous']) &&
    isset($_POST['startDate']) &&
    isset($_POST['deadline']) &&
    isset($_POST['originBranchID']) &&
    isset($_POST['destinationBranchID']) &&
    isset($_POST['status'])
) {
    $id = $_POST['jobID'];
    $quantity = $_POST['quantity'];
    $weight = $_POST['weight'];
    $size = $_POST['size'];
    $hazardous = $_POST['hazardous'] === 'true' ? 1 : 0;
    $startDate = $_POST['startDate'];
    $deadline = $_POST['deadline'];
    $originBranchID = $_POST['originBranchID'];
    $destinationBranchID = $_POST['destinationBranchID'];
    $status = $_POST['status'];

    $sql = "UPDATE jobs SET 
            quantity = '$quantity', 
            weight = '$weight', 
            size = '$size', 
            hazardous = '$hazardous', 
            startDate = '$startDate', 
            deadline = '$deadline', 
            originBranchID = '$originBranchID', 
            destinationBranchID = '$destinationBranchID', 
            status = '$status' 
            WHERE jobID = '$id'";
    mysqli_query($conn, $sql);

    header("location:job.php");
    exit();
}
?>