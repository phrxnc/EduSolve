<?php
session_start(); 
include_once("../dbConnection/connect.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../forms/login-signup.php");
    exit();
}

// Fetch the logged-in user's data from the database
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
    // Redirect or handle error if the user is not found
    header("Location: ../forms/login-signup.php");
    exit();
}

// Determine if the user is a student
$isStudent = $user_role === 'student';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reading Comprehension</title>
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
      <h1>Lesson 3: Reading Comprehension</h1>
      <h2>Introduction</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Reading comprehension</strong> is the ability to read,
            understand, analyze, and interpret written material. It involves
            extracting the main idea, understanding details, making inferences,
            and drawing conclusions based on the text.
          </p>
          <p>
            When we make sense of a text, however, we don’t just remember the
            exact words and phrases we read. Rather, we form a mental model of
            what the text describes by integrating the sense of the words and
            sentences into a meaningful whole, like a film that plays in our
            head.
          </p>
          <p>
            Good comprehension is vital if reading is to have a purpose, if a
            reader is to engage with and learn from a text and, ultimately, if a
            reader is to enjoy what they’re reading.
          </p>
          <div class="video">
            <video controls width="720">
              <source
                src="../media/Reading comprehension skills .mp4"
                type="video/mp4"
              />
              Your browser does not support the video tag.
            </video>
          </div>
          <h3>Factors associated with good comprehension</h3>
          <p>
            Good comprehension requires a range of different knowledge and
            skills:
          </p>
          <ul>
            <li>Vocabulary and Background knowledge</li>
            <li>Integration and Inference skills</li>
            <li>Understanding language structure/connections</li>
          </ul>

          <h2>Main Idea and Supporting Details</h2>
          <p>
            The <strong>main idea</strong> is the central point or message of a
            text. It answers the question, "What is the passage about?"
          </p>
          <p>
            <strong>Supporting details</strong> provide evidence, examples, or
            explanations that back up the main idea. For instance, in an article
            about climate change, the main idea could be the impacts of global
            warming, and the details might include melting glaciers or rising
            sea levels.
          </p>
          <h2>Making Inferences</h2>
          <p>
            <strong>Inference</strong> is the process of drawing conclusions
            from hints or implied information rather than explicitly stated
            details. For example, if a character in a story puts on a raincoat
            and grabs an umbrella, we infer that it’s going to rain.
          </p>
          <h2>Understanding Author’s Purpose and Tone</h2>
          <p>
            The <strong>author’s purpose</strong> refers to why the text was
            written:
          </p>
          <ul>
            <li>To inform (e.g., news articles).</li>
            <li>To entertain (e.g., fiction).</li>
            <li>To persuade (e.g., advertisements).</li>
          </ul>
          <p>
            <strong>Tone</strong> reflects the writer’s attitude, such as
            optimistic, sarcastic, or serious, which helps in understanding
            their viewpoint.
          </p>
          <h2>Summarizing</h2>
          <p>
            <strong>Summarizing</strong> involves reducing a text to its most
            essential points without personal opinions. This skill helps readers
            identify the core ideas of a story or article, ensuring
            comprehension of the material without unnecessary details.
          </p>
          <h2>Identifying Text Structure</h2>
          <p>
            Text structure refers to how a passage is organized. Common
            structures include:
          </p>
          <ul>
            <li>
              <strong>Cause and Effect:</strong> Shows relationships between
              actions/events.
            </li>
            <li>
              <strong>Problem and Solution:</strong> Identifies an issue and
              proposes solutions.
            </li>
            <li>
              <strong>Compare and Contrast:</strong> Highlights similarities and
              differences.
            </li>
            <li>
              <strong>Sequence:</strong> Explains events in chronological order.
            </li>
          </ul>
          <h2>Understanding Figurative Language</h2>
          <p>
            <strong>Figurative language</strong> uses expressions that go beyond
            literal meaning to create vivid imagery, such as:
          </p>
          <ul>
            <li>Metaphors: “Time is a thief.”</li>
            <li>Similes: “As brave as a lion.”</li>
            <li>Personification: “The wind whispered through the trees.”</li>
          </ul>
          <h2>Identifying Themes and Motifs</h2>
          <p>
            A <strong>theme</strong> is the overarching message or idea (e.g.,
            “friendship” or “courage”).
          </p>
          <p>
            <strong>Motifs</strong> are recurring elements or symbols that
            support the theme (e.g., recurring imagery of light symbolizing
            hope).
          </p>
          <p>Critical Reading and Evaluation</p>
          <p>
            This involves assessing the text’s credibility and logic. A critical
            reader questions:
          </p>
          <p>
            Recognizing these devices enhances comprehension of literary texts.
          </p>
          <ul>
            <li>Are the sources reliable?</li>
            <li>Is the reasoning logical and consistent?</li>
          </ul>
          <p>
            For instance, evaluating a scientific article requires checking the
            evidence and methodology.
          </p>
          <h2>Examples</h2>
          <h3>Understanding the Main Idea</h3>
          <p>
            <strong>Passage:</strong> "The Internet has transformed the way we
            learn. Online resources and courses have made education accessible
            to people across the globe."
          </p>
          <p>
            <strong>Main Idea:</strong> The Internet has made learning more
            accessible globally.
          </p>
          <h3>Making Inferences</h3>
          <p>
            <strong>Passage:</strong> "She quickly put on her coat and grabbed
            her keys. The wind outside howled as she opened the door."
          </p>
          <p>
            <strong>Inference:</strong> It is cold outside, and she is preparing
            to go out.
          </p>
          <h3>Identifying the Author's Purpose</h3>
          <p>
            <strong>Passage:</strong> "The new technology has the potential to
            revolutionize the way we live and work, improving efficiency and
            quality of life."
          </p>
          <p>
            <strong>Author's Purpose:</strong> To explain the positive impact of
            new technology.
          </p>
          <h3>Understanding Details</h3>
          <p>
            <strong>Passage:</strong> "The city park is home to many species of
            birds, including sparrows, robins, and blue jays. People visit the
            park to enjoy the birds and nature."
          </p>
          <p>
            <strong>Detail:</strong> The park has various bird species, and
            people visit for the birds and nature.
          </p>
        </div>
      </div>
      <div class="quiz-button">
        <a href="../index.php"
          ><button
            id="backbuts"
            style="padding: 20px; background-color: #1d2630; color: white"
          >
            Back
          </button></a
        >
        <?php if ($isStudent): ?>
          <a href="../Quiz/ReadingQuiz.html">
            <button
              id="test-button"
              style="padding: 20px; background-color: #1d2630; color: white"
            >
              Take Practice Test
            </button>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
