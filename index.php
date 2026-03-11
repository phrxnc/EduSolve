<?php
include_once("dbConnection/connect.php");
session_start();
$isLoggedIn = isset($_SESSION['id']);

if ($isLoggedIn) {
    $user_id = $_SESSION['id'];
    $query = "SELECT username, role, profile_pic, email FROM users WHERE id = $user_id";
    $result = mysqli_query($dbc, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $user_role = $user['role'];

        $profile_pic = $user['profile_pic'] ?? 'uploads/profile_pics/default.jpg';
        $email = $user['email'] ?? '';
    } else {
        $user_role = 'guest';
        $user = ['username' => 'Guest'];
        $profile_pic = 'uploads/profile_pics/default.jpg';
        $email = ''; 
    }
} else {
    header("Location: forms/login-signup.php");
    exit();
}

// if ($user_role === 'superadmin') {
//     $scores_query = "
//         SELECT u.username, u.email, sub.name AS subject_name, s.score
//         FROM users u
//         JOIN scores s ON u.id = s.user_id
//         JOIN subjects sub ON s.subject_id = sub.id
//         ORDER BY u.username, sub.name
//     ";
// } else {
//     $scores_query = "
//         SELECT u.username, sub.name AS subject_name, s.score
//         FROM users u
//         JOIN scores s ON u.id = s.user_id
//         JOIN subjects sub ON s.subject_id = sub.id
//         WHERE u.id = $user_id
//         ORDER BY sub.name
//     ";
// }
if ($user_role === 'superadmin') {
    $scores_query = "
    SELECT 
        u.id AS user_id, 
        u.username, 
        u.email, 
        sub.name AS subject_name, 
        s.score, 
        s.subject_id
    FROM 
        users u
    JOIN 
        scores s ON u.id = s.user_id
    JOIN 
        subjects sub ON s.subject_id = sub.id
    ORDER BY 
        u.username, sub.name
    ";
} else {
    $scores_query = "
        SELECT u.id AS user_id, u.username, sub.name AS subject_name, s.score
        FROM users u
        JOIN scores s ON u.id = s.user_id
        JOIN subjects sub ON s.subject_id = sub.id
        WHERE u.id = $user_id
        ORDER BY sub.name
    ";
}

$scores_result = mysqli_query($dbc, $scores_query);


function getCurrentUnlockedLesson($user_id, $dbc) {
    $lessons_query = "SELECT l.id, l.name, l.passing_score, ls.score, s.name AS subject
                      FROM lessons l
                      LEFT JOIN lesson_scores ls ON l.id = ls.lesson_id AND ls.user_id = $user_id
                      LEFT JOIN subjects s ON l.subject_id = s.id
                      ORDER BY l.id";
    
    $lessons_result = mysqli_query($dbc, $lessons_query);
    
    if ($lessons_result) {
        while ($lesson = mysqli_fetch_assoc($lessons_result)) {
            if (is_null($lesson['score'])) {
                return $lesson;
            } elseif ($lesson['score'] < $lesson['passing_score']) {
                return $lesson; 
            }
        }
    }
    return null;
}

$currentLesson = null;
if ($user_role === 'student') {
    $currentLesson = getCurrentUnlockedLesson($user_id, $dbc);
}


// UNLOCK AND LOCK
$isMathLocked = ($user_role == 'student' && !isset($scores['Math']));
$isReadingLocked = ($user_role == 'student' && !isset($scores['Reading']));

