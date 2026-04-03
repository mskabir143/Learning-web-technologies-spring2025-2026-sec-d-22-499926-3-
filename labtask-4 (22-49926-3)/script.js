const unitPrice = 1000;
const quantityInput = document.getElementById("quantity");
const totalPriceInput = document.getElementById("totalPrice");
const errorMsg = document.getElementById("errorMsg");

function updateTotalPrice() {
    let quantity = parseInt(quantityInput.value);

    if (isNaN(quantity) || quantity < 0) {
        quantity = 0;
        quantityInput.value = 0;
        errorMsg.textContent = "Quantity cannot be negative.";
    } else {
        errorMsg.textContent = "";
    }

    const total = unitPrice * quantity;
    totalPriceInput.value = total;

    if (total > 1000) {
        alert("Congratulations! You are now eligible for a gift coupon.");
    }
}

quantityInput.addEventListener("input", updateTotalPrice);