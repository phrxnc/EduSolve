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
    question:
      "What is the primary source of electromagnetic energy in the Solar System?",
    options: ["The Sun", "The Moon", "Proxima Centauri", "The Milky Way"],
    correct: "The Sun",
  },
  {
    id: 1,
    question:
      "Which planet has the most highly inclined orbit in the Solar System?",
    options: ["Neptune", "Mars", "Pluto", "Uranus"],
    correct: "Pluto",
  },
  {
    id: 2,
    question:
      "What percentage of the Solar System's mass is contained in the Sun?",
    options: ["99.85%", "50%", "75%", "90%"],
    correct: "99.85%",
  },
  {
    id: 3,
    question: "Which planets are classified as terrestrial planets?",
    options: [
      "Mercury, Venus, Earth, Mars",
      "Jupiter, Saturn, Uranus, Neptune",
      "Pluto and Neptune",
      "Mars, Jupiter, Saturn",
    ],
    correct: "Mercury, Venus, Earth, Mars",
  },
  {
    id: 4,
    question: "What is the nearest star to the Sun?",
    options: ["Andromeda", "Proxima Centauri", "Alpha Centauri", "Betelgeuse"],
    correct: "Proxima Centauri",
  },
  {
    id: 5,
    question: "What causes Earth's seasons?",
    options: [
      "Earth's distance from the Sun",
      "Earth's axial tilt",
      "Earth's rotation",
      "The Moon's gravitational pull",
    ],
    correct: "Earth's axial tilt",
  },
  {
    id: 6,
    question:
      "Which planet contains more than twice the mass of all other planets combined?",
    options: ["Saturn", "Jupiter", "Neptune", "Earth"],
    correct: "Jupiter",
  },
  {
    id: 7,
    question: "What term describes Earth's spinning motion about its axis?",
    options: ["Revolution", "Orbit", "Rotation", "Precession"],
    correct: "Rotation",
  },
  {
    id: 8,
    question: "What is the shape of Earth's orbit around the Sun?",
    options: ["Circular", "Elliptical", "Triangular", "Hexagonal"],
    correct: "Elliptical",
  },
  {
    id: 9,
    question: "What phenomenon occurs when the Earth is farthest from the Sun?",
    options: ["Perihelion", "Aphelion", "Equinox", "Solstice"],
    correct: "Aphelion",
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
            lesson_id: 5,
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
