<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - TitanVault</title>
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
                <a href="{{ route('transaction') }}" class="nav-item">
                    <i data-lucide="list-checks"></i>
                    <span>Recent Transactions</span>
                </a>
                <a href="{{ route('deposit') }}" class="nav-item">
                    <i data-lucide="banknote-arrow-up"></i>
                    <span>Deposit</span>
                </a>
                <a href="{{ route('setting') }}" class="nav-item active">
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
              <h1>Settings</h1>
          </header>

          <section class="form-card">
              <h2>Profile Settings</h2>
              <div class="profile-picture-section">
                  <img id="profilePicture" src="{{ !empty(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) : asset('images/profile.png') }}" alt="Profile Picture" class="profile-picture">
                </div>
                
                <form id="settingsForm" method="POST" action="{{ route('setting')}}" enctype="multipart/form-data">
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
                    
                    <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" style="display: none;">
                    <div style="display: flex; justify-content: center; margin: 1rem 0;">
                        <button type="button" 
                                class="primary-button" 
                                id="changeProfilePictureButton"
                                style="background: #2563eb; color: #fff; border: none; border-radius: 6px; padding: 0.75rem 1.5rem; font-size: 1rem; font-weight: 500; cursor: pointer;">
                            Change Profile Picture
                        </button>
                    </div>

                  <div class="form-group">
                      <label for="usernameInput">Change Username</label>
                      <input type="text" id="usernameInput" name="username" class="input-field" placeholder="Enter your username">
                  </div>
                  <div class="form-group">
                      <label for="emailInput">Email</label>
                      <input type="email" id="emailInput" value="{{ Auth::user()->email}}" disabled name="email" class="input-field" >
                  </div>
                  <button type="submit" class="primary-button w-full">Save Changes</button>
              </form>
          </section>
      </main>

        <!-- Mobile Bottom Navigation -->
        <nav class="bottom-nav" id="mobile-bottom-nav">
            <a href="{{ route('dashboard') }}" class="nav-item active">
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
  <script src="./js/script2.js"></script>
</body>
</html>
