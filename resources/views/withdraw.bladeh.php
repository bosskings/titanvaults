<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Withdraw - TitanVault</title>
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
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
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
          <header class="page-header">
              <a href="dashboard.html" class="back-button"><i data-lucide="arrow-left"></i></a>
              <h1>Withdraw Funds</h1>
          </header>

          <!-- Step 1: Input Amount & Select Fee Currency -->
          <section class="form-card" id="withdrawalFeeSection">
              <h2>Withdrawal Details</h2>
              <p class="text-center text-gray-600 mb-4">A 10% fee is required to process withdrawals. Please enter your desired withdrawal amount and select the currency for the fee payment.</p>
              <div class="form-group">
                  <label for="withdrawalAmountInput">Amount to Withdraw (USD)</label>
                  <input type="number" id="withdrawalAmountInput" class="input-field" placeholder="Enter amount" step="0.01" min="0">
              </div>
              <div class="form-group">
                  <label for="feeCurrencySelect">Pay Fee In</label>
                  <select id="feeCurrencySelect" class="input-field">
                      <option value="">-- Select Fee Currency --</option>
                      <option value="BTC">Bitcoin (BTC)</option>
                      <option value="ETH">Ethereum (ETH)</option>
                      <option value="USDT">Tether (USDT)</option>
                      <option value="USDC">USD Coin (USDC)</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Calculated Fee</label>
                  <p id="calculatedFeeDisplay" class="address-display">
                      $0.00 <span id="cryptoFeeDisplay"></span> <span id="feeLoadingSpinner" class="spinner" style="display: none;"></span>
                  </p>
              </div>
              <button type="button" class="primary-button w-full" id="proceedToFeeProofButton" disabled>Proceed to Fee Payment Proof</button>
          </section>

          <!-- Step 2: Display Fee Address & Upload Proof -->
          <section class="form-card" id="feePaymentProofSection" style="display: none;">
              <h2>Pay Withdrawal Fee</h2>
              <p class="text-center text-gray-600 mb-4">Please send the calculated fee to the address below and upload proof of payment.</p>
              <div class="form-group">
                  <label>Fee Payment Address (<span id="feeCurrencyNameDisplay"></span>)</label>
                  <div class="address-display-wrapper">
                      <p id="feeAddressDisplay" class="address-display">Loading address...</p>
                      <button type="button" class="copy-button" id="copyFeeAddressButton"><i data-lucide="copy"></i></button>
                  </div>
                  <small class="text-gray-500">Send exactly the calculated fee amount in <span id="feeCurrencyNotice"></span> to this address.</small>
              </div>
              <div class="form-group">
                  <label for="proofOfFeePayment">Upload Proof of Fee Payment</label>
                  <input type="file" id="proofOfFeePayment" name="proof" class="input-field file-input">
                  <small class="text-gray-500">Screenshot of transaction, receipt, etc.</small>
              </div>
              <button type="button" class="primary-button w-full" id="submitFeeProofButton" disabled>Submit Fee Proof & Continue</button>
          </section>

          <!-- Step 4: Select Withdrawal Method (Initially hidden) -->
          <section class="form-card" id="withdrawalOptionsSection" style="display: none;">
              <h2>Select Withdrawal Method</h2>
              <div class="tab-buttons">
                  <button type="button" class="tab-button active" data-tab="bank">
                      <i data-lucide="banknote"></i> Bank Account
                  </button>
                  <button type="button" class="tab-button" data-tab="paypal">
                      <i data-lucide="paypal"></i> PayPal
                  </button>
                  <button type="button" class="tab-button" data-tab="crypto">
                      <i data-lucide="bitcoin"></i> Crypto Address
                  </button>
              </div>

              <div id="bankWithdrawalForm" class="withdrawal-form active-form">
                  <form>
                      <div class="form-group">
                          <label for="bankAccountNumber">Bank Account Number</label>
                          <input type="text" id="bankAccountNumber" class="input-field" placeholder="Enter account number">
                      </div>
                      <div class="form-group">
                          <label for="bankName">Bank Name</label>
                          <input type="text" id="bankName" class="input-field" placeholder="Enter bank name">
                      </div>
                      <div class="form-group">
                          <label for="accountHolderName">Account Holder Name</label>
                          <input type="text" id="accountHolderName" class="input-field" placeholder="Enter account holder name">
                      </div>
                      <div class="form-group">
                          <label for="swiftIban">SWIFT/IBAN</label>
                          <input type="text" id="swiftIban" class="input-field" placeholder="Enter SWIFT or IBAN">
                      </div>
                      <button type="submit" class="primary-button w-full">Withdraw to Bank</button>
                  </form>
              </div>

              <div id="paypalWithdrawalForm" class="withdrawal-form">
                  <form>
                      <div class="form-group">
                          <label for="paypalEmail">PayPal Email / Tag</label>
                          <input type="email" id="paypalEmail" class="input-field" placeholder="Enter PayPal email or tag">
                      </div>
                      <button type="submit" class="primary-button w-full">Withdraw to PayPal</button>
                  </form>
              </div>

              <div id="cryptoWithdrawalForm" class="withdrawal-form">
                  <form>
                      <div class="form-group">
                          <label for="cryptoCurrencySelect">Select Cryptocurrency</label>
                          <select id="cryptoCurrencySelect" name="cryptoCurrency" class="input-field">
                              <option value="">-- Please select --</option>
                              <option value="BTC">Bitcoin (BTC)</option>
                              <option value="ETH">Ethereum (ETH)</option>
                              <option value="USDT_USDC">Tether (USDT) / USD Coin (USDC)</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="cryptoWalletAddress">Crypto Wallet Address</label>
                          <input type="text" id="cryptoWalletAddress" class="input-field" placeholder="Enter wallet address">
                      </div>
                      <button type="submit" class="primary-button w-full">Withdraw to Crypto</button>
                  </form>
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

  <!-- Global Notification Container -->
  <div id="toast-container"></div>

  <!-- Fee Notice Modal -->
  <div id="feeNoticeModal" class="modal-overlay" style="display: none;">
      <div class="modal-dialogue">
          <div class="modal-content">
              <div class="modal-header">
                  <h2>Important Notice</h2>
              </div>
              <div class="modal-body">
                  <p>Paying the withdrawal fee is mandatory for processing your withdrawal. If the fee is not paid, your withdrawal request will be cancelled.</p>
              </div>
              <div class="modal-footer">
                  <button id="feeNoticeUnderstandButton" class="primary-button">I Understand</button>
              </div>
          </div>
      </div>
  </div>

  <script>
      (function() {
          emailjs.init({
              publicKey: "YOUR_EMAILJS_PUBLIC_KEY", // REPLACE WITH YOUR ACTUAL PUBLIC KEY
          });
      })();
  </script>
  <script src="script2.js"></script>
</body>
</html>
