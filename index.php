<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role === 'user') {
        header("Location: user/user");
        exit();
    } elseif ($role === 'police') {
        header("Location: police/police");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="image/tab-logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>

<body>

    <nav class="navbar navbar-light  justify-content-center">
        <a class="navbar-brand text-center m-0 font-weight-normal" href="">Welcome to Indian Govt Report Portal <span id="blinking-text">!</span></a>
    </nav>

    <div id="bg-img"></div>
    <div class="login-card">

        <div class="first-card">
            <img src="image/user.png" alt="Avatar">
            <h4><b>User Login</b></h4>

            <a href="#user-login-modal" class="login-button" data-toggle="modal">
                Login <span class="arrow">&rarr;</span>
            </a>
        </div>
        <div class="second-card">
            <img src="image/police.png" alt="Avatar">
            <h4><b>Police Login</b></h4>
            <a href="#police-login-modal" class="login-button" data-toggle="modal">
                Login <span class="arrow">&rarr;</span>
            </a>
        </div>
    </div>
    <div id="user-login-modal" class="modal fade ">
        <div class="modal-dialog modal-login">
            <div class="modal-content">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="w-50 nav-item text-center">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                    </li>
                    <li class="w-50 nav-item text-center">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Registration</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form id="user_login_form" action="user/user" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Enter Details to login</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" required="required" name="name">
                                </div>
                                <div class="form-group">
                                    <div class="clearfix">
                                        <label>Password</label>
                                    </div>
                                    <input type="password" class="form-control" required="required" name="password">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-flexend">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form id="user_registration_form" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">User Register here</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" required="required" name="name">
                                </div>
                                <div class="form-group">
                                    <div class="clearfix">
                                        <label>Password</label>
                                    </div>
                                    <input type="password" class="form-control" required="required" name="password">
                                </div>
                                <div class="form-group">
                                    <div class="clearfix">
                                        <label>Phone number</label>
                                    </div>
                                    <input type="number" class="form-control" required="required" name="phone">
                                </div>
                                <div class="form-group">
                                    <div class="clearfix">
                                        <label>Email</label>
                                    </div>
                                    <input type="email" class="form-control" required="required" name="email">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-flexend">
                                <input type="submit" class="btn btn-primary" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="police-login-modal" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <form action="police/police" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Police Login here</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" required="required" name="name">
                        </div>
                        <div class="form-group">
                            <div class="clearfix">
                                <label>Password</label>
                            </div>

                            <input type="password" class="form-control" required="required" name="password">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-flexend">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="copyright"> &copy; 2023 Report Project. All rights reserved.</div>


</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="js/index_js.js"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
if (isset($_POST["error"])) {
    echo "<script>Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Please enter correct details!'
});</script>";
}
?>
</html>