const loginBtn = document.querySelector(".Log-in");
const loginOverlay = document.querySelector("#Login-overlay");
const loginCloseBtn = document.querySelector("#Loginclose");
const registerLink = document.querySelector("#Login-overlay a");

if (typeof hasError !== "undefined" && hasError) {
  loginOverlay.style.display = "flex";
}

loginBtn.addEventListener("click", () => {
  loginOverlay.style.display = "flex";
});

loginCloseBtn.addEventListener("click", () => {
  loginOverlay.style.display = "none";
});

loginOverlay.addEventListener("click", (e) => {
  if (e.target === loginOverlay) {
    loginOverlay.style.display = "none";
  }
});

registerLink.addEventListener("click", (e) => {
  e.preventDefault();
  loginOverlay.style.display = "none";
  document.querySelector("#Signup-overlay").style.display = "flex";
});
