// Ensure Lucide icons are created on page load and after dynamic content
document.addEventListener("DOMContentLoaded", () => {
  window.lucide.createIcons()
  // loadUserData()
  setupNavigation()
  setupLogoutButtons()
  setupDepositPage()
  setupWithdrawalPage()
  setupSettingsPage()
  renderHoldings() // Call to render holdings on dashboard
  //renderTransactions() // Call to render transactions on recent-transactions page
})

// --- Global Notification Functions ---
function showToast(message, type = "info", duration = 3000) {
  const toastContainer = document.getElementById("toast-container")
  if (!toastContainer) {
    console.warn("Toast container not found. Falling back to alert:", message)
    alert(message)
    return
  }

  const toast = document.createElement("div")
  toast.classList.add("toast-notification", type)
  toast.textContent = message
  toastContainer.appendChild(toast)

  setTimeout(() => {
    toast.remove()
  }, duration)
}

function showModal(title, message, onConfirm) {
  const modalOverlay = document.getElementById("feeNoticeModal") // Reusing the fee notice modal structure
  const modalTitle = modalOverlay.querySelector(".modal-header h2")
  const modalBody = modalOverlay.querySelector(".modal-body p")
  const confirmButton = modalOverlay.querySelector("#feeNoticeUnderstandButton")

  if (!modalOverlay || !modalTitle || !modalBody || !confirmButton) {
    console.error("Modal elements not found. Falling back to alert:", message)
    alert(`${title}\n\n${message}`)
    if (onConfirm) onConfirm()
    return
  }

  modalTitle.textContent = title
  modalBody.textContent = message
  modalOverlay.style.display = "flex" // Show the modal

  const handleConfirm = () => {
    modalOverlay.style.display = "none" // Hide the modal
    confirmButton.removeEventListener("click", handleConfirm)
    if (onConfirm) onConfirm()
  }

  confirmButton.addEventListener("click", handleConfirm)
}

// --- Global Functions ---

function loadUserData() {
  // const currentUser = JSON.parse(localStorage.getItem("titanvault_current_user"))
  // if (!currentUser) {
  //   // Redirect to login if no user is logged in
  //   window.location.href = "login.html"
  //   return
  // }

  // Dashboard specific
  // const welcomeMessage = document.getElementById("welcome-message")
  // if (welcomeMessage) {
  //   welcomeMessage.textContent = `Hello, ${currentUser.firstName} ${currentUser.lastName}`
  // }

  // Settings page specific
  const usernameInput = document.getElementById("usernameInput")
  const emailInput = document.getElementById("emailInput")
  const profilePicture = document.getElementById("profilePicture")
  const headerProfilePicture = document.getElementById("headerProfilePicture")

  if (usernameInput) {
    usernameInput.value = currentUser.username || `${currentUser.firstName} ${currentUser.lastName}`
  }
  if (emailInput) {
    emailInput.value = currentUser.email
  }
  if (profilePicture && currentUser.profilePicture) {
    profilePicture.src = currentUser.profilePicture
  }
  if (headerProfilePicture && currentUser.profilePicture) {
    headerProfilePicture.src = currentUser.profilePicture
  }
}

function setupNavigation() {
  const currentPath = window.location.pathname.split("/").pop()
  const navItems = document.querySelectorAll(".nav-item")

  navItems.forEach((item) => {
    const href = item.getAttribute("href")
    if (href && href.includes(currentPath)) {
      item.classList.add("active")
    } else {
      item.classList.remove("active")
    }
  })
}

function setupLogoutButtons() {
  const logoutButtons = document.querySelectorAll('[id^="logout-"]')
  logoutButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault()
      localStorage.removeItem("titanvault_current_user")
      showToast("Logged out successfully!", "info")
      window.location.href = "login.html" // Redirect to login page
    })
  })
}



// --- Dashboard Page Logic ---
const mockHoldings = [
  { name: "Bitcoin", ticker: "BTC", balance: 1, usdValue: 0, logo: "./images/btc.svg" },
  { name: "Ethereum", ticker: "ETH", balance: 1, usdValue: 0, logo: "./images/eth.svg" },
  { name: "Solana", ticker: "SOL", balance: 1, usdValue: 0, logo: "./images/solana.svg" },
  { name: "Tether", ticker: "USDT", balance: 1, usdValue: 0, logo: "./images/usdt.svg" },
  { name: "USD Coin", ticker: "USDC", balance: 1, usdValue: 0, logo: "./images/usdc.svg" },
];

