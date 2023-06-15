<?php 
require("../config/config.php");
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $password = $_POST["password"];

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
        echo "sucess";
        exit();
    } else {
        // Display an error message
        $error = "error";
        // header("location:index.php?wrongdetails");
        exit();
    }
}
?>