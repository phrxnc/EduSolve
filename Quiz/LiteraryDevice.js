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
    question: "What is a simile used for?",
    options: [
      "To compare two things using 'like,' 'as,' or 'than'.",
      "To create rhymes in poetry.",
      "To exaggerate a statement for effect.",
      "To give hints about future events.",
    ],
    correct: "To compare two things using 'like,' 'as,' or 'than'.",
  },
  {
    id: 1,
    question: "Give an example of a metaphor.",
    options: [
      "The world is a stage.",
      "She is as brave as a lion.",
      "The car zoomed past us.",
      "It rained cats and dogs.",
    ],
    correct: "The world is a stage.",
  },
  {
    id: 2,
    question: "What is personification?",
    options: [
      "Giving human qualities to non-human things.",
      "A comparison without using 'like' or 'as'.",
      "A type of irony.",
      "Repetition of sounds at the beginning of words.",
    ],
    correct: "Giving human qualities to non-human things.",
  },
  {
    id: 3,
    question: "What is the main purpose of hyperbole?",
    options: [
      "To emphasize or exaggerate an idea.",
      "To compare two objects.",
      "To provide subtle hints.",
      "To create sound effects.",
    ],
    correct: "To emphasize or exaggerate an idea.",
  },
  {
    id: 4,
    question: "Define alliteration.",
    options: [
      "Repetition of consonant sounds at the beginning of words.",
      "Use of words that imitate sounds.",
      "Reference to historical events.",
      "Attributing human traits to objects.",
    ],
    correct: "Repetition of consonant sounds at the beginning of words.",
  },
  {
    id: 5,
    question: "What is onomatopoeia?",
    options: [
      "Words that imitate natural sounds.",
      "A phrase with contradictory terms.",
      "A subtle hint about future events.",
      "A story with a deeper meaning.",
    ],
    correct: "Words that imitate natural sounds.",
  },
  {
    id: 6,
    question: "What is foreshadowing?",
    options: [
      "Hints about events to come in a story.",
      "Repetition of sounds in words.",
      "A story within another story.",
      "An intentional exaggeration.",
    ],
    correct: "Hints about events to come in a story.",
  },
  {
    id: 7,
    question: "Name a type of irony.",
    options: ["Dramatic irony.", "Hyperbole.", "Allusion.", "Metaphor."],
    correct: "Dramatic irony.",
  },
  {
    id: 8,
    question: "What is an oxymoron?",
    options: [
      "A phrase combining contradictory terms.",
      "A humorous imitation.",
      "An exaggerated statement.",
      "A reference to another work.",
    ],
    correct: "A phrase combining contradictory terms.",
  },
  {
    id: 9,
    question: "What does imagery appeal to?",
    options: [
      "The senses.",
      "Future events.",
      "Historical facts.",
      "Contradictory terms.",
    ],
    correct: "The senses.",
  },
  {
    id: 10,
    question: "What is allusion?",
    options: [
      "A reference to a well-known person, place, or event.",
      "A phrase that imitates sound.",
      "A subtle comparison.",
      "A type of exaggeration.",
    ],
    correct: "A reference to a well-known person, place, or event.",
  },
  {
    id: 11,
    question: "What is an allegory?",
    options: [
      "A story with a deeper meaning.",
      "A humorous twist in events.",
      "A contradiction in terms.",
      "An exaggerated statement.",
    ],
    correct: "A story with a deeper meaning.",
  },
  {
    id: 12,
    question: "What is an example of auditory imagery?",
    options: [
      "The sound of broken glass shattering.",
      "The red sunset blazed in the sky.",
      "The soft silk felt smooth to the touch.",
      "The pie tasted sweet and tangy.",
    ],
    correct: "The sound of broken glass shattering.",
  },
  {
    id: 13,
    question: "What is situational irony?",
    options: [
      "An outcome different from what is expected.",
      "A humorous imitation.",
      "A direct comparison.",
      "A phrase with opposite terms.",
    ],
    correct: "An outcome different from what is expected.",
  },
  {
    id: 14,
    question: "What does a corrective allusion aim to do?",
    options: [
      "Oppose the original reference.",
      "Support an exaggerated claim.",
      "Imitate a sound effect.",
      "Describe a sensory detail.",
    ],
    correct: "Oppose the original reference.",
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
    // Get the current question's options
    let question = document.getElementsByClassName("container-mid")[questionCount];
    let options = question.querySelectorAll(".option-div");
    
    // Check if any option has been selected
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
            lesson_id: 14,
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
