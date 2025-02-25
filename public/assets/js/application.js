document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("newEquipmentForm");
  const submitBtn = document.getElementById("newSubmitBtn");

  submitBtn.addEventListener("click", function (event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    form.classList.add("was-validated");
  });
});
