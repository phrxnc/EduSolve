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
      "What is the term for the study of shapes, sizes, and properties of space?",
    options: ["Algebra", "Geometry", "Trigonometry", "Calculus"],
    correct: "Geometry",
  },
  {
    id: 1,
    question: "What is a polygon with four sides called?",
    options: ["Triangle", "Square", "Rectangle", "Quadrilateral"],
    correct: "Quadrilateral",
  },
  {
    id: 2,
    question: "Which of the following is not a type of angle?",
    options: ["Acute Angle", "Obtuse Angle", "Reflex Angle", "Cubic Angle"],
    correct: "Cubic Angle",
  },
  {
    id: 3,
    question: "What is a figure formed by two rays sharing a common endpoint?",
    options: ["Line", "Angle", "Point", "Ray"],
    correct: "Angle",
  },
  {
    id: 4,
    question:
      "In solid geometry, what do we call the point where edges of a solid meet?",
    options: ["Edge", "Face", "Vertex", "Plane"],
    correct: "Vertex",
  },
  {
    id: 5,
    question: "Which of the following is a three-dimensional figure?",
    options: ["Square", "Circle", "Triangle", "Cube"],
    correct: "Cube",
  },
  {
    id: 6,
    question:
      "What do we call two figures that have the same shape but different sizes?",
    options: ["Similar", "Congruent", "Symmetric", "Parallel"],
    correct: "Similar",
  },
  {
    id: 7,
    question: "What is the formula for the area of a rectangle?",
    options: [
      "Area = Length x Width",
      "Area = Side x Side",
      "Area = πr²",
      "Area = Base x Height / 2",
    ],
    correct: "Area = Length x Width",
  },
  {
    id: 8,
    question:
      "What is the perimeter of a rectangle with a length of 6 cm and a width of 4 cm?",
    options: ["24 cm", "20 cm", "16 cm", "12 cm"],
    correct: "20 cm",
  },
  {
    id: 9,
    question:
      "What is the area of a triangle with a base of 10 units and a height of 6 units?",
    options: [
      "30 square units",
      "60 square units",
      "15 square units",
      "20 square units",
    ],
    correct: "30 square units",
  },
  {
    id: 10,
    question:
      "What is the perimeter of an equilateral triangle with side lengths of 8 cm?",
    options: ["24 cm", "16 cm", "32 cm", "28 cm"],
    correct: "24 cm",
  },
  {
    id: 11,
    question:
      "A rectangle has a length of 12 cm and a width of 5 cm. What is its area?",
    options: ["60 square cm", "55 square cm", "50 square cm", "48 square cm"],
    correct: "60 square cm",
  },
  {
    id: 12,
    question: "What is the volume of a cube with a side length of 3 cm?",
    options: ["27 cm³", "18 cm³", "36 cm³", "9 cm³"],
    correct: "27 cm³",
  },
  {
    id: 13,
    question: "If the radius of a circle is 7 cm, what is its area?",
    options: [
      "153.94 square cm",
      "154.00 square cm",
      "143.65 square cm",
      "154.20 square cm",
    ],
    correct: "153.94 square cm",
  },
  {
    id: 14,
    question:
      "Find the volume of a cone with a radius of 3 cm and a height of 4 cm.",
    options: ["37.68 cm³", "45.56 cm³", "32.98 cm³", "42.52 cm³"],
    correct: "37.68 cm³",
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
            lesson_id: 8,
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
