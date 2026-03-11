<?php
include_once("../dbConnection/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['subject_id'], $_POST['new_score'])) {
    $user_id = intval($_POST['user_id']);
    $subject_id = intval($_POST['subject_id']);
    $new_score = intval($_POST['new_score']);

    if ($new_score >= 0 && $new_score <= 50) {
        $update_query = "
            UPDATE scores 
            SET score = $new_score 
            WHERE user_id = $user_id AND subject_id = $subject_id
        ";

        if (mysqli_query($dbc, $update_query)) {
            echo "<script>
                    alert('Score updated successfully.');
                    window.location.href = '../index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating score: " . mysqli_error($dbc) . "');
                    window.location.href = '../index.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Invalid score value.');
                window.location.href = '../index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = '../index.php';
          </script>";
}
?>
