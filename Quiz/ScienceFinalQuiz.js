let timeLeft = document.querySelector(".time-left");
let quizContainer = document.getElementById("container");
let nextBtn = document.getElementById("next-button");
let countOfQuestion = document.querySelector(".number-of-questions");
let displayContainer = document.getElementById("display-container");
let scoreContainer = document.querySelector(".score-container");
let restart = document.getElementById("restart");
let userScore = document.getElementById("user-score");
let questionCount;
let scoreCount = 0;
let count = 11;
let countdown;

// 10 questions
const quizArray = [
  {
    id: 0,
    question: "What is the basic unit of life?",
    options: ["Molecule", "Atom", "Cell", "Organelle"],
    correct: "Cell",
  },
  {
    id: 1,
    question:
      "Which of the following is the primary genetic material of living organisms?",
    options: ["RNA", "Proteins", "DNA", "Lipids"],
    correct: "DNA",
  },
  {
    id: 2,
    question:
      "What term describes the process of maintaining a stable internal environment?",
    options: ["Homeostasis", "Evolution", "Metabolism", "Adaptation"],
    correct: "Homeostasis",
  },
  {
    id: 3,
    question: "Who is credited with the theory of natural selection?",
    options: [
      "Jean-Baptiste Lamarck",
      "Gregor Mendel",
      "Charles Darwin",
      "Carl Linnaeus",
    ],
    correct: "Charles Darwin",
  },
  {
    id: 4,
    question:
      "Which of the following is the smallest level of biological organization?",
    options: ["Molecule", "Atom", "Cell", "Organ"],
    correct: "Atom",
  },
  {
    id: 5,
    question: "What distinguishes eukaryotic cells from prokaryotic cells?",
    options: [
      "Presence of a cell wall",
      "Presence of membrane-bound organelles",
      "Smaller size",
      "Lack of DNA",
    ],
    correct: "Presence of membrane-bound organelles",
  },
  {
    id: 6,
    question: "How many pairs of chromosomes are present in the human genome?",
    options: ["23", "22", "46", "24"],
    correct: "23",
  },
  {
    id: 7,
    question: "What are alternative forms of a gene called?",
    options: ["Chromosomes", "Alleles", "Histones", "Traits"],
    correct: "Alleles",
  },
  {
    id: 8,
    question: "What is the function of mitochondria in a cell?",
    options: [
      "Photosynthesis",
      "Protein synthesis",
      "Energy production",
      "DNA replication",
    ],
    correct: "Energy production",
  },
  {
    id: 9,
    question:
      "Which term refers to all the living and non-living components in a particular area?",
    options: ["Population", "Ecosystem", "Community", "Biosphere"],
    correct: "Ecosystem",
  },
  {
    id: 10,
    question: "What is matter?",
    options: [
      "A substance that has mass and occupies space",
      "A substance that is only visible",
      "A substance with no mass",
      "A substance that has only volume",
    ],
    correct: "A substance that has mass and occupies space",
  },
  {
    id: 11,
    question: "Which of the following is a state of matter?",
    options: ["Plasma", "Mass", "Density", "Volume"],
    correct: "Plasma",
  },
  {
    id: 12,
    question: "Which state of matter has a fixed shape and volume?",
    options: ["Solid", "Liquid", "Gas", "Plasma"],
    correct: "Solid",
  },
  {
    id: 13,
    question: "What is a physical property of matter?",
    options: [
      "Reactivity with other substances",
      "Melting point",
      "Flammability",
      "Rusting",
    ],
    correct: "Melting point",
  },
  {
    id: 14,
    question: "Which of the following is an example of a chemical property?",
    options: ["Density", "Color", "Reactivity with oxygen", "Volume"],
    correct: "Reactivity with oxygen",
  },
  {
    id: 15,
    question: "What is an example of an intensive property?",
    options: ["Mass", "Volume", "Temperature", "Length"],
    correct: "Temperature",
  },
  {
    id: 16,
    question: "Which of the following is an example of a pure substance?",
    options: ["Air", "Salt", "Milk", "Water vapor"],
    correct: "Salt",
  },
  {
    id: 17,
    question: "A homogeneous mixture is:",
    options: [
      "A mixture with a uniform composition",
      "A mixture that can be visually distinguished",
      "A mixture that only consists of solids",
      "A mixture with two distinct layers",
    ],
    correct: "A mixture with a uniform composition",
  },
  {
    id: 18,
    question: "Which of the following substances is a compound?",
    options: ["Gold", "Oxygen", "Water", "Nitrogen"],
    correct: "Water",
  },
  {
    id: 19,
    question: "Which of the following is a heterogeneous mixture?",
    options: ["Saltwater", "Sand and water", "Air", "Vinegar"],
    correct: "Sand and water",
  },
  {
    id: 20,
    question:
      "Which of the following layers is located directly above the mantle?",
    options: [
      "The inner core",
      "The outer core",
      "The crust",
      "The asthenosphere",
    ],
    correct: "The crust",
  },
  {
    id: 21,
    question: "What causes an earthquake at a convergent plate boundary?",
    options: [
      "Plates moving away from each other",
      "Plates sliding past each other",
      "Plates colliding and one sinking beneath the other",
      "Plates pushing upwards to form mountains",
    ],
    correct: "Plates colliding and one sinking beneath the other",
  },
  {
    id: 22,
    question: "Which of the following is an example of a divergent boundary?",
    options: [
      "The San Andreas Fault",
      "The Great Rift Valley",
      "The Himalayan Mountains",
      "The Andes Mountain Range",
    ],
    correct: "The Great Rift Valley",
  },
  {
    id: 23,
    question: "Where is the thickest part of the Earth’s crust located?",
    options: [
      "Ocean floors",
      "Under the continents",
      "At the Earth’s core",
      "At the plate boundaries",
    ],
    correct: "Under the continents",
  },
  {
    id: 24,
    question: "What is the main difference between weather and climate?",
    options: [
      "Weather refers to long-term trends, while climate refers to short-term conditions",
      "Weather changes rapidly, while climate remains constant",
      "Weather refers to short-term conditions, while climate refers to long-term patterns",
      "There is no difference between weather and climate",
    ],
    correct:
      "Weather refers to short-term conditions, while climate refers to long-term patterns",
  },
  {
    id: 25,
    question:
      "Which of the following best describes the role of meteorologists?",
    options: [
      "Study historical climate data",
      "Predict the weather over long periods of time",
      "Monitor short-term weather conditions and develop forecasts",
      "Study volcanic eruptions and their effects",
    ],
    correct: "Monitor short-term weather conditions and develop forecasts",
  },
  {
    id: 26,
    question: "What causes a volcanic eruption?",
    options: [
      "Movement of tectonic plates along transform boundaries",
      "Sudden release of magma from the Earth's crust",
      "Cooling of the Earth's outer layer",
      "Movement of wind and air pressure",
    ],
    correct: "Sudden release of magma from the Earth's crust",
  },
  {
    id: 27,
    question: "What is the primary cause of a tsunami?",
    options: [
      "Hurricane winds",
      "Submarine earthquakes",
      "Heavy rainfall",
      "Volcanic activity",
    ],
    correct: "Submarine earthquakes",
  },
  {
    id: 28,
    question: "Which of the following is a type of weather-driven disaster?",
    options: ["Earthquake", "Wildfire", "Volcanic eruption", "Tsunami"],
    correct: "Wildfire",
  },
  {
    id: 29,
    question: "What happens when two continental plates collide?",
    options: [
      "One plate sinks beneath the other, forming an ocean trench",
      "They push upwards, forming mountain ranges",
      "One plate moves apart, forming new crust",
      "They slide past each other, creating a fault line",
    ],
    correct: "They push upwards, forming mountain ranges",
  },
  {
    id: 30,
    question: "What is motion in physics?",
    options: [
      "A change in the position of a body with respect to time",
      "The force acting on a body",
      "The resistance to change in motion",
      "The mass of an object in movement",
    ],
    correct: "A change in the position of a body with respect to time",
  },
  {
    id: 31,
    question: "What is the formula for speed?",
    options: [
      "Speed = Distance × Time",
      "Speed = Distance ÷ Time",
      "Speed = Time ÷ Distance",
      "Speed = Distance + Time",
    ],
    correct: "Speed = Distance ÷ Time",
  },
  {
    id: 32,
    question: "What is the unit of force?",
    options: ["Joule", "Newton", "Watt", "Pascal"],
    correct: "Newton",
  },
  {
    id: 33,
    question: "Which of Newton's laws is also known as the law of inertia?",
    options: ["First Law", "Second Law", "Third Law", "None of these"],
    correct: "First Law",
  },
  {
    id: 34,
    question: "Which energy transformation occurs in a car engine?",
    options: [
      "Mechanical to electrical",
      "Chemical to mechanical",
      "Thermal to chemical",
      "Kinetic to potential",
    ],
    correct: "Chemical to mechanical",
  },
  {
    id: 35,
    question: "What is potential energy?",
    options: [
      "The energy of an object in motion",
      "The stored energy due to position or configuration",
      "The energy released during a chemical reaction",
      "The energy due to thermal activity",
    ],
    correct: "The stored energy due to position or configuration",
  },
  {
    id: 36,
    question: "What is the SI unit of energy?",
    options: ["Watt", "Newton", "Joule", "Kilogram"],
    correct: "Joule",
  },
  {
    id: 37,
    question: "What does an object in free fall experience?",
    options: [
      "Acceleration due to gravity",
      "No acceleration",
      "Uniform speed",
      "Zero velocity",
    ],
    correct: "Acceleration due to gravity",
  },
  {
    id: 38,
    question: "What is the center of gravity?",
    options: [
      "The point of maximum height",
      "The point where all weight appears concentrated",
      "The point of rotational motion",
      "The point of no force",
    ],
    correct: "The point where all weight appears concentrated",
  },
  {
    id: 39,
    question: "What is the relationship between power, work, and time?",
    options: [
      "Power = Work ÷ Time",
      "Power = Work × Time",
      "Power = Time ÷ Work",
      "Power = Work² ÷ Time",
    ],
    correct: "Power = Work ÷ Time",
  },
  {
    id: 40,
    question: "What is an example of a lever in daily life?",
    options: ["Bicycle", "Hammer", "Pulley", "Screw"],
    correct: "Hammer",
  },
  {
    id: 41,
    question: "What is a pulley system used for?",
    options: [
      "Increasing mass",
      "Decreasing gravity",
      "Lifting heavy objects",
      "Generating heat",
    ],
    correct: "Lifting heavy objects",
  },
  {
    id: 42,
    question: "What does a convex lens do?",
    options: [
      "Diverges light rays",
      "Converges light rays",
      "Scatters light",
      "Blocks light",
    ],
    correct: "Converges light rays",
  },
  {
    id: 43,
    question: "What is the speed of light in a vacuum?",
    options: ["3 × 10⁶ m/s", "3 × 10⁷ m/s", "3 × 10⁸ m/s", "3 × 10⁹ m/s"],
    correct: "3 × 10⁸ m/s",
  },
  {
    id: 44,
    question: "Which color of light has the shortest wavelength?",
    options: ["Red", "Green", "Blue", "Violet"],
    correct: "Violet",
  },
  {
    id: 45,
    question: "Which organ system is responsible for pumping blood?",
    options: [
      "Nervous system",
      "Circulatory system",
      "Respiratory system",
      "Digestive system",
    ],
    correct: "Circulatory system",
  },
  {
    id: 46,
    question: "What is the main function of the small intestine?",
    options: [
      "Breaking down proteins",
      "Absorbing nutrients",
      "Pumping oxygen",
      "Filtering blood",
    ],
    correct: "Absorbing nutrients",
  },
  {
    id: 47,
    question: "Which organ is known as the body's 'detox center'?",
    options: ["Lungs", "Liver", "Kidneys", "Heart"],
    correct: "Liver",
  },
  {
    id: 48,
    question: "What is the role of red blood cells?",
    options: [
      "Carrying oxygen",
      "Fighting infections",
      "Transporting nutrients",
      "Producing antibodies",
    ],
    correct: "Carrying oxygen",
  },
  {
    id: 49,
    question: "Which organ is responsible for filtering waste from the blood?",
    options: ["Heart", "Liver", "Kidneys", "Lungs"],
    correct: "Kidneys",
  },
];

