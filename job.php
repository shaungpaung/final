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
                        <h5 id="toggle-form" class="text-center">Job Form</h5>
                        <?php
                        if (isset($_GET['jobID'])) {
                            $id = $_GET['jobID'];
                            $sql = "SELECT * FROM jobs WHERE jobID = '$id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            ?>
                            <form method="POST" id="job-form" action="jobUpdate.php">
                                <input type="hidden" name="jobID" value="<?php echo $row['jobID'] ?>">
                                <input value="<?php echo $row['quantity'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter quantity" name="quantity" />
                                <input value="<?php echo $row['weight'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter weight" name="weight" />
                                <input value="<?php echo $row['size'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter size" name="size" />
                                <select class="form-select mb-2" name="hazardous">
                                    <option value="1" <?php echo $row['hazardous'] ? 'selected' : ''; ?>>Yes hazardous
                                    </option>
                                    <option value="0" <?php echo !$row['hazardous'] ? 'selected' : ''; ?>>No hazardous
                                    </option>
                                </select>
                                <input type="date" class="form-control mb-2" value="<?php echo $row['startDate'] ?>"
                                    name="startDate" />
                                <input type="date" class="form-control mb-2" value="<?php echo $row['deadline'] ?>"
                                    name="deadline" />

                                <!-- Dropdown for selecting jobVehicleID -->
                                <select class="form-select mb-2" name="jobVehicleID">
                                    <?php
                                    // Assuming you have already included the database connection file
                                
                                    // Fetch vehicle data from the database
                                    $sql = "SELECT * FROM vehicles";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any rows returned
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row of the result set
                                        while ($vehicle = mysqli_fetch_assoc($result)) {
                                            // Display the option with the vehicleID and name
                                            $selected = ($vehicle['vehicleID'] == $row['jobVehicleID']) ? 'selected' : '';
                                            echo '<option value="' . $vehicle['vehicleID'] . '" ' . $selected . '>' . $vehicle['type'] . ' (' . $vehicle['vehicleID'] . ')</option>';
                                        }
                                    } else {
                                        // If no rows are returned, display a default option
                                        echo '<option value="">No vehicles found</option>';
                                    }
                                    ?>
                                </select>

                                <input value="<?php echo $row['originBranchID'] ?>" type="text" class="form-control mb-2"
                                    placeholder="Enter From branch" name="originBranchID" />
                                <input value="<?php echo $row['destinationBranchID'] ?>" type="text"
                                    class="form-control mb-2" placeholder="Enter To Branch" name="destinationBranchID" />
                                <select class="form-select mb-2" name="status">
                                    <option value="completed" <?php echo $row['status'] === 'completed' ? 'selected' : ''; ?>>
                                        Completed</option>
                                    <option value="in progress" <?php echo $row['status'] === 'in progress' ? 'selected' : ''; ?>>In Progress
                                    </option>
                                </select>
                                <button class="btn btn-primary">Update</button>
                            </form>

                        <?php } else { ?>
                            <form method="POST" id="job-form" action="jobCreate.php">
                                <input type="text" class="form-control mb-2" placeholder="Enter quantity" name="quantity" />
                                <input type="text" class="form-control mb-2" placeholder="Enter weight" name="weight" />
                                <input type="text" class="form-control mb-2" placeholder="Enter size" name="size" />
                                <select class="form-select mb-2" name="hazardous">
                                    <option value="1">Yes hazardous</option>
                                    <option value="0">No hazardous</option>
                                </select>

                                <input type="date" class="form-control mb-2" placeholder="Enter start date"
                                    name="startDate" />
                                <input type="date" class="form-control mb-2" placeholder="Enter deadline" name="deadline" />
                                <select class="form-select mb-2" name="jobVehicleID">
                                    <?php
                                    // Assuming you have already included the database connection file
                                
                                    // Fetch vehicle data from the database
                                    $sql = "SELECT * FROM vehicles";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any rows returned
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row of the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Display the option with the vehicleID and name
                                            echo '<option value="' . $row['vehicleID'] . '">' . $row['type'] . ' (' . $row['vehicleID'] . ')</option>';
                                        }
                                    } else {
                                        // If no rows are returned, display a default option
                                        echo '<option value="">No vehicles found</option>';
                                    }
                                    ?>
                                </select>

                                <input type="text" class="form-control mb-2" placeholder="Enter From branch"
                                    name="originBranchID" />
                                <input type="text" class="form-control mb-2" placeholder="Enter To Branch"
                                    name="destinationBranchID" />
                                <select class="form-select mb-2" name="status">
                                    <option value="completed">Completed</option>
                                    <option value="in progress">In Progress</option>
                                </select>
                                <button class="btn btn-primary">Create</button>
                            </form>
                        <?php } ?>
                    </div>
                </span>
                <div class="table-container border rounded shadow-lg mt-1">
                    <div class="main-page rounded">
                        <table class="table table-bordered ">
                            <thead class="rounded sticky-top mb-1">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Job ID</th>
                                    <th class="text-center" scope="col">quantity</th>
                                    <th class="text-center" scope="col">weight</th>
                                    <th class="text-center" scope="col">size</th>
                                    <th class="text-center" scope="col">hazardous</th>
                                    <th class="text-center" scope="col">startDate</th>
                                    <th class="text-center" scope="col">deadline</th>
                                    <th class="text-center" scope="col">Vehicle</th>
                                    <th class="text-center" scope="col">From Branch</th>
                                    <th class="text-center" scope="col">To Branch</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Edit</th>
                                    <th class="text-center" scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="jobTable" class="rounded">
                                <?php
                                $sql = "SELECT * FROM jobs";
                                $result = mysqli_query($conn, $sql);
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['jobID']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['weight']; ?></td>
                                        <td><?php echo $row['size']; ?></td>
                                        <td><?php echo $row['hazardous']; ?></td>
                                        <td><?php echo $row['startDate']; ?></td>
                                        <td><?php echo $row['deadline']; ?></td>
                                        <?php
                                        $vehicleID = $row['jobVehicleID'];
                                        $query = "SELECT type FROM vehicles WHERE vehicleID = ?";
                                        $stmt = mysqli_prepare($conn, $query);
                                        mysqli_stmt_bind_param($stmt, "i", $row['jobVehicleID']);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $vehicles);
                                        mysqli_stmt_fetch($stmt);
                                        mysqli_stmt_close($stmt);
                                        ?>
                                        <td><?php echo $vehicles . ' (' . $vehicleID . ')'; ?></td>
                                        <?php
                                        $query = "SELECT name FROM branches WHERE BranchID = ?";
                                        $stmt = mysqli_prepare($conn, $query);
                                        mysqli_stmt_bind_param($stmt, "i", $row['originBranchID']);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $originBranch);
                                        mysqli_stmt_fetch($stmt);
                                        mysqli_stmt_close($stmt);
                                        ?>
                                        <td><?php echo $originBranch; ?></td>
                                        <?php
                                        $query = "SELECT name FROM branches WHERE BranchID = ?";
                                        $stmt = mysqli_prepare($conn, $query);
                                        mysqli_stmt_bind_param($stmt, "i", $row['destinationBranchID']);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $branchName);
                                        mysqli_stmt_fetch($stmt);
                                        mysqli_stmt_close($stmt);
                                        ?>
                                        <td><?php echo $branchName; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><a href="job.php?jobID=<?php echo $row['jobID']; ?>"
                                                class="btn edit edit-bg">Edit</a></td>
                                        <td><a href="jobDelete.php?jobID=<?php echo $row['jobID']; ?>"
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