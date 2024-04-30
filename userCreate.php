<?php
include ('db.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username,password) VALUES('$name','$hashedPassword')";
    mysqli_query($conn, $sql);
    header("location:index.php");
}
?>