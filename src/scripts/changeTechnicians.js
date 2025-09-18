// Seleciona todos os botões de editar técnicos
document.querySelectorAll(".btn-edit-client").forEach((btn) => {
  btn.addEventListener("click", function () {
    // Pega os dados do técnico
    const technicalId = this.getAttribute("data-id");
    const technicalName = this.getAttribute("data-name");
    const technicalNumber = this.getAttribute("data-number");

    // Seleciona o modal (wrapper com overlay)
    const modal = document.getElementById("editModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // Preenche os campos do modal pelos names/ids
    const inputName = modal.querySelector("#edit_name");
    const inputNumber = modal.querySelector("#edit_number");
    const inputId = modal.querySelector("#editTechnicalId");

    if (inputName) inputName.value = technicalName || "";
    if (inputNumber) {
      inputNumber.value = technicalNumber || "";
      // Dispara o evento de input para aplicar a máscara
      inputNumber.dispatchEvent(new Event("input"));
    }
    if (inputId) inputId.value = technicalId || "";

    // Focar no campo nome
    if (inputName) inputName.focus();
  });
});

// Fechar modal ao clicar no overlay ou no botão de fechar
const modalWrapper = document.getElementById("editModal");
if (modalWrapper) {
  const overlay = modalWrapper.querySelector("#editModalOverlay");
  const closeBtn = modalWrapper.querySelector("#closeEditModal");

  const closeModal = () => modalWrapper.classList.add("hidden");

  if (overlay) overlay.addEventListener("click", closeModal);
  if (closeBtn) closeBtn.addEventListener("click", closeModal);

  // Fechar com Esc
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modalWrapper.classList.contains("hidden")) {
      closeModal();
    }
  });
}
