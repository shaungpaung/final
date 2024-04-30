<?php
include ('db.php');
if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['branchPhoneNumber'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $ph = $_POST['branchPhoneNumber'];
    $sql = "INSERT INTO branches (name,address,branchPhoneNumber) VALUES('$name', '$address','$ph')";
    mysqli_query($conn, $sql);
    header("location:branch.php");
}
?>