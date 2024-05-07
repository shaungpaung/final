<?php
include ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $name = $_POST['username'];
            $password = $_POST['password'];
            $sql = "INSERT INTO users (username,password) VALUES('$name','$password')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("status" => "success", "message" => "User created successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error creating user."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Username and password are required."));
        }
    }
}
?>