<?php
include_once("../dbConnection/connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'] ?? null;
    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'User is not logged in.']);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $score = $data['score'] ?? null;
    $lesson_id = $data['lesson_id'] ?? null;

    if (is_numeric($score) && is_numeric($lesson_id)) {
        $lessonExistsQuery = "SELECT COUNT(*) FROM lessons WHERE id = $lesson_id";
        $lessonExistsResult = mysqli_query($dbc, $lessonExistsQuery);
        $lessonExists = mysqli_fetch_row($lessonExistsResult)[0];

        if ($lessonExists) {
            // Check if the score for this lesson already exists
            $scoreExistsQuery = "SELECT COUNT(*) FROM lesson_scores WHERE user_id = $user_id AND lesson_id = $lesson_id";
            $scoreExistsResult = mysqli_query($dbc, $scoreExistsQuery);
            $scoreExists = mysqli_fetch_row($scoreExistsResult)[0];

            if ($scoreExists) {
                // Update the existing score
                $updateQuery = "UPDATE lesson_scores SET score = '$score' WHERE user_id = '$user_id' AND lesson_id = '$lesson_id'";
                if (mysqli_query($dbc, $updateQuery)) {
                    echo json_encode(['success' => true, 'message' => 'Score updated successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update score.']);
                }
            } else {
                // Insert a new score record
                $insertQuery = "INSERT INTO lesson_scores (user_id, lesson_id, score) VALUES ('$user_id', '$lesson_id', '$score')";
                if (mysqli_query($dbc, $insertQuery)) {
                    echo json_encode(['success' => true, 'message' => 'Score saved successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to save score.']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid lesson ID.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid score or lesson ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
