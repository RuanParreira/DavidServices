const btnToggle = document.getElementById("toggleSenha");
const inputSenha = document.getElementById("senhaInput");
const iconEye = document.getElementById("iconEye");
btnToggle.addEventListener("click", function (e) {
  e.preventDefault();
  if (inputSenha.type === "password") {
    inputSenha.type = "text";
    iconEye.classList.remove("bi-eye");
    iconEye.classList.add("bi-eye-slash");
  } else {
    inputSenha.type = "password";
    iconEye.classList.remove("bi-eye-slash");
    iconEye.classList.add("bi-eye");
  }
});
