<?php
session_start();

if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="../style/first-page.css">
    <title>Welcome to EduSolve!</title>
</head>
<body>
    <header>
        <div class="title-logo">
            <img src="../img/Education.png" alt="Gradpic">
            <h2>EduSolve</h2> 
        </div>
        <div class="Hposition">
            <div class="courses">
                <img src="../img/Courses.png" alt="courses-icon">
                <h6>Courses</h6>
            </div>
            <div class="students">
                <img src="../img/graduation.svg" alt="courses-icon">
                <h6>Students</h6>
            </div>
            <div class="support">
                <img src="../img/Support.png" alt="courses-icon">
                <h6>Support</h6>
            </div>
            <div class="buttons">
                <button class="btn btn-dark Sign-up">Sign up</button>
                <button class="Log-in">Log in</button>
            </div>
        </div>
    </header>
    <main>
        <div class="texts">
            <h1>Elevate</h1>
            <h1>Learning!</h1>
            <p>Bridging the gap between challenges and solutions in learning.</p>
            <button id="get-started" class="btn btn-dark">Get Started</button>
        </div>
        <div>
            <img src="../img/studynig.png" alt="man studying">
        </div>
    </main>

    <div id="Login-overlay" class="overlay" style="display: <?= $error_message ? 'flex' : 'none'; ?>;">
        <div class="overlay-content">
            <span id="Loginclose" class="close">&times;</span>
            <form action="../functions/login.php" method="POST">
                <h4>Log in</h4>
                <?php if ($error_message): ?>
                    <div class="error-message" style="color: red;"><?= $error_message; ?></div>
                <?php endif; ?>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn btn-dark">Log in</button>
                <p>Don't have an account? <a href="#" style="color: black"><b>Register</b></a></p>
            </form>
        </div>
    </div>

    <div id="Signup-overlay" class="overlay">
        <div class="overlay-content">
            <span id="Signupclose" class="close">&times;</span>
            <form action="../functions/signup.php" method="POST">
                <h4>Sign up</h4>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="email" id="email" name="email" placeholder="Email" required> 
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                <div class="roles" style="display: flex; justify-content: end; width: 350px; margin: 15px;">
                    <select name="role" required>
                        <option value="student">Student</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark">Sign up</button>
                <p>Already have an account? <a href="#" style="color: black"><b>Log in</b></a></p>
            </form>
        </div>
    </div>

    <footer>
        <div>
            <img src="img/icon.png" alt="">
        </div>
        <div>  
            <a href="#">Terms & Conditions</a>
            <a href="#">Privacy Policy</a>
        </div>
    </footer>
</body>
<script src="../javascript/Login.js"></script>
<script src="../javascript/Signup.js"></script>
</html>
