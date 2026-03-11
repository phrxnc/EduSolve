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
    <title>Probability</title>
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
      <h1>Lesson: Probability</h1>
      <h2>Probability</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Probability</strong> Probability is a measure of the
            likelihood of an event to occur. Many events cannot be predicted
            with total certainty. We can predict only the chance of an event to
            occur i.e., how likely they are going to happen, using it.
            Probability can range from 0 to 1, where 0 means the event to be an
            impossible one and 1 indicates a certain event. Probability for
            Class 10 is an important topic for the students which explains all
            the basic concepts of this topic. The probability of all the events
            in a sample space adds up to 1.
          </p>
          <h3>Example:</h3>
          <p>
            when we toss a coin, either we get Head OR Tail, only two possible
            outcomes are possible (H, T). But when two coins are tossed then
            there will be four possible outcomes, i.e {(H, H), (H, T), (T, H),
            (T, T)}.
          </p>
          <h3>Formula for Probability</h3>
          <p>
            The probability formula is defined as the possibility of an event to
            happen is equal to the ratio of the number of favourable outcomes
            and the total number of outcomes.
          </p>
          <p>
            Probability of event to happen P(E) = Number of favourable
            outcomes/Total Number of outcomes
          </p>
          <h3>Another Examples:</h3>
          <p>
            1. There are 6 pillows in a bed, 3 are red, 2 are yellow and 1 is
            blue. What is the probability of picking a yellow pillow?
          </p>
          <p>
            <strong>Answer: </strong>The probability is equal to the number of
            yellow pillows in the bed divided by the total number of pillows,
            i.e. 2/6 = 1/3.
          </p>
          <p>
            2. There is a container full of coloured bottles, red, blue, green
            and orange. Some of the bottles are picked out and displaced. Sumit
            did this 1000 times and got the following results:
          </p>
          <ul>
            <li>No. of blue bottles picked out: 300</li>
            <li>No. of red bottles: 200</li>
            <li>No. of green bottles: 450</li>
            <li>No. of orange bottles: 50</li>
          </ul>
          <p>What is the probability that Sumit will pick a green bottle?</p>
          <p>
            <strong>Answer:</strong> For every 1000 bottles picked out, 450 are
            green. Therefore, P(green) = 450/1000 = 0.45
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Set Notation</h2>
          <p>
            You may omit this section if you are familiar with these concepts. A
            set is a collection of objects. We often specify a set by listing
            its members, or elements, in parentheses like this {}. For example A
            = {2, 4, 6, 8} means that A is the set consisting of numbers
            2,4,6,8. We could also write A ={even numbers less than 9}.
          </p>
          <p>
            The <strong>union</strong> of A and B is the set of elements which
            belong to A or to B (or both) and can be written as A ∪ B.
          </p>
          <p>
            The <strong>intersection</strong> of A and B is the set of elements
            which belong to both A and B, and can be written as A ∩ B.
          </p>
          <p>
            The <strong>complement</strong> of A, frequently denoted by A, is
            the set of all elements which do not belong to A. In making this
            definition we assume that all elements we are thinking about belong
            to some larger set U, which we call the universal set.
          </p>
          <p>
            The <strong>empty set</strong>, written ∅ or {}, means the set with
            no elements in it.
          </p>
          <p>
            A set C is a <strong>subset</strong> of A if all the elements in C
            are also in A.
          </p>
          <p>For example, let</p>
          <pre>
            <i>
            U = {all positive numbers ≤ 10}
            A = {2, 4, 6, 8}
            B = {1, 2,3}
            C = {6, 8}
            </i>
          </pre>
          <p>
            Sets A, B and U may be represented in a Venn Diagram as follows:
          </p>
          <div class="image">
            <img src="../media/Venn Diagram1.png" alt="" width="500px" />
            <p class="caption">
              Figure 1.1: Sets A, B and U may be represented in a Venn Diagram
            </p>
          </div>
          <p>
            A intersection B, A ∩ B, is shown in the Venn diagram by the overlap
            of the sets A and B, A ∩ B = {2}.
          </p>
          <p>
            The union of the sets A and B, A ∪ B, is the set of elements that
            are in A = {2, 4, 6, 8} together with the elements that are in B =
            {1, 2, 3} including each element once only.
          </p>

          <p>So, A ∪ B = {1, 2, 3, 4, 6, 8}.</p>
          <p>
            The complement of A is the set A is contains all the elements in U
            which are not in A. So, A = {1, 3, 5, 7, 9, 10}. C is a subset of A
            as every element in C = {6, 8} is also in A = {2, 4, 6, 8}.
          </p>
        </div>
      </div>

      <h2>Finite Equiprobable Spaces</h2>
      <div class="content">
        <div class="text">
          <p>
            In loose terms, we say that the probability of something happening
            is 1 , if, when the experiment is repeated often under the same
            conditions, the stated result occurs 25% of the time.
          </p>

          <p>
            For the moment, we will confine our discussion to cases where there
            are a finite number of equally likely outcomes.
          </p>
          <p>
            For example, if a coin is tossed, there are two equally likely
            outcomes: heads (H) or tails (T). If a die is tossed, there are six
            equally likely outcomes: 1,2,3,4,5,6.
          </p>
          <h3>Some Notation</h3>
          <p>
            The set of all possible outcomes of the given experiment is called
            the <strong>sample space</strong>. An event is a subset of a sample
            space.
          </p>
        </div>
        <div class="image">
          <img src="../media/Sample-space.png" alt="" width="600px" />
          <p class="caption">Figure 1.2: Sample Space</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Calculating Probabilities</h2>
          <p>
            Look again at the example of rolling a six faced die. The possible
            outcomes in this experiment are 1,2,3,4,5,6, so the sample space is
            the set {1,2,3,4,5,6}. The ‘event’ of ‘getting a 6’ is the subset
            {6}. We represent this in the following diagram.
          </p>
          <p>
            There are six possibilities in the sample space and only one of
            these corresponds to getting a 6, so the probability of getting a 6
            when you roll a die is 1/6.
          </p>
          <p>We say that the probability of an event A occuring is</p>
          <div class="image">
            <img src="../media/FormulaPA.png" alt="" width="400px" />
            <p class="caption">Figure 1.3: Sample Space</p>
          </div>
          <h3>Examples</h3>
          <p>
            1. If a fair coin is tossed, it is clear from our definition of
            probability above that P (obtaining a head) = 1/2
          </p>
          <p>
            2. A card is selected at random from a pack of 52 cards. Let A =
            ‘the card is a heart’ and B = ‘the card is an ace’. Find P (A), P
            (B).
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Complementary Events</h2>
          <p>
            <i>If an event is a certainty, then its probability is one.</i>
          </p>
          <p>
            In common language we often say it is 100% certain (which is the
            same thing).
          </p>
          <p>
            For example, in the coin tossing experiment, let C be the event
            ‘obtaining a head or a tail’.
          </p>
          <p>
            The sample space is {H, T}. The event is {H, T}. So P (C) = 2/2 = 1.
          </p>
          <h3>Example</h3>
          <p>
            If a normal die is rolled, what is the probability that the number
            showing is less than 7?
          </p>
          <h3>Solution</h3>
          <p>Sample space = {1,2,3,4,5,6} Event = {1,2,3,4,5,6}</p>
          <p>Hence the probability (number is less than 7) = 6/6 = 1.</p>
          <p><i>If an event is impossible, then its probability is zero</i></p>
          <h3>Another Example</h3>
          <p>Find the probability of throwing an 8 on a normal die.</p>
          <p>
            Here there are no possible outcomes in the event. i.e. Sample space
            = 1,2,3,4,5,6 Event = {}, i.e. the empty set.
          </p>
          <p>Hence the probability of throwing an 8 is 0 = 0.</p>
          <p>
            If the event is neither impossible nor certain, then clearly its
            probability is between 0 and 1.
          </p>
          <p>
            <i
              >Two events are <strong>complementary</strong> if they cannot
              occur at the same time and they make up the whole sample space.</i
            >
          </p>
        </div>
      </div>

      <h2>Mutually Exclusive Events</h2>
      <div class="content">
        <div class="text">
          <p>
            Two events are
            <strong>incompatible, disjoint or mutually exclusive</strong> when
            the occurence of one precludes the occurrence of the other, i.e.
            they can not occur at the same time. For example, we can never have
            the head side and the tail side of a coin face up at the same time.
          </p>
          <h3>Example</h3>
          <p>Suppose a die is tossed.</p>
          <p>
            Then the events E = ‘obtaining an even number’ and O = ‘obtaining a
            one’ are mutually exclusive.
          </p>
          <div class="image">
            <img
              src="../media/MutallyExclusiveDiagram.png"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.5: Mutually Exclusive Diagram</p>
          </div>
          <p>
            Notice that P (throwing an even number or one) = P(1, 2, 4, 6) 4 = 6
            = P(E)+ P (O)
          </p>
        </div>
        <div class="image">
          <img
            src="../media/Mutually-Exclusive-1024x676.jpg"
            alt=""
            width="400px"
          />
          <p class="caption">Figure 1.4: Mutually Exclusive Events</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Conditional Probability</h2>
          <p>
            A lecture on a topic of public health is held and 300 people attend.
            They are classified in the following way:
          </p>
          <div class="image">
            <img src="../media/ConditionallyDiagram.png" alt="" width="400px" />
            <p class="caption">Figure 1.5: Conditionally Probability Events</p>
          </div>
          <p>
            If one person is selected at random, find the following
            probabilities:
          </p>
          <ul>
            <li>(a) P (a doctor is chosen);</li>
            <li>(b) P (a female is chosen);</li>
            <li>(c) P (a nurse is chosen);</li>
            <li>(d) P (a male is chosen);</li>
            <li>(e) P (a female nurse is chosen);</li>
            <li>(f) P (a male doctor is chosen).</li>
          </ul>
          <h3>Solution</h3>
          <div class="image">
            <img
              src="../media/ConditionallyDiagram2.png"
              alt=""
              width="400px"
            />
          </div>
          <ul>
            <li>
              (a) The number of doctors is 190 and the total number of people is
              300, so P (doctor) 190/ 300
            </li>
            <li>(b) P(female) = 180/300</li>
            <li>(c) P(male) = 120/300</li>
            <li>(d) P(nurse) = 110/300</li>
            <li>
              (e) There are 90 female nurses, therefore P (female ∩ nurse) =
              90/300
            </li>
            <li>(f) P (male doctor) = P (male ∩ doctor) = 100/300 .</li>
          </ul>
          <p>
            Now suppose you are given the information that a female is chosen
            and you wish to find the probability that she is a nurse. This is
            what we call <strong>conditional probability</strong>. We want the
            probability that the person chosen is a nurse, subject to the
            condition that we know she is female. The notation used for this is:
          </p>
          <p>P (nurse | female)</p>
          <p>
            Read this as‘the probability of the person chosen being a nurse,
            given that she isfemale’. Since there are 180 females and of these
            90 are nurses, the required probability is 90/180 = 1/2
          </p>
          <div class="image">
            <img
              src="../media/ConditionallyDiagram3.png"
              alt=""
              width="400px"
            />
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Independence</h2>
          <p>
            Two events A and B are said to be independent if and only if P (A |
            B) = P (A), that is, when the conditional probability of A given B
            is the same as the probability of A
          </p>
          <p>
            Here is a game of chance. A friend tosses a coin and you bet on the
            outcome. Suppose she has tossed the coin 3 times and obtained
            ‘heads’ all three times. What would you bet on the fourth trial?
          </p>
          <p>
            You might be inclined to guess ‘tails’ but would still only have
            probability 1/2 of being right
          </p>
          <p>
            The chance of getting ‘tails’ on any one throw is 1/2 . The outcome
            of one throw is not affected by previous ones - the coin has no
            memory! (You might, of course, check that the coin does have a
            tail.)
          </p>
          <p>
            When the chance of a given outcome remains the same, irrespective of
            whether or not another event has occurred, the events are said to be
            <strong>independent.</strong>
          </p>
          <h3>Example</h3>
          <p>
            What is the probability of obtaining ‘six’ and ‘six’ on two
            successive rolls of a die?
          </p>
          <h3>Solution</h3>
          <p>P (obtaining 6 on a roll of a die) = 1/6</p>
          <p>
            The two rolls are independent - the die cannot remember what
            happened first.
          </p>
          <p>So P (6 and 6) = 1/6 . 1/6 = 1/66</p>
          <p>
            Notice that this is equal to the probability of ‘2’ followed by ‘3’,
            or indeed any ordered sequence of two numbers.
          </p>
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
              $lessonId = 10; 
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
                  <a href="../Quiz/ProbabilityQuiz.php">
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