// Restart the quiz
restart.addEventListener("click", () => {
  initial();
  displayContainer.classList.remove("hide");
  scoreContainer.classList.add("hide");
});

// Move to the next question
// nextBtn.addEventListener(
//   "click",
//   (displayNext = () => {
//     questionCount += 1;

//     if (questionCount === quizArray.length) {
//       displayContainer.classList.add("hide");
//       scoreContainer.classList.remove("hide");
//       userScore.innerHTML =
//         "Your Score is " + scoreCount + " out of " + quizArray.length;
//     } else {
//       countOfQuestion.innerHTML =
//         questionCount + 1 + " of " + quizArray.length + " Questions";
//       quizDisplay(questionCount);
//       count = 11;
//       clearInterval(countdown);
//       timerDisplay();
//     }
//   })
// );

nextBtn.addEventListener(
  "click",
  (displayNext = () => {
    
    let question = document.getElementsByClassName("container-mid")[questionCount];
    let options = question.querySelectorAll(".option-div");
    
    let isAnswered = Array.from(options).some(option => option.classList.contains("correct") || option.classList.contains("incorrect"));

    if (!isAnswered) {
      alert("Please select an answer before proceeding!");
      return;
    }

    questionCount += 1;

    if (questionCount === quizArray.length) {
      displayContainer.classList.add("hide");
      scoreContainer.classList.remove("hide");
      userScore.innerHTML =
        "Your Score is " + scoreCount + " out of " + quizArray.length;

        fetch("../functions/save_scores.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            score: scoreCount,
            subject_id: 1,
          }),
        })
    } else {
      countOfQuestion.innerHTML =
        questionCount + 1 + " of " + quizArray.length + " Questions";
      quizDisplay(questionCount);
      count = 11;
      clearInterval(countdown);
      timerDisplay();
    }
  })
);


