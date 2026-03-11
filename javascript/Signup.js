document.addEventListener("DOMContentLoaded", function () {
  const signupBtn = document.querySelector(".Sign-up");
  const signupOverlay = document.querySelector("#Signup-overlay");
  const signupCloseBtn = document.querySelector("#Signupclose");
  const loginLink = document.querySelector("#Signup-overlay a");

  signupBtn.addEventListener("click", () => {
    signupOverlay.style.display = "flex";
  });

  document.querySelector(".courses").addEventListener("click", function () {
    signupOverlay.style.display = "flex";
  });

  document.querySelector(".students").addEventListener("click", function () {
    signupOverlay.style.display = "flex";
  });

  document.querySelector(".support").addEventListener("click", function () {
    signupOverlay.style.display = "flex";
  });

  document.querySelector("#get-started").addEventListener("click", function () {
    signupOverlay.style.display = "flex";
  });

  signupCloseBtn.addEventListener("click", () => {
    signupOverlay.style.display = "none";
  });

  signupOverlay.addEventListener("click", (e) => {
    if (e.target === signupOverlay) {
      signupOverlay.style.display = "none";
    }
  });

  loginLink.addEventListener("click", (e) => {
    e.preventDefault();
    signupOverlay.style.display = "none";
    document.querySelector("#Login-overlay").style.display = "flex";
  });
});
