<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deposit - TitanVault</title>
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
              <a href="dashboard.html" class="nav-item">
                  <i data-lucide="home"></i>
                  <span>Home</span>
              </a>
              <a href="recent-transactions.html" class="nav-item">
                  <i data-lucide="list-checks"></i>
                  <span>Recent Transactions</span>
              </a>
              <a href="deposit.html" class="nav-item active">
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
          <header class="page-header">
              <a href="dashboard.html" class="back-button"><i data-lucide="arrow-left"></i></a>
              <h1>Deposit Funds</h1>
          </header>

          <section class="form-card">
              <form id="depositForm">
                  <div class="form-group">
                      <label for="currencySelect">Select Currency</label>
                      <select id="currencySelect" name="currency" class="input-field">
                          <option value="">-- Please select --</option>
                          <option value="BTC">Bitcoin (BTC)</option>
                          <option value="ETH">Ethereum (ETH)</option>
                          <option value="USDT">Tether (USDT)</option>
                          <option value="USDC">USD Coin (USDC)</option>
                      </select>
                  </div>

                  <div class="form-group" id="cryptoAddressSection" style="display: none;">
                      <label>Deposit Address</label>
                      <div class="address-display-wrapper">
                          <p id="cryptoAddressDisplay" class="address-display"></p>
                          <button type="button" class="copy-button" id="copyAddressButton"><i data-lucide="copy"></i></button>
                      </div>
                      <small class="text-gray-500">Send only <span id="selectedCurrencyName"></span> to this address.</small>
                  </div>

                  <div class="form-group">
                      <label for="depositAmount">Deposit Amount</label>
                      <input type="number" id="depositAmount" name="amount" class="input-field" placeholder="Enter amount" step="0.01" min="0">
                  </div>

                  <div class="form-group">
                      <label for="proofOfPayment">Upload Proof of Payment</label>
                      <input type="file" id="proofOfPayment" name="proof" class="input-field file-input">
                      <small class="text-gray-500">Screenshot of transaction, receipt, etc.</small>
                  </div>

                  <button type="submit" class="primary-button">Submit Deposit</button>
              </form>
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
          <a href="deposit.html" class="nav-item active">
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
