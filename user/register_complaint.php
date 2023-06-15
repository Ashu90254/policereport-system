<?php 
require("../config/config.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $location = $_POST["location"];
    $Police_Station = $_POST["Police_Station"];
    $description = $_POST["description"];
    
    $response = mysqli_query($conn, "INSERT INTO policereports (registered_by, description, location, status, Police_Station) VALUES ('$name', '$description', '$location', 'Pending', '$Police_Station')");
    if ($response){
        echo "sucess";
    }else{
        echo "error";
    }
}

?>