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
    <title>Geometry</title>
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
      <h1>Lesson 3: Geometry</h1>
      <h2>Geometry</h2>
      <div class="content">
        <div class="text">
          <p>
            Geometry studies shapes, sizes, and the properties of space. It
            involves points, lines, surfaces, and solids.
          </p>
          <p>
            Geometry is derived from Ancient Greek words – ‘Geo’ means ‘Earth’
            and ‘metron’ means ‘measurement’. In Euclidean geometry, there are
            two-dimensional shapes and three-dimensional shapes.
          </p>
          <p>
            In a plane geometry, 2d shapes such as triangles, squares,
            rectangles, circles are also called flat shapes. In solid geometry,
            3d shapes such as a cube, cuboid, cone, etc. are also called solids.
            The basic geometry is based on points, lines and planes explained in
            coordinate geometry.
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Plane Geometry (Two-dimensional Geometry)</h2>
          <p>
            <strong>Plane Geometry</strong> deals with flat shapes which can be
            drawn on a piece of paper. These include lines, circles & triangles
            of two dimensions. Plane geometry is also known as two-dimensional
            geometry.
          </p>
          <p>
            All the two-dimensional figures have only two measures such as
            length and breadth. It does not deal with the depth of the shapes.
            Some examples of plane figures are square, triangle, rectangle,
            circle, and so on.
          </p>
          <p>The important terminologies in plane geometry are:</p>
          <ul>
            <li>Point</li>
            <li>Line</li>
            <li>Angles</li>
          </ul>
          <h3>Point</h3>
          <p>
            A point is a precise location or place on a plane. A dot usually
            represents them. It is important to understand that a point is not a
            thing, but a place. Also, note that a point has no dimension;
            preferably, it has the only position.
          </p>
          <h3>Line</h3>
          <p>
            The line is straight (no curves), having no thickness and extends in
            both directions without end (infinitely). It is important to note
            that it is the combination of infinite points together to form a
            line. In geometry, we have a horizontal line and vertical line which
            are x-axis and y-axis respectively.
          </p>
          <ul>
            <li>
              <strong>Line Segment</strong> – If a line has a starting and an
              endpoint then it is called a Line Segment.
            </li>
            <li>
              <strong>Ray</strong> – If a line has a starting point and has no
              endpoint is called Ray.
            </li>
          </ul>
        </div>
        <div class="image">
          <img src="../media/PlaneGeometry.png" alt="" width="500px" />
          <p class="caption">Figure 1.1: Plane Geometry</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Angles in Geometry</h2>
          <p>
            In planar geometry, an angle is the figure formed by two rays,
            called the sides of the angle, sharing a common endpoint, called the
            vertex of the angle.
          </p>
          <h3>Types of Angle</h3>
          <p>
            <strong>Acute Angle</strong> – An Acute angle (or Sharp angle) is an
            angle smaller than a right angle ie. it can range between 0 – 90
            degrees.
          </p>
          <p>
            <strong>Obtuse Angle</strong> – An Obtuse angle is more than 90
            degrees but is less than 180 degrees.
          </p>
          <p><strong>Right Angle</strong> – An angle of 90 degrees.</p>
          <p>
            <strong>Straight Angle</strong> – An angle of 180 degrees is a
            straight angle, i.e. the angle formed by a straight line
          </p>
          <p>
            <strong>Reflex Angle</strong> - An angle whose measure is greater
            than 180° but less than 360° is termed as a reflex angle.
          </p>
          <div class="image">
            <img src="../media/typesofanglesingeo.png" alt="" width="500px" />
            <p class="caption">Figure 1.2: Types of Angle in Geometry</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Polygons in Geometry</h2>
          <p>
            A plane figure that is bounded by a finite chain of straight line
            segments closing in a loop to form a closed polygonal chain or
            circuit.
          </p>
          <p>
            The name ‘poly’ refers to multiple. An n-gon is a polygon with n
            sides; for example, a triangle is a 3-gon polygon.
          </p>
          <h3>Types of Polygon</h3>
          <ul>
            <li>Triangles</li>
            <li>Quadrilaterals</li>
            <li>Pentagon</li>
            <li>Hexagon</li>
            <li>Heptagon</li>
            <li>Octagon</li>
            <li>Nonagon</li>
            <li>Decagon</li>
          </ul>
          <div class="image">
            <img
              src="../media/Polygon-Types-Properties.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.3: Types of Polygon in Geometry</p>
          </div>
        </div>
      </div>

      <h2>Circle in Geometry</h2>
      <div class="content">
        <div class="text">
          <p>
            A Circle is a simple closed shape. From a certain point called the
            centre, all points of a circle are of same consistent distance, i.e.
            the curve traced out by a point that moves so that its distance from
            the centre is constant.
          </p>
          <h3>Similarity and Congruency in Geometry</h3>
          <p>
            <strong>Similarity</strong> – Two figures are said to be similar if
            they have the same shape or have an equal angle but do not have the
            same size.
          </p>
          <p>
            <strong>Congruence</strong> – Two figures are said to be Congruent
            if they have the same shape and size. Thus, they are totally equal.
          </p>
        </div>
        <div class="image">
          <img src="../media/GeometryCircle.png" alt="" width="500px" />
          <p class="caption">Figure 1.4: Circle in Geometry</p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Solid Geometry (Three-dimensional geometry)</h2>
          <p>
            <strong>Solid Geometry</strong> deals with 3-dimensional objects
            like cubes, prisms, cylinders & spheres. It deals with three
            dimensions of the figure such as length, breadth and height. But
            some solid solids do not have faces <strong>(e.g. sphere).</strong>
          </p>
          <p>
            Solid geometry is the study of three dimensions in Euclidean space.
            The objects which are around us are three-dimensional. All the
            three-dimensional shapes are obtained from the rotation operation of
            2D shapes. The important attributes of 3D shapes are:
          </p>
          <ul>
            <li>Faces</li>
            <li>Edges</li>
            <li>Vertices</li>
          </ul>
          <h3>Edges</h3>
          <p>
            An edge is defined as the line segment on the boundary that joins
            one vertex to the other vertex. It means that it joins one corner
            point to the other. It forms the skeleton of 3D shapes. In other
            words, it can be defined as the faces, that meet in the straight
            line is called edge.
          </p>
          <h3>Faces</h3>
          <p>
            We know that all the geometric shapes are made up of flat surface
            called faces. It is a flat surface enclosed by the edges. For any
            three-dimensional shapes, the face should be a two-dimensional
            figure.
          </p>
          <h3>Vertices</h3>
          <p>
            A vertex is defined as the point where the edges of the solid figure
            meet at each other. In other words, it can be said that, the point
            where the adjacent sides of the polygon meet. The vertex is the
            corners where the edges meet.
          </p>
          <div class="image">
            <img
              src="../media/table-face-vertices-edge.jpg"
              alt=""
              width="500px"
            />
            <p class="caption">Figure 1.5: Example: Solid Geometry Table</p>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Perimeter</h2>
          <p>
            The perimeter of a two-dimensional figure is the distance covered
            around it. It defines the length of shape, whether it is a
            <strong>triangle, square, rectangle or a circle</strong>. Area and
            perimeter are the two major properties of a 2D shape, which
            describes them.
          </p>
          <p>
            The perimeter of each shape varies as per their dimensions. Only in
            the case of a circle, the perimeter is stated as the circumference
            of the circle. But the method to find the perimeter of all the
            polygons is the same, which is we need to add all its sides.
          </p>
          <p>
            The perimeter of any two-dimensional closed shape is the total
            distance around it. Perimeter is the sum of all the sides of a
            polygon, such as:
          </p>
          <ul>
            <li>Perimeter of square = Sum of all four sides</li>
            <li>Perimeter of rectangle = Sum of all four sides</li>
            <li>Perimeter of triangle = Sum of all three sides</li>
          </ul>
          <h2>Formulas</h2>
          <div class="image">
            <img src="../media/PerimetersFormula.png" alt="" width="500px" />
            <p class="caption">Figure 1.6: Formulas for Perimeters</p>
          </div>
          <h3>Examples</h3>
          <p>
            1: What is the perimeter of an equilateral triangle whose side
            length is 7 cm?
          </p>
          <p>
            <strong>Solution:</strong> Given, the length of the side of an
            equilateral triangle is 7 cm
          </p>
          <p>
            As we know, the equilateral triangle has all its sides equal in
            length. Therefore, Perimeter of triangle = a+b+c
          </p>
          <p>Here, a = b = c</p>
          <p>Therefore, Perimeter = 3a</p>
          <p>P = 3 x 7 = <strong>21 cm</strong></p>
          <p>
            2: If the length of parallel sides of a parallelogram is 8 cm and 11
            cm, respectively, then find its perimeter.
          </p>
          <p>
            <strong>Solution: </strong>
            Given, The length of parallel sides of a parallelogram is 8 cm and
            11 cm, respectively.
          </p>
          <p>
            By the formula of perimeter, we know; Perimeter of Parallelogram =
            2(a+b)
          </p>
          <p>P = 2 (8 + 11)</p>
          <p>P = 2 x 19</p>
          <p>P = 38 cm</p>
          <p>
            Therefore, the perimeter of a given parallelogram is
            <strong>38 cm.</strong>
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Area</h2>
          <p>
            <strong>Area</strong> plays a vital role in contemporary
            mathematics. The area is the quantity that shows the amount of space
            occupied by a two-dimensional figure or shape or planar lamina in
            the plane. In simple words, the area can be defined as the measure
            (the amount) of cloth or material with a thickness provided that
            would be required to construct a model of the shape or the necessary
            amount of paint to cover the surface of the shape with a single
            layer, i.e. one coat.
          </p>
          <p>
            It is the two-dimensional representation of the length of a curve or
            the volume of a solid, where length is a one-dimensional concept and
            the volume is a three-dimensional related concept.
          </p>
          <p>
            The area of different shapes can be measured by comparing the shape
            to squares, which have a fixed size. We can find the area of simple
            and complex shapes using certain specific methods.
          </p>
          <h2>Formulas</h2>
          <div class="image">
            <img
              src="../media/frequently-used-area-formulas.png"
              alt=""
              width="400px"
            />
            <p class="caption">Figure 1.7: Formulas for Area</p>
          </div>
          <h3>Examples</h3>
          <p><strong>Example 1: Area of a Rectangle</strong></p>
          <p>
            Problem: Find the area of a rectangle with a length of 8 units and a
            width of 5 units.
          </p>
          <p>
            Solution: The formula for the area of a rectangle is: Area = Length
            x Width
          </p>
          <p>Substituting the given values: Area = 8 x 5 = 40 square units</p>
          <p>
            So, the area of the rectangle is <strong>40 square units.</strong>
          </p>
          <p><strong>Example 2: Area of a Square</strong></p>
          <p>
            Problem: Find the area of a square with a side length of 6 units.
          </p>
          <p>Solution: The formula for the area of a square is: Area = Side²</p>
          <p>Substituting the given value: Area = 6² = 36 square units</p>
          <p>
            Therefore, the area of the square is
            <strong>36 square units. </strong>
          </p>
          <p><strong>Example 3: Area of a Circle</strong></p>
          <p>Problem: Find the area of a circle with a radius of 4 units.</p>
          <p>
            Solution: The formula for the area of a circle is: Area = π x
            Radius²
          </p>
          <p>
            Substituting the given value: Area = π x 4 2 = π x 16 ≈ 3.1416 x 16
            = 50.2656 square units
          </p>
          <p>
            So, the area of the circle is approximately
            <strong>50.27 square units.</strong>
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>Volume</h2>
          <p>
            A <strong>volume</strong> is simply defined as the amount of space
            occupied by any three-dimensional solid. These solids can be a cube,
            a cuboid, a cone, a cylinder or a sphere.
          </p>
          <p>
            Different shapes have different volumes. In 3D geometry, we have
            studied the various shapes and solids such as cubes, cuboids,
            cylinders, cones, etc., that are defined in three dimensions. For
            all these shapes, we are going to learn to find the volume.
          </p>
          <h3>Unit of Volume</h3>
          <p>
            Volume of a solid is measured in <strong>cubic units</strong>. For
            example, if dimensions are given in meters, then the volume will be
            in cubic meters. This is the standard unit of volume in the
            International System of Units (SI). Similarly, other units of volume
            are cubic centimeters, cubic feet, cubic inches, etc.
          </p>
          <h3>Example</h3>
          <p>
            If a cuboid has dimensions of 10cm x 3cm x 5cm, then find its
            volume.
          </p>
          <p>Solution: Volume of cuboid = length x width x height</p>
          <p>V = 10cm x 3cm x 5cm</p>
          <p>V = 150 cubic centimeters</p>
          <p>
            Hence, we can see here the unit of volume of cuboid is measured in
            cubic centimeters.
          </p>
          <h3>Volume of liquid</h3>
          <p>
            Basically, the volume of a liquid is measured in liters, where 1
            liter is equal to 1000 cubic centimeters.
          </p>
          <p>1 liter = 1000 cubic centimeters = 0.001 cubic meters</p>
          <p>Hence, 1 cubic meters = 1000 liters</p>
          <p>
            Also, to measure the volume of a small amount of liquid, we use
            <strong>milliliters</strong>.
          </p>
          <p>
            1 milliliters = 0.001 liter = 1 cubic centimeters, Volume of liquid
            is also commonly measured in <strong>gallons</strong>.
          </p>
          <h2>Formulas</h2>
          <div class="image">
            <img src="../media/volumeformulas.png" alt="" width="500px" />
            <p class="caption">Figure 1.8: Formulas for Volume</p>
          </div>

          <h3>Examples</h3>
          <p>
            <strong
              >1: Find the volume of a cube if its side length is equal to 4
              cm.</strong
            >
          </p>
          <p>Solution: Given, the length of cube = 4cm</p>
          <p>As we know, Volume of cube = Side³</p>
          <p>Therefore, Volume of cube with 4cm length = 43 (cm)³</p>
          <p>Volume = <strong>64 cm³</strong></p>
          <p>
            <strong
              >2: What is the volume of the cone if the radius is 2cm and the
              height is 5cm.</strong
            >
          </p>
          <p>Solution: Given, radius of circular base of cone = 2cm</p>
          <p>Height of cone = 5cm</p>
          <p>As we know, Volume of cone = ⅓ πr²h</p>
          <p>Volume = ⅓ π (2)² (5), Volume = ⅓ x 22/7 x 4 x 5</p>
          <p>Volume = <strong>20.93 cm³</strong></p>
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
              $lessonId = 8;
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
                  <a href="../Quiz/GeometryQuiz.php">
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
