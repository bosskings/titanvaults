// Initialize Lucide icons
        lucide.createIcons();

        // Password visibility toggle
        const loginPasswordInput = document.getElementById('loginPassword');
        const loginPasswordToggle = document.getElementById('loginPasswordToggle');
        const loginPasswordIcon = loginPasswordToggle.querySelector('i');

        loginPasswordToggle.addEventListener('click', function() {
            if (loginPasswordInput.type === 'password') {
                loginPasswordInput.type = 'text';
                loginPasswordIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                loginPasswordInput.type = 'password';
                loginPasswordIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        });

        // Form submission
        // const loginForm = document.getElementById('loginForm');
        const loginErrorMessage = document.getElementById('loginErrorMessage');

        // loginForm.addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const email = document.getElementById('loginEmail').value;
        //     const password = document.getElementById('loginPassword').value;
            
        //     // Get stored users from localStorage
        //     const users = JSON.parse(localStorage.getItem('titanvault_users') || '[]');
            
        //     // Find user with matching email
        //     const user = users.find(u => u.email === email);
            
        //     if (!user) {
        //         showLoginError('No account found with this email address.');
        //         return;
        //     }
            
        //     if (user.password !== password) {
        //         showLoginError('Incorrect password. Please try again.');
        //         return;
        //     }
            
        //     // Store current user session
        //     localStorage.setItem('titanvault_current_user', JSON.stringify(user));
            
        //     // Redirect to dashboard or trigger success callback
        //     if (typeof onLoginSuccess === 'function') {
        //         onLoginSuccess(user);
        //     } else {
        //         window.location.href = 'dashboard.html';
        //     }
        // });

        function showLoginError(message) {
            loginErrorMessage.textContent = message;
            loginErrorMessage.style.display = 'block';
            setTimeout(() => {
                loginErrorMessage.style.display = 'none';
            }, 5000);
        }

        // Optional callback for integration
        function showRegisterForm() {
            if (typeof onShowRegister === 'function') {
                onShowRegister();
            }
        }