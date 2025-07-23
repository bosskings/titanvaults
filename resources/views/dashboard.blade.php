<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - TitanVault</title>
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

  <link rel="stylesheet" href="./css/style2.css">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
  <div class="app-container">
      <!-- Desktop Sidebar -->
      <aside class="sidebar" id="desktop-sidebar">
          <div class="sidebar-header">
              <img src="./images/titanvault.png" alt="TitanVault Logo" class="logo shield-logo">
              <span class="app-name">TitanVault</span>
          </div>
          <nav class="sidebar-nav">
              <a href="dashboard.html" class="nav-item active">
                  <i data-lucide="home"></i>
                  <span>Home</span>
              </a>
              <a href="recent-transactions.html" class="nav-item">
                  <i data-lucide="list-checks"></i>
                  <span>Recent Transactions</span>
              </a>
              <a href="deposit.html" class="nav-item">
                  <i data-lucide="banknote-arrow-up"></i>
                  <span>Deposit</span>
              </a>
              <a href="settings.html" class="nav-item">
                  <i data-lucide="settings"></i>
                  <span>Settings</span>
              </a>
              <a href="#" class="nav-item" id="logout-desktop">
                  <i data-lucide="log-out"></i>
                  <span>Logout</span>
              </a>
          </nav>
      </aside>

      <!-- Main Content Area -->
      <main class="main-content">
          <header class="dashboard-header">
              <div class="header-left">
                  <h1 id="welcome-message">Hello, [User's Name]</h1>
              </div>
              <div class="header-right">
                  <button class="icon-button"><i data-lucide="sliders"></i></button>
                  <a href="settings.html" class="profile-link">
                      <img id="headerProfilePicture" src="imgs/profile.png" alt="Profile Picture" class="profile-picture-small">
                  </a>
              </div>
          </header>

          <section class="portfolio-summary">
              <div class="balance-card">
                  <p class="label">Portfolio Balance</p>
                  <div class="balance-display-wrapper">
                      <h2 class="balance-amount" id="portfolioBalance">$98,140.12</h2>
                      <button class="icon-button balance-toggle-button" id="toggleBalanceVisibility">
                          <i data-lucide="eye"></i>
                      </button>
                  </div>
                  <div class="balance-change">
                      <i data-lucide="trending-up" class="text-green-500"></i>
                      <span class="text-green-500">2.7%</span>
                  </div>
              </div>

              <div class="action-buttons">
                  <button class="action-button">
                      <div class="icon-wrapper"><i data-lucide="dollar-sign"></i></div>
                      <span>Buy</span>
                  </button>
                  <button class="action-button">
                      <div class="icon-wrapper"><i data-lucide="banknote"></i></div>
                      <span>Sell</span>
                  </button>
                  <button class="action-button">
                      <div class="icon-wrapper"><i data-lucide="repeat"></i></div>
                      <span>Swap</span>
                  </button>
                  <a href="deposit.html" class="action-button">
                      <div class="icon-wrapper"><i data-lucide="hand-coins"></i></div>
                      <span>Receive</span>
                  </a>
                  <a href="withdraw.html" class="action-button">
                      <div class="icon-wrapper"><i data-lucide="arrow-up-to-line"></i></div>
                      <span>Send</span>
                  </a>
              </div>
          </section>

          <section class="section-card">
              <div class="section-header">
                  <h3>Your Crypto</h3>
                  <p>View your wallets, connect to Coinbase and more.</p>
                  <button class="icon-button"><i data-lucide="grid"></i></button>
              </div>
              <!-- <div class="crypto-holdings">
                  <div class="holding-card">
                      <div class="holding-header">
                          <div class="coin-icons">
                              <img src="/placeholder.svg?height=20&width=20" alt="Coin Icon" class="coin-icon">
                              <img src="/placeholder.svg?height=20&width=20" alt="Coin Icon" class="coin-icon">
                              <img src="/placeholder.svg?height=20&width=20" alt="Coin Icon" class="coin-icon">
                              <span>+5</span>
                          </div>
                      </div>
                      <p class="holding-name">My Everything Key</p>
                      <p class="holding-balance">$2,139.04</p>
                      <div class="balance-change">
                          <i data-lucide="trending-up" class="text-green-500"></i>
                          <span class="text-green-500">2.7%</span>
                          <i data-lucide="arrow-right" class="ml-auto"></i>
                      </div>
                  </div>
                  <div class="holding-card">
                      <div class="holding-header">
                          <div class="coin-icons">
                              <img src="/placeholder.svg?height=20&width=20" alt="Coin Icon" class="coin-icon">
                          </div>
                      </div>
                      <p class="holding-name">Savings Key</p>
                      <p class="holding-balance">$10,245.32</p>
                      <div class="balance-change">
                          <i data-lucide="trending-down" class="text-red-500"></i>
                          <span class="text-red-500">2.7%</span>
                          <i data-lucide="arrow-right" class="ml-auto"></i>
                      </div>
                  </div>
              </div> -->
          </section>

          <section class="section-card">
              <h3>Holdings</h3>
              <div class="holdings-list" id="holdingsList">
                  <!-- Holdings will be dynamically loaded here -->
              </div>
          </section>

          <section class="section-card">
              <h3>Expand your Portfolio</h3>
              <div class="expand-options">
                  <div class="expand-card">
                      <i data-lucide="file-text"></i>
                      <span>Create, import or join a shared wallet</span>
                  </div>
                  <div class="expand-card">
                      <i data-lucide="database"></i>
                      <span>Connect your Coinbase account</span>
                  </div>
              </div>
          </section>
      </main>

      <!-- Mobile Bottom Navigation -->
      <nav class="bottom-nav" id="mobile-bottom-nav">
          <a href="dashboard.html" class="nav-item active">
              <i data-lucide="home"></i>
              <span>Home</span>
          </a>
          <a href="recent-transactions.html" class="nav-item">
              <i data-lucide="list-checks"></i>
              <span>Transactions</span>
          </a>
          <a href="deposit.html" class="nav-item">
              <i data-lucide="banknote-arrow-up"></i>
              <span>Deposit</span>
          </a>
          <a href="#" class="nav-item" id="logout-mobile">
              <i data-lucide="log-out"></i>
              <span>Logout</span>
          </a>
      </nav>
  </div>
  <div id="toast-container"></div>
  <script src="script2.js"></script>
</body>
</html>
