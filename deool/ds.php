<?php
$conn = new mysqli("localhost", "root", "", "form");
if($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
?>