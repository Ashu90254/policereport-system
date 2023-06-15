<?php
session_start();
require("../config/config.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $password = md5($_POST["password"]);

    $stmt = $conn->prepare("SELECT name, password, user_role FROM user_login WHERE name = ? AND password = ?");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful
        $row = $result->fetch_assoc();
        $dbUsername = $row['name'];
        $dbRole = $row['user_role'];

        // Store the username and role in the session
        $_SESSION["name"] = $dbUsername;
        $_SESSION["role"] = $dbRole;

        // Redirect the user to the logged-in page
        header("Location: user");
        exit();
    } else {
        // Display an error message
        $error = "Invalid username or password";
        // header("location:index.php?wrongdetails");
        echo "
        <form id='myForm' action='../index' method='post'>
            <input type='hidden' name='error' value='user_details_wrong'>
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>
    ";
        exit();
    }
}

// echo $_SESSION["name"]
if ($_SESSION["role"] == "user") {
    // echo "Welcome " . $_SESSION["name"];
    $username = $_SESSION["name"];
} else {
    header("location: ../index");
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../css/stylesheet.css"> -->
    <link rel="icon" type="image/x-icon" href="../image/tab-logo.png">
    <link rel="stylesheet" href="../css/report-table.css">
    <!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->
    <style>
        body {
            background-color: #e3e3e3;
        }

        .report-banner {
            margin-top: 2rem;

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Welcome to user portal <?php echo $_SESSION["name"]; ?></a>

            <button class="btn btn-outline-danger btn-sm" onclick="location.href='../logout'" type="submit">
        Logout <i class="fa fa-sign-out" aria-hidden="true"></i></button>
    </nav>
    <div class="text-center report-banner">
        <h4>Reports</h4>
    </div>
    <div class="container w-75 p-3">
        <?php
        if (isset($_SESSION["name"])) {
            $select_query = "SELECT * FROM policereports where registered_by = '$username'";
            $selectresult = mysqli_query($conn, $select_query);
            if (mysqli_num_rows($selectresult) > 0) {
                echo '<table class="responsive-table">
                <thead>
                    <tr>
                        <th scope="col">Complaint number</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last updated by</th>
                        <th scope="col">Last Update</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
            }
            while ($row = mysqli_fetch_array($selectresult)) {
                    
                    $formatted_date = date("d-m-Y", strtotime($row["report_date"]));
                echo '<tr>
                        <th scope="row" data-type="date">' . $row["report_id"] . '</th>
                        <th scope="row" data-type="date">' . $formatted_date . '</th>
                        <td data-title="Status">' . $row["status"] . '</td>
                        <td data-title="Last updated by">' . (!empty($row["last_update_by"]) ? $row["last_update_by"] : "Not available") . '</td>
                        <td data-title="Update time">' . (!empty($row["last_updated_time"]) ? $row["last_updated_time"] : "Not available") . '</td>
                        <td data-title="action"><button data-toggle="modal" data-target="#details_modal_' . $row["report_id"] . '" class="btn btn-sm btn-outline-secondary">Details</button></td>
                    </tr>';
        ?>
                <div class="modal fade" id="details_modal_<?php echo $row['report_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="details_modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Report Id</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["report_id"]; ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Report Date</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["report_date"]; ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Reported By</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["registered_by"]; ?></div>
                                    </div>
                                </div>
                                <div class="container  mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Description</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["description"]; ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Location</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["location"]; ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Status</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["status"]; ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Last Update time</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php if(!empty($row["last_updated_time"])){echo $row["last_updated_time"];}else{echo"Not Available";} ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Last Update By</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php if(!empty($row["last_update_by"])){echo $row["last_update_by"];}else{echo"Not Available";} ?></div>
                                    </div>
                                </div>
                                <div class="container mt-3 mb-3">
                                    <div class="row">
                                        <div class="col">Reporting Police Station</div>
                                        <div class="col text-center">:</div>
                                        <div class="col"><?php echo $row["police_station"]; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div><?php
                    }
                    if (mysqli_num_rows($selectresult) > 0) {
                        echo "</tbody></table>";
                    }
                    if (!mysqli_num_rows($selectresult) > 0) {
                        echo "<div class='d-flex justify-content-center align-items-center text-danger'>You Don't have any complaint registeted click here to register a complaint &nbsp; <button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#register-complaint-form'>Register a Complaint</button></div>";
                    }
                    if (mysqli_num_rows($selectresult) > 0) {
                        echo "<div class='d-flex flex-row-reverse'><button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#register-complaint-form'>Register a new complaint</button></div>";
                    }
                }
                        ?>
        <div id="register-complaint-form" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <form id="register-complaint" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Enter details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Describe the issue</label>
                                <input type="textarea" name="description" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Choose police station</label>
                                <select class="form-control form-control-sm" name="Police_Station">
                                    <option>Delhi</option>
                                    <option>Noida</option>
                                    <option>Gurugram</option>
                                </select>
                            </div>
                            <input type="hidden" name="name" value="<?php echo $username; ?>">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="../js/user_js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>