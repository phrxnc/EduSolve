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
    question: "What is the purpose of grammar in language?",
    options: [
      "To confuse readers with complex rules",
      "To convey clear and precise meanings",
      "To make sentences longer and more interesting",
      "To remove punctuation from sentences",
    ],
    correct: "To convey clear and precise meanings",
  },
  {
    id: 1,
    question: "Which sentence is a simple sentence?",
    options: [
      "He studied all night, so he passed the test.",
      "Because it was raining, she stayed inside.",
      "She enjoys hiking and biking on weekends.",
      "I will go to the park after finishing my homework.",
    ],
    correct: "She enjoys hiking and biking on weekends.",
  },
  {
    id: 2,
    question:
      "Which coordinating conjunction is used in the sentence: 'I wanted to play outside, but it was raining'?",
    options: ["and", "but", "nor", "yet"],
    correct: "but",
  },
  {
    id: 3,
    question: "What type of clause is: 'since the movie was too long'?",
    options: [
      "Independent clause",
      "Adjective clause",
      "Dependent adverb clause",
      "Noun clause",
    ],
    correct: "Dependent adverb clause",
  },
  {
    id: 4,
    question:
      "What is the correct subject-verb agreement for the sentence: 'The team ____ practicing daily.'?",
    options: ["is", "are", "were", "have been"],
    correct: "is",
  },
  {
    id: 5,
    question:
      "Which punctuation mark should be used to join two independent clauses?",
    options: ["Comma", "Period", "Semicolon", "Colon"],
    correct: "Semicolon",
  },
  {
    id: 6,
    question: "What is the correct use of a colon?",
    options: [
      "He said: 'Let's go to the park!'",
      "Bring the following items: a pen, a notebook, and a ruler.",
      "She loves many colors; such as blue, red, and green.",
      "The meeting is at: 3 PM.",
    ],
    correct: "Bring the following items: a pen, a notebook, and a ruler.",
  },
  {
    id: 7,
    question: "What does an apostrophe indicate in a contraction?",
    options: [
      "A missing punctuation mark",
      "The plural form of a noun",
      "Letters have been left out",
      "A question is being asked",
    ],
    correct: "Letters have been left out",
  },
  {
    id: 8,
    question: "Which sentence correctly uses quotation marks?",
    options: [
      "He said, I will be late for dinner.",
      "She asked, 'Where are you going?'",
      "The title of the book is 'To Kill A Mockingbird.",
      "'What time is it', asked John.",
    ],
    correct: "She asked, 'Where are you going?'",
  },
  {
    id: 9,
    question: "What is the function of a semicolon?",
    options: [
      "To replace a period in declarative sentences",
      "To join two independent clauses without a conjunction",
      "To introduce a list or explanation",
      "To indicate possession",
    ],
    correct: "To join two independent clauses without a conjunction",
  },
  {
    id: 10,
    question:
      "Insert the correct punctuation: My brother who is very tall plays basketball.",
    options: [
      "My brother, who is very tall, plays basketball.",
      "My brother who is very tall, plays basketball.",
      "My brother, who is very tall plays basketball.",
      "My brother who is very tall plays, basketball.",
    ],
    correct: "My brother, who is very tall, plays basketball.",
  },
  {
    id: 11,
    question: "Choose the correctly punctuated sentence:",
    options: [
      "I enjoy cooking my family and my dog.",
      "I enjoy cooking, my family, and my dog.",
      "I enjoy, cooking my family and, my dog.",
      "I enjoy cooking my family, and my dog.",
    ],
    correct: "I enjoy cooking, my family, and my dog.",
  },
  {
    id: 12,
    question: "Which of the following sentences is correct?",
    options: [
      "The dog that barked loudly is mine.",
      "The dog that barked loudly, is mine.",
      "The dog, that barked loudly, is mine.",
      "The dog, that barked loudly is mine.",
    ],
    correct: "The dog that barked loudly is mine.",
  },
  {
    id: 13,
    question: "Choose the correct sentence:",
    options: [
      "It’s raining outside, isn’t it?",
      "It’s raining outside isn’t it?",
      "Its raining outside, isn’t it?",
      "It’s raining outside isn’t, it?",
    ],
    correct: "It’s raining outside, isn’t it?",
  },
  {
    id: 14,
    question: "Identify the sentence with correct grammar:",
    options: [
      "She don’t like apples.",
      "She doesn’t likes apples.",
      "She doesn’t like apples.",
      "She don’t likes apples.",
    ],
    correct: "She doesn’t like apples.",
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
            lesson_id: 12,
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
  scoreContainer.classList.add("hide");
  initial();
};
