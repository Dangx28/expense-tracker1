const button = document.getElementById("load_button");
button.addEventListener("click", loadExpenses);

async function loadExpenses() {
  const expenses = await getExpenses();
  showExpenses(expenses);
}

const form = document.getElementById("form");
form.addEventListener("submit", handleSignup);

async function handleSignup(e) {
  e.preventDefault();
  const result = await sendSignup(form);
  if (result.error) {
    console.log(result.error);
  } else {
    form.reset();
  }
}
