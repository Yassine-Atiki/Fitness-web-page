// Validation script for signup and login

document.addEventListener("DOMContentLoaded", () => {
    // Sign-up validation
    const signupForm = document.querySelector("#form");
    if (document.title.includes("SignUp")) {
        signupForm.addEventListener("submit", (e) => {
            const name = document.querySelector("#name").value.trim();
            const email = document.querySelector("#email").value.trim();
            const password = document.querySelector("#passwd").value;
            const confirmPassword = document.querySelector("#repeat-passwd").value;

            clearErrors();
            let hasError = false;

            if (name === "") {
                showError("#name", "Veuillez entrer votre nom.");
                hasError = true;
            }

            if (!validateEmail(email)) {
                showError("#email", "Veuillez entrer une adresse email valide.");
                hasError = true;
            }

            if (password.length < 6) {
                showError("#passwd", "Le mot de passe doit contenir au moins 6 caractères.");
                hasError = true;
            }

            if (password !== confirmPassword) {
                showError("#repeat-passwd", "Les mots de passe ne correspondent pas.");
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    }

    // Login validation
    if (document.title.includes("Login")) {
        signupForm.addEventListener("submit", (e) => {
            const email = document.querySelector("#email").value.trim();
            const password = document.querySelector("#passwd").value;

            clearErrors();
            let hasError = false;

            if (!validateEmail(email)) {
                showError("#email", "Veuillez entrer une adresse email valide.");
                hasError = true;
            }

            if (password.length < 6) {
                showError("#passwd", "Le mot de passe doit contenir au moins 6 caractères.");
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    }
});

// Function to validate email format
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to display error message below an input
function showError(inputSelector, message) {
    const inputElement = document.querySelector(inputSelector);
    const errorDiv = inputElement.nextElementSibling;
    if (errorDiv && errorDiv.classList.contains("error")) {
        errorDiv.textContent = message;
        errorDiv.style.color = "red";
    }
}

// Function to clear all error messages
function clearErrors() {
    const errorDivs = document.querySelectorAll(".error");
    errorDivs.forEach(div => {
        div.textContent = "";
        div.style.color = "";
    });
}
