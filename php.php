<?php
$servername = "localhost";
$username = "root";
$dbname = "myDb";
$password = "";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("connection failed: ". $conn->connect_error );
}
$sql = "SELECT firstname, lastname FROM myguests ";
$result = $conn->query($sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        echo "Name:".$row["firstname"]. " ".$row["lastname"]."<br>";
    }
}
else{
    echo "zero results";
}
$conn->close();
?>