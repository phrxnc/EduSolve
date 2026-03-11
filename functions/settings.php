<?php
include_once("../dbConnection/connect.php");
session_start();

$isLoggedIn = isset($_SESSION['id']);
if (!$isLoggedIn) {
    header("Location: forms/login-signup.php");
    exit();
}

$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = mysqli_real_escape_string($dbc, $_POST['username']);
    if (!empty($new_username)) {
        $query = "UPDATE users SET username = '$new_username' WHERE id = $user_id";
        mysqli_query($dbc, $query);
    }

    $new_email = mysqli_real_escape_string($dbc, $_POST['email']);
    if (!empty($new_email)) {
        $query = "UPDATE users SET email = '$new_email' WHERE id = $user_id";
        mysqli_query($dbc, $query);
    }

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $file_name = basename($_FILES['profile_pic']['name']);
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $upload_dir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pics' . DIRECTORY_SEPARATOR;
        $file_path = $upload_dir . $file_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (copy($file_tmp, $file_path)) {
            $relative_path = 'uploads/profile_pics/' . $file_name;
            $query = "UPDATE users SET profile_pic = '$relative_path' WHERE id = $user_id";
            mysqli_query($dbc, $query);
        } else {
            error_log("File upload failed. Temp file: $file_tmp, Destination: $file_path");
        }
    }

    if (isset($_POST['reset_profile_pic'])) {
        $query = "UPDATE users SET profile_pic = NULL WHERE id = $user_id";
        mysqli_query($dbc, $query);
    }

    header("Location: ../index.php");
    exit();
}
?>
