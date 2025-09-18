document.addEventListener("DOMContentLoaded", function () {
  const cpfInput = document.getElementById("cpf");
  if (!cpfInput) return;

  cpfInput.addEventListener("input", function (e) {
    let value = cpfInput.value.replace(/\D/g, ""); // Remove tudo que não for número

    // Limita a 14 dígitos
    value = value.slice(0, 11);

    // Formata CPF
    if (value.length <= 11) {
      // CPF: 000.000.000-00
      value = value.replace(/(\d{3})(\d)/, "$1.$2");
      value = value.replace(/(\d{3})(\d)/, "$1.$2");
      value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    }
    cpfInput.value = value;
  });

  // Impede colar letras/acentos
  cpfInput.addEventListener("keypress", function (e) {
    // Só permite números
    if (!/[0-9]/.test(e.key)) {
      e.preventDefault();
    }
  });

  // Formatar Numero de Telefone (campo principal)
  const numberInput = document.getElementById("number");
  if (numberInput) {
    numberInput.addEventListener("input", function () {
      let value = numberInput.value.replace(/\D/g, "");
      value = value.slice(0, 11);

      if (value.length > 0) {
        if (value.length > 10) {
          // Celular: (XX) XXXXX-XXXX
          value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        } else if (value.length === 10) {
          // Fixo: (XX) XXXX-XXXX
          value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3");
        } else if (value.length > 6) {
          // Intermediário: (XX) XXXXX-XXX ou (XX) XXXX-XXX
          value = value.replace(/^(\d{2})(\d{4,5})(\d{1,3})$/, "($1) $2-$3");
        } else if (value.length > 2) {
          value = value.replace(/^(\d{2})(\d{0,5})$/, "($1) $2");
        } else {
          value = value.replace(/^(\d{0,2})$/, "($1");
        }
      }

      numberInput.value = value;
    });

    numberInput.addEventListener("keypress", function (e) {
      // Só permite números
      if (!/[0-9]/.test(e.key)) e.preventDefault();
    });
  }

  // Formatar Numero de Telefone (campo do modal de edição)
  const editNumberInput = document.getElementById("edit_number");
  if (editNumberInput) {
    editNumberInput.addEventListener("input", function () {
      let value = editNumberInput.value.replace(/\D/g, "");
      value = value.slice(0, 11);

      if (value.length > 0) {
        if (value.length > 10) {
          // Celular: (XX) XXXXX-XXXX
          value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        } else if (value.length === 10) {
          // Fixo: (XX) XXXX-XXXX
          value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3");
        } else if (value.length > 6) {
          // Intermediário: (XX) XXXXX-XXX ou (XX) XXXX-XXX
          value = value.replace(/^(\d{2})(\d{4,5})(\d{1,3})$/, "($1) $2-$3");
        } else if (value.length > 2) {
          value = value.replace(/^(\d{2})(\d{0,5})$/, "($1) $2");
        } else {
          value = value.replace(/^(\d{0,2})$/, "($1");
        }
      }

      editNumberInput.value = value;
    });

    editNumberInput.addEventListener("keypress", function (e) {
      // Só permite números
      if (!/[0-9]/.test(e.key)) e.preventDefault();
    });
  }
});
