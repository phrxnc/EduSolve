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
    <title>Vocabulary</title>
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
      <h1>Lesson 1: Vocabulary</h1>
      <h2>Introduction</h2>
      <div class="content">
        <div class="text">
          <strong>Vocabulary</strong> refers to the set of words known and used
          by a person in both oral and written communication. A strong
          vocabulary improves comprehension, communication, and the ability to
          express ideas. Vocabulary acquisition involves understanding words'
          meanings, how they are used in different contexts, and the
          relationships they share with other words, such as synonyms and
          antonyms.
          <h2>Synonyms and Antonyms:</h2>
          <h3>Synonyms</h3>
          <p>
            A <strong>synonym</strong> is a word/phrase, the meaning of which is
            the same or nearly the same as another word or phrase. Words that
            are synonyms are described as synonymous.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>Artful – Crafty</li>
            <li>Quick - Rapid</li>
            <li>Deceptive – Misleading</li>
            <li>Enormous – Immense</li>
          </ul>
          <h3>Antonyms</h3>
          <p>
            An <strong>antonym</strong> is a word/phrase that means the opposite
            of another word or phrase. Check the examples.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>Admire – Detest</li>
            <li>Bravery – Cowardice</li>
            <li>Generous - Stingy</li>
          </ul>
        </div>
      </div>

      <h2>Multiple Word Forms</h2>
      <div class="content">
        <div class="text">
          <h3>Verb</h3>
          <p>
            A <strong>verb</strong> is a word that describes what the subject of
            a sentence is doing. Verbs can indicate (physical or mental)
            actions, occurrences, and states of being.
          </p>
          <p>
            Every sentence must have at least one verb. At the most basic level,
            a sentence can consist solely of a single verb in the imperative
            form (e.g., “Run.”). In this example, the implied subject is “you.”
          </p>
          <h4>Examples: Verbs in a sentence</h4>
          <ul>
            <li>She decided to <strong>run</strong> in the marathon.</li>
            <li>Jeffrey <strong>builds</strong> a house.</li>
            <li>True love <strong>exists</strong>.</li>
          </ul>
          <h3>Noun</h3>
          <p>
            A <strong>noun</strong> is a word that names something, such as a
            person, place, thing, or idea. In a sentence, nouns can play the
            role of subject, direct object, indirect object, subject complement,
            object complement, appositive, or modifier.
          </p>
          <h4>Examples: Nouns</h4>
          <ul>
            <li>cat</li>
            <li>bicycle</li>
            <li>She finished the <strong>run</strong> in an hour</li>
          </ul>
          <h3>Adjectives</h3>
          <p>
            An adjective is a word that modifies or describes a noun or pronoun.
            Adjectives can be used to describe the qualities of someone or
            something independently or in comparison to something else.
          </p>
          <h4>Examples: Adjectives in a sentence</h4>
          <ul>
            <li>I like <strong>old</strong> houses.</li>
            <li>The girl is <strong>tall and skinny.</strong></li>
            <li>Jane is <strong>smarter</strong> than her brother.</li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/nounvsverbvsadjective.jpg" alt="" width="400px" />
          <p class="caption">Figure 1.1: Noun vs Verb vs Adjective</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Word Definition from Context</h2>
          <p>
            Understanding the meaning of a word in context means you use the
            words around the unfamiliar word (its context) to figure out its
            meaning. Context clues are the hints or information nearby that help
            you understand the word without needing to look it up in a
            dictionary.
          </p>
          <ul>
            <li>
              <strong>Expands Vocabulary:</strong> You’ll improve your
              vocabulary by learning new words in real-life contexts.
            </li>
            <li>
              <strong>Improves Reading Comprehension:</strong> You will be
              better at understanding texts without needing to stop and search
              for every unknown word.
            </li>
            <li>
              <strong>Enhances Fluency:</strong> Reading becomes smoother when
              you can guess the meaning of a word through its context, helping
              with faster reading.
            </li>
          </ul>
          <h3>Types of Context Clues:</h3>
          <p>
            <strong>1. Definition Clue</strong> - The sentence or passage
            directly defines the word or provides a synonym.
          </p>
          <h4>Example:</h4>
          <p>
            "Archaeologists study <strong>artifacts</strong>, which are objects
            made by humans from the past, such as tools or pottery."
          </p>
          <ul>
            <li>
              <strong>Clue: </strong> "objects made by humans from the past"
            </li>
            <li>
              <strong>Meaning of artifacts</strong>: objects made by humans from
              earlier times.
            </li>
          </ul>
          <p>
            <strong>2. Inference Clue</strong> - The meaning of the word can be
            guessed by considering the overall meaning of the sentence or
            paragraph.
          </p>
          <h4>Example:</h4>
          <p>
            "After the final whistle blew, the players left the field with
            downcast eyes, their heads lowered in defeat."
          </p>
          <ul>
            <li><strong>Clue:</strong> The players are sad and defeated.</li>
            <li>
              <strong>Meaning of "downcast":</strong> feeling sad or depressed.
            </li>
          </ul>
          <p>
            <strong>3. Comparison Clue</strong> - The word is compared to
            something else, often using "like" or "as".
          </p>
          <h4>Example:</h4>
          <p>
            "His voice was <strong>thunderous</strong>, booming across the
            stadium like a storm."
          </p>
          <ul>
            <li>
              <strong>Clue:</strong> "booming" and "like a storm" help suggest
              loudness.
            </li>
            <li>
              <strong>Meaning of "thunderous":</strong> very loud or powerful.
            </li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Word with Multiple Meanings</h2>
          <p>
            A word with multiple meanings is a word that can be interpreted in
            different ways depending on the situation. These words can have
            meanings related to different concepts, objects, or actions.
            Understanding these meanings relies on context—the surrounding
            words, the sentence structure, and the situation in which the word
            is used.
          </p>
          <div class="image">
            <img
              src="../media/Wordwithdifferentmeanings.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.2: Word with Multiple Meanings</p>
          </div>
          <h3>Example:</h3>
          <p>
            "She gave him a <i>light</i> tap on the shoulder, then added, ‘I’ll
            light the candles later.’"
          </p>
          <ul>
            <li>"Light" (tap) means a gentle or soft touch.</li>
            <li>
              "Light" (candles) means to ignite or start something burning.
            </li>
          </ul>
          <p>
            Explanation: The word "stronglight" has different meanings depending
            on the context.
          </p>
          <h3>How to Identify Multiple Meanings</h3>
          <p>
            When you come across a word with multiple meanings, consider these
            steps to understand which meaning is intended:
          </p>
          <p><strong>1. Look at the surrounding words:</strong></p>
          <p>
            Pay attention to the other words in the sentence. For example, the
            word "tap" in the first sentence gives a clue that "light" refers to
            something gentle. In the second sentence, "candles" suggests that
            "light" refers to starting a fire.
          </p>
          <p><strong>2. Consider the overall context: </strong></p>
          <p>
            Ask yourself, "What is the subject talking about?" If someone is
            discussing a soft touch, the word light is likely describing
            gentleness. If they are discussing fire or candles, it’s likely
            referring to ignition.
          </p>
          <p><strong>3. Check for common idioms or phrases: </strong></p>
          <p>
            Some words with multiple meanings may also appear in well-known
            expressions or idioms. For instance, "light as a feather" uses
            "light" to mean weightless.
          </p>
          <h3>Why Do Words Have Multiple Meanings?</h3>
          <p>
            Words often develop multiple meanings over time. A single word may
            originate from one meaning, but as language evolves, it can come to
            represent something different depending on how it is used. This is
            called <strong>polysemy</strong> — when a single word has multiple
            related meanings.
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
              $lessonId = 11; 
              $subject = 'English';

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
                  <a href="../Quiz/VocabularyQuiz.php">
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
