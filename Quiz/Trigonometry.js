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
    question: "What does the word 'Trigonometry' originate from?",
    options: [
      "a) Latin words for circle and measure",
      "b) Greek words for triangle and measure",
      "c) Greek words for angle and sides",
      "d) Latin words for geometry and algebra",
    ],
    correct: "b) Greek words for triangle and measure",
  },
  {
    id: 1,
    question: "What is the measure of a straight angle?",
    options: ["a) 90°", "b) 180°", "c) 270°", "d) 360°"],
    correct: "b) 180°",
  },
  {
    id: 2,
    question: "What is the formula for the Pythagorean Theorem?",
    options: [
      "a) Hypotenuse = Base + Perpendicular",
      "b) Hypotenuse² = Base² + Perpendicular²",
      "c) Base² = Hypotenuse² + Perpendicular²",
      "d) Hypotenuse² = Base² - Perpendicular²",
    ],
    correct: "b) Hypotenuse² = Base² + Perpendicular²",
  },
  {
    id: 3,
    question: "Convert 45° into radians.",
    options: ["a) π/4", "b) π/2", "c) π/6", "d) 3π/4"],
    correct: "a) π/4",
  },
  {
    id: 4,
    question:
      "Which trigonometric function represents the ratio of opposite to hypotenuse in a right triangle?",
    options: ["a) Sine", "b) Cosine", "c) Tangent", "d) Secant"],
    correct: "a) Sine",
  },
  {
    id: 5,
    question:
      "Solve: If the hypotenuse of a right triangle is 10 and one side is 6, what is the length of the other side?",
    options: ["a) 8", "b) 7", "c) 4", "d) 5"],
    correct: "d) 8",
  },
  {
    id: 6,
    question: "What is the radian measure of 360°?",
    options: ["a) π", "b) 2π", "c) 3π", "d) π/2"],
    correct: "b) 2π",
  },
  {
    id: 7,
    question: "What is the sine of 30°?",
    options: ["a) 1/2", "b) √3/2", "c) √2/2", "d) 1"],
    correct: "a) 1/2",
  },
  {
    id: 8,
    question: "If cos(θ) = 4/5 in a right triangle, what is sin(θ)?",
    options: ["a) 3/5", "b) 4/5", "c) 5/4", "d) √41/5"],
    correct: "a) 3/5",
  },
  {
    id: 9,
    question:
      "What is the area of a right triangle with a base of 5 units and a height of 12 units?",
    options: [
      "a) 30 square units",
      "b) 60 square units",
      "c) 75 square units",
      "d) 25 square units",
    ],
    correct: "b) 30 square units",
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
            lesson_id: 9,
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
