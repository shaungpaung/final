<?php
include ('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logistics Web Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="toggle.js"></script>
    <link rel="stylesheet" href="style.css" />
    <style>
        .hidden {
            display: none;
        }

        .list-group a {
            text-decoration: none;
            color: black;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-info border-bottom border-body">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    Logistics Company
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="branch.php">Branch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vehicle.php">Vehicle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="job.php">Job</a>
                        </li>
                    </ul>
                </div>

                <div class="d-flex justify-content-center">
                    <a class="btn btn-light ms-1 me-2 text-de custom-hover-bg custom-hover-text custom-hover-shadow"
                        id="logoutButton" href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="main-container d-flex">
        <div class="navContainer container-sm col-md-2 bg-primary">
            <ul class="list-group mt-3 mb-3">
                <a href="index.php">
                    <li class="list-group-item m-2 rounded custom-hover-bg custom-hover-text custom-hover-shadow">Users
                    </li>
                </a>

                <a href="branch.php">
                    <li class="list-group-item m-2 rounded custom-hover-bg custom-hover-text custom-hover-shadow">Branch
                    </li>
                </a>

                <a href="vehicle.php">
                    <li class="list-group-item m-2 rounded custom-hover-bg custom-hover-text custom-hover-shadow">
                        Vehicle
                    </li>
                </a>

                <a href="job.php">
                    <li class="list-group-item m-2 rounded custom-hover-bg custom-hover-text custom-hover-shadow">Job
                    </li>
                </a>

            </ul>
        </div>

        <div class="main bg-danger col-md-10 container-xxl">
            <div class="container-xl  align-items-center p2 border-body mt-2 mb-2">
                <span class="d-flex justify-content-center">
                    <div class="branch-form col-md-4 p-2 border rounded shadow-sm bg-white">
                        <h5 id="toggle-form" class="text-center ">User Form</h5>
                        <?php
                        if (isset($_GET['userID'])) {
                            $id = $_GET['userID'];
                            $sql = "SELECT * FROM users WHERE userID = '$id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            ?>
                            <form method="POST" id="job-form" action="userUpdate.php">
                                <input type="hidden" name="userID" value="<?php echo $row['userID'] ?>">
                                <input value="<?php echo $row['username'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter Name" name="username" />
                                <input value="<?php echo $row['password'] ?>" type="password" class="form-control mb-2"
                                    placeholder="Enter password" name="password" />
                                <button class="btn btn-primary">Update</button>
                            </form>
                        <?php } else { ?>
                            <form method="POST" id="job-form" action="userCreate.php">
                                <input type="text" class="form-control mb-2" placeholder="Enter Name" name="username" />
                                <input type="password" class="form-control mb-2" placeholder="Enter address"
                                    name="password" />
                                <button class="btn btn-primary">Create</button>
                            </form>
                        <?php } ?>
                    </div>
                </span>
                <div class="table-container mt-1">
                    <div class="main-page rounded">
                        <table class="table table-bordered ">
                            <thead class="rounded sticky-top mb-1">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Name</th>
                                    <th class="text-center" scope="col">Password</th>
                                    <th class="text-center" scope="col">Edit</th>
                                    <th class="text-center" scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="jobTable" class="rounded">
                                <?php
                                $sql = "SELECT * FROM users";
                                $result = mysqli_query($conn, $sql);
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {

                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['password']; ?></td>
                                        <td><a href="index.php?userID=<?php echo $row['userID']; ?>"
                                                class="btn btn-primary">Edit</a></td>
                                        <td><a href="userDelete.php?userID=<?php echo $row['userID']; ?>"
                                                class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#toggle-form').click(function () {
                    var form = $('#job-form');
                    if (form.hasClass('d-none')) {
                        form.removeClass('d-none');
                        $('#toggle-form').text('Job Form');
                    } else {
                        form.addClass('d-none');
                        $('#toggle-form').text('Open Form');
                    }
                });
            });
        </script>

</body>

</html>