if ($user_role === 'student') {

    $science_passing_score_query = "SELECT passing_score FROM subjects WHERE name = 'Science'";
    $math_passing_score_query = "SELECT passing_score FROM subjects WHERE name = 'Math'";
    $reading_passing_score_query = "SELECT passing_score FROM subjects WHERE name = 'English'";

    $science_passing_score_result = mysqli_query($dbc, $science_passing_score_query);
    $math_passing_score_result = mysqli_query($dbc, $math_passing_score_query);
    $reading_passing_score_result = mysqli_query($dbc, $reading_passing_score_query);

    $science_score_query = "SELECT score FROM scores WHERE user_id = $user_id AND subject_id = (SELECT id FROM subjects WHERE name = 'Science')";
    $math_score_query = "SELECT score FROM scores WHERE user_id = $user_id AND subject_id = (SELECT id FROM subjects WHERE name = 'Math')";
    $reading_score_query = "SELECT score FROM scores WHERE user_id = $user_id AND subject_id = (SELECT id FROM subjects WHERE name = 'English')";

    $science_score_result = mysqli_query($dbc, $science_score_query);
    $math_score_result = mysqli_query($dbc, $math_score_query);
    $reading_score_result = mysqli_query($dbc, $reading_score_query); 


    if ($science_passing_score_result && mysqli_num_rows($science_passing_score_result) > 0) {
        $science_passing_score = mysqli_fetch_assoc($science_passing_score_result)['passing_score'];

        if ($science_score_result && mysqli_num_rows($science_score_result) > 0) {
            $science_score = mysqli_fetch_assoc($science_score_result)['score'];
            if ($science_score >= $science_passing_score) {
                $isMathLocked = false;  // UNLOCK MATH IF >= passing score for Science
            }
        }
    }

    if ($math_passing_score_result && mysqli_num_rows($math_passing_score_result) > 0) {
        $math_passing_score = mysqli_fetch_assoc($math_passing_score_result)['passing_score'];

        if ($math_score_result && mysqli_num_rows($math_score_result) > 0) {
            $math_score = mysqli_fetch_assoc($math_score_result)['score'];
            if ($math_score >= $math_passing_score) {
                $isReadingLocked = false; // UNLOCK READING IF >= passing score for Math
            }
        }
    }

    if ($reading_passing_score_result && mysqli_num_rows($reading_passing_score_result) > 0) {
        $reading_passing_score = mysqli_fetch_assoc($reading_passing_score_result)['passing_score'];

        if ($reading_score_result && mysqli_num_rows($reading_score_result) > 0) {
            $reading_score = mysqli_fetch_assoc($reading_score_result)['score'];
            if ($reading_score >= $reading_passing_score) {
                $isReadingLocked = false;
            }
        }
    }
}

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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a3e3c36fea.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="style/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="style/home-page.css">
    <title>Home</title>