// Fetch real-time prices for 5 major cryptocurrencies and update usdValue in mockHoldings
async function fetchMajorCryptoPrices() {
  const apiUrl = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,solana,tether,usd-coin&vs_currencies=usd";
  try {
    const response = await fetch(apiUrl);
    if (!response.ok) throw new Error("Failed to fetch crypto prices");
    const data = await response.json();
    // Map CoinGecko IDs to tickers for clarity
    const idToTicker = {
      bitcoin: "BTC",
      ethereum: "ETH",
      solana: "SOL",
      tether: "USDT",
      "usd-coin": "USDC"
    };
    // Update usdValue for each holding
    mockHoldings.forEach(holding => {
      // Find the CoinGecko id for this ticker
      const id = Object.keys(idToTicker).find(key => idToTicker[key] === holding.ticker);
      if (id && data[id] && typeof data[id].usd === "number") {
        holding.usdValue = holding.balance * data[id].usd;
      }
    });
    // Optionally, log the updated holdings
    // console.log("Updated mockHoldings with real-time prices:", mockHoldings);
    // If you want to re-render holdings after update, call renderHoldings() here if defined
    if (typeof renderHoldings === "function") renderHoldings();
  } catch (err) {
    console.error("Error fetching crypto prices:", err);
  }
}

// Call the function to update usdValue in mockHoldings
fetchMajorCryptoPrices();


function renderHoldings() {
  const holdingsList = document.getElementById("holdingsList")
  const portfolioBalanceDisplay = document.getElementById("portfolioBalance")

  if (holdingsList && portfolioBalanceDisplay) {
    holdingsList.innerHTML = "" // Clear existing content

    let totalPortfolioBalance = 0

    mockHoldings.forEach((holding) => {
      totalPortfolioBalance += holding.usdValue

      const holdingItem = document.createElement("div")
      holdingItem.classList.add("holding-item")
      holdingItem.innerHTML = `
              <img src="${holding.logo}" alt="${holding.name} Logo" class="currency-logo">
              <div class="currency-info">
                  <span class="currency-name">${holding.name}</span>
                  <span class="currency-ticker">${holding.ticker}</span>
              </div>
              <span class="currency-balance">${holding.balance} ${holding.ticker}</span>
              <span class="currency-usd">$${holding.usdValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
          `
      holdingsList.appendChild(holdingItem)
    })

    // portfolioBalanceDisplay.dataset.actualValue = totalPortfolioBalance.toFixed(2) // Store actual value
    // portfolioBalanceDisplay.textContent = `$${totalPortfolioBalance.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`

  }
}

setupBalanceVisibilityToggle() // Setup toggle after balance is rendered

function setupBalanceVisibilityToggle() {
  const toggleButton = document.getElementById("toggleBalanceVisibility")
  const portfolioBalance = document.getElementById("portfolioBalance")
  
  if (toggleButton && portfolioBalance) {
    const icon = toggleButton.querySelector("i")
    let isVisible = true // Default state is visible

    toggleButton.addEventListener("click", () => {
      isVisible = !isVisible

      if (isVisible) {
        
        portfolioBalance.textContent = document.getElementById("portfolioBalance").title;
        icon.setAttribute("data-lucide", "eye")
      } else {
        portfolioBalance.textContent = "******"
        icon.setAttribute("data-lucide", "eye-off")
      }
      window.lucide.createIcons() // Re-render icon
    })
  }
}

// --- Recent Transactions Page Logic ---
const mockTransactions = [
  {
    id: 1,
    type: "Deposit",
    currency: "USD",
    amount: 500.0,
    date: "2025-07-17 10:30 AM",
    status: "Completed",
    icon: "arrow-down",
  },
  {
    id: 2,
    type: "Withdrawal",
    currency: "BTC",
    amount: 0.01,
    date: "2025-07-16 03:15 PM",
    status: "Pending",
    icon: "arrow-up",
  },
  {
    id: 3,
    type: "Trade",
    currency: "ETH",
    amount: 0.5,
    date: "2025-07-16 11:00 AM",
    status: "Completed",
    icon: "repeat",
  },
  {
    id: 4,
    type: "Deposit",
    currency: "ETH",
    amount: 1.5,
    date: "2025-07-15 09:00 AM",
    status: "Completed",
    icon: "arrow-down",
  },
  {
    id: 5,
    type: "Withdrawal",
    currency: "USD",
    amount: 100.0,
    date: "2025-07-14 06:45 PM",
    status: "Failed",
    icon: "arrow-up",
  },
]

