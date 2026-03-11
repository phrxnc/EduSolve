document.addEventListener("DOMContentLoaded", () => {
  const subjects = document.querySelectorAll(".subject");
  const filterLinks = document.querySelectorAll(".filter-link");
  const modulesContainers = document.querySelectorAll(".modules");
  const progressContainer = document.querySelector(".progress-container");
  const progressBarContainer = document.querySelector(
    ".progress-bar-container"
  );
  const progressTitle = document.querySelector(".progress-title");
  const settingsContainer = document.querySelector(".settings-container");
  const coursesButton = document.querySelector(".courses a");
  const rightSidebar = document.querySelector(".right-sidebar");

  function filterSubjects(filter) {
    resetSubjects();

    // Show the sidebar only when the "all" filter is selected
    if (rightSidebar) {
      if (filter === "all") {
        rightSidebar.style.display = "block"; // Show the sidebar
      } else {
        rightSidebar.style.display = "none"; // Hide the sidebar
      }
    }

    subjects.forEach((subject) => {
      if (filter === "all") {
        subject.style.display = "flex";
      } else if (filter === "pending") {
        if (subject.classList.contains("locked")) {
          subject.style.display = "flex";
        } else {
          subject.style.display = "none";
        }
      } else if (filter === "current") {
        if (
          !subject.classList.contains("locked") &&
          !subject.classList.contains("completed")
        ) {
          subject.style.display = "flex";
        } else {
          subject.style.display = "none";
        }
      } else if (filter === "completed") {
        if (subject.classList.contains("completed")) {
          subject.style.display = "flex";
        } else {
          subject.style.display = "none";
        }
      }
    });
  }

  function resetSubjects() {
    subjects.forEach((subject) => (subject.style.display = "flex"));
    modulesContainers.forEach((modules) => (modules.style.display = "none"));
    if (progressContainer) progressContainer.style.display = "block";
    if (progressBarContainer) progressBarContainer.style.display = "block";
    if (progressTitle) progressTitle.style.display = "block";
    if (settingsContainer) settingsContainer.style.display = "none";
  }

  filterLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      filterLinks.forEach((link) => link.classList.remove("active"));
      e.target.classList.add("active");

      const filter = e.target.dataset.filter;
      filterSubjects(filter);
    });
  });

  filterSubjects("all");

  subjects.forEach((subject) => {
    subject.addEventListener("click", (e) => {
      e.stopPropagation();

      resetSubjects();

      subjects.forEach((sub) => {
        if (sub !== subject) {
          sub.style.display = "none";
        }
      });

      const subjectModules = subject.nextElementSibling;
      if (subjectModules && subjectModules.classList.contains("modules")) {
        subjectModules.style.display = "block";
      }

      if (progressContainer) progressContainer.style.display = "none";
      if (progressBarContainer) progressBarContainer.style.display = "none";
      if (progressTitle) progressTitle.style.display = "none";
    });
  });

  if (coursesButton) {
    coursesButton.addEventListener("click", (e) => {
      e.preventDefault();
      resetSubjects();
    });
  }
});
