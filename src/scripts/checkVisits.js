document.addEventListener("DOMContentLoaded", function () {
  const dateInput = document.getElementById("date");
  const timeSelect = document.getElementById("time");
  const options = timeSelect.querySelectorAll("option");

  async function checkAllTimes() {
    const date = dateInput.value;
    let firstAvailable = null;
    for (const option of options) {
      const time = option.value;
      const res = await fetch("../../src/backend/visits/checkVisit.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `date=${encodeURIComponent(date)}&time=${encodeURIComponent(time)}`,
      });
      const data = await res.json();
      if (data.agendado) {
        option.textContent = `${time} (Agendado)`;
        option.disabled = true;
      } else {
        option.textContent = time;
        option.disabled = false;
        if (!firstAvailable) firstAvailable = option;
      }
    }
    // Seleciona o primeiro horário disponível
    if (firstAvailable) {
      firstAvailable.selected = true;
    } else {
      timeSelect.selectedIndex = -1; // Nenhum disponível
    }
  }

  dateInput.addEventListener("change", checkAllTimes);
  checkAllTimes();
});
