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
      "Choose the word that best fits the sentence: The ancient ruins were truly ________, leaving visitors in awe.",
    options: ["mundane", "fascinating", "insignificant", "boring"],
    correct: "fascinating",
  },
  {
    id: 1,
    question: "Identify the synonym of 'benevolent':",
    options: ["Generous", "Selfish", "Cruel", "Angry"],
    correct: "Generous",
  },
  {
    id: 2,
    question: "What does the word 'perseverance' most closely mean?",
    options: [
      "Giving up easily",
      "Steadfastness",
      "Carelessness",
      "Procrastination",
    ],
    correct: "Steadfastness",
  },
  {
    id: 3,
    question: "Choose the antonym of 'brave':",
    options: ["Bold", "Fearful", "Heroic", "Courageous"],
    correct: "Fearful",
  },
  {
    id: 4,
    question: "Which word is closest in meaning to 'melancholy'?",
    options: ["Joyful", "Sad", "Angry", "Hopeful"],
    correct: "Sad",
  },
  {
    id: 5,
    question: "The word 'meticulous' means:",
    options: ["Careless", "Precise", "Lazy", "Quick"],
    correct: "Precise",
  },
  {
    id: 6,
    question: "Which word is a synonym of 'fragile'?",
    options: ["Strong", "Shaky", "Delicate", "Durable"],
    correct: "Delicate",
  },
  {
    id: 7,
    question: "What does 'sophisticated' most closely mean?",
    options: ["Simple", "Elegant", "Basic", "Clumsy"],
    correct: "Elegant",
  },
  {
    id: 8,
    question: "What is the synonym of 'obvious'?",
    options: ["Hidden", "Clear", "Complex", "Uncertain"],
    correct: "Clear",
  },
  {
    id: 9,
    question: "Choose the word that is most similar in meaning to 'elated':",
    options: ["Sad", "Excited", "Indifferent", "Calm"],
    correct: "Excited",
  },
  {
    id: 10,
    question: "What is vocabulary?",
    options: [
      "A set of mathematical formulas",
      "The set of words known and used by a person",
      "A collection of books",
      "A list of synonyms and antonyms",
    ],
    correct: "The set of words known and used by a person",
  },
  {
    id: 11,
    question: "What is a synonym?",
    options: [
      "A word with the same or similar meaning as another",
      "A word with the opposite meaning",
      "A verb used in past tense",
      "A word describing a place",
    ],
    correct: "A word with the same or similar meaning as another",
  },
  {
    id: 12,
    question: "What is an antonym?",
    options: [
      "A synonym for a verb",
      "A word describing a noun",
      "A word that means the opposite of another",
      "A word with multiple meanings",
    ],
    correct: "A word that means the opposite of another",
  },
  {
    id: 13,
    question: "What is a verb?",
    options: [
      "A word describing an action, occurrence, or state of being",
      "A word that describes a noun",
      "A word that means the opposite of another",
      "A word with multiple meanings",
    ],
    correct: "A word describing an action, occurrence, or state of being",
  },
  {
    id: 14,
    question: "What is a noun?",
    options: [
      "A word that modifies another word",
      "A word that names a person, place, thing, or idea",
      "A word describing an action",
      "A word with multiple meanings",
    ],
    correct: "A word that names a person, place, thing, or idea",
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
            lesson_id: 11,
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
