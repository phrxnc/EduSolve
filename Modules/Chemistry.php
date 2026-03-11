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
    <title>Chemistry</title>
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
      <h1>Lesson 2: Chemistry</h1>
      <h2>Matter</h2>
      <div class="content">
        <div class="text">
          <p>
            Matter is described as something that has mass and occupies space.
            All physical structures are made up of matter, and the state or
            process of matter is an easily observed property of matter. Strong,
            liquid, and gas are the three basic states of matter.
          </p>
          <p>
            Everything that exists is made up of matter. Atoms and substances
            are made up of minuscule pieces of matter. The atoms that make up
            the objects we see and touch every day are made up of matter. All
            that has mass and occupies space has volume is known as matter. The
            amount of matter in an object is measured by its mass.
          </p>
          <h3>Solid</h3>
          <ul>
            <li>In solids, particles are tightly or closely packed.</li>
            <li>
              The gaps between the particles are tiny and hence it is tough to
              compress them.
            </li>
            <li>Solid has a fixed shape and volume.</li>
            <li>An example of solids: solid ice, sugar, rock, wood, etc.</li>
          </ul>
          <h3>Liquid</h3>
          <ul>
            <li>
              In a liquid state of matter, particles are less tightly packed as
              compared to solids.
            </li>
            <li>
              Liquids take the shape of the container in which they are kept.
            </li>
            <li>Liquids have fixed volume but no fixed shape.</li>
            <li>
              Example of a liquid state of matter: water, milk, blood, coffee,
              etc.
            </li>
          </ul>
          <h3>Gas</h3>
          <ul>
            <li>In gases, particles are far apart from each other.</li>
            <li>
              Force of attraction between the particles is negligible, and they
              can move freely.
            </li>
            <li>Gases have neither a fixed volume nor a fixed shape.</li>
            <li>
              An example of gases: air, helium, nitrogen, oxygen, carbon
              dioxide, etc.
            </li>
          </ul>
          <h3>Plasma</h3>
          <ul>
            <li>
              Plasma is a not so generally seen form of matter. Plasma consists
              of particles with extremely high kinetic energy. Electricity is
              used to ionize noble gases and make glowing signs, which is
              essentially plasma.
            </li>
            <li>Superheated forms of plasma are what stars are.</li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/States of Matter.png" alt="" width="500px" />
          <p class="caption">Figure 2.1: States of Matter</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Properties of Matter</h2>
          <div class="image">
            <img src="../media/Chemistry1.png" alt="" width="500px" />
            <p class="caption">Figure 2.2: Properties of Matter</p>
          </div>
          <p>
            All matter has physical and chemical properties. Physical properties
            are characteristics that scientists can measure without changing the
            composition of the sample under study, such as mass, color, and
            volume (the amount of space occupied by a sample). Chemical
            properties describe the characteristic ability of a substance to
            react to form new substances; they include its flammability and
            susceptibility to corrosion. All samples of a pure substance have
            the same chemical and physical properties. For example, pure copper
            is always a reddish-brown solid (a physical property) and always
            dissolves in dilute nitric acid to produce a blue solution and a
            brown gas (a chemical property).
          </p>
          <h3>Physical Properties</h3>
          <ul>
            <li>
              Properties are the characteristics that enable us to differentiate
              one material from another. A physical property is an attribute of
              matter that is independent of its chemical composition. .
            </li>
            <li>
              Density, colour, hardness, melting and boiling points, and
              electrical conductivity are all examples of physical properties.
            </li>
            <li>
              Any characteristic that can be measured, such as an object’s
              density, colour, mass, volume, length, malleability, melting
              point, hardness, odour, temperature, and more, are considered
              properties of matter.
            </li>
          </ul>
          <h3>Chemical Properties</h3>
          <p>
            Chemical properties are characteristics that can only be measured or
            observed as matter transforms into a particular type of matter.
            Reactivity, flammability, and the ability to rust are among them.
            The tendency of matter to react chemically with other substances is
            known as reactivity. Flammability, toxicity, acidity, the reactivity
            of various types, and heat of combustion are examples of chemical
            properties.
          </p>
          <ul>
            <li>
              <strong>Reactivity</strong> – The tendency of matter to combine
              chemically with other substances is known as reactivity. Certain
              materials are highly reactive, whereas others are extremely
              inactive. Potassium, for example, is extremely reactive, even in
              the presence of water. A pea-sized piece of potassium reacts
              explosively when combined with a small volume of water.
            </li>
            <li>
              <strong>Flammability</strong> – The tendency of matter to burn is
              referred to as flammability. As matter burns, it reacts with
              oxygen and transforms into various substances. A flammable matter
              is anything like wood.
            </li>
            <li>
              <strong>Toxicity</strong> – Toxicity refers to the extent to which
              a chemical element or a combination of chemicals may harm an
              organism.
            </li>
            <li>
              <strong>Acidity</strong> - A substance’s ability to react with an
              acid is a chemical property. Some metals form compounds when they
              react with different acids. Acids react with bases to create
              water, which neutralizes the acid.
            </li>
          </ul>
          <h2>Intensive and Extensive Properties of Matter</h2>
          <p>
            Both the physical and chemical properties of matter are either
            extensive or intensive. Extensive properties including mass and
            volume are proportional to the amount of matter being weighed.
            Density and colour, for example, are not affected by the amount of
            matter present.
          </p>
          <ol>
            <li>
              <strong>Intensive Properties</strong> - a bulk property, which
              means it is a system’s local physical property that is independent
              of the system’s size or volume of material. Intensive properties
              are those that are independent of the amount of matter present.
              Pressure and temperature, for example, are intensive properties.
            </li>
            <li>
              <strong>Extensive Properties</strong> - A property that is
              dependent on the amount of matter in a sample is known as an
              extensive property. Extensive properties include mass and volume.
              The scale of the system or the volume of matter in it determines
              the extensive property of the system. Extensive properties are
              those in which the value of a system’s property is equal to the
              sum of the values for the parts of the system.
            </li>
          </ol>
          <div class="image">
            <img src="../media/IntensiveExtensive.png" alt="" width="500px" />
            <p class="caption">
              Figure 2.3: Intensive and Extensive Properties of Matter
            </p>
          </div>
          <h2>Key Points</h2>
          <ul>
            <li>
              <strong>Matter</strong> is anything that has mass and occupies
              space. All physical structures are made of matter, which exists in
              three basic states: solid, liquid, and gas.
            </li>
            <li>
              <strong>Properties of Matter</strong> - Matter has physical and
              chemical properties.
            </li>
            <ul>
              <li>
                Physical Properties - Measurable without changing the substance
                (e.g., mass, color, volume, density, hardness, boiling and
                melting points).
              </li>
              <li>
                Chemical Properties - Observable when a substance reacts to form
                new substances (e.g., reactivity, flammability, toxicity).
              </li>
            </ul>
            <li>
              <strong>Intensive vs. Extensive Properties: </strong>
            </li>
            <ul>
              <li>
                Intensive Properties - Independent of the amount of matter
                (e.g., density, color, temperature).
              </li>
              <li>
                Extensive Properties- Dependent on the amount of matter (e.g.,
                mass, volume).
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </div>

    <div class="lesson">
      <h2>Pure Substances and Mixtures</h2>
      <div class="video">
        <video controls>
          <source
            src="../media/Pure Substance vs Mixture.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="content">
        <div class="text">
          <p>
            Pure substances are further classified as elements and compounds.
          </p>
          <p>
            An element is a substance that consists of only one type or kind of
            atom. An element is a pure substance as it cannot be broken down or
            transformed into a new substance even by using some physical or
            chemical means. Elements are mostly metals, non-metals or
            metalloids.
          </p>
          <p>
            Compounds, on the other hand, are also pure substances when two or
            more elements are combined chemically in a fixed ratio. However,
            these substances can be broken down into separate elements by
            chemical methods.
          </p>
          <br />
          <h3>Characteristics and Properties Of Pure Substances</h3>
          <ul>
            <li>
              Pure substances are mostly homogeneous in nature containing only
              one type of atom or molecule.
            </li>
            <li>
              These substances mainly have a constant or uniform composition
              throughout.
            </li>
            <li>The substances have fixed boiling and melting points.</li>
            <li>
              A pure substance usually participates in a chemical reaction to
              form predictable products.
            </li>
          </ul>
          <h3>Examples of Pure Substances</h3>
          <p>
            All elements are mostly pure substances. A few of them include gold,
            copper, oxygen, chlorine, diamond, etc. Compounds such as water,
            salt or crystals, baking soda amongst others are also grouped as
            pure substances.
          </p>
          <div class="image">
            <img src="../media/Pure Substances.png" alt="" width="500px" />
            <p class="caption">Figure 2.4: Pure Substances</p>
          </div>
          <h2>Mixture</h2>
          <p>
            A substance, on the other hand, is impure if it consists of
            different kinds of elements combined physically and not chemically.
            Impure substances are also called mixtures. Mixtures are further
            divided into homogenous or heterogeneous mixture.
          </p>
          <h3>Homogeneous vs Heterogeneuous</h3>
          <ul>
            <li>
              A homogeneous mixture occasionally called a solution, is
              comparatively unvarying in configuration or constant. Every unit
              of the mixture is like every other unit. For instance, if you
              liquefy sugar in water and blend it really well, your concoction
              is essentially the same, no matter where you sample it. This
              mixture contains two or more chemical substances.
            </li>
            <li>
              A heterogeneous mixture is a concoction whose configuration varies
              from spot to spot within the sample. For example, if you put a
              little amount of sugar in a vessel, add some sand, and then shake
              the jar a couple of times, your concoction doesn’t have the same
              configuration all throughout the jar. As the sand is heftier,
              there’s possibly more amount of sand at the bottom of the jar and
              more sugar at the top part. These mixtures can be identified
              visually and separated easily by physical means.
            </li>
          </ul>
          <div class="image">
            <img
              src="../media/homogeneous_heterogeneous.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 2.5: Homogeneous vs Heterogeneous</p>
          </div>
          <h3>
            Characteristics And Properties Of Mixtures Or Impure Substance
          </h3>
          <ul>
            <li>
              It does not have any specific properties, the properties of the
              mixture are a result of the average properties of all the
              constituents.
            </li>
            <li>It is formed as a result of a physical change.</li>
            <li>Their melting and boiling points differ.</li>
          </ul>
          <h3>Example Of Mixtures</h3>
          <ul>
            <li>Solid and liquid such as sand and water</li>
            <li>Gas and gas like nitrogen and oxygen in the atmosphere.</li>
            <li>A solution like water and oil.</li>
            <li>Gas and liquid such as water.</li>
          </ul>
          <h3>Differences Between Pure Substances and Mixtures</h3>
          <div class="image">
            <p class="caption">
              The differences between pure substances and mixtures are given
              below.
            </p>
            <img src="../media/Difference.png" alt="" width="650px" />
          </div>
          <h2>Key Points</h2>
          <ul>
            <li>
              <strong>Pure Substances</strong> are substances with only one type
              of atom or molecule, chemically pure.
              <ul>
                <li>
                  <strong>Classification: </strong> Elements (e.g., gold,
                  copper) and Compounds (e.g., water, salt).
                </li>
                <li>
                  <strong>Properties: </strong>
                  <ul>
                    <li>Homogeneous composition.</li>
                    <li>Fixed boiling/melting points.</li>
                    <li>Predictable chemical reactions.</li>
                  </ul>
                </li>
              </ul>
            </li>

            <li>
              <strong>Mixture</strong>, combinations of substances physically
              mixed, not chemically bonded.
              <ul>
                <li>
                  <strong>Types: </strong>
                  <ul>
                    <li>
                      Homogeneous Mixture: Uniform composition (e.g., sugar
                      water).
                    </li>
                    <li>
                      Heterogeneous Mixture: Non-uniform composition (e.g., sand
                      and sugar).
                    </li>
                  </ul>
                </li>
                <li>
                  <strong>Properties: </strong>
                  <ul>
                    <li>No fixed properties, depends on components.</li>
                    <li>Formed by physical changes.</li>
                    <li>Variable melting/boiling points.</li>
                  </ul>
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
              $lessonId = 2;
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
                  <a href="../Quiz/chemistryquiz.php">
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
