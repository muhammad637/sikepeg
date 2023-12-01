@extends('main', ['title' => 'Show Pegawai'])
@push('style-css')
    <style>
        .judul-text {
            color: black;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <h1 class="text-center my-5 judul-text ">Personal File</h1>
    <div class="main-body ">
        <div class="card mb-3">
            <div class="card-body judul-text">
                <div class="text-center mb-3">
                    <h5 style="margin-bottom: -25px; " class="">
                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                    </h5>
                    <br />
                    {{-- <span class="badge bg-light fw-italic">Nonaktif</span> --}}
                    <span
                        class="badge {{ $pegawai->status_pegawai == 'aktif' ? 'bg-success' : 'bg-warning' }} text-white">{{ $pegawai->status_pegawai }}</span>
                    <span class="judul-text">{{ $pegawai->jabatan }}</span>
                </div>
                <div class="row">
                    <!-- profie -->
                   
                    <div class="col-sm-12 col-md-12 col-lg-3 my-5">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{$pegawai->jenis_kelamin == 'laki-laki' ? 'https://bootdey.com/img/Content/avatar/avatar7.png' : asset('image/perempuan.jpg')}}" alt="Admin"
                                class="rounded-circle" width="150" />
                        </div>
                    </div>  
                   
                   
                    
                    <!-- end profile -->

                    <!-- isi -->
                    <div class="col-sm-12 col-md-12 col-lg-9 text-capitalize">

                        <div class="badge mb-3 p-1 px-2" style="background: black">
                            <h4 class="fw-bold text-white">
                                # Biodata Pegawai
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col" class="judul-text">
                                            NIK</th>
                                        <td scope="col">{{ $pegawai->nik}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">
                                            {{ $pegawai->status_tenaga == 'asn' ? 'NIP' : 'NIPPK' }}</th>
                                        <td scope="col">{{ $pegawai->nip_nippk }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Nama Lengkap</th>
                                        <td scope="col">
                                            {{ $pegawai->nama_lengkap ?? $pegawai->gelar_depan . ' ' . $pegawai->nama_depan . ' ' . $pegawai->nama_belakang . ' ' . $pegawai->gelar_belakang }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Tempat Tanggal Lahir</th>
                                        <td scope="col">
                                            {{ $pegawai->tempat_lahr . ' ' . Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Usia</th>
                                        <td scope="col">
                                            {{ date_diff(date_create($pegawai->tanggal_lahir), date_create('now'))->y }}
                                            Tahun</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Alamat</th>
                                        <td scope="col">{{ $pegawai->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">No Wa</th>
                                        <td scope="col">{{ $pegawai->no_wa }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Status Pegawai</th>
                                        <td scope="col">{{ $pegawai->status_tenaga }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                    </div>
                    <!-- end isi -->
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 ">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col" class="judul-text">Ruangan</th>
                                        <td scope="col ">{{ strtoupper($pegawai->ruangan->nama_ruangan) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Tahun Pensiun</th>
                                        <td scope="col">
                                            {{ $pegawai->tahun_pensiun}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Status Tenaga</th>
                                        <td scope="col "class="text-uppercase">
                                            {{ $pegawai->status_tenaga .' / '.$pegawai->status_tipe }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Jabatan</th>
                                        <td scope="col">
                                            {{ $pegawai->jabatan ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <tr>
                                            <th scope="col" class="judul-text">Pendidikan Terakhir</th>
                                            <td scope="col">{{ $pegawai->pendidikan_terakhir }}</td>
                                        </tr>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Tanggal Lulus</th>
                                        <td scope="col">{{ $pegawai->tanggal_lulus }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">No Ijazah</th>
                                        <td scope="col">{{ $pegawai->no_ijazah }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Masa Kerja</th>
                                        <td scope="col">{{ $pegawai->status_tipe == 'pns' ? date_diff(date_create($pegawai->tmt_pns),date_create('now'))->y : ($pegawai->status_tipe == 'pppk' ? date_diff(date_create($pegawai->tmt_pppk),date_create('now'))->y : date_diff(date_create($pegawai->tanggal_masuk),date_create('now'))->y) }} Tahun</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Cuti Tahunan</th>
                                        <td scope="col">{{ $pegawai->cuti_tahunan }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="judul-text">Sisa Cuti Tahunan</th>
                                        <td scope="col">{{ $pegawai->sisa_cuti_tahunan }} hari <a href="#" class="badge bg-warning text-dark {{$pegawai->str->count() > 0 ? '' : 'd-none'}}">Lihat</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 ">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @if ($pegawai->status_tipe == 'pns')
                                        <tr>
                                            <th scope="col" class="judul-text">Sekolah / Perguruan Tinggi</th>
                                            <td scope="col">{{ $pegawai->sekolah }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">TMT CPNS</th>
                                            <td scope="col">{{ $pegawai->tmt_cpns }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">TMT PNS</th>
                                            <td scope="col">
                                                {{ $pegawai->tmt_pns}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">TMT Pangkat Terakhir</th>
                                            <td scope="col">
                                                {{ $pegawai->tmt_pangkat_terakhir }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="col" class="judul-text">Pangkat / Golongan</th>
                                            <td scope="col" class="text-uppercase">
                                                {{ $pegawai->pangkat->nama_pangkat .' '. $pegawai->golongan->nama_golongan }} <a href="{{route('admin.kenaikan-pangkat.riwayat',[ 'pegawai' => $pegawai->id])}}" class="badge bg-warning text-dark {{$pegawai->kenaikanpangkat->count() > 0 ? "" : "d-none"}}">Lihat</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">Jenis Tenaga</th>
                                            <td scope="col" class="text-uppercase">{{ $pegawai->jenis_tenaga }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">No Karpeg</th>
                                            <td scope="col">{{ $pegawai->no_karpeg ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">No Taspen</th>
                                            <td scope="col">{{ $pegawai->no_taspen ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">No NPWP</th>
                                            <td scope="col">{{ $pegawai->no_npwp ?? '-' }}</td>
                                        </tr>
                                        
                                        @if ($pegawai->jenis_tenaga == 'nakes')
                                        {{-- <tr>
                                            <th scope="col" class="judul-text">Tanggal Berakhir STR</th>
                                            <td scope="col">{{ $pegawai->str->sortByDesc('tanggal_terbit_str')->first()->masa_berakhir_str ?? '-' }} <a href="{{route('admin.str.history',['pegawai' => $pegawai->id])}}" class="badge bg-warning text-dark {{$pegawai->str->count() > 0 ? '' : 'd-none'}}">Lihat</a></td>
                                        </tr> --}}
                                        <tr>
                                            <th scope="col" class="judul-text">Tanggal Berakhir SIP</th>
                                            <td scope="col">{{ $pegawai->sip->sortByDesc('tanggal_terbit_sip')->first()->masa_berakhir_sip ?? '-' }} <a href="{{route('admin.sip.history',['pegawai' => $pegawai->id])}}" class="badge bg-warning text-dark {{$pegawai->sip->count() > 0 ? '' : 'd-none'}}">Lihat</a></td>
                                        </tr>
                                        @endif
                                        @elseif($pegawai->status_tipe == 'pppk')
                                        <tr>
                                            <th scope="col" class="judul-text">Sekolah / Perguruan Tinggi</th>
                                            <td scope="col">{{ $pegawai->sekolah }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">TMT PPPK</th>
                                            <td scope="col">{{ $pegawai->tmt_pppk }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">TMT Pangkat Terakhir</th>
                                            <td scope="col text-uppercase">
                                                {{ $pegawai->tmt_pangkat_terakhir }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="col" class="judul-text">Golongan</th>
                                            <td scope="col">
                                                {{ $pegawai->golongan->nama_golongan }}
                                               </td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">Jenis Tenaga</th>
                                            <td scope="col">{{ $pegawai->jenis_tenaga }}</td>
                                        </tr>
                                       @if ($pegawai->jenis_tenaga == 'nakes')
                                        <tr>
                                            <th scope="col" class="judul-text">Tanggal Berakhir STR</th>
                                            <td scope="col">{{ $pegawai->str->sortByDesc('masa_berakhir_str')->first() ? Carbon\Carbon::parse($pegawai->str->sortByDesc('masa_berakhir_str')->first()->masa_berakhir_str)->format('d-m-Y'): '-' }} <a href="#" class="badge bg-warning text-dark {{$pegawai->str->count() > 0 ? '' : 'd-none'}}">Lihat</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">Tanggal Berakhir SIP</th>
                                            <td scope="col">{{ $pegawai->sip->sortByDesc('tanggal_terbit_sip')->first() ? 'tes' : '-' }} <a href="#" class="badge bg-warning text-dark {{$pegawai->sip->count() > 0 ? '' : 'd-none'}}">Lihat</a></td>
                                        </tr>
                                        @endif
                                        @else
                                        <tr>
                                            <th scope="col" class="judul-text">Tanggal Masuk Pegawai</th>
                                            <td scope="col">{{ $pegawai->tanggal_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="judul-text">NI PTT-PK/THL</th>
                                            <td scope="col">{{ $pegawai->niPtt_pkThl }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('script')
@endpush
