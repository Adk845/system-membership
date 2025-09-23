<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #f7f7f7; padding: 0; margin: 0;">
    <table width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; overflow: hidden;">
        <tr>
            <td style="background-color:#800000; padding: 20px; text-align:center; color:#ffffff;">
                <h1 style="margin:0; font-size: 22px;">🎉 Selamat, Pendaftaran Berhasil!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 25px; color:#333333; line-height:1.6;">
                <p>Halo <strong>{{ $anggota->nama }}</strong>,</p>
                <p>
                    Terima kasih telah mendaftar di <strong>{{ config('app.name') }}</strong>.  
                    Akun Anda telah dibuat secara otomatis dan Anda juga sudah berhasil terdaftar
                    pada event berikut:
                </p>
                <table style="background-color:#f3f3f3; padding:15px; border-radius:6px; margin: 15px 0; width:100%;">
                    <tr>
                        <td><strong>Nama Event:</strong></td>
                        <td>{{ $event->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Waktu:</strong></td>
                        <td>{{ $event->waktu }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi:</strong></td>
                        <td>{{ $event->lokasi }}</td>
                    </tr>
                </table>

                <p>Berikut informasi akun Anda untuk login ke platform kami:</p>

                <ul style="background:#f3f3f3; padding:15px; border-radius:6px; list-style:none;">
                    <li><strong>Email:</strong> {{ $anggota->email }}</li>
                    <li><strong>Password Default:</strong> 123456789</li>
                    {{-- <li><strong>Email:</strong> {{ $user->email }}</li>
                    <li><strong>Password Default:</strong> {{ $defaultPassword }}</li> --}}
                </ul>

                <p style="margin-top:20px;">
                    Demi keamanan, silakan segera login dan <strong>ganti password</strong> Anda setelah masuk pertama kali.
                </p>

                <div style="text-align:center; margin: 30px 0;">
                    <a href="{{ route('login') }}"
                       style="background-color:#800000; padding:12px 20px; color:#ffffff; text-decoration:none; border-radius:5px; display:inline-block;">
                       🔑 Login ke Akun
                    </a>
                </div>

                <p style="font-size:14px; color:#666666;">
                    Jika Anda merasa tidak melakukan pendaftaran ini, abaikan email ini.
                </p>

                <p>Terima kasih,<br>
                <strong>{{ config('app.name') }}</strong></p>
            </td>
        </tr>
        <tr>
            <td style="background:#800000; padding:10px; text-align:center; color:#ffffff; font-size:12px;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
