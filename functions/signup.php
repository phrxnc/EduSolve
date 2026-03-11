<?php
session_start();
include_once("../dbConnection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role']; 

    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = "Passwords do not match!";
        header("Location: ../forms/login-signup.php");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!$dbc) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $checkQuery = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($dbc, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error_message'] = "Email is already in use!";
        header("Location: ../forms/login-signup.php");
        exit;
    }

    $insertQuery = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";
    $insertResult = mysqli_query($dbc, $insertQuery);

    if ($insertResult) {
        $_SESSION['success_message'] = "Registration successful! Redirecting to login...";
        header("Location: ../forms/login-signup.php");
        exit;
    } else {
        $_SESSION['error_message'] = "There was an error during registration. Please try again.";
        header("Location: ../forms/login-signup.php");
        exit;
    }
}
?>
