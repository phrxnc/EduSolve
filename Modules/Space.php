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
    <title>Space Science</title>
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
      <h1>Lesson 5: Space Science</h1>
      <h2>Solar System</h2>
      <div class="content">
        <div class="text">
          <p>
            Our solar system consists of an average star we call the Sun, the
            planets Mercury, Venus, Earth, Mars, Jupiter, Saturn, Uranus,
            Neptune, and Pluto.
          </p>
          <div class="image">
            <img
              src="../media/planets-distance-order-Sun.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 5.1.: The Solar System</p>
          </div>

          <p>
            The satellites of the planets;
            <strong
              >numerous comets, asteroids, and meteoroids; and the
              interplanetary medium. The Sun</strong
            >
            is the richest source of electromagnetic energy (mostly in the form
            of heat and light) in the solar system. The Sun's nearest known
            stellar neighbor is a red dwarf star called Proxima Centauri, at a
            distance of 4.3 light years away. The whole solar system, together
            with the local stars visible on a clear night, orbits the center of
            our home galaxy, a spiral disk of 200 billion stars we call the
            Milky Way. The Milky Way has two small galaxies orbiting it nearby,
            which are visible from the southern hemisphere. They are called the
            Large Magellanic Cloud and the Small Magellanic Cloud. The nearest
            large galaxy is the Andromeda Galaxy. It is a spiral galaxy like the
            Milky Way but is 4 times as massive and is 2 million light years
            away. Our galaxy, one of billions of galaxies known, is traveling
            through intergalactic space.
          </p>
          <div class="image">
            <img
              src="../media/satallites of the planets.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 5.2.: Satallites of The Planets</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <p>
            The planets, most of the satellites of the planets and the asteroids
            revolve around the Sun in the same direction, in nearly circular
            orbits. When looking down from above the Sun's north pole, the
            planets orbit in a counter-clockwise direction. The planets orbit
            the Sun in or near the same plane, called the
            <strong>ecliptic</strong>. Pluto is a special case in that its orbit
            is the most highly inclined (18 degrees) and the most highly
            elliptical of all the planets. Because of this, for part of its
            orbit, Pluto is closer to the Sun than is Neptune. The axis of
            rotation for most of the planets is nearly perpendicular to the
            ecliptic. The exceptions are Uranus and Pluto, which are tipped on
            their sides.
          </p>
        </div>
        <div class="image">
          <img src="../media/elliptic.jpg" alt="" width="500px" />
          <p class="caption">Figure 5.3.: Elliptic</p>
        </div>
      </div>
      <br />
      <div class="content">
        <div class="text">
          <h2>Composition Of The Solar System</h2>
          <p>
            <strong>Sun</strong>contains 99.85% of all the matter in the Solar
            System. The planets, which condensed out of the same disk of
            material that formed the Sun, contain only 0.135% of the mass of the
            solar system. Jupiter contains more than twice the matter of all the
            other planets combined. Satellites of the planets, comets,
            asteroids, meteoroids, and the interplanetary medium constitute the
            remaining 0.015%. The following table is a list of the mass
            distribution within our Solar System.
          </p>
          <ul>
            <li>Sun: 99.85%</li>
            <li>Planets: 0.135%</li>
            <li>Comets: 0.01% ?</li>
            <li>Satellites: 0.00005%</li>
            <li>Minor Planets: 0.0000002% ?</li>
            <li>Meteoroids: 0.0000001% ?</li>
            <li>Interplanetary Medium: 0.0000001% ?</li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>The Terrestrial Planets</h2>
          <p>
            The terrestrial planets are the four innermost planets in the solar
            system:
          </p>
          <ol>
            <li>Mercury</li>
            <li>Venus</li>
            <li>Earth</li>
            <li>Mars</li>
          </ol>
          <p>
            They are called terrestrial because they have a compact, rocky
            surface like the Earth's. The planets,
            <strong>Venus, Earth, and Mars</strong> have significant atmospheres
            while <strong>Mercury</strong> has almost none. The following
            diagram shows the approximate distance of the terrestrial planets to
            the Sun.
          </p>
          <div class="image">
            <img src="../media/Terrestrial Planets.png" alt="" width="500px" />
            <p class="caption">Figure 5.5.: The Terrestrial Planets</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>The Jovian Planets</h2>
          <p>
            <strong>Jupiter, Saturn, Uranus, and Neptune</strong> are known as
            the Jovian (Jupiter-like) planets, because they are all gigantic
            compared with Earth, and they have a gaseous nature like Jupiter's.
            The Jovian planets are also referred to as the gas giants, although
            some or all of them might have small solid cores. The following
            diagram shows the approximate distance of the Jovian planets to the
            Sun.
          </p>
          <div class="image">
            <img src="../media/jovian-planets.jpg" alt="" width="500px" />
            <p class="caption">Figure 5.6.: The Jovian Planets</p>
          </div>
        </div>
      </div>

      <br />
      <h2>Our Milkyway Galaxy</h2>

      <div class="content">
        <div class="text">
          <p>
            This image of our galaxy, the Milky Way, was taken with NASA's
            Cosmic Background Explorer's (COBE) Diffuse Infrared Background
            Experiment (DIRBE). This never-before-seen view shows the Milky Way
            from an edge-on perspective with the galactic north pole at the top,
            the south pole at the bottom and the galactic center at the center.
            The picture combines images obtained at several near-infrared
            wavelengths. Stars within our galaxy are the dominant source of
            light at these wavelengths. Even though our solar system is part of
            the Milky Way, the view looks distant because most of the light
            comes from the population of stars that are closer to the galactic
            center than our own Sun. (Courtesy NASA)
          </p>
        </div>
        <div class="image">
          <img src="../media/Milky_way.jpeg" alt="" width="400px" />
          <p class="caption">Figure 5.7.: Milky Way</p>
        </div>
      </div>
      <h2>Rotation and Revolution</h2>

      <div class="content">
        <div class="text">
          <p>
            "Rotation" refers to an object's spinning motion about its own axis.
            "Revolution" refers the object's orbital motion around another
            object. For example, Earth rotates on its own axis, producing the
            24-hour day. Earth revolves about the Sun, producing the 365-day
            year. A satellite revolves around a planet.
          </p>
          <h3>Earth's Rotation</h3>
          <p>
            The Earth rotates on its axis relative to the Sun every 24.0 hours
            mean solar time, with an inclination of 23.45 degrees from the plane
            of its orbit around the Sun. Mean solar time represents an average
            of the variations caused by Earth's non-circular orbit. Its rotation
            relative to "fixed" stars (sidereal time) is 3 minutes 56.55 seconds
            shorter than the mean solar day, the equivalent of one solar day per
            year.
          </p>
          <h4>Importance of Earth Rotation</h4>
          <ul>
            <li>
              The Earth’s rotation creates the diurnal cycle of lightness and
              darkness, temperature and humidity changes.
            </li>
            <li>The Earth’s rotation causes tides in the oceans and seas.</li>
          </ul>
          <h3>Earth's Revolution</h3>
          <p>
            Earth revolves in orbit around the Sun in 365 days, 6 hours, 9
            minutes with reference to the stars, at a speed ranging from 29.29
            to 30.29 km/s. The 6 hours, 9 minutes adds up to about an extra day
            every fourth year, which is designated a leap year, with the extra
            day added as February 29th. Earth's orbit is elliptical and reaches
            its closest approach to the Sun, a perihelion of 147,090,000 km, on
            about January fourth of each year. Aphelion comes six months later
            at 152,100,000 km.
          </p>
          <h4>Importance of Revolution</h4>
          <ul>
            <li>Revolution causes seasons.</li>
            <li>
              Revolution creates perihelion and aphelion. Perihelion occurs when
              the Earth is closest to the Sun. Aphelion occurs when the Earth is
              far from the Sun.
            </li>
            <li>
              Revolution has a direct influence on the varied length of day and
              night time. The duration of days and nights are the same at the
              equator. This is known as the equinox. The duration of days and
              nights vary in the Northern and Southern hemispheres. This is
              known as solstices.
            </li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/Rotate & Revolution.jpg" alt="" width="400px" />
          <p class="caption">Figure 5.8.: Rotate vs Revolution</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h3>Rotation and Revolution of Planets</h3>
          <div class="image">
            <img src="../media/rotation of planets.jpg" alt="" width="500px" />
            <p class="caption">Figure 5.9.: Rotation of Planets</p>
          </div>
          <h3>Difference Between Rotation and Revolution</h3>
          <div class="image">
            <img
              src="../media/Rotation+vs.+Revolution.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">
              Figure 5.10.: basic differences between rotation and revolution.
            </p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Key Points</h2>
          <h3>Solar System</h3>
          <ul>
            <li>
              The Solar System includes the Sun, eight planets, their
              satellites, comets, asteroids, meteoroids, and the interplanetary
              medium.
            </li>
            <li>
              The Sun is the primary source of electromagnetic energy in the
              solar system, containing 99.85% of the total mass.
            </li>
            <li>
              Proxima Centauri: The nearest star to the Sun, located 4.3 light
              years away.
            </li>
            <li>
              Milky Way Galaxy: The Solar System orbits the center of the Milky
              Way, a spiral galaxy with 200 billion stars.
            </li>
            <li>
              Planets orbit the Sun in a counter-clockwise direction in nearly
              circular orbits within the same plane, called the ecliptic.
            </li>
            <li>
              Pluto has the most inclined (18°) and elliptical orbit, making it
              closer to the Sun than Neptune for part of its orbit.
            </li>
            <li>
              Rotation Axes: Most planets rotate perpendicular to the ecliptic,
              except Uranus and Pluto, which are tipped on their sides.
            </li>
          </ul>
          <h3>Composition of the Solar System</h3>
          <ul>
            <li>
              <strong>Mass Distribution: </strong>
              <ul>
                <li>Sun: 99.85%</li>
                <li>Planets: 0.135%</li>
                <li>
                  Other components (comets, satellites, meteoroids): 0.015%
                </li>
              </ul>
            </li>
            <li>
              <strong>Jupiter</strong>: Contains more than twice the mass of all
              other planets combined.
            </li>
          </ul>
          <h3>Terrestrial and Jovian Planets</h3>
          <ul>
            <li>
              <strong>Terrestrial Planets</strong> - Compact, rocky surfaces
              with significant atmospheres (except Mercury).
              <ul>
                <li>Mercury, Venus, Earth, Mars</li>
              </ul>
            </li>
            <li>
              <strong>Jovian Planets</strong> - Gigantic, gaseous planets,
              sometimes with small solid cores.
              <ul>
                <li>Jupiter, Saturn, Uranus, Neptune</li>
              </ul>
            </li>
          </ul>
          <ul>
            <li>
              The Milky Way is a spiral galaxy viewed edge-on in many
              astronomical images.
            </li>
            <li>
              Contains billions of stars, including those closer to the galactic
              center, which dominate its light.
            </li>
          </ul>
          <h3>Rotation and Revolution</h3>
          <ul>
            <li>
              Rotation: Spinning motion of an object about its axis (e.g.,
              Earth’s 24-hour rotation causes day and night).
            </li>
            <li>
              Revolution: Orbital motion of an object around another object
              (e.g., Earth’s 365-day orbit around the Sun).
            </li>
            <br />
            <li>
              <strong>Earth's Rotation </strong>
              <ul>
                <li>
                  Earth rotates on its axis every 24 hours, tilted at 23.45°.
                </li>
                <li>Diurnal Cycle: Alternation of light and darkness.</li>
                <li>
                  Tides: Generated by the gravitational pull and Earth’s spin.
                </li>
              </ul>
            </li>
            <br />
            <li>
              <strong>Earth's Revolution </strong>
              <ul>
                <li>
                  Earth completes a revolution around the Sun in 365 days, 6
                  hours, and 9 minutes.
                </li>
                <li>The orbit is elliptical:</li>
                <li>
                  Perihelion: Closest approach to the Sun (~147 million km).
                </li>
                <li>
                  Aphelion: Farthest distance from the Sun (~152 million km).
                </li>
                <li>Causes the seasons due to the axial tilt.</li>
                <li>
                  Creates <strong>equinoxes</strong> (equal day and night at the
                  equator) and solstices (varied day/night durations in
                  hemispheres).
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
              $lessonId = 5;
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
                  <a href="../Quiz/spacequiz.php">
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
