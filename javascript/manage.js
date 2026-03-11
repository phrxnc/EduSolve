document.addEventListener("DOMContentLoaded", function () {
  const manageLink = document.querySelector(".Course-Manage a");
  const coursesLink = document.querySelector(".courses a");
  const form = document.querySelector("form");
  const options = document.querySelector(".options");
  const subs = document.querySelector(".subs");
  const supp = document.querySelector(".support a");
  const supportSection = document.querySelector(".support-boxes");
  const span = document.querySelector("span");
  const rightSidebar = document.querySelector(".right-sidebar");
  const CourseManage = document.querySelector(".Course-Manage");
  const studcontainer = document.querySelector(".students-container");
  const studList = document.getElementById("student-list-section");
  const studLink = document.querySelector(".students a");
  const settingsLink = document.querySelector(".settings a");
  const settingsContainer = document.querySelector(".settings-container");
  const settingsForm = document.querySelector(".settings-container form");

  const userRole = "superadmin";
  if (userRole !== "superadmin") {
    if (CourseManage) CourseManage.style.display = "none";
    if (studLink) studLink.style.display = "none";

    if (manageLink) {
      manageLink.removeEventListener("click", manageLinkClickHandler);
    }

    if (studLink) {
      studLink.removeEventListener("click", studLinkClickHandler);
    }

    if (manageLink)
      manageLink.addEventListener("click", function (e) {
        e.preventDefault();
        alert("This section is only available to Admins.");
      });

    if (studLink)
      studLink.addEventListener("click", function (e) {
        e.preventDefault();
        alert("This section is only available to Admins.");
      });
  }

  const accountSettingsLink = document.getElementById("account-settings-link");

  if (accountSettingsLink) {
    accountSettingsLink.addEventListener("click", function (e) {
      e.preventDefault();
      // Hide the support section
      if (supportSection) {
        span.style.display = "none";
        supportSection.style.display = "none";
        supportSection.style.display = "none";
      }
      // Display the settings container
      if (settingsContainer) {
        settingsContainer.style.display = "block";
      }
    });
  }

  coursesLink.addEventListener("click", function (e) {
    e.preventDefault();
    form.style.display = "none";
    options.style.display = "block";
    subs.style.display = "flex";
    span.style.display = "none";
    supportSection.style.display = "none";
    rightSidebar.style.display = "flex";
    studcontainer.style.display = "none";
    if (userRole === "superadmin" && CourseManage) {
      CourseManage.style.display = "flex";
    }
    studList.style.display = "none";
    settingsContainer.style.display = "none";
  });

  supp.addEventListener("click", function (e) {
    e.preventDefault();
    form.style.display = "none";
    options.style.display = "none";
    subs.style.display = "none";
    if (CourseManage) CourseManage.style.display = "none";
    rightSidebar.style.display = "none";
    span.style.display = "block";
    span.style.width = "800px";
    supportSection.style.display = "flex";
    studcontainer.style.display = "none";
    studList.style.display = "none";
    settingsContainer.style.display = "none";
  });

  settingsLink.addEventListener("click", function (e) {
    e.preventDefault();
    options.style.display = "none";
    subs.style.display = "none";
    form.style.display = "none";
    span.style.display = "none";
    supportSection.style.display = "none";
    rightSidebar.style.display = "none";
    studcontainer.style.display = "none";
    if (CourseManage) CourseManage.style.display = "none";
    studList.style.display = "none";
    settingsContainer.style.display = "block";
    settingsForm.style.display = "block";
  });

  if (userRole === "superadmin" && manageLink) {
    manageLink.addEventListener("click", function (e) {
      e.preventDefault();
      options.style.display = "none";
      subs.style.display = "none";
      form.style.display = "block";
      span.style.display = "none";
      supportSection.style.display = "none";
      rightSidebar.style.display = "none";
      studcontainer.style.display = "none";
      CourseManage.style.display = "flex";
      studList.style.display = "none";
      settingsContainer.style.display = "none";
    });
  }

  if (userRole === "superadmin" && studLink) {
    studLink.addEventListener("click", function (e) {
      e.preventDefault();
      options.style.display = "none";
      subs.style.display = "none";
      if (CourseManage) CourseManage.style.display = "none";
      rightSidebar.style.display = "none";
      studcontainer.style.width = "1000px";
      studList.style.display = "block";
      span.style.display = "none";
      form.style.display = "none";
      settingsContainer.style.display = "none";
      displayStudents(students);
    });
  }
});

