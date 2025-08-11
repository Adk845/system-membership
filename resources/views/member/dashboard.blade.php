@extends('adminlte::page')

@section('title', 'Dashboard Member')

@section('content')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

{{-- @dd($data) --}}
<div class="dashboard-container">
    <div class="row">
        {{-- Kiri: Kartu Member --}}
        <div class="col-md-5 col-left">
            <div class="member-card" style="background-image: url('{{ asset('images/depan.png') }}');">
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
                <div class="info-card">
                    <div class="d-flex align-items-center" id="foto_nama">                        
                        <div>
                            @if($anggota->foto)
                                <img style="width: 100px; height:100px; border-radius: 50%;" src="{{ asset('storage/'.$anggota->foto) }}" alt="Foto Profil">
                            @else
                                <img style="width: 100px; height:100px; border-radius: 50%;" src="{{ asset('images/no_profile.jpg') }}" alt="Foto Default">
                            @endif
                        </div>                        
                        <div class="ml-2 d-flex align-items-center">
                            <p style="font-size: 20px; font-weight: 600; margin: 0;">{{ $anggota->nama }}</p>
                            <i class="far fa-check-circle ml-2"></i>
                        </div>
                    </div>
                    <div id="about_me" class="mt-4 mb-4">
                        <p style="font-weight:500; color:rgb(115, 115, 115);">{{ $anggota->about_me }}</p>
                    </div>

                    <div id="data_diri">
                        <table>
                            <tr class="baris" >
                                <td style="width: 180px" class="title-data">Nomor Keanggotaan</td>
                                <td>:</td>
                                <td style="font-weight: 600"> {{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr class="baris">
                                <td class="title-data">Status Keanggotaan</td>
                                <td>:</td>
                                <td style="font-weight: 600"> {{ ucfirst($user->role) }}</td>
                            </tr>
                            <tr class="baris">
                                <td class="title-data">Domisili</td>
                                <td>:</td>
                                <td style="font-weight: 600"> {{ $anggota->domisili }}</td>
                            </tr>
                            <tr class="baris">
                                <td class="title-data">Email</td>
                                <td>:</td>
                                <td style="font-weight: 600"> {{ $anggota->email }}</td>
                            </tr>
                            <tr class="baris">
                                <td class="title-data">Anggota Sejak</td>
                                <td>:</td>
                                <td style="font-weight: 600"> {{ $anggota->created_at->format('Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="pt-4 pb-4">
                        <a href="{{ route('member.profile') }}" style="width: 300px" class="btn btn-outline-primary">Lihat profil</a>
                    </div>
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
