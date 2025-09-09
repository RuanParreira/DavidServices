document.querySelectorAll(".observation-toggle").forEach((toggle, idx) => {
  toggle.addEventListener("click", function () {
    const inputDiv = document.querySelectorAll(".observation-input")[idx];
    if (inputDiv) {
      inputDiv.classList.toggle("hidden");
      inputDiv.classList.toggle("flex"); // Adiciona ou remove a classe flex
      toggle.classList.toggle("hidden");
      // Foca no input ao abrir
      const input = inputDiv.querySelector("input");
      if (input) input.focus();
    }
  });
});
