const form = document.querySelectorAll(".response-form");
var button = document.querySelectorAll(".toggle-form");

function toggle() {
  button.addEventListener("click", function () {
    form.style.display = "block";
  });
}
