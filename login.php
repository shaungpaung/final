<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
        }

        #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: auto;
            border: 1px solid #9c9c9c;
            background-color: #eaeaea;
            padding: 20px;
        }

        #register-link {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div id="login-box">
                <h3 class="text-center text-info mb-4">Login</h3>
                <form id="login-form" class="form" action="index.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label text-info">Username:</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-info">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-md">Submit</button>
                </form>
                <?php
                include 'db.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        header("Location: index.php");
                        exit();
                    } else {
                        $error = "Invalid username or password";
                    }
                }
                ?>
                <?php if (isset($error)) { ?>
                    <div class="text-danger"><?php echo $error; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>