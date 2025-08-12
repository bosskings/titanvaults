<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TitanVault</title>
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

    <link rel="stylesheet" href="./css/login.css">
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
                <li><a href="{{ route('home')}} ">Home</a></li>
                <li><a href="{{ route('about')}} ">About</a></li>
                <li><a href="{{ route('contact')}}">Contact</a></li>
            </ul>

            <!-- Desktop/Tablet View Auth Buttons -->
            <div class="navbar-auth-desktop" id="navbarAuthDesktop">
            <a href="{{ route('register')}}"><button class="signup-btn">Sign Up</button></a> 
                <a href="{{ route('login')}}"><button class="login-btn">Login</button></a>
            </div>

            <!-- Mobile Menu Content (hidden on desktop, shown on mobile via JS) -->
            <div class="mobile-menu-content" id="mobileMenuContent">
                <ul class="navbar-links-mobile">
                <li><a href="{{ route('home')}}">Home</a></li>
                <li><a href="{{ route('about')}}">About</a></li>
                <li><a href="{{ route('contact')}}">Contact</a></li>
                </ul>
                <div class="navbar-auth-mobile">
                    <a href="{{ route('register')}}"><button class="signup-btn">Sign Up</button></a> 
                <a href="{{ route('login')}}"><button class="login-btn">Login</button></a>
                </div>
            </div>
        </nav>

    <main>
    
    <div class="outer">
    <div class="inner">
        <div class="titanvault-login">
        <div class="logo">
            <i data-lucide="shield"></i>
        </div>
        
        <h1 class="title">Welcome back to TitanVault</h1>
        <p class="subtitle">Sign in to access your secure crypto wallet</p>
        
        <div class="error-message" id="loginErrorMessage"></div>
        
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf


            @if ($errors->any())
                <div class="form-group" style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label class="form-label" for="loginEmail">Email Address</label>
                <div class="input-wrapper">
                    <i data-lucide="mail" class="input-icon"></i>
                    <input 
                        name="email"
                        type="email" 
                        id="loginEmail" 
                        class="form-input" 
                        placeholder="Enter your email"
                        required
                    >
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="loginPassword">Password</label>
                <div class="input-wrapper">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input 
                        name="password"
                        type="password" 
                        id="loginPassword" 
                        class="form-input" 
                        placeholder="Enter your password"
                        required
                    >
                    <button type="button" class="password-toggle" id="loginPasswordToggle">
                        <i data-lucide="eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-row">
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="loginRemember" class="checkbox">
                    <label for="loginRemember" class="checkbox-label">Remember me</label>
                </div>
                <a href="#" class="forgot-link">Forgot your password?</a>
            </div>
            
            <button type="submit" class="submit-btn">Sign In</button>
        </form>
        
        <div class="auth-link">
            Don't have an account? <a href="{{ route('register') }}" >Sign up</a>
        </div>
        
        <p class="security-text">Protected by industry-leading security</p>
    </div>
</div>
</div>






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

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/689ac95de010901923f41e93/1j2ea563d';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    
    <script src="./js/script.js"></script>
    <script src="./js/login.js"></script>
</body>
</html>