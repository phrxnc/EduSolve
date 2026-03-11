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
    question: "What does probability measure?",
    options: [
      "The certainty of an event occurring",
      "The likelihood of an event occurring",
      "The time it takes for an event to occur",
      "The total outcomes in a sample space",
    ],
    correct: "The likelihood of an event occurring",
  },
  {
    id: 1,
    question: "Which of the following is the range of probability?",
    options: ["0 to 1", "-1 to 1", "0 to 100", "-100 to 100"],
    correct: "0 to 1",
  },
  {
    id: 2,
    question: "If an event is impossible, what is its probability?",
    options: ["1", "0", "1/2", "It depends on the event"],
    correct: "0",
  },
  {
    id: 3,
    question: "Two events are mutually exclusive if:",
    options: [
      "They occur at the same time",
      "They cannot occur at the same time",
      "Their probabilities sum to 2",
      "They are independent",
    ],
    correct: "They cannot occur at the same time",
  },
  {
    id: 4,
    question: "What is the probability of a certain event occurring?",
    options: ["0", "1", "1/2", "It depends on the event"],
    correct: "1",
  },
  {
    id: 5,
    question:
      "What do you call the set of all possible outcomes in an experiment?",
    options: ["Sample space", "Event", "Subset", "Complement"],
    correct: "Sample space",
  },
  // Problem-Solving Questions
  {
    id: 6,
    question:
      "A jar contains 6 yellow, 4 red, and 10 green marbles. If one marble is picked at random, what is the probability of it being yellow?",
    options: ["3/10", "1/5", "3/20", "1/2"],
    correct: "3/10",
  },
  {
    id: 7,
    question:
      "A coin is tossed three times. What is the probability of getting exactly two heads?",
    options: ["1/4", "1/2", "3/8", "3/4"],
    correct: "3/8",
  },
  {
    id: 8,
    question:
      "A bag contains 4 white balls, 3 black balls, and 2 red balls. Two balls are drawn at random. What is the probability that both are black?",
    options: ["1/12", "1/24", "3/40", "3/42"],
    correct: "1/12",
  },
  {
    id: 9,
    question:
      "In a survey, 60% of participants like chocolate, 30% like vanilla, and 10% like both. If a participant is chosen at random, what is the probability that they like only chocolate?",
    options: ["0.4", "0.5", "0.6", "0.3"],
    correct: "0.5",
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
            lesson_id: 10,
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
