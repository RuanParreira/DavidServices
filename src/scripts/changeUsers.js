// Seleciona todos os botões de editar
document.querySelectorAll(".btn-edit-client").forEach((btn) => {
  btn.addEventListener("click", function () {
    // Pega os dados do cliente
    const clientId = this.getAttribute("data-id");
    const clientName = this.getAttribute("data-name");
    const clientNumber = this.getAttribute("data-number");
    const clientCPF_CNPJ = this.getAttribute("data-cpf_cnpj");

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
    const inputName = modal.querySelector("#edit_name");
    const inputNumber = modal.querySelector("#edit_number");
    const inputId = modal.querySelector("#editClientId");
    const inputCPF_CNPJ = modal.querySelector("#edit_cpf_cnpj");

    if (inputName) inputName.value = clientName || "";
    if (inputCPF_CNPJ) {
      // Se o valor do banco for null/empty mostra placeholder "VAZIO", caso contrário aplica máscara e mostra o valor
      if (clientCPF_CNPJ === null || clientCPF_CNPJ === "" || String(clientCPF_CNPJ).toLowerCase() === "null") {
        inputCPF_CNPJ.value = "";
        inputCPF_CNPJ.placeholder = "Não Cadastrado";
      } else {
        inputCPF_CNPJ.placeholder = "";
        inputCPF_CNPJ.value = clientCPF_CNPJ || "";
        // Dispara o evento de input para aplicar a máscara do CPF/CNPJ
        inputCPF_CNPJ.dispatchEvent(new Event("input"));
      }
    }
    if (inputNumber) {
      inputNumber.value = clientNumber || "";
      // Dispara o evento de input para aplicar a máscara do telefone
      inputNumber.dispatchEvent(new Event("input"));
    }
    if (inputId) inputId.value = clientId || "";

    // Adiciona listener para enviar o formulário com Enter enquanto o modal estiver aberto
    modal._submitOnEnter = function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        const form = modal.querySelector("form");
        if (form) {
          if (typeof form.requestSubmit === "function") form.requestSubmit();
          else form.submit();
        }
      }
    };
    modal.addEventListener("keydown", modal._submitOnEnter);

    // Focar no campo nome
    if (inputName) inputName.focus();
  });
});

// Fechar modal ao clicar no overlay ou no botão de fechar
const modalWrapper = document.getElementById("editModal");
if (modalWrapper) {
  const overlay = modalWrapper.querySelector("#editModalOverlay");
  const closeBtn = modalWrapper.querySelector("#closeEditModal");

  const closeModal = () => {
    const modalContent = modalWrapper.querySelector(".modal-content");

    // Remove listener de Enter (se existir)
    if (modalWrapper._submitOnEnter) {
      modalWrapper.removeEventListener("keydown", modalWrapper._submitOnEnter);
      delete modalWrapper._submitOnEnter;
    }

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