function renderTransactions() {
  const transactionsList = document.getElementById("transactionsList")
  if (transactionsList) {
    transactionsList.innerHTML = "" // Clear existing content

    mockTransactions.forEach((transaction) => {
      const transactionItem = document.createElement("div")
      transactionItem.classList.add("transaction-item")
      transactionItem.innerHTML = `
              <div class="transaction-icon">
                  <i data-lucide="${transaction.icon}"></i>
              </div>
              <div class="transaction-details">
                  <span class="transaction-type">${transaction.type} (${transaction.currency})</span>
                  <span class="transaction-date">${transaction.date}</span>
              </div>
              <span class="transaction-amount">${transaction.type === "Withdrawal" ? "-" : ""}${transaction.amount.toLocaleString()} ${transaction.currency}</span>
              <span class="transaction-status ${transaction.status.toLowerCase()}">${transaction.status}</span>
          `
      transactionsList.appendChild(transactionItem)
    })
    window.lucide.createIcons() // Re-render icons
  }
}

// --- Deposit Page Logic ---
function setupDepositPage() {
  const currencySelect = document.getElementById("currencySelect")
  const cryptoAddressSection = document.getElementById("cryptoAddressSection")
  const cryptoAddressDisplay = document.getElementById("cryptoAddressDisplay")
  const selectedCurrencyName = document.getElementById("selectedCurrencyName")
  const copyAddressButton = document.getElementById("copyAddressButton")
  const depositForm = document.getElementById("depositForm")

  if (currencySelect) {
    currencySelect.addEventListener("change", () => {
      const selectedValue = currencySelect.value
      let address = ""
      let currencyFullName = ""

      switch (selectedValue) {
        case "BTC":
          address = "0xC8C6984045e2d4943B7D10848A996Ff262499B3E"
          currencyFullName = "Bitcoin (BTC)"
          break
        case "ETH":
          address = "0xC8C6984045e2d4943B7D10848A996Ff262499B3E"
          currencyFullName = "Ethereum (ETH)"
          break
        case "USDT":
          address = "0xC8C6984045e2d4943B7D10848A996Ff262499B3E" // ERC-20 USDT
          currencyFullName = "Tether (USDT)"
          break
        case "USDC":
          address = "0xC8C6984045e2d4943B7D10848A996Ff262499B3E" // ERC-20 USDC
          currencyFullName = "USD Coin (USDC)"
          break
        default:
          address = ""
          currencyFullName = ""
          break
      }

      if (address) {
        cryptoAddressDisplay.textContent = address
        selectedCurrencyName.textContent = currencyFullName
        cryptoAddressSection.style.display = "block"
      } else {
        cryptoAddressSection.style.display = "none"
      }
      window.lucide.createIcons() // Re-render icons if any are dynamically added/removed
    })
  }

  if (copyAddressButton) {
    copyAddressButton.addEventListener("click", async () => {
      const addressToCopy = cryptoAddressDisplay.textContent
      try {
        await navigator.clipboard.writeText(addressToCopy)
        showToast("Address copied to clipboard!", "success")
      } catch (err) {
        console.error("Failed to copy address: ", err)
        showToast("Failed to copy address. Please copy manually.", "error")
      }
    })
  }

  if (depositForm) {
    depositForm.addEventListener("submit", (e) => {
      // e.preventDefault()
      const currency = currencySelect.value
      const amount = document.getElementById("depositAmount").value
      const proof = document.getElementById("proofOfPayment").files[0]

      if (!currency || !amount || !proof) {
        showToast("Please fill in all deposit details and upload proof of payment.", "error")
        return
      }

      // Simulate deposit submission
      showToast(
        `Deposit of ${amount} ${currency} submitted successfully! We will review your proof of payment.`,
        "success",
      )
      // depositForm.reset()
      cryptoAddressSection.style.display = "none"
      window.lucide.createIcons()
    })
  }
}





// --- Withdrawal Page Logic ---
const COINGECKO_API_URL = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd"
const COINGECKO_CACHE_DURATION = 60 * 1000 // 60 seconds

let coingeckoCache = {
  data: null,
  timestamp: 0,
}

