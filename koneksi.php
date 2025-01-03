<?php

date_default_timezone_set("Asia/Jakarta");

$hostserver = "localhost";
$username = "root";
$password = "";
$database = "webdailyjournal";

$conn = new mysqli($hostserver, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
} else {
    echo "";
}
?>