// Timer functionality
const timerDisplay = () => {
  countdown = setInterval(() => {
    count--;
    timeLeft.innerHTML = `${count}s`;
    if (count === 0) {
      clearInterval(countdown);
      
      let question = document.getElementsByClassName("container-mid")[questionCount];
      let options = question.querySelectorAll(".option-div");

      let isAnswered = Array.from(options).some(option => option.classList.contains("correct") || option.classList.contains("incorrect"));

      if (!isAnswered) {

        options.forEach(element => {
          if (element.innerText === quizArray[questionCount].correct) {
            element.classList.add("correct");
          }
        });
      }

      displayNext();
    }
  }, 1000);
};
// Display a question
const quizDisplay = (questionCount) => {
  let quizCards = document.querySelectorAll(".container-mid");
  quizCards.forEach((card) => {
    card.classList.add("hide");
  });
  quizCards[questionCount].classList.remove("hide");
};

// Create quiz questions
function quizCreator() {
  quizArray.sort(() => Math.random() - 0.5);

  for (let i of quizArray) {
    i.options.sort(() => Math.random() - 0.5);
    let div = document.createElement("div");
    div.classList.add("container-mid", "hide");

    let question_DIV = document.createElement("p");
    question_DIV.classList.add("question");
    question_DIV.innerHTML = i.question;
    div.appendChild(question_DIV);

    div.innerHTML += `
      <button class="option-div" onclick="checker(this)">${i.options[0]}</button>
      <button class="option-div" onclick="checker(this)">${i.options[1]}</button>
      <button class="option-div" onclick="checker(this)">${i.options[2]}</button>
      <button class="option-div" onclick="checker(this)">${i.options[3]}</button>
    `;

    quizContainer.appendChild(div);
  }
}

// Check if the answer is correct
function checker(userOption) {
  let userSolution = userOption.innerText;
  let question =
    document.getElementsByClassName("container-mid")[questionCount];
  let options = question.querySelectorAll(".option-div");

  if (userSolution === quizArray[questionCount].correct) {
    userOption.classList.add("correct");
    scoreCount++;
  } else {
    userOption.classList.add("incorrect");
    options.forEach((element) => {
      if (element.innerText === quizArray[questionCount].correct) {
        element.classList.add("correct");
      }
    });
  }

  clearInterval(countdown);
  options.forEach((element) => {
    element.disabled = true;
  });
}

// Initialize the quiz
function initial() {
  quizContainer.innerHTML = "";
  questionCount = 0;
  scoreCount = 0;
  count = 11;
  clearInterval(countdown);
  quizCreator();
  quizDisplay(questionCount);
  timerDisplay();
}
// On window load
window.onload = () => {
  displayContainer.classList.remove("hide");
  scoreContainer.classList.add("hide");
  initial();
};
