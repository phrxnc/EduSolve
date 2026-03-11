<?php
include_once("../dbConnection/connect.php");

$lockedLessons = [
    'Science' => [1 => false, 2 => true, 3 => true, 4 => true, 5 => true],
    'Math' => [6 => false, 7 => true, 8 => true, 9 => true, 10 => true],
    'Reading' => [11 => false, 12 => true, 13 => true, 14 => true, 15 => true],
];

$finalQuizLocked = [
    'Science' => true,
    'Math' => true,
    'Reading' => true,
];

if ($user_role === 'student') {
    $biology_passing_score_query = "
        SELECT passing_score 
        FROM lessons 
        WHERE name = 'Biology' 
          AND subject_id = (SELECT id FROM subjects WHERE name = 'Science')
    ";
    $biology_passing_score_result = mysqli_query($dbc, $biology_passing_score_query);

    if ($biology_passing_score_result && mysqli_num_rows($biology_passing_score_result) > 0) {
        $biology_passing_score = mysqli_fetch_assoc($biology_passing_score_result)['passing_score'];
        
        $biology_score_query = "
            SELECT score 
            FROM lesson_scores 
            WHERE user_id = $user_id 
              AND lesson_id = (SELECT id FROM lessons WHERE name = 'Biology' AND subject_id = (SELECT id FROM subjects WHERE name = 'Science'))
        ";
        $biology_score_result = mysqli_query($dbc, $biology_score_query);

        if ($biology_score_result && mysqli_num_rows($biology_score_result) > 0) {
            $biology_score = mysqli_fetch_assoc($biology_score_result)['score'];
            if ($biology_score >= $biology_passing_score) {
                $lockedLessons['Science'][2] = false; 
            }
        }
    }

    for ($lesson = 2; $lesson <= 5; $lesson++) {
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
                if ($lesson_score >= $lesson_passing_score && $lesson < 5) {
                    $lockedLessons['Science'][$lesson + 1] = false;
                }

                if ($lesson == 5 && $lesson_score >= $lesson_passing_score) {
                    $finalQuizLocked['Science'] = false;  
                }
            }
        }
    }

    $math_lesson_1_passing_score_query = "
        SELECT passing_score 
        FROM lessons 
        WHERE name = 'Number Theory' 
        AND subject_id = (SELECT id FROM subjects WHERE name = 'Math')
    ";
    $math_lesson_1_passing_score_result = mysqli_query($dbc, $math_lesson_1_passing_score_query);

    if ($math_lesson_1_passing_score_result && mysqli_num_rows($math_lesson_1_passing_score_result) > 0) {
        $math_lesson_1_passing_score = mysqli_fetch_assoc($math_lesson_1_passing_score_result)['passing_score'];

        $math_lesson_1_score_query = "
            SELECT score 
            FROM lesson_scores 
            WHERE user_id = $user_id 
            AND lesson_id = (SELECT id FROM lessons WHERE name = 'Number Theory' AND subject_id = (SELECT id FROM subjects WHERE name = 'Math'))
        ";
        $math_lesson_1_score_result = mysqli_query($dbc, $math_lesson_1_score_query);

        if ($math_lesson_1_score_result && mysqli_num_rows($math_lesson_1_score_result) > 0) {
            $math_lesson_1_score = mysqli_fetch_assoc($math_lesson_1_score_result)['score'];
            if ($math_lesson_1_score >= $math_lesson_1_passing_score) {
                $lockedLessons['Math'][7] = false; 
            }
        }
    }


    for ($lesson = 7; $lesson <= 10; $lesson++) {
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
                if ($lesson_score >= $lesson_passing_score && $lesson < 10) {
                    $lockedLessons['Math'][$lesson + 1] = false; 
                }

                if ($lesson == 10 && $lesson_score >= $lesson_passing_score) {
                    $finalQuizLocked['Math'] = false; 
                }
            }
        }
    }

    $reading_lesson_1_passing_score_query = "
        SELECT passing_score 
        FROM lessons 
        WHERE name = 'Vocabulary' 
        AND subject_id = (SELECT id FROM subjects WHERE name = 'English')
    ";
    $reading_lesson_1_passing_score_result = mysqli_query($dbc, $reading_lesson_1_passing_score_query);

    if ($reading_lesson_1_passing_score_result && mysqli_num_rows($reading_lesson_1_passing_score_result) > 0) {
        $reading_lesson_1_passing_score = mysqli_fetch_assoc($reading_lesson_1_passing_score_result)['passing_score'];
    
        $reading_lesson_1_score_query = "
            SELECT score 
            FROM lesson_scores 
            WHERE user_id = $user_id 
            AND lesson_id = (SELECT id FROM lessons WHERE name = 'Vocabulary' AND subject_id = (SELECT id FROM subjects WHERE name = 'English'))
        ";
        $reading_lesson_1_score_result = mysqli_query($dbc, $reading_lesson_1_score_query);
    
        if ($reading_lesson_1_score_result && mysqli_num_rows($reading_lesson_1_score_result) > 0) {
            $reading_lesson_1_score = mysqli_fetch_assoc($reading_lesson_1_score_result)['score'];
            
            if ($reading_lesson_1_score >= $reading_lesson_1_passing_score) {
                $lockedLessons['Reading'][12] = false; 
            }
        }
    }

    for ($lesson = 12; $lesson <= 15; $lesson++) {
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
                if ($lesson_score >= $lesson_passing_score && $lesson < 15) {
                    $lockedLessons['Reading'][$lesson + 1] = false;
                }
                if ($lesson == 15 && $lesson_score >= $lesson_passing_score) {
                    $finalQuizLocked['Reading'] = false;
                }
            }
        }
    }
}

return [
    'lockedLessons' => $lockedLessons,
    'finalQuizLocked' => $finalQuizLocked,
];
?>