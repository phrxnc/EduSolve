<?php
session_start(); 
include_once("../dbConnection/connect.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../forms/login-signup.php");
    exit();
}

$user_id = $_SESSION['id'];
$query = "SELECT username, role FROM users WHERE id = ?";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $user_role = $user['role'];
} else {
    header("Location: ../forms/login-signup.php");
    exit();
}

$isStudent = $user_role === 'student';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trigonometry</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <div class="lesson">
      <h1>Lesson: Trigonometry</h1>
      <h2>Trigonometry</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Trigonometry</strong> is a branch of mathematics that
            focuses on relationships between the sides and angles of triangles.
            The word trigonometry comes from the Latin derivative of Greek words
            for triangle (trigonon) and measure (metron). Trigonometry (Trig) is
            an intricate piece of other branches of mathematics such as,
            Geometry, Algebra, and Calculus.
          </p>
          <h2>Angles</h2>
          <p>
            When two rays combine with a common endpoint and the angle is
            formed. The two components of an angle are “sides” and “vertex”. The
            side can be categorized into terminal sides and initial sides (or
            vertical sides) as shown in the image below.
          </p>
          <p>
            These two rays can combine in multiple fashions to form the
            different types of angles in mathematics. Let us begin by studying
            these different types of angles in geometry.
          </p>
          <h3>Parts of Angle</h3>
          <ul>
            <li>Vertex – Point where the arms meet.</li>
            <li>Arms – Two straight line segments form a vertex.</li>
            <li>
              Angle – If a ray is rotated about its endpoint, the measure of its
              rotation is called angle between its initial and final position.
            </li>
          </ul>
          <h3>Classification of Angles</h3>
          <ul>
            <li>Based on Magnitude</li>
            <li>Based on Rotation</li>
          </ul>
          <h3>Six Types of Angles</h3>
          <ul>
            <li>Acute Angles</li>
            <li>Obtuse Angles</li>
            <li>Right Angles</li>
            <li>Straight Angles</li>
            <li>Reflex Angles</li>
            <li>Full Rotation</li>
          </ul>
          <div class="image">
            <img src="../media/typesofangles.jpg" alt="" width="500px" />
            <p class="caption">Figure 1.2: Types of Angles</p>
          </div>
          <h3>Angle Types Based on Rotation</h3>
          <p>
            Based on the direction of measurement or the direction of rotation,
            angles can be of two types:
          </p>
          <ul>
            <li>
              <strong>Positive angles</strong> are those angles which are
              measured in a counterclockwise direction from the base. In most
              cases, positive angles are used to represent angles in geometry.
              From the origin, if an angle is drawn in the (+x, +y) plane, it
              forms a positive angle.
            </li>
            <li>
              <strong>Negative angles</strong> are those angles which are
              measured in a clockwise direction from the base. From the origin,
              if an angle is drawn towards the (x, -y) plane, it forms a
              negative angle.
            </li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/Parts-of-an-Angle.jpg" alt="" width="300px" />
          <p class="caption">Figure 1.1: Angle</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Right Triangle</h2>
          <p>
            A right-angled triangle is a triangle, that has one of its interior
            angles equal to 90 degrees or any one angle is a right angle.
            Therefore, this triangle is also called the right triangle or
            90-degree triangle. The right triangle plays an important role in
            trigonometry.
          </p>
          <p>
            The three sides of the right triangle are related to each other.
            This relationship is explained by Pythagoras theorem. According to
            this theorem, in a right triangle,
          </p>
          <p>Hypotenuse2 = Perpendicular2 + Base2</p>
          <div class="image">
            <img
              src="../media/hypotenuse3-1613732946.png"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.3: Pythagoras Theorem</p>
          </div>
          <p>
            The area of the biggest square is equal to the sum of the square of
            the two other small square areas. We can generate the Pythagoras
            theorem as the square of the length of the hypotenuse is equal to
            the sum of the length of squares of base and height.
          </p>
          <h3>Area of Right Angled Triangle</h3>
          <p>
            The area is in the two-dimensional region and is measured in a
            square unit. It can be defined as the amount of space taken by the
            2-dimensional object.
          </p>
          <p>The area of a triangle can be calculated by:</p>
          <div class="image">
            <img
              src="../media/tutors-area-of-right-triangle-formula.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.4: Area of a Right Triangle</p>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="text">
          <h3>Understand how angles are measured</h3>
          <p>
            Since Trigonometry focuses on relationships of sides and angles of a
            triangle, let’s go over how angles are measured… Angles are formed
            by an initial side and a terminal side. An initial side is said to
            be in standard position when it’s vertex is located at the origin
            and the ray goes along the positive x axis.
          </p>
          <div class="image">
            <img src="../media/Angle-Measurement-1.png" alt="" width="500px" />
            <p class="caption">Figure 1.1: Angle Measurement</p>
          </div>
          <p>
            An angle is measured by the amount of rotation from the initial side
            to the terminal side. A positive angle is made by a rotation in the
            counterclockwise direction and a negative angle is made by a
            rotation in the clockwise direction.
          </p>
          <h3>Angles can be measure in two ways:</h3>
          <ul>
            <li>Degrees</li>
            <li>Radians</li>
          </ul>

          <h3>Degrees</h3>
          <p>A circle is comprised of 360°, which is called one revolution</p>
          <div class="image">
            <img src="../media/circle.png" alt="" width="300px" />
            <p class="caption">Figure 1.2: Degrees in Circle</p>
          </div>
          <p>Degrees are used primarily to describe the size of an angle.</p>
          <p>
            The real mathematician is the radian, since most computations are
            done in radians.
          </p>
          <h3>Radians</h3>
          <p>
            1 revolution measured in radians is 2π, where π is the constant
            approximately 3.14.
          </p>
          <div class="image">
            <img src="../media/Radians.jpg" alt="" width="300px" />
            <p class="caption">Figure 1.2: Radians in Circle</p>
          </div>
          <h3>How can we convert between the two you ask?</h3>
          <p>
            Easy, since 360° = 2π radians (1 revolution) Then, 180° = π radians
            So that means that 1° = 𝜋/180 radians and And 180/𝜋 degrees = 1
            radian.
          </p>
          <h3>Examples:</h3>
          <p>1. Convert 60° into radians</p>
          <p>60 ⋅ (1 degree) 𝜋/180 = 60 ⋅ 𝜋/180 = 60𝜋/180 𝜋 / 3 = radian</p>
          <p>2. Convert (-45°) into radians</p>
          <p>-45 ⋅ 𝜋/180 = −45𝜋/180 = − 𝜋/4 radian</p>
          <p>3. Convert 3𝜋 / 2 radian into degrees</p>
          <p>3𝜋./2 (1 radian) 180/𝜋 = 3𝜋/2 ⋅ 180/𝜋 = 540𝜋/2𝜋 = 270°</p>
          <h3>Unit Circle</h3>
          <div class="image">
            <img src="../media/UnitCircle.png" alt="" width="300px" />
            <p class="caption">Figure 1.3: Unit Circle</p>
          </div>
          <p>
            The Unit Circle is a circle that is centered at the origin and
            always has a radius of 1. The unit circle will be helpful to us
            later when we define the trigonometric ratios. You may remember from
            Algebra 2 that the equation of the Unit Circle is 𝑥² + 𝑦² = 1.
          </p>
        </div>
      </div>

      <h2>Trigonometric Functions</h2>
      <div class="content">
        <div class="text">
          <p>
            In Trigonometry there are six trigonometric ratios that relate the
            angle measures of a right triangle to the length of its sides.
            (Remember a right triangle contains a 90° angle)
          </p>
          <p>
            A right triangle can be formed from an initial side x and a terminal
            side r, where r is the radius and hypotenuse of the right triangle.
            (see figure below) The Pythagorean Theorem tells us that x² + y² =
            r², therefore r = √𝑥² + 𝑦². 𝜃 (theta) is used to label a non-right
            angle. The six trigonometric functions can be used to find the ratio
            of the side lengths. The six functions are sine (sin), cosine (cos),
            tangent (tan), cosecant (csc), secant (sec), and cotangent (cot).
            Below you will see the ratios formed by these functions.
          </p>
          <div class="image">
            <img
              src="../media/trigonometric-functions-1.png"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.5: Trigonometric Functions</p>
          </div>
        </div>
        <div class="image">
          <img
            src="../media/unit-circle-trigonometry.png"
            alt=""
            width="300px"
          />
          <p class="caption">Figure 1.4: Unit Circle using Trigonometry</p>
        </div>
      </div>

      <div class="quiz-button"> 
          <a href="../index.php">
              <button id="backbuts" style="padding: 20px; background-color: #1d2630; color: white">
                  Back
              </button>
          </a>
          <?php if ($isStudent): ?>
              <?php 
              $lessonId = 9; 
              $subject = 'Math';

              $quizPassed = false;
              $lesson_score_query = "
                  SELECT score 
                  FROM lesson_scores 
                  WHERE user_id = $user_id 
                    AND lesson_id = (SELECT id FROM lessons WHERE id = $lessonId AND subject_id = (SELECT id FROM subjects WHERE name = '$subject'))
              ";
              $lesson_score_result = mysqli_query($dbc, $lesson_score_query);

              if ($lesson_score_result && mysqli_num_rows($lesson_score_result) > 0) {
                  $user_score = mysqli_fetch_assoc($lesson_score_result)['score'];
                  $passing_score_query = "
                      SELECT passing_score 
                      FROM lessons 
                      WHERE id = $lessonId AND subject_id = (SELECT id FROM subjects WHERE name = '$subject')
                  ";
                  $passing_score_result = mysqli_query($dbc, $passing_score_query);

                  if ($passing_score_result && mysqli_num_rows($passing_score_result) > 0) {
                      $passing_score = mysqli_fetch_assoc($passing_score_result)['passing_score'];
                      $quizPassed = $user_score >= $passing_score;
                  }
              }

              if (!$quizPassed): ?>
                  <a href="../Quiz/TrigonometryQuiz.php">
                      <button id="test-button" style="padding: 20px; background-color: #1d2630; color: white">
                          Take Practice Test
                      </button>
                  </a>
              <?php endif; ?>
          <?php endif; ?>
      </div>
    </div>
  </body>
</html>
