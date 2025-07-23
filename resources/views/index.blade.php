<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TitanVault</title>
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

    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <!-- Meta Tags Generated via https://www.opengraph.xyz -->

    <link rel="stylesheet" href="./css/style.css">
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
    <section id="hero" class="hero-section">
    <div class="hero-content">
        <p class="subtitle">JOIN OVER 1 MILLION USERS WORLDWIDE</p>
        <h1 class="hero-title">Own your crypto. <br><span class="highlight">No banks. No middlemen. No limits.</span></h1>
        <p class="hero-description">
            TitanVault is your all-in-one crypto command center — buy, hold, swap, spend, and grow your assets on your terms. Total control. Zero compromise.
        </p>
        <div class="hero-buttons">
            <a href="register.html" class="btn btn-primary">Get Started</a>
            <a href="about.html" class="btn btn-secondary">Learn More</a>
        </div>
        <div class="hodl-pay-card">
            <i data-lucide="zap"></i>
            <span>Introducing HODL Pay: Tap into your crypto’s value without selling.</span>
        </div>
    </div>
    <div class="hero-image-container">
        <img src="./images/hero-img.png" alt="Titan Vault App Mockup" class="hero-image">
    </div>
</section>
    <section class="crypto-section-container">
        <div class="crypto-section-card">
            <div class="crypto-section-content">
                <div class="crypto-section__text">
                    <h2 class="crypto-section__title">Get the best rates, every time you trade.</h2>
                    <p class="crypto-section__description">TitanVault scans top providers to secure you the best value, whether you're buying or swapping crypto. No guesswork, just transparent deals and flexible payment options.</p>
                    <div class="crypto-section__buttons">
                        <a href="login.html" class="crypto-section__btn--primary">Buy Crypto</a>
                        <a href="login.html" class="crypto-section__btn--secondary">Swap Crypto</a>
                    </div>
                </div>
                <div class="crypto-section__image-container">
                    <img src="./images/section.png" alt="Crypto App UI" class="crypto-section__image">
                </div>
            </div>
        </div>
    </section>

    <section class="everything-section-container">
        <div class="everything-section-content">
            <div class="everything-section__image-container">
                <img src="./images/cta-section-ii.svg" alt="Crypto wallet and cards" class="everything-section__image">
            </div>
            <div class="everything-section__text-content">
                <h2 class="everything-section__title">Everything you want in a crypto app, nothing you don't.</h2>
                <ul class="everything-section__feature-list">
                    <li><i data-lucide="check-circle" class="feature-icon"></i> Secure self-custody wallet for total ownership</li>
                    <li><i data-lucide="check-circle" class="feature-icon"></i> Manage multiple wallets across top blockchains</li>
                    <li><i data-lucide="check-circle" class="feature-icon"></i> Instantly purchase BTC and hundreds of tokens</li>
                    <li><i data-lucide="check-circle" class="feature-icon"></i> Swap thousands of crypto pairs with ease</li>
                    <li><i data-lucide="check-circle" class="feature-icon"></i> Pay bills, buy gift cards, and shop with crypto</li>
                </ul>
                <a href="#" class="everything-section__link">Create Your Wallet <i data-lucide="arrow-right"></i></a>
                <div class="everything-section__buttons">
                    <a href="dashboard.html" class="everything-section__btn--primary">Launch Web<br>App</a>
                    <a href="register.html" class="everything-section__btn--secondary">Sign Up for<br>TitanVault</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section-container">
        <div class="features-section__header">
            <h2 class="features-section__title">Engineered for security. Designed for everyone.</h2>
            <p class="features-section__subtitle">TitanVault combines institutional-grade security with a sleek, intuitive interface anyone can use.</p>
        </div>
        <div class="features-section__grid">
            <div class="features-section__card">
                <div class="features-section__icon-container">
                    <i data-lucide="shield"></i>
                </div>
                <h3 class="features-section__card-title">Military-Grade Security</h3>
                <p class="features-section__card-description">Fortified with advanced encryption and layered protection to keep your assets safe.</p>
            </div>

            <div class="features-section__card">
                <div class="features-section__icon-container">
                    <i data-lucide="zap"></i>
                </div>
                <h3 class="features-section__card-title">Lightning Fast Transactions</h3>
                <p class="features-section__card-description">Send, receive, and swap crypto in seconds using TitanVault's ultra-fast infrastructure.</p>
            </div>

            <div class="features-section__card">
                <div class="features-section__icon-container">
                    <i data-lucide="globe"></i>
                </div>
                <h3 class="features-section__card-title">Global Freedom</h3>
                <p class="features-section__card-description">Access your wallet from anywhere, anytime. We never sleep, and neither should your assets.</p>
            </div>

            <div class="features-section__card">
                <div class="features-section__icon-container">
                    <i data-lucide="lock"></i>
                </div>
                <h3 class="features-section__card-title">You Own It</h3>
                <p class="features-section__card-description">No intermediaries. With TitanVault, your keys and your crypto are truly yours.</p>
            </div>

            <div class="features-section__card">
                <div class="features-section__icon-container">
                    <i data-lucide="trending-up"></i>
                </div>
                <h3 class="features-section__card-title">Smart Portfolio Tools</h3>
                <p class="features-section__card-description">Track your holdings and monitor trends in real-time with powerful analytics.</p>
            </div>

            <div class="features-section__card">
                <div class="features-section__icon-container">
                    <i data-lucide="users"></i>
                </div>
                <h3 class="features-section__card-title">Community First</h3>
                <p class="features-section__card-description">You're not alone. Join a growing global community of empowered crypto users.</p>
            </div>
        </div>
    </section>

    <section class="hero-banner">
        <div class="hero-content-ii">
            <h1 class="hero-title-ii">
                Get more crypto for your money.
            </h1>
            <p class="hero-description-ii">
                TitanVault compares real-time prices from leading providers so you always trade at the best rates with no hidden charges.
            </p>
            <div class="hero-actions-ii">
                <a href="register.html">
                    <button class="button-primary-ii">
                    Create Wallet
                </button>
                </a>
                <a href="register.html">
                    <button class="button-secondary-ii">
                    Start Swapping
                </button>
                </a>
            </div>
        </div>

        <div class="hero-graphic-container">
            <div class="hero-graphic-placeholder">
                <script src="https://widgets.coingecko.com/gecko-coin-converter-widget.js"></script>
                <gecko-coin-converter-widget locale="en" outlined="true" initial-currency="usd"></gecko-coin-converter-widget>
            </div>
        </div>
    </section>

    <section class="crypto-bills-section">
        <div class="bills-content-wrapper">
            <h2 class="bills-title">
                Pay everyday bills using your crypto
            </h2>
            <p class="bills-description">
                From credit cards to rent and more, TitanVault lets you settle real-world expenses through seamless crypto payments.
            </p>

            <div class="features-icons">
                <div class="feature-icon-wrapper">
                    <i data-lucide="home"></i>
                </div>
                <div class="feature-icon-wrapper">
                    <i data-lucide="credit-card"></i>
                </div>
                <div class="feature-icon-wrapper">
                    <i data-lucide="car"></i>
                </div>
                <div class="feature-icon-wrapper">
                    <i data-lucide="file-text"></i>
                </div>
            </div>

            <div class="call-to-action">
                <button class="cta-button primary">
                    Start Paying with TitanVault
                </button>
            </div>

            <p class="legal-text">
                Availability varies by region. Check our terms and conditions for details.
            </p>
        </div>

        <div class="bills-image-wrapper">
            <div class="bills-image-placeholder">
                <img src="./images/pay-cta-image.png" width="100%" alt="Crypto bill payment">
            </div>
        </div>
    </section>

    <section class="ready-section">
        <h2 class="section-heading">
            Ready to own your crypto future?
        </h2>
        <p class="section-description">
            Over 1 million users trust TitanVault. Sign up now and take full control in just a few minutes.
        </p>
        <div class="action-buttons">
            <button class="action-button primary">
                Create Wallet <i data-lucide="arrow-right"></i>
            </button>
            <button class="action-button secondary">
                Learn More <i data-lucide="arrow-right"></i>
            </button>
        </div>
    </section>

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
    <script src="./js/script.js"></script>
</body>
</html>