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
    question: "What is the main idea of a text?",
    options: [
      "The central point or message of the text.",
      "The first sentence of the text.",
      "A random detail mentioned in the text.",
      "The conclusion of the text.",
    ],
    correct: "The central point or message of the text.",
  },
  {
    id: 1,
    question:
      "What skill involves drawing conclusions from hints or implied information?",
    options: [
      "Summarizing",
      "Making inferences",
      "Identifying text structure",
      "Understanding figurative language",
    ],
    correct: "Making inferences",
  },
  {
    id: 2,
    question: "Which is NOT one of the author's purposes for writing?",
    options: ["To entertain", "To confuse", "To inform", "To persuade"],
    correct: "To confuse",
  },
  {
    id: 3,
    question: "What does 'sequence' refer to in identifying text structure?",
    options: [
      "Highlighting similarities and differences",
      "Explaining events in chronological order",
      "Identifying an issue and proposing solutions",
      "Showing relationships between actions/events",
    ],
    correct: "Explaining events in chronological order",
  },
  {
    id: 4,
    question: "Which of the following is an example of figurative language?",
    options: [
      "The tree is tall.",
      "The wind whispered through the trees.",
      "The book is on the table.",
      "The car is blue.",
    ],
    correct: "The wind whispered through the trees.",
  },
  {
    id: 5,
    question:
      "What is the main idea of the following passage? 'Exercise not only strengthens the body but also improves mental health. Regular physical activity can reduce stress and increase overall happiness.'",
    options: [
      "Exercise is only for physical fitness.",
      "Exercise benefits both the body and mind.",
      "Exercise causes stress.",
      "Exercise is boring.",
    ],
    correct: "Exercise benefits both the body and mind.",
  },
  {
    id: 6,
    question:
      "What can you infer about the explorers in this sentence? 'The explorers braved harsh winds and freezing temperatures to reach the summit of the mountain.'",
    options: [
      "They are unprepared for the journey.",
      "They are determined and brave.",
      "They are afraid of heights.",
      "They are inexperienced.",
    ],
    correct: "They are determined and brave.",
  },
  {
    id: 7,
    question:
      "How would you describe the atmosphere of the town square? 'The town square bustled with activity. Vendors called out their wares, children ran around, and musicians played lively tunes.'",
    options: [
      "Quiet and calm",
      "Busy and lively",
      "Empty and abandoned",
      "Chaotic and frightening",
    ],
    correct: "Busy and lively",
  },
  {
    id: 8,
    question:
      "What is an inference you can make from this passage? 'She smiled at the children as they played in the park, basking in the warm sunlight.'",
    options: [
      "She dislikes children.",
      "She is enjoying a sunny day.",
      "The weather is cold.",
      "She is waiting for someone.",
    ],
    correct: "She is enjoying a sunny day.",
  },
  {
    id: 9,
    question:
      "What is the primary message in this passage? 'After years of hard work and dedication, the team celebrated their victory with a grand feast.'",
    options: [
      "Hard work leads to success.",
      "The team was lazy.",
      "The team failed.",
      "The team did not enjoy the feast.",
    ],
    correct: "Hard work leads to success.",
  },
  {
    id: 10,
    question:
      "What does the passage imply about the weather? 'The rain had been pouring for hours, and the streets were flooded.'",
    options: [
      "It had been raining lightly.",
      "The weather was clear.",
      "The rain caused a flood.",
      "The rain had just started.",
    ],
    correct: "The rain caused a flood.",
  },
  {
    id: 11,
    question:
      "Which of the following is a detail from the passage? 'The museum displayed art from different periods, from ancient sculptures to contemporary paintings.'",
    options: [
      "The museum had various types of art.",
      "The museum only displayed sculptures.",
      "The art was all contemporary.",
      "There was no art in the museum.",
    ],
    correct: "The museum had various types of art.",
  },
  {
    id: 12,
    question:
      "What is the main idea of the following passage? 'Reading regularly can improve vocabulary, increase knowledge, and enhance concentration.'",
    options: [
      "Reading has many benefits.",
      "Reading is boring.",
      "Reading is only for fun.",
      "Reading is hard.",
    ],
    correct: "Reading has many benefits.",
  },
  {
    id: 13,
    question:
      "What can you infer about the character in this passage? 'She gripped the edge of the cliff, her heart racing, as she stared down at the rocky valley below.'",
    options: [
      "She is confident and calm.",
      "She is terrified and anxious.",
      "She is enjoying the view.",
      "She is not afraid of heights.",
    ],
    correct: "She is terrified and anxious.",
  },
  {
    id: 14,
    question:
      "What can you infer from the passage? 'He had never been more excited to start his new job and could barely sleep the night before his first day.'",
    options: [
      "He was nervous about the job.",
      "He was looking forward to the job.",
      "He was dreading the job.",
      "He was unsure about the job.",
    ],
    correct: "He was looking forward to the job.",
  },
];

// Restart the quiz
restart.addEventListener("click", () => {
  initial();
  displayContainer.classList.remove("hide");
  scoreContainer.classList.add("hide");
});

// Move to the next question
nextBtn.addEventListener(
  "click",
  (displayNext = () => {
    questionCount += 1;

    if (questionCount === quizArray.length) {
      displayContainer.classList.add("hide");
      scoreContainer.classList.remove("hide");
      userScore.innerHTML =
        "Your Score is " + scoreCount + " out of " + quizArray.length;
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

// Check if the Answer is correct
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
  scoreContainer.classList.add("hide")
  initial();
};
