const orderForm = document.getElementById('order-form');
const appetizers = document.getElementById('appetizers');
const entrees = document.getElementById('entrees');
const drinks = document.getElementById('drinks');
const desserts = document.getElementById('desserts');
const submitBtn = document.getElementById('submit-btn');
const total = document.getElementById('total');


// Calculate the total price
function calculateTotal() {
  const appetizersPrice = parseFloat(appetizers.value);
  const entreesPrice = parseFloat(entrees.value);
  const drinksPrice = parseFloat(drinks.value);
  const dessertsPrice = parseFloat(desserts.value);
  
  const totalPrice = appetizersPrice + entreesPrice + drinksPrice + dessertsPrice;
  total.innerText = `Rs ${totalPrice.toFixed(2)}`;
}

// Add event listener to the form
orderForm.addEventListener('submit', function(e) {
  e.preventDefault();
  calculateTotal();
});

// Add event listeners to the select elements
appetizers.addEventListener('change', calculateTotal);
entrees.addEventListener('change', calculateTotal);
drinks.addEventListener('change', calculateTotal);
desserts.addEventListener('change', calculateTotal);
