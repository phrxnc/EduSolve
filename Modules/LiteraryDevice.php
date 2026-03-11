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
      <h1>Lesson 4: Literary Devices</h1>
      <h2>Simile</h2>
      <div class="content">
        <div class="text">
          <p>
            A <strong>simile</strong> is a rhetorical device used to compare two
            things using the words “like,” “as,” or “than.”
          </p>
          <p>
            Similes can be used to create vivid imagery or to draw surprising
            connections between two unrelated things. They’re commonly used in
            literature, advertising, and everyday speech and are closely related
            to metaphors and analogies.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>"She ran as fast as a cheetah."</li>
            <li>"His words cut like a knife."</li>
            <li>"The clouds were fluffy like cotton candy."</li>
          </ul>
          <p>
            Similes can be used to create vivid imagery or to draw surprising
            connections between two unrelated things. They’re commonly used in
            literature, advertising, and everyday speech and are closely related
            to metaphors and analogies.
          </p>
        </div>
        <div class="image">
          <img src="../media/simile.jpg" alt="" width="400px" />
          <p class="caption">Figure 1.1: Simile</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Methaphor</h2>
          <p>
            A direct comparison between two unlike things, suggesting they are
            the same.
          </p>
          <p>
            A metaphor is a figure of speech that implicitly compares two
            unrelated things, typically by stating that one thing is another
            (e.g., “that chef is a magician”)
          </p>
          <p>
            Metaphors are commonly used in literature, advertising, and everyday
            speech.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>"The world is a stage."</li>
            <li>"His heart is a cold stone."</li>
            <li>"The snow was a white blanket covering the ground."</li>
          </ul>
          <div class="image">
            <img src="../media/simile-vs-metaphor.png" alt="" width="400px" />
            <p class="caption">Figure 1.2: Simile vs Metaphor</p>
          </div>
        </div>
      </div>

      <h2>Personification</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Personification</strong> is a figure of speech that is used
            to attribute human characteristics to something that is not human.
            It can also be used to personify an abstract quality.
          </p>
          <p>
            Personification can be used in a sentence to describe something
            concisely and also to bring a deeper meaning and connection to the
            object or virtue being personified. However, it is figurative and so
            it cannot be used in formal essays, any kind of professional or
            technical writing or to convey something literal.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>"The flowers waved hello as the breeze passed by."</li>
            <li>"The car groaned as it climbed the steep hill."</li>
            <li>"The clock stared at me, urging me to hurry."</li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/personification.jpg" alt="" width="400px" />
          <p class="caption">Figure 1.3: Personification</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Hyperbole</h2>

          <p>
            A rhetorical device that is mainly used to make something look and
            sound a lot better than it actually is. In other words, it can be
            said to be a form of exaggeration.
          </p>
          <p>An exaggerated statement not meant to be taken literally.</p>
          <p>
            The main purpose of a hyperbole is to emphasise something or to make
            a mind-blowing effect on the reader or listener.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>"I’ve told you a million times to clean your room!"</li>
            <li>"She’s so tall, she can touch the sky."</li>
            <li>"I’m so tired I could sleep for a year."</li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Alliteration</h2>
          <p>
            <strong>Alliteration</strong> is a literary device that uses similar
            phonetic sounds in continuity to make an effect. This device is
            usually used to decorate the words with a musical, lyrical or
            emotional effect.
          </p>
          <p>
            Basically, The repetition of the same initial consonant sounds in a
            series of words.
          </p>
          <p>
            Now, using alliteration can be made easy if you understand a few
            basic facts about it. Take a look at the following points.
          </p>
          <ul>
            <li>
              Alliteration is formed using words beginning with similar
              consonant or vowel sounds.
            </li>
            <li>
              These words have to be used consecutively, one after the other.
            </li>
            <li>
              Similar sounding syllables can also be used to form alliterated
              sentences.
            </li>
          </ul>
          <div class="image">
            <img
              src="../media/Figurative-Language-Illustration.jpg"
              alt=""
              width="400px"
            />
            <p class="caption">Figure 1.4: Figures of Speech</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Onomatopoeia</h2>
          <p>
            Onomatopoeia is a figure of speech in which a word is pronounced the
            same way as the sound associated with it. Onomatopoeia occurs most
            commonly with animal sounds (e.g., the buzz from a bee), mechanical
            sounds (e.g., the clang of metal on metal), and action/impact sounds
            (e.g., the boom from an explosion).
          </p>
          <p>A word that imitates a natural sound.</p>
          Onomatopoeia, like other sound devices (e.g., sibilance and
          alliteration), is used to enhance the reading or listening experience.
          Writers often use onomatopoeia for the following reasons:
          <ul>
            <li>
              <strong>Create vivid imagery</strong>. Mimicking real-life sounds
              allows writers to create more detailed and sensory-rich scenes.
            </li>
            <li>
              <strong>Evoke an auditory response</strong>. Using onomatopoeia
              creates a more immersive reading experience and allows the reader
              to “hear” the sounds within the story.
            </li>
          </ul>
          <h3>Examples:</h3>
          <ul>
            <li>"The bees <strong>buzzed</strong> in the garden."</li>
            <li>"The door <strong>creaked</strong> open slowly."</li>
            <li>"The fireworks <strong>boomed</strong> in the night sky."</li>
          </ul>
        </div>
      </div>

      <h2>Foreshadowing</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Foreshadowing</strong>, the organization and presentation of
            events and scenes in a work of fiction or drama so that the reader
            or observer is prepared to some degree for what occurs later in the
            work.
          </p>
          <p>
            Giving hints or clues about events that will happen later in the
            story.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>
              A character finding a mysterious letter that becomes important
              later.
            </li>
            <li>
              Dark storm clouds gathering as characters discuss an upcoming
              battle.
            </li>
            <li>
              A broken watch mentioned early in the story hinting at lost time.
            </li>
            <li>
              The disastrous flood that occurs at the end of George Eliot’s The
              Mill on the Floss (1860), is foreshadowed by many references to
              the river and to water in general throughout the book.
            </li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/Foreshadow.jpg" alt="" width="400px" />
          <p class="caption">Figure 1.5: Foreshadowing</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Irony</h2>
          <p>
            Irony is a rhetorical device that is used to express an intended
            meaning by using language that conveys the opposite meaning when
            taken literally.
          </p>
          <p>
            Irony is a rhetorical device that is used to express an intended
            meaning by using language that conveys the opposite meaning when
            taken literally.
          </p>
          <h3>The Different Types of Irony</h3>
          <ul>
            <li>
              <strong>Dramatic irony</strong> is the type in which one or more
              characters in a story or a play is given no idea of a very
              important piece of information that would alter their lives and
              also change the course of the plot completely. Dramatic irony
              keeps the readers excited and sustains the interest in the
              happenings of the story. It lets the audience have sympathy for
              the characters in the story, instils fear in them and builds
              suspense. In simple terms, when dramatic irony is employed, the
              audience knows something that the characters have not yet found
              out or understood. William Shakespeare is known widely for the use
              of dramatic irony in most of his tragic plays. Christopher
              Marlowe, Jane Austen, Jonathan Swift and Thomas Hardy are some of
              the writers who made effective use of dramatic irony in their
              writings.
            </li>
            <li>
              <strong>Situational irony</strong> is the one in which the events
              in the story or play give the readers a result that is different
              from what they had been expecting to occur. This type of irony
              puts the protagonist of the story/play in a situation that demands
              a heavy price in order to get to their goal. It also aids in
              creating a ‘twist’. Who doesn’t like a good twist, right? This
              situation would push the character to a whole new level. It can
              also be used to communicate an intended message or moral to the
              audience. O. Henry, Kate Chopin, Christopher Marlowe, Jane Austen,
              William Shakespeare and Guy de Maupassant are some of the writers
              who made good use of situational irony in their works.
            </li>
            <li>
              <strong>Verbal irony</strong> is when the author has put the
              characters’ lines in such a way that the intended meaning is the
              exact opposite of what is being said. Unlike the other two types
              of irony, when verbal irony is used, the character knows the truth
              but uses irony intentionally in a sarcastic manner to reveal the
              hidden truth. Jonathan Swift, William Shakespeare, Jane Austen,
              Samuel Taylor Coleridge, Edgar Allen Poe and George Bernard Shaw
              are known for the use of verbal irony in their works.
            </li>
          </ul>
          <h3>Examples:</h3>
          <ul>
            <li>
              <strong>Dramatic irony:</strong> The audience knows Juliet is
              alive, but Romeo does not (Romeo and Juliet).
            </li>
            <li>
              <strong>Situational irony:</strong> A police station gets robbed.
            </li>
            <li>
              <strong>Verbal irony:</strong> "Oh great, another rainy day," said
              during a storm.
            </li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Oxymoron</h2>
          <p>
            An <strong>oxymoron</strong> is a rhetorical device that uses two
            opposite or contradictory terms one after the other in order to
            project an effect.
          </p>
          <p>A phrase that combines two contradictory terms.</p>
          <p>
            An oxymoron, as already discussed, is the combination of two
            contradicting terms. There are some points you have to remember when
            forming and using oxymorons in sentences. The first point you have
            to keep in mind is that you have to combine two opposite words, only
            then can it be considered an oxymoron. Also, do not just use any two
            opposite terms. Not every combination would make sense. You have to
            carefully analyse which two words would create an effect on your
            audience.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>“Parting is such <strong>sweet sorrow.</strong>”</li>
            <li>O <strong>heavy lightness!</strong> Serious vanity!</li>
            <li>"Jumbo shrimp"</li>
            <li>"Bittersweet moment"</li>
            <li>"Living dead"</li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Imagery</h2>
          <p>
            Imagery is language used by poets, novelists and other writers to
            create images in the mind of the reader. Imagery includes figurative
            and metaphorical language to improve the reader’s experience through
            their senses.
          </p>
          <p>
            Descriptive language that appeals to the senses (sight, sound,
            smell, touch, taste).
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>
              Imagery using <strong>visuals</strong>: The night was black as
              ever, but bright stars lit up the sky in beautiful and varied
              constellations which were sprinkled across the astronomical
              landscape.
            </li>
            <li>
              Imagery using <strong>sounds</strong>: Silence was broken by the
              peal of piano keys as Shannon began practicing her concerto.
            </li>
            <li>
              Imagery using <strong>scent</strong>: She smelled the scent of
              sweet hibiscus wafting through the air, its tropical smell a
              reminder that she was on vacation in a beautiful place.
            </li>
            <li>
              Imagery using <strong>taste</strong>: The candy melted in her
              mouth and swirls of bittersweet chocolate and slightly sweet but
              salty caramel blended together on her tongue. Thanks to an
              in-depth description of the candy’s various flavors, the reader
              can almost experience the deliciousness directly.
            </li>
            <li>
              Imagery using <strong>touch</strong>: After the long run, he
              collapsed in the grass with tired and burning muscles. The grass
              tickled his skin and sweat cooled on his brow.
            </li>
          </ul>
          <h3>Types of Imagery:</h3>
          <ul>
            <li>
              <strong>Visual imagery</strong> describes what we see: comic book
              images, paintings, or images directly experienced through the
              narrator’s eyes. Visual imagery may include:
              <ul>
                <li>
                  Color, such as: burnt red, bright orange, dull yellow, verdant
                  green, and Robin’s egg blue.
                </li>
                <li>
                  Shapes, such as: square, circular, tubular, rectangular, and
                  conical.
                </li>
                <li>
                  Size, such as: miniscule, tiny, small, medium-sized, large,
                  and gigantic.
                </li>
              </ul>
            </li>
            <li>
              <strong>Auditory imagery</strong> describes what we hear, from
              music to noise to pure silence. Auditory imagery may include:
              <ul>
                <li>
                  Enjoyable sounds, such as: beautiful music, birdsong, and the
                  voices of a chorus.
                </li>
                <li>
                  Noises, such as: the bang of a gun, the sound of a broom
                  moving across the floor, and the sound of broken glass
                  shattering on the hard floor.
                </li>
                <li>
                  The lack of noise, describing a peaceful calm or eerie
                  silence.
                </li>
              </ul>
            </li>
            <li>
              <strong>Olfactory imagery</strong> describes what we smell.
              Olfactory imagery may include:
              <ul>
                <li>
                  Fragrances, such as perfumes, enticing food and drink, and
                  blooming flowers.
                </li>
                <li>
                  Odors, such as rotting trash, body odors, or a stinky wet dog.
                </li>
              </ul>
            </li>
            <li>
              <strong>Gustatory imagery</strong> describes what we taste.
              Gustatory imagery can include:
              <ul>
                <li>Sweetness, such as candies, cookies, and desserts.</li>
                <li>
                  Sourness, bitterness, and tartness, such as lemons and limes.
                </li>
                <li>
                  Saltiness, such as pretzels, French fries, and pepperonis.
                </li>
                <li>Spiciness, such as salsas and curries.</li>
                <li>Savoriness, such as a steak dinner or thick soup.</li>
              </ul>
            </li>
            <li>
              <strong>Tactile imagery</strong> describes what we feel or touch.
              Tactile imagery includes:
              <ul>
                <li>
                  Temperature, such as bitter cold, humidity, mildness, and
                  stifling heat.
                </li>
                <li>Texture, such as rough, ragged, seamless, and smooth.</li>
                <li>
                  Touch, such as hand-holding, one’s in the grass, or the
                  feeling of starched fabric on one’s skin.
                </li>
                <li>
                  Movement, such as burning muscles from exertion, swimming in
                  cold water, or kicking a soccer ball.
                </li>
              </ul>
            </li>
          </ul>
          <div class="image">
            <img src="../media/Imagery.png" alt="" width="600px" />
            <p class="caption">Figure 1.6: Imagery</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Allusion</h2>
          <p>
            Allusion is a reference to a well-known person, character, place, or
            event that a writer makes to deepen the reader’s understanding of
            their work. Allusions aren’t reserved for writing, though—we
            frequently use them in our speech.
          </p>
          <p>
            An allusion is a concise way to communicate a lot of meaning. Think
            of it like a writing shortcut. You could spend a paragraph or two
            describing why a proposed business venture is doomed to fail despite
            it checking all the boxes for being the best in its market, or you
            could describe it as “unsinkable” and instantly communicate the same
            sentiment.
          </p>
          <h3>Examples:</h3>
          <ul>
            <li>"He met his Waterloo." (Refers to Napoleon's final defeat.)</li>
            <li>"She had a Mona Lisa smile."</li>
            <li>"It felt like opening Pandora’s box."</li>
          </ul>

          <h3>Types of Allusion</h3>
          <p>
            <strong>Casual allusion</strong> is a single allusion that doesn’t
            significantly impact the reader’s understanding of the work.
          </p>
          <p>
            For example, you might describe a character’s home as “the kind of
            place where Tim Burton would be right at home.” Readers who are
            familiar with Burton’s work would visualize the home as having lots
            of sharp, angular black and white design elements. Readers who
            aren’t familiar might not picture this, but they could continue
            reading without losing understanding of the story.
          </p>
          <p>
            <strong>Self-reference</strong> or also known as
            <i>self-allusion</i> is an allusion to one of your own works. Author
            Wally Lamb does this in a few of his books, which take place in a
            shared fictional community.
          </p>
          <p>
            You might work a self-reference into a story by having the
            protagonist interact with the protagonist of a previous story. You
            can also reference your own work by using a piece’s words in a new
            way, like using a past poem’s refrain as the opening line in a new
            poem.
          </p>
          <p>
            <strong>Corrective allusion</strong> is where a writer makes a
            reference, but for the purpose of opposing the original reference.
          </p>
          <p>
            While Shakespeare’s Romeo and Juliet is alluded to frequently to
            communicate ideas about true love and star-crossed lovers, a writer
            might use a corrective allusion like this:
          </p>
          <dl>
            <dd>
              <i
                >They were a pair of star-crossed lovers, doomed to stoke chaos
                and destroy lives.</i
              >
            </dd>
          </dl>
          <p>
            See how this allusion flips the typical reference to Romeo and
            Juliet on its head, referencing the destruction that resulted from
            their pairing?
          </p>
          <p>
            <strong>Single reference</strong> is a straightforward allusion
            where the reader is supposed to recognize the reference and
            understand its meaning. With a single reference, the allusion does
            not extend beyond the one instance—in other words, there aren’t
            follow-up references that could drive the work into allegory
            territory.
          </p>
          <p>
            Single references can communicate meaningful ideas, but they can
            also be one-off moments where you can slip a joke or a wink into
            your writing. For example, you might allude to Atlas, a figure from
            Greek mythology, in a persuasive essay about hard-working frontline
            workers “holding the world on their shoulders.” Or you might tease
            your mailing list by referencing Pokémon in a promotional email that
            says “A wild discount appeared!”
          </p>
          <p>
            <strong>Apparent allusion</strong> is an allusion that makes a
            specific reference for the purpose of challenging that reference.
            Apparent allusions can work similarly to corrective allusions, but
            the difference is that while a corrective allusion overtly opposes
            the original source, an apparent allusion challenges it.
          </p>
          <p>
            An example of an apparent allusion occurs in Toni Morrison’s The
            Bluest Eye, where she uses a section of a Dick and Jane primer as a
            way to comment on how and what children are taught about culture
            through their schoolwork.
          </p>
          <p>
            <strong>Multiple reference, </strong>when a work contains multiple
            instances of allusion to various practices or tropes from a singular
            cultural tradition, it’s known as a conflation or multiple
            reference. The Scary Movie series is an example of movies that use
            multiple reference to poke fun at the horror film genre.
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Allegory</h2>
          <p>A story with a deeper meaning, often moral or political.</p>
          <h3>Examples:</h3>
          <ul>
            <li>
              Animal Farm by George Orwell symbolizes the Russian Revolution.
            </li>
            <li>
              The Allegory of the Cave by Plato symbolizes human perception and
              reality.
            </li>
            <li>
              The Lion, the Witch, and the Wardrobe by C.S. Lewis symbolizes
              Christianity.
            </li>
          </ul>
          <h3>Allegory vs. Symbolism</h3>
          <p>
            Allegory and symbolism are often confused, but they are not the same
            thing.
          </p>
          <ul>
            <li>
              <strong>Allegory</strong> is a work that makes extensive use of
              symbolism in order to communicate a broader moral or meaning.
              Nearly every aspect of an allegory—from characters, to objects, to
              dialogue, to settings, to major plot events—can typically be
              interpreted as having a secondary, symbolic meaning that fits into
              the allegory's broader meaning. For instance, in the 17th-century
              allegory Pilgrim's Progress, the protagonist (named "Christian")
              and his journey, as well as every other character, object, and
              location he interacts with along the way, symbolically fit into a
              larger moral or lesson about the proper "path" to reach heaven.
            </li>
            <li>
              <strong>Symbolism</strong> is the use of symbols, usually physical
              objects, to represent abstract ideas or qualities. For instance,
              in <i>To Kill a Mockingbird the Mockingbird</i> symbolizes
              innocence and beauty.
            </li>
          </ul>
          <p>
            So, to put it another way: an allegory is a type of work or story
            that represents some idea, concept, or historical event that is
            different from the literal events contained within the story.
            Symbolism is the technique that an allegory uses in order to be able
            to represent and communicate its deeper meaning.
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Paradox</h2>
          <p>
            A paradox is a figure of speech in which a statement appears to
            contradict itself. This type of statement can be described as
            paradoxical. A compressed paradox comprised of just a few words is
            called an oxymoron. This term comes from the Greek paradoxa, meaning
            "incredible, contrary to opinion or expectation."
          </p>
          <p>
            Basically, a statement that seems contradictory but reveals a deeper
            truth.
          </p>
          <h3>Examples:</h3>
          <p>
            A paradox can have positive or negative connotations, can be used in
            writing or speech, and can be used individually or within a set of
            paradoxes—these are flexible devices. To get a better understanding
            of what a paradox is beyond a figure of speech and how it may be
            used, read these quotes and examples.
          </p>
          <ul>
            <li>"The only constant is change."</li>
            <li>"I must be cruel to be kind." -Hamlet</li>
            <li>"This is the beginning of the end."</li>
            <li>
              <i
                >"Paradoxically though it may seem ... , it is none the less
                true that life imitates art far more than art imitates life.”</i
              >
              -Oscar Wilde
            </li>
            <li>
              <i>"Some of the biggest failures I ever had were successes." </i
              >-Pearl Bailey
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
              $lessonId = 14; 
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
                  <a href="../Quiz/LiteraryDeviceQuiz.php">
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
