<html>

    <head>
        <title>Titan Vaults Support</title>
    </head>

    <body>
        <div style="background:#f0f6ff;padding:40px 0;">
            <div style="max-width:500px;margin:0 auto;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.07);overflow:hidden;">
                <div style="background:#2563eb;padding:32px 0 16px 0;text-align:center;">
                    <img src="https://titanvaults.org/images/titanvault.png" alt="TitanVault Logo" style="width:80px;height:auto;margin-bottom:12px;">
                    <h2 style="color:#fff;font-size:1.5rem;font-weight:bold;margin:0 0 8px 0;letter-spacing:1px;">{{ htmlspecialchars($title) }}</h2>
                </div>
                <div style="padding:32px 24px 32px 24px;">
                    <div style="color:#1e293b;font-size:1.1rem;line-height:1.7;">
                        {{ $messageBody }}
                    </div>
                </div>
                <div style="background:#f0f6ff;padding:16px;text-align:center;color:#64748b;font-size:0.95rem;">
                    &copy; {{ date('Y') }} TitanVault. All rights reserved.
                </div>
            </div>
        </div>
    </body>
</html>