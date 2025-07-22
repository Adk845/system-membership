@extends('adminlte::page')

@section('title', 'Dashboard Member')

@section('content')

<style>
    :root {
        --primary: #3c4b64;
        --accent: #4f5d78;
        --light: #f7f8fa;
        --white: #ffffff;
        --shadow: rgba(0, 0, 0, 0.05);
    }
    body {
        background: var(--light) !important;
        font-family: 'Segoe UI', sans-serif;
        color: #2a2a2a;
    }
    .dashboard-container {
        padding: 30px 15px;
    }
    .col-left, .col-right {
        margin-bottom: 30px;
    }
  .member-card {
    width: 100%;
    max-width: 450px; /* Lebar maksimum agar tidak terlalu besar */
    aspect-ratio: 1.409 / 1; /* Menjaga rasio gambar */
    border-radius: 15px;
    background-size: contain; /* Agar gambar tidak terpotong */
    background-position: center;
    background-repeat: no-repeat;
    box-shadow: 0 4px 15px var(--shadow);
    margin: 0 auto 20px auto; /* Tengah dan bawah */
    position: relative;
    overflow: hidden;
}


    .member-card .overlay {
        position: absolute;
        inset: 0;
        /* background: rgba(0,0,0,0.4); */
        color: var(--white);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 24px;
    }
    .member-card .overlay h4 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    .member-card .overlay p {
        font-size: 14px;
        margin: 4px 0 0;
    }
    /* .member-card .qr {
        align-self: flex-end;
        width: 60px;
        height: 60px;
        background: var(--white);
        padding: 6px;
        border-radius: 8px;
        box-shadow: 0 2px 8px var(--shadow);
    }
    .member-card .qr img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    } */
    .info-card {
        background: var(--white);
        border-radius: 8px;
        box-shadow: 0 2px 8px var(--shadow);
        padding: 20px;
        margin-bottom: 20px;
    }
    .info-card h5 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 12px;
    }
    .info-card .nav-tabs {
        border-bottom: none;
    }
    .info-card .nav-tabs .nav-link {
        color: #666;
        font-weight: 500;
    }
    .info-card .nav-tabs .nav-link.active {
        color: var(--primary);
        border: none;
        border-bottom: 2px solid var(--primary);
    }
    .info-card .tab-content {
        margin-top: 12px;
    }
    .penggerak {
        display: flex;
        align-items: center;
        font-size: 14px;
    }
    .penggerak i {
        font-size: 20px;
        margin-right: 8px;
        color: var(--primary);
    }
    .penggerak .text-center {
        flex: 1;
        text-align: center;
        font-weight: 500;
    }
    .metrics {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .metric-card {
        flex: 1;
        min-width: 160px;
        background: var(--white);
        border-radius: 8px;
        box-shadow: 0 2px 8px var(--shadow);
        padding: 16px;
        text-align: center;
    }
    .metric-card i {
        font-size: 24px;
        margin-bottom: 6px;
        display: block;
        color: #a57c00;
    }
    .metric-card .value {
        font-size: 20px;
        font-weight: 600;
    }
    .metric-card .label {
        font-size: 14px;
        color: #555;
        margin-top: 4px;
    }
    .ranking-section {
        background: var(--white);
        border-radius: 8px;
        box-shadow: 0 2px 8px var(--shadow);
        padding: 20px;
    }
    .ranking-section h5 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
    }
    .ranking-cards {
        display: flex;
        gap: 16px;
        justify-content: space-between;
    }
    .ranking-card {
        flex: 1;
        text-align: center;
        padding: 12px;
        border: 1px solid #eee;
        border-radius: 6px;
    }
    .ranking-card h6 {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }
    .ranking-card .place {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
    }
