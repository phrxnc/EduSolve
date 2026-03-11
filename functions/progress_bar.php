<?php
if ($user_role === 'student') {
    $science_progress = 0;
    $math_progress = 0;
    $reading_progress = 0;

    $science_total_lessons = 5; 
    $science_unlocked_lessons = 0;
    for ($lesson = 1; $lesson <= $science_total_lessons; $lesson++) {
        $lesson_passing_score_query = "
            SELECT passing_score 
            FROM lessons 
            WHERE id = $lesson 
              AND subject_id = (SELECT id FROM subjects WHERE name = 'Science')
        ";
        $lesson_passing_score_result = mysqli_query($dbc, $lesson_passing_score_query);
        
        if ($lesson_passing_score_result && mysqli_num_rows($lesson_passing_score_result) > 0) {
            $lesson_passing_score = mysqli_fetch_assoc($lesson_passing_score_result)['passing_score'];

            $lesson_score_query = "
                SELECT score 
                FROM lesson_scores 
                WHERE user_id = $user_id 
                  AND lesson_id = $lesson
            ";
            $lesson_score_result = mysqli_query($dbc, $lesson_score_query);

            if ($lesson_score_result && mysqli_num_rows($lesson_score_result) > 0) {
                $lesson_score = mysqli_fetch_assoc($lesson_score_result)['score'];
                if ($lesson_score >= $lesson_passing_score) {
                    $science_unlocked_lessons++;
                }
            }
        }
    }
    $science_progress = ($science_unlocked_lessons / $science_total_lessons) * 100;

    $math_total_lessons = 5; 
    $math_unlocked_lessons = 0;
    for ($lesson = 6; $lesson <= 10; $lesson++) {
        $lesson_passing_score_query = "
            SELECT passing_score 
            FROM lessons 
            WHERE id = $lesson 
              AND subject_id = (SELECT id FROM subjects WHERE name = 'Math')
        ";
        $lesson_passing_score_result = mysqli_query($dbc, $lesson_passing_score_query);
        
        if ($lesson_passing_score_result && mysqli_num_rows($lesson_passing_score_result) > 0) {
            $lesson_passing_score = mysqli_fetch_assoc($lesson_passing_score_result)['passing_score'];

            $lesson_score_query = "
                SELECT score 
                FROM lesson_scores 
                WHERE user_id = $user_id 
                  AND lesson_id = $lesson
            ";
            $lesson_score_result = mysqli_query($dbc, $lesson_score_query);

            if ($lesson_score_result && mysqli_num_rows($lesson_score_result) > 0) {
                $lesson_score = mysqli_fetch_assoc($lesson_score_result)['score'];
                if ($lesson_score >= $lesson_passing_score) {
                    $math_unlocked_lessons++;
                }
            }
        }
    }
    $math_progress = ($math_unlocked_lessons / $math_total_lessons) * 100;

    $reading_total_lessons = 5; 
    $reading_unlocked_lessons = 0;
    for ($lesson = 11; $lesson <= 15; $lesson++) {
        $lesson_passing_score_query = "
            SELECT passing_score 
            FROM lessons 
            WHERE id = $lesson 
              AND subject_id = (SELECT id FROM subjects WHERE name = 'English')
        ";
        $lesson_passing_score_result = mysqli_query($dbc, $lesson_passing_score_query);
        
        if ($lesson_passing_score_result && mysqli_num_rows($lesson_passing_score_result) > 0) {
            $lesson_passing_score = mysqli_fetch_assoc($lesson_passing_score_result)['passing_score'];

            $lesson_score_query = "
                SELECT score 
                FROM lesson_scores 
                WHERE user_id = $user_id 
                  AND lesson_id = $lesson
            ";
            $lesson_score_result = mysqli_query($dbc, $lesson_score_query);

            if ($lesson_score_result && mysqli_num_rows($lesson_score_result) > 0) {
                $lesson_score = mysqli_fetch_assoc($lesson_score_result)['score'];
                if ($lesson_score >= $lesson_passing_score) {
                    $reading_unlocked_lessons++;
                }
            }
        }
    }
    $reading_progress = ($reading_unlocked_lessons / $reading_total_lessons) * 100;
}
