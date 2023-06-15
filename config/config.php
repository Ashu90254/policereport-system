<?php 
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "police_complaint";

$conn = mysqli_connect($host,$username,$password,$database);

if (!isset($conn)){
    echo "connection error";
}else{

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS user_login (name varchar(288),password varchar(288),email varchar(288),phone_number int(50),user_role varchar(288) default 'user')");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS police_login (name varchar(288),password varchar(288),email varchar(288),police_station varchar(288),emp_id int(50),user_role varchar(288) default 'police')");
mysqli_query($conn,"CREATE TABLE IF NOT EXISTS policereports(report_id INT PRIMARY KEY AUTO_INCREMENT,report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,registered_by varchar(288),description TEXT,location VARCHAR(100),status ENUM('Pending', 'Under Investigation', 'Closed') NOT NULL,last_update_by varchar(288),last_updated_time varchar(288),police_station varchar(288))");
}
