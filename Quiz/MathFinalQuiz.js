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
    question: "What is a trinomial?",
    options: [
      "An expression with one term",
      "An expression with two terms",
      "An expression with three terms",
      "None of the above",
    ],
    correct: "An expression with three terms",
  },
  {
    id: 11,
    question: "Factorize: x^2 + 5x + 6.",
    options: [
      "(x + 2)(x + 3)",
      "(x + 1)(x + 6)",
      "(x − 2)(x − 3)",
      "(x − 6)(x − 9)",
    ],
    correct: "(x + 2)(x + 3)",
  },
  {
    id: 12,
    question: "What is a monomial?",
    options: [
      "An expression with one term",
      "An expression with two terms",
      "An expression with three terms",
      "An expression with no terms",
    ],
    correct: "An expression with one term",
  },
  {
    id: 13,
    question: "What is the degree of a polynomial?",
    options: [
      "The highest power of the variable",
      "The number of terms in the polynomial",
      "The coefficient of the leading term",
      "All of the above",
    ],
    correct: "The highest power of the variable",
  },
  {
    id: 14,
    question: "What does it mean to factorize an expression?",
    options: [
      "To break it into simpler terms or factors",
      "To add it to another expression",
      "To simplify it by division",
      "All of the above",
    ],
    correct: "To break it into simpler terms or factors",
  },
  {
    id: 15,
    question: "What is the product of (x - 2)(x + 2)?",
    options: ["x^8 - 4", "x^2 - 4", "x^2 + 4", "x^2 - 2"],
    correct: "x^2 - 4",
  },
  {
    id: 16,
    question: "What is a binomial?",
    options: [
      "An expression with one term",
      "An expression with two terms",
      "An expression with three terms",
      "An expression with one-hundred terms",
    ],
    correct: "An expression with two terms",
  },
  {
    id: 17,
    question: "What is the base in the expression 6^4?",
    options: ["6", "4", "24", "69"],
    correct: "6",
  },
  {
    id: 18,
    question: "If 5x + 2y = 20 and y = 2, find x.",
    options: ["x = 2", "x = 20", "x = 3", "x = 4"],
    correct: "x = 3",
  },
  {
    id: 19,
    question: "What is the exponent in the expression 2x^3?",
    options: ["2", "3", "6", "420"],
    correct: "3",
  },
  {
    id: 20,
    question:
      "Which of the following layers is located directly above the mantle?",
    options: [
      "The inner core",
      "The outer core",
      "The crust",
      "The asthenosphere",
    ],
    correct: "The crust",
  },
  {
    id: 21,
    question:
      "What is the term for the study of shapes, sizes, and properties of space?",
    options: ["Algebra", "Geometry", "Trigonometry", "Calculus"],
    correct: "Geometry",
  },
  {
    id: 22,
    question: "What is a polygon with four sides called?",
    options: ["Triangle", "Square", "Rectangle", "Quadrilateral"],
    correct: "Quadrilateral",
  },
  {
    id: 23,
    question: "Which of the following is not a type of angle?",
    options: ["Acute Angle", "Obtuse Angle", "Reflex Angle", "Cubic Angle"],
    correct: "Cubic Angle",
  },
  {
    id: 24,
    question: "What is a figure formed by two rays sharing a common endpoint?",
    options: ["Line", "Angle", "Point", "Ray"],
    correct: "Angle",
  },
  {
    id: 25,
    question:
      "What is the perimeter of an equilateral triangle with side lengths of 8 cm?",
    options: ["24 cm", "16 cm", "32 cm", "28 cm"],
    correct: "24 cm",
  },
  {
    id: 26,
    question: "Which of the following is a three-dimensional figure?",
    options: ["Square", "Circle", "Triangle", "Cube"],
    correct: "Cube",
  },
  {
    id: 27,
    question:
      "What do we call two figures that have the same shape but different sizes?",
    options: ["Similar", "Congruent", "Symmetric", "Parallel"],
    correct: "Similar",
  },
  {
    id: 28,
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
    id: 29,
    question:
      "What is the perimeter of a rectangle with a length of 6 cm and a width of 4 cm?",
    options: ["24 cm", "20 cm", "16 cm", "12 cm"],
    correct: "20 cm",
  },
  {
    id: 30,
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
    id: 31,
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
    id: 32,
    question: "Which of the following is the range of probability?",
    options: ["0 to 1", "-1 to 1", "0 to 100", "-100 to 100"],
    correct: "0 to 1",
  },
  {
    id: 33,
    question: "If an event is impossible, what is its probability?",
    options: ["1", "0", "1/2", "It depends on the event"],
    correct: "0",
  },
  {
    id: 34,
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
    id: 35,
    question: "What is the probability of a certain event occurring?",
    options: ["0", "1", "1/2", "It depends on the event"],
    correct: "1",
  },
  {
    id: 36,
    question:
      "What do you call the set of all possible outcomes in an experiment?",
    options: ["Sample space", "Event", "Subset", "Complement"],
    correct: "Sample space",
  },
  // Problem-Solving Questions
  {
    id: 37,
    question:
      "A jar contains 6 yellow, 4 red, and 10 green marbles. If one marble is picked at random, what is the probability of it being yellow?",
    options: ["3/10", "1/5", "3/20", "1/2"],
    correct: "3/10",
  },
  {
    id: 38,
    question:
      "A coin is tossed three times. What is the probability of getting exactly two heads?",
    options: ["1/4", "1/2", "3/8", "3/4"],
    correct: "3/8",
  },
  {
    id: 39,
    question:
      "A bag contains 4 white balls, 3 black balls, and 2 red balls. Two balls are drawn at random. What is the probability that both are black?",
    options: ["1/12", "1/24", "3/40", "3/42"],
    correct: "1/12",
  },
  {
    id: 40,
    question:
      "In a survey, 60% of participants like chocolate, 30% like vanilla, and 10% like both. If a participant is chosen at random, what is the probability that they like only chocolate?",
    options: ["0.4", "0.5", "0.6", "0.3"],
    correct: "0.5",
  },
  {
    id: 41,
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
    id: 42,
    question: "What is the measure of a straight angle?",
    options: ["a) 90°", "b) 180°", "c) 270°", "d) 360°"],
    correct: "b) 180°",
  },
  {
    id: 43,
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
    id: 44,
    question: "Convert 45° into radians.",
    options: ["a) π/4", "b) π/2", "c) π/6", "d) 3π/4"],
    correct: "a) π/4",
  },
  {
    id: 45,
    question:
      "Which trigonometric function represents the ratio of opposite to hypotenuse in a right triangle?",
    options: ["a) Sine", "b) Cosine", "c) Tangent", "d) Secant"],
    correct: "a) Sine",
  },
  {
    id: 46,
    question:
      "Solve: If the hypotenuse of a right triangle is 10 and one side is 6, what is the length of the other side?",
    options: ["a) 8", "b) 7", "c) 4", "d) 5"],
    correct: "d) 8",
  },
  {
    id: 47,
    question: "What is the radian measure of 360°?",
    options: ["a) π", "b) 2π", "c) 3π", "d) π/2"],
    correct: "b) 2π",
  },
  {
    id: 48,
    question: "What is the sine of 30°?",
    options: ["a) 1/2", "b) √3/2", "c) √2/2", "d) 1"],
    correct: "a) 1/2",
  },
  {
    id: 49,
    question: "If cos(θ) = 4/5 in a right triangle, what is sin(θ)?",
    options: ["a) 3/5", "b) 4/5", "c) 5/4", "d) √41/5"],
    correct: "a) 3/5",
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
            subject_id: 2,
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
