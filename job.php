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
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .branch-form {
            align-items: center;
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
    <div class="main-container d-flex ">
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
                        <h5 id="toggle-form" class="text-center">Job Form</h5>
                        <?php
                        if (isset($_GET['jobID'])) {
                            $id = $_GET['jobID'];
                            $sql = "SELECT * FROM jobs WHERE jobID = '$id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            ?>
                            <form method="POST" id="job-form" act ion="jobUpdate.php">
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
                <div class="table-container mt-1">
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
                                        <td><?php echo $row['originBranchID']; ?></td>
                                        <td><?php echo $row['destinationBranchID']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><a href="job.php?jobID=<?php echo $row['jobID']; ?>"
                                                class="btn btn-primary">Edit</a></td>
                                        <td><a href="jobDelete.php?jobID=<?php echo $row['jobID']; ?>"
                                                class="btn btn-danger">Delete</a>
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