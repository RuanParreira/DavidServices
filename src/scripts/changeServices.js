// Seleciona todos os botões de editar serviços
document.querySelectorAll(".btn-edit-client").forEach((btn) => {
  btn.addEventListener("click", function () {
    // Pega os dados do serviço
    const serviceId = this.getAttribute("data-id");
    const serviceStatus = this.getAttribute("data-status");
    const serviceDate = this.getAttribute("data-date");
    const serviceTechnical = this.getAttribute("data-technical");
    const serviceEquipment = this.getAttribute("data-equipment");
    const serviceProblem = this.getAttribute("data-problem");

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
    const inputId = modal.querySelector("#editClientId");
    const inputEquipment = modal.querySelector("#edit_equipment");
    const inputDate = modal.querySelector("#edit_date");
    const selectTechnical = modal.querySelector("#edit_technical");
    const selectStatus = modal.querySelector("#edit_status");
    const textareaProblem = modal.querySelector("#edit_problem");

    if (inputId) inputId.value = serviceId || "";
    if (inputEquipment) inputEquipment.value = serviceEquipment || "";
    if (inputDate) inputDate.value = serviceDate || "";
    if (selectTechnical) selectTechnical.value = serviceTechnical || "";
    if (selectStatus) selectStatus.value = serviceStatus || "";
    if (textareaProblem) textareaProblem.value = serviceProblem || "";

    // Focar no campo equipamento
    if (inputEquipment) inputEquipment.focus();
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
    }, 200);
  };

  if (overlay) overlay.addEventListener("click", closeModal);
  if (closeBtn) closeBtn.addEventListener("click", closeModal);

  // Fechar com Esc
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modalWrapper.classList.contains("hidden")) {
      closeModal();
    }
  });

  // Interceptar submit do formulário para confirmar status finalizado
  const editForm = modalWrapper.querySelector("form");
  if (editForm) {
    editForm.addEventListener("submit", function (e) {
      const statusSelect = this.querySelector("#edit_status");
      if (statusSelect && statusSelect.value === "4") {
        if (
          !confirm(
            "Tem certeza que deseja finalizar este serviço? Esta ação não pode ser desfeita.",
          )
        ) {
          e.preventDefault();
          return false;
        }
      }
    });
  }
}
