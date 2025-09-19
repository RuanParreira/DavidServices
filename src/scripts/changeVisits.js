// Seleciona todos os botões de editar visitas
document.querySelectorAll(".btn-edit-visit").forEach((btn) => {
  btn.addEventListener("click", function () {
    // Pega os dados da visita
    const visitId = this.getAttribute("data-id");
    const visitAddress = this.getAttribute("data-address");
    const technicalId = this.getAttribute("data-technical-id");

    // Seleciona o modal (wrapper com overlay)
    const modal = document.getElementById("editModal");
    const modalContent = modal.querySelector(".modal-content");

    // Mostra o modal e inicia a animação de entrada
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // Força um reflow para garantir que as classes sejam aplicadas
    modal.offsetHeight;

    // Adiciona classes de animação
    modal.classList.add("modal-entering");
    if (modalContent) {
      modalContent.classList.add("modal-content-entering");
    }

    // Remove as classes de animação após a transição
    setTimeout(() => {
      modal.classList.remove("modal-entering");
      if (modalContent) {
        modalContent.classList.remove("modal-content-entering");
      }
    }, 300);

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

  const closeModal = () => {
    const modalContent = modalWrapper.querySelector(".modal-content");

    // Adiciona classes de animação de saída
    modalWrapper.classList.add("modal-leaving");
    if (modalContent) {
      modalContent.classList.add("modal-content-leaving");
    }

    // Esconde o modal após a animação
    setTimeout(() => {
      modalWrapper.classList.add("hidden");
      modalWrapper.classList.remove("flex", "modal-leaving");
      if (modalContent) {
        modalContent.classList.remove("modal-content-leaving");
      }
    }, 300);
  };

  if (overlay) overlay.addEventListener("click", closeModal);
  if (closeBtn) closeBtn.addEventListener("click", closeModal);

  // Fechar com Esc
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modalWrapper.classList.contains("hidden")) {
      closeModal();
    }
  });
}
