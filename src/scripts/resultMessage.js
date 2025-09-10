setTimeout(function () {
  var msg = document.getElementById("successMessage");
  if (msg) {
    msg.style.display = "none";
  }
}, 3000);

setTimeout(function () {
  var msg = document.getElementById("errorMessage");
  if (msg) {
    msg.style.display = "none";
  }
}, 3000);

// Limpar Clientes
var clearBtn = document.getElementById("clearSearchBtn");
if (clearBtn) {
  clearBtn.addEventListener("click", function () {
    document.getElementById("searchInput").value = "";
    window.location.href = window.location.pathname;
  });
}

//Limpar Serviços Finalizados
var clearFinishedBtn = document.getElementById("clearFinishedSearch");
if (clearFinishedBtn) {
  clearFinishedBtn.addEventListener("click", function () {
    // Redireciona para a página sem parâmetros de busca
    window.location.href = window.location.pathname;
  });
}

//Limpar Visitas Tecnicas
var clearSearchVisit = document.getElementById("clearSearchVisit");
if (clearSearchVisit) {
  clearSearchVisit.addEventListener("click", function () {
    // Redireciona para a página sem parâmetros de busca
    window.location.href = window.location.pathname;
  });
}
