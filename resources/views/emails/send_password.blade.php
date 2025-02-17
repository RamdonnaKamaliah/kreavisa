<!DOCTYPE html>
<html>
<head>
    <title>Password Akun Anda</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 600px; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">👋 Selamat Datang di Sistem Kreavisa!</h2>
        <p style="font-size: 16px; color: #555;">Berikut adalah password untuk akun Anda:</p>
        <p style="font-size: 20px; font-weight: bold; color: #333; background: #f8f8f8; padding: 10px; border-radius: 5px; display: inline-block;">
            {{ $password }}
        </p>
        <p style="font-size: 16px; color: #555;">Silakan gunakan password ini untuk login ke Website Kreavisa.</p>
        <p style="font-size: 16px; color: #555;">Jika Anda tidak meminta akun ini, silakan abaikan email ini.</p>
        <hr style="border: 0; height: 1px; background: #ddd; margin: 20px 0;">
        <p style="font-size: 14px; color: #888;">&copy; {{ date('Y') }} Kreavisa. Semua hak dilindungi.</p>
    </div>
</body>

</html>