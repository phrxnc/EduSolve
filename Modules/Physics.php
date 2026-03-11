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
    <title>Physics</title>
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
      <h1>Lesson 3: Motion and Force</h1>
      <h2>Motion</h2>
      <div class="content">
        <div class="text">
          <p>
            Whenever a body is moving, we say it is in motion. For instance, if
            a boy is walking down the street from his school to his home, we
            will say that the boy is in motion. But imagine if the boy stops for
            5 minutes in the way and sits down. If someone asks at that time if
            the boy is in motion, the answer will be ‘No’. From this, we can
            infer that the motion of a body is dependent on time. In physics, we
            say that motion is the change in the position of a body with respect
            to time.
          </p>
          <p>
            Everything that exists is made up of matter. Atoms and substances
            are made up of minuscule pieces of matter. The atoms that make up
            the objects we see and touch every day are made up of matter. All
            that has mass and occupies space has volume is known as matter. The
            amount of matter in an object is measured by its mass.
          </p>
        </div>
        <div class="image">
          <img src="../media/motion.jpg" alt="" width="300px" />
          <p class="caption">Figure 3.1: Motion</p>
        </div>
      </div>
      <div class="content">
        <div class="text">
          <h2>Force</h2>
          <p>
            We can say that force is a push or pull acting on an object or
            energy as an attribute of physical action or movement. This occurs
            when two entities are in contact. According to the universal law of
            gravitation, every object in this universe exerts a force on others.
            The force acting on an object is given by the following parameter:
          </p>
          <div class="image">
            <img src="../media/force.jpg" alt="" width="400px" />
            <p class="caption">Figure 3.2: Force</p>
          </div>
          <ul>
            <li>SI unit of Force: <strong>newton(N) or kg.m/s²</strong></li>
            <li>Symbol of Force: <strong>F</strong></li>
            <li>Type of quantity: <strong>Vector quantity</strong></li>
            <li>Dimensional Formula: <strong>M¹L¹T-²</strong></li>
            <li>
              Other units:
              <strong>dyne, pound-force, kilopond, poundal, kip</strong>
            </li>
          </ul>
        </div>
      </div>
      <div class="content">
        <div class="text">
          <h2>Force and Motion Relation</h2>
          <p>
            Force and motion are fundamentally interconnected, with force being
            the primary cause of motion. When an object is in motion, it implies
            that a force is either currently acting on it or has acted to
            initiate its motion. For instance, when a person walks, their
            movement results from the muscular force exerted by their body.
          </p>
          <p>
            Force, defined as a push or pull, is any interaction that changes an
            object's state of motion when unopposed. Motion, in turn, refers to
            a change in an object’s position over time, typically described by
            either a change in speed or direction.
          </p>
          <p>
            Isaac Newton's studies on force and motion established the following
            key principles:
          </p>
          <ul>
            <li>
              <strong>Force accelerates a body: </strong>Increases its speed.
            </li>
            <li>
              <strong>Force decelerates a body: </strong>Reduces its speed.
            </li>
            <li>
              <strong>Force changes a body's direction: </strong>Alters its path
              of motion.
            </li>
          </ul>
          <h2>Newton's Laws of Motion</h2>
          <p>
            Sir Isaac Newton’s Laws of Motion transformed our grasp of the
            physical world. These laws explain the behavior of objects at rest
            and in motion, laying the foundation for classical mechanics.
          </p>
          <h3>Newton’s First Law of Motion: The Law of Inertia</h3>
          <p>
            Newton’s First Law of Motion, also known as the Law of Inertia, is a
            fundamental principle that describes the behaviour of objects in the
            absence of external influences. The term “Law of Inertia” emphasizes
            the concept of inertia, which refers to the property of massive
            objects to resist changes in their state of motion. This idea stems
            from the observation that objects naturally maintain their current
            state of rest or motion, resisting any changes unless acted upon by
            an external force.
          </p>
          <div class="image">
            <img src="../media/Newton_s-first-law.jpg" alt="" width="500px" />
            <p class="caption">Figure 3.3: The Law of Inertia</p>
          </div>
          <h3>Newton’s Second Law of Motion: Force, Mass, and Acceleration</h3>
          <p>
            The second law of motion describes the relationship between the
            force acting on a body and the resulting acceleration. According to
            Newton’s second law, the force acting on an object is equal to the
            product of its mass and acceleration.
          </p>
          <p>
            Mathematically, we express Newton’s Second Law as follows:
            <i>F = m x a</i>
          </p>
          <p>
            Here, F represents the force, m is the object’s mass and a is the
            acceleration produced. This equation reveals that the acceleration
            of an object is directly proportional to the magnitude of the net
            force applied in the same direction as the force and inversely
            proportional to the object’s mass.
          </p>
          <div class="image">
            <img src="../media/Newton_s-second-law.jpg" alt="" width="500px" />
            <p class="caption">Figure 3.4: Force, Mass, and Acceleration</p>
          </div>
          <h3>Newton’s Third Law of Motion: Action and Reaction</h3>
          <p>
            Newton’s Third Law of Motion states that for every action, there is
            an equal and opposite reaction. When two bodies interact, they apply
            forces on each other that are equal in magnitude and opposite in
            direction. This law highlights the concept that forces always occur
            in pairs.
          </p>
          <p>
            This third law of motion has profound implications, including
            conserving momentum. Momentum is a property of moving objects
            determined by an object’s mass and velocity. According to Newton’s
            third law, the total momentum of an isolated system remains
            constant. This means that in any interaction, the total momentum
            before and after the interaction remains the same, regardless of the
            forces involved.
          </p>
          <div class="image">
            <img src="../media/Newton_s-Third-law.jpg" alt="" width="500px" />
            <p class="caption">Figure 3.5: Action and Reaction</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Acceleration</h2>
          <p>
            Acceleration is defined as The rate of change of velocity with
            respect to time.
          </p>
          <p>
            Acceleration is a vector quantity as it has both magnitude and
            direction. It is also the second derivative of position with respect
            to time or it is the first derivative of velocity with respect to
            time.
          </p>
          <div class="image">
            <img src="../media/Acceleration.png" alt="" width="350px" />
            <p class="caption">Figure 3.6: Action and Reaction</p>
          </div>
          <h3>Acceleration's Formula</h3>
          <p>Acceleration formula is given as:</p>

          <p>Where:</p>
          <ul>
            <li>a is the acceleration in m.s-²</li>
            <li>vi is the initial velocity in m.s-¹</li>
            <li>vf is the final velocity in m.s-¹</li>
            <li>t is the time interval in s</li>
            <li>SI unit: m/s² is the SI unit of acceleration</li>
          </ul>
          <div class="image">
            <img src="../media/accelformula.jpg" alt="" width="400px" />
            <p class="caption">Figure 3.7: Acceleration Formula</p>
          </div>

          <h2>Velocity</h2>
          <p>
            Your notion of velocity is probably the same as its scientific
            definition. You know that if you have a large displacement in a
            small amount of time you have a large velocity, and that velocity
            has units of distance divided by time, such as miles per hour or
            kilometers per hour.
          </p>
          <p>
            Average velocity is displacement (change in position) divided by the
            time of travel.
          </p>

          <div class="image">
            <img
              src="../media/velocity-formula-new1.jpg"
              alt=""
              width="400px"
            />
            <p class="caption">Figure 3.8: Velocity Formula/p></p>
          </div>
          <h3>Initial and Final Velocity</h3>
          <p>
            Initial velocity describes how fast an object travels when gravity
            first applies force on the object. On the other hand, the final
            velocity is a vector quantity that measures the speed and direction
            of a moving body after it has reached its maximum acceleration.
          </p>
          <h3>How to find the final velocity?</h3>
          <p>
            Finding the final velocity is simple, with a few calculations and
            basic conceptual knowledge.
          </p>
          <ol>
            <li>
              Determine the object’s original velocity by dividing the time it
              took for the object to travel a given distance by the total
              distance. In the equation V = d/t, V is the velocity, d is the
              distance, and t is the time.
            </li>
            <li>
              Determine the object’s acceleration by dividing the object’s mass
              by force and multiply the answer by the time it took for it to
              accelerate. For example, if the object weighs 30 kg and has a
              force of 15 N applied to it, then the acceleration would be 4 m/s.
            </li>
            <li>
              Add the quantity obtained from Step 1 and Step 2 to obtain the
              final velocity. For example, if your initial velocity was 3 m/s
              and your object acceleration is 4 m/s, your final velocity is 7
              m/s (3 + 4 = 7).
            </li>
          </ol>
        </div>
      </div>
      <h2>Speed and Velocity</h2>
      <div class="content">
        <div class="text">
          <p>
            Speed and velocity can be a little confusing for most of us. Well,
            the difference between speed and velocity is that speed gives us an
            idea of how fast an object is moving, whereas velocity not only
            tells us its speed but also tells us the direction the body is
            moving in. We can define speed as a function of distance travelled,
            whereas velocity is a function of displacement. Instantaneous
            velocity is the velocity of a body at any given time. Average
            velocity is the total displacement by total time and is given by v =
            △x/△t where ∆x is the total displacement of the body and ∆t is the
            time. Average velocity is always less than or equal to that of
            average speed; this is because displacement can never be higher than
            the distance travelled, but the distance travelled can be higher
            than that of displacement.
          </p>
          <h2>Difference between Speed and Velocity</h2>
        </div>
        <div class="image">
          <img src="../media/speed vs velocity.png" alt="" width="400px" />
          <p class="caption">Figure 3.9: Speed vs Velocity</p>
        </div>
      </div>
      <div class="image">
        <img src="../media/Table speed vs velocity.png" alt="" width="600px" />
        <p class="caption">Figure 3.10: Speed vs Velocity</p>
      </div>
      <div class="content">
        <div class="text">
          <h2>Key Points</h2>
          <ul>
            <li>
              <strong>Motion</strong>
              <ul>
                <li>
                  Motion is the change in position of an object with respect to
                  time.
                </li>
                <li>
                  It is dependent on time and occurs when a force acts on a
                  body.
                </li>
              </ul>
            </li>
            <li>
              <strong>Force</strong>
              <ul>
                <li>
                  Defined as a push or pull acting on an object, causing a
                  change in motion.
                </li>
                <li>
                  SI unit: Newton (N); force is a vector quantity with magnitude
                  and direction.
                </li>
              </ul>
            </li>
            <li>
              <strong>Force and Motion Relation </strong>
              <ul>
                <li>
                  Force initiates or changes motion by accelerating,
                  decelerating, or altering the direction of a body.
                </li>
              </ul>
            </li>
            <li>
              <strong>Newton’s Laws of Motion </strong>
              <ul>
                <li>
                  <strong>First Law (Law of Inertia):</strong>Objects remain at
                  rest or in uniform motion unless acted upon by a net external
                  force.
                </li>
                <li>
                  <strong>Second Law: <i>F=m × a</i></strong
                  >,showing force is proportional to mass and acceleration.
                </li>
                <li>
                  <strong>Third Law: </strong>For every action, there is an
                  equal and opposite reaction.
                </li>
              </ul>
            </li>
            <li>
              <strong>Acceleration</strong> - SI unit: m/s²; a vector quantity
              influenced by both magnitude and direction.
            </li>
            <li>
              <strong>Velocity</strong> - Measures displacement over time and
              includes direction.
              <ul>
                <li>Initial Velocity: Speed when force first acts.</li>
                <li>Final Velocity: Speed after maximum acceleration.</li>
              </ul>
            </li>
            <li>
              <strong>Speed vs. Velocity </strong>
              <ul>
                <li>Speed: Scalar quantity; depends on distance traveled.</li>
                <li>
                  Velocity: Vector quantity; considers displacement and
                  direction.
                </li>
              </ul>
            </li>
          </ul>
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
              $lessonId = 3;
              $subject = 'Science';

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
                  <a href="../Quiz/PhysicsQuiz.php">
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
