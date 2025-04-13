<?php
include "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $conn->prepare('SELECT id, username, password FROM
    users WHERE email = ?');
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($id, $username, $hashed);
        $stmt->fetch();
        if(password_verify($password, $hashed)){
            $_SESSION['user_id']  = $id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;

        }
        else{
        echo "wrong password!";
        }
    }
    else{
    echo "email not found!";
    }
}
?>
<form method= "POST">
    <input type="email" placeholder="please enter your email" required name= "email">
    <br><input type="password" name ="password" placeholder="enter password " required >
    <br> <input type="submit" value = "Login ">
</form>