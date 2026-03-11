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
    <title>Biology</title>
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
      <h1>Lesson 1: Biology</h1>
      <h2>Introduction</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Biology</strong> is a natural science concerned with the
            study of life and living organisms. Modern biology is a vast and
            eclectic field composed of many specialized disciplines that study
            the structure, function, growth, distribution, evolution, or other
            features of living organisms.
          </p>
          <p>
            However, despite the broad scope of biology, there are certain
            general and unifying concepts that govern all study and research:
          </p>
          <ul>
            <li>The cell is the basic unit of life</li>
            <li>
              Genes (consisting of DNA or RNA) are the basic unit of heredity
            </li>
            <li>
              Evolution accounts for the unity and diversity seen among living
              organisms
            </li>
            <li>All organisms survive by consuming and transforming energy</li>
            <li>All organisms maintain a stable internal environment</li>
          </ul>
          <p>
            Biological research indicates the first forms of life on Earth were
            microorganisms that existed for billions of years before the
            evolution of larger organisms. The mammals, birds, and flowers so
            familiar to us are all relatively recent, originating within the
            last 200 million years. Modern-appearing humans,
            <i>Homo sapiens</i>, are a relatively new species, having inhabited
            this planet for only the last 200,000 years (approximately).
          </p>
        </div>
        <div class="image">
          <img
            src="../media/biology-organism-collage.png"
            alt="Biology: The Study of Life"
            width="300px"
            height="350px"
          />
          <p class="caption">
            Figure 1.1.1: Biology: The Study of Life. A collection of organisms
            clockwise from top left: bacteria, koala, fern, toadstool, tree
            frog, tarantula.
          </p>
        </div>
      </div>
      <div class="image">
        <img
          src="../media/stonesjpeg.jpeg"
          alt=""
          width="350px"
          height="350px"
        />
        <p class="caption">
          Figure 1.1.1 : Stromatolites: Stromatolites, sedimentary accretions
          formed by the actions of cyanobacteria, provide fossil evidence of
          life on Earth about 3.5 billion years ago.
        </p>
      </div>

      <div class="content">
        <div class="text">
          <h2>History of Biological Science</h2>
          <p>
            Although modern biology is a relatively recent development, sciences
            related to and included within it have been studied since ancient
            times. Natural philosophy was studied as early as the ancient
            civilizations of Mesopotamia, Egypt, the Indian subcontinent, and
            China. However, the origins of modern biology and its approach to
            the study of nature are most often traced back to ancient Greece.
            (Biology is derived from the Greek word “bio” meaning “life” and the
            suffix “ology” meaning “study of.”)
          </p>
          <p>
            Advances in microscopy also had a profound impact on biological
            thinking. In the early 19th century, a number of biologists pointed
            to the central importance of the cell and in 1838, Schleiden and
            Schwann began promoting the now universal ideas of the cell theory.
            Jean-Baptiste Lamarck was the first to present a coherent theory of
            evolution, although it was the British naturalist Charles Darwin who
            spread the theory of natural selection throughout the scientific
            community. In 1953, the discovery of the double helical structure of
            DNA marked the transition to the era of molecular genetics.
          </p>
          <h2>Key Points</h2>
          <ul>
            <li>
              Biology has evolved as a field of science since it was first
              studied in ancient civilizations, although modern biology is a
              relatively recent field.
            </li>
            <li>
              Science is a process that requires the testing of ideas using
              evidence gathered from the natural world. Science is iterative in
              nature and involves critical thinking, careful data collection,
              rigorous peer review, and the communication of results.
            </li>
            <li>
              Science also refers to the body of knowledge produced by
              scientific investigation.
            </li>
          </ul>

          <h2>Key Terms</h2>
          <ul>
            <li>
              <strong>Science: </strong>A process for learning about the natural
              world that tests ideas using evidence gathered from nature.
            </li>
            <li>
              <strong>Biology: </strong>A natural science concerned with the
              study of life and living organisms.
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="lesson">
      <h2>Characteristics of Living Things</h2>
      <div class="content">
        <div class="text">
          <p>
            Living things share common characteristics that define life. They
            are organized into cells, the basic units of life, and grow and
            develop over time. All living organisms reproduce to ensure the
            survival of their species and rely on metabolism to obtain and use
            energy. They maintain stable internal conditions through
            homeostasis, respond to environmental stimuli, and adapt over
            generations through evolution. These traits distinguish living
            organisms from non-living matter and form the basis for
            understanding biology.
          </p>
          <p>
            Join the Amoeba Sisters as they explore several characteristics of
            life.
          </p>
        </div>
      </div>
      <div class="video">
        <video controls width="720">
          <source src="../media/Characteristics of Life.mp4" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </div>
    </div>

    <div class="lesson">
      <h2>Levels of Biological Organization</h2>
      <div class="content">
        <div class="text">
          <p>
            Living things are highly organized and structured, following a
            hierarchy that can be examined on a scale from small to large. The
            atom is the smallest and most fundamental unit of matter. It
            consists of a nucleus surrounded by electrons. Atoms form molecules
            which are chemical structures consisting of at least two atoms held
            together by one or more chemical bonds. Many molecules that are
            biologically important are macromolecules, large molecules that are
            typically formed by polymerization (a polymer is a large molecule
            that is made by combining smaller units called monomers, which are
            simpler than macromolecules). An example of a macromolecule is
            deoxyribonucleic acid (DNA), which contains the instructions for the
            structure and functioning of all living organisms.
          </p>
        </div>
        <div class="image">
          <img
            src="../media/dna.jpeg"
            alt="Biology: The Study of Life"
            width="225px"
            height="350px"
          />
          <p class="caption">
            Figure 2.1.1 : DNA: All molecules, including this DNA molecule, are
            composed of atoms.
          </p>
        </div>
      </div>

      <div class="content">
        <div class="text">
          <h2>From Organelles to Biospheres</h2>
          <p>
            Macromolecules can form aggregates within a cell that are surrounded
            by membranes; these are called organelles. Organelles are small
            structures that exist within cells. Examples of these include:
            mitochondria and chloroplasts, which carry out indispensable
            functions. Mitochondria produce energy to power the cell while
            chloroplasts enable green plants to utilize the energy in sunlight
            to make sugars. All living things are made of cells, and the cell
            itself is the smallest fundamental unit of structure and function in
            living organisms. (This requirement is why viruses are not
            considered living: they are not made of cells. To make new viruses,
            they have to invade and hijack the reproductive mechanism of a
            living cell; only then can they obtain the materials they need to
            reproduce. ) Some organisms consist of a single cell and others are
            multicellular. Cells are classified as prokaryotic or eukaryotic.
            Prokaryotes are single-celled or colonial organisms that do not have
            membrane-bound nuclei; in contrast, the cells of eukaryotes do have
            membrane-bound organelles and a membrane-bound nucleus.
          </p>
          <p>
            In larger organisms, cells combine to make tissues, which are groups
            of similar cells carrying out similar or related functions. Organs
            are collections of tissues grouped together performing a common
            function. Organs are present not only in animals but also in plants.
            An organ system is a higher level of organization that consists of
            functionally related organs. Mammals have many organ systems. For
            instance, the circulatory system transports blood through the body
            and to and from the lungs; it includes organs such as the heart and
            blood vessels. Furthermore, organisms are individual living
            entities. For example, each tree in a forest is an organism.
            Single-celled prokaryotes and single-celled eukaryotes are also
            considered organisms and are typically referred to as
            microorganisms.
          </p>
          <p>
            All the individuals of a species living within a specific area are
            collectively called a population. For example, a forest may include
            many pine trees. All of these pine trees represent the population of
            pine trees in this forest. Different populations may live in the
            same specific area. For example, the forest with the pine trees
            includes populations of flowering plants and also insects and
            microbial populations. A community is the sum of populations
            inhabiting a particular area. For instance, all of the trees,
            flowers, insects, and other populations in a forest form the
            forest’s community. The forest itself is an ecosystem. An ecosystem
            consists of all the living things in a particular area together with
            the abiotic, non-living parts of that environment such as nitrogen
            in the soil or rain water. At the highest level of organization, the
            biosphere is the collection of all ecosystems, and it represents the
            zones of life on earth. It includes land, water, and even the
            atmosphere to a certain extent. Taken together, all of these levels
            comprise the biological levels of organization, which range from
            organelles to the biosphere.
          </p>
          <div class="image">
            <img
              src="../media/biological-levels.png"
              alt=""
              width="250px"
              height="550px"
            />
            <p class="caption">
              Figure 2.2.2 : Biological Levels of Organization: The biological
              levels of organization of living things follow a hierarchy, such
              as the one shown. From a single organelle to the entire biosphere,
              living organisms are part of a highly structured hierarchy.
            </p>
          </div>

          <h2>Key Points</h2>
          <ul>
            <li>
              The atom is the smallest and most fundamental unit of matter. The
              bonding of at least two atoms or more form molecules.
            </li>
            <li>
              The simplest level of organization for living things is a single
              organelle, which is composed of aggregates of macromolecules.
            </li>
            <li>
              The highest level of organization for living things is the
              biosphere; it encompasses all other levels.
            </li>
          </ul>

          <h2>Key Terms</h2>
          <ul>
            <li>
              <strong>Molecule: </strong>A process for learning about the
              natural world that tests ideas using evidence gathered from
              nature.
            </li>
            <li>
              <strong>macromolecule: </strong>A natural science concerned with
              the study of life and living organisms.
            </li>
            <li>
              <strong>polymerization: </strong>A natural science concerned with
              the study of life and living organisms.
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="lesson">
      <h2>Genetics</h2>
      <div class="content">
        <div class="text">
          <p>
            <strong>Genetics</strong> is a study of heredity in general and of
            genes in particular. Genetics forms one of the central pillars of
            biology and overlaps with many other areas, such as agriculture,
            medicine, and biotechnology.
          </p>
          <p>
            Since the dawn of civilization, humankind has recognized the
            influence of heredity and applied its principles to the improvement
            of cultivated crops and domestic animals. A Babylonian tablet more
            than 6,000 years old, for example, shows pedigrees of horses and
            indicates possible inherited characteristics. Other old carvings
            show cross-pollination of date palm trees. Most of the mechanisms of
            heredity, however, remained a mystery until the 19th century, when
            genetics as a systematic science began.
          </p>
          <h2>Chromosomes and Genes</h2>
          <p>
            Biological research indicates the first forms of life on Earth were
            microorganisms that existed for billions of years before the
            evolution of larger organisms. The mammals, birds, and flowers so
            familiar to us are all relatively recent, originating within the
            last 200 million years. Modern-appearing humans,
            <i>Homo sapiens</i>, are a relatively new species, having inhabited
            this planet for only the last 200,000 years (approximately).
          </p>
        </div>
      </div>
      <div class="image">
        <img
          src="../media/Chromosomes.jpg"
          alt=""
          width="350px"
          height="350px"
        />
        <p class="caption">Figure 5.1. Chromosomes</p>
      </div>
      <div class="content">
        <div class="text">
          <p>
            Each species has a characteristic number of chromosomes. Chromosomes
            are coiled structures made of DNA and proteins called histones
            Chromosomes are the form of the genetic material of a cell during
            cell division. See the "Chromosomes" section for additional
            information.
          </p>
          <p>
            The human genome has 23 pairs of chromosomes located in the nucleus
            of somatic cells. Each chromosome is composed of genes and other DNA
            wound around histones (proteins) into a tightly coiled molecule.
          </p>
        </div>
      </div>
      <div class="image">
        <img
          src="../media/chromosome-structure-and-organisation.png"
          alt=""
          width="300px"
          height="350px"
        />
        <p class="caption">Figure 5.2: Chromosome Structure</p>
        <img src="../media/human chromosomes.jpg" alt="" width="300px" />
        <p class="caption">Figure 5.3: Human Chromosomes</p>
      </div>

      <div class="content">
        <div class="text">
          <h2>Autosomes</h2>
          <p>
            Of the 23 pairs of human chromosomes, 22 pairs are autosomes
            (numbers 1–22 in Figure 5.3). Autosomes are chromosomes that contain
            genes for characteristics that are unrelated to sex. These
            chromosomes are the same in males and females. The great majority of
            human genes are located on autosomes. At the link below, you can
            click on any human chromosome to see which traits its genes control.
            http://www.ornl.gov/sci/techresources/Human_Genome/posters/chromosome/chooser.shtml
          </p>
          <p>
            The human genome has 23 pairs of chromosomes located in the nucleus
            of somatic cells. Each chromosome is composed of genes and other DNA
            wound around histones (proteins) into a tightly coiled molecule.
          </p>

          <h2>Sex Chromosomes</h2>
          <p>
            The remaining pair of human chromosomes consists of the sex
            chromosomes, X and Y. Females have two X chromosomes, and males have
            one X and one Y chromosome. In females, one of the X chromosomes in
            each cell is inactivated and known as a Barr body. This ensures that
            females, like males, have only one functioning copy of the X
            chromosome in each cell.
          </p>
          <p>
            The X chromosome is much larger than the Y chromosome. The X
            chromosome has about 2,000 genes, whereas the Y chromosome has fewer
            than 100, none of which are essential to survival. (For comparison,
            the smallest autosome, chromosome 22, has over 500 genes.) Virtually
            all of the X chromosome genes are unrelated to sex. Only the Y
            chromosome contains genes that determine sex. A single Y chromosome
            gene, called SRY (which stands for sex-determining region Y gene),
            triggers an embryo to develop into a male. Without a Y chromosome,
            an individual develops into a female, so you can think of female as
            the default sex of the human species. Can you think of a reason why
            the Y chromosome is so much smaller than the X chromosome?
          </p>
          <h2>Human Genes</h2>
          <p>
            Humans have an estimated 20,000 to 22,000 genes. This may sound like
            a lot, but it really isn’t. Far simpler species have almost as many
            genes as humans. However, human cells use splicing and other
            processes to make multiple proteins from the instructions encoded in
            a single gene. Of the 3 billion base pairs in the human genome, only
            about 25 percent make up genes and their regulatory elements. The
            functions of many of the other base pairs are still unclear. To
            learn more about the coding and noncoding sequences of human DNA,
            watch the animation at this link:
            www.hhmi.org/biointeractive/d...sequences.html.
          </p>
          <p>
            The majority of human genes have two or more possible alleles, which
            are alternative forms of a gene. Differences in alleles account for
            the considerable genetic variation among people. In fact, most human
            genetic variation is the result of differences in individual DNA
            bases within alleles.
          </p>
          <h2>Key Points</h2>
          <ul>
            <li>
              Humans have 23 pairs of chromosomes. Of these, 22 pairs are
              autosomes.
            </li>
            <li>
              The X and Y chromosomes are the sex chromosomes. Females have two
              X chromosomes, and males have one X and one Y.
            </li>
            <li>
              Human chromosomes contain a total of 20,000 to 22,000 genes, the
              majority of which have two or more alleles.
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
              $lessonId = 1; 
              $subject = 'Science';

              // Check if the user has already passed the quiz
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
                  <a href="../Quiz/biologyquiz.php">
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