</head>
<body>
<div class="container">
        <nav>
            <a href="index.php">
                <div class="title-logo">
                    <img src="img/Education.png" alt="Gradpic">
                    <h2>EduSolve</h2>
                </div>
            </a>
            <div class="clickables">
                <div class="courses">
                    <a href="#">
                    <i class="fa-solid fa-c"></i>
                    <p>Courses</p>
                    </a>
                </div>
                
               
                <?php if ($user_role === 'superadmin'): ?>
                    <div class="students">
                        <a href="#">
                            <i class="fa-regular fa-user"></i>
                            <p>Students</p>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="support">
                    <a href="#">
                    <i class="fa-regular fa-circle-question"></i>
                    <p>Support</p>
                    </a>
                </div>
                
                <div class="settings">
                    <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings</p>
                    </a>
                </div>
            </div>
        </nav>
        <main>
        <header>
            <div class="users">
                <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
                <p>
                    <?php 
                    if ($isLoggedIn) { 
                        $query = "SELECT username, email, role FROM users WHERE id = $user_id"; 
                        $result = mysqli_query($dbc, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $user = mysqli_fetch_assoc($result);
                            echo $user['username'] . " (" . ucfirst($user['role']) . ")";
                        } else {
                            echo "User not found";
                        }
                    } else {
                        echo "Guest";
                    }
                    ?>
                </p>
            </div>
            <div class="flex-items">
                <!-- <input type="search" placeholder="Search"> -->
                <a href="functions/logout.php">Logout</a>
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
        </header>

        <?php if ($user_role === 'superadmin'): ?> 
            <div class="Course-Manage">
                <h2>Courses</h2>
                <a href="#">Manage</a>
            </div>
        <?php endif; ?>


            <form action="">
                <input type="text" placeholder="Basic Information">
                <div class="Ctitle">
                    <h4>Course Title</h4>
                    <input type="text" placeholder="Enter">
                </div>
                <div class="Cdesc">
                    <h4>Course Description</h4>
                    <textarea name="description" cols="70" rows="10"></textarea>
                </div>
                <div class="Ccontent">
                    <h4>Course Content</h4>
                    <input type="file">
                </div>
                <button class="btn btn-primary btn-sm">Submit</button>
            </form>
            
            <span id="support">
                <h1>Support</h1>
                <div class="support-p">
                    <h2>Welcome to EduSolve Support</h2>
                    <p>Contact us, let us know how we can help you</p>
                </div>
                <h2>Need help? We got your back</h2>
                <div class="support-boxes">
                    <a href="WEBDEV DOCUMENTATION.pdf" target="_blank" class="box-link"> 
                        <div class="box box-1">
                            <i class="bx bx-file"></i>
                            <h3>Getting Started</h3>
                            <small>Documentation for EduSolve!</small>
                        </div>
                    </a>
                    <a href="forms/faq.php" class="box-link">
                        <div class="box box-2">
                            <i class="bx bx-question-mark"></i>
                            <h3>F.A.Q.</h3>
                            <small>Frequently Asked Questions.</small>
                        </div>
                    </a>
                    <a href="#" class="box-link" id="account-settings-link">
                        <div class="box box-3">
                            <i class="bx bx-user-circle"></i>
                            <h3>Account Settings</h3>
                            <small>Settings for your account.</small>
                        </div>
                    </a>
                </div>
            </span>
            
           
            <div id="settings-section" class="settings-container" style="display: none;">
                <h2>Settings</h2>
                <form id="profile-form" action="functions/settings.php" method="POST" enctype="multipart/form-data">
                    <div class="profile-pic">
                        <img id="user-img" src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
                        
                    </div>

                    <div class="profile-actions">
                  
                
                    <input type="file" name="profile_pic" id="profile-pic" accept="image/*" onchange="previewImage(event)" />
                    
                    <label class="reset-label">
                        <input type="checkbox" name="reset_profile_pic" id="reset-profile-pic"> Clear
                    </label>
                </div>

                    <div class="username-update">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter new username" value="<?php echo htmlspecialchars($user['username']); ?>">
                    </div>

                    <div class="email-update">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter new email" 
                            value="<?php echo htmlspecialchars($user['email']); ?>" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                            >
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>




            <div id="student-list-section" class="students-container">
                <h2>Students</h2>
                <div class="filter-section">
                <!-- <div>
                    <a href="#" onclick="sortByName()">Name &#9650;</a>
                    <a href="#" onclick="sortByScore()">Score &#9650;</a>
                </div> -->
                </div>
                <table class="student-list">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Final Quiz Scores</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $displayed_users = [];

        if ($scores_result && mysqli_num_rows($scores_result) > 0) {
            while ($score = mysqli_fetch_assoc($scores_result)) {
                $user_id = isset($score['user_id']) ? $score['user_id'] : null;

                if ($user_id !== null) {
                    if (!in_array($user_id, $displayed_users)) {
                        echo "
                        <tr>
                            <td>{$score['username']}</td>
                            <td>{$score['email']}</td>
                            <td>{$score['subject_name']}</td>
                            <td>{$score['score']}/50</td>
                            <td>
                                <!-- Display the score by default -->
                                <span id='score-display-{$user_id}-{$score['subject_id']}'>
                                    {$score['score']}/50
                                </span>
                                
                                <!-- The input for score is hidden initially -->
                                <input type='number' 
                                    class='score-input' 
                                    id='score-input-{$user_id}-{$score['subject_id']}' 
                                    value='{$score['score']}' 
                                    min='0' max='50' 
                                    style='display: none; width: 60px;'>
                            </td>
                            <td>
                                <!-- Edit button to toggle editing -->
                                <button onclick=\"makeScoreEditable({$user_id}, {$score['subject_id']})\" 
                                        class='btn-edit' id='edit-btn-{$user_id}-{$score['subject_id']}'>
                                    Edit Score
                                </button>
                                <!-- Save button, hidden by default -->
                                <button onclick=\"saveScore({$user_id}, {$score['subject_id']})\" 
                                        class='btn-save' id='save-btn-{$user_id}-{$score['subject_id']}' 
                                        style='display: none;'>Save Score</button>
                            </td>
                            <td>
                                <!-- Only show delete button once per user -->
                                <form method='post' action='functions/delete_students.php' style='display: inline-block;' onsubmit=\"return confirm('Are you sure you want to delete this student?');\">
                                    <input type='hidden' name='id' value='" . htmlspecialchars($user_id) . "'>
                                    <button type='submit'>Delete User</button>
                                </form>
                            </td>
                        </tr>";

                        $displayed_users[] = $user_id;
                    } else {
                        echo "
                        <tr>
                            <td>{$score['username']}</td>
                            <td>{$score['email']}</td>
                            <td>{$score['subject_name']}</td>
                            <td>{$score['score']}/50</td>
                            <td>
                                <!-- Display the score by default -->
                                <span id='score-display-{$user_id}-{$score['subject_id']}'>
                                    {$score['score']}/50
                                </span>
                                
                                <!-- The input for score is hidden initially -->
                                <input type='number' 
                                    class='score-input' 
                                    id='score-input-{$user_id}-{$score['subject_id']}' 
                                    value='{$score['score']}' 
                                    min='0' max='50' 
                                    style='display: none; width: 60px;'>
                            </td>
                            <td>
                                <!-- Edit button to toggle editing -->
                                <button onclick=\"makeScoreEditable({$user_id}, {$score['subject_id']})\" 
                                        class='btn-edit' id='edit-btn-{$user_id}-{$score['subject_id']}'>
                                    Edit Score
                                </button>
                                <!-- Save button, hidden by default -->
                                <button onclick=\"saveScore({$user_id}, {$score['subject_id']})\" 
                                        class='btn-save' id='save-btn-{$user_id}-{$score['subject_id']}' 
                                        style='display: none;'>Save Score</button>
                            </td>
                            <td>
                                <!-- No delete button for subsequent rows of the same user -->
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Error: User ID is missing</td></tr>";
                }
            }
        } else {
            echo "<tr><td colspan='5'>No scores available</td></tr>";
        }
        ?>
    </tbody>
</table>
            </div>

            <div class="options">
                <?php if ($user_role !== 'superadmin'): ?>
                    <a href="#" class="filter-link active" data-filter="all">All</a>
                    <a href="#" class="filter-link" data-filter="current">Current</a>
                    <a href="#" class="filter-link" data-filter="pending">Pending</a>
                    <a href="#" class="filter-link" data-filter="completed">Completed</a>
                <?php endif; ?>
            </div>                
            
            <div class="subs">
                <div class="Science subject <?php echo $isScienceLocked ? 'locked' : ($science_score >= $science_passing_score ? 'completed' : ''); ?>" data-category="current">
                    <div class="Science-logo">
                        <i class="fa-solid fa-flask fa-2xl"></i>
                    </div>
                    <p>Science</p>
                </div>
            
                <div class="modules">
                    <div class="module <?php echo $lockedLessons['Science'][1] ? 'locked' : ''; ?>">
                        <h3 class="module-number">1</h3>
                        <a href="Modules/Biology.php" class="module-name hvr-grow"><h3 style="margin: 0;">Biology</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Science'][2]) ? 'locked' : ''; ?>">
                    <h3 class="module-number">2</h3>
                        <a href="Modules/Chemistry.php" class="module-name hvr-grow"><h3 style="margin: 0;">Chemistry</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Science'][3]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">3</h3>
                        <a href="Modules/Physics.php" class="module-name hvr-grow"><h3 style="margin: 0;">Physics</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Science'][4]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">4</h3>
                        <a href="Modules/Earth.php" class="module-name hvr-grow"><h3 style="margin: 0;">Earth</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Science'][5]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">5</h3>
                        <a href="Modules/Space.php" class="module-name hvr-grow"><h3 style="margin: 0;">Space</h3></a>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                        <?php if ($user_role !== 'superadmin'): ?>
                            <?php 
                            $subject = 'Science';
                            $finalQuizPassed = false;

                            $science_passing_score_query = "SELECT passing_score FROM subjects WHERE name = '$subject'";
                            $science_passing_score_result = mysqli_query($dbc, $science_passing_score_query);

                            if ($science_passing_score_result && mysqli_num_rows($science_passing_score_result) > 0) {
                                $science_passing_score = mysqli_fetch_assoc($science_passing_score_result)['passing_score'];

                                $science_score_query = "
                                    SELECT score 
                                    FROM scores 
                                    WHERE user_id = $user_id 
                                    AND subject_id = (SELECT id FROM subjects WHERE name = '$subject')
                                ";
                                $science_score_result = mysqli_query($dbc, $science_score_query);

                                if ($science_score_result && mysqli_num_rows($science_score_result) > 0) {
                                    $user_score = mysqli_fetch_assoc($science_score_result)['score'];
                                    $finalQuizPassed = $user_score >= $science_passing_score;
                                }
                            }

                            if (isset($finalQuizLocked['Science']) && $finalQuizLocked['Science']): ?>
                                <button id="backbuts" style="padding: 20px; background-color: #d3d3d3; color: #a9a9a9; border-radius: 10px; border-style: none; cursor: not-allowed;" disabled>
                                    Final Test
                                </button>
                            <?php elseif (!$finalQuizPassed): ?>
                                <a href="Quiz/Science.php">
                                    <button id="backbuts" style="padding: 20px; background-color: #1d2630; color: white; border-radius: 10px; border-style: none; cursor: pointer;">
                                        Final Test
                                    </button>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                  
                <div class="Math subject <?php echo $isMathLocked ? 'locked' : ($math_score >= $math_passing_score ? 'completed' : ''); ?>" data-category="current">
                    <div class="Math-logo">
                        <i class="fa-solid fa-calculator fa-2xl"></i>
                    </div>
                    <p>Math</p>
                </div>
                
                <div class="modules">
                    <div class="module <?php echo $lockedLessons['Math'][6] ? 'locked' : ''; ?>">
                        <h3 class="module-number">1</h3>
                        <a href="Modules/Number Theory.php" class="module-name hvr-grow"><h3 style="margin: 0;">Number Theory</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Math'][7]) ? 'locked' : ''; ?>">
                    <h3 class="module-number">2</h3>
                        <a href="Modules/Algebra.php" class="module-name hvr-grow"><h3 style="margin: 0;">Algebra</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Math'][8]) ? 'locked' : ''; ?>">
                    <h3 class="module-number">3</h3>
                        <a href="Modules/Geometry.php" class="module-name hvr-grow"><h3 style="margin: 0;">Geometry</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Math'][9]) ? 'locked' : ''; ?>">
                    <h3 class="module-number">4</h3>
                        <a href="Modules/Trigonometry.php" class="module-name hvr-grow"><h3 style="margin: 0;">Trigonometry</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Math'][10]) ? 'locked' : ''; ?>">
                    <h3 class="module-number">5</h3>
                        <a href="Modules/Probability.php" class="module-name hvr-grow"><h3 style="margin: 0;">Probability</h3></a>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                        <?php if ($user_role !== 'superadmin'): ?>
                            <?php 
                            $subject = 'Math';
                            $finalQuizPassed = false;

                            $math_passing_score_query = "SELECT passing_score FROM subjects WHERE name = '$subject'";
                            $math_passing_score_result = mysqli_query($dbc, $math_passing_score_query);

                            if ($math_passing_score_result && mysqli_num_rows($math_passing_score_result) > 0) {
                                $math_passing_score = mysqli_fetch_assoc($math_passing_score_result)['passing_score'];

                                $math_score_query = "
                                    SELECT score 
                                    FROM scores 
                                    WHERE user_id = $user_id 
                                    AND subject_id = (SELECT id FROM subjects WHERE name = '$subject')
                                ";
                                $math_score_result = mysqli_query($dbc, $math_score_query);

                                if ($math_score_result && mysqli_num_rows($math_score_result) > 0) {
                                    $user_score = mysqli_fetch_assoc($math_score_result)['score'];
                                    $finalQuizPassed = $user_score >= $math_passing_score;
                                }
                            }
                            
                            if (isset($finalQuizLocked['Math']) && $finalQuizLocked['Math']): ?>
                                <button id="backbuts" style="padding: 20px; background-color: #d3d3d3; color: #a9a9a9; border-radius: 10px; border-style: none; cursor: not-allowed;" disabled>
                                    Final Test
                                </button>
                            <?php elseif (!$finalQuizPassed): ?>
                                <a href="Quiz/MathFinalQuiz.php">
                                    <button id="backbuts" style="padding: 20px; background-color: #1d2630; color: white; border-radius: 10px; border-style: none; cursor: pointer;">
                                        Final Test
                                    </button>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="Reading subject <?php echo $isReadingLocked ? 'locked' : ($reading_score >= $reading_passing_score ? 'completed' : ''); ?>" data-category="current">
                    <div class="Reading-logo">
                        <i class="fa-solid fa-book fa-2xl"></i>
                    </div>
                    <p>Reading</p>
                </div>

                <div class="modules">
                    <div class="module <?php echo $lockedLessons['Reading'][11] ? 'locked' : ''; ?>">
                        <h3 class="module-number">1</h3>
                        <a href="Modules/Vocabulary.php" class="module-name hvr-grow"><h3 style="margin: 0;">Vocabulary</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Reading'][12]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">2</h3>
                        <a href="Modules/Grammar & Punctuation.php" class="module-name hvr-grow"><h3 style="margin: 0;">Grammar & Punctuation</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Reading'][13]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">3</h3>
                        <a href="Modules/Reading Comprehension.php" class="module-name hvr-grow"><h3 style="margin: 0;">Reading Comprehension</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Reading'][14]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">4</h3>
                        <a href="Modules/LiteraryDevice.php" class="module-name hvr-grow"><h3 style="margin: 0;">Literary Devices</h3></a>
                    </div>
                    <div class="module <?php echo ($user_role !== 'superadmin' && $lockedLessons['Reading'][15]) ? 'locked' : ''; ?>">
                        <h3 class="module-number">5</h3>
                        <a href="Modules/Literature.php" class="module-name hvr-grow"><h3 style="margin: 0;">Literature</h3></a>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                        <?php if ($user_role !== 'superadmin'): ?>
                            <?php 
                                $subject = 'English';
                                $finalQuizPassed = false;

                                $reading_passing_score_query = "SELECT passing_score FROM subjects WHERE name = '$subject'";
                                $reading_passing_score_result = mysqli_query($dbc, $reading_passing_score_query);

                                if ($reading_passing_score_result && mysqli_num_rows($reading_passing_score_result) > 0) {
                                    $reading_passing_score = mysqli_fetch_assoc($reading_passing_score_result)['passing_score'];

                                    $reading_score_query = "
                                        SELECT score 
                                        FROM scores 
                                        WHERE user_id = $user_id 
                                        AND subject_id = (SELECT id FROM subjects WHERE name = '$subject')
                                    ";
                                    $reading_score_result = mysqli_query($dbc, $reading_score_query);

                                    if ($reading_score_result && mysqli_num_rows($reading_score_result) > 0) {
                                        $user_score = mysqli_fetch_assoc($reading_score_result)['score'];
                                        $finalQuizPassed = $user_score >= $reading_passing_score;
                                    }
                                }
                                
                                if (isset($finalQuizLocked['Reading']) && $finalQuizLocked['Reading']): ?>
                                    <button id="backbuts" style="padding: 20px; background-color: #d3d3d3; color: #a9a9a9; border-radius: 10px; border-style: none; cursor: not-allowed;" disabled>
                                        Final Test
                                    </button>
                                <?php elseif (!$finalQuizPassed): ?>
                                    <a href="Quiz/ReadingFinalQuiz.php">
                                        <button id="backbuts" style="padding: 20px; background-color: #1d2630; color: white; border-radius: 10px; border-style: none; cursor: pointer;">
                                            Final Test
                                        </button>
                                    </a>
                                <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </main>
            <div class="right-sidebar">
                <aside>
        
                <?php if ($user_role !== 'superadmin'): ?>
                    <h2 class="progress-title">Progress</h2>

                    <div class="progress-container">
                        <h3 class="up-next-title">Up-next</h3>
                        <?php if ($currentLesson): ?>
                            <div class="up-next-item">
                                <div class="icon">
                                    <?php 
                                        if ($currentLesson['subject'] == 'Science') {
                                            echo '<div class="progress-science-logo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M15 9.783V4h1V2H8v2h1v5.783l-4.268 9.389a1.992 1.992 0 0 0 .14 1.911A1.99 1.99 0 0 0 6.553 22h10.895a1.99 1.99 0 0 0 1.681-.917c.37-.574.423-1.289.14-1.911L15 9.783zm-4.09.631c.06-.13.09-.271.09-.414V4h2v6c0 .143.03.284.09.414L15.177 15H8.825l2.085-4.586z"></path></svg>
                                                </div>';
                                        } elseif ($currentLesson['subject'] == 'Math') {
                                            echo '<div class="progress-math-logo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M6 22h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm3-3H7v-2h2v2zm0-4H7v-2h2v2zm0-4H7V9h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm4 8h-2v-6h2v6zm0-8h-2V9h2v2zM6 4h12v3H6V4z"></path></svg>
                                                </div>';
                                        } elseif ($currentLesson['subject'] == 'English') {
                                            echo '<div class="progress-reading-logo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M6 22h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1H21V4c0-1.103-.897-2-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3zM5 8V5c0-.805.55-.988 1-1h13v12H5V8z"></path><path d="M8 6h9v2H8z"></path></svg>
                                                </div>';
                                        } else {
                                            echo '<i class="fa-solid fa-question-circle fa-2xl"></i>'; 
                                        }
                                    ?>
                                </div>
                                <p class="subject">
                                    <a href="Modules/<?php echo ucfirst(strtolower($currentLesson['name'])); ?>.php">
                                        <?php echo htmlspecialchars($currentLesson['name']); ?>
                                    </a>
                                </p>
                            </div>
                        <?php else: ?>
                            <p style="color: white;">No upcoming lessons available.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                        
                <?php
                    include 'functions/progress_bar.php';

                    if ($user_role === 'student'):
                        echo '<div class="progress-bar-container">';
                        
                        echo '<p>Science</p>';
                        echo '<div class="progress">';
                            echo '<div class="progress-bar-wrapper">';
                                echo '<div class="progress-bar" style="width: ' . $science_progress . '%"></div>';
                                echo '<span class="progress-percent">' . round($science_progress) . '%</span>';
                            echo '</div>';
                        echo '</div>';

                        echo '<p>Math</p>';
                            echo '<div class="progress">';
                                echo '<div class="progress-bar-wrapper">';
                                    echo '<div class="progress-bar" style="width: ' . $math_progress . '%"></div>';
                                echo '<span class="progress-percent">' . round($math_progress) . '%</span>';
                            echo '</div>';
                        echo '</div>';

                        echo '<p>Reading</p>';
                        echo '<div class="progress">';
                            echo '<div class="progress-bar-wrapper">';
                                echo '<div class="progress-bar" style="width: ' . $reading_progress . '%"></div>';
                                echo '<span class="progress-percent">' . round($reading_progress) . '%</span>';
                            echo '</div>';
                        echo '</div>';

                        echo '</div>';
                    endif;
                ?>
            </aside>
        </div>
</div>
    <script>
    var userRole = "<?php echo $user_role; ?>";
    </script>
    <script>
    const students = <?php echo json_encode($students); ?>;
    </script>
   
</div>

<script>
function makeScoreEditable(userId, subjectId) {
    document.getElementById(`score-display-${userId}-${subjectId}`).style.display = 'none';
    document.getElementById(`edit-btn-${userId}-${subjectId}`).style.display = 'none';

    document.getElementById(`score-input-${userId}-${subjectId}`).style.display = 'inline-block';
    document.getElementById(`save-btn-${userId}-${subjectId}`).style.display = 'inline-block';
}

function saveScore(userId, subjectId) {
    const newScore = document.getElementById(`score-input-${userId}-${subjectId}`).value;

    if (newScore < 0 || newScore > 50) {
        alert('Please enter a score between 0 and 50.');
        return;
    }

    fetch('functions/edit_scores.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${userId}&subject_id=${subjectId}&new_score=${newScore}`,
    })
        .then(response => response.text())
        .then(result => {
            document.getElementById(`score-input-${userId}-${subjectId}`).style.display = 'none';
            document.getElementById(`save-btn-${userId}-${subjectId}`).style.display = 'none';

            document.getElementById(`score-display-${userId}-${subjectId}`).textContent = `${newScore}/50`;
            document.getElementById(`score-display-${userId}-${subjectId}`).style.display = 'none';

            document.getElementById(`edit-btn-${userId}-${subjectId}`).style.display = 'inline-block';

            window.location.href = 'index.php';
        })
        .catch(error => {
            alert('Error updating score.');
            console.error(error);
        });
}
</script>

    <script src="javascript/subs.js"></script>
    <script src="javascript/manage.js"></script>
    <script src="javascript/students.js"></script>
    <script src="javascript/settings.js"></script>
    <script src="javascript/trans.js"></script>
</body>
</html>
