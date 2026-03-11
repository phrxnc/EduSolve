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
    question: "Solve for x: 3x + 5 = 14.",
    options: ["x = 3", "x = 2", "x = 5", "x = 69"],
    correct: "x = 3",
  },
  {
    id: 1,
    question: "Simplify: 2(x + 3) − x.",
    options: ["x + 6", "x + y", "x + 3", "3x + 3"],
    correct: "x + 6",
  },
  {
    id: 2,
    question: "Factorize: x^2 + 5x + 6.",
    options: [
      "(x + 2)(x + 3)",
      "(x + 1)(x + 6)",
      "(x − 2)(x − 3)",
      "(x − 6)(x − 9)",
    ],
    correct: "(x + 2)(x + 3)",
  },
  {
    id: 3,
    question: "What is a monomial?",
    options: [
      "An expression with one term",
      "An expression with two terms",
      "An expression with three terms",
      "An expression with no terms",
    ],
    correct: "An expression with one term",
  },
  {
    id: 4,
    question: "What is the degree of a polynomial?",
    options: [
      "The highest power of the variable",
      "The number of terms in the polynomial",
      "The coefficient of the leading term",
      "All of the above",
    ],
    correct: "The highest power of the variable",
  },
  {
    id: 5,
    question: "What does it mean to factorize an expression?",
    options: [
      "To break it into simpler terms or factors",
      "To add it to another expression",
      "To simplify it by division",
      "All of the above",
    ],
    correct: "To break it into simpler terms or factors",
  },
  {
    id: 6,
    question: "What is the product of (x - 2)(x + 2)?",
    options: ["x^8 - 4", "x^2 - 4", "x^2 + 4", "x^2 - 2"],
    correct: "x^2 - 4",
  },
  {
    id: 7,
    question: "What is a binomial?",
    options: [
      "An expression with one term",
      "An expression with two terms",
      "An expression with three terms",
      "An expression with one-hundred terms",
    ],
    correct: "An expression with two terms",
  },
  {
    id: 8,
    question: "What is the base in the expression 6^4?",
    options: ["6", "4", "24", "69"],
    correct: "6",
  },
  {
    id: 9,
    question: "If 5x + 2y = 20 and y = 2, find x.",
    options: ["x = 2", "x = 20", "x = 3", "x = 4"],
    correct: "x = 3",
  },
  {
    id: 10,
    question: "What is the exponent in the expression 2x^3?",
    options: ["2", "3", "6", "420"],
    correct: "3",
  },
  {
    id: 11,
    question:
      "What is the value of x in the quadratic equation x^2 - 6x + 9 = 0?",
    options: ["x = 3", "x = 24", , "x = 5", "x = 1"],
    correct: "x = 3",
  },
  {
    id: 12,
    question: "What is a trinomial?",
    options: [
      "An expression with one term",
      "An expression with two terms",
      "An expression with three terms",
      "None of the above",
    ],
    correct: "An expression with three terms",
  },
  {
    id: 13,
    question: "Which symbol represents a strict inequality?",
    options: ["<", "≤", "=", "<>"],
    correct: "<",
  },
  {
    id: 14,
    question: "Identify the polynomial.",
    options: ["x^2 + 4x + 5", "x^2 + 4", "x^3", "x^2"],
    correct: "x^2 + 4x + 5",
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
            lesson_id: 7,
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
