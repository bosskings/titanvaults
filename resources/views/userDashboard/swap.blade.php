<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swap Crypto - TitanVault</title>
    <meta name="description" content="TitanVault: Swap crypto securely from your vault.">
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
    <link rel="stylesheet" href="./css/style2.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="./js/script2.js"></script>
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
            <a href="{{ route('transaction') }}" class="nav-item">
                <i data-lucide="list-checks"></i>
                <span>Recent Transactions</span>
            </a>
            <a href="{{ route('deposit') }}" class="nav-item">
                <i data-lucide="banknote-arrow-up"></i>
                <span>Deposit</span>
            </a>
            <a href="{{ route('swap') }}" class="nav-item active">
                <i data-lucide="repeat"></i>
                <span>Swap</span>
            </a>
            <a href="{{ route('send') }}" class="nav-item">
                <i data-lucide="arrow-up-right"></i>
                <span>Send</span>
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
            <a href="{{ route('dashboard') }}" class="back-button"><i data-lucide="arrow-left"></i></a>
            <h1>Swap Crypto</h1>
        </header>

        <section class="form-card">
            <div class="balance-summary" style="margin-bottom: 1.5rem;">
                <h3>Your Balances</h3>
                <ul id="user-balance-list" class="balance-list">
                    <li>
                        <span class="coin-name" id="current-balance-coin">BTC</span>
                        <span id="current-balance-amount" class="coin-balance">1.23456789</span>
                    </li>
                </ul>
            </div>
            <form id="swapCryptoForm" method="POST" action="{{ route('swap')}}" autocomplete="off">
                @csrf

                @if (session('success'))
                    <p class="toast-notification success">
                        {{$mssg = session('success')}}
                    </p>
                @elseif(session('error'))
                    <p class="toast-notification error">
                        {{$mssg = session('error')}}
                    </p>
                @endif

                <div class="form-group">
                    <label for="fromCurrency">From</label>
                    <select id="fromCurrency" name="fromCurrency" class="input-field" required>
                        <option value="BTC">Bitcoin (BTC)</option>
                        <option value="ETH">Ethereum (ETH)</option>
                        <option value="USDT">Tether (USDT)</option>
                        <option value="USDC">USD Coin (USDC)</option>
                    </select>
                </div>
                <div class="form-group" style="display: flex; align-items: flex-end; gap: 0.5rem;">
                    <div style="flex:1;">
                        <label for="swapAmount">Amount</label>
                        <input type="number" id="swapAmount" name="swapAmount" class="input-field" placeholder="Enter amount" step="0.00000001" min="0.00000001" required>
                    </div>
                    <button type="button" class="secondary-button" id="maxButton" style="margin-bottom:2px;">Max</button>
                </div>
                <div class="form-group">
                    <label for="toCurrency">To</label>
                    <select id="toCurrency" name="toCurrency" class="input-field" required>
                        <option value="ETH">Ethereum (ETH)</option>
                        <option value="BTC">Bitcoin (BTC)</option>
                        <option value="USDT">Tether (USDT)</option>
                        <option value="USDC">USD Coin (USDC)</option>
                    </select>
                </div>
                <div class="form-group" id="swapRateSection" style="display:none;">
                    <label style="font-weight: 500; color: #3b82f6;">
                        Estimated Rate: 
                        <span id="swapRateText">1 BTC ≈ 15 ETH</span>
                    </label>
                </div>
                <button type="submit" class="primary-button" id="swapButton">Swap</button>
            </form>
            <div id="processingMessage" class="processing-message" style="display:none; margin-top:2rem;">
                <div class="loader"></div>
                <p id="processingText" style="margin-top:1rem;">Processing your swap...</p>
            </div>
        </section>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="bottom-nav" id="mobile-bottom-nav">
        <a href="{{ route('dashboard') }}" class="nav-item">
            <i data-lucide="home"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('transaction') }}" class="nav-item">
            <i data-lucide="list-checks"></i>
            <span>Transactions</span>
        </a>
        <a href="{{ route('deposit') }}" class="nav-item">
            <i data-lucide="banknote-arrow-up"></i>
            <span>Deposit</span>
        </a>
        <a href="{{ route('swap') }}" class="nav-item active">
            <i data-lucide="repeat"></i>
            <span>Swap</span>
        </a>
        <a href="{{ route('logout') }}" class="nav-item" id="logout-mobile">
            <i data-lucide="log-out"></i>
            <span>Logout</span>
        </a>
    </nav>
</div>
<div id="toast-container"></div>

