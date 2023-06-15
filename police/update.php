<?php 
require("../config/config.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $report_id = $_POST["report_id"];
    $update_status = $_POST["update_status"];
    $name = $_POST["name"];
    $remarks =  $_POST["remarks"];
    $currentDate = date("d-m-Y h:i");
    // echo $currentDate;

    $sql = "UPDATE policereports SET last_update_by = '$name', last_updated_time = '$currentDate', status = '$update_status',remarks = '$remarks' WHERE report_id = '$report_id'";
    echo $sql;
    $response = mysqli_query($conn, $sql);
    if ($response) {
        echo "
        <form id='myForm' action='police' method='POST'>
            <input type='hidden' name='update_sucess' value='update_sucess_done'>
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>
    ";
        
    } else {
        echo "There is an issue with mysqli: " . mysqli_error($conn);
    }

}

?>