document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("search-client");
  const suggestionContainer = document.getElementById("suggestion-container");
  const inputWrapper = input.parentElement; // div.relative que envolve o input
  let selectedClient = null;

  input.addEventListener("input", async function () {
    const query = input.value.trim();
    if (query.length < 2) {
      removeSuggestionBox();
      return;
    }

    const res = await fetch(
      "../../src/backend/registerServices/autoComplete.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `q=${encodeURIComponent(query)}`,
      },
    );
    const clients = await res.json();

    showSuggestions(clients);
  });

  function showSuggestions(clients) {
    removeSuggestionBox();
    suggestionContainer.classList.remove("hidden");
    suggestionContainer.innerHTML = "";

    if (!clients.length) {
      const msg = document.createElement("div");
      msg.className = "p-4 text-center text-gray-500";
      msg.textContent = "Nenhum cliente encontrado";
      suggestionContainer.appendChild(msg);
      return;
    }

    clients.forEach((client) => {
      const button = document.createElement("button");
      button.type = "button";
      button.className =
        "w-full cursor-pointer flex flex-col gap-1 text-left p-4 hover:bg-gray-50 border-b border-gray-100 last:border-b-0 transition-colors";
      button.onclick = (e) => {
        e.preventDefault();
        selectClient(client);
      };

      const pName = document.createElement("p");
      pName.className = "font-medium text-gray-900";
      pName.textContent = client.name;

      const pCpf = document.createElement("p");
      pCpf.className = "text-sm text-gray-600";
      pCpf.textContent = `CPF: ${client.cpf_cnpj}`;

      const pNumber = document.createElement("p");
      pNumber.className = "text-sm text-gray-500";
      pNumber.textContent = client.number;

      button.appendChild(pName);
      button.appendChild(pCpf);
      button.appendChild(pNumber);

      suggestionContainer.appendChild(button);
    });
  }

  function selectClient(client) {
    selectedClient = client;
    const icon = inputWrapper.querySelector("i");
    input.style.display = "none";
    if (icon) icon.style.display = "none";
    suggestionContainer.classList.add("hidden");
    suggestionContainer.innerHTML = "";

    // Cria o card do cliente selecionado
    const card = document.createElement("div");
    card.className =
      "flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-lg mt-2";

    const infoDiv = document.createElement("div");

    const pName = document.createElement("p");
    pName.className = "font-medium text-gray-900";
    pName.textContent = client.name;

    const pCpf = document.createElement("p");
    pCpf.className = "text-sm text-gray-600";
    pCpf.textContent = `CPF: ${client.cpf_cnpj} - ${client.number}`;

    infoDiv.appendChild(pName);
    infoDiv.appendChild(pCpf);

    // Botão de remover
    const removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.className =
      "p-1 cursor-pointer text-gray-400 hover:text-gray-600 transition-colors ml-2";
    removeBtn.innerHTML = `<i class="bi bi-x-circle"></i>`;
    removeBtn.onclick = function () {
      card.remove();
      input.value = "";
      input.style.display = "";
      if (icon) icon.style.display = "";
      selectedClient = null;
      // Remove o campo oculto
      let hiddenInput = document.getElementById("selected-client-id");
      if (hiddenInput) hiddenInput.remove();
    };

    card.appendChild(infoDiv);
    card.appendChild(removeBtn);

    // Adiciona o card logo após o input
    inputWrapper.appendChild(card);

    // Adiciona ou atualiza o campo oculto com o id do cliente
    let hiddenInput = document.getElementById("selected-client-id");
    if (!hiddenInput) {
      hiddenInput = document.createElement("input");
      hiddenInput.type = "hidden";
      hiddenInput.name = "id_client";
      hiddenInput.id = "selected-client-id";
      input.closest("form").appendChild(hiddenInput);
    }
    hiddenInput.value = client.id;
  }

  function removeSuggestionBox() {
    suggestionContainer.innerHTML = "";
    suggestionContainer.classList.add("hidden");
  }

  document.addEventListener("click", function (e) {
    if (!input.contains(e.target) && !suggestionContainer.contains(e.target))
      removeSuggestionBox();
  });
});
