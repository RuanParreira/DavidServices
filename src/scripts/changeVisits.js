// Seleciona todos os botões de editar visitas
document.querySelectorAll(".btn-edit-visit").forEach((btn) => {
  btn.addEventListener("click", function () {
    // Pega os dados da visita
    const visitId = this.getAttribute("data-id");
    const visitAddress = this.getAttribute("data-address");
    const technicalId = this.getAttribute("data-technical-id");

    // Seleciona o modal (wrapper com overlay)
    const modal = document.getElementById("editModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // Preenche os campos do modal pelos names/ids
    const inputAddress = modal.querySelector("#edit_address");
    const selectTechnical = modal.querySelector("#edit_technical");
    const inputId = modal.querySelector("#editVisitId");

    if (inputAddress) inputAddress.value = visitAddress || "";
    if (selectTechnical) selectTechnical.value = technicalId || "";
    if (inputId) inputId.value = visitId || "";

    // Focar no campo endereço
    if (inputAddress) inputAddress.focus();
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
