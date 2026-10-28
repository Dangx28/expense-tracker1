async function getExpenses() {
  const response = await fetch("api/get_expenses.php");
  const data = await response.json();
  return data;
}

async function sendSignup(form) {
  const response = await fetch("api/add_expense.php", {
    method: "POST",
    body: new FormData(form),
  });

  return await response.json();
}
