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
    <title>Number Theory</title>
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
      <h1>Lesson 1: Number Theory</h1>
      <h2>Number Theory</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Number theory</strong> is the study of numbers, particularly
            integers, and their properties. It explores concepts like
            divisibility, prime numbers, and the relationships between numbers.
          </p>
          <p>
            Number theory helps to study the relationships between different
            sorts of numbers. Natural numbers are separated into a variety of
            times. Here are some of the familiar and unfamiliar examples with
            quick number theory introduction.
          </p>
          <p>
            In number theory, the numbers are classified into different types,
            such as natural numbers, whole numbers, complex numbers, and so on.
            The sub-classifications of the natural number are given below:
          </p>
          <ul>
            <li>
              <strong>Odd Numbers:</strong> The numbers that are not evenly
              divided by 2 are called odd numbers. For example: 1, 3, 5, 7, 9,
              11, 13, 15, 17, 19…..
            </li>
            <li>
              <strong>Even Numbers:</strong> The numbers that are evenly divided
              by 2 are called even numbers. For example: 2, 4, 6, 8, 10, 12, 14,
              16, 18, 20, 22 . . .
            </li>
            <li>
              <strong>Square Numbers:</strong> A number multiplied by itself is
              called square numbers. For example: 4, 9, 16, 25, 36, 49, 64,
              81,100 . . .
            </li>
            <li>
              <strong>Cube Numbers:</strong> A number multiplied by itself 3
              times is called cube numbers. For example: 8, 27, 64, 125, 216,
              343, 512 . . .
            </li>
            <li>
              <strong>Prime numbers:</strong> If a number has only two factors:
              1 and the number is called prime numbers. For example: 2, 3, 5, 7,
              11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47,53, 59, 61 . . .
            </li>
            <li>
              <strong>Composite Numbers:</strong> Composite number has more than
              two factors. The composite numbers are numbers which are not prime
              numbers. The number 1 is neither prime nor composite. For example:
              4, 6, 8, 9, 10, 12, 14, 15, 16,18, 20, 21, 22, 24 . . .
            </li>
            <li>
              <strong>Fibonacci Numbers:</strong> Fibonacci numbers are created
              starting with 1 and 1, then get the next number in the list and
              adds the previous two numbers. Say, 1+1 =2 and then add 1+2 you
              get 3, then adds 2+3 gives 5, then 3+5 gives 8 and so on. For
              example: 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89. . .
            </li>
          </ul>
          <h3>Applications of Number Theory</h3>
          <p>
            Here are some of the most important number theory applications.
            Number theory is used to find some of the important divisibility
            tests, whether a given integer m divides the integer n. Number
            theory have countless applications in mathematics as well in
            practical applications such as
          </p>
          <ul>
            <li>Security System like in banking securities</li>
            <li>Coding theory</li>
            <li>Barcodes</li>
          </ul>
          <h3>Greatest Common Divisor</h3>
          <p>
            The greatest common divisor (GCD) of two or more numbers is the
            greatest common factor number that divides them, exactly. It is also
            called the highest common factor (HCF). For example, the greatest
            common factor of 15 and 10 is 5, since both the numbers can be
            divided by 5
          </p>
          <p>
            The GCD of 12 and 15 is 3 because it is the largest number that
            divides both.
          </p>
          <h2>Methods to Find GCD</h2>
          <p>
            There are several methods to find the greatest common divisor of
            given two numbers.
          </p>
          <ol>
            <li>Prime factorisation method</li>
            <li>Long division method</li>
            <li>Euclid’s division algorithm</li>
          </ol>
          <h3>Prime factorization method</h3>
          <div class="image">
            <img src="../media/gcf-factor-trees.png" alt="" width="400px" />
            <p class="caption">Figure 1.1: Prime factorization</p>
          </div>
          <p>
            In the prime factorisation method, each given number is written as
            the product of prime numbers and then find the product of the
            smallest power of each common prime factor.
          </p>
          <p>
            This method is applicable only for positive numbers, i,e. Natural
            numbers.
          </p>
          <h4>Example: Find the Greatest common factor of 24, 30 and 36.</h4>
          <p>Solution: Prime factors of 24 is 23 × 3</p>
          <p>Prime factors of 30 = 2 × 3 × 5</p>
          <p>Prime factors of 36 = 2² x 3²</p>
          <p>
            From the factorisation, we can see, only 2 x 3 are common prime
            factors.
          </p>
          <p>Therefore, <strong>GCD (24, 30, 36) = 2 x 3 = 6</strong></p>
          <h3>Long division method</h3>
          <div class="image">
            <img src="../media/LongDivisionGCF.png" alt="" width="400px" />
            <p class="caption">Figure 1.2: Long division method</p>
          </div>
          <p>
            In this method, the largest number among the given set of numbers
            should be divided by the second largest number, and again the
            second-largest number should be divided by the remainder of the
            previous operation, this process will continue till the remainder is
            zero. The divisor, when the remainder is zero, is called the
            greatest common divisor of the given numbers.
          </p>
          <h3>Euclid’s division algorithm</h3>
          <div class="image">
            <img src="../media/euclidean-algorithm.png" alt="" width="400px" />
            <p class="caption">Figure 1.3: Euclid’s division algorithm</p>
          </div>
          <p>
            This method is stated only for positive integers. Find the below
            steps in order to get the HCF of two positive integers a and b. Here
            a > b.
          </p>
          <p>
            Step 1: Applying Euclid’s division lemma to a and b we get two whole
            numbers q and r such that, a = bq+r ; 0 r < b.
          </p>
          <p>
            Step 2: If r = 0, then b is the HCF of a and b. If r ≠0, then apply
            Euclid’s division lemma to b and r.
          </p>
          <p>Step 3: Continue the above process until the remainder is zero.</p>
          <p>
            Step 4: When the remainder is zero, the divisor at this stage is the
            HCF of given numbers.
          </p>
          <h3>GCD Formula</h3>
          <p>
            If a and b are any number, then the greatest common divisor of a and
            b can be given by:
          </p>
          <strong>GCD (a,b) = [|a.b|]/[lcm(a,b)] </strong>
          <h2>Examples: Problems and Solutions</h2>

          <p>
            <strong>Problem 1: </strong>Find the common factors of 10 and 16
          </p>
          <strong>Solution: </strong>
          <p>Factors of 10 are: 2 x 5 = 10 & 1 x 10 = 10</p>
          <p>Therefore, the factors are 1, 2, 5 and 10</p>
          <p>Factors of 16 are 4 x 4 = 16, 1 x 16 = 16, 2 x 8 = 16</p>
          <p>Therefore, the factors of 16 are as follows: 1, 2, 4, 8, 16</p>
          Then, the common factors are <strong>1 and 2. </strong>

          <p>
            <strong>Problem 2: </strong>Find the Greatest Common Divisor(G.C.D)
            of a number 30 and 52
          </p>
          <strong>Solution:</strong>
          <p>Divisors of 30 are 1, 2, 3, 5, 6, 10, 15, 30</p>
          <p>Divisors of 52 are 1, 2, 4, 13, 26, 52</p>
          <p>The common divisors in 30 and 52 is 2</p>
          <p>Therefore, the G. C.D of 30 and 52 is 2</p>
          <strong>gcd(30,52)= 2 </strong>
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
              $lessonId = 6; 
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
                  <a href="../Quiz/NumberTheoryQuiz.php">
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