async function fetchCoinGeckoPrices() {
  const now = Date.now()
  if (coingeckoCache.data && now - coingeckoCache.timestamp < COINGECKO_CACHE_DURATION) {
    return coingeckoCache.data // Return cached data if still fresh
  }

  try {
    const response = await fetch(COINGECKO_API_URL)
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    const data = await response.json()
    coingeckoCache = {
      data: data,
      timestamp: now,
    }
    return data
  } catch (error) {
    console.error("Error fetching CoinGecko prices:", error)
    showToast("Failed to fetch live crypto rates. Displaying USD fee only.", "error")
    return null
  }
}

function setupWithdrawalPage() {
  // Main unified form
  const withdrawalForm = document.getElementById("withdrawalForm") // The single form tag wrapping all sections

  // Section references
  const withdrawalFeeSection = document.getElementById("withdrawalFeeSection")
  const feePaymentProofSection = document.getElementById("feePaymentProofSection")
  const withdrawalOptionsSection = document.getElementById("withdrawalOptionsSection")
  const mssgBox = document.getElementById("messageArea")


  // Fee calculation elements
  const withdrawalAmountInput = document.getElementById("withdrawalAmountInput")
  const feeCurrencySelect = document.getElementById("feeCurrencySelect")
  const calculatedFeeDisplay = document.getElementById("calculatedFeeDisplay")
  const cryptoFeeDisplay = document.getElementById("cryptoFeeDisplay")
  const feeLoadingSpinner = document.getElementById("feeLoadingSpinner")
  const proceedToFeeProofButton = document.getElementById("proceedToFeeProofButton")

  // Fee payment proof elements
  const feeAddressDisplay = document.getElementById("feeAddressDisplay")
  const feeCurrencyNameDisplay = document.getElementById("feeCurrencyNameDisplay")
  const feeCurrencyNotice = document.getElementById("feeCurrencyNotice")
  const copyFeeAddressButton = document.getElementById("copyFeeAddressButton")
  const proofOfFeePaymentInput = document.getElementById("proofOfFeePayment")
  const submitFeeProofButton = document.getElementById("submitFeeProofButton")

  // Withdrawal method tab and input elements
  const tabButtons = document.querySelectorAll(".tab-button")
  const withdrawalForms = document.querySelectorAll(".withdrawal-form") // These are now just sections, not forms

  // Withdrawal method input fields
  const bankAccountNumberInput = document.getElementById("bankAccountNumber")
  const bankNameInput = document.getElementById("bankName")
  const paypalEmailInput = document.getElementById("paypalEmail")
  const cryptoCurrencySelect = document.getElementById("cryptoCurrencySelect")
  const cryptoWalletAddressInput = document.getElementById("cryptoWalletAddress")

  // The final submit button (should be inside the withdrawalOptionsSection)
  const finalWithdrawButton = document.getElementById("finalWithdrawButton")

  // State
  let currentWithdrawalAmount = 0
  let currentWithdrawalFeeUSD = 0
  let selectedFeeCurrency = ""
  let currentWithdrawalFeeInSelectedCurrency = 0
  let selectedWithdrawalMethod = "bank" // default, can be "bank", "paypal", "crypto"

  const mockFeeAddresses = {
    BTC: "0xC8C6984045e2d4943B7D10848A996Ff262499B3E",
    ETH: "0xC8C6984045e2d4943B7D10848A996Ff262499B3E",
    USDT: "0xC8C6984045e2d4943B7D10848A996Ff262499B3E",
    USDC: "0xC8C6984045e2d4943B7D10848A996Ff262499B3E",
  }

  async function updateFeeCalculation() {
    const amount = Number.parseFloat(withdrawalAmountInput.value)
    const feeCurrency = feeCurrencySelect.value

    if (isNaN(amount) || amount <= 0 || amount < 5000) {
      mssgBox.textContent = '$5,000 is the minimum withdrawal amount';

      currentWithdrawalAmount = 0
      currentWithdrawalFeeUSD = 0
      currentWithdrawalFeeInSelectedCurrency = 0
      calculatedFeeDisplay.textContent = "$0.00"
      cryptoFeeDisplay.textContent = ""
      proceedToFeeProofButton.disabled = true
      return
    }else{
      mssgBox.display = 'none';
      mssgBox.textContent = '';
      
    }

    currentWithdrawalAmount = amount
    // Generate a random integer between 550 and 800 (inclusive)
    currentWithdrawalFeeUSD = (amount / 100) * 14;

    calculatedFeeDisplay.textContent = `$${currentWithdrawalFeeUSD.toFixed(2)}`
    cryptoFeeDisplay.textContent = "" // Clear previous crypto display
    proceedToFeeProofButton.disabled = true // Disable until calculation is done

    if (feeCurrency) {
      selectedFeeCurrency = feeCurrency
      if (feeCurrency === "BTC" || feeCurrency === "ETH") {
        feeLoadingSpinner.style.display = "inline-block" // Show spinner
        const prices = await fetchCoinGeckoPrices()
        feeLoadingSpinner.style.display = "none" // Hide spinner

        if (prices) {
          const cryptoId = feeCurrency === "BTC" ? "bitcoin" : "ethereum"
          const rate = prices[cryptoId]?.usd
          if (rate) {
            currentWithdrawalFeeInSelectedCurrency = currentWithdrawalFeeUSD / rate
            cryptoFeeDisplay.textContent = ` (${currentWithdrawalFeeInSelectedCurrency.toFixed(8)} ${feeCurrency})`
            proceedToFeeProofButton.disabled = false
          } else {
            showToast(`Could not get ${feeCurrency} rate. Displaying USD fee only.`, "error")
            cryptoFeeDisplay.textContent = ` (Rate unavailable)`
            proceedToFeeProofButton.disabled = false // Allow proceeding with USD only
          }
        } else {
          // API failed, already showed toast in fetchCoinGeckoPrices
          cryptoFeeDisplay.textContent = ` (API Error)`
          proceedToFeeProofButton.disabled = false // Allow proceeding with USD only
        }
      } else {
        // USDT or USDC, no conversion needed as 1:1 with USD
        currentWithdrawalFeeInSelectedCurrency = currentWithdrawalFeeUSD
        cryptoFeeDisplay.textContent = ` (${currentWithdrawalFeeInSelectedCurrency.toFixed(2)} ${feeCurrency})`
        proceedToFeeProofButton.disabled = false
      }
    } else {
      cryptoFeeDisplay.textContent = ` (Select Fee Currency)`
      proceedToFeeProofButton.disabled = true
    }
  }

  if (withdrawalAmountInput) {
    withdrawalAmountInput.addEventListener("input", updateFeeCalculation)
  }

  if (feeCurrencySelect) {
    feeCurrencySelect.addEventListener("change", updateFeeCalculation)
  }

  // Step 1: Proceed to Fee Proof (just show next section)
  if (proceedToFeeProofButton) {
    proceedToFeeProofButton.addEventListener("click", (e) => {
      e.preventDefault()
      if (currentWithdrawalAmount <= 0 || !selectedFeeCurrency) {
        showToast("Please enter a valid amount and select a fee currency.", "error")
        return
      }

      // Display fee address and prepare for proof upload
      feeAddressDisplay.textContent = "Chat with Live support or send an email to get and address."
      feeCurrencyNameDisplay.textContent = selectedFeeCurrency
      feeCurrencyNotice.textContent = selectedFeeCurrency

      withdrawalFeeSection.style.display = "none"
      feePaymentProofSection.style.display = "block"
      window.lucide.createIcons()
    })
  }

  // Step 2: Copy fee address
  if (copyFeeAddressButton) {
    copyFeeAddressButton.addEventListener("click", async () => {
      const addressToCopy = feeAddressDisplay.textContent
      try {
        await navigator.clipboard.writeText(addressToCopy)
        showToast("Fee address copied to clipboard!", "success")
      } catch (err) {
        console.error("Failed to copy address: ", err)
        showToast("Failed to copy address. Please copy manually.", "error")
      }
    })
  }

  // Step 3: Enable submit proof button if file selected
  if (proofOfFeePaymentInput) {
    proofOfFeePaymentInput.addEventListener("change", () => {
      if (proofOfFeePaymentInput.files.length > 0) {
        submitFeeProofButton.disabled = false
      } else {
        submitFeeProofButton.disabled = true
      }
    })
  }

  // Step 4: Submit fee proof (just show next section)
  if (submitFeeProofButton) {
    submitFeeProofButton.addEventListener("click", (e) => {
      e.preventDefault()
      if (proofOfFeePaymentInput.files.length === 0) {
        showToast("Please upload proof of fee payment.", "error")
        return
      }


       // using ajax, get the verification and upgraded status

        // Very simple AJAX (XMLHttpRequest) to check a controller for a value and display messages
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/verification_status", true); // Adjust URL to your controller route
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              try {
                
                
                var response = JSON.parse(xhr.responseText);

                console.log(response);
                
                if (response.status != 'verified') {

                  // Show mandatory fee notice modal
                  showModal(
                    "Important Notice",
                    "Your account must be verified before withdrawal!.",
                    () => {
                      // This callback runs when "I Understand" is clicked
                      window.location.reload();
                    },
                  )
                }else if (response.upgraded != 'YES') {
                  
                  // Show mandatory fee notice modal
                  showModal(
                    "Important Notice",
                    "Upgrade your account for higher withdrawal limits!.",
                    () => {
                      // This callback runs when "I Understand" is clicked
                      window.location.reload();
                    },
                  )
                }else{
                  showToast("Account verified and upgraded, proceed to withdraw.", "success");
                }


              } catch (e) {
                showToast("Could not check verification status.", "error");
              }
            } else {
              showToast("Failed to check verification status.", "error");
            }
          }
        };
        xhr.send();

      
    })
  }

  // Step 5: Tab switching for withdrawal method (just show/hide sections, not forms)
  tabButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault()
      tabButtons.forEach((btn) => btn.classList.remove("active"))
      button.classList.add("active")
      selectedWithdrawalMethod = button.dataset.tab // "bank", "paypal", "crypto"

      withdrawalForms.forEach((form) => form.classList.remove("active-form"))
      document.getElementById(`${button.dataset.tab}WithdrawalForm`).classList.add("active-form")
      window.lucide.createIcons()
    })
  })

  // Step 6: Final form submission (the only real submit)
  if (withdrawalForm) {
    withdrawalForm.addEventListener("submit", (e) => {
      // e.preventDefault()

      // Only allow submission if on withdrawalOptionsSection (final step)
      if (withdrawalOptionsSection.style.display !== "block") {
        showToast("Please complete all previous steps before submitting withdrawal.", "error")
        return
      }

      // Validate and process based on selected withdrawal method
      let withdrawalDetails = {
        amount: currentWithdrawalAmount.toFixed(2),
        feeUSD: currentWithdrawalFeeUSD.toFixed(2),
        method: "",
        details: {},
      }

      if (selectedWithdrawalMethod === "bank") {
        const accountNumber = bankAccountNumberInput ? bankAccountNumberInput.value : ""
        const bankName = bankNameInput ? bankNameInput.value : ""
        if (!accountNumber || !bankName) {
          showToast("Please fill in all bank details.", "error")
          return
        }
        withdrawalDetails.method = "Bank Transfer"
        withdrawalDetails.details = { accountNumber, bankName }
        showToast("Bank withdrawal request submitted!", "success")
      } else if (selectedWithdrawalMethod === "paypal") {
        const paypalEmail = paypalEmailInput ? paypalEmailInput.value : ""
        if (!paypalEmail) {
          showToast("Please enter your PayPal email or tag.", "error")
          return
        }
        withdrawalDetails.method = "PayPal"
        withdrawalDetails.details = { paypalEmail }
        showToast("PayPal withdrawal request submitted!", "success")
      } else if (selectedWithdrawalMethod === "crypto") {
        const cryptoCurrency = cryptoCurrencySelect ? cryptoCurrencySelect.value : ""
        const cryptoAddress = cryptoWalletAddressInput ? cryptoWalletAddressInput.value : ""
        if (!cryptoCurrency || !cryptoAddress) {
          showToast("Please select a cryptocurrency and enter the wallet address.", "error")
          return
        }
        withdrawalDetails.method = "Crypto"
        withdrawalDetails.details = { cryptoCurrency, cryptoAddress }
        showToast(`Crypto withdrawal request for ${cryptoCurrency} submitted!`, "success")
      } else {
        showToast("Please select a withdrawal method.", "error")
        return
      }

      // Call EmailJS for withdrawal (non-blocking)
      sendWithdrawalConfirmationEmail(
        JSON.parse(localStorage.getItem("titanvault_current_user")),
        withdrawalDetails
      )

      // Optionally reset the form or go back to the first step
      withdrawalForm.reset()
      withdrawalOptionsSection.style.display = "none"
      withdrawalFeeSection.style.display = "block"
      feePaymentProofSection.style.display = "none"
      // Reset state
      currentWithdrawalAmount = 0
      currentWithdrawalFeeUSD = 0
      selectedFeeCurrency = ""
      currentWithdrawalFeeInSelectedCurrency = 0
      selectedWithdrawalMethod = "bank"
      tabButtons.forEach((btn) => btn.classList.remove("active"))
      if (tabButtons[0]) tabButtons[0].classList.add("active")
      withdrawalForms.forEach((form, idx) => {
        if (idx === 0) form.classList.add("active-form")
        else form.classList.remove("active-form")
      })
      window.lucide.createIcons()
    })
  }
}

