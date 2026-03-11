<?php 
include_once("../dbConnection/connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['username'];
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        if (empty($login)) {
            $_SESSION['error'] = "Username/Email field is empty.";
        }
        if (empty($password)) {
            $_SESSION['error'] = "Password field is empty.";
        }
    } else {
        $query = mysqli_query($dbc, "SELECT * FROM users WHERE username='$login' OR email='$login'");
        $user = mysqli_fetch_array($query);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            header("Location: ../index.php");
            exit(); 
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
        }
    }
    header("Location: ../forms/login-signup.php");
    exit();
}
?>
