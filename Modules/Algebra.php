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
    <title>Algebra</title>
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
      <h1>Lesson 2: Algebra</h1>
      <h2>Algebra</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Algebra</strong> involves the study of symbols and the rules
            for manipulating these symbols to solve equations and model
            real-world situations.
          </p>
          <p>
            one of the oldest branches in the history of mathematics that deals
            with number theory, geometry, and analysis.
          </p>
          <p>
            Algebra helps solve the mathematical equations and allows to derive
            unknown quantities, like the bank interest, proportions,
            percentages. We can use the variables in the algebra to represent
            the unknown quantities that are coupled in such a way as to rewrite
            the equations.
          </p>
          <h3>Linear Inequalities</h3>
          <p>
            Linear inequalities in two variables represent the inequalities
            between two algebraic expressions where two distinct variables are
            included. In linear inequalities in two variables, we use greater
            than (>), less than (<), greater than or equal (≥) and less than or
            equal (≤) symbols, instead of using equal to a symbol (=).
          </p>
          <p>
            Any two real numbers or two algebraic expressions associated with
            the symbol ‘<’, ‘>’, ‘≤’ or ‘≥’ form a linear inequality. For
            example, 9<11, 18>17 are examples of numerical inequalities and
            x+7>y, y<10-x, x ≥ y > 11 are examples of algebraic inequalities.
          </p>
          <p>
            The symbols ‘<‘ and ‘>’ represent the strict inequalities and the
            symbols ‘≤’ and ‘≥’ represent slack inequalities. To represent
            linear inequalities in one variable in a number line is a visual
            representation and is a convenient way to represent the solutions of
            the inequality. Now, we will discuss the graph of a linear
            inequality in two variables.
          </p>
          <p>The examples of linear inequalities in two variables are:</p>
          <ul>
            <li>3x < 2y + 5</li>
            <li>8y – 9x > 10</li>
            <li>9x ≥ 10/y</li>
            <li>x + y ≤ 0</li>
          </ul>
          <p>
            <strong>Note:</strong> 4x2 + 2x + 5 < 0 is not an example of linear
            inequality in one variable, because the exponent of x is 2 in the
            first term. It is a quadratic inequality.
          </p>
          <h3>Example of Linear Inequalities</h3>
          <p>
            The solution for linear inequalities in two variables is an ordered
            pair that is true for the inequality statement. Let us say if Ax +
            By > C is a linear inequality where x and y are two variables, then
            an ordered pair (x, y) satisfying the statement will be the required
            solution.
          </p>
          <p>
            For example, if 2x + 3y > 4 is a linear inequality, then we can
            check the solution, by putting the values of x and y here.
          </p>
          <p>Let x = 1 and y = 2</p>
          <p>Taking LHS, we have; 2 (1) + 3 (2) = 2 + 6 = 8</p>
          <p>
            Since, 8 > 4, therefore, the ordered pair (1, 2) satisfy the
            inequality 2x + 3y > 4. Hence, <strong>(1, 2)</strong> is the
            solution.
          </p>
          <div class="image">
            <img
              src="../media/linearinequalitiesjpg.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.1: Another Example</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Exponent</h2>
          <p>
            Exponent is defined as the method of expressing large numbers in
            terms of powers. That means, exponent refers to how many times a
            number multiplied by itself. For example, 6 is multiplied by itself
            4 times, i.e. 6 × 6 × 6 × 6. This can be written as 64. Here, 4 is
            the exponent and 6 is the base. This can be read as 6 is raised to
            power 4.
          </p>
          <h3>Exponent Symbol</h3>
          <p>
            The symbol used for representing the exponent is ^. This symbol (^)
            is called a carrot. For example, 4 raised to 2 can be written as 4^2
            or 42. Thus, 4^2 = 4 × 4 = 16. The below table shows the
            representation of a few numerical expressions using exponents.
          </p>
          <div class="image">
            <img src="../media/ExponentSymbol.png" alt="" width="600px" />
            <p class="caption">Figure 1.2: Exponent Symbol</p>
          </div>
          <h3>Exponent Laws</h3>
          <p>
            <strong>Multiplication Law:</strong> Bases – multiplying the like
            ones; add the exponents and keep the base the same.
          </p>
          <p>
            When bases are raised with power to another, multiply the exponents
            and keep the base the same.
          </p>
          <p>
            <strong>Division Law:</strong> Bases – dividing the like ones;
            subtract the exponent of the denominator from the exponent of the
            numerator Exponent and keep the base the same.
          </p>
          <p>
            Let ‘a’ be any integer or a decimal number and ‘m’, ‘n’ are positive
            integers, that represent the powers to the bases such that the above
            laws can be written as:
          </p>
          <ul>
            <li>aᵐ . aⁿ = aᵐ +ⁿ</li>
            <li>(aᵐ )ⁿ = aᵐ ⁿ</li>
            <li>(ab)ⁿ = aⁿ bⁿ</li>
            <li>(a/b)ⁿ = aⁿ/bⁿ</li>
            <li>aᵐ /aⁿ = aᵐ-ⁿ</li>
            <li>aᵐ /aⁿ = 1/aⁿ-ᵐ</li>
          </ul>
          <p>
            These laws referred to the properties of exponents. These are used
            to simplify complex algebraic expressions and write large numbers in
            an understandable manner.
          </p>
          <h3>Exponent Table</h3>
          <p>
            The below table shows the values of different expressions in terms
            of exponents along with their expansions and values. This will help
            you in understanding the simplification of numbers with exponents in
            detail.
          </p>
          <div class="image">
            <img src="../media/ExponentTable.png" alt="" width="600px" />
            <p class="caption">Figure 1.3: Exponent Tabel</p>
          </div>
          <h3>Examples</h3>
          <p><strong>Example 1:</strong> Simplify (32 × 3-5)/ 9-2</p>
          <p>Solution:</p>
          <p>(32 × 3-5)/ 9-2 = 3(2 – 5) × 92</p>
          <p>= 3-3 × (32)2</p>
          <p>= 3-2 × 34</p>
          <p>= 3(-2 + 4)</p>
          <p>= 32</p>
          <p>= 9</p>
          <p>Therefore, Simplify (32 × 3-5)/ 9-2 = <strong>9</strong></p>
          <p>Example 2: Solve 2eˣ + 5 = 115</p>
          <p>Solution:</p>
          <p>2eˣ + 5 = 115</p>
          <p>2eˣ = 115 – 5</p>
          <p>2eˣ = 110</p>
          <p>eˣ = 110/2</p>
          <p>eˣ = 55</p>
          <strong>x = ln 55 </strong>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h3>Polynomials</h3>
          <p>
            Polynomial is made up of two terms, namely Poly (meaning “many”) and
            Nominal (meaning “terms.”). A polynomial is defined as an expression
            which is composed of variables, constants and exponents, that are
            combined using mathematical operations such as addition,
            subtraction, multiplication and division (No division operation by a
            variable). Based on the number of terms present in the expression,
            it is classified as monomial, binomial, and trinomial. Examples of
            constants, variables and exponents are as follows:
          </p>
          <ul>
            <li>Constants. Example: 1, 2, 3, etc.</li>
            <li>Variables. Example: g, h, x, y, etc.</li>
            <li>Exponents: Example: 5 in x⁵ etc.</li>
          </ul>
          <h4>Notation</h4>
          <p>
            The polynomial function is denoted by P(x) where x represents the
            variable. For example,
          </p>
          <p>P(x) = x²-5x+11</p>
          <p>If the variable is denoted by a, then the function will be P(a)</p>
          <h3>Types of Polynomials</h3>
          <ul>
            <li>Monomial</li>
            <li>Binomial</li>
            <li>Trinomial</li>
            <li>Polynomial containing 4 terms (Quadronomial)</li>
          </ul>
          <h3>Monomial</h3>
          <p>
            A monomial is an expression which contains only one term. For an
            expression to be a monomial, the single term should be a non-zero
            term. A few examples of monomials are:
          </p>
          <ul>
            <li>5x</li>
            <li>3</li>
            <li>6a⁴</li>
          </ul>
          <h3>Binomial</h3>
          <p>
            A binomial is a polynomial expression which contains exactly two
            terms. A binomial can be considered as a sum or difference between
            two or more monomials. A few examples of binomials are:
          </p>
          <ul>
            <li>– 5x + 3,</li>
            <li>6a⁴ + 17x</li>
            <li>xy² + xy</li>
          </ul>
          <h3>Trinomial</h3>
          <p>
            A trinomial is an expression which is composed of exactly three
            terms. A few examples of trinomial expressions are:
          </p>
          <ul>
            <li>– 8a⁴ + 2x + 7</li>
            <li>4x² + 9x + 7</li>
          </ul>
          <h3>Degree of a Polynomial</h3>
          <p>
            The degree of a polynomial is defined as the highest exponent of a
            monomial within a polynomial. Thus, a polynomial equation having one
            variable which has the largest exponent is called a degree of the
            polynomial.
          </p>
          <div class="image">
            <img src="../media/ExponentTable.png" alt="" width="600px" />
            <p class="caption">Figure 1.4: Degree of a Polynomial</p>
          </div>
          <p>
            <strong>Example:</strong> Find the degree of the polynomial P(x) =
            6s4+ 3x2+ 5x +19
          </p>
          <p>
            <strong>Solution:</strong> The degree of the polynomial is 4 as the
            highest power of the variable 4.
          </p>
        </div>
      </div>

      <h2>Quadratic Equations</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Quadratics</strong> can be defined as a polynomial equation
            of a second degree, which implies that it comprises a minimum of one
            term that is squared. It is also called quadratic equations. The
            general form of the quadratic equation is:
            <strong>ax² + bx + c = 0</strong>
          </p>
          <p>
            where x is an unknown variable and a, b, c are numerical
            coefficients. For example, x2 + 2x +1 is a quadratic or quadratic
            equation. Here, a ≠ 0 because if it equals zero then the equation
            will not remain quadratic anymore and it will become a linear
            equation, such as: <strong>bx+c=0</strong>
          </p>
          <p>Thus, this equation cannot be called a quadratic equation.</p>
          <p>The terms a, b and c are also called quadratic coefficients.</p>
          <div class="image">
            <img src="../media/quadratic-formula.jpg" alt="" width="500px" />
            <p class="caption">Figure 1.5: Quadratic Equations</p>
          </div>
          <h3>Examples of Quadratics</h3>
          <p>
            Below are the illustrations of quadratic equations of the form (ax²
            + bx + c = 0)
          </p>
          <ul>
            <li>x² –x – 9 = 0</li>
            <li>5x² – 2x – 6 = 0</li>
            <li>3x² + 4x + 8 = 0</li>
            <li>-x² +6x + 12 = 0</li>
          </ul>
          <p>
            Examples of a quadratic equation with the absence of a ‘ C ‘- a
            constant term.
          </p>
          <ul>
            <li>-x² – 9x = 0</li>
            <li>x² + 2x = 0</li>
            <li>-6x² – 3x = 0</li>
            <li>-5x² + x = 0</li>
          </ul>
          <h3>How to Solve Quadratic Equations</h3>
          <p>four methods of solving quadratic equations.</p>
          <ol>
            <li>Factoring</li>
            <li>Completing the square</li>
            <li>Using Quadratic Formula</li>
            <li>Taking the square root</li>
          </ol>
          <h4>Factoring of Quadratics</h4>
          <ul>
            <li>Begin with a equation of the form ax² + bx + c = 0</li>
            <li>Ensure that it is set to adequate zero.</li>
            <li>
              Factor the left-hand side of the equation by assuming zero on the
              right-hand side of the equation.
            </li>
            <li>Assign each factor equal to zero.</li>
            <li>
              Now solve the equation in order to determine the values of x.
            </li>
          </ul>
          <h3>Example:</h3>
          <p>2x²- x - 6 = 0</p>
          <p>(2x + 3)(x - 2) = 0</p>
          <p>2x + 3 = 0</p>
          <p>x = -3 / 2</p>
          <strong>x = 2</strong>
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
              $lessonId = 7; 
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
                  <a href="../Quiz/AlgebraQuiz.php">
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
