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

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".upload-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let id = this.getAttribute("data-id"); // Pega o ID correto
      let fileInput = document.getElementById("imageUploadInput" + id);

      if (fileInput) {
        fileInput.click(); // Abre o seletor de arquivos apenas do equipamento clicado
      } else {
        console.error("Elemento não encontrado: imageUploadInput" + id);
      }
    });
  });
});
