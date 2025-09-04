document.addEventListener('DOMContentLoaded', function() {
    // Calculate and display the grand total
    calculateGrandTotal();

    // Form validation
    const checkoutForm = document.getElementById('checkoutForm');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            if (!validateCheckoutForm()) {
                e.preventDefault();
            } else {
                // If form is valid, you could add loading state here
                document.querySelector('.btn-submit').value = 'Processing...';
                document.querySelector('.btn-submit').disabled = true;
            }
        });
    }

    // Real-time validation for address field
    const addressField = document.getElementById('delivery_address');
    if (addressField) {
        addressField.addEventListener('input', function() {
            validateAddressField();
        });
    }
});

// Calculate the grand total from all items
function calculateGrandTotal() {
    const itemRows = document.querySelectorAll('#checkoutItems tr');
    let grandTotal = 0;

    itemRows.forEach(row => {
        const price = parseFloat(row.cells[1].textContent);
        const quantity = parseInt(row.cells[2].textContent);
        const total = price * quantity;
        
        // Update the total cell
        row.cells[3].textContent = total.toFixed(2);
        
        grandTotal += total;
    });

    // Update grand total display
    const grandTotalElement = document.getElementById('grandTotal');
    if (grandTotalElement) {
        grandTotalElement.textContent = `$${grandTotal.toFixed(2)}`;
    }

    return grandTotal;
}

// Validate the entire checkout form
function validateCheckoutForm() {
    const isAddressValid = validateAddressField();
    const isPaymentValid = validatePaymentMethod();

    return isAddressValid && isPaymentValid;
}

// Validate address field
function validateAddressField() {
    const addressField = document.getElementById('delivery_address');
    const errorElement = document.getElementById('addressErr');
    let isValid = true;

    if (!addressField.value.trim()) {
        errorElement.textContent = 'Please enter a delivery address';
        addressField.style.borderColor = '#e74c3c';
        isValid = false;
    } else if (addressField.value.trim().length < 10) {
        errorElement.textContent = 'Address should be at least 10 characters';
        addressField.style.borderColor = '#e74c3c';
        isValid = false;
    } else {
        errorElement.textContent = '';
        addressField.style.borderColor = '#ddd';
    }

    return isValid;
}

// Validate payment method (though the select always has a value)
function validatePaymentMethod() {
    const paymentMethod = document.getElementById('payment_method');
    const errorElement = document.getElementById('paymentErr');
    
    // This is more for demonstration since the select always has a value
    if (!paymentMethod.value) {
        errorElement.textContent = 'Please select a payment method';
        paymentMethod.style.borderColor = '#e74c3c';
        return false;
    } else {
        errorElement.textContent = '';
        paymentMethod.style.borderColor = '#ddd';
        return true;
    }
}