</style>
{{-- @dd($data) --}}
<div class="dashboard-container">
    <div class="row">
        {{-- Kiri: Kartu Member --}}
        <div class="col-md-5 col-left">
            <div class="member-card" style="background-image: url('{{ asset('images/depan.png   ') }}');">
                <div class="overlay">
                    <div style="position: absolute; 
                                top: 50%; 
                                left: 50%; 
                                transform: translate(-50%, -50%);
                                margin: 0;
                                width: 100%;
                                text-align: center;
                                pointer-events: none;">
                        
                        {{-- <h4>{{ str_pad($anggota->id, 4, '0', STR_PAD_LEFT) }}</h4> --}}
                        <h4 style="margin-bottom: 5px; font-size: 30px; color: #e7c47b; font-family: 'Poppins', sans-serif; font-weight: normal;">{{ $anggota->nama }}</h4>
                        <h4>{{ ucfirst($anggota->level) }}</h4>
                        {{-- Nomor unik kartu --}}
                        <p style="font-size: 16px; color: #fff; font-weight: 400; margin: 0; color: #e7c47b;">
                        {{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}
                        </p>                
                    </div>
                    {{-- Kiri Bawah: Member Since --}}
                    <p style="font-family: 'Great Vibes', cursive; position: absolute; bottom: 30px; left: 15px; font-size: 16px; color: #e7c47b; font-weight: 400; margin: 0;">
                        Member Since: 
                        {{ $user->created_at->format('Y') }}
                    </p>                    
                </div>
            </div>
            <div class="member-card" style="background-image: url('{{ asset('images/depan.png') }}');">
                <div class="overlay">
                    <ul style="font-size: 10px; line-height: 1.5; margin-bottom: 20px; margin-top: 50px;">
                    <strong>Disclaimer Kartu Keanggotaan:</strong> 
            
                        <li>Kartu <strong>ini eksklusif dari komunitas membership ISolutions Indonesia</strong>.</li>
                        <li><strong>ISolutions Indonesia tidak bertanggung jawab</strong> atas kerugian atau kerusakan yang timbul akibat kehilangan atau penggunaan kartu yang tidak sah.</li>
                        <li>Kartu ini merupakan tanggung jawab pemilik, <strong>ISolutions Indonesia tidak bertanggung jawab atas penyalahgunaan</strong>.</li>
                        <li>Segala bentuk <strong>penyalahgunaan akan dikenakan sanksi</strong>, termasuk pembatalan akses tanpa kompensasi.</li>
                        <li><strong>Pelanggaran terhadap ketentuan ini</strong> dapat mengakibatkan pembatalan keikutsertaan secara mutlak.</li>
                        <li><strong>ISolutions berhak menolak akses</strong> apabila ditemukan penyalahgunaan.</li>
                        <li>Jika kartu ini ditemukan, mohon <strong>kembalikan ke ISolutions Indonesia</strong>.</li>
                    </ul>
                </div>
            </div>
        </div>

    





        {{-- Kanan: Info Profil, Metrics, Ranking --}}
        <div class="col-md-7 col-right">        

            <div class="info-card"> 
                <h5>Profil Usaha</h5>
                <p>Isolutions Indonesia</p>              
            </div>
            <div class="info-card">
                
                
                <div class="d-flex">                                           
                        <div class="ml-5 d-flex">
                            <p><strong>Status Keanggotaan</strong></p>
                            <p class="mr-2"><strong>:</strong></p>                            
                                <p class="text-center">{{ ucfirst($user->role) }}</p>                            
                        </div>
                       
                        <div class="kontener_info ml-5 d-flex" >
                            <p><strong>Domisili </strong></p>
                            <p class="mr-2"><strong>:</strong></p>
                            <p>{{ $kota }}</p>
                            {{-- <h5>{{ $kota }}</h5> --}}
                        </div>
                        @if(Auth::user()->role == 'koordinator')
                            <div class="ml-5">
                                <h5>Anggota</h5>
                                <p class="text-center" style="font-size: 20px; font-weight: bold">{{ $member->count() }}</p>
                                {{-- <p class="text-center">Anggota</p> --}}
                                {{-- <h5>{{ $member->count() }} Anggota</h5> --}}
                            </div>
                        @endif                    
                </div>
            </div>

            <div class="metrics">
                <div class="metric-card">
                    <i class="fas fa-trophy"></i>
                    <div class="value">{{'12' }}</div>
                    <div class="label">Peringkat</div>
                </div>
                <div class="metric-card">
                    <i class="fas fa-chart-line"></i>
                    <div class="value">{{'89' }}</div>
                    <div class="label">Poin</div>
                </div>
                <div class="metric-card">
                    <i class="fas fa-coins"></i>
                    <div class="value">{{ '42' }}</div>
                    <div class="label">Koin</div>
                </div>
            </div>

                <div class="ranking-section mt-4">
                    <h5>3 Peringkat Teratas Bulan Ini</h5>
                    <div class="ranking-cards">
                        <div class="ranking-card">
                            <h6>1st Place</h6>
                            <div>
                                <img src="{{ asset('images') }}/no_profile.jpg" width="100px" alt="" style="border-radius: 50%">
                            </div>
                            <div class="place">Andi Pratama</div>
                        </div>
                        <div class="ranking-card">
                            <h6>2nd Place</h6>
                            <div>
                                <img src="{{ asset('images') }}/no_profile.jpg" width="100px" alt="" style="border-radius: 50%">
                            </div>
                            <div class="place">Rina Dewi</div>
                        </div>
                        <div class="ranking-card">
                            <h6>3rd Place</h6>
                            <div>
                                <img src="{{ asset('images') }}/no_profile.jpg" width="100px" alt="" style="border-radius: 50%">
                            </div>
                            <div class="place">Dimas Oktavian</div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
