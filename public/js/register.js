      // Initialize Lucide icons
        lucide.createIcons();

        // Password visibility toggles
        function setupRegisterPasswordToggle(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            const icon = toggle.querySelector('i');

            toggle.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.setAttribute('data-lucide', 'eye-off');
                } else {
                    input.type = 'password';
                    icon.setAttribute('data-lucide', 'eye');
                }
                lucide.createIcons();
            });
        }

        setupRegisterPasswordToggle('registerPassword', 'registerPasswordToggle');
        setupRegisterPasswordToggle('registerConfirmPassword', 'registerConfirmPasswordToggle');

        // Password strength checker
        const registerPasswordInput = document.getElementById('registerPassword');
        const registerPasswordStrength = document.getElementById('registerPasswordStrength');
        const registerStrengthFill = document.getElementById('registerStrengthFill');
        const registerStrengthText = document.getElementById('registerStrengthText');

        const registerRequirements = {
            length: { 
                element: document.getElementById('register-req-length'), 
                test: (pwd) => pwd.length >= 8 
            },
            upper: { 
                element: document.getElementById('register-req-upper'), 
                test: (pwd) => /[A-Z]/.test(pwd) 
            },
            lower: { 
                element: document.getElementById('register-req-lower'), 
                test: (pwd) => /[a-z]/.test(pwd) 
            },
            number: { 
                element: document.getElementById('register-req-number'), 
                test: (pwd) => /[0-9]/.test(pwd) 
            },
            special: { 
                element: document.getElementById('register-req-special'), 
                test: (pwd) => /[^a-zA-Z0-9]/.test(pwd) 
            }
        };

        function updateRegisterPasswordStrength(password) {
            if (password.length === 0) {
                registerPasswordStrength.style.display = 'none';
                return;
            }
            
            registerPasswordStrength.style.display = 'block';
            
            let metRequirements = 0;
            
            const requirementTexts = {
                length: 'At least 8 characters',
                upper: 'One uppercase letter',
                lower: 'One lowercase letter', 
                number: 'One number',
                special: 'One special character'
            };
            
            Object.entries(registerRequirements).forEach(([key, req]) => {
                const met = req.test(password);
                
                if (met) {
                    req.element.classList.add('met');
                    req.element.innerHTML = '<span style="color: #059669;">✓</span> <span>' + requirementTexts[key] + '</span>';
                    metRequirements++;
                } else {
                    req.element.classList.remove('met');
                    req.element.innerHTML = '<span style="color: #ef4444;">✗</span> <span>' + requirementTexts[key] + '</span>';
                }
            });
            
            const percentage = (metRequirements / 5) * 100;
            registerStrengthFill.style.width = percentage + '%';
            
            if (metRequirements <= 2) {
                registerStrengthFill.style.background = '#ef4444';
                registerStrengthText.textContent = 'Weak';
                registerStrengthText.style.color = '#ef4444';
            } else if (metRequirements <= 4) {
                registerStrengthFill.style.background = '#f59e0b';
                registerStrengthText.textContent = 'Medium';
                registerStrengthText.style.color = '#f59e0b';
            } else {
                registerStrengthFill.style.background = '#10b981';
                registerStrengthText.textContent = 'Strong';
                registerStrengthText.style.color = '#10b981';
            }
            
            updateRegisterSubmitButton();
        }

        registerPasswordInput.addEventListener('input', function() {
            updateRegisterPasswordStrength(this.value);
        });

        // Form validation
        // const registerForm = document.getElementById('registerForm');
        const registerSubmitBtn = document.getElementById('registerSubmitBtn');
        const registerErrorMessage = document.getElementById('registerErrorMessage');

        function updateRegisterSubmitButton() {
            const firstName = document.getElementById('registerFirstName').value;
            const lastName = document.getElementById('registerLastName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('registerConfirmPassword').value;
            const terms = document.getElementById('registerTerms').checked;
            
            const allRequirementsMet = password.length > 0 && Object.values(registerRequirements).every(req => req.test(password));
            const passwordsMatch = password === confirmPassword && confirmPassword.length > 0;
            const allFieldsFilled = firstName && lastName && email && password && confirmPassword;
            
            registerSubmitBtn.disabled = !(allFieldsFilled && allRequirementsMet && passwordsMatch && terms);
        }

        ['registerFirstName', 'registerLastName', 'registerEmail', 'registerConfirmPassword'].forEach(id => {
            document.getElementById(id).addEventListener('input', updateRegisterSubmitButton);
        });

        document.getElementById('registerTerms').addEventListener('change', updateRegisterSubmitButton);

        document.getElementById('registerConfirmPassword').addEventListener('input', function() {
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '#d1d5db';
            }
            
            updateRegisterSubmitButton();
        });

        // Form submission
        // registerForm.addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const firstName = document.getElementById('registerFirstName').value;
        //     const lastName = document.getElementById('registerLastName').value;
        //     const email = document.getElementById('registerEmail').value;
        //     const password = document.getElementById('registerPassword').value;
        //     const confirmPassword = document.getElementById('registerConfirmPassword').value;
            
        //     if (password !== confirmPassword) {
        //         showRegisterError('Passwords do not match.');
        //         return;
        //     }
            
        //     const existingUsers = JSON.parse(localStorage.getItem('titanvault_users') || '[]');
        //     if (existingUsers.find(user => user.email === email)) {
        //         showRegisterError('An account with this email already exists--.');
        //         return;
        //     }
            
        //     const newUser = {
        //         id: Date.now().toString(),
        //         firstName,
        //         lastName,
        //         email,
        //         password,
        //         createdAt: new Date().toISOString()
        //     };
            
        //     existingUsers.push(newUser);
        //     localStorage.setItem('titanvault_users', JSON.stringify(existingUsers));
        //     localStorage.setItem('titanvault_current_user', JSON.stringify(newUser));
            
        //     if (typeof onRegisterSuccess === 'function') {
        //         onRegisterSuccess(newUser);
        //     } else {
        //         window.location.href = 'dashboard.html';
        //     }
        // });

        function showRegisterError(message) {
            registerErrorMessage.textContent = message;
            registerErrorMessage.style.display = 'block';
            setTimeout(() => {
                registerErrorMessage.style.display = 'none';
            }, 5000);
        }

        function showLoginForm() {
            if (typeof onShowLogin === 'function') {
                onShowLogin();
            }
        }