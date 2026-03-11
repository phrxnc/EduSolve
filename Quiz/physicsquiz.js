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
    id: 1,
    question: "What is force?",
    options: [
      "A push or pull acting on an object",
      "The resistance of an object to motion",
      "The mass of an object",
      "The velocity of an object",
    ],
    correct: "A push or pull acting on an object",
  },
  {
    id: 2,
    question: "Which unit is used to measure force?",
    options: ["Newton (N)", "Meter (m)", "Kilogram (kg)", "Joule (J)"],
    correct: "Newton (N)",
  },
  {
    id: 3,
    question: "Newton's First Law of Motion is also known as:",
    options: [
      "The Law of Inertia",
      "The Law of Acceleration",
      "The Law of Action and Reaction",
      "The Law of Universal Gravitation",
    ],
    correct: "The Law of Inertia",
  },
  {
    id: 4,
    question: "What does Newton's Second Law of Motion describe?",
    options: [
      "The relationship between force, mass, and acceleration",
      "The law of inertia",
      "The equal and opposite reactions of forces",
      "The effect of gravity on objects",
    ],
    correct: "The relationship between force, mass, and acceleration",
  },
  {
    id: 5,
    question:
      "Which of the following is a direct result of Newton’s Third Law of Motion?",
    options: [
      "For every action, there is an equal and opposite reaction",
      "Force is proportional to mass and acceleration",
      "Objects at rest stay at rest",
      "The speed of light is constant",
    ],
    correct: "For every action, there is an equal and opposite reaction",
  },
  {
    id: 6,
    question: "What is acceleration?",
    options: [
      "The rate of change of velocity with respect to time",
      "The force acting on a body",
      "The speed of an object in motion",
      "The initial velocity of a body",
    ],
    correct: "The rate of change of velocity with respect to time",
  },
  {
    id: 7,
    question:
      "A car accelerates from rest to 20 m/s in 5 seconds. What is the acceleration?",
    options: ["4 m/s²", "5 m/s²", "10 m/s²", "20 m/s²"],
    correct: "4 m/s²",
  },
  {
    id: 8,
    question:
      "A force of 10 N is applied to a 2 kg object. What is the acceleration of the object?",
    options: ["5 m/s²", "2 m/s²", "1 m/s²", "10 m/s²"],
    correct: "5 m/s²",
  },
  {
    id: 9,
    question: "What does the term 'final velocity' refer to?",
    options: [
      "The speed of an object after maximum acceleration",
      "The speed of an object when it first starts moving",
      "The initial velocity before any force is applied",
      "The constant speed of an object",
    ],
    correct: "The speed of an object after maximum acceleration",
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
            lesson_id: 3,
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
