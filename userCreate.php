<?php
include ('db.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (username,password) VALUES('$name','$password')";
    mysqli_query($conn, $sql);
    header("location:index.php");
}
?>