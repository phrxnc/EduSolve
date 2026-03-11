<?php
  include_once("../dbConnection/connect.php");
  session_start();

  if (!isset($_SESSION['id'])) {
      header("Location: ../index.php");
      exit();
  }

  $user_id = $_SESSION['id'];

  $required_subject = 'Math';
  $required_score = 30;

  $check_query = "
      SELECT score
      FROM scores
      WHERE user_id = $user_id 
        AND subject_id = (SELECT id FROM subjects WHERE name = '$required_subject')
  ";
  $check_result = mysqli_query($dbc, $check_query);
  if ($check_result && mysqli_num_rows($check_result) > 0) {
      $score = mysqli_fetch_assoc($check_result)['score'];
      if ($score < $required_score) {
          header("Location: ../index.php");
          exit();
      }
  } else {
      header("Location: ../index.php");
      exit();
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Final Quiz</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div id="display-container">
      <div class="header">
        <div class="number-of-count">
          <span class="number-of-questions"> 1 of 50 questions </span>
        </div>
        <div class="timer-div">
          <img src="timer-regular-24.png" alt="" width="20px" />
          <span class="time-left">10s</span>
        </div>
      </div>
      <div id="container">
        <!-- Questions -->
      </div>
      <button id="next-button">Next</button>
    </div>

    <div class="score-container hide">
      <div id="user-score">Demo Score</div>
      <div>
        <a href="../index.php"><button style="padding: 20px; background-color: #1d2630; color: white; margin-right: 20px;" id="backA">Back</button></a>
        <button id="restart" style="padding: 20px; background-color: #1d2630; color: white;">Try again</button>
      </div>
    </div>


    <script>
        const userId = <?php echo json_encode($_SESSION['id']); ?>;
    </script>
    <script src="ReadingFinalQuiz.js"></script>
  </body>
</html>
