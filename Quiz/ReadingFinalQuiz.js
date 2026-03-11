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
    question: "Identify the synonym of 'benevolent':",
    options: ["Generous", "Selfish", "Cruel", "Angry"],
    correct: "Generous",
  },
  {
    id: 1,
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
    id: 2,
    question: "Choose the antonym of 'brave':",
    options: ["Bold", "Fearful", "Heroic", "Courageous"],
    correct: "Fearful",
  },
  {
    id: 3,
    question: "Which word is closest in meaning to 'melancholy'?",
    options: ["Joyful", "Sad", "Angry", "Hopeful"],
    correct: "Sad",
  },
  {
    id: 4,
    question: "The word 'meticulous' means:",
    options: ["Careless", "Precise", "Lazy", "Quick"],
    correct: "Precise",
  },
  {
    id: 5,
    question: "Which word is a synonym of 'fragile'?",
    options: ["Strong", "Shaky", "Delicate", "Durable"],
    correct: "Delicate",
  },
  {
    id: 6,
    question: "What does 'sophisticated' most closely mean?",
    options: ["Simple", "Elegant", "Basic", "Clumsy"],
    correct: "Elegant",
  },
  {
    id: 7,
    question: "What is the synonym of 'obvious'?",
    options: ["Hidden", "Clear", "Complex", "Uncertain"],
    correct: "Clear",
  },
  {
    id: 8,
    question: "Choose the word that is most similar in meaning to 'elated':",
    options: ["Sad", "Excited", "Indifferent", "Calm"],
    correct: "Excited",
  },
  {
    id: 9,
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
    id: 10,
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
    id: 11,
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
    id: 12,
    question: "Which is NOT one of the author's purposes for writing?",
    options: ["To entertain", "To confuse", "To inform", "To persuade"],
    correct: "To confuse",
  },
  {
    id: 13,
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
    id: 14,
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
    id: 15,
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
    id: 16,
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
    id: 17,
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
    id: 18,
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
    id: 19,
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
    id: 20,
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
    id: 21,
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
    id: 22,
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
    id: 23,
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
    id: 24,
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
    id: 25,
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
    id: 26,
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
    id: 27,
    question: "Name a type of irony.",
    options: ["Dramatic irony.", "Hyperbole.", "Allusion.", "Metaphor."],
    correct: "Dramatic irony.",
  },
  {
    id: 28,
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
    id: 29,
    question: "What is an example of dramatic irony?",
    options: [
      "The audience knows a character is in danger, but the character doesn't.",
      "A character exaggerates their feelings.",
      "A character uses sarcasm.",
      "A character explains their thoughts directly.",
    ],
    correct:
      "The audience knows a character is in danger, but the character doesn't.",
  },
  {
    id: 30,
    question: "What is the purpose of flashback?",
    options: [
      "To provide a glimpse into past events.",
      "To describe the setting.",
      "To predict the future.",
      "To build suspense.",
    ],
    correct: "To provide a glimpse into past events.",
  },
  {
    id: 31,
    question: "What type of character is usually the protagonist?",
    options: [
      "The main character.",
      "A minor character.",
      "A villain.",
      "A narrator.",
    ],
    correct: "The main character.",
  },
  {
    id: 32,
    question: "Which character is an antagonist?",
    options: [
      "A character who opposes the protagonist.",
      "A character who helps the protagonist.",
      "A character with no major role.",
      "A narrator in the story.",
    ],
    correct: "A character who opposes the protagonist.",
  },
  {
    id: 33,
    question: "What is a dynamic character?",
    options: [
      "A character who changes over time.",
      "A character who stays the same.",
      "A character who is minor.",
      "A character who is static.",
    ],
    correct: "A character who changes over time.",
  },
  {
    id: 34,
    question: "What defines a round character?",
    options: [
      "A complex character with multiple traits.",
      "A character with a single defining trait.",
      "A character who does not change.",
      "A character who remains unknown.",
    ],
    correct: "A complex character with multiple traits.",
  },
  {
    id: 35,
    question: "What is a flat character?",
    options: [
      "A character with one dominant trait.",
      "A character who experiences growth.",
      "A character who is complex.",
      "A character who opposes the protagonist.",
    ],
    correct: "A character with one dominant trait.",
  },
  {
    id: 36,
    question: "What is an example of a setting?",
    options: [
      "The time and place where a story takes place.",
      "The main character's name.",
      "The problem in the story.",
      "The sequence of events in the plot.",
    ],
    correct: "The time and place where a story takes place.",
  },
  {
    id: 37,
    question: "What is conflict in a story?",
    options: [
      "A struggle between opposing forces.",
      "The resolution of a problem.",
      "The conclusion of the story.",
      "The setting of the story.",
    ],
    correct: "A struggle between opposing forces.",
  },
  {
    id: 38,
    question: "What is a theme in a story?",
    options: [
      "The central idea or underlying message.",
      "The characters' names.",
      "The events in the plot.",
      "The dialogue spoken by the characters.",
    ],
    correct: "The central idea or underlying message.",
  },
  {
    id: 39,
    question: "What is tone in literature?",
    options: [
      "The author's attitude toward the subject.",
      "The characters' emotions.",
      "The events in the plot.",
      "The setting of the story.",
    ],
    correct: "The author's attitude toward the subject.",
  },
  {
    id: 40,
    question: "What is mood in literature?",
    options: [
      "The overall feeling or atmosphere of a story.",
      "The moral lesson in the story.",
      "The time and place of the story.",
      "The personality of the protagonist.",
    ],
    correct: "The overall feeling or atmosphere of a story.",
  },
  {
    id: 41,
    question: "What is a symbol in literature?",
    options: [
      "An object, person, or event that represents something beyond itself.",
      "The main character in the story.",
      "The sequence of events in the plot.",
      "The setting of the story.",
    ],
    correct:
      "An object, person, or event that represents something beyond itself.",
  },
  {
    id: 42,
    question: "What is allegory?",
    options: [
      "A narrative in which characters or events represent abstract ideas or moral qualities.",
      "A genre of comedy.",
      "A sequence of random events.",
      "A style of writing that is very detailed.",
    ],
    correct:
      "A narrative in which characters or events represent abstract ideas or moral qualities.",
  },
  {
    id: 43,
    question: "What is the purpose of satire?",
    options: [
      "To criticize or mock something in society.",
      "To describe a perfect world.",
      "To entertain with humorous tales.",
      "To provide a clear explanation.",
    ],
    correct: "To criticize or mock something in society.",
  },
  {
    id: 44,
    question: "What is a paradox?",
    options: [
      "A statement that contradicts itself but may contain truth.",
      "A repetitive sound.",
      "A reference to another work.",
      "A character's inner struggle.",
    ],
    correct: "A statement that contradicts itself but may contain truth.",
  },
  {
    id: 45,
    question: "What is a cliché?",
    options: [
      "An overused phrase or idea.",
      "A new and original idea.",
      "A unique character trait.",
      "An unexpected plot twist.",
    ],
    correct: "An overused phrase or idea.",
  },
  {
    id: 46,
    question: "What is the climax of a story?",
    options: [
      "The turning point or most intense moment.",
      "The introduction of characters.",
      "The resolution of the plot.",
      "The setting of the story.",
    ],
    correct: "The turning point or most intense moment.",
  },
  {
    id: 47,
    question: "What is the resolution in a story?",
    options: [
      "The conclusion where the problem is solved.",
      "The beginning of the story.",
      "The introduction of the characters.",
      "The series of conflicts leading to the climax.",
    ],
    correct: "The conclusion where the problem is solved.",
  },
  {
    id: 48,
    question: "What is an epilogue?",
    options: [
      "A short section at the end of a story that provides closure.",
      "A prologue at the beginning of the story.",
      "The introduction of the main conflict.",
      "The description of the setting.",
    ],
    correct: "A short section at the end of a story that provides closure.",
  },
  {
    id: 49,
    question: "What is a motif in literature?",
    options: [
      "A recurring element that has symbolic significance.",
      "The main plot of the story.",
      "The title of the story.",
      "A specific location in the story.",
    ],
    correct: "A recurring element that has symbolic significance.",
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

        fetch("../functions/save_scores.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            score: scoreCount,
            subject_id: 3,
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
