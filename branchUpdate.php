<?php
include ('db.php');
if (isset($_POST['branchID']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['branchPhoneNumber'])) {
    $id = $_POST['branchID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $ph = $_POST['branchPhoneNumber'];
    $sql = "UPDATE branches SET name = '$name', address = '$address', branchPhoneNumber = '$ph' WHERE branchID = '$id'";
    mysqli_query($conn, $sql);
    header("location:branch.php");
    exit();
}