function sendWithdrawalConfirmationEmail(userDetails, withdrawalDetails) {
  const serviceID = "YOUR_EMAILJS_SERVICE_ID" // REPLACE WITH YOUR ACTUAL SERVICE ID
  const templateID = "YOUR_EMAILJS_TEMPLATE_ID" // REPLACE WITH YOUR ACTUAL TEMPLATE ID

  const templateParams = {
    user_name: userDetails.firstName + " " + userDetails.lastName,
    user_email: userDetails.email,
    withdrawal_amount: withdrawalDetails.amount, // Now includes the actual withdrawal amount
    withdrawal_fee_usd: withdrawalDetails.feeUSD, // New: includes the calculated fee in USD
    withdrawal_fee_crypto_amount: withdrawalDetails.feeCryptoAmount || "N/A", // Fee in selected crypto
    withdrawal_fee_crypto_currency: withdrawalDetails.feeCryptoCurrency || "N/A", // Selected crypto for fee
    withdrawal_method: withdrawalDetails.method,
    // Add other relevant parameters as needed for your EmailJS template
    // For example, if method is 'Bank Transfer', you might add:
    // bank_account_number: withdrawalDetails.details?.accountNumber,
  }

  window.emailjs.send(serviceID, templateID, templateParams).then(
    (response) => {
      console.log("Email successfully sent!", response.status, response.text)
      // No blocking UI feedback here, just console log
    },
    (error) => {
      console.error("Email sending failed:", error)
      // No blocking UI feedback here, just console log
    },
  )
}

