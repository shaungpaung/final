<?php
include ('db.php');
if (isset($_POST['userID']) && isset($_POST['username']) && isset($_POST['password'])) {
    $id = $_POST['userID'];
    $name = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username = '$name', password = '$hashedPassword'WHERE userID = '$id'";
    mysqli_query($conn, $sql);
    header("location:index.php");
    exit();
}