// document.addEventListener("DOMContentLoaded", function () {
//   const manageLink = document.querySelector(".Course-Manage a");
//   const coursesLink = document.querySelector(".courses a");
//   const form = document.querySelector("form");
//   const options = document.querySelector(".options");
//   const subs = document.querySelector(".subs");
//   const supp = document.querySelector(".support a");
//   const supportSection = document.querySelector(".support-boxes");
//   const span = document.querySelector("span");
//   const rightSidebar = document.querySelector(".right-sidebar");
//   const CourseManage = document.querySelector(".Course-Manage");
//   const studcontainer = document.querySelector(".students-container");
//   const studList = document.getElementById("student-list-section");
//   const studLink = document.querySelector(".students a");
//   const settingsLink = document.querySelector(".settings a");
//   const settingsContainer = document.querySelector(".settings-container");
//   const settingsForm = document.querySelector(".settings-container form");

//   manageLink.addEventListener("click", function (e) {
//     e.preventDefault();
//     options.style.display = "none";
//     subs.style.display = "none";
//     form.style.display = "block";
//     span.style.display = "none";
//     supportSection.style.display = "none";
//     rightSidebar.style.display = "none";
//     studcontainer.style.display = "none";
//     CourseManage.style.display = "flex";
//     studList.style.display = "none";
//     settingsContainer.style.display = "none";
//   });

//   coursesLink.addEventListener("click", function (e) {
//     e.preventDefault();
//     form.style.display = "none";
//     options.style.display = "block";
//     subs.style.display = "flex";
//     span.style.display = "none";
//     supportSection.style.display = "none";
//     rightSidebar.style.display = "flex";
//     studcontainer.style.display = "none";
//     CourseManage.style.display = "flex";
//     studList.style.display = "none";
//     settingsContainer.style.display = "none";
//   });

//   supp.addEventListener("click", function (e) {
//     e.preventDefault();
//     form.style.display = "none";
//     options.style.display = "none";
//     subs.style.display = "none";
//     CourseManage.style.display = "none";
//     rightSidebar.style.display = "none";
//     span.style.display = "block";
//     span.style.width = "800px";
//     supportSection.style.display = "flex";
//     studcontainer.style.display = "none";
//     studList.style.display = "none";
//     settingsContainer.style.display = "none";
//   });

//   studLink.addEventListener("click", function (e) {
//     e.preventDefault();
//     options.style.display = "none";
//     subs.style.display = "none";
//     CourseManage.style.display = "none";
//     rightSidebar.style.display = "none";
//     studcontainer.style.width = "1000px";
//     studList.style.display = "block";
//     span.style.display = "none";
//     form.style.display = "none";
//     settingsContainer.style.display = "none";
//     displayStudents(students);
//   });

//   settingsLink.addEventListener("click", function (e) {
//     e.preventDefault();
//     options.style.display = "none";
//     subs.style.display = "none";
//     form.style.display = "none";
//     span.style.display = "none";
//     supportSection.style.display = "none";
//     rightSidebar.style.display = "none";
//     studcontainer.style.display = "none";
//     CourseManage.style.display = "none";
//     studList.style.display = "none";
//     settingsContainer.style.display = "block";
//     settingsForm.style.display = "block"; // Fixed: Corrected the settingsForm style assignment
//   });
// });
