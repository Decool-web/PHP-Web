<?php
include 'db.php';
if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["register"])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST["password"];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid email!";
    }
    else if(strlen($password)<6){
        echo "password must be at least 6 characters"; 
    }
    else{
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        if($check->num_rows>0){
            echo "email already exists ";
        }
        else{
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users(username, email, password)
            VALUES(?,?,?);");
            $stmt->bind_param("sss", $username, $email, $hashed);
            $stmt->execute();
            echo "registered succesfully";
        }
    }
}
?>
<form method= "POST">
    username: <input type="text" name = "username" placeholder= "username" required> <br>
    Email: <input type="email" name= "email" placeholder="email" required><br>
    Password: <input type="password" name = "password" required placeholder = "enter a strong password"><br>
    <input type="submit" value = "Sign up" name = "register" >
</form>