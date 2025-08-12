<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | TitanVault</title>
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

    <link rel="stylesheet" href="./css/about.css">
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


            <section class="about-section">
                <div class="container about-container">
                    <div class="about-content">
                        <span class="about-badge">
                            <i data-lucide="star" class="badge-icon"></i>
                            TRUSTED BY MILLIONS
                        </span>
                        <h1>Contact Us <span class="blue-text">TitanVault</span></h1>
                        <p>
                            We're building the future of digital finance. Our mission is to provide everyone with secure, simple, and powerful tools to manage their cryptocurrency with complete confidence and control.
                        </p>
                        <div class="about-actions">
                            <a href="{{ route('register') }}" class="btn primary-btn">
                                Join Our Community
                                <i data-lucide="arrow-right"></i>
                            </a>
                            <a href="{{ route('login') }}" class="btn secondary-btn">View Security Report</a>
                        </div>
                    </div>
                    <div class="about-image">
                        <div class="image-placeholder">
                            
                        </div>
                    </div>
                </div>
                <div class="about-stats-container">
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <i data-lucide="shield-check"></i>
                        </div>
                        <h3>$10B+</h3>
                        <p>Assets Protected</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <i data-lucide="users"></i>
                        </div>
                        <h3>1M+</h3>
                        <p>Trusted Users</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <i data-lucide="zap"></i>
                        </div>
                        <h3>99.9%</h3>
                        <p>Uptime</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <i data-lucide="globe"></i>
                        </div>
                        <h3>150+</h3>
                        <p>Countries</p>
                    </div>
                </div>
            </section>
    
            <section class="values-section">
                <div class="container values-container">
                    <div class="section-header">
                        <h2>How to reach us</h2>
                        <p>These principles guide everything we do, from product development to customer support.</p>
                    </div>
                    <div class="values-grid">
                        <div class="value-card">
                            <div class="value-icon">
                                <i data-lucide="envelop"></i>
                            </div>
                            <h3>Email</h3>
                            <p>Your assets are protected by the highest standards of cryptographic security.</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">
                                <i data-lucide="telegram"></i>
                            </div>
                            <h3>Telegram</h3>
                            <p>We build for our users, listening to feedback and evolving together.</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">
                                <i data-lucide="whatsapp"></i>
                            </div>
                            <h3>Whatsapp</h3>
                            <p>Constantly pushing the boundaries of what's possible in crypto technology.</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">
                                <i data-lucide="phone"></i>
                            </div>
                            <h4>Phone</h4>
                            <p>Making crypto simple and accessible for users around the world.</p>
                        </div>
                    </div>
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
</body>
</html>