// FinanceFlow - Login JavaScript

document.addEventListener("DOMContentLoaded", function () {

    const loginForm = document.querySelector("form");

    const username = document.getElementById("username");
    const password = document.getElementById("password");


    // Validate form before submission
    loginForm.addEventListener("submit", function (event) {

        let valid = true;

        clearErrors();


        // Username validation
        if (username.value.trim() === "") {

            showError(
                username,
                "Username is required."
            );

            valid = false;

        } else if (username.value.trim().length < 3) {

            showError(
                username,
                "Username must be at least 3 characters."
            );

            valid = false;

        } else {

            showSuccess(username);
        }


        // Password validation
        if (password.value === "") {

            showError(
                password,
                "Password is required."
            );

            valid = false;

        } else if (password.value.length < 6) {

            showError(
                password,
                "Password must be at least 6 characters."
            );

            valid = false;

        } else {

            showSuccess(password);
        }


        // Stop submission if validation fails
        if (!valid) {
            event.preventDefault();
        }

    });


    // Remove error while user starts typing
    username.addEventListener("input", function () {
        removeFieldMessage(username);
    });


    password.addEventListener("input", function () {
        removeFieldMessage(password);
    });

});


// Show error message
function showError(input, message) {

    const inputBox = input.closest(".input-box");

    inputBox.classList.add("error");
    inputBox.classList.remove("success");

    removeFieldMessage(input);

    const error = document.createElement("span");

    error.className = "error-message";
    error.textContent = message;

    inputBox.parentElement.appendChild(error);
}


// Show successful validation
function showSuccess(input) {

    const inputBox = input.closest(".input-box");

    inputBox.classList.remove("error");
    inputBox.classList.add("success");
}


// Remove field error
function removeFieldMessage(input) {

    const inputBox = input.closest(".input-box");

    inputBox.classList.remove("error");
    inputBox.classList.remove("success");

    const error = inputBox.parentElement.querySelector(".error-message");

    if (error) {
        error.remove();
    }
}


// Clear all validation messages
function clearErrors() {

    document.querySelectorAll(".error-message").forEach(function (error) {
        error.remove();
    });

    document.querySelectorAll(".input-box").forEach(function (box) {
        box.classList.remove("error");
        box.classList.remove("success");
    });
}


// Show / hide password
function togglePassword() {

    const password = document.getElementById("password");

    const button = document.querySelector(".show-password");

    if (password.type === "password") {

        password.type = "text";
        button.textContent = "🙈";

    } else {

        password.type = "password";
        button.textContent = "👁";
    }
}