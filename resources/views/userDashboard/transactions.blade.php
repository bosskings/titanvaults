<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recent Transactions - TitanVault</title>
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
                <a href="{{ route('dashboard') }}" class="nav-item">
                    <i data-lucide="home"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('transaction') }}" class="nav-item active">
                    <i data-lucide="list-checks"></i>
                    <span>Recent Transactions</span>
                </a>
                <a href="{{ route('deposit') }}" class="nav-item">
                    <i data-lucide="banknote-arrow-up"></i>
                    <span>Deposit</span>
                </a>
                <a href="{{ route('setting') }}" class="nav-item">
                    <i data-lucide="settings"></i>
                    <span>Settings</span>
                </a>
                <a href="{{ route('logout')}}" class="nav-item" id="logout-desktop">
                    <i data-lucide="log-out"></i>
                    <span>Logout</span>
                </a>
            </nav>
      </aside>

      <!-- Main Content Area -->
      <main class="main-content">
          <header class="page-header">
              <a href="dashboard.html" class="back-button"><i data-lucide="arrow-left"></i></a>
              <h1>Recent Transactions</h1>
          </header>

          <section class="form-card">
              <div class="transactions-list" id="transactionsList">
                  <!-- Transactions will be dynamically loaded here -->
              </div>
          </section>
      </main>

      <!-- Mobile Bottom Navigation -->
      <nav class="bottom-nav" id="mobile-bottom-nav">
          <a href="dashboard.html" class="nav-item">
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
  <script src="./js/script2.js"></script>
</body>
</html>
