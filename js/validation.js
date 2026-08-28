/**
 * Client-side validation for the roster app's forms.
 * Server-side validation still applies in every PHP script;
 * this just gives the user instant feedback in the browser.
 */
document.addEventListener('DOMContentLoaded', function () {

    // ---- Login form ----
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const errorBox = document.getElementById('form-error');

            clearInvalid([username, password]);

            if (!username.value.trim() || !password.value.trim()) {
                e.preventDefault();
                errorBox.textContent = 'Please fill in both fields.';
                markInvalid([username, password]);
            }
        });
    }

    // ---- Register form ----
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const confirm = document.getElementById('confirm_password');
            const errorBox = document.getElementById('form-error');

            clearInvalid([username, password, confirm]);
            let message = '';

            if (username.value.trim().length < 3) {
                message = 'Username must be at least 3 characters.';
                markInvalid([username]);
            } else if (password.value.length < 6) {
                message = 'Password must be at least 6 characters.';
                markInvalid([password]);
            } else if (password.value !== confirm.value) {
                message = 'Passwords do not match.';
                markInvalid([password, confirm]);
            }

            if (message) {
                e.preventDefault();
                errorBox.textContent = message;
            }
        });
    }

    // ---- Add / Edit hero form ----
    const heroForm = document.getElementById('hero-form');
    if (heroForm) {
        heroForm.addEventListener('submit', function (e) {
            const requiredFields = ['hero_name', 'real_name', 'short_bio', 'long_bio']
                .map(id => document.getElementById(id));
            const errorBox = document.getElementById('form-error');

            clearInvalid(requiredFields);

            const emptyFields = requiredFields.filter(f => !f.value.trim());

            if (emptyFields.length > 0) {
                e.preventDefault();
                errorBox.textContent = 'Please fill in all required fields marked with *.';
                markInvalid(emptyFields);
            }
        });
    }

    function markInvalid(fields) {
        fields.forEach(f => f.classList.add('invalid'));
    }

    function clearInvalid(fields) {
        fields.forEach(f => f.classList.remove('invalid'));
    }
});
