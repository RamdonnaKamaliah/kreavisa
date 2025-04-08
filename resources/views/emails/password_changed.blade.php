<!DOCTYPE html>
<html>
<head>
    <title>Password Akun Anda Diubah</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 600px; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">🔒 Password Akun Anda Telah Diubah</h2>
        <p style="font-size: 16px; color: #555;">Halo {{ $user->nama_lengkap }},</p>
        <p style="font-size: 16px; color: #555;">Password akun Anda baru saja diubah.</p>
        <p style="font-size: 16px; color: #555;">Jika ini bukan Anda, segera hubungi admin atau reset password Anda.</p>
        <hr style="border: 0; height: 1px; background: #ddd; margin: 20px 0;">
        <p style="font-size: 14px; color: #888;">&copy; {{ date('Y') }} Kreavisa. Semua hak dilindungi.</p>
    </div>
</body>
</html>