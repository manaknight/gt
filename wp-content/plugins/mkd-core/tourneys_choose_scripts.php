<script>
    const contentOne = document.getElementById("content-one");
const contentTwo = document.getElementById("content-two");
const contentArrows = document.querySelectorAll(".arrow-link");
const chooseContent = document.querySelectorAll(".choose-content");

// modal
const alertWrapper = document.getElementById("choose-alert-wrapper");
const alertContent = document.querySelectorAll(".alert-content");
const alertClose = document.getElementById("alert-close-icon");
const yesAlert = document.getElementById("yes-alert-btn");
const noAlert = document.getElementById("no-alert-btn");
const okAlert = document.getElementById("ok-alert-btn");

contentArrows.forEach((arrow) => {
  arrow.addEventListener("click", function (e) {
    e.preventDefault();
    const arrowID = e.target.id;
    if (arrowID === "arrow-one") {
      contentOne.classList.add("mobile-view");
      contentTwo.classList.remove("mobile-view");
    } else {
      contentTwo.classList.add("mobile-view");
      contentOne.classList.remove("mobile-view");
    }
  });
});

// modal
chooseContent.forEach((btn) => {
  btn.addEventListener("click", function () {
    alertWrapper.classList.remove("hidden");
  });
});

alertClose.addEventListener("click", function (e) {
  e.preventDefault();
  alertWrapper.classList.add("hidden");
  alertContent.forEach((content) => {
    content.classList.add("hidden");
  });
  document.getElementById("options-alert").classList.remove("hidden");
});

noAlert.addEventListener("click", function (e) {
  e.preventDefault();
  alertWrapper.classList.add("hidden");
});

yesAlert.addEventListener("click", function (e) {
  e.preventDefault();
  alertContent.forEach((content) => {
    content.classList.add("hidden");
  });
  document.getElementById("final-alert").classList.remove("hidden");
});

alertWrapper.addEventListener("click", function (e) {
  const wrapperId = e.target.id;
  if (wrapperId === "choose-alert-wrapper") {
    e.target.classList.add("hidden");
  }
});

</script>