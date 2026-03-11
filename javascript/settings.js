// document.addEventListener("DOMContentLoaded", function () {
//   const settingsLink = document.querySelector(".settings a");
//   const settingsContainer = document.querySelector(".settings-container");
//   const options = document.querySelector(".options");
//   const subs = document.querySelector(".subs");
//   const form = document.querySelector("form");
//   const span = document.querySelector("span");
//   const supportSection = document.querySelector(".support-boxes");
//   const rightSidebar = document.querySelector(".right-sidebar");
//   const CourseManage = document.querySelector(".Course-Manage");
//   const studcontainer = document.querySelector(".students-container");
//   const studList = document.getElementById("student-list-section");
//   const studLink = document.querySelector(".students a");

//   settingsLink.addEventListener("click", function (e) {
//     e.preventDefault(); // Prevent default anchor link behavior

//     // Hide all other sections
//     options.style.display = "none";
//     subs.style.display = "none";
//     form.style.display = "none";
//     span.style.display = "none";
//     supportSection.style.display = "none";
//     rightSidebar.style.display = "none";
//     studcontainer.style.display = "none";
//     CourseManage.style.display = "none";
//     studList.style.display = "none";

//     // Show settings container
//     settingsContainer.style.display = "block";
//   });

//   // Handle the profile form submission
//   const profileForm = document.getElementById("profile-form");
//   if (profileForm) {
//     profileForm.addEventListener("submit", function (e) {
//       e.preventDefault();
//       // Handle form submission (e.g., save the changes)
//       console.log("Profile form submitted.");
//       // Add any further form handling logic here
//     });
//   }
// });
