{{-- <!DOCTYPE html>
<html>
<head>
    <title>Email Broadcast</title>
</head>
<body>
    <div>
        <h3>judul email : {{ $email->subject }}</h3>
    </div>
    <div>
        {!! $email->body !!}
    </div>
    <div>
        <img src="{{ asset('storage/' . $email->image_url) }}" alt="" width="300px">
    </div>    
</body>
</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broadcast Email</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding:20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1d4ed8; color:#ffffff; padding:20px; text-align:center;">
                            <h1 style="margin:0; font-size:20px;">📢 Membership ISolutions</h1>
                        </td>
                    </tr>
                    
                    <!-- Body -->
                    <tr>
                        <td style="padding:20px; color:#374151; font-size:14px; line-height:1.6;">
                            {{-- {!! $email->body !!} --}}
                            {!! $body !!}
                        </td>
                    </tr>

                    {{-- @if(!empty($email->image_url)) --}}
                    @if(!empty($image))
                    <!-- Banner Gambar -->
                    <tr>
                        <td style="padding:0 20px 20px 20px;">
                            {{-- <img src="{{ asset('storage/' . $email->image_url) }}" alt="Gambar" style="width:100%; border-radius:6px; display:block;"> --}}
                            <img src="{{ asset('storage/' . $image) }}" alt="Gambar" style="width:100%; border-radius:6px; display:block;">
                        </td>
                    </tr>
                    @endif

                    <!-- CTA Button (optional, kalau nanti mau promo / reminder) -->
                    {{-- <tr>
                        <td align="center" style="padding:20px;">
                            <a href="https://yourdomain.com" style="background-color:#1d4ed8; color:#ffffff; text-decoration:none; padding:12px 24px; border-radius:4px; display:inline-block;">
                                Lihat Detail
                            </a>
                        </td>
                    </tr> --}}
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9fafb; color:#6b7280; text-align:center; padding:12px; font-size:12px;">
                            Email ini dikirim otomatis, mohon tidak membalas pesan ini.<br>
                            &copy; {{ date('Y') }} Membership ISolutions.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>


