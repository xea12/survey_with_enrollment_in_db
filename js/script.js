const setStep = (step) => {
  document
    .querySelectorAll(".step-content")
    .forEach((element) => (element.style.display = "none"));
  //document.querySelector("[data-step='" + step + "']").style.display = "block";
  document.querySelectorAll(".steps .step").forEach((element, index) => {
    index < step - 1
      ? element.classList.add("complete")
      : element.classList.remove("complete");
    index == step - 1
      ? element.classList.add("current")
      : element.classList.remove("current");
    if (step === 2) {
      document.getElementById("page-info").classList.add("hidden");
      document.getElementById("steps2").classList.add("hidden");
      element.classList.add("hidden");
    }
  });
};
document.querySelectorAll("[data-set-step]").forEach((element) => {
  element.onclick = (event) => {
    event.preventDefault();
    setStep(parseInt(element.dataset.setStep));
  };
});
/*
const exit = document.querySelector(".overlay");
const survey = document.querySelector("#survey-window");
const overlay = document.querySelector("#overlay");
exit.addEventListener("click", function () {
  survey.classList.add("survey-display-none");
  overlay.classList.add("survey-display-none");
});
*/

window.addEventListener("DOMContentLoaded", function () {
  var stepContent = document.querySelectorAll(".asks-step");
  var totalPages = stepContent.length;
  var currentPage = 1;

  function updatePageInfo() {
    var pageInfo = document.getElementById("page-info");
    pageInfo.textContent = "Strona " + currentPage + " / " + totalPages;
  }

  function showPage(page) {
    for (var i = 0; i < stepContent.length; i++) {
      stepContent[i].classList.remove("current");
    }
    stepContent[page - 1].classList.add("current");
    currentPage = page;
    updatePageInfo();
  }

  updatePageInfo();

  var nextBtns = document.querySelectorAll("[data-set-step]");
  nextBtns.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      var nextPage = this.getAttribute("data-set-step");
      showPage(nextPage);
    });
  });
});
