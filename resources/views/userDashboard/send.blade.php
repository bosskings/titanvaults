<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Crypto - TitanVault</title>
    <meta name="description" content="TitanVault: Send crypto securely from your vault.">
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
        <a href="{{ route('dashboard') }}">
            <div class="sidebar-header">
                <img src="./images/titanvault.png" alt="TitanVault Logo" class="logo shield-logo">
                <span class="app-name">TitanVault</span>
            </div>
        </a>
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
            <a href="{{ route('send') }}" class="nav-item active">
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
            <h1>Send Crypto</h1>
        </header>

        <section class="form-card">
            <div class="balance-summary" style="margin-bottom: 1.5rem;">
                <h3>Your Balances</h3>
                <ul id="user-balance-list" class="balance-list">
                    <li>
                        <span class="coin-name">{{ $user->coin ?? 'N/A' }}</span>
                        <span id="coin-balance" class="coin-balance">${{ $user->balance  }}</span>
                    </li>
                </ul>
            </div>
            <form id="sendCryptoForm" action="{{ route('send') }}" method="POST" autocomplete="off">
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
                    <label for="coinSelect">Select Coin</label>
                    <select id="coinSelect" name="coin" class="input-field" required>
                        <option value="">-- Please select --</option>
                        <option value="BTC">Bitcoin (BTC)</option>
                        <option value="ETH">Ethereum (ETH)</option>
                        <option value="USDT">Tether (USDT)</option>
                        <option value="USDC">USD Coin (USDC)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sendAmount">Amount</label>
                    <input type="number" id="sendAmount" name="amount" class="input-field" placeholder="Enter amount" step="0.00000001" min="0.00000001" required>
                </div>

                <div class="form-group">
                    <label for="receiverAddress">Destination Address</label>
                    <input type="text" id="receiverAddress" name="receiver_address" class="input-field" placeholder="Paste or type destination address" required>
                </div>

                <!-- Charges Section: 10% of transfer amount -->
                <div id="chargeSection" class="form-group" style="margin-bottom: 1rem; display: none;">
                    <label style="font-weight: 500; color: #f59e42;">
                        Estimated Charge (10%): 
                        <span id="chargeAmount">0</span>
                        <span id="chargeCoin"></span>
                    </label>
                </div>

                <button type="submit" class="primary-button" id="sendButton">Send Crypto</button>
            </form>
            <div id="processingMessage" class="processing-message" style="display:none; margin-top:2rem;">
                <div class="loader"></div>
                <p id="processingText" style="margin-top:1rem;">Processing your transaction...</p>
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
        <a href="{{ route('send') }}" class="nav-item active">
            <i data-lucide="arrow-up-right"></i>
            <span>Send</span>
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
        BTC : document.getElementById('coin-balance').innerHTML,
        ETH: document.getElementById('coin-balance').innerHTML,
        USDT:document.getElementById('coin-balance').innerHTML,
        USDC:document.getElementById('coin-balance').innerHTML
    };

    // function renderBalances() {
    //     const list = document.getElementById('user-balance-list');
    //     if (!list) return;
    //     list.innerHTML = '';
    //     Object.entries(demoBalances).forEach(([coin, amount]) => {
    //         let name = '';
    //         if (coin === 'BTC') name = 'Bitcoin';
    //         if (coin === 'ETH') name = 'Ethereum';
    //         if (coin === 'USDT') name = 'Tether';
    //         if (coin === 'USDC') name = 'USD Coin';
    //         list.innerHTML += `<li><strong>${name} (${coin}):</strong> <span>${amount}</span></li>`;
    //     });
    // }
    // renderBalances();

    // --- Charges Calculation Section ---
    const sendAmountInput = document.getElementById('sendAmount');
    const coinSelectInput = document.getElementById('coinSelect');
    const chargeSection = document.getElementById('chargeSection');
    const chargeAmountSpan = document.getElementById('chargeAmount');
    const chargeCoinSpan = document.getElementById('chargeCoin');

    function updateChargeSection() {
        const amount = parseFloat(sendAmountInput.value);
        const coin = coinSelectInput.value;
        if (!isNaN(amount) && amount > 0 && coin) {
            const charge = amount * 0.10;
            chargeAmountSpan.textContent = charge.toFixed(8).replace(/\.?0+$/, '');
            chargeCoinSpan.textContent = coin;
            chargeSection.style.display = '';
        } else {
            chargeAmountSpan.textContent = '0';
            chargeCoinSpan.textContent = '';
            chargeSection.style.display = 'none';
        }
    }

    sendAmountInput.addEventListener('input', updateChargeSection);
    coinSelectInput.addEventListener('change', updateChargeSection);

    // Form handling for dummy send
    document.getElementById('sendCryptoForm').addEventListener('submit', function(e) {
        // e.preventDefault();

        // Get values
        const coin = document.getElementById('coinSelect').value;
        const amount = parseFloat(document.getElementById('sendAmount').value);
        const address = document.getElementById('receiverAddress').value.trim();

        // Validate
        if (!coin || !amount || !address) {
            showToast('Please fill all fields.', 'error');
            return;
        }
        if (amount <= 0) {
            showToast('Amount must be greater than zero.', 'error');
            return;
        }
        if (amount > demoBalances[coin]) {
            showToast('Insufficient balance.', 'error');
            return;
        }

        // Hide form, show processing
        document.getElementById('sendCryptoForm').style.display = 'none';
        const processingDiv = document.getElementById('processingMessage');
        const processingText = document.getElementById('processingText');
        processingText.textContent = `Processing your ${coin} transfer of ${amount} to ${address}...`;
        processingDiv.style.display = 'block';

        // Simulate processing (in real app, submit form)
        setTimeout(function() {
            // For demo, just show success and reset
            processingText.textContent = `Your ${coin} transfer of ${amount} to ${address} is being processed!`;
            showToast('Transaction submitted for processing.', 'success');
            setTimeout(function() {
                // Reset form and UI
                document.getElementById('sendCryptoForm').reset();
                document.getElementById('sendCryptoForm').style.display = '';
                processingDiv.style.display = 'none';
                updateChargeSection();
            }, 2500);
        }, 2000);
    });

    // Initialize charge section on page load
    updateChargeSection();
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
    #chargeSection {
        background: #fff7ed;
        border: 1px solid #f59e42;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 1rem;
    }
    #chargeSection label {
        color: #f59e42;
        font-weight: 500;
    }
</style>

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
</body>
</html>
