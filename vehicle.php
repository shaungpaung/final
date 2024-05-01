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
    <link rel="stylesheet" href="mainStyle.css" />
    <style>
        .branch-form {
            align-items: center;
        }

        .delete {
            background-color: rgb(255, 0, 0);
            color: black(63, 42, 165);
        }

        .edit {
            background-color: rgb(0, 255, 255);
            color: black;
        }

        .edit-bg:hover {
            background-color: rgb(0, 133, 133);
            color: black;
        }

        .delete-bg:hover {
            background-color: rgb(133, 0, 0);
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
                    <span class="text-white">Logistics Company</span>
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

    <div class="main-container d-flex ">
        <div class="navContainer container-sm col-md-2 bg-dark-subtle">
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
        <div class="main bg-body-secondary shadow p-3 mb-5 col-md-10 container-xxl">
            <div class="container-xl  align-items-center p2 border-body mt-2 mb-2">
                <span class="d-flex justify-content-center">
                    <div class="branch-form shadow-lg col-md-4 p-2 border rounded bg-white">
                        <h5 id="toggle-form" class="text-center">Vehicle Form</h5>
                        <?php
                        if (isset($_GET['vehicleID'])) {
                            $id = $_GET['vehicleID'];
                            $sql = "SELECT * FROM vehicles WHERE vehicleID = '$id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            ?>
                            <form method="POST" id="job-form" action="vehicleUpdate.php">
                                <input type="hidden" name="vehicleID" value="<?php echo $row['vehicleID'] ?>">
                                <input value="<?php echo $row['type'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter Name" name="type" />
                                <input value="<?php echo $row['maximumCarryingWeight'] ?>" type="text"
                                    class="form-control mb-2" placeholder="Enter maximumCarryingWeight"
                                    name="maximumCarryingWeight" />
                                <input value="<?php echo $row['maximumAvailableSpace'] ?>" type="text"
                                    class="form-control mb-2" placeholder="Enter maximumAvailableSpace"
                                    name="maximumAvailableSpace" />
                                <input value="<?php echo $row['homeBranchID'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter Branch" name="homeBranchID" />
                                <button class="btn btn-primary">Update</button>
                            </form>
                        <?php } else { ?>
                            <form method="POST" id="job-form" action="vehicleCreate.php">
                                <input type="text" class="form-control mb-2" placeholder="Enter Type" name="type" />
                                <input type="text" class="form-control mb-2" placeholder="Enter maximumCarryingWeight"
                                    name="maximumCarryingWeight" />
                                <input type="text" class="form-control mb-2" placeholder="Enter maximumAvailableSpace"
                                    name="maximumAvailableSpace" />
                                <input type="text" class="form-control mb-2" placeholder="Enter Branch"
                                    name="homeBranchID" />
                                <button class="btn btn-primary">Create</button>
                            </form>
                        <?php } ?>
                    </div>
                </span>
                <div class="table-container border rounded shadow-lg mt-1">
                    <div class="main-page rounded">
                        <table class="table table-bordered ">
                            <thead class="rounded sticky-top">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">vehicle ID</th>
                                    <th class="text-center" scope="col">Type</th>
                                    <th class="text-center" scope="col">Maximum Carrying Weight</th>
                                    <th class="text-center" scope="col">Maximum Available Space</th>
                                    <th class="text-center" scope="col">Branch</th>
                                    <th class="text-center" scope="col">Edit</th>
                                    <th class="text-center" scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="jobTable" class="rounded">
                                <?php
                                $sql = "SELECT * FROM vehicles";
                                $result = mysqli_query($conn, $sql);
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['vehicleID']; ?></td>
                                        <td><?php echo $row['type']; ?></td>
                                        <td><?php echo $row['maximumCarryingWeight']; ?> Kg</td>
                                        <td><?php echo $row['maximumAvailableSpace']; ?> Kg</td>
                                        <?php
                                        $query = "SELECT name FROM branches WHERE branchID = ?";
                                        $stmt = mysqli_prepare($conn, $query);
                                        mysqli_stmt_bind_param($stmt, "i", $row['homeBranchID']);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $branchName);
                                        mysqli_stmt_fetch($stmt);
                                        mysqli_stmt_close($stmt);
                                        ?>
                                        <td><?php echo $branchName; ?></td>
                                        <td><a href="vehicle.php?vehicleID=<?php echo $row['vehicleID']; ?>"
                                                class="btn edit edit-bg">Edit</a></td>
                                        <td><a href="vehicleDelete.php?vehicleID=<?php echo $row['vehicleID']; ?>"
                                                class="btn delete delete-bg">Delete</a></td>
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
    </div>
    <script>
        $(document).ready(function () {
            $('#toggle-form').click(function () {
                var form = $('#job-form');
                if (form.hasClass('d-none')) {
                    form.removeClass('d-none');
                    $('#toggle-form').text('Vehicle Form');
                } else {
                    form.addClass('d-none');
                    $('#toggle-form').text('Open Form');
                }
            });
        });
    </script>
</body>

</html>