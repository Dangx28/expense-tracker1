async function getExpenses() {
  const response = await fetch("api/get_expenses.php");
  const data = await response.json();
  return data;
}
