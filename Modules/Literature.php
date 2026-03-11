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
    <title>Literary Devices</title>
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
      <h1>Lesson 5: Literature</h1>
      <h2>Literature</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Literature,</strong> a body of written works. The name has
            traditionally been applied to those imaginative works of poetry and
            prose distinguished by the intentions of their authors and the
            perceived aesthetic excellence of their execution. Literature may be
            classified according to a variety of systems, including language,
            national origin, historical period, genre, and subject matter.
          </p>
          <h2>The scope of literature</h2>
          <p>
            Literature is a form of human expression. But not everything
            expressed in words—even when organized and written down—is counted
            as literature. Those writings that are primarily
            informative—technical, scholarly, journalistic—would be excluded
            from the rank of literature by most, though not all, critics.
            Certain forms of writing, however, are universally regarded as
            belonging to literature as an art. Individual attempts within these
            forms are said to succeed if they possess something called artistic
            merit and to fail if they do not. The nature of artistic merit is
            less easy to define than to recognize. The writer need not even
            pursue it to attain it. On the contrary, a scientific exposition
            might be of great literary value and a pedestrian poem of none at
            all.
          </p>
          <h2>Novel</h2>
          <p>
            an invented prose narrative of considerable length and a certain
            complexity that deals imaginatively with human experience, usually
            through a connected sequence of events involving a group of persons
            in a specific setting.
          </p>
          <p>A novel typically includes:</p>
          <ul>
            <li>A complex plot</li>
            <li>Well-developed characters</li>
            <li>A coherent theme</li>
            <li>A narrative that explores human experience</li>
            <li>
              A setting that can be in the present, past, future, or another
              location
            </li>
          </ul>
          <p>
            Novels are usually at least 50,000 words long, but can be much
            longer. They are one of the most popular forms of literature.
          </p>
          <p>
            Novels come in many genres,
            <strong
              >including historical, picaresque, sentimental, Gothic,
              psychological, and more.
            </strong>
          </p>
          <h3>Elements</h3>
          <p>
            Novels can include many elements, such as the
            <strong
              >story, characters, setting, narrative method, point of view, and
              scope.
            </strong>
          </p>

          <h2>Poetry</h2>
          <p>
            <strong>Poetry</strong> is a literary art that uses language's
            aesthetic and rhythmic qualities to create meaning. The word
            "poetry" comes from the Medieval Latin word poētria, which means
            "poetic art"
          </p>
          <p>
            Poems are usually written in verse, which is a series of lines that
            follow a rhythmic or other deliberate structure. Poems can be
            structured with rhyming lines and meter, which is the rhythm and
            emphasis of a line based on syllabic beats.
          </p>
          <h3>Types of Poetry</h3>
          <p>
            Poetry can be divided into further genres, such as
            <strong>epic, lyric, narrative, satirical, or prose poetry.</strong>
          </p>
          <p>
            Poets use a variety of techniques, called
            <strong>poetic devices</strong>, to create artistic effects. These
            include:
          </p>
          <ul>
            <li>
              <strong>Assonance</strong> - Repetition of vowel sounds in nearby
              words (e.g., "The rain in Spain").
            </li>
            <li>
              <strong>Alliteration</strong> - Repetition of the same initial
              consonant sounds (e.g., "Peter Piper picked a peck").
            </li>
            <li>
              <strong>Euphony</strong> - Pleasant, harmonious sound created by
              soft and melodic words.
            </li>
            <li>
              <strong>Cacophony</strong> - Harsh, jarring sounds created by
              clashing or discordant words.
            </li>
            <li>
              <strong>Onomatopoeia</strong> - Words that imitate natural sounds
              (e.g., "buzz," "crash").
            </li>
            <li>
              <strong>Sound Symbolism</strong> - Use of specific sounds to evoke
              a particular meaning or feeling (e.g., "sl" for slippery: "slide,"
              "slip").
            </li>
          </ul>
          <h2>Drama</h2>
          <p>
            <strong>Drama</strong> is the specific mode of fiction represented
            in performance: a play, opera, mime, ballet, etc., performed in a
            theatre, or on radio or television.
          </p>
          <p>
            Considered as a genre of poetry in general, the dramatic mode has
            been contrasted with the epic and the lyrical modes ever since
            Aristotle's Poetics (c. 335 BC) — the earliest work of dramatic
            theory.
          </p>
          <p>
            In most cases, dramas take the form of plays, where a written script
            by a playwright is performed at a theatre in front of a live
            audience. A drama could also refer to any other performance that may
            be either live or recorded, such as mime theatre, ballets, musicals,
            operas, films, television shows, or even radio programmes.
          </p>
          <h3>Elements</h3>
          <p>
            Although dramas can take various shapes and forms, here are a few
            common elements that bind all dramas together as a genre.
            <strong>
              plot and action, audience, characters, dialogue and
              staging</strong
            >
          </p>
          <h2>Examples of Literature:</h2>
          <h3>English Works</h3>
          <ul>
            <li>
              <strong>Novel</strong>: To Kill a Mockingbird by Harper Lee -
              Explores themes of
              <strong>justice, racism, and moral growth.</strong>
              <a href="../media/TKaMFullText.pdf" target="_blank">Read here!</a>
            </li>
            <div class="image">
              <img
                src="../media/640px-To_Kill_a_Mockingbird_(first_edition_cover).jpg"
                alt=""
                width="350px"
              />
              <p class="caption">
                Figure 1.1.: To Kill a Mockingbird By Harper Lee
              </p>
            </div>
            <div class="video">
              <video controls width="720">
                <source
                  src="../media/To Kill a Mockingbird - Book Summary.mp4"
                  type="video/mp4"
                />
                Your browser does not support the video tag.
              </video>
            </div>

            <li>
              <strong>Poetry</strong>: The Road Not Taken by Robert Frost - A
              reflection on <strong>life choices</strong> and their
              consequences.
              <pre>
              <i>
                <strong>The Road Not Taken</strong>
                By Robert Frost

                Two roads diverged in a yellow wood,
                And sorry I could not travel both
                And be one traveler, long I stood
                And looked down one as far as I could
                To where it bent in the undergrowth;


                Then took the other, as just as fair,
                And having perhaps the better claim,
                Because it was grassy and wanted wear;
                Though as for that the passing there
                Had worn them really about the same,


                And both that morning equally lay
                In leaves no step had trodden black.
                Oh, I kept the first for another day!
                Yet knowing how way leads on to way,
                I doubted if I should ever come back.


                I shall be telling this with a sigh
                Somewhere ages and ages hence:
                Two roads diverged in a wood, and I—
                I took the one less traveled by,
                And that has made all the difference.
                </i>
              </pre>
            </li>
            <li>
              <strong>Drama</strong>: Romeo and Juliet by William Shakespeare -
              A timeless story of <strong>love and tragedy.</strong>
              <a
                href="../media/romeo-and-juliet_PDF_FolgerShakespeare.pdf"
                target="_blank"
                >Read here!</a
              >
            </li>
            <div class="image">
              <img
                src="../media/Romeo&JulietBookCover.jpg"
                alt=""
                width="350px"
              />
              <p class="caption">
                Figure 1.2.: Romeo and Juliet By William Shakespeare
              </p>
            </div>
          </ul>

          <h3>Filipino Works</h3>
          <ul>
            <li>
              <strong>Novel</strong>: Noli Me Tangere by Dr. José Rizal - A
              powerful critique of
              <strong>colonialism and social injustices</strong> in the
              Philippines.
              <p>
                Read Here:
                <a href="../media/Noli-Me-Tangere.pdf" target="_blank">PDF</a>
                <a
                  href="../media/The Project Gutenberg eBook of Noli Me Tangere, by Dr. José Rizal..html"
                  target="_blank"
                  >HTML</a
                >
              </p>
            </li>
            <div class="image">
              <img src="../media/nolibookcover.jpg" alt="" width="350px" />
              <p class="caption">
                Figure 1.3.: Noli Me Tangere By Dr. Jose Rizal
              </p>
            </div>
            <li>
              <strong>Poetry</strong>: Ang Pamana by Jose Corazon de Jesus -
              Celebrates the <strong>sacrifices and love</strong> of mothers.
              <pre>
                
                <i>
                <strong>Ang Pamana</strong>
                by Jose Corazon de Jesus

                Isang araw ang ina ko’y nakita kong namamanglaw,
                Naglilinis ng marumi’t mga lumang kasangkapan.
                Sa pilak ng kanyang buhok na hibla na katandaan,
                Nabakas ko ang maraming taon niyang kahirapan.

                Nakita ko ang ina ko’y tila baga nalulumbay,
                At ang sabi, “Itong piyano sa iyo ko ibibigay,
                Ang kubyertos nating pilak ay kay Itang maiiwan,
                Mga silya’t aparador ay kay Tikong nababagay.
                Sa ganyan ko hinahati itong ating munting yaman.”

                Pinilit kong pasayahin ang lungkot ng aking mukha,
                Tinangka kong magpatawa upang siya ay matuwa.
                Subalit sa aking mata’y may namuong mga luha,
                Naisip ko ang ina ko, ang ina ko na kawawa.

                Tila kami iiwan na’t may yari nang huling nasa,
                At sa halip na magalak sa pamanang mapapala,
                Sa puso ko ay dumalaw ang malungkot na gunita.
                Napaiyak akong tila isang kaawa-awang bata,
                Niyakap ko ang ina ko at sa kanya ay winika:

                "Ang ibig ko sana, Ina’y ikaw aking pasiyahin,
                At huwag nang makita pang ika’y nalulungkot mandin.
                O, Ina ko, ano po ba at naisipang hatiin
                Ang lahat ng munting yamang maiiwan sa amin?"

                "Wala naman," yaong sagot, "baka ako ay tawagin
                Ni Bathala. Mabuti nang malaman mo ang habilin.
                Iyang piyano, itong silya’t aparador ay alaming
                Pamana ko na sa iyo, bunsong ginigiliw."

                "Ngunit Inang," ang sagot ko, "ang lahat ng kasangkapan,
                Ang lahat ng yaman dito ay hindi ko kailangan.
                Ang ibig ko’y ikaw, Ina, ang ibig ko’y ikaw, Inang.
                Hinihiling ko sa Diyos na ang pamana ko’y ikaw.

                Aanhin ko iyong piyano kapag ikaw ay mamatay,
                At hindi ko matutugtog sa tabi ng iyong hukay?
                Ililimos ko sa iba ang lahat ng ating yaman,
                Pagkat di ka maaaring pantayan ng daigdigan.
                Pagkat ikaw, O Ina ko, ika’y wala pang kapantay."
                </i>
              </pre>
            </li>
            <li>
              <strong>Drama</strong>: Walang Sugat by Severino Reyes - A drama
              about <strong>love and patriotism</strong> during the Philippine
              revolution.
              <a
                href="../media/Walang Sugat ni Severino Reyes _ Philippine Literature.html"
                target="_blank"
                >Read here!</a
              >
            </li>

            <div class="image">
              <img
                src="../media/Walang-Sugat-39-Mabuhay-LSalcedo-sf.jpg"
                alt=""
                width="350px"
              />
              <p class="caption">Figure 1.4.: Walang Sugat by Severino Reyes</p>
            </div>
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
              $lessonId = 15; 
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
                  <a href="../Quiz/LiteratureQuiz.php">
                      <button id="test-button" style="padding: 20px; background-color: #1d2630; color: white">
                          Take Practice Test
                      </button>
                  </a>
              <?php endif; ?>
          <?php endif; ?>
      </div>
  </body>
</html>
