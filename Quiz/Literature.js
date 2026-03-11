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
    question: "What is the primary focus of literature as an art form?",
    options: [
      "Informative and technical writing",
      "Artistic merit and human expression",
      "Scholarly and journalistic work",
      "Scientific research and exposition",
    ],
    correct: "Artistic merit and human expression",
  },
  {
    id: 1,
    question: "What theme is explored in Noli Me Tangere by Dr. José Rizal?",
    options: [
      "a) Love and sacrifice",
      "b) Colonialism and social injustices",
      "c) Reflection on life choices",
      "d) Friendship and loyalty",
    ],
    correct: "b) Colonialism and social injustices",
  },
  {
    id: 2,
    question: "Which literary work focuses on star-crossed lovers?",
    options: [
      "a) Romeo and Juliet",
      "b) To Kill a Mockingbird",
      "c) Walang Sugat",
      "d) Ang Pamana",
    ],
    correct: "a) Romeo and Juliet",
  },
  {
    id: 3,
    question: "What does the poem Ang Pamana celebrate?",
    options: [
      "a) Justice",
      "b) The beauty of nature",
      "c) A mother’s sacrifices",
      "d) Patriotism",
    ],
    correct: "c) A mother’s sacrifices",
  },
  {
    id: 4,
    question: "Which of the following is an example of drama?",
    options: [
      "a) Noli Me Tangere",
      "b) Walang Sugat",
      "c) To Kill a Mockingbird",
      "d) The Road Not Taken",
    ],
    correct: "b) Walang Sugat",
  },
  {
    id: 5,
    question: "What is the primary theme of To Kill a Mockingbird?",
    options: [
      "a) Friendship",
      "b) Justice and racism",
      "c) Betrayal",
      "d) Patriotism",
    ],
    correct: "b) Justice and racism",
  },
  {
    id: 6,
    question: "What does the 'road' symbolize in The Road Not Taken?",
    options: ["a) Freedom", "b) Choices in life", "c) Success", "d) Nature"],
    correct: "b) Choices in life",
  },
  {
    id: 7,
    question: "What type of society does Noli Me Tangere critique?",
    options: [
      "a) Revolutionary society",
      "b) Colonial society",
      "c) Democratic society",
      "d) Feudal society",
    ],
    correct: "b) Colonial society",
  },
  {
    id: 8,
    question:
      "Which Filipino drama portrays love during the Philippine revolution?",
    options: [
      "a) Noli Me Tangere",
      "b) Ang Pamana",
      "c) Walang Sugat",
      "d) None of the above",
    ],
    correct: "c) Walang Sugat",
  },
  {
    id: 9,
    question: "In Romeo and Juliet, what leads to the tragedy?",
    options: [
      "a) Miscommunication and family feud",
      "b) War and politics",
      "c) Natural disasters",
      "d) Poverty",
    ],
    correct: "a) Miscommunication and family feud",
  },
  {
    id: 10,
    question: "What distinguishes poetry from other literary forms?",
    options: [
      "It focuses on narrative prose",
      "It emphasizes aesthetic and rhythmic qualities",
      "It avoids any artistic devices",
      "It primarily involves characters and setting",
    ],
    correct: "It emphasizes aesthetic and rhythmic qualities",
  },
  {
    id: 11,
    question: "Which of the following is an example of a poetic device?",
    options: [
      "Character development",
      "Rhythmic beats and meter",
      "Stage directions",
      "Complex plot",
    ],
    correct: "Rhythmic beats and meter",
  },
  {
    id: 12,
    question: "What is a distinguishing feature of drama as a literary genre?",
    options: [
      "It is always written in verse",
      "It is primarily intended for performance",
      "It excludes dialogue and characters",
      "It focuses only on written scripts",
    ],
    correct: "It is primarily intended for performance",
  },
  {
    id: 13,
    question: "Which poetic device uses words that imitate natural sounds?",
    options: ["Onomatopoeia", "Alliteration", "Euphony", "Cacophony"],
    correct: "Onomatopoeia",
  },
  {
    id: 14,
    question: "Which of the following is NOT a common genre of novels?",
    options: ["Historical", "Psychological", "Prose poetry", "Gothic"],
    correct: "Prose poetry",
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
            lesson_id: 15,
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
