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
    <title>Earth Science</title>
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
      <h1>Lesson 4: Earth Science</h1>
      <h2>Structure of the Earth</h2>
      <div class="content">
        <div class="text">
          <p>
            The Earth is made of several layers, These are the core, the mantle
            and the crust. Each layer has unique characteristics. Let’s look at
            these layers starting from the inside.
          </p>
          <h2>The Core</h2>
          <p>
            Located at the centre of the Earth is the core. It has two layers.
            The inner core and the outer Core.
          </p>
          <p>
            The core is the Earth's source of internal heat. This is because it
            contains radioactive materials that release heat as they break down
            into more stable materials. The inner core has a temperature of up
            to 4 000℃ and the outer core has a temperature of up to 3 600℃.
            Between these two layers is a liquid-solid boundary called the
            Lehmann Discontinuity. This is actually the hottest part of the
            core. It is as hot as the surface of the Sun!
          </p>
          <p>
            The <strong>inner core</strong> is around 1 216 km thick. It’s made
            of solid iron with some nickel. These dense metals would have sunk
            down in the young Earth, ending up in the centre. The solid inner
            core rotates within the liquid outer core.
          </p>
          <p>
            The <strong>outer core</strong> is around 2 270 km thick. It’s made
            of liquid iron with some nickel. It is liquid because it experiences
            less pressure than the inner core. This layer also conducts
            electricity. This creates the electrical currents that form Earth’s
            magnetic field.
          </p>
        </div>
      </div>
      <div class="image">
        <img
          src="../media/Layers_of_the_Earth.png"
          alt=""
          width="300px"
          height="350px"
        />
        <p class="caption">Figure 4.1: Layers of the Earth.</p>
      </div>
      <br />
      <div class="content">
        <div class="text">
          <h2>The Mantle</h2>

          <p>
            Above the core is the mantle. Like the core, the mantle also has two
            layers. These are the lower mantle and the upper mantle. Both layers
            of the mantle are made up of hot, dense, semi-solid rock.
          </p>
          <p>
            The <strong>lower mantle</strong> is around 2 885 km thick. This
            layer is so large that the volume of this region is about 84% of the
            Earth’s total volume! The temperature of the mantle is cooler than
            that of the core. It only reaches about 3 000℃ . As you travel from
            the lower mantle to the upper mantle, the material gets less dense.
          </p>
          <p>
            Between the lower and upper mantle lies a transition zone. It is
            about 400–660 km below the Earth’s surface.
          </p>
          <p>
            Above the transition zone is the <strong>upper mantle</strong>. This
            area extends from 400 km below the surface up to the Earth’s crust
            layer. The upper most part of the upper mantle is called the
            asthenosphere. The asthenosphere is made of soft, flowing rock.
          </p>
        </div>
        <div class="image">
          <img src="../media/Earth cross-section.png" alt="" width="450px" />
          <p class="caption">Figure 4.2: Earth's Cross Section.</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>The Crust</h2>
          <p>
            Floating on top of the asthenosphere is the crust. The crust is the
            solid, rigid part of our planet. Unlike the deeper layers, the crust
            is a cool layer of rock. It has a thickness that varies from 5 to 80
            km. Together, the upper part of the asthenosphere and the crust make
            up the <strong>lithosphere</strong>.
          </p>
          <p>
            The <strong>lower mantle</strong> is around 2 885 km thick. This
            layer is so large that the volume of this region is about 84% of the
            Earth’s total volume! The temperature of the mantle is cooler than
            that of the core. It only reaches about 3 000℃ . As you travel from
            the lower mantle to the upper mantle, the material gets less dense.
          </p>
          <p>
            The thinnest portions of the crust are found on the ocean floor. It
            forms what we call the oceanic crust. This part of the crust can be
            less than 5 km thick.
          </p>
          <p>
            The thickest parts of the Earth’s crust lie under the
            <strong>continents</strong>. It forms what we call the continental
            crust. This part of the crust can be up to 80 km thick.
          </p>
          <p>
            The temperature of the crust closest to the mantle is about 500℃.
            The temperature of the crust near the Earth’s surface is about the
            same as the air temperature.
          </p>
          <div class="image">
            <img src="../media/Continental crust.jpg" alt="" width="500px" />
            <p class="caption">Figure 4.3: Earth's Continental Crust.</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Plate Boundaries</h2>
          <p>
            Movement in narrow zones along plate boundaries causes most
            earthquakes. Most seismic activity occurs at three types of plate
            boundaries—divergent, convergent, and transform.
          </p>
          <p>
            As the plates move past each other, they sometimes get caught and
            pressure builds up. When the plates finally give and slip due to the
            increased pressure, energy is released as seismic waves, causing the
            ground to shake. This is an earthquake.
          </p>
          <p>
            Some of the plates have ocean water above them. Other plates include
            continents, and some plates include both continents and ocean. The
            movements of the plates help shape the geological features of our
            planet. The three main types of plate movements include:
          </p>
          <p>
            <strong>Divergent/Spreading</strong>: This is where two plates move
            away from each other. Molten rock from the mantle erupts along the
            opening, forming new crust. The earthquakes that occur along these
            zones, called spreading centers, are relatively small. The Great
            Rift Valley in Africa, the Red Sea and the Gulf of Aden all formed
            as a result of divergent plate motion.
          </p>
          <p>
            <strong>Convergent/Colliding</strong>: This occurs when plates move
            towards each other and collide. When a continental plate meets an
            oceanic plate, the thinner, denser, and more flexible oceanic plate
            sinks beneath the thicker, more rigid continental plate. This is
            called subduction. Subduction causes deep ocean trenches to form,
            such as the one along the west coast of South America. The rocks
            pulled down under the continent begin to melt. Sometimes the molten
            rock rises to the surface, through the continent, forming a line of
            volcanoes. About 80% of earthquakes occur where plates are pushed
            together, called convergent boundaries.
          </p>
          <p>
            When two tectonic plates slide past each other, the place where they
            meet is a <strong>transform or lateral fault</strong>. The San
            Andreas Fault is one of the best examples of lateral plate motion.
          </p>
          <div class="image">
            <img src="../media/Plate bounderies.png" alt="" width="400px" />
            <p class="caption">Figure 4.4: Plate Bounderies.</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <p>
            Another form of convergent boundary is a collision where two
            continental plates meet head-on. Since neither plate is stronger
            than the other, they crumple and are pushed up. This can lead to the
            formation of huge, high mountain ranges such as the Himalayas.
          </p>
        </div>
        <div class="image">
          <img src="../media/san-andreas-fault-map.jpg" alt="" height="400px" />
          <p class="caption">Figure 4.5: San Andreas Fault.</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Weather & Climate</h2>
          <p>
            <strong>Weather</strong> is the state of the atmosphere at a
            particular time and place. Daily changes in the weather are driven
            by differences in temperature, moisture and air pressure.
          </p>
          <p>
            <strong>Climate</strong> refers to the prevailing weather trends and
            typical conditions over a long period of time. People who study
            weather have a different occupation title than those that study
            climate:
          </p>
          <ul>
            <li>
              <i>Meteorologists</i> study current weather conditions and develop
              forecasts. Weather forecasting is a prediction of what the weather
              will be like next hour, day or week.
            </li>
            <li>
              <i>Climatologists</i> study data and indicators of historical
              climates either over centuries or eons. They also make predictions
              about changing climate patterns in the future.
            </li>
          </ul>

          <h3>Understanding Weather</h3>
          <p>
            Weather refers to the short-term conditions of the lower atmosphere,
            such as precipitation, temperature, humidity, wind direction, wind
            speed, and atmospheric pressure. It could be sunny, cloudy, rainy,
            foggy, cold, hot, windy, stormy, snowing … the list goes on.
          </p>

          <div class="image">
            <img src="../media/types of weather.png" alt="" width="500px" />
            <p class="caption">Figure 4.6: Types of Weather.</p>
          </div>

          <p>
            The atmospheric conditions that influence weather are always
            fluctuating, which is why the weather is always changing.
            Meteorologists analyze data from satellites, weather stations, and
            buoys to predict weather conditions over the upcoming days or weeks.
            These forecasts are important because weather influences many
            aspects of human activity. Sailors and pilots, for example, need to
            know when there might be a big storm coming, and farmers need to
            plan around the weather to plant and harvest crops. Firefighters
            also keep track of daily weather in order to be prepared for the
            likelihood of forest fires. Weather forecasts are also useful for
            military mission planning, for features of trade, and for warning
            people of potentially dangerous weather conditions.
          </p>

          <h3>Understanding Climate</h3>
          <p>
            While weather refers to short-term changes in the atmosphere,
            climate refers to atmospheric changes over longer periods of time,
            usually defined as 30 years or more. This is why it is possible to
            have an especially cold spell even though, on average, global
            temperatures are rising. The former is a weather event that takes
            place over the course of days, while the latter indicates an overall
            change in climate, which occurs over decades. In other words, the
            cold winter is a relatively small atmospheric perturbation within a
            much larger, long-term trend of warming.
          </p>

          <div class="image">
            <img src="../media/types of climate.jpg" alt="" width="500px" />
            <p class="caption">Figure 4.7: Climates in four seasons.</p>
          </div>

          <p>
            Despite their differences, weather and climate are interlinked. As
            with weather, climate takes into account precipitation, wind speed
            and direction, humidity, and temperature. In fact, climate can be
            thought of as an average of weather conditions over time. More
            importantly, a change in climate can lead to changes in weather
            patterns.
          </p>
          <p>
            Climate conditions vary between different regions of the world and
            influence the types of plants and animals that live there. For
            example, the Antarctic has a polar climate with subzero
            temperatures, violent winds, and some of the driest conditions on
            Earth. The organisms that live there are highly adapted to survive
            the extreme environment.
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Natural Disasters</h2>
          <p>
            <strong>Natural disasters, </strong>any calamitous occurrence
            generated by the effects of natural, rather than human-driven,
            phenomena that produces great loss of human life or destruction of
            the natural environment, private property, or public infrastructure.
            A natural disaster may be caused by weather and climate events or by
            earthquakes, landslides, and other occurrences that originate at
            Earth’s surface or within the planet itself. No spot on Earth is
            immune from a natural disaster; however, certain types of disasters
            are often limited to or occur more frequently in specific geographic
            regions.
          </p>
          <h2>Types</h2>
          <h3>Weather and Climate-Driven Disasters:</h3>
          <ul>
            <li>
              Flooding: Caused by heavy rains associated with hurricanes,
              typhoons, or other intense storms. These storms can result in
              widespread flooding, especially in low-lying areas.
            </li>
            <li>
              Drought: Prolonged periods of dry weather, which can lead to water
              shortages, crop failures, and famine. Shifts in precipitation
              patterns due to climate change can contribute to the severity of
              droughts.
            </li>
            <li>
              Famine: A result of extreme drought or inadequate rainfall,
              leading to food shortages, malnutrition, and sometimes starvation.
            </li>
            <li>
              Wildfires: Often triggered by heat waves and shifts in
              precipitation patterns. Dry conditions, combined with strong
              winds, can cause wildfires to spread rapidly, destroying forests,
              homes, and causing loss of life.
            </li>
            <li>
              Windstorms: Includes tropical cyclones (hurricanes, typhoons),
              tornadoes, and derechos. These windstorms can cause severe damage,
              uprooting trees, destroying buildings, and disrupting power lines.
            </li>
            <li>
              Blizzards and Heavy Snowfalls: Snowstorms that result in
              dangerously low temperatures, reduced visibility, and accumulation
              of snow, which can paralyze regions and cause accidents or deaths.
            </li>
          </ul>
          <div class="image">
            <img src="../media/types of disasters2.jpg" alt="" width="500px" />
            <p class="caption">Figure 4.8: Natural Disasters.</p>
          </div>
        </div>
      </div>
      <br />
      <div class="content">
        <div class="text">
          <h3>Earth-Driven Disasters:</h3>
          <ul>
            <li>
              Volcanic Eruptions: When a volcano explodes, it can produce lava
              flows, toxic gas clouds, ash falls, and pyroclastic flows. These
              eruptions can cause significant destruction to nearby towns, loss
              of life, and disrupt air travel due to ash clouds.
            </li>
            <li>
              Earthquakes: Sudden movements of the Earth's crust caused by
              tectonic plate shifts. Earthquakes can cause massive destruction
              to buildings, roads, and infrastructure, and may trigger tsunamis
              if occurring underwater.
            </li>
          </ul>

          <h3>Combination-Driven Disasters:</h3>
          <ul>
            <li>
              Landslides: A mass movement of rock, debris, and soil downslope,
              often triggered by heavy rains that saturate the soil on unstable
              slopes. Earthquakes can also trigger landslides, leading to
              further destruction in mountainous regions.
            </li>
            <li>
              Avalanches: When snow buildup on mountain slopes becomes unstable,
              it can slide down the mountain, destroying anything in its path.
              Avalanches can be triggered by snowstorms or earthquakes.
            </li>
            <li>
              Tsunamis: Large ocean waves that can rise as high as 30 meters.
              Tsunamis are often triggered by submarine earthquakes, underwater
              landslides, volcanic eruptions, or even meteor or comet impacts.
              They can travel across oceans and cause widespread destruction in
              coastal areas, often thousands of kilometers away from the origin.
            </li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/types of disasters.jpg" alt="" height="450px" />
          <p class="caption">Figure 4.9: Natural Disasters.</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Key Points</h2>
          <h3>Structure of the Earth</h3>
          <ul>
            <li>
              Core: The Earth’s innermost layer with two parts: the inner core
              (solid iron and nickel, ~4,000℃) and the outer core (liquid iron
              and nickel, ~3,600℃). The outer core generates Earth’s magnetic
              field.
            </li>
            <li>
              Mantle: Above the core, with the lower mantle (2,885 km thick,
              ~3,000℃) and the upper mantle (less dense, including the soft
              asthenosphere). The mantle is largely semi-solid rock.
            </li>
            <li>
              Crust: The Earth's outermost layer, made of solid rock, varying in
              thickness (5-80 km). The crust is cooler compared to the mantle
              and includes oceanic (thin) and continental (thick) parts.
            </li>
          </ul>
          <h3>Plate Bounderies</h3>
          <ul>
            <li>
              Divergent/Spreading: Plates move apart, creating new crust from
              molten rock (e.g., Great Rift Valley).
            </li>
            <li>
              Convergent/Colliding: Plates move toward each other, with one
              plate sometimes sinking under the other (e.g., oceanic plate
              subducting under continental plate).
            </li>
            <li>
              Transform/Sliding: Plates slide past each other, often causing
              earthquakes (e.g., San Andreas Fault).
            </li>
            <li>
              Collision of Continental Plates: Results in mountain ranges like
              the Himalayas.
            </li>
          </ul>
          <h3>Weather and Climate</h3>
          <ul>
            <li>
              Weather: Short-term atmospheric conditions, including temperature,
              humidity, and pressure. It changes frequently and affects daily
              life
            </li>
            <li>
              Climate: Long-term atmospheric patterns, usually over 30 years.
              It’s a summary of weather over time and varies globally, affecting
              ecosystems and human activities.
            </li>
            <li>
              Meteorologists vs. Climatologists: Meteorologists forecast
              short-term weather, while climatologists study long-term climate
              trends and changes.
            </li>
          </ul>
          <h3>Natural Disasters</h3>
          <ul>
            <li>
              <strong>Weather and Climate-Driven Disasters: </strong>
              <ul>
                <li>
                  Flooding: Caused by heavy rains, often linked with hurricanes
                  or typhoons.
                </li>
                <li>
                  Drought: Prolonged dry periods leading to water shortages and
                  famine.
                </li>
                <li>
                  Famine: Caused by extreme droughts or insufficient rainfall.
                </li>
                <li>Wildfires: Triggered by heat waves and dry conditions.</li>
                <li>
                  Windstorms: Includes hurricanes, tornadoes, and derechos that
                  cause widespread damage.
                </li>
                <li>
                  Blizzards/Snowfalls: Severe snowstorms causing dangerous
                  conditions and accidents.
                </li>
              </ul>
            </li>
            <li>
              <strong>Earth-Driven Disasters: </strong>
              <ul>
                <li>
                  Volcanic Eruptions: Explosive events that release lava, ash,
                  and gases.
                </li>
                <li>
                  Earthquakes: Sudden shifts in the Earth’s crust, often leading
                  to damage and tsunamis.
                </li>
              </ul>
            </li>
            <li>
              <strong>Combination-Driven Disasters: </strong>
              <ul>
                <li>
                  Landslides: Triggered by heavy rains or earthquakes, causing
                  debris flow.
                </li>
                <li>
                  Avalanches: Snow buildup that slides down mountains, often due
                  to snowstorms or earthquakes.
                </li>
                <li>
                  Tsunamis: Large ocean waves caused by underwater earthquakes,
                  landslides, or volcanic eruptions, traveling long distances
                  and causing destruction.
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
              $lessonId = 4;
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
                  <a href="../Quiz/earthquiz.php">
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