<script>
    // Dummy balances for demo (in real app, fetch from backend)
    const demoBalances = {
        BTC: 1.23456789,
        ETH: 5.6789,
        USDT: 1200.50,
        USDC: 800.00
    };

    // Dummy rates for demo
    const demoRates = {
        'BTC-ETH': 15,
        'ETH-BTC': 0.0667,
        'BTC-USDT': 65000,
        'USDT-BTC': 0.000015,
        'ETH-USDT': 4000,
        'USDT-ETH': 0.00025,
        'BTC-USDC': 65000,
        'USDC-BTC': 0.000015,
        'ETH-USDC': 4000,
        'USDC-ETH': 0.00025,
        'USDT-USDC': 1,
        'USDC-USDT': 1
    };

    // Set initial balance display
    function updateBalanceDisplay() {
        const from = document.getElementById('fromCurrency').value;
        document.getElementById('current-balance-coin').textContent = from;
        document.getElementById('current-balance-amount').textContent = demoBalances[from];
    }

    // Set To currency options to not include selected From
    function updateToCurrencyOptions() {
        const from = document.getElementById('fromCurrency').value;
        const toSelect = document.getElementById('toCurrency');
        Array.from(toSelect.options).forEach(opt => {
            opt.disabled = (opt.value === from);
        });
        // If current selection is disabled, pick another
        if (toSelect.value === from) {
            for (let opt of toSelect.options) {
                if (!opt.disabled) {
                    toSelect.value = opt.value;
                    break;
                }
            }
        }
    }

    // Show estimated rate
    function updateSwapRate() {
        const from = document.getElementById('fromCurrency').value;
        const to = document.getElementById('toCurrency').value;
        const rateSection = document.getElementById('swapRateSection');
        const rateText = document.getElementById('swapRateText');
        if (from && to && from !== to) {
            const key = `${from}-${to}`;
            const rate = demoRates[key];
            if (rate) {
                rateText.textContent = `1 ${from} ≈ ${rate} ${to}`;
                rateSection.style.display = '';
            } else {
                rateText.textContent = 'Rate unavailable';
                rateSection.style.display = '';
            }
        } else {
            rateSection.style.display = 'none';
        }
    }

    // Max button logic
    document.getElementById('maxButton').addEventListener('click', function() {
        const from = document.getElementById('fromCurrency').value;
        document.getElementById('swapAmount').value = demoBalances[from];
    });

    // Update balance and options on currency change
    document.getElementById('fromCurrency').addEventListener('change', function() {
        updateBalanceDisplay();
        updateToCurrencyOptions();
        updateSwapRate();
    });
    document.getElementById('toCurrency').addEventListener('change', updateSwapRate);

    // Initial setup
    updateBalanceDisplay();
    updateToCurrencyOptions();
    updateSwapRate();

    // Dummy swap form handling
    document.getElementById('swapCryptoForm').addEventListener('submit', function(e) {
        // e.preventDefault();

        const from = document.getElementById('fromCurrency').value;
        const to = document.getElementById('toCurrency').value;
        const amount = parseFloat(document.getElementById('swapAmount').value);

        if (!from || !to || from === to) {
            showToast('Please select different currencies.', 'error');
            return;
        }
        if (!amount || amount <= 0) {
            showToast('Enter a valid amount.', 'error');
            return;
        }
        if (amount > demoBalances[from]) {
            showToast('Insufficient balance.', 'error');
            return;
        }

        // Hide form, show processing
        document.getElementById('swapCryptoForm').style.display = 'none';
        const processingDiv = document.getElementById('processingMessage');
        const processingText = document.getElementById('processingText');
        processingText.textContent = `Swapping ${amount} ${from} to ${to}...`;
        processingDiv.style.display = 'block';

        setTimeout(function() {
            processingText.textContent = `Your swap of ${amount} ${from} to ${to} is being processed!`;
            showToast('Swap submitted for processing.', 'success');
            setTimeout(function() {
                document.getElementById('swapCryptoForm').reset();
                document.getElementById('swapCryptoForm').style.display = '';
                processingDiv.style.display = 'none';
                updateBalanceDisplay();
                updateSwapRate();
            }, 2000);
        }, 1500);
    });

    // Dummy toast
    function showToast(msg, type) {
        const toast = document.createElement('div');
        toast.className = 'toast-notification ' + (type === 'success' ? 'success' : 'error');
        toast.textContent = msg;
        document.getElementById('toast-container').appendChild(toast);
        setTimeout(() => toast.remove(), 2500);
    }
</script>
<style>
    .balance-list { list-style: none; padding: 0; }
    .balance-list li { margin-bottom: 0.5rem; }
    .processing-message { text-align: center; }
    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3b82f6;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }
    @keyframes spin {
        0% { transform: rotate(0deg);}
        100% { transform: rotate(360deg);}
    }
    .secondary-button {
        background: #f3f4f6;
        color: #3b82f6;
        border: 1px solid #3b82f6;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .secondary-button:hover {
        background: #e0e7ff;
    }
    #swapRateSection {
        background: #f0f9ff;
        border: 1px solid #3b82f6;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 1rem;
    }
    #swapRateSection label {
        color: #3b82f6;
        font-weight: 500;
    }
    .toast-notification {
        position: relative;
        margin: 0.5rem auto;
        padding: 0.75rem 1.25rem;
        border-radius: 6px;
        font-size: 1rem;
        width: fit-content;
        min-width: 200px;
        text-align: center;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .toast-notification.success {
        background: #e0fce0;
        color: #15803d;
        border: 1px solid #22c55e;
    }
    .toast-notification.error {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #ef4444;
    }
</style>
</body>
</html>