// --- Settings Page Logic ---
function setupSettingsPage() {
  const profilePicture = document.getElementById("profilePicture")
  const profilePictureInput = document.getElementById("profilePictureInput")
  const changeProfilePictureButton = document.getElementById("changeProfilePictureButton")
  const usernameInput = document.getElementById("usernameInput")
  const settingsForm = document.getElementById("settingsForm")

  if (changeProfilePictureButton) {
    changeProfilePictureButton.addEventListener("click", () => {
      profilePictureInput.click()
    })
  }

  if (profilePictureInput) {
    profilePictureInput.addEventListener("change", (event) => {
      const file = event.target.files[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
          const base64Image = e.target.result
          profilePicture.src = base64Image
          // Save to localStorage (simulate upload)
          const currentUser = JSON.parse(localStorage.getItem("titanvault_current_user"))
          if (currentUser) {
            currentUser.profilePicture = base64Image // Store as base64 for simplicity
            localStorage.setItem("titanvault_current_user", JSON.stringify(currentUser))
            // Update all users array as well
            let allUsers = JSON.parse(localStorage.getItem("titanvault_users") || "[]")
            allUsers = allUsers.map((user) => (user.id === currentUser.id ? currentUser : user))
            localStorage.setItem("titanvault_users", JSON.stringify(allUsers))
          }
          // Update header profile picture immediately if on dashboard
          const headerProfilePicture = document.getElementById("headerProfilePicture")
          if (headerProfilePicture) {
            headerProfilePicture.src = base64Image
          }
          showToast("Profile picture updated!", "success")
        }
        reader.readAsDataURL(file)
      }
    })
  }

  if (settingsForm) {
    settingsForm.addEventListener("submit", (e) => {
      // e.preventDefault()
      const newUsername = usernameInput.value
      const currentUser = JSON.parse(localStorage.getItem("titanvault_current_user"))

      if (currentUser) {
        currentUser.username = newUsername
        localStorage.setItem("titanvault_current_user", JSON.stringify(currentUser))

        // Update all users array as well
        let allUsers = JSON.parse(localStorage.getItem("titanvault_users") || "[]")
        allUsers = allUsers.map((user) => (user.id === currentUser.id ? currentUser : user))
        localStorage.setItem("titanvault_users", JSON.stringify(allUsers))

        showToast("Settings saved successfully!", "success")
        // loadUserData() // Reload data to reflect changes
      }
    })
  }
}
