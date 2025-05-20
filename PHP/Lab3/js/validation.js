class FormValidator {
    static validateId(id) {
        const pattern = /^\d{3,10}$/;
        return pattern.test(id);
    }

    static validateEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }

    static validatePassword(password) {
        const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return pattern.test(password);
    }

    static validateConfirmPassword(password, confirmPassword) {
        return password === confirmPassword;
    }

    static showError(elementId, message) {
        const errorElement = document.getElementById(elementId + 'Error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    static hideError(elementId) {
        const errorElement = document.getElementById(elementId + 'Error');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }
}