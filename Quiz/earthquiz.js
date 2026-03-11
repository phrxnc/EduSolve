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
    question: "What is the main function of the Earth's core?",
    options: [
      "To generate the Earth's magnetic field",
      "To maintain the Earth's temperature",
      "To control the weather",
      "To store volcanic materials",
    ],
    correct: "To generate the Earth's magnetic field",
  },
  {
    id: 1,
    question: "What material primarily makes up the Earth's inner core?",
    options: [
      "Solid rock",
      "Liquid water",
      "Solid iron and nickel",
      "Silicate minerals",
    ],
    correct: "Solid iron and nickel",
  },
  {
    id: 2,
    question: "What is the temperature of the Earth’s outer core?",
    options: ["500℃", "2,000℃", "3,600℃", "4,000℃"],
    correct: "3,600℃",
  },
  {
    id: 3,
    question:
      "Which layer of the Earth is responsible for producing the magnetic field?",
    options: ["The crust", "The mantle", "The inner core", "The outer core"],
    correct: "The outer core",
  },
  {
    id: 4,
    question: "What is the primary composition of the Earth's mantle?",
    options: ["Water", "Solid metal", "Semi-solid rock", "Gas"],
    correct: "Semi-solid rock",
  },
  {
    id: 5,
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
    id: 6,
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
    id: 7,
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
    id: 8,
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
    id: 9,
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
    id: 10,
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
    id: 11,
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
    id: 12,
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
    id: 13,
    question: "Which of the following is a type of weather-driven disaster?",
    options: ["Earthquake", "Wildfire", "Volcanic eruption", "Tsunami"],
    correct: "Wildfire",
  },
  {
    id: 14,
    question: "What happens when two continental plates collide?",
    options: [
      "One plate sinks beneath the other, forming an ocean trench",
      "They push upwards, forming mountain ranges",
      "One plate moves apart, forming new crust",
      "They slide past each other, creating a fault line",
    ],
    correct: "They push upwards, forming mountain ranges",
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

        fetch("../functions/save_scoreslessons.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            score: scoreCount,
            lesson_id: 4,
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
