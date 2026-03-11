<?php
include_once("../dbConnection/connect.php");
session_start();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user_id from session
        $user_id = $_SESSION['id'] ?? null;
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User is not logged in.']);
            exit;
        }

        // Get the data from the request
        $data = json_decode(file_get_contents('php://input'), true);
        $score = $data['score'] ?? null;
        $subject_id = $data['subject_id'] ?? null;

        if (is_numeric($score) && is_numeric($subject_id)) {
            // Validate that subject exists
            $subjectExistsQuery = "SELECT COUNT(*) FROM subjects WHERE id = $subject_id";
            $subjectExistsResult = mysqli_query($dbc, $subjectExistsQuery);
            $subjectExists = mysqli_fetch_row($subjectExistsResult)[0];

            if ($subjectExists) {
                $scoreExistsQuery = "SELECT COUNT(*) FROM scores WHERE user_id = $user_id AND subject_id = $subject_id";
                $scoreExistsResult = mysqli_query($dbc, $scoreExistsQuery);
                $scoreExists = mysqli_fetch_row($scoreExistsResult)[0];

                if ($scoreExists) {
                    $updateQuery = "UPDATE scores SET score = '$score' WHERE user_id = '$user_id' AND subject_id = '$subject_id'";
                    if (mysqli_query($dbc, $updateQuery)) {
                        echo json_encode(['success' => true, 'message' => 'Score updated successfully.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to update score.']);
                    }
                } else {
                    $insertQuery = "INSERT INTO scores (user_id, subject_id, score) VALUES ('$user_id', '$subject_id', '$score')";
                    if (mysqli_query($dbc, $insertQuery)) {
                        echo json_encode(['success' => true, 'message' => 'Score saved successfully.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to save score.']);
                    }
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid subject ID.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid score or subject ID.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>