<form method = "POST">
    Username: <input type="text" name = "username" required><br>
    Email: <input type="email" name = "email" required ><br>
    Password: <input type="password" name = "password" required><br>
    <button name = "register">Sign up </button>
</form>
<?php
include 'ds.php';
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt =$conn->prepare("INSERT INTO users(username, email, password)
    VALUES(?,?,?)");
    $stmt->bind_param("sss",$username, $email, $password);
    $stmt->execute();
    echo "succesfully signed";
}
?>