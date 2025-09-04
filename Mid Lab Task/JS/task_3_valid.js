document.getElementById('donationForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Collect all values
    var firstName = document.getElementById('firstName').value.trim();
    var lastName = document.getElementById('lastName').value.trim();
    var address = document.getElementById('address').value.trim();
    var city = document.getElementById('city').value.trim();
    var state = document.getElementById('state').value;
    var phone = document.getElementById('phone').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var amountRadio = document.querySelector('input[name="amount"]:checked');
    var otherAmount = document.getElementById('otherAmount').value.trim();

    // Required fields validation
    if (!firstName || !lastName || !address || !city || !state || !phone || !email || !password || !confirmPassword || !amountRadio) {
        alert("All fields are required!");
        return;
    }
    // Name validation
    if (!/^[A-Za-z ]+$/.test(firstName)) {
        alert("First Name can only contain alphabets and spaces.");
        return;
    }
    if (!/^[A-Za-z ]+$/.test(lastName)) {
        alert("Last Name can only contain alphabets and spaces.");
        return;
    }
    // Phone validation
    if (!/^\d{11}$/.test(phone)) {
        alert("Phone number must be exactly 11 digits.");
        return;
    }
    // Email validation (simple)
    if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
        alert("Please enter a valid email address.");
        return;
    }
    // Password validation
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return;
    }
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/.test(password)) {
        alert("Password must have at least one uppercase, one lowercase, one digit, and one special character.");
        return;
    }
    // Confirm password
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return;
    }
    // Donation amount
    if (amountRadio.value === "other") {
        if (!otherAmount || isNaN(otherAmount) || Number(otherAmount) <= 0) {
            alert("Please enter a valid other amount.");
            return;
        }
    }
    alert("Thank you for your donation!");
    this.reset();
    document.getElementById('otherAmount').style.display = "none";
});

// Show/hide "Other Amount"
document.querySelectorAll('input[name="amount"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        if (this.value === "other") {
            document.getElementById('otherAmount').style.display = "block";
        } else {
            document.getElementById('otherAmount').style.display = "none";
        }
    });
});