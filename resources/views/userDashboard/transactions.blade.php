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

  <style>
    .text-orange{
        color: orange
    }

    .text-green{
        color: green
    }
  </style>
</head>
<body>
  <div class="app-container">
      <!-- Desktop Sidebar -->
      <aside class="sidebar" id="desktop-sidebar">
            <a href="{{ route('home') }}">
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
              <a href="{{ route('dashboard') }}" class="back-button"><i data-lucide="arrow-left"></i></a>
              <h1>Recent Transactions</h1>
          </header>

          <section class="form-card">
              <div class="transactions-list" id="transactionsList">
                  <!-- Transactions will be dynamically loaded here -->
              @php
                  // Group transactions: unseen (pending) first, then seen (completed/others)
                  $pending = [];
                  $completed = [];
                  if(isset($accounts) && (is_array($accounts) || $accounts instanceof \Illuminate\Support\Collection) && count($accounts)) {
                      foreach($accounts as $account) {
                          if(isset($account->seen) && !$account->seen) {
                              $pending[] = $account;
                          } else {
                              $completed[] = $account;
                          }
                      }
                  }
                  // Helper for status label and color
                  function getStatusLabelAndClass($account) {
                      if(isset($account->status) && $account->status == "UNSEEN") {
                          // Unseen: Pending, orange text
                          return ['Pending', 'transaction-status-pending', 'text-orange'];
                      }
                      // Seen: Completed, green text
                      return ['Completed', 'transaction-status-completed', 'text-green'];
                  }
                  // Helper for icon
                  function getTransactionIcon($purpose) {
                      $purpose = strtolower($purpose);
                      if ($purpose === 'send' || $purpose === 'sent') return 'arrow-up';
                      if ($purpose === 'withdraw' || $purpose === 'withdrawal') return 'arrow-right';
                      if ($purpose === 'deposit') return 'arrow-down';
                      if ($purpose === 'swap') return 'repeat';
                      return 'repeat';
                  }
              @endphp

              {{-- Pending (Unseen) Transactions --}}
              @foreach($pending as $transaction)
                  @php
                      [$statusLabel, $statusClass, $statusColor] = getStatusLabelAndClass($transaction);
                      $icon = getTransactionIcon($transaction->purpose);
                  @endphp
                  <div class="transaction-item">
                      <div class="transaction-icon">
                          <i data-lucide="{{ $icon }}"></i>
                      </div>
                      <div class="transaction-details">
                          <span class="transaction-type">{{ ucfirst($transaction->purpose) }} ({{ $transaction->coin }})</span>
                          <span class="transaction-date">{{ \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d h:i A') }}</span>
                      </div>
                      <span class="transaction-amount">
                          {{ (strtolower($transaction->purpose) === 'withdraw' || strtolower($transaction->purpose) === 'withdrawal') ? '-' : '' }}
                          {{ number_format($transaction->amount, 8, '.', ',') }} {{ $transaction->coin }}
                      </span>
                      <span class="transaction-status {{ $statusClass }} {{ $statusColor }}">{{ $statusLabel }}</span>
                  </div>
              @endforeach

              {{-- Completed (Seen) Transactions --}}
              @foreach($completed as $transaction)
                  @php
                      [$statusLabel, $statusClass, $statusColor] = getStatusLabelAndClass($transaction);
                      $icon = getTransactionIcon($transaction->purpose);
                  @endphp
                  <div class="transaction-item">
                      <div class="transaction-icon">
                          <i data-lucide="{{ $icon }}"></i>
                      </div>
                      <div class="transaction-details">
                          <span class="transaction-type">{{ ucfirst($transaction->purpose) }} ({{ $transaction->coin }})</span>
                          <span class="transaction-date">{{ \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d h:i A') }}</span>
                      </div>
                      <span class="transaction-amount">
                          {{ (strtolower($transaction->purpose) === 'withdraw' || strtolower($transaction->purpose) === 'withdrawal') ? '-' : '' }}
                          {{ number_format($transaction->amount, 8, '.', ',') }} {{ $transaction->coin }}
                      </span>
                      <span class="transaction-status {{ $statusClass }} {{ $statusColor }}">{{ $statusLabel }}</span>
                  </div>
              @endforeach

              @if((!isset($accounts) || count($accounts) === 0))
                  <div class="transaction-item">
                      <div class="transaction-details">
                          <span>No transactions found.</span>
                      </div>
                  </div>
              @endif
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
          <a href="{{ route('logout') }}" class="nav-item" id="logout-mobile">
              <i data-lucide="log-out"></i>
              <span>Logout</span>
          </a>
      </nav>
  </div>
  <div id="toast-container"></div>
  <script src="./js/script2.js"></script>
</body>

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
</html>
