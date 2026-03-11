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
    <title>Grammar and Punctuation</title>
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
      <h1>Lesson 2: Grammar & Punctuation</h1>
      <h2>Grammar</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Grammar</strong> is the system of rules that govern how
            words and sentences are structured in a language. It helps in
            conveying clear and precise meanings.
          </p>
          <p>
            Grammatical errors can disrupt an audience’s ability to understand
            your message clearly, or can simply distract from your message.
            Further, grammatical missteps can often weaken the writer’s
            credibility, potentially causing your audience to not take your
            message seriously.
          </p>
        </div>
      </div>

      <h2>Types of Sentences</h2>
      <div class="content">
        <div class="text">
          <p>
            When we refer to grammar, we are generally speaking about how
            language is formed at the sentence level. Words are the foundation
            of sentences, and in the previous section we learned about what
            types of words make up the main part of speech.
          </p>
          <p>
            Here we focus on how we put those words together to try to create
            meaning. In future chapters we will keep building on this to learn
            about paragraphs and how we then use those in various formats like
            letters, memos, and reports.
          </p>
          <p>
            The first part of this review will focus on the three main types of
            sentences: simple, compound, and complex sentences.
          </p>
          <div class="image">
            <img src="../media/types-of-sentences1.jpg" alt="" width="350px" />
            <p class="caption">Figure 1.1: Types of Sentences</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h3>Simple Sentences</h3>
          <p>
            <strong>Simple sentences</strong> contain one subject–verb pair and
            express a complete thought. They may contain more than one subject,
            as in the following example:
          </p>
          <h4>Examples:</h4>
          <ul>
            <li>"My wife and I got married in Japan. "</li>
            <li>He cut the grass and put away the lawnmower.</li>
            <li>The movie wasn’t very interesting. (subject, verb)</li>
          </ul>
          <h3>Compound Sentences</h3>
          <p>
            The second type of sentence, the <strong>compound sentence</strong>,
            consists of two simple sentences joined by a coordinating
            conjunction.
          </p>
          <p>
            There are seven coordinating conjunctions: for, and, nor, but, or,
            yet, so. A comma precedes a coordinating conjunction, which joins
            two simple sentences.
          </p>
          <p>
            <strong>Note:</strong> Do not be confused between a coordinating
            conjunction in a compound sentence and a compound verb in a simple
            sentence. Study the following examples carefully.
          </p>
          <h4>Examples:</h4>
          <ul>
            <li>
              "My friend plays the guitar and writes music." This is a
              <strong>simple sentence</strong> containing a subject (friend) and
              a compound verb (plays/writes).
            </li>
            <li>
              My friend plays the guitar, and he writes music. This is a
              <strong>compound sentence</strong> — two simple sentences joined
              by a comma and a coordinating conjunction. The subject of the
              first simple sentence is friend, and the verb is plays. The
              subject of the second simple sentence is he, and the verb is
              writes.
            </li>
          </ul>
          <h3>Complex Sentences</h3>
          <p>
            Clauses are groups of words that contain subjects and verbs. There
            are two types:
            <strong
              >independent (main) clauses and dependent (subordinate)
              clauses.</strong
            >
          </p>
          <p>
            An independent clause, in addition to containing a subject and verb,
            expresses a complete thought and can stand alone as a simple
            sentence. A dependent clause on its own is just part of a sentence
            or fragment. It must be joined to an independent clause for it to
            make sense and present a complete thought to the reader.
          </p>
          <p>
            There are three types of dependent clauses:
            <strong
              >adjective clauses, adverb clauses, and noun clauses.</strong
            >
            When you join dependent and independent clauses together, you create
            complex sentences. Study the examples below.
          </p>
          <h4>Examples:</h4>
          <strong>Complex sentence using a dependent adjective clause: </strong>
          <ol>
            <li>
              "Vancouver has many interesting places to shop." -
              <strong>independent clause or simple sentence</strong>
            </li>
            <li>
              "which is the largest city in British Columbia." -
              <strong>dependent adjective clause</strong>
            </li>
            <li>
              "Columbia, has many interesting places to shop." -
              <strong>complex sentence </strong>
            </li>
          </ol>
          <strong
            >Complex sentence using a dependent adverb clause of reason:
          </strong>
          <ol>
            <li>
              "I went to bed early." -
              <strong>independent clause or simple sentence </strong>
            </li>
            <li>
              "because I was tired." -
              <strong>dependent adverb clause of reason </strong>
            </li>
            <li>
              "I went to bed early because I was tired." -
              <strong>complex sentence </strong>
            </li>
          </ol>
          <strong>Complex sentence using a dependent noun clause: </strong>
          <ol>
            <li>
              "I already know." -
              <strong>independent clause or simple sentence </strong>
            </li>
            <li>"what you said" - <strong>dependent noun clause </strong></li>
            <li>
              "I already know what you said." -
              <strong>complex sentence </strong>
            </li>
          </ol>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Subject-Verb Agreement</h2>
          <p>
            A grammatical rule that requires the subject and verb in a sentence
            to match in number, person, and gender.
          </p>
          <p>
            Subject-verb agreement helps readers understand who or what is doing
            something, making writing easier to read.
          </p>
          <div class="image">
            <img
              src="../media/subject_verb_agreement.jpg"
              alt=""
              width="400px"
            />
            <p class="caption">Figure 1.2: Subject-Verb Agreement</p>
          </div>
          <p>
            In English, the most common way to achieve subject-verb agreement is
            to match the number of the subject and verb:
          </p>

          <ul>
            <li><strong>Singular subject: </strong>Use a singular verb</li>
            <li><strong>Plural subject:</strong> Use a plural verb</li>
          </ul>
          <h4>However, there are some exceptions to this rule:</h4>
          <p>
            <strong>Singular "they": </strong>Use a plural verb form. For
            example, "The participant expressed satisfaction with their job".
          </p>
          <p>
            <strong
              >Singular nouns or pronouns connected by "or" or "nor": </strong
            >Use a singular verb. For example, "The chairperson or the CEO
            approves the proposal before proceeding".
          </p>
          <p>
            <strong>Titles and country names: </strong>Use a singular verb. For
            example, "The Netherlands is a European country that borders
            Belgium".
          </p>
          <p>
            <strong>The verb "be": </strong>Uses different forms based on both
            number and person.
          </p>
        </div>
      </div>

      <h2>Punctuation</h2>
      <div class="content">
        <div class="text">
          <p>
            Punctuation involves symbols that guide the reader in understanding
            the intended meaning and structure of sentences, such as periods,
            commas, colons, semicolons, and question marks.
          </p>
          <p>
            Punctuation marks provide visual clues to readers, telling them how
            they should read the sentence. Some punctuation marks tell you that
            you are reading a list of items, while other marks tell you that a
            sentence contains two independent ideas.
          </p>
          <div class="image">
            <img src="../media/punctuationmarks.jpg" alt="" width="500px" />
            <p class="caption">Figure 1.3: Punctuation Marks</p>
          </div>
          <p>
            Let’s begin with three punctuation marks you are probably already
            comfortable with.
          </p>
          <h3>Periods</h3>
          <p>
            The <strong>period (.)</strong> is a very common punctuation mark
            that indicates the end of a declarative sentence. The period can
            also be used at the end of an imperative sentence.
          </p>
          <h4>Example:</h4>
          <ul>
            <li>The concert begins in two hours.</li>
            <li>Watch for oncoming traffic.</li>
          </ul>
          <h3>Question Marks</h3>
          <p>
            The <strong>question mark (?)</strong> is used at the end of an
            interrogative sentence, indicating that the sentence is a question.
          </p>
          <p><strong>Example: </strong>Is it snowing?</p>
          <h3>Exclamation Marks</h3>
          <p>
            The <strong>exclamation mark (!)</strong> is used at the end of an
            exclamatory sentence, indicating that the sentence is an
            exclamation. The mark could also be used at the end of an imperative
            sentence to indicate a command.
          </p>
          <h4>Example:</h4>
          <ul>
            <li>This is the best day of my life!</li>
            <li>Stop what you’re doing right now!</li>
          </ul>
          <h3>Commas</h3>
          <p>
            One of the punctuation clues to reading you may encounter is the
            <strong>comma (,)</strong>. The comma indicates a pause in a
            sentence or a separation of things in a list. There are many ways to
            use a comma. Here are a few:
          </p>
          <ul>
            <li>
              <strong>Introductory word (such as a sentence adverb): </strong
              >Personally, I think the practice is helpful.
            </li>
            <li>
              <strong>Lists: </strong>
              The barn, the tool shed, and the back porch were destroyed by the
              wind.
            </li>
            <li>
              <strong>Coordinating adjectives:</strong> He was tired, hungry,
              and late.
            </li>
            <li>
              <strong>Conjunctions in compound sentences:</strong> The bedroom
              door was closed, so the children knew their mother was asleep.
            </li>
            <li>
              <strong>Interrupting words:</strong> I knew where it was hidden,
              of course, but I wanted them to find it themselves.
            </li>
            <li>
              <strong>Dates, addresses, greetings, and letters:</strong> The
              letter was postmarked December 8, 1945.
            </li>
          </ul>
          <h3>Semicolons</h3>
          <p>
            Another punctuation mark that you will encounter is the
            <strong>semicolon (;)</strong>. The semicolon indicates a break in
            the flow of a sentence, but functions differently than a period or a
            comma. When you encounter a semicolon while reading aloud, this
            indicates a place to pause and take a breath.
          </p>
          <p>
            <strong>Note: </strong>Use semicolons to join two main clauses. Do
            not use semicolons with coordinating conjunctions such as and, or,
            and but.
          </p>
          <h4>Example: Semicolons to Join Two Independent Clauses</h4>
          <ul>
            <li>
              <strong>Incorrect:</strong> Be sure to wear clean, well-pressed
              clothes to the interview, appearances are important. (incorrect
              because of comma splice/run-on-sentence)
            </li>
            <li>
              <strong>Correct:</strong> Be sure to wear clean, well-pressed
              clothes to the interview; appearances are important.
            </li>
          </ul>
          <h4>Example: Semicolons to Join Items in a List</h4>
          <ul>
            <li>
              <strong>Incorrect:</strong> The colour combinations we can choose
              from are black, white, and grey, green, brown, and black, or red,
              green, and brown.
            </li>
            <li>
              <strong>Correct:</strong> The colour combinations we can choose
              from are black, white, and grey; green, brown, and black; or red,
              green, and brown.
            </li>
          </ul>
          <h3>Colons</h3>
          <p>
            The <strong>colon (:)</strong> is used to introduce lists,
            quotations, examples, and explanations. You can also use a colon
            after the greeting in business letters and memos.
          </p>
          <h4>Examples:</h4>
          <ul>
            <li>Dear Hiring Manager:</li>
            <li>To: Human Resources</li>
          </ul>
          <strong>Colons for Lists or Explanation:</strong>
          <ul>
            <li>
              <strong>Incorrect: </strong>"You need to bring: a notebook, a pen,
              and a calculator." Explanation: The colon is used before a list or
              explanation, but it is not needed before an incomplete thought.
            </li>
            <li>
              <strong>Correct: </strong>"You need to bring the following items:
              a notebook, a pen, and a calculator."
            </li>
          </ul>
          <h3>Quotation Marks</h3>
          <p>
            <strong>Quotation marks (“ ”)</strong> set off a group of words from
            the rest of the text. Use them to indicate direct quotations or to
            indicate a title. Quotation marks always appear in pairs.
          </p>
          <h4>Example:</h4>
          <ul>
            <li>
              <strong>Incorrect:</strong> I need to finish my homework, she
              said.
            </li>
            <li>
              <strong>Correct:</strong> "I need to finish my homework," she
              said.
            </li>
          </ul>
          <p>
            <strong>Note: </strong> Quotation marks are used to indicate direct
            speech.
          </p>
          <p>
            <strong>Direct Quotations</strong> - is an exact account of what
            someone said or wrote. To include a direct quotation in your
            writing, enclose the words in quotation marks.
            <strong>For example:</strong> Carly said, “I’m not ever going back
            there again.”
          </p>
          <p>
            <strong>Indirect quotation</strong> - is a restatement of what
            someone said or wrote and does not use the person’s exact words. You
            do not need to use quotation marks for indirect quotations.
            <strong>For example:</strong> Carly said that she would never go
            back there.
          </p>
          <h3>Apostrophes</h3>
          <p>
            An <strong>apostrophe (’)</strong> is a punctuation mark that is
            used with a noun to show possession or to indicate where a letter
            has been left out to form a contraction.
          </p>
          <p>
            <strong>Possession</strong> - An apostrophe and the letter s
            indicate who or what owns something. To show possession with a
            singular noun, add ’s.
          </p>
          <h4>Example: Apostrophes for Possession</h4>
          <ul>
            <li><strong>Incorrect: </strong> "That is Marias book."</li>
            <li><strong>Correct: </strong> "That is Maria's book."</li>
          </ul>
          <p>
            <strong>Contractions</strong> - is a word that is formed by
            combining two words. In a contraction, an apostrophe shows where one
            or more letters have been left out. Contractions are commonly used
            in informal writing but not in formal writing.
          </p>
          <h4>Example: Apostrophes for Contraction</h4>

          <ul>
            <li>I don’t like ice cream.</li>
            <li>We’ll see you later.</li>
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
              $lessonId = 12; 
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
                  <a href="../Quiz/GrammarQuiz.php">
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
