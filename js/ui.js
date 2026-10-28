async function showExpenses(expenses) {
  const table = document.getElementById("expense_tb");
  table.innerHTML = "";
  expenses.forEach((c, i, a) => {
    const expenseArray = [
      c.id,
      c.amount,
      c.description,
      c.category_name,
      c.expense_date,
    ];

    const tableRow = document.createElement("tr");

    for (let j = 0; j < expenseArray.length; j++) {
      const td = document.createElement("td");

      td.textContent = expenseArray[j];

      tableRow.appendChild(td);
    }

    table.appendChild(tableRow);
  });
}
