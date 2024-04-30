<?php
include ('db.php');
if (
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
    $quantity = $_POST['quantity'];
    $weight = $_POST['weight'];
    $size = $_POST['size'];

    $hazardous = $_POST['hazardous'] === 'true' ? 1 : 0;

    $startDate = $_POST['startDate'];
    $deadline = $_POST['deadline'];
    $originBranchID = $_POST['originBranchID'];
    $destinationBranchID = $_POST['destinationBranchID'];
    $status = $_POST['status'];

    $sql = "INSERT INTO jobs (quantity, weight, size, hazardous, startDate, deadline, originBranchID, destinationBranchID, status) 
            VALUES ('$quantity', '$weight', '$size', '$hazardous', '$startDate', '$deadline', '$originBranchID', '$destinationBranchID', '$status')";
    mysqli_query($conn, $sql);

    header("location:job.php");
}
?>