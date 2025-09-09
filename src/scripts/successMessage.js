setTimeout(function () {
  var msg = document.getElementById("successMessage");
  if (msg) {
    msg.style.display = "none";
  }
}, 3000);

var clearBtn = document.getElementById("clearSearchBtn");
if (clearBtn) {
  clearBtn.addEventListener("click", function () {
    document.getElementById("searchInput").value = "";
    window.location.href = window.location.pathname;
  });
}
