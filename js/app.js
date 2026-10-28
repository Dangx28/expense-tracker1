async function loadExpenses() {
  const expenses = await getExpenses();
  showExpenses(expenses);
}

const button = document.getElementById("load_button");
button.addEventListener("click", loadExpenses);
