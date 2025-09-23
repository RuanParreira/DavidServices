document.addEventListener("DOMContentLoaded", function () {
  const btnFecharMenu = document.querySelector(".btn-fechar-menu");

  if (btnFecharMenu) {
    btnFecharMenu.addEventListener("click", function () {
      toggleMenu();
    });
  }

  async function updateMenuSession(menuState) {
    try {
      const response = await fetch("../../src/backend/menu/toggle_menu.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ menuState: menuState }),
      });

      if (!response.ok) {
        console.error("Erro ao atualizar estado do menu");
      }
    } catch (error) {
      console.error("Erro na requisição:", error);
    }
  }

  function toggleMenu() {
    const menu = document.querySelector(".menu-lateral, .menu-lateral-fechado");

    if (menu.classList.contains("menu-lateral")) {
      // Fechar menu
      menu.className = "menu-lateral-fechado";

      // Atualizar ícone do botão fechar
      const btnFecharMenu = document.querySelector(".btn-fechar-menu i");
      if (btnFecharMenu) {
        btnFecharMenu.className = "bi bi-list text-3xl";
      }

      // Atualizar estrutura do menu
      const layerTitulo = menu.querySelector(".layer-titulo-menu .flex");
      if (layerTitulo) {
        layerTitulo.classList.add("hidden");
      }

      // Atualizar links do menu
      const menuLinks = menu.querySelectorAll("nav a");
      menuLinks.forEach((link) => {
        // Trocar classes dos links
        if (link.classList.contains("itens-menu-active")) {
          link.className = "itens-menu-active-fechado";
        } else if (link.classList.contains("itens-menu")) {
          link.className = "itens-menu-fechado";
        }

        // Trocar classes dos ícones
        const icon = link.querySelector("i");
        if (icon && icon.classList.contains("icons-menu")) {
          icon.className = icon.className.replace(
            "icons-menu",
            "icons-menu-fechado",
          );
        }

        // Esconder texto
        const span = link.querySelector("span");
        if (span) {
          span.classList.add("hidden");
        }
      });

      // Atualizar botão sair
      const btnSair = menu.querySelector(".btn-sair");
      if (btnSair) {
        btnSair.className = "btn-sair-fechado";
        const spanSair = btnSair.querySelector("span");
        if (spanSair) {
          spanSair.classList.add("hidden");
        }
      }

      // Atualizar container do botão sair
      const layerBtnSair = menu.querySelector(".layer-btn-sair");
      if (layerBtnSair) {
        layerBtnSair.className = "layer-btn-sair-fechado";
      }

      // Atualizar main-pages
      const mainPages = document.querySelector(".main-pages");
      if (mainPages) {
        mainPages.className = "main-pages-fechado";
      }

      // Salvar estado na sessão
      updateMenuSession("fechado");
    } else {
      // Abrir menu
      menu.className = "menu-lateral";

      // Restaurar ícone do botão fechar
      const btnFecharMenu = document.querySelector(".btn-fechar-menu i");
      if (btnFecharMenu) {
        btnFecharMenu.className = "bi bi-x text-3xl";
      }

      // Restaurar estrutura do menu
      const layerTitulo = menu.querySelector(".layer-titulo-menu .flex");
      if (layerTitulo) {
        layerTitulo.classList.remove("hidden");
      }

      // Restaurar links do menu
      const menuLinks = menu.querySelectorAll("nav a");
      menuLinks.forEach((link) => {
        // Restaurar classes dos links
        if (link.classList.contains("itens-menu-active-fechado")) {
          link.className = "itens-menu-active";
        } else if (link.classList.contains("itens-menu-fechado")) {
          link.className = "itens-menu";
        }

        // Restaurar classes dos ícones
        const icon = link.querySelector("i");
        if (icon && icon.classList.contains("icons-menu-fechado")) {
          icon.className = icon.className.replace(
            "icons-menu-fechado",
            "icons-menu",
          );
        }

        // Mostrar texto
        const span = link.querySelector("span");
        if (span) {
          span.classList.remove("hidden");
        }
      });

      // Restaurar botão sair
      const btnSair = menu.querySelector(".btn-sair-fechado");
      if (btnSair) {
        btnSair.className = "btn-sair";
        const spanSair = btnSair.querySelector("span");
        if (spanSair) {
          spanSair.classList.remove("hidden");
        }
      }

      // Restaurar container do botão sair
      const layerBtnSairFechado = menu.querySelector(".layer-btn-sair-fechado");
      if (layerBtnSairFechado) {
        layerBtnSairFechado.className = "layer-btn-sair";
      }

      // Restaurar main-pages
      const mainPagesFechado = document.querySelector(".main-pages-fechado");
      if (mainPagesFechado) {
        mainPagesFechado.className = "main-pages";
      }

      // Salvar estado na sessão
      updateMenuSession("aberto");
    }
  }
});
