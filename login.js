document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateForm()) {
                form.submit();
            }
        });
    }

    prefillEmailFromCookie();
    showLoginMessage();
});

function validateForm() {
    clearErrors();

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    let isValid = true;

    if (!email) {
        showError('email', 'Email is required');
        isValid = false;
    } else if (!isValidEmail(email)) {
        showError('email', 'Please enter a valid email address');
        isValid = false;
    }

    if (!password) {
        showError('password', 'Password is required');
        isValid = false;
    } else if (password.length < 6) {
        showError('password', 'Password must be at least 6 characters');
        isValid = false;
    }

    return isValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const formGroup = field.closest('.form-group');

    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.cssText = 'color: #dc3545; font-size: 12px; margin-top: 4px;';

    formGroup.appendChild(errorDiv);
    field.style.borderColor = '#dc3545';
}

function clearErrors() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(error => error.remove());

    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.style.borderColor = '#ddd';
    });
}

function prefillEmailFromCookie() {
    const emailField = document.getElementById('email');
    if (!emailField) {
        return;
    }

    const cookieMatch = document.cookie.match(/(?:^|;\s*)user_email=([^;]+)/);
    if (cookieMatch) {
        emailField.value = decodeURIComponent(cookieMatch[1]);
    }
}

function showLoginMessage() {
    const messageBox = document.getElementById('login-message');
    if (!messageBox) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const error = params.get('error');
    const logout = params.get('logout');

    let message = '';
    let className = 'alert';

    if (error === 'user_not_found') {
        message = 'Email not found. Please check your email or register a new account.';
        className += ' alert-error';
    } else if (error === 'invalid_password') {
        message = 'Invalid password. Please try again.';
        className += ' alert-error';
    } else if (logout === 'success') {
        message = 'You have been successfully logged out.';
        className += ' alert-success';
    }

    if (message) {
        messageBox.textContent = message;
        messageBox.className = className;
        messageBox.hidden = false;
    }
}
