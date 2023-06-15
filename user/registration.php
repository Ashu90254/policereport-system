<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $protect_pass = md5($_POST["password"]);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    require("../config/config.php");
    $sql = "INSERT INTO user_login(name, password, email, phone_number)
        VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $protect_pass, $email, $phone);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Sucesfully";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
