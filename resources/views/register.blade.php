<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TitanVault</title>
    <meta name="description" content="TitanVault: Your secure crypto vault for digital assets.">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://titan-vault.vercel.app">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Titan Vault">
    <meta property="og:description" content="TitanVault: Your secure crypto vault for digital assets.">
    <meta property="og:image" content="https://opengraph.b-cdn.net/production/images/8efe88f6-331b-4a48-8233-60d9864423fb.png?token=ibGKIZ2KqiYAD9bnF2SMV8alW5MWapy0Itk1RGFw6oY&height=800&width=1200&expires=33288862938">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="titan-vault.vercel.app">
    <meta property="twitter:url" content="https://titan-vault.vercel.app">
    <meta name="twitter:title" content="Titan Vault">
    <meta name="twitter:description" content="TitanVault: Your secure crypto vault for digital assets.">
    <meta name="twitter:image" content="https://opengraph.b-cdn.net/production/images/8efe88f6-331b-4a48-8233-60d9864423fb.png?token=ibGKIZ2KqiYAD9bnF2SMV8alW5MWapy0Itk1RGFw6oY&height=800&width=1200&expires=33288862938">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Meta Tags Generated via https://www.opengraph.xyz -->

    <link rel="stylesheet" href="./css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
   <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div id="main-content">
        <nav class="navbar-container">
        <a href="index.html" class="navbar-logo"><i data-lucide="shield"></i> TitanVault</a>

        <div class="hamburger-menu" id="hamburgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Desktop/Tablet View Navigation Links -->
        <ul class="navbar-links-desktop" id="navbarLinksDesktop">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <!-- Desktop/Tablet View Auth Buttons -->
        <div class="navbar-auth-desktop" id="navbarAuthDesktop">
           <a href="register.html"><button class="signup-btn">Sign Up</button></a> 
            <a href="login.html"><button class="login-btn">Login</button></a>
        </div>

        <!-- Mobile Menu Content (hidden on desktop, shown on mobile via JS) -->
        <div class="mobile-menu-content" id="mobileMenuContent">
            <ul class="navbar-links-mobile">
               <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#">Contact</a></li>
            </ul>
            <div class="navbar-auth-mobile">
                <a href="register.html"><button class="signup-btn">Sign Up</button></a> 
            <a href="login.html"><button class="login-btn">Login</button></a>
            </div>
        </div>
    </nav>

        <main>
    
            <div class="outer">
                <div class="inner">

               

            <div class="titanvault-register">
        <div class="logo-ii">
            <i data-lucide="shield"></i>
        </div>
        
        <h1 class="title">Create your TitanVault account</h1>
        <p class="subtitle">Join millions who trust TitanVault for secure crypto storage</p>
        
        <div class="error-message" id="registerErrorMessage"></div>
        
        <form id="registerForm">
            <div class="form-group">
                <div class="form-row">
                    <div>
                        <label class="form-label" for="registerFirstName">First Name</label>
                        <div class="input-wrapper">
                            <i data-lucide="user" class="input-icon"></i>
                            <input 
                                type="text" 
                                id="registerFirstName" 
                                class="form-input" 
                                placeholder="John"
                                required
                            >
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="registerLastName">Last Name</label>
                        <div class="input-wrapper">
                            <i data-lucide="user" class="input-icon"></i>
                            <input 
                                type="text" 
                                id="registerLastName" 
                                class="form-input" 
                                placeholder="Doe"
                                required
                            >
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="registerEmail">Email Address</label>
                <div class="input-wrapper">
                    <i data-lucide="mail" class="input-icon"></i>
                    <input 
                        type="email" 
                        id="registerEmail" 
                        class="form-input" 
                        placeholder="john@example.com"
                        required
                    >
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="registerPassword">Password</label>
                <div class="input-wrapper">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input 
                        type="password" 
                        id="registerPassword" 
                        class="form-input" 
                        placeholder="Create a strong password"
                        required
                    >
                    <button type="button" class="password-toggle" id="registerPasswordToggle">
                        <i data-lucide="eye-off"></i>
                    </button>
                </div>
                <div class="password-strength" id="registerPasswordStrength" style="display: none;">
                    <div class="strength-bar">
                        <div class="strength-fill" id="registerStrengthFill"></div>
                    </div>
                    <div class="strength-text" id="registerStrengthText"></div>
                    <div class="strength-requirements">
                        <div class="requirement" id="register-req-length">
                            <span>✗</span>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement" id="register-req-upper">
                            <span>✗</span>
                            <span>One uppercase letter</span>
                        </div>
                        <div class="requirement" id="register-req-lower">
                            <span>✗</span>
                            <span>One lowercase letter</span>
                        </div>
                        <div class="requirement" id="register-req-number">
                            <span>✗</span>
                            <span>One number</span>
                        </div>
                        <div class="requirement" id="register-req-special">
                            <span>✗</span>
                            <span>One special character</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="registerConfirmPassword">Confirm Password</label>
                <div class="input-wrapper">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input 
                        type="password" 
                        id="registerConfirmPassword" 
                        class="form-input" 
                        placeholder="Confirm your password"
                        required
                    >
                    <button type="button" class="password-toggle" id="registerConfirmPasswordToggle">
                        <i data-lucide="eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="checkbox-wrapper">
                <input type="checkbox" id="registerTerms" class="checkbox" required>
                <label for="registerTerms" class="checkbox-label">
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>
            
            <button type="submit" class="submit-btn" id="registerSubmitBtn" disabled>Create Account</button>
        </form>
        
        <div class="auth-link">
            Already have an account? <a href="#" onclick="showLoginForm()">Sign in</a>
        </div>
        
        <p class="security-text">Your account will be protected by military-grade encryption</p>
    </div>
 </div>
</div>
<br>

    <footer class="bullionfx-footer">
        <div class="footer-content-wrapper">
            <div class="footer-brand">
                <div class="footer-logo">
                    <i data-lucide="shield"></i>
                    <span>TitanVault</span>
                </div>
                <p class="footer-description">
                    TitanVault is redefining digital asset ownership by bridging crypto with real-world value and trust.
                </p>
                <div class="social-links">
                    <a href="#" class="social-icon" aria-label="Twitter">
                        <i data-lucide="twitter"></i>
                    </a>
                    <a href="#" class="social-icon" aria-label="Instagram">
                        <i data-lucide="instagram"></i>
                    </a>
                    <a href="#" class="social-icon" aria-label="Facebook">
                        <i data-lucide="facebook"></i>
                    </a>
                </div>
            </div>

            <div class="footer-nav-group">
                <h3 class="nav-heading">Quick Links</h3>
                <ul class="nav-list">
                    <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Benefits</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Upgrade</a></li>
                </ul>
            </div>

            <div class="footer-nav-group">
                <h3 class="nav-heading">Legal</h3>
                <ul class="nav-list">
                    <li class="nav-item"><a href="#" class="nav-link">Terms & Conditions</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Privacy Policy</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Cookie Policy</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Disclaimer</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright">
            &copy; <span id="currentYear"></span> TitanVault. All rights reserved.
        </div>
    </footer>
</main>

    </div>
<script>
    lucide.createIcons()
  </script>
    <script src="script.js"></script>
    <script src="register.js"></script>
</body>
</html>