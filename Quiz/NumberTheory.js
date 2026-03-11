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
    question: "What is an example of a composite number?",
    options: ["2", "7", "15", "23"],
    correct: "15",
  },
  {
    id: 1,
    question: "Which of the following is NOT a prime number?",
    options: ["29", "41", "51", "73"],
    correct: "51",
  },
  {
    id: 2,
    question: "What is the first cube number?",
    options: ["2", "8", "1", "27"],
    correct: "1",
  },
  {
    id: 3,
    question: "What is the 7th Fibonacci number?",
    options: ["8", "13", "21", "34"],
    correct: "13",
  },
  {
    id: 4,
    question: "Which property is unique to all prime numbers?",
    options: [
      "They are all odd",
      "They are divisible only by 1 and themselves",
      "They have more than two factors",
      "They are all even",
    ],
    correct: "They are divisible only by 1 and themselves",
  },
  {
    id: 5,
    question: "Which method is NOT used to find the GCD of two numbers?",
    options: [
      "Prime factorization",
      "Euclid’s algorithm",
      "Long division method",
      "Multiplication method",
    ],
    correct: "Multiplication method",
  },
  {
    id: 6,
    question: "Identify all prime numbers between 10 and 30.",
    options: [
      "11, 13, 17, 19, 23, 29",
      "12, 15, 18, 21",
      "10, 14, 20, 28",
      "none of the above",
    ],
    correct: "11, 13, 17, 19, 23, 29",
  },
  {
    id: 7,
    question: "What is the least common multiple (LCM) of 6 and 8?",
    options: ["24", "48", "12", "69"],
    correct: "24",
  },
  {
    id: 8,
    question: "If a = 15 and b = 25, what is the GCD of a and b?",
    options: ["5", "10", "15", "20"],
    correct: "5",
  },
  {
    id: 9,
    question: "Find the GCD of 18 and 48 using the prime factorization method.",
    options: ["6", "12", "9", "3"],
    correct: "6",
  },
  {
    id: 10,
    question: "What is the GCD of 84 and 28 using the long division method?",
    options: ["14", "28", "42", "7"],
    correct: "28",
  },
  {
    id: 11,
    question: "Find the GCD of 42 and 56 using Euclid's algorithm.",
    options: ["14", "7", "28", "21"],
    correct: "14",
  },
  {
    id: 12,
    question: "Two numbers are 16 and 24. Find their GCD.",
    options: ["4", "8", "12", "16"],
    correct: "8",
  },
  {
    id: 13,
    question: "What is the smallest prime number?",
    options: ["1", "2", "3", "5"],
    correct: "2",
  },
  {
    id: 14,
    question: "Which of the following is a Fibonacci number?",
    options: ["6", "10", "13", "20"],
    correct: "13",
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
            lesson_id: 6